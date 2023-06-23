<?php
// Include classes required for initialization.
require_once CLASSES . '/Database.php';
require_once CLASSES . '/Router.php';
require_once CLASSES . '/Route.php';
require_once CLASSES . '/Analytics.php';

require_once SYSTEM  . '/functions.php';


use Core\Database;
use Controller\Router;

function init(){

    //Load system options
    if(!$GLOBALS['TEST_MODE']){
        Database::getConnection();
        $result = Database::getData("SELECT * FROM options", [], "all");
        for ($i = 0; $i < count($result); $i++) {
            $GLOBALS['options'][$result[$i]['key']] = $result[$i]['value'];
        }
    } else{
        if (!file_exists(ABSPATH . 'system.json')) {
            echo sprintf("<p>There doesn't seem to be a %s file. I need this before we can get started.</p>", '<code>system.json</code>');
            http_response_code(500);
            die();
        }
        $result = json_decode(file_get_contents(ABSPATH . 'system.json'), true);
        foreach ($result as $key => $value) {
            $GLOBALS[$key] = $value;
        }
    }
    unset($result);

    // Build array from request
    $requestURI = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    if (stripos(end($requestURI), '?') || str_starts_with(end($requestURI), '?')) {
        $requestURI[count($requestURI) - 1] = stristr(end($requestURI), '?', true);
    }

    //Start session
    session_start();
    switch($requestURI[0]){
        case 'api':
            $api = new Router(array_slice($requestURI, 1), ['api']);
            $api->getRoute('api', true);
            break;
        case 'sitemap.xml':
            getTemplate('sitemap');
            http_response_code(200);
            break;
        case 'robots.txt':
            getTemplate('robots');
            http_response_code(200);
            break;     
        case 'admin':
            $api_key = isset($_GET['api_key']) ? clearVal($_GET['api_key']): $_COOKIE['api_key'];
            if($api_key == getOptions('api_key')){
                $admin = new Router(array_slice($requestURI,1), ['admin']);
                $admin->getRoute('admin',true);
                break; 
            }     
        default:
            $web = new Router($requestURI, ['web', 'activate', 'admin']);
            $web->getRoute(getOptions('api_key') || $GLOBALS['TEST_MODE'] ? 'web' : 'activate', true);
    }
    //Save log
    if(!$GLOBALS['TEST_MODE'])
        update_logs();
}
init();
