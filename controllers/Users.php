<?php

class Users extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function checkUserExistsByGoogleID($googleId) {
        $result = $this->db->checkUserExistsByGoogleID($googleId);
        if (!isset($result)) {
            http_response_code(400); exit();
        }

        return $result;
    }

    public function getUserByGoogleID($googleId) {
        
    }

    public function addUser($googleId, $forename, $surname, $email) {
        $result = $this->db->addUser($googleId, $forename, $surname, $email);
        
        
    }
}