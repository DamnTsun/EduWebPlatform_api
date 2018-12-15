<?php

class Users extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['users'];
        $this->db = new Model_User();
    }

    public function checkUserExistsByGoogleId($googleId) {
        $result = $this->db->checkUserExistsByGoogleId($googleId);
        if (!isset($result)) {
            http_response_code(400); exit();
        }

        return $result;
    }

    public function getUserByGoogleId($googleId) {
        $result = $this->db->getUserByGoogleId($googleId);
        if (!isset($result) || sizeof($result) == 0) {
            return null;
        }
        return $result;
    }

    public function addUser($googleId, $forename, $surname, $email) {
        $result = $this->db->addUser($googleId, $forename, $surname, $email);
        if (!isset($result)) {
            http_response_code(500); exit();
        }
        return $result;
    }


    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'admin' => ($rec['admin']) ? true : false,
                    'banned' => ($rec['banned']) ? true : false
                )
            );
        }
        return $results;
    }
}