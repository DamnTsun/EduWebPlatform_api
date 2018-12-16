<?php

class Auth {

    // Constants for POST / $_SESSION variable names.
    private const GOOGLE_TOKEN_NAME = 'google_id_token';




    // *** TOKEN VALIDATION ***
    private static function validateIdToken_Google($id_token) {
        // Load in Google API.
        require_once $_ENV['dir_vendor'] . 'autoload.php';
        $client = new Google_Client([ 'client_id' => $_ENV['google_client_id'] ]);
        
        // Verify id_token. Will return JWT if successful. Null otherwise.
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            return $payload;
        } else {
            return null;
        }
    }



    // *** INIT SESSION ***
    /**
     * Initiates a new session. Checks and validates a google id_token. (given via POST)
     */
    public static function initSession_Google() {
        session_start();
        session_regenerate_id();

        // Check id_token given in POST body.
        if (!isset($_POST[Auth::GOOGLE_TOKEN_NAME])) {
            http_response_code(400); Auth::killSession(); return;
        }

        // Attempt to get payload from id_token.
        $payload = Auth::validateIdToken_Google($_POST[Auth::GOOGLE_TOKEN_NAME]);
        if (!isset($payload)) {
            http_response_code(400); Auth::killSession(); return;
        }

        // Create users controller instance for interacting with users / users_google records.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();

        // Check if users_google record exists for googleid.
        if (!$userController->checkGoogleUserExists($payload['sub'])) {
            // Create new user record. Note down id.
            $user_id = $userController->createUser();
            if (!isset($user_id)) {
                http_response_code(500); Auth::killSession(); return;
            }
            // Create new users_google record using user_id and google_id.
            $result = $userController->createGoogleUser($user_id, $payload['sub']);
            if (!isset($result)) {
                http_response_code(500); Auth::killSession(); return;
            }
        }

        // Get users_google record corresponding to googleid.
        $googleUser = $userController->getGoogleUser($payload['sub']);
        if (!isset($googleUser) || sizeof($googleUser) == 0) {
            http_response_code(400); Auth::killSession(); return;
        }

        // Get users record.
        $user = $userController->getUser($googleUser[0]['user_id']);
        if (!isset($user) || sizeof($user) == 0) {
            http_response_code(400); Auth::killSession(); return;
        }

        // Check not banned.
        if ($user[0]['banned']) {
            http_response_code(403); Auth::killSession(); return;
        }


        // Destroy previous session if exists.
        Auth::killSession();
        // Start session and return user record.
        session_start();
        $_SESSION[Auth::GOOGLE_TOKEN_NAME] = $_POST[Auth::GOOGLE_TOKEN_NAME];
        echo json_encode(Auth::formatUserRecord($user), JSON_HEX_QUOT | JSON_HEX_TAG);
        http_response_code(200);
        var_dump($_SESSION);
    }

    /**
     * Initiates a new session. Checks and validates a facebook id_token. (given via POST)
     */
    public static function initSession_Facebook() {
        throw new NotImplementedException();
    }

    /**
     * Initiates a new session. Checks and validates a linkedin id_token. (given via POST)
     */
    public static function initSession_LinkedIn() {
        throw new NotImplementedException();
    }





    /**
     * Validates users session based on id_token in session.
     * Checks it is in $_SESSION, valid, etc.
     * Checks if corresponding user is admin if specified.
     */
    public static function validateSession($checkAdmin) {
        Auth::getSession();
        if (!isset($_SESSION)) { return null; }
        $user = null;

        // Check id_token in $_SESSION corresponds to a supported social media account type.
        // Google
        if (isset($_SESSION[Auth::GOOGLE_TOKEN_NAME])) {
            $user = Auth::validateSession_Google($_SESSION[Auth::GOOGLE_TOKEN_NAME]);
        }
        // Facebook
        else if (false) {

        }
        // LinkedIn
        else if (false) {

        }


        // Check a record was retrieved.
        if (!isset($user)) {
            return null;
        }
        // Check not banned.
        if (!isset($user['banned']) || $user['banned'] == 1) {
            return null;
        }
        // Check admin if required.
        if ($checkAdmin) {
            if (!isset($user['admin']) || $user['admin'] == 0) {
                return null;
            }
        }

        return $user;
    }

    private static function validateSession_Google($id_token) {
        // Make sure actually in a session.
        if (!isset($_SESSION) || !isset($_SESSION[Auth::GOOGLE_TOKEN_NAME])) {
            return null;
        }

        // Attempt to get payload from id_token.
        $payload = Auth::validateIdToken_Google($_SESSION[Auth::GOOGLE_TOKEN_NAME]);
        if (!isset($payload)) {
            return null;
        }

        // Create users controller instance for interacting with users / users_google records.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();

        // Get users_google record corresponding to googleid.
        $googleUser = $userController->getGoogleUser($payload['sub']);
        if (!isset($googleUser) || sizeof($googleUser) == 0) {
            return null;
        }

        // Get users record.
        $user = $userController->getUser($googleUser[0]['user_id']);
        if (!isset($user) || sizeof($user) == 0) {
            return null;
        }

        // Return retreived record.
        return Auth::formatUserRecord($user);
    }

    private static function validateSession_Facebook() {
        throw new NotImplementedException();
    }

    private static function validateSession_LinkedIn() {
        throw new NotImplementedException();
    }





    /**
     * Formats user record for output.
     * @param records - user record to be formatted. (should be array containing 1 item)
     */
    private static function formatUserRecord($records) {
        if (!isset($records) || sizeof($records) == 0) { return null; }
        return array(
            'id' => (int)$records[0]['id'],
            'admin' => ($records[0]['admin'] == 1) ? true : false,
            'banned' => ($records[0]['banned'] == 1) ? true : false
        );
    }





    /**
     * Destroys the current session immediately.
     */
    public static function endSession() {
        // Start / resume the session. Kill the session.
        Auth::getSession();
        Auth::killSession();
    }

    /**
     * Starts / resumes a session. Exists for maintainability.
     */
    private static function getSession() {
        session_start();
        session_regenerate_id();
    }
    /**
     * Destroys session if it is set.
     */
    private static function killSession() {
        if (isset($_SESSION)) {
            session_destroy();
        }
    }
}