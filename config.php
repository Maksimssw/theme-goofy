<?php
/**
 * Constants
 */
define('SYSTEM', ABSPATH . 'system');
define('INC', SYSTEM . '/includes');
define('CLASSES',  SYSTEM . '/classes');

define('STORAGE', ABSPATH . 'storage');
define('TEMPLATES', STORAGE . '/templates');

define('CONTENT', ABSPATH . 'content');
define('THEMES',  CONTENT . '/themes');

/**
 * Global variables
 */
global $SITE_URL, $options, $TEST_MODE;

// Get Site URL

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '0.0.0.0') {
    $SITE_URL = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
} else {
    $SITE_URL = 'https://' .  $_SERVER['SERVER_NAME'] . '/';
}

/**
 * Enable/disable Test Mode
 * if "true", config will be taken from system.json and API will stop working.
 */
$TEST_MODE = false;

/**
 * Init System Load
 */
require SYSTEM . '/init.php';
