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
     * Checks whether user with given socialMediaID, associated with a specific social media provider, exists.
     * @param socialMediaID - socialMediaID of record.
     * @param socialMediaProviderName - name of socialMediaProviders record. This will be used to get it's id field.
     */
    public function checkUserExistsBySocialMediaID($socialMediaID, $socialMediaProviderName) {
        try {
            return $this->query(
                "SELECT
                    users.id
                FROM
                    users
                WHERE
                    users.socialMediaID = :_smid
                    AND
                    users.socialMediaProvider_id = (
                        SELECT
                            socialMediaProviders.id
                        FROM
                            socialMediaProviders
                        WHERE
                            socialMediaProviders.name = :_name
                    )",
                array(
                    ':_smid' => $socialMediaID,
                    ':_name' => $socialMediaProviderName
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets user record with given id.
     * @param id - id of record.
     */
    public function getUserByID($id) {
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
     * Get user with given socialMediaID, associated with a specific social media provider, exists.
     * @param socialMediaID - socialMediaID of record.
     * @param socialMediaProviderName - name of socialMediaProviders record. This will be used to get it's id field.
     */
    public function getUserBySocialMediaID($socialMediaID, $socialMediaProviderName) {
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName,
                    privilegeLevels.level
                FROM
                    users,
                    privilegeLevels
                WHERE
                    users.socialMediaID = :_smid
                    AND
                    users.socialMediaProvider_id = (
                        SELECT
                            socialMediaProviders.id
                        FROM
                            socialMediaProviders
                        WHERE
                            socialMediaProviders.name = :_name
                    )
                    AND
                    privilegeLevels.id = users.privilegeLevel_id",
                array(
                    ':_smid' => $socialMediaID,
                    ':_name' => $socialMediaProviderName
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
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