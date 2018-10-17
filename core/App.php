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



    // Utility functions.
    /**
     * Validates the given Google ID Token.
     */
    public static function validateGoogleIdToken($id_token) {
        // Load in Google API.
        require_once $_ENV['vendor'] . 'autoload.php';

        $client = new Google_Client([ 'client_id' => $_ENV['google_client_id'] ]);

        // Verify id_token. Return JWT payload if successful, otherwise null.
        $payload = null;
        try {
            $payload = $client->verifyIdToken($id_token);
        } catch (UnexpectedValueException $e) {
            $payload = null;
        }
        return $payload;
    }

    /**
     * Returns whether the given string is an integer.
     * Returns true is a int is given.
     * Returns false if non-string given.
     * Returns false if the given value is numeric but has decimal places.
     */
    public static function stringIsInt($string) {
        // Check if already an int.
        if (is_integer($string)) { echo 'was int'; return true; }
        // Check it is a string.
        if (!is_string($string)) { return false; }
        // Check it only contains numbers. (0 - 9)
        return preg_match('/^[0123456789]+$/', $string) == 1;
    }

    public static function validateSession($requiresAdmin) {
        session_start();
        session_regenerate_id();
        
        // Attempt to get id_token from session.
        $id_token = null;
        if (!isset($_SESSION['id_token'])) {
            // If id_token not in session, attempt to get it from POST body.
            if (!isset($_POST['id_token'])) {
                http_response_code(401); exit();
            }
            $id_token = $_POST['id_token'];
        } else {
            $id_token = $_SESSION['id_token'];
        }

        // Attempt to get payload from id_token.
        $payload = App::validateGoogleIdToken($id_token);
        // Check successful.
        if ($payload == null) {
            http_response_code(400); exit();
        }
        
        // Get users controller instance.
        require_once $_ENV['dir_controllers'] . 'Users.php';
        $userController = new Users();
        
        if (!$userController->checkUserExistsByGoogleId($payload['sub'])) {
            
        }
    }
}