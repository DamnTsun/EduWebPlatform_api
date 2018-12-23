<?php

class Auth {

    // Constants
    private const GOOGLE_TOKEN_NAME = 'google_id_token';

    private const JWT_ISSUER = 'EduWebPlatform backend';
    private const JWT_AUDIENCE = 'EduWebPlatform frontend';

    // Specific database values for maintainability.
    // Stores value of privilege levels. (the exact casesensitive values of records)
    private const PRIVILEGE_LEVELS = array(
        'normal' => 'Normal',
        'admin' => 'Admin',
        'banned' => 'Banned'
    );





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
        // Check id_token given in POST body.
        if (!isset($_POST[Auth::GOOGLE_TOKEN_NAME])) {
            http_response_code(400); return '`google_id_token` not given in POST body.';
        }

        // Attempt to get payload from id_token.
        $payload = Auth::validateIdToken_Google($_POST[Auth::GOOGLE_TOKEN_NAME]);
        if (!isset($payload)) {
            http_response_code(400); return '`google_id_token` is not valid.';
        }

        // Create users controller instance for interacting with users / users_google records.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();


        // $payload['sub'] is the subject - aka the user's google id.
        // Check is user exists where socialMediaID = $payload['sub'] and social media type of Google.
        if (!$userController->checkUserExistsBySocialMediaID($payload['sub'], 'google')) {
            // Attempt to create user account for user, using google, with normal privilege level.
            $result = $userController->createUser($payload['sub'], 'google', 'normal');
            if (!isset($result)) {
                http_response_code(500); return 'Something went wrong. Unable to create new internal user record.';
            }
        }

        // Get user record using socialMediaID ($payload['sub']) and socialMediaProvider name (google).
        $user = $userController->getUserBySocialMediaID($payload['sub'], 'google');
        if (!isset($user) || sizeof($user) == 0) {
            http_response_code(500); return 'Something went wrong. Your user record exists, but could not be retrieved.';
        }

        // Check user not banned.
        if ($user[0]['level'] == Auth::PRIVILEGE_LEVELS['banned']) {
            http_response_code(401); return 'You are banned.';
        }


        // Create and return JWT to user.
        Auth::createJWT($user[0]['id']);
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
     * Returns user record if validation passed, null otherwise.
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
        $userRecord = $usersController->getUserByID($userid);
        if (!isset($userRecord) || sizeof($userRecord) == 0) { return null; }
        
        // Check user privilege level.
        switch ($userRecord[0]['level']) {
            // Exclude admin from default case.
            case Auth::PRIVILEGE_LEVELS['admin']:
                break;
            // Check if user banned.
            case Auth::PRIVILEGE_LEVELS['banned']:
                return null;

            // Any other privilege level.
            default:
                // Check admin is required.
                if ($checkAdmin) { return null; }
                break;
        }

        return Auth::formatUserRecord($userRecord);
    }





    // ***** JWT functions (create, validate, etc) *****
    /**
     * Creates a JWT for the given user_id. JWT is encoded with Sha256 using secret Hmac key.
     * @param user_id - id of user.
     */
    public static function createJWT($user_id) {
        require_once $_ENV['dir_vendor'] . 'autoload.php';

        // Create token with sha256 encryption. (1 shared key) and return it.
        try {
            $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
            $jwt = (new Lcobucci\JWT\Builder())->setIssuer(Auth::JWT_ISSUER)                // Issuer:      Application backend.
                                                ->setAudience(Auth::JWT_AUDIENCE)           // Audience:    Application frontend.
                                                ->setIssuedAt(time())                       // Issued at:   Now.
                                                ->setExpiration(time() + 3600)              // Expires in:  1 hour.
                                                ->set('user_id', (int)$user_id)             // Store user_id as claim.
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
            'displayName' => $records[0]['displayName'],
            'privilegeLevel' => $records[0]['level']
        );
    }

}