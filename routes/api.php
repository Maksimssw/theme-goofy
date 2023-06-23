<?php
namespace Root\Route;

use Controller\Route;
use Controller\Router;

class api extends Route {
    
    const apiRoutes = ["analytics", "options", "magicchecker", "upload", "download", "activate", "reset"];

    public function init(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE');

        // Deny access to API if Test Mode is active
        if ($GLOBALS['TEST_MODE']) {
            http_response_code(403);
            return;
        }

        if ($this->request && in_array($this->request[0], self::apiRoutes)) {
            $api = new Router(array_slice($this->request, 1), self::apiRoutes, "\\API" , 'api/', $this->checkAuth());
            $api->getRoute($this->request[0]);
        } else {
            http_response_code(400);
            return;
        }
    }
    private function checkAuth(){
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && !preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            return false;
        } else if (isset($matches) && $matches[1] == getOptions('api_key')) {
            return true;
        }
        return false;
    }
}