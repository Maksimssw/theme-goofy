<?php
/**
 * Clear variables
 */
function clearVal($value, $type = "str"){
    if (!$value) return null;
    switch ($type) {
        case 'str':
            return trim(strip_tags($value));
        case 'int':
            return abs((int)$value);
        case 'html':
            return trim(htmlspecialchars($value));
    }
}

/**
 * Get system options by key
 */
function getOptions($key){
    return $GLOBALS['options'][$key] ? $GLOBALS['options'][$key] : null;
}

/**
 * Trackers
 */
function getTrackers(){
    foreach ($_GET as $key => $value) {
        if (in_array($key, explode(",", getOptions('trackers'))) && file_exists(SYSTEM . "/trackers/$key.php")) {
            require_once SYSTEM . "/trackers/$key.php";
        }
    }
}
/**
 * Get System Template
 */
function getTemplate($name, $type = 'tml'){
    $file = TEMPLATES . "/$name.$type.php";
    if(file_exists($file)){
        require_once $file;
    }else{
        echo sprintf("<p>Template connection error. There doesn't seem to be a %s file.</p>", "<code>$name.$type.php</code>");
        http_response_code(500);
        die();
    }
}

/**
 * Template functions
 */
function get_template_dir($type = 'html'){
    switch ($type) {
        case 'html':
            return $GLOBALS['SITE_URL'] . 'content/themes/' . $GLOBALS['active_template'];
            break;
        case 'php':
            return THEMES . '/' . $GLOBALS['active_template'] . '/';
            break;
    }
}

function get_template_parts($file_name, $folder = "template-parts/"){
    if ($file_name) {
        $file_path = THEMES . '/' . $GLOBALS['active_template'] . '/' . $folder . $file_name . '.php';
        if (file_exists($file_path)) {
            include_once $file_path;
        } else {
            echo sprintf("<p>%s .There doesn't seem to be the <code>%s.php</code> file.</p>", $file_path, $file_name);
        }
    }
}

function jQuery($version = "3.6.0"){
    print('<script src="' . $GLOBALS['SITE_URL'] . 'storage/templates/js/jquery-3.6.0.min.js?ver=' . $version . '"></script>' . "\n");
}

function translateModule($translate = "en", $current = "en"){
    $GLOBALS['template_lang'] = [$translate, $current];
    getTemplate('translate','prt');
}

/**
 * Save logs
 */
function update_logs(){
    // User IP
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;
    // Log string
    $log = date('Y-m-d H:i:s') . " \"" . $_SERVER['REQUEST_URI'] ."\" $ip" . " - " . $_SERVER['HTTP_USER_AGENT'] . " [" . http_response_code() ."]";
    // Check Folder
    if (!is_dir(STORAGE . '/logs'))
        mkdir(STORAGE . '/logs');
    // Save Log
    file_put_contents(STORAGE . '/logs/' . date("Y-m-d") .".log", $log . PHP_EOL, FILE_APPEND);
}