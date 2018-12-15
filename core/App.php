<?php

// urls
//  - /subject
//      GET - Gets all subjects.
//      POST [Requires id_token in POST body] - Creates new subject. (Requires admin)
//      DELETE [Requires id_token in POST body] - Deletes an existing subject. (Requires admin)

//  - /subject/<subjectName>/topic
//      GET - Gets all topics for a given subject.
//      POST [Requires id_token in POST body] - Creates a new topic for a given subject. (Requires admin)
//      DELETE [Requires id_token in POST body] - Deletes an existing topic for a given subject. (Requires admin)

//  - /subject/<subjectName>/topic/<topicName>/lesson
//      GET - Gets all lessons for a given topic for a given subject.
//      POST [Requires id_token in POST body] - Creates a new lesson for a given topic for a given subject. (Requires admin)
//      DELETE [Requires id_token in POST body] - Deletes an existing lesson for a given topic for a given subject. (Requires admin)

//  - /subject/<subjectName>/post
//      GET - Gets all posts for a given subject.
//      POST [Requires id_token, postTitle, postBody in POST body] - Creates a new post for a given subject. (Requires admin)

//  - /subject/<subjectName>/post/<postID>
//      DELETE [Requires id_token in POST body] - Delete an existing post for a given subject. (Requires admin)


//  - /user
//      POST [Requires id_token in POST body] - Gets user record corresponding to given id_token. Returns id, isAdmin, isBanned.
//          If no user account exists for id_token, a new account is created. Then does above.

//  - /user/get/all
//      POST [Requires id_token in POST body] - Gets all user records. Returns id, isAdmin, isBanned. (Requires admin)

//  - /user/get/admin
//      POST [Requires id_token in POST body] - Gets user records of admins. Returns id, isAdmin, isBanned. (Requires admin)

//  - /user/get/banned
//      POST [Requires id_token in POST body] - Gets user records of banned users. Returns id, isAdmin, isBanned. (Requires admin)

//  - /user/<userID>/ban?setTo[true | false]
//      POST [Requires id_token in POST body] - Gets user record for given userID. Sets isBanned to setTo. (Requires admin)

//  - /user/<userID>/admin?setTo[true | false]
//      POST [Requires id_token in POST body] - Gets user record for given userID. Sets isAdmin to setTo. (Requires admin)


class App {

    const ADD_KEYWORD = 'add';
    const DELETE_KEYWORD = 'delete';

    /*
    Param 1 is controller.
    Param 2 is value, such as subjectName / userID.
    Param 3 is method for controller.
    Only param 1 is required, though params 2 / 3 are necessary for most functionality.
    */
    private $router;
    protected $controller;
    protected $controllerValue;
    protected $method = 'index';
    protected $methodValue;
    protected $params = [];



