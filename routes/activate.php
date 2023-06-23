<?php

namespace Root\Route;

use Controller\Route;

class activate extends Route{
    public function init(){
        getTemplate('activate');
        return true;
    }
}