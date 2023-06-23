<?php
/**
 * @package GeekPress
 * @version 1.1.0
 * @link https://github.com/2NGeeks/GeekPress
 */

//Absolute path
if (!defined('ABSPATH')) {
    define('ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/');
}

// Check config file
if (file_exists(ABSPATH . 'config.php')) {
    require ABSPATH . 'config.php';
} else {
    echo sprintf("<p>There doesn't seem to be a %s file. I need this before we can get started.</p>", '<code>config.php</code>');
    http_response_code(500);
}