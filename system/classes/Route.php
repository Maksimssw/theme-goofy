<?php
namespace Controller;

abstract class Route{
    public $request, $postData, $getData, $method, $props;
    public function __construct($request, $method, $props){
        $this->request = $request;
        $this->method = $method;
        $this->props = $props;
        if (count($_GET)) $this->getData = $_GET;
        $this->postData = json_decode(file_get_contents('php://input'), true);
    }

    abstract protected function init();
}