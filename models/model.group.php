<?php

class Model_Group extends Model {

    /**
     * Returns whether a group with the given id exists.
     * @param groupid - id of group.
     */
    public function checkGroupExists($groupid) {
        try {
            return $this->query(
                "SELECT
                    groups.id
                FROM
                    groups
                WHERE
                    groups.id = :_groupid",
                array(
                    ':_groupid' => $groupid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Returns whether the specified user is a member of the specified group.
     * @param userid - id of user.
     * @param groupid - id of group.
     */
    public function checkUserInGroup($userid, $groupid) {
        try {
            return $this->query(
                "SELECT
                    users.id
                FROM
                    users
                JOIN user_groups ON
                    users.id = user_groups.user_id
                WHERE
                    users.id = :_userid
                    AND
                    user_groups.group_id = :_groupid",
                array(
                    ':_userid' => $userid,
                    ':_groupid' => $groupid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets groups that the current user is a part of.
     * @param userid - id of current user.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getCurrentUserGroups($userid, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    groups.id,
                    groups.name,
                    groups.description,
                    groups.imageUrl
                FROM
                    user_groups
                JOIN groups ON
                    user_groups.group_id = groups.id
                WHERE
                    user_groups.user_id = :_userid
                GROUP BY
                    user_groups.group_id
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_userid' => $userid,
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
     * Gets all groups.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getAllGroups($count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    groups.id,
                    groups.name,
                    groups.description,
                    groups.imageUrl
                FROM
                    groups
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
     * Gets a group by id.
     * @param groupid - id of group.
     */
    public function getGroupByID($groupid) {
        try {
            return $this->query(
                "SELECT
                    groups.id,
                    groups.name,
                    groups.description,
                    groups.imageUrl
                FROM
                    groups
                WHERE
                    groups.id = :_groupid",
                array(
                    ':_groupid' => $groupid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }






    /**
     * Creates a new group with the specified user as the sole member.
     * @param userid - creator / 1st member of group.
     * @param name - name of group.
     * @param description - description of group.
     */
    public function createGroup($userid, $name, $description, $imageUrl) {
        // Create group.
        $groupid = $this->createGroupRecord($name, $description, $imageUrl);
        if (!isset($groupid)) {
            return null;
        }
        // Create user_group record.
        $result = $this->addUserToGroup($userid, $groupid);
        if (!isset($result)) {
            return null;
        }

        return $groupid;
    }

    /**
     * Creates a group with given name and description.
     * @param name - name for group.
     * @param description - description for group.
     */
    private function createGroupRecord($name, $description, $imageUrl) {
        try {
            return $this->query(
                "INSERT INTO
                    groups
                    (
                        `name`,
                        `description`,
                        imageUrl
                    )
                    VALUES (:_name, :_description, :_imageUrl)",
                array(
                    ':_name' => $name,
                    ':_description' => $description,
                    ':_imageUrl' => $imageUrl
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }







    /**
     * Modifies value of an existing group.
     * @param groupid - id of group.
     * @param name - name for group. - Ignored if null.
     * @param description - description for group. - Ignored if null.
     * @param imageUrl - imageUrl for group. - Ignored if null.
     */
    public function modifyGroup($groupid, $name, $description, $imageUrl) {
        // Build up query string and params based on given values.
        $queryString = "UPDATE groups SET ";
        $queryParams = array();
        // Name
        if (isset($name)) {
            $queryString = $queryString . "groups.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // Description
        if (isset($description)) {
            // Add ', ' if another field already added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "groups.description = :_description";
            $queryParams[':_description'] = $description;
        }
        // ImageUrl
        if (isset($imageUrl)) {
            // Add ', ' if another field already added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "groups.imageUrl = :_imageUrl";
            $queryParams[':_imageUrl'] = $imageUrl;
        }

        // End query.
        $queryString = $queryString . " WHERE groups.id = :_groupid LIMIT 1";
        $queryParams[':_groupid'] = $groupid;
        try {
            return $this->query(
                $queryString,
                $queryParams,
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Deletes the group with given id.
     * @param groupid - id of group.
     */
    public function deleteGroup($groupid) {
        try {
            return $this->query(
                "DELETE FROM
                    groups
                WHERE
                    groups.id = :_groupid",
                array(
                    ':_groupid' => $groupid
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }










    /**
     * Gets users who are members of a specified group.
     * @param groupid - id of group.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getUsersInGroup($groupid, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName
                FROM
                    user_groups
                JOIN users ON
                    user_groups.user_id = users.id
                WHERE
                    user_groups.group_id = :_groupid
                    AND
                    users.privilegeLevel_id != 3     -- User not banned.
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_groupid' => $groupid,
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
     * Gets users who are not members of a specified group.
     * @param groupid - id of group.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getUsersNotInGroup($groupid, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName
                FROM
                    users
                WHERE
                    -- Will return 1 if user is in the group, 0 otherwise.
                    (
                        SELECT
                            COUNT(*)
                        FROM
                            user_groups
                        WHERE
                            -- Lookup users who are in the group.
                            user_groups.group_id = :_groupid
                            AND
                            user_groups.user_id = users.id
                    ) = 0
                    AND
                        users.privilegeLevel_id != 3 -- User not banned.
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_groupid' => $groupid,
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
     * Adds the specified user to the specified group.
     * @param userid - id of user.
     * @param groupid - id of group.
     */
    public function addUserToGroup($userid, $groupid) {
        try {
            return $this->query(
                "INSERT INTO
                    user_groups
                    (
                        user_id,
                        group_id
                    )
                    VALUES (:_userid, :_groupid)",
                array(
                    ':_userid' => $userid,
                    ':_groupid' => $groupid
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Removes the specified user from the specified group.
     * @param userid - id of user.
     * @param groupid - id of group.
     */
    public function removeUserFromGroup($userid, $groupid) {
        try {
            return $this->query(
                "DELETE FROM
                    user_groups
                WHERE
                    user_groups.user_id = :_userid
                    AND
                    user_groups.group_id = :_groupid",
                array(
                    ':_userid' => $userid,
                    ':_groupid' => $groupid
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}
