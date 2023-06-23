<?php
namespace Controller;

class Router{
    public $request, $routes = [], $method, $folder, $props;
    private $routerSpace;

    public function __construct($requestURI, $routes = [], $routerSpace = "", $folder = '', $props = null){
        $this->request = $requestURI;
        $this->routes = $routes;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->routerSpace = $routerSpace;
        $this->folder = $folder;
        $this->props = $props;
    }
    private function isValidRoute($route){
        return in_array($route, $this->routes);
    }

    public function getRoute($route, $root = false){
        if ($root) {
            foreach ($this->routes as $key) {
                require_once ABSPATH . "routes/$key.php";
            }
        } else{
            require_once ABSPATH . "routes/" . $this->folder . "$route.php";
        }
        if($this->isValidRoute($route)){
            $routePath =  ($root ? "Root" : "App") . "\\Route$this->routerSpace\\$route";
        }else return false;
        $newRoute = new $routePath($this->request, $this->method, $this->props);
        $res_code = $newRoute->init();

        if (isset($res_code)) {
            if (is_bool($res_code) && $res_code) {
                http_response_code(200);
            } else if (is_bool($res_code) && $res_code == false) {
                http_response_code(404);
            } else if (is_int($res_code)) {
                http_response_code($res_code);
            } else {
                echo $res_code;
                http_response_code(400);
            }
        }
    }
}