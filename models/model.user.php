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
                    users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate)
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
                        ),
                        DEFAULT
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




    
    /**
     * Updates specified user's 'lastSignInDate' field to the current timestamp.
     * This field is used to delete old users, based on whether the timestamp is a set time in the past. (e.g. 180 days).
     * @param userid- id of user.
     */
    public function updateUserLastSignInDate($userid) {
        try {
            return $this->query(
                "UPDATE
                    users
                SET
                    users.lastSignInDate = DEFAULT
                WHERE
                    users.id = :_userid",
                array(
                    ':_userid' => $userid
                ),
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            return null;
        }
    }




    /**
     * Deletes user with given id.
     */
    public function deleteUser($id) {
        try {
            return $this->query(
                "DELETE from
                    users
                WHERE
                    id = :_id",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }




    /**
     * Updates a users display name.
     * @param id - id of user.
     * @param name - new name for user.
     */
    public function changeUserName($id, $name) {
        try {
            return $this->query(
                "UPDATE
                    users
                SET
                    displayName = :_name
                WHERE
                    id = :_id",
                array(
                    ':_name' => $name,
                    ':_id' => $id
                ),
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            return null;
        }
    }



    /**
     * Gets users from users table, ordered by id.
     * @param count - number of users to get.
     * @param offset - number of users to skip.
     */
    public function getUsers($count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName,
                    privilegeLevels.level
                FROM
                    users
                JOIN privilegeLevels ON
                    privilegeLevels.id = users.privilegeLevel_id
                ORDER BY users.id
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets users whose displayname is like the given value.
     * @param name - value for displayname search.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getUsersByName($name, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName,
                    privilegeLevels.level
                FROM
                    users
                JOIN privilegeLevels ON
                    privilegeLevels.id = users.privilegeLevel_id
                WHERE
                    users.displayName LIKE :_name
                ORDER BY users.id
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_name' => $name,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }




    /**
     * Sets privilege level of a user.
     * Sets to 1 if regular user, 2 if admin.
     * @param id - id of user.
     * @param setToAdmin - whether to set user to admin.
     */
    public function setUserAdminStatus($id, $setToAdmin) {
        // Privilege level 1 is normal. 2 is admin.
        $level = ($setToAdmin) ? '2' : '1';

        // Attempt to set.
        return $this->setUserPrivilegeLevel($id, $level);
    }

    /**
     * Sets whether a user is banned.
     * @param id - id of user.
     * @param setToBanned - whether to set user to banned.
     */
    public function setUserBannedStatus($id, $setToBanned) {
        // If user is being unbanned, they get regular user privilege level (1).
        $level = ($setToBanned) ? '3' : '1';

        // Attempt to set.
        return $this->setUserPrivilegeLevel($id, $level);
    }


    /**
     * Sets users privilege leve (regular, admin, banned, etc).
     * @param id - id of user.
     * @param value - id of privilege level in privilegeLevels table. CURRENTLY... (1 = regular, 2 = admin, 3 = banned)
     */
    private function setUserPrivilegeLevel($id, $value) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "UPDATE
                    users
                SET
                    users.privilegeLevel_id = :_level
                WHERE
                    users.id = :_id",
                array(
                    ':_level' => $value,
                    ':_id' => $id
                ),
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}