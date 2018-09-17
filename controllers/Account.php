<?php

class Account extends Controller {
    
    public function __construct() {
        require_once $_ENV['dir_models'] . 'model.account.php';
        $this->db = new Model_Account();
    }

    public function index() {
        // If user not signed in, redirect them to sign in.
        if (!isset($_SESSION['userid'])) {
            App::redirect('account/signin/');
        }
        $record = $this->db->getUserById($_SESSION['userid']);
        $this->view('account', [ 'record' => $record ]);
    }

    public function signIn() {
        // If user is signed in, redirect them to dashboard.
        if (isset($_SESSION['userid'])) {
            App::redirect('account/');
        }
        // Sign user in if being redirected by google, else get auth url for sign in.
        $authUrl = $this->checkForGoogleSignIn();
        $this->view('signin', [ 'authUrl' => $authUrl ]);
    }

    public function signOut() {
        // If user is not logged in, redirect to sign in.
        if (!isset($_SESSION['userid'])) {
            App::redirect('account/login');
        }
        // End session.
        unset($_SESSION['userid']);
        if (isset($_SESSION['access_token'])) {
            unset($_SESSION['access_token']);
        }
        App::redirect('account/signin/');
    }



    private function checkForGoogleSignIn() {
        // Load in google sign in api.
        require_once $_ENV['dir_vendor'] . 'google-api-php-client-2.2.2/vendor/autoload.php';

        // Enter api credentials.
        $client = new Google_Client();
        $client->setClientId($_ENV['google_client_id']);
        $client->setClientSecret($_ENV['google_client_secret']);
        $client->setRedirectUri($_ENV['google_redirect_url']);
        $client->setPrompt('select_account');
        $client->addScope('email');
        $client->addScope('profile');

        $service = new Google_Service_Oauth2($client);
        
        $authUrl = '';
        // Check code sent back.
        if (!isset($_GET['code'])) {
            // Code not sent, generate auth url.
            $authUrl = $client->createAuthUrl();
        } else {
            // Code sent, authenticate and set access token.
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: ' . filter_var($_ENV['google_redirect_url'], FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $payload = $service->userinfo->get();
        }

        // Sign user in using data in payload.
        if (isset($payload)) {
            // Check if user has an account.
            if (!$this->db->checkUserExists($payload['id'])) {
                // User doesn't have an account, create a record for them.
                $this->db->addUser($payload['id'], $payload['givenName'],
                    $payload['familyName'], $payload['email']);
            }
            // Get user record and set session variables.
            $record = $this->db->getUserByGoogleId($payload['id']);
            $_SESSION['userid'] = $record['id'];

            unset($_SESSION['access_token']);
            App::redirect('account/');
        }

        // Return auth url if user not signed in and redirected.
        return $authUrl;
    }

}