<?php

namespace App\Route\API;
use Controller\Route;
use Core\Database;

class options extends Route{
    const optionsKeys = ['template', 'utm_key', 'trackers', 'version', 'api_key'];
    public function init(){
        if (!$this->props) return 403;
        switch ($this->method) {
            case 'GET':
                $result = Database::getData("SELECT * FROM options", [], "all");
                for ($i = 0; $i <  count($result); $i++) {
                    $formated[$result[$i]['key']] = $result[$i]['value'];
                }
                unset($result);
                if (is_array($formated)) {
                    print(json_encode($formated));
                    return true;
                }
                break;
            case 'PATCH':
                foreach ($this->postData as $key => $value) {
                    if (in_array($key, self::optionsKeys)) {
                        $result = Database::updateData("UPDATE options SET value=? WHERE key=?", [clearVal($value), clearVal($key)]);
                        if (!is_bool($result) && $result !== true) {
                            print($result);
                            return 400;
                        }
                        return true;
                    } else {
                        echo "This key is not found: $key";
                        return 400;
                    }
                }

                break;
        }
        return false;
    }
}