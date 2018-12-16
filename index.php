<?php

// REMOVE BEFORE PUBLISHING PRODUCTION.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Set php.ini attributes to improve session security.
ini_set('session.use_strict_mode', 1);      // Use strict mode.
ini_set('session.use_only_cookies', 1);     // Prevents user leaking their sessionid via the url.
ini_set('session.use_trans_sid', 0);        // Prevents sessionid appearing in places such as a Referer header.
ini_set('session.cookie_httponly', 1);      // Prevents clientside JavaScript from accessing the session cookie.
ini_set('session.cookie_secure', 0);        // HTTPS only. (should be 0 when using localhost)

// Setup base stuff.
header("Access-Control-Allow-Origin: *");

require_once 'core/reference.php';
require_once 'core/Auth.php';
require_once 'core/Router.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

require_once 'core/App.php';


// Get any PUT / DELETE parameters. Store them in $_PUT / $_DELETE.

$_PUT = array();
$_DELETE = array();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);
        foreach ($_PUT as $key => $value) {
            unset($_PUT[$key]);
            $_PUT[str_replace('amp;', '', $key)] = $value;
        }
        break;
    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);
        foreach ($_DELETE as $key => $value) {
            unset($_DELETE[$key]);
            $_DELETE[str_replace('amp;', '', $key)] = $value;
        }
        break;
}
$_REQUEST = array_merge($_REQUEST, $_PUT);
$_REQUEST = array_merge($_REQUEST, $_DELETE);

new App();