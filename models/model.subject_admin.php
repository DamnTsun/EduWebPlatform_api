<?php

class Model_Subject_Admin extends Model {


    /**
     * Returns whether the specified user is a subject_admin for the specified subject.
     * @param subjectid - id of subject.
     * @param userid - id of user.
     */
    public function checkUserIsSubjectAdmin($subjectid, $userid) {
        try {
            return $this->query(
                "SELECT
                    subject_admins.user_id
                FROM
                    subject_admins
                WHERE
                    subject_admins.subject_id = :_subjectid
                    AND
                    subject_admins.user_id = :_userid",
                array(
                    ':_subjectid' => $subjectid,
                    ':_userid' => $userid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets a specified subject_admin via their userid and subjectid.
     * @param subjectid - id of subject.
     * @param userid - id of user.
     */
    public function getSubjectAdminByIDs($subjectid, $userid) {
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName
                FROM
                    subject_admins
                JOIN users ON
                    subject_admins.user_id = users.id
                WHERE
                    -- Get record associated with subject.
                    subject_admins.subject_id = :_subjectid
                    AND
                    -- Get record with specified id.
                    users.id = :_userid",
                array(
                    ':_subjectid' => $subjectid,
                    ':_userid' => $userid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets admins who have associated themselves with the specified subject.
     * @param subjectid - id of subject.
     * @param count - number of records to get.
     * @param offset - number of records to skip.
     */
    public function getSubjectAdminsBySubject($subjectid, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    users.id,
                    users.displayName
                FROM
                    subject_admins
                JOIN users ON
                    subject_admins.user_id = users.id
                WHERE
                    -- Only get admins (admin privilege is 2). Non-admins only removed from this table once per day via event.
                    users.privilegeLevel_id = 2
                    AND
                    -- Only get subject admins for the specified subject.
                    subject_admins.subject_id = :_subjectid
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_subjectid' => $subjectid,
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
     * Adds the specified user to the specified subject as a subject_admin.
     * Does not prevent non-admins being added. This must be done prior to calling this method.
     * @param subjectid - id of subject.
     * @param userid - id of user.
     */
    public function addSubjectAdminToSubject($subjectid, $userid) {
        try {
            return $this->query(
                "INSERT INTO
                    subject_admins (subject_id, `user_id`)
                VALUES
                    (
                        :_subjectid,
                        :_userid
                    );",
                array(
                    ':_subjectid' => $subjectid,
                    ':_userid' => $userid
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Removes the specified user from the specified subject (as a subject_admin).
     * Will do nothing if specified subject or user does not exist.
     * @param subjectid - id of subject.
     * @param userid - id of user.
     */
    public function removeSubjectAdminFromSubject($subjectid, $userid) {
        try {
            return $this->query(
                "DELETE FROM
                    subject_admins
                WHERE
                    -- Only for the specified subject.
                    subject_admins.subject_id = :_subjectid
                    AND
                    -- Only for the specified user.
                    subject_admins.user_id = :_userid",
                array(
                    ':_subjectid' => $subjectid,
                    ':_userid' => $userid
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }


}