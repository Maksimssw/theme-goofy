<?php
namespace Root\Route;

use Controller\Route;

class admin extends Route {
    public function init(){
        require_once ABSPATH . 'routes/admin/index.php';
        return true;
    }
}