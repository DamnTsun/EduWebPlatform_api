<?php

class Model_Account extends Model {

    public function checkUserExists($googleid) {
        return $this->query('SELECT `id` FROM `users` WHERE `google_id` = :googleid', array(':googleid' => $googleid), Model::TYPE_BOOL);
    }

    public function getUserById($userid) {
        $result = $this->query('SELECT * FROM `users` WHERE `id` = :id', array(':id' => $userid), Model::TYPE_FETCH);
        return $result;
    }

    public function getUserByGoogleId($googleid) {
        $result = $this->query('SELECT * FROM `users` WHERE `google_id` = :googleid', array(':googleid' => $googleid), Model::TYPE_FETCH);
        return $result;
    }
    
    
    public function addUser($googleid, $forename, $surname, $email) {
        $result = $this->query('INSERT INTO `users` (`google_id`, `forename`, `surname`, `email`) 
            VALUES (:googleid, :forename, :surname, :email)',
            array(':googleid' => $googleid, ':forename' => $forename,
            ':surname' => $surname, ':email' => $email),
            Model::TYPE_INSERT);
        return $result;
    }
}