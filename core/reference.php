<?php

$_ENV = array();

// Database connection information.
$_ENV['db_host'] = 'localhost';
$_ENV['db_name'] = 'math_edu_app';
$_ENV['db_user'] = 'mea';
$_ENV['db_pass'] = 'mea';

// Directory paths.
$_ENV['dir_base'] = 'http://localhost/matheduapp-prototype_api/';
$_ENV['dir_core'] = 'core/';
$_ENV['dir_controllers'] = 'controllers/';
$_ENV['dir_subcontrollers'] = 'controllers/subcontrollers/';
$_ENV['dir_models'] = 'models/';
$_ENV['dir_vendor'] = 'vendor/';

// Google OAuth API information.
$_ENV['google_client_id'] = '140771721886-3ht78s72map4d75dd0iletdh6b5lkmsr.apps.googleusercontent.com';
$_ENV['google_client_secret'] = '2zUMuYz4FIrr1Ikq2oa5dqHP';

// Other stuff.
$_ENV['beautifyJSON'] = false; // Whether to put JSON in pre tag to make it readable.