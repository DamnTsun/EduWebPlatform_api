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
    /*
    Param 1 is controller.
    Param 2 is value, such as subjectName / userID.
    Param 3 is method for controller.
    Only param 1 is required, though params 2 / 3 are necessary for most functionality.
    */
    protected $controller;
    protected $method = 'index';
    protected $params = [];



    public function __construct() {
        $url = $this->parseUrl();

        // CONTROLLER.
        // Check parameter given a the controller exists.
        if (!isset($url[0]) || !is_file($_ENV['dir_controllers'] . $url[0] . '.php')) {
            http_response_code(400);
            return;
        }
        require_once $_ENV['dir_controllers'] . $url[0] . '.php';
        $this->controller = new $url[0];
        unset($url[0]);

        // METHOD
        // Check for method parameter.
        if (isset($url[2])) {
            // Check method exists. (Param may just be a value)
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
            }
        }


        //PARAMETERS
        // Get parameters if specified, else empty array.
        $this->params = $url ? array_values($url) : [];

        // Call specified method on specified controller.
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) {
            // Replace spaces with '+' since FILTER_SANITIZE_URL would remove them.
            $url = str_replace(' ', '+', $_GET['url']);
            $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

            // Capitalize first letter of first param (controller). Due to case sensitive file systems.
            if (sizeof($url) > 0) { $url[0] = ucfirst($url[0]); }
            // Convert '+' into spaces.
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
        require_once 'vendor/autoload.php';

        $client = new Google_Client(['client_id' => $_ENV['google_client_id']]);
        try {
            $payload = $client->verifyIdToken($id_token);
        } catch (UnexpectedValueException $e) {
            return null;
        }

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
        if (is_integer($string)) { echo 'was int'; return true; }
        // Check it is a string.
        if (!is_string($string)) { return false; }
        // Check it only contains numbers. (0 - 9)
        return preg_match('/^[0123456789]+$/', $string) == 1;
    }
}