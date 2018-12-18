<?php

class Auth {

    // Constants
    private const GOOGLE_TOKEN_NAME = 'google_id_token';

    private const JWT_ISSUER = 'EduWebPlatform backend';
    private const JWT_AUDIENCE = 'EduWebPlatform frontend';





    // *** TOKEN VALIDATION ***
    /**
     * Validates given google id_token.
     * @param id_token - id_token to be validated.
     */
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

    /**
     * Validates given facebook id_token.
     * @param id_token - id_token to be validated.
     */
    private static function validateIdToken_Facebook($id_token) {
        throw new NotImplementedException();
    }

    /**
     * Validates given linkedin id_token.
     * @param id_token - id_token to be validated.
     */
    private static function validateIdToken_LinkedIn($id_token) {
        throw new NotImplementedException();
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


        // Everything passes. Create and return JWT to user. (Returned as JSON object containing: JWT, expiry)
        Auth::createJWT($user[0]['id'], ($user[0]['admin'] == 1) ? true : false);
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
     * @param checkAdmin - Whether the return user must be an admin.
     */
    public static function validateSession($checkAdmin) {
        // Check id token sent as request header.
        if (!isset($_SERVER['HTTP_IDTOKEN'])) { return null; }
        
        // Attempt to get user id based off idToken. (will valid token in the process)
        $userid = Auth::validateJWT($_SERVER['HTTP_IDTOKEN']);
        if (!isset($userid)) { return null; }

        // Attempt to get user record with retrieved id.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $usersController = new Users();
        $userRecord = $usersController->getUser($userid);
        if (!isset($userRecord) || sizeof($userRecord) == 0) { return null; }
        // Check admin if necessary.
        if ($checkAdmin) {
            if (!($userRecord[0]['admin'] == 1)) {
                return null;
            }
        }

        return Auth::formatUserRecord($userRecord);
    }





    // ***** JWT functions (create, validate, etc) *****
    /**
     * Creates a JWT for the given user_id and admin status. JWT is encoded with Sha256 using secret Hmac key.
     * @param user_id - id of user.
     * @param admin - admin status of user.
     */
    public static function createJWT($user_id, $admin) {
        require_once $_ENV['dir_vendor'] . 'autoload.php';

        // Create token with sha256 encryption. (1 shared key) and return it.
        try {
            $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
            $jwt = (new Lcobucci\JWT\Builder())->setIssuer(Auth::JWT_ISSUER)                // Issuer:      Application backend.
                                                ->setAudience(Auth::JWT_AUDIENCE)           // Audience:    Application frontend.
                                                ->setIssuedAt(time())                       // Issued at:   Now.
                                                ->setExpiration(time() + 3600)              // Expires in:  1 hour.
                                                ->set('user_id', (int)$user_id)             // Store user_id as claim.
                                                ->set('admin', $admin)                      // Store admin status as claim.
                                                ->sign($signer, $_ENV['JWT_Hmac_key'])      // Sign using Sha256.
                                                ->getToken();
        } catch (Exception $e) {
            http_response_code(500); return;
        }

        // Return jwt and expiry as json.
        echo json_encode(
            array(
                'idToken' => (string)$jwt,
                'expiresAt' => $jwt->getClaim('exp')
            ),
            JSON_HEX_QUOT | JSON_HEX_TAG
        );
        http_response_code(200);
    }


    /**
     * Validates the given jwt. Makes sure it is valid, not been tampered with, has not expired. Also checks admin if specified.
     * @param jwt - JSON Web Token to be validated.
     * @param admin - Whether the corresponding user must be an admin.
     */
    public static function validateJWT($jwt) {
        require_once $_ENV['dir_vendor'] . 'autoload.php';

        // Attempt to parse jwt.
        try {
            $parsed = (new Lcobucci\JWT\Parser())->parse((string)$jwt);
        } catch (Exception $e) {
            return null;
        }

        // Verify token has not been modified.
        $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
        if (!$parsed->verify($signer, $_ENV['JWT_Hmac_key'])) { return null; }

        // Check issuer / audience / expiry (automatic)
        $data = new Lcobucci\JWT\ValidationData();
        $data->setIssuer(Auth::JWT_ISSUER);
        $data->setAudience(Auth::JWT_AUDIENCE);
        if (!$parsed->validate($data)) { return null; }

        // Return user id.
        return $parsed->getClaim('user_id');
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







    public static function JWTtest() {
        require_once $_ENV['dir_vendor'] . 'autoload.php';

        // Create token with sha256 encryption. (1 shared key)
        $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
        $token = (new Lcobucci\JWT\Builder())->setIssuer(Auth::JWT_ISSUER)              // Issuer:      Application backend.
                                            ->setAudience(Auth::JWT_AUDIENCE)           // Audience:    Application frontend.
                                            ->setIssuedAt(time())                       // Issued at:   Now.
                                            ->setExpiration(time() + 3600)              // Expires in:  1 hour.
                                            ->set('user_id', 1)                         // Store user_id as claim.
                                            ->set('admin', false)                       // Store admin status as claim.
                                            ->sign($signer, $_ENV['JWT_Hmac_key'])      // Sign using Sha256.
                                            ->getToken();

        //echo 'Token:<br/>' . $token . '<br/><br/>';

        //echo 'Verifying with wrong key: ';
        //echo ($token->verify($signer, 'aaa2')) ? 'Valid' : 'Invalid' . '<br/>';
        //echo 'Verifying with correct key: ';
        //echo ($token->verify($signer, $_ENV{'JWT_Hmac_key'})) ? 'Valid' : 'Invalid' . '<br/>';
        //var_dump($token->getClaims());

        // Attempt to parse jwt.
        $parsed = (new Lcobucci\JWT\Parser())->parse((string)$token);
        //echo 'Parsed token is valid? ';
        //echo ($parsed->verify($signer, $_ENV['JWT_Hmac_key'])) ? 'Valid' : 'Invalid';

        // JSON response to send to client.
        $response = array(
            'idToken' => (string)$token,
            'expiresAt' => $token->getClaim('exp')
        );
        echo json_encode($response);
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