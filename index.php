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