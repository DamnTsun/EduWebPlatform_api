<?php

abstract class Controller {
    // Model class
    protected $db;
    // User model class
    protected $userDb;

    public function __construct() {
        require_once $_ENV['dir_models'] . 'model.user.php';
        $this->userDb = new Model_User();
    }

    protected function model($model) {
        if (file_exists($_ENV['dir_models'].$model.'.php')) {
            require_once '../app/models/'.$model.'.php';
            return new $model();
        }
    }

    protected function printJSON($object) {
        echo json_encode($object, JSON_HEX_QUOT | JSON_HEX_TAG);
    }
    
    protected function printMessage($message) {
        $this->printJSON(array('message' => $message));
    }

    protected function handleSessionUser($requiresAdmin) {
        // Get user.
        $user = App::validateSession();
        // Check successful.
        if (!isset($user)) {
            http_response_code(401);
            $this->printMessage('You are not signed in.');
            exit();
        }
        // If required, check user is admin.
        if ($requiresAdmin && !$user['admin']) {
            http_response_code(401);
            $this->printMessage('You are not an admin.');
            exit();
        }
        return $user;
    }

    /**
     * Formats records for output.
     * @param records - records to be formatted.
     */
    protected abstract function formatRecords($records);
    /**
     * Validates incoming JSON (for create / modify resource) so that it contains all necessary fields.
     * @param json - the json of the object.
     */
    protected abstract function validateJSON($json);
}