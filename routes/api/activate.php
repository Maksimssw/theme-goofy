<?php

namespace App\Route\API;

use Controller\Route;
use Core\Database;

class activate extends Route{
    public function init(){
        if(!isset($this->postData['api_key']) || !$this->postData['api_key']) return false;
        if(!$this->props && getOptions('api_key')) return 401;
        $result = Database::updateData("UPDATE options SET value=? WHERE key=?", [clearVal($this->postData['api_key']), 'api_key']);
        if($result){
            $file_path = ABSPATH . clearVal($this->postData['api_key']) . ".txt";
            file_put_contents($file_path ,'', FILE_APPEND);
        }
        return true;
    }
}
