<?php

class Controller {
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
}