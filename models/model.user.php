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
                    users.displayName,
                    privilegeLevels.level
                FROM
                    users,
                    privilegeLevels
                WHERE
                    users.id = :_id
                    AND
                    privilegeLevels.id = users.privilegeLevel_id
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
     * Creates new user with given socialMediaID, id of socialMediaProviders record with given name,
     *  id of privilegeLevels record with given level.
     * @param socialMediaID - socialMediaID for record.
     * @param socialMediaProviderName - name of socialMediaProviders record.
     * @param privilegeLevel - level of privilgeLevels record.
     */
    public function createUser($socialMediaID, $socialMediaProviderName, $privilegeLevelName) {
        try {
            return $this->query(
                "INSERT INTO
                    users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id)
                VALUES
                    (
                        DEFAULT,
                        :_smid,
                        (
                            SELECT
                                socialMediaProviders.id
                            FROM
                                socialMediaProviders
                            WHERE
                                socialMediaProviders.name = :_smname
                        ),
                        (
                            SELECT
                                privilegeLevels.id
                            FROM
                                privilegeLevels
                            WHERE
                                privilegeLevels.level = :_plname
                        )
                    )",
                array(
                    ':_smid' => $socialMediaID,
                    ':_smname' => $socialMediaProviderName,
                    ':_plname' => $privilegeLevelName
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }

}