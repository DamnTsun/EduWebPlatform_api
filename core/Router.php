<?php

class Router {

    public function __construct() {
        $this->setupRoutes();
    }


    
    /**
     * Sets up routes for the router.
     */
    private function setupRoutes() {
        // Setup array.
        $this->routes = array(
            'GET' => array(),
            'POST' => array(),
            'PUT' => array(),
            'DELETE' => array()
        );

        // Call setup method corresponding to the request method in use.
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->setupGETRoutes();
                break;
            case 'POST':
                $this->setupPOSTRoutes();
                break;
            case 'PUT':
                $this->setupPUTRoutes();
                break;
            case 'DELETE':
                $this->setupDELETERoutes();
                break;
            default:
                http_response_code(405); exit();
        }
    }





    /**
     * Sets up routes for GET requests.
     */
    private function setupGETRoutes() {
        // ****************
        // *** SUBJECTS ***
        // ****************
        // GET all subjects.
        $this->addGETRoute('/^\/subjects\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
            $controller = new Subjects();
            $controller->getAllSubjects();
        });
        // GET 1 subject by id.
        $this->addGETRoute('/^\/subjects\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
            $controller = new Subjects();
            $controller->getSubjectByID($params[1]); // subjectid
        });

        // **************
        // *** TOPICS ***
        // **************
        // GET all topics.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
            $topicsController = new Topics();
            $topicsController->getAllTopicsBySubject($params[1]); // subjectid
        });
        // GET 1 topic by id.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
            $topicsController = new Topics();
            $topicsController->getTopicByID($params[1], $params[3]); // subjectid, topicid
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // GET all lessons.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/\d+\/lessons\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['lessons'];
            $controller = new Lessons();
            $controller->getAllLessonsByTopic($params[1], $params[3]); // subjectid, topicid
        });
        // GET 1 lesson by id.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/\d+\/lessons\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['lessons'];
            $controller = new Lessons();
            $controller->getLessonByID($params[1], $params[3], $params[5]); // subjectid, topicid, lessonid
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // GET all tests.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/\d+\/tests\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['tests'];
            $controller = new Tests();
            $controller->getAllTestsByTopic($params[1], $params[3]); // subjectid, topicid
        });
        // GET 1 test by id.
        $this->addGETRoute('/^\/subjects\/\d+\/topics\/\d+\/tests\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['tests'];
            $controller = new Tests();
            $controller->getTestByID($params[1], $params[3], $params[5]); // subjectid, topicid, lessonid
        });
    }





    /**
     * Sets up routes for POST requests.
     */
    private function setupPOSTRoutes() {
        // ****************
        // *** SUBJECTS ***
        // ****************
        // CREATE new subject.
        $this->addPOSTRoute('/^\/subjects\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
            $controller = new Subjects();
            $controller->createSubject();
        });

        // **************
        // *** TOPICS ***
        // **************
        // CREATE new topic.
        $this->addPOSTRoute('/^\/subjects\/\d+\/topics\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
            $controller = new Topics();
            $controller->createTopic($params[1]); // subject id
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // CREATE new lesson.
        $this->addPOSTRoute('/^\/subjects\/\d+\/topics\/\d+\/lessons\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['lessons'];
            $controller = new Lessons();
            $controller->createLesson($params[1], $params[3]); // subjectid, topicid
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // CREATE new test.
        $this->addPOSTRoute('/^\/subjects\/\d+\/topics\/\d+\/tests\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['tests'];
            $controller = new Tests();
            $controller->createTest($params[1], $params[3]); // subjectid, topicid
        });

        // *************
        // *** USERS ***
        // *************
        // Authenticate with server (Google)
        $this->addPOSTRoute('/^\/users\/auth\/google\/?$/', function($params) {
            Auth::initSession_Google();
        });
        // Authenticate with server (Facebook) - NOT IMPLEMENTED
        // Authenticate with server (LinkedIn) - NOT IMPLEMENTED

        // Check authentification status with server (Google)
        $this->addPOSTRoute('/^\/users\/auth\/google\/validate\/?$/', function($params) {
            // Check admin if 'checkAdmin' included in GET parameters.
            $checkAdmin = (isset($_GET['checkAdmin']));
            $user = Auth::validateSession($checkAdmin);
            // If user is null (invalid token, user doesn't exist, user banned, user not admin, etc), return 403 - Unauthorized.
            if (!isset($user)) { http_response_code(401); return; }
            echo json_encode($user, JSON_HEX_QUOT | JSON_HEX_TAG);
        });
        // Check authentification status with server (Facebook) - NOT IMPLEMENTED
        // Check authentification status with server (LinkedIn) - NOT IMPLEMENTED

        // End session immediately.
        $this->addPOSTRoute('/^\/users\/auth\/kill\/?$/', function($params) {
            Auth::endSession();
        });


        $this->addPOSTRoute('/^\/jwttest\/?$/' , function($params) {
            Auth::JWTtest();
        });
    }





    /**
     * Sets up routes for PUT requests.
     */
    private function setupPUTRoutes() {
        // ****************
        // *** SUBJECTS ***
        // ****************

        // **************
        // *** TOPICS ***
        // **************

        // ***************
        // *** LESSONS ***
        // ***************
    }





    /**
     * Sets up routes for DELETE requests.
     */
    private function setupDELETERoutes() {
        // ****************
        // *** SUBJECTS ***
        // ****************
        // DELETE subject
        $this->addDELETERoute('/^\/subjects\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
            $controller = new Subjects();
            $controller->deleteSubject($params[1]); // subjectid
        });

        // **************
        // *** TOPICS ***
        // **************
        // DELETE topic.
        $this->addDELETERoute('/^\/subjects\/\d+\/topics\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
            $controller = new Topics();
            $controller->deleteTopic($params[1], $params[3]); // subjectid, topicid
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // DELETE lesson.
        $this->addDELETERoute('/^\/subjects\/\d+\/topics\/\d+\/lessons\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['lessons'];
            $controller = new Lessons();
            $controller->deleteLesson($params[1], $params[3], $params[5]); // subjectid, topicid, lessonid.
        });

        // ***************
        // *** LESSONS ***
        // ***************
        // DELETE test.
        $this->addDELETERoute('/^\/subjects\/\d+\/topics\/\d+\/tests\/\d+\/?$/', function($params) {
            require_once $_ENV['dir_controllers'] . $_ENV['controllers']['tests'];
            $controller = new Tests();
            $controller->deleteTest($params[1], $params[3], $params[5]); // subjectid, topicid, lessonid.
        });
    }










    /**
     * Checks each route, attempting to match the given url.
     * @param $url - URL to be matched.
     * @param $params - URL parameters being passed.
     */
    public function checkRoutes($url = '', $params = []) {
        // Check if accepted request method.
        if ($this->isRequestMethodSupported($_SERVER['REQUEST_METHOD'])) {

            // Check against predefined routes for given request method.
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if (preg_match($route->getRegex() . 'i', $url)) {
                    $route->getMethod()($params);
                    return;
                }
            }

        } else {
            // Method not supported.
            http_response_code(405); return;
        }

        // Nothing matched. Return 404.
        http_response_code(404);
    }

    /**
     * Determines whether the given string is among the HTTP methods supported by this api.
     */
    private function isRequestMethodSupported($route) {
        switch ($route) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'DELETE':
                return true;
            default:
                return false;
        }
    }





    /**
     * Adds the given route to the routes list for the specified HTTP method. (GET / POST / PUT / DELETE)
     */
    private function addRoute($requestMethod, $route) {
        if (!$this->isRequestMethodSupported($requestMethod)) {
            echo 'Attempted to add route for unsupported request method. Please correct.';
            return;
        }

        // Push route into area of routes list for the specified HTTP request method.
        array_push(
            $this->routes[$requestMethod],
            $route
        );
    }



    /**
     * Adds a GET route to the router.
     * @param $regex - Regular expression for use when matching route.
     * @param $method - Method to be ran when route is matched.
     */
    private function addGETRoute($regex, $method) {
        $this->addRoute('GET', new Route($regex, $method));
    }
    /**
     * Adds a POST route to the router.
     * @param $regex - Regular expression for use when matching route.
     * @param $method - Method to be ran when route is matched.
     */
    private function addPOSTRoute($regex, $method) {
        $this->addRoute('POST', new Route($regex, $method));
    }
    /**
     * Adds a PUT route to the router.
     * @param $regex - Regular expression for use when matching route.
     * @param $method - Method to be ran when route is matched.
     */
    private function addPUTRoute($regex, $method) {
        $this->addRoute('PUT', new Route($regex, $method));
    }
    /**
     * Adds a DELETE route to the router.
     * @param $regex - Regular expression for use when matching route.
     * @param $method - Method to be ran when route is matched.
     */
    private function addDELETERoute($regex, $method) {
        $this->addRoute('DELETE', new Route($regex, $method));
    }

}










/**
 * Class for holding route.
 */
class Route {

    private $regex;             // Regular expression for route.
    private $method;            // Method ran when route is matched.
    
    public function __construct($regex, $method) {
        $this->regex = $regex;
        $this->method = $method;
    }

    public function getRegex() { return $this->regex; }
    public function getMethod() { return $this->method; }
}