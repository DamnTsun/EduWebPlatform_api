<?php

class Router {

    public function __construct() {
        $this->routes = array(
            // For getting data from the database. Some routets require prior authentication.
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
                ),



                '/test' => array(
                    'regex' => '/^\/test\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Subjects.php';
                        $controller = new Subjects();
                        $bool = $controller->checkSubjectExists(1);
                        echo 'Found it? ';
                        var_dump($bool);
                        $controller->getSubjectByID(1);
                    }
                )
            ),


            // For authenticating and for adding new resources.
            'POST' => array(
                // Authenticate with the server to use user methods (and if appropriate, admin methods)
                '/users/auth' => array(
                    'regex' => '/^\/users\/auth\/?$/',
                    'method' => function($params) {
                        App::initSession();
                    }
                ),

                // Create a new subject
                '/subjects' => array(
                    'regex' => '/^\/subjects\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Subjects.php';
                        $controller = new Subjects();
                        $controller->createSubject();
                    }
                ),

                // Create a new topic
                '/subjects/:id/topics' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Topics.php';
                        $controller = new Topics();
                        $controller->createTopic($params[1]);
                    }
                )
            ),

            
            // For updating values of an existing resource.
            'PUT' => array(
                
            ),


            // For deleting an existing resource.
            'DELETE' => array(
                // Delete subject record with given id.
                '/subjects/:id' => array(
                    'regex' => '/^\/subjects\/\d+\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Subjects.php';
                        $controller = new Subjects();
                        $controller->deleteSubject($params[1]);
                    }
                ),

                // Delete topic record with given id.
                '/subjects/:id/topics/:id' => array(
                    'regex' => '/^\/subjects\/\d+\/topics\/\d+\/?$/',
                    'method' => function($params) {
                        require_once $_ENV['dir_controllers'] . 'Topics.php';
                        $controller = new Topics();
                        $controller->deleteTopic($params[3]);
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
            case 'PUT':
            case 'DELETE':
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