<?php

class Admin extends Controller {

    public function __construct() {
        require_once $_ENV['dir_models'] . 'model.admin.php';
        $this->db = new Model_Admin();
    }


    public function index() {
        // If not signed in, 404.
        if (!isset($_SESSION['userid'])) {
            $this->view404();
            return;
        }
        $record = $this->db->getUserById($_SESSION['userid']);
        // If not admin, 404.
        if (!$record['admin']) {
            $this->view404();
            return;
        }
        $this->view('admin', [ 'record' => $record ]);
    }
}