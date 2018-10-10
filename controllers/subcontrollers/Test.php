<?php

class Test extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.test.php';
        $this->db = new Model_Test();
    }

    public function index($testId = null) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                // Get user.
                if (!isset($_POST['id_token'])) {
                    http_response_code(400); return;
                }
                $googleUser = App::validateGoogleIdToken($_POST['id_token']);
                if (is_null($googleUser)) {
                    http_response_code(400); return;
                }
                $user = $this->userDb->getUser($googleUser);

                if (is_null($testId)) {
                // Get all tests. (based on count/offeset)
                    $this->getTests($user);
                } else {
                // Get a specific test if exists.
                    $this->getTest($user, $testId);
                }
                break;
        }
    }

    private function getTest($user, $testId) {

    }

    private function getTests($user) {
        $count = 10;
        $offset = 0;
        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }
        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }
    }
}