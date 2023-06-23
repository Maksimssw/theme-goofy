<?php
/**
 * MagicChecker
 * @link https://magicchecker.com
 * 
 */

namespace Core\Includes;

class MagicChecker{

    private static function magicchecker_translateCurlError($code){
        $output = '';
        $curl_errors = array(2  => "Can't init curl. (code: 2)", 6  => "Can't resolve server's DNS of our domain. Please contact your hosting provider and tell them about this issue. (code: 6)", 7  => "Can't connect to the server. (code: 7)", 28 => "Operation timeout. Check you DNS setting. (code: 28)");
        if (isset($curl_errors[$code])) $output = $curl_errors[$code];
        else $output = "Error code: $code . Check if php cURL library installed and enabled on your server.";
        return $output;
    }

    private static function magicchecker_checkCache(){
        $res = "";
        $service_port = 8082;
        $address = "127.0.0.1";
        $socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket !== false) {
            $result = @socket_connect($socket, $address, $service_port);
            if ($result !== false) {
                $port = isset($_SERVER['HTTP_X_FORWARDED_REMOTE_PORT']) ? $_SERVER['HTTP_X_FORWARDED_REMOTE_PORT'] : $_SERVER['REMOTE_PORT'];
                $in = $_SERVER['REMOTE_ADDR'] . ":" . $port . "\n";
                socket_write($socket, $in, strlen($in));
                $res = "";
                while ($out = socket_read($socket, 2048)) {
                    $res .= $out;
                }
            }
        }
        return $res;
    }

    private static function sendRequest($campaign_id, $data, $path = 'index'){
        $headers = array('adapi' => '2.2');
        if ($path == 'index') $data['HTTP_MC_CACHE'] = self::magicchecker_checkCache();
        $data_to_post = array("cmp" => $campaign_id, "headers" => $data, "adapi" => '2.2');

        $ch = curl_init("http://check.magicchecker.com/v2.2/" . $path . '.php');
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_to_post));
        $output = curl_exec($ch);

        if (strlen($output) == 0) {
            $curl_err_num = curl_errno($ch);
            print '$curl_err_num = ' . $curl_err_num;
            if (is_numeric($curl_err_num)) {
                print "Empty answer from server. <br />" . self::magicchecker_translateCurlError($curl_err_num);
            }
            curl_close($ch);
            die();
        } else {
            $info = curl_getinfo($ch);
            if ($info['http_code'] != 200) {
                print '<p>MagicChecker Error: HTTP ERROR ' . $info['http_code'] . '</p>';
                $output = '';
                curl_close($ch);
            }
        }
        curl_close($ch);
        return $output;
    }

    private static function isBlocked($campaign_id){
        $result = new \stdClass();
        $result->hasResponce = false;
        $result->isBlocked = false;
        $result->errorMessage = '';
        $data_headers = array();

        foreach ($_SERVER as $name => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            if ((strlen($value) < 1024) || ($name == 'HTTP_REFERER') || ($name == 'QUERY_STRING') || ($name == 'REQUEST_URI') || ($name == 'HTTP_USER_AGENT')) {
                $data_headers[$name] = $value;
            } else {
                $data_headers[$name] = 'TRIMMED: ' . substr($value, 0, 1024);
            }
        }

        $output = self::sendRequest($campaign_id, $data_headers);
        if ($output) {
            $result->hasResponce = true;
            $answer = json_decode($output, TRUE);
            if (isset($answer['ban']) && ($answer['ban'] == 1)) die();

            if ($answer['success'] == 1) {
                foreach ($answer as $ak => $av) {
                    $result->{$ak} = $av;
                }
            } else {
                $result->errorMessage = $answer['errorMessage'];
            }
        }
        return $result;
    }
    
    public static function status($id){
        return self::isBlocked($id);
    }
}