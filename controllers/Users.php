<?php

class Users extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                // Get id token.
                if (!isset($_POST['id_token'])) {
                    http_response_code(400); 'id token not given'; return;
                }
                $googleUser = App::validateGoogleIdToken($_POST['id_token']);
                if (is_null($googleUser)) {
                    http_response_code(400); return;
                }
                $user = $this->userDb->getUser($googleUser);

                $values = array(
                    'isAdmin' => $user['admin'],
                    'isBanned' => $user['banned']
                );

                echo json_encode($values);
                return;

            default:
                http_response_code(405); return;
        }
    }
}