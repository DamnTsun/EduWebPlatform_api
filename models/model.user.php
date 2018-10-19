<?php

class Model_User extends Model {

    public function checkUserExistsByGoogleId($googleId) {
        try {
            return $results = $this->query(
                "SELECT
                    users.id
                FROM
                    users
                WHERE
                    users.googleId = :_googleId
                LIMIT 1",
                array(
                    ':_googleId' => $googleId
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    public function getUserByGoogleId($googleId) {
        try {
            return $results = $this->query(
                "SELECT
                    users.id,
                    users.admin,
                    users.banned
                FROM
                    users
                WHERE
                    users.googleId = :_googleId
                LIMIT 1",
                array(
                    ':_googleId' => $googleId
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    public function addUser($googleId, $forename, $surname, $email) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    users (
                        googleId,
                        email,
                        forename,
                        surname
                    )
                VALUES (
                    :_googleId,
                    :_email,
                    :_forename,
                    :_surname
                )",
                array(
                    ':_googleId' => $googleId,
                    ':_forename' => $forename,
                    ':_surname' => $surname,
                    ':_email' => $email
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}