<?php

namespace App\Route\API;

use Controller\Route;
use Core\Database;

class analytics extends Route{
    public function init(){
        $row_per_page = 15;
        $current_page = 1;
        switch ($this->method) {
            case 'GET':
                $count = Database::getData("SELECT COUNT(*) FROM analytics", [], "", 3)[0];
                if (!$count) return 204;
                $pages = ceil($count / $row_per_page);
                if (isset($this->getData['page']) && clearVal($this->getData['page'], 'int') > 1) $current_page = clearVal($this->getData['page'], 'int');
                $current_page = $current_page > $pages ? $pages : $current_page;
                $offset = ($current_page - 1) * $row_per_page;

                $data = Database::getData("SELECT * FROM analytics ORDER BY date DESC LIMIT $offset, $row_per_page", [], 'all');
                $result['count'] = $count;
                $result['pages'] = $pages;
                $result['data'] = $data;
                print(json_encode($result));
                return true;
                break;
        }
        return false;
    }
}
