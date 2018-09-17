<?php

class Controller {
    // Model class
    protected $db;

    protected function model($model) {
        if (file_exists($_ENV['dir_models'].$model.'.php')) {
            require_once '../app/models/'.$model.'.php';
            return new $model();
        }
    }
}