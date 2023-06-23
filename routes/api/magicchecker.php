<?php

namespace App\Route\API;
use Controller\Route;
use Core\Database;

class magicchecker extends Route{
    public function init(){
        if (!$this->props) return 403;
        switch ($this->method) {
            case 'GET':
                $result = Database::getData("SELECT * FROM magicchecker", [], "all");
                print(json_encode($result));
                return true;
                break;
            case 'POST':
                if (is_array($this->postData)){
                    $req  = [];
                    for($i=0; $i < count($this->postData); $i++){
                        $str = "('" . clearVal($this->postData[$i]['key']) . "','" . clearVal($this->postData[$i]['value']) . "')";
                        $req[] = $str;
                        unset($str);
                    }
                    $result = Database::updateData("INSERT INTO magicchecker (key, value) VALUES " . implode(',', $req), []);
                    if (is_bool($result) && $result === true) {
                        return 200;
                    } else print($result);
                }
                break;
            case 'PATCH':
                if (is_array($this->postData)) {
                    for ($i = 0; $i < count($this->postData); $i++) {
                        $result = Database::updateData("UPDATE magicchecker SET value=? WHERE key=?", [clearVal($this->postData[$i]['value']), clearVal($this->postData[$i]['key'])]);
                        if (!is_bool($result) && $result !== true) {
                            print($result);
                            return 400;
                        }
                    }
                    return true;
                }
                break;    
            case 'DELETE';
                if (is_array($this->postData)) {                    
                    for ($i = 0; $i < count($this->postData); $i++) {
                        $result = Database::updateData("DELETE FROM magicchecker WHERE key=?", [clearVal($this->postData[$i])]);
                        if (!is_bool($result) && $result !== true) {
                            print($result);
                            return 400;
                        }
                    }
                    return true;
                }
                break;
        }
        return false;
    }
}