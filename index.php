<?php
header("Access-Control-Allow-Origin: http://localhost:4200");

require_once 'core/reference.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

require_once 'core/App.php';
new App();