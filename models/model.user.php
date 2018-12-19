<?php

class Model_User extends Model {

    /**
     * Checks whether user with given id exists.
     * @param id - id of record.
     */
    public function checkUserExistsByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    users.id
                FROM
                    users
                WHERE
                    users.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Checks users_google record exists with given google_id.
     * @param googleid - google_id of record.
     */
    public function checkGoogleUserExistsByGoogleID($googleid) {
        try {
            return $results = $this->query(
                "SELECT
                    users_google.user_id
                FROM
                    users_google
                WHERE
                    users_google.google_id = :_googleid
                LIMIT 1",
                array(
                    ':_googleid' => $googleid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            echo $e;
            return null;
        }
    }

    /**
     * Checks users_facebook record exists with given facebook_id.
     * @param googleid - facebook_id of record.
     */
    public function checkFacebookUserExistsByFacebookID($facebookid) {
        throw new NotImplementedException();
    }

    /**
     * Checks users_linkedin record exists with given linkedin_id.
     * @param linkedinid - linkedin_id of record.
     */
    public function checkLinkedInUserExistsByLinkedInID($linkedinid) {
        throw new NotImplementedException();
    }





    /**
     * Gets user record with given id.
     * @param id - id of record.
     */
    public function getUser($id) {
        try {
            return $results = $this->query(
                "SELECT
                    users.id,
                    users.admin,
                    users.banned
                FROM
                    users
                WHERE
                    users.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Gets users_google record with given googleid.
     * @param googleid - google_id of record.
     */
    public function getGoogleUser($googleid) {
        try {
            return $results = $this->query(
                "SELECT
                    users_google.user_id,
                    users_google.google_id
                FROM
                    users_google
                WHERE
                    users_google.google_id = :_googleid
                LIMIT 1",
                array(
                    ':_googleid' => $googleid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Gets users_facebook record with given facebookid.
     * @param facebookid - facebook_id of record.
     */
    public function getFacebookUser($facebookid) {
        throw new NotImplementedException();
    }

    /**
     * Gets users_linkedin record with given linkedinid.
     * @param linkedinid - linkedin_id of record.
     */
    public function getLinkedInUser($linkedinid) {
        throw new NotImplementedException();
    }





    /**
     * Creates a new user record with default values. (displayName: 'unnamed user', admin: false, banned: false)
     */
    public function createUser() {
        try {
            return $results = $this->query(
                "INSERT INTO
                    users (displayName, admin, banned)
                VALUES
                    (
                        DEFAULT,
                        DEFAULT,
                        DEFAULT
                    )",
                array(),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Creates a new users_google record. Links a internal users record with a google id.
     * @param userid - id of users record to be associated with googleid.
     * @param googleid - googleid to be associated with users record.
     */
    public function createGoogleUser($userid, $googleid) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    users_google (`user_id`, google_id)
                VALUES
                    (
                        :_userid,
                        :_googleid
                    )",
                array(
                    ':_userid' => $userid,
                    ':_googleid' => $googleid
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Creates a new users_facebook record. Links a internal users record with a facebook id.
     * @param userid - id of users record to be associated with facebookid.
     * @param facebookid - facebookid to be associated with users record.
     */
    public function createFacebookUser($userid, $facebookid) {
        throw new NotImplementedException();
    }

    /**
     * Creates a new users_linkedin record. Links a internal users record with a linkedin id.
     * @param userid - id of users record to be associated with linkedinid.
     * @param linkedinid - linkedinid to be associated with users record.
     */
    public function createLinkedInUser($userid, $linkedinid) {
        throw new NotImplementedException();
    }


}