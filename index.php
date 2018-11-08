<?php

// REMOVE BEFORE PUBLISHING PRODUCTION.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


// Setup base stuff.
header("Access-Control-Allow-Origin: *");

require_once 'core/reference.php';
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