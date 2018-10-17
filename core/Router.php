<?php

class Router {

    public function __construct() {
        $this->routes = array(
            // GET routes
            'GET' => array(
                // Subjects
                '/subjects' => array(
                    'regex' => '/^\/subjects\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Subjects.php';
                        $controller = new Subjects();
                        $controller->getAllSubjects();
                    }
                ),
                '/subjects/:id' => array(
                    'regex' => '/^\/subjects\/\d+\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Subjects.php';
                        $controller = new Subjects();
                        $controller->getSubjectByID($params[1]);
                    }
                ),

                // Topics
                '/subjects/:id/topics' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Topics.php';
                        $controller = new Topics();
                        $controller->getAllTopicsBySubject($params[1]);
                    }
                ),
                '/subjects/:id/topics/:id' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/\d+\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Topics.php';
                        $controller = new Topics();
                        $controller->getTopicByID($params[3]);
                    }
                ),

                // Lessons
                '/subjects/:id/topics/:id/lessons' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/\d+\/lessons\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Lessons.php';
                        $controller = new Lessons();
                        $controller->getAllLessonsByTopic($params[3]);
                    }
                ),
                '/subjects/:id/topics/:id/lessons/:id' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/\d+\/lessons\/\d+\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Lessons.php';
                        $controller = new Lessons();
                        $controller->getLessonByID($params[5]);
                    }
                )
            ),


            // POST routes (Requires valid id_token in POST body. Some methods are admin only)
            'POST' => array(
                // NOTE: 'user record' only returns 'id', 'isAdmin', and 'isBanned' fields of user records.
                // Get all user records. (ADMIN)
                '/users' => array(
                    'regex' => '',
                    'method' => function($params) {

                    }
                )
            )
        );
    }


    public function checkRoutes($url = '', $params = []) {
        // Check if accepted request method.
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
            case 'POST':
                // Check against predefined routes for given request method.
                foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                    if (preg_match($route['regex'] . 'i', $url)) {
                        $route['method']($params);
                        return;
                    }
                }
                break;
            // Method not supported.
            default:
                http_response_code(405); return;
        }

        // Nothing matched. Return 404.
        http_response_code(404);
    }
}