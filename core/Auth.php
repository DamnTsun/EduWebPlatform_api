<?php

class Auth {

    // Constants
    private const GOOGLE_TOKEN_NAME = 'google_id_token';
    private const FACEBOOK_TOKEN_NAME = 'facebook_id_token';

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
     * Verifies a token (for any provider), by sending it to the given url. (Should be social media provider's endpoint for token validation)
     * @param url - url to use.
     */
    private static function verifyTokenByURL($url) {
        $curl = curl_init();
        // Set url.
        curl_setopt($curl, CURLOPT_URL, $url);
        // Set return transfer. (Content returned by request is stored in a variable)
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Execture request and close curl.
        $response = curl_exec($curl);
        curl_close($curl);

        // Check response received.
        if (!isset($response)) {
            return null;
        }

        return $response;
    }


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
        // Perform GET request to Facebook token validation endpoint using curl.
        $curl = curl_init();
        // Set url.
        $response = Auth::verifyTokenByURL(
            'https://graph.facebook.com/debug_token' .
                '?input_token=' . $id_token .
                '&access_token=' . $_ENV['facebook_client_id'] . '|' . $_ENV['facebook_client_secret']
        );

        // Check successful.
        if (!isset($response)) {
            return null;
        }

        // Try parsing it as JSON.
        try {
            $payload = json_decode($response);
            // Make sure payload is in correct / expected format.
            if (!isset($payload) || !isset($payload->data)) {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }

        // Check app_id matches this app.
        if (!isset($payload->data->app_id) || $payload->data->app_id !== $_ENV['facebook_client_id']) {
            return null;
        }
        // Check is_valid is true.
        if (!isset($payload->data->is_valid) || !$payload->data->is_valid) {
            return null;
        }

        return $payload;
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
     * Initiates a new session. Gets user with given socialMediaID and given socialMediaProvider (by name)
     * If user does not exists, an account is created for them, and then returned.
     * Do not call this directly. Call initSession_Google or similar. It will pass the correspond values if validation is passed.
     * @param socialMediaID - id of social media account being used to sign in. (Extenal id, aka on social media provider's side)
     * @param socialMediaProviderName - name of socialMediaProviders record linked to the account.
     */
    private static function initSession($socialMediaID, $socialMediaProviderName) {
        // Create users controller instance for interacting with users / users_google records.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $userController = new Users();


        // Check if user exists with given socialMediaID, associated with given socialMediaProvider.
        if (!$userController->checkUserExistsBySocialMediaID($socialMediaID, $socialMediaProviderName)) {
            // Attempt to create user account for user, using google, with normal privilege level.
            $result = $userController->createUser($socialMediaID, $socialMediaProviderName, 'normal');
            if (!isset($result)) {
                http_response_code(500); return 'Something went wrong. Unable to create new internal user record.';
            }
        }

        // Get user record using socialMediaID ($payload['sub']) and socialMediaProvider name (google).
        $user = $userController->getUserBySocialMediaID($socialMediaID, $socialMediaProviderName);
        if (!isset($user) || sizeof($user) == 0) {
            http_response_code(500); return 'Something went wrong. Your user record exists, but could not be retrieved.';
        }

        // Check user not banned.
        if ($user[0]['level'] == Auth::PRIVILEGE_LEVELS['banned']) {
            http_response_code(401); return 'You are banned.';
        }


        // Create and return JWT to user.
        Auth::createJWT($user[0]['id']);
        return null;
    }


    /**
     * Initiates a new session. Checks and validates a google id_token. (given via POST)
     */
    public static function initSession_Google() {
        // Check id_token given in POST body.
        if (!isset($_POST[Auth::GOOGLE_TOKEN_NAME])) {
            http_response_code(400); return '`' . Auth::GOOGLE_TOKEN_NAME . '` not given in POST body.';
        }

        // Attempt to get payload from id_token.
        $payload = Auth::validateIdToken_Google($_POST[Auth::GOOGLE_TOKEN_NAME]);
        if (!isset($payload)) {
            http_response_code(400); return '`' . Auth::GOOGLE_TOKEN_NAME . '` is not valid.';
        }

        // payload['sub'] is 'subject' - aka user's google id.
        // Attempt to initialize session with given social media id of type 'google'. Return to return any errors.
        return Auth::initSession($payload['sub'], 'google');
    }

    /**
     * Initiates a new session. Checks and validates a facebook id_token. (given via POST)
     */
    public static function initSession_Facebook() {
        // Check id_token given in POST body.
        if (!isset($_POST[Auth::FACEBOOK_TOKEN_NAME])) {
            http_response_code(400); return '`' . Auth::FACEBOOK_TOKEN_NAME . '` not given in POST body.';
        }

        // Attempt to get payload from id_token.
        $payload = Auth::validateIdToken_Facebook($_POST[Auth::FACEBOOK_TOKEN_NAME]);
        if (!isset($payload)) {
            http_response_code(400); return '`' . Auth::FACEBOOK_TOKEN_NAME . '` is not valid.';
        }

        // $payload->data->user_id is user's facebook id.
        // Attempt to initialize session with given social media id of type 'facebook'. Return to return any errors.
        return Auth::initSession($payload->data->user_id, 'facebook');
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