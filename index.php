<?php

// REMOVE BEFORE PUBLISHING PRODUCTION.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

header("Access-Control-Allow-Origin: http://localhost:4200");

require_once 'core/reference.php';
require_once 'core/Router.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

require_once 'core/App.php';
new App();