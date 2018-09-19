<?php

class Model_User extends Model {

    public function getUser($googleUser) {
        // If no user record exists for googleId, create one.
        if (!$this->checkUserExists($googleUser['sub'])) {
            $this->addUser($googleUser['sub'], $googleUser['given_name'],
                $googleUser['family_name'], $googleUser['email']);
        }
        // Return user record matching googleId.
        return $this->getUserByGoogleId($googleUser['sub']);
    }

    private function checkUserExists($googleid) {
        return $this->query(
            'SELECT
                `id`
            FROM
                `users`
            WHERE
                `googleId` = :googleid',
            array(':googleid' => $googleid),
            Model::TYPE_BOOL);
    }


    private function getUserByGoogleId($googleid) {
        $result = $this->query(
            'SELECT
                `id`,
                `admin`,
                `banned`
            FROM
                `users`
            WHERE
                `googleId` = :googleid',
            array(':googleid' => $googleid),
            Model::TYPE_FETCH);
        return $result;
    }
    
    
    private function addUser($googleid, $forename, $surname, $email) {
        $result = $this->query(
            'INSERT INTO
                `users` (`googleId`, `forename`, `surname`, `email`) 
            VALUES
                (:googleid, :forename, :surname, :email)',
            array(
                ':googleid' => $googleid,
                ':forename' => $forename,
                ':surname' => $surname,
                ':email' => $email),
            Model::TYPE_INSERT);
        return $result;
    }

}