<?php

class Home extends Controller {

    public function index($name = '') {
        $user = $this->model('User');
        if (isset($user)) {
            $user->name = $name;
        }

        $this->view('index', ['name' => $user->name]);
    }

    public function test() {
        echo 'test';
    }
}