<?php

$_ENV = array();

// Database connection information.
$_ENV['db_host'] = 'localhost';
$_ENV['db_name'] = 'EduWebApp';
$_ENV['db_user'] = 'mea';
$_ENV['db_pass'] = 'mea';

// Directory paths.
$_ENV['dir_base'] = 'http://localhost/EduWebPlatform_api/';
$_ENV['dir_core'] = 'core/';
$_ENV['dir_controllers'] = 'controllers/';
$_ENV['dir_subcontrollers'] = 'controllers/subcontrollers/';
$_ENV['dir_models'] = 'models/';
$_ENV['dir_vendor'] = 'vendor/';

// Controller filenames.
$_ENV['controllers'] = array(
    'subjects' => 'Subjects.php',
    'topics' => 'Topics.php',
    'lessons' => 'Lessons.php',
    'tests' => 'Tests.php',
    'test_questions' => 'TestQuestions.php',
    'posts' => 'Posts.php',

    'user_tests' => 'User_Tests.php',
    'user_test_questions' => 'User_TestQuestions.php',
    'users' => 'Users.php',
    'messages' => 'Messages.php',
    'groups' => 'Groups.php',
    'subject_admins' => 'SubjectAdmins.php'
);

// Model filenames.
$_ENV['models'] = array(
    'subjects' => 'model.subject.php',
    'topics' => 'model.topic.php',
    'lessons' => 'model.lesson.php',
    'tests' => 'model.test.php',
    'test_questions' => 'model.test_question.php',
    'posts' => 'model.post.php',

    'user_tests' => 'model.user_test.php',
    'user_test_questions' => 'model.user_test_question.php',
    'users' => 'model.user.php',
    'messages' => 'model.message.php',
    'groups' => 'model.group.php',
    'subject_admins' => 'model.subject_admin.php'
);


// JWT Hmac key for Sha256 hashing.
$_ENV['JWT_Hmac_key'] = '';
// Google OAuth API information.
$_ENV['google_client_id'] = '';
$_ENV['google_client_secret'] = '';
// Facebook OAuth API informatino.
$_ENV['facebook_client_id'] = '';
$_ENV['facebook_client_secret'] = '';

// Other stuff.
$_ENV['beautifyJSON'] = false; // Whether to put JSON in pre tag to make it readable.