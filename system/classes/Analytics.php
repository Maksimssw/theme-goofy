<?php
namespace Core;
require_once INC . "/BrowserDetection.php";

class Analytics{
    public static $user_id, $status, $ip, $userAgent, $ipInfo, $browserInfo;
    
    public static function add($user_id, $status){
        self::$user_id = $user_id;
        self::$status = $status;

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) self::$ip = $client;
        elseif (filter_var($forward, FILTER_VALIDATE_IP)) self::$ip = $forward;
        else self::$ip = $remote;

        self::$userAgent = $_SERVER['HTTP_USER_AGENT'];

        $browser = new Includes\BrowserDetection();
        self::$browserInfo = $browser->getAll(self::$userAgent);

        if ($_SERVER['SERVER_NAME'] != 'localhost' && self::$ip != '127.0.0.1') {
            self::ipAPI();
        }
        self::insertDB();
    }
    private static function ipAPI(){
        $ch = curl_init('http://ip-api.com/json/' . self::$ip. '?fields=148482');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        self::$ipInfo = json_decode($data, true);
    }
    private static function insertDB(){
        $sendData = [
            'user_id'       => self::$user_id,
            'ip'            => self::$ip,
            'user_agent'    => self::$userAgent,
            'referer'       => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
            'domain'        => $_SERVER['SERVER_NAME'],
            'country'       => isset(self::$ipInfo['countryCode']) ? self::$ipInfo['countryCode'] : null,
            'os'            => self::$browserInfo['os_name'],
            'browser'       => self::$browserInfo['browser_name'],
            'status'        => self::$status == 'safe' ? 0 : 1,
            'query'         =>isset($_SERVER['QUERY_STRING']) ? clearVal($_SERVER['QUERY_STRING'], "html") : null
        ];

        Database::updateData("INSERT INTO analytics (". implode(",", array_keys($sendData)) . ") VALUES ('". implode("','", array_values($sendData)) . "')", []);
    }
}