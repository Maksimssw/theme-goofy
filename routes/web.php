<?php

namespace Root\Route;

use Controller\Route;
use Core\Analytics;
use Core\Database;
use Core\Includes;

require_once INC . '/MagicChecker.php';

class web extends Route{
    private $mc_campaigns, $magicResult;
    public $debug, $utm_key;
    public function init(){
        //Check Debug Mode
        $this->debug = isset($this->getData['debug']) ? clearVal($this->getData['debug']) : false;

        // Get Main UTM from MagicChecker
        $this->utm_key = getOptions('utm_key');
        
        // Get MagicChecker's Campaigns
        if(!$GLOBALS['TEST_MODE']){
            $result = Database::getData("SELECT * FROM magicchecker", [], 'all');
            if(isset($result[0])){
                for ($i = 0; $i < count($result); $i++) {
                    $GLOBALS['magicchecker'][$result[$i]['key']] = $result[$i]['value'];
                }
            }
            unset($result);
        }
        $this->mc_campaigns = $GLOBALS['magicchecker'] ?: array();

        // Check Target UTM in URL(Get Data)
        if(isset($this->getData[$this->utm_key]) && array_key_exists($this->getData[$this->utm_key], $this->mc_campaigns) && $this->mc_campaigns[$this->getData[$this->utm_key]]){
            // Get result from MagicChecker
            $this->magicResult = (array) Includes\MagicChecker::status($this->mc_campaigns[clearVal($this->getData[$this->utm_key])]);
            // Success
            if ($this->magicResult['success'] && (is_int($this->magicResult['isBlocked']) && $this->magicResult['isBlocked'] == 0)) {
                if($this->magicResult['urlType'] == 'redirect'){
                    return $this->filter('promo', '', true);
                    
                }
                if(is_dir(THEMES . DIRECTORY_SEPARATOR . clearVal($this->getData[$this->utm_key]))){
                    return $this->filter('promo', clearVal($this->getData[$this->utm_key]));
                }
            }
        }
        return $this->filter('safe', getOptions('template'));
    }
    private function filter($status, $template_name, $redirect = false){
        // Save user Data
        if (!isset($_COOKIE['user_id']) && !$this->debug) {
            $user_id = time() . '.' . uniqid();
            setcookie('user_id', $user_id, time() + (3600 * 24 * 30), '/');
            Analytics::add($user_id, $status);
            unset($user_id);
        }

        // Macros for redirect link
        $linkMacros = [
            'source'    => $_SERVER['SERVER_NAME'],
            'ua'        => Analytics::$userAgent,
            'ip'        => Analytics::$ip,
            'referer'   => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
        ];

        // Debug Mode
        if ($this->debug && is_dir(THEMES . DIRECTORY_SEPARATOR . $this->debug) && !$redirect) {
            $GLOBALS['active_template'] = $this->debug;
            return $this->get_template(implode("-", $this->request));
        }

        if($redirect){
            $redirectURL = parse_url($this->magicResult['url']);
            if ($redirectURL['query']) {
                parse_str($redirectURL['query'], $decoded);
                foreach ($decoded as $key => $value) {
                    if (str_starts_with($value, '_')){
                        if(in_array(substr($value, 1), array_keys($linkMacros))) $decoded[$key] = $linkMacros[substr($value, 1)];
                        else $decoded[$key] = isset($this->getData[substr($value, 1)]) ? clearVal($this->getData[substr($value, 1)]) : "";
                    }    
                }
                $redirectURL['query'] = http_build_query($decoded);
            }
            $urlResult = $redirectURL['scheme'] . '://' . $redirectURL['host'] . $redirectURL['path'] . (isset($redirectURL['query']) ?  '?' . $redirectURL['query'] : '');
            if($this->debug && $this->debug == 'redirect'){
                echo "<pre>" . $urlResult . '</pre>';
                return true;
            }else
                header("Location: $urlResult");
        }

        $GLOBALS['active_template'] = $template_name;
        return $this->get_template(implode("-", $this->request));
    }

    private function get_template($file_name){
        // Get php path of Template
        $template = get_template_dir('php');
        
        // Require Theme's Functions file
        $func = $template . 'functions.php' ;
        if(file_exists($func)){
            require_once $func;
            unset($func);
        }
        if($file_name == 'functions') $file_name = '';

        // Check index file of template
        if (!file_exists($template . "index.php")) {
            getTemplate('error');
            return 501;
        }

        // Generate path
        switch ($file_name) {
            case '404':
                if (file_exists($template . '404.php')){
                    require_once $template . '404.php';
                    return 404;
                }
                $file_name = '';
            default:
                if(!$file_name){
                    require_once $template . 'index.php';
                    return true;
                }
                $template .= $file_name . '.php';
                if(file_exists($template)){
                    require_once $template;
                    return true;
                }else{
                    return $this->get_template('404');
                }
        }
    }
}