    public function __construct() {
        // Create router instance.
        $this->router = new Router();
        
        // Parse url, getting rid of all the bad things...
        $urlFragments = $this->parseUrl();
        // Return BAD REQUEST if url is just base directory.
        if (!isset($urlFragments)) {
            http_response_code(400); return;
        }

        // Reconstruct url with slashes using sanitized fragments.
        $url = '';
        foreach ($urlFragments as $frag) {
            $url = $url . '/' . $frag;
        }
        
        // Attempt to match a route.
        $this->router->checkRoutes($url, $urlFragments);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) {
            // Replace spaces with '+' since FILTER_SANITIZE_URL would remove them.
            $url = str_replace(' ', '+', $_GET['url']);
            $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

            // Convert '+' back into spaces.
            for ($i = 0; $i < count($url); $i++) {
                $url[$i] = str_replace('+', ' ', $url[$i]);
            }
            return $url;
        }
    }





    /**
     * Gets GET parameter corresponding to given value. If GET parameter is not set, the given default value is returned.
     * @param $paramName - String index of GET parameter in $_GET array.
     * @param $defaultValue - Value to be returned if $_GET[$paramName] is not set.
     * @param $isInt - Whether retrieved value should be an integer.
     */
    public static function getGETParameter($paramName, $defaultValue, $isInt = false) {
        // If valid parameter name given, and it is set in $_GET, and the value is an integer
        if (isset($paramName) &&
            isset($_GET[$paramName])) {
                // If value should be an int, check it and return it if it is an int.
                if ($isInt) {
                    if (App::stringIsInt($_GET[$paramName])) {
                        return (int)$_GET[$paramName];
                    }
                // Otherwise just return value.
                } else {
                    return $_GET[$paramName];
                }
        }
        // Validation failed. Return default value.
        return $defaultValue;
    }


    // Utility functions.
    /**
     * Validates the given Google ID Token.
     */
    public static function validateGoogleIdToken($id_token) {
        // Load in Google API.
        require_once $_ENV['dir_vendor'] . 'autoload.php';

        $client = new Google_Client([ 'client_id' => $_ENV['google_client_id'] ]);

        // Verify id_token. Return JWT payload if successful, otherwise null.
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            return $payload;
        } else {
            return null;
        }
    }

    /**
     * Returns whether the given string is an integer.
     * Returns true is a int is given.
     * Returns false if non-string given.
     * Returns false if the given value is numeric but has decimal places.
     */
    public static function stringIsInt($string) {
        // Check if already an int.
        if (is_integer($string)) { return true; }
        // Check it is a string.
        if (!is_string($string)) { return false; }
        // Check it only contains numbers. (0 - 9)
        return preg_match('/^[0123456789]+$/', $string) == 1;
    }


    public static function initSession() {
        // Check is POST request.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); session_destroy(); return;
        }
        // Check id_token given in POST body.
        if (!isset($_POST['id_token'])) {
            http_response_code(400); session_destroy(); return;
        }

        // Attempt to get payload from id_token.
        $payload = App::validateGoogleIdToken($_POST['id_token']);
        if (!isset($payload)) {
            http_response_code(400); session_destroy(); return;
        }

        // Get user controller instance and attempt to get user using googleId.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();
        // Create new user if necessary.
        if (!$userController->checkUserExistsByGoogleId($payload['sub'])) {
            $userController->addUser($payload['sub'], $payload['given_name'], $payload['family_name'], $payload['email']);
        }
        // Get user record. Check not banned.
        $user = $userController->getUserByGoogleId($payload['sub']);
        if (sizeof($user) == 0) {
            http_response_code(400); return;
        }
        if ($user[0]['banned']) {
            http_response_code(403); session_destroy(); return;
        }

        // Start session.
        session_start();
        $_SESSION['id_token'] = $_POST['id_token'];
        http_response_code(200);
    }

    public static function validateSession() {
        session_start();
        session_regenerate_id();
        
        // Check already in session and that id_token is set.
        if (!isset($_SESSION) || !isset($_SESSION['id_token'])) {
            session_destroy();
            return null;
        }

        // Attempt to get payload from id_token.
        $payload = App::validateGoogleIdToken($_SESSION['id_token']);
        if (!isset($payload)) {
            session_destroy();
            return null;
        }

        // Get user controller instance and attempt to get user using googleId.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();
        $user = $userController->getUserByGoogleId($payload['sub']);
        if (!isset($user) || sizeof($user) == 0) {
            session_destroy();
            return null;
        }
        if ($user[0]['banned']) {
            http_response_code(403); return null;
        }
        return $user[0];
    }


    public static function getPutParameters() {
        // Return empty if not PUT request.
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') { return array(); }
        // Get PUT data and parse it into array.
        parse_str(file_get_contents('php://input'), $_PUT);
        foreach ($_PUT as $key => $value) {
            unset($_PUT[$key]);
            $_PUT[str_replace('amp;', '', $key)] = $value;
        }

        return $_PUT;
    }
}