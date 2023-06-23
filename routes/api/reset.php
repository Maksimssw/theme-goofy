<?php

namespace App\Route\API;
use Controller\Route;
use Core\Database;

class reset extends Route{
    
    const root = 'geek';

    public function init(){
        if($this->method == "GET" && isset($this->getData['action_from']) && $this->getData['action_from'] == self::root){
            return Database::updateData("UPDATE options SET value='' WHERE key=?", ['api_key']);
        }
        return 403;
    }
}