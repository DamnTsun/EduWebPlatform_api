<?php

// REMOVE BEFORE PUBLISHING PRODUCTION.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


// Set headers.
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: idToken");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
// Handle OPTIONS request for CORS preflight request. (Browser don't like it if not explicitly stated...)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: idToken");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
    exit();
}

// Require in base files.
require_once 'core/reference.php';
require_once 'core/Auth.php';
require_once 'core/Router.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

require_once 'core/App.php';


// Start app.
new App();