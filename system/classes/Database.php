<?php
namespace Core;

class Database {
    private static $db_name = STORAGE . '/database.db';
    public static $connection;
    public static function getConnection(){
        try {
            self::$connection = new \PDO('sqlite:' . self::$db_name);
        } catch (\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
    public static function getData($sql, $params = [], $fetch = "", $mode = 2){
        $data = self::$connection->prepare($sql);
        $data->execute($params);
        switch ($fetch) {
            case 'all':
                return $data->fetchAll($mode);
            default:
                return $data->fetch($mode);
        }
    }
    public static function updateData($sql, $params){
        try {
            return self::$connection->prepare($sql)->execute($params);
            return true;
        } catch (\PDOException $th) {
            return json_encode(["code" => $th->getCode(), "message" => $th->getMessage()]);
        }
    }
    public static function prepareSQL($sql, $arr, $substr = true){
        $result = [];
        foreach($arr as $key => $value){
            $sql .= "$key=?,";
            array_push($result, $value);
        }
        if($substr) $sql = substr($sql, 0, -1);
        return ["sql" => $sql, "array" => $result];
    }
}