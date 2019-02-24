<?php

class Model_Subject extends Model {

    /**
     * Checks a subject exists with the given name.
     * @param name - Name of subject being looked for.
     */
    public function checkSubjectExists($name) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id
                FROM
                    subjects
                WHERE
                    subjects.name = :_name
                LIMIT 1",
                array(
                    ':_name' => $name
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Checks a subject exists with the given id.
     * @param id - ID of subject being looked for.
     */
    public function checkSubjectExistsByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id
                FROM
                    subjects
                WHERE
                    subjects.id = :_id
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
     * Gets all subjects. Does not get subjects that are hidden or have no contained topics.
     * @param count - how many records to get. Optional, default 10.
     * @param offset - how many records to skip. Optional, default 0.
     */
    public function getAllSubjects($count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.hidden,
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) AS 'topicCount'
                FROM
                    subjects
                WHERE
                    -- Not hidden.
                    subjects.hidden != 1
                    AND
                    -- Contains at least 1 topic.
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) > 0
                ORDER BY
                    subjects.name
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
     * Gets all subjects.
     * @param count - how many records to get. Optional, default 10.
     * @param offset - how many records to skip. Optional, default 0.
     */
    public function getAllSubjectsAdmin($count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.hidden,
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) AS 'topicCount'
                FROM
                    subjects
                ORDER BY
                    subjects.name
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
     * Gets subject with given id. Does not get subjects that are hidden or do not contain any topics.
     * @param id - id of subject.
     */
    public function getSubjectByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.hidden,
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) AS 'topicCount'
                FROM
                    subjects
                WHERE
                    subjects.id = :_id
                    AND
                    -- Not hidden.
                    subjects.hidden != 1
                    AND
                    -- Contains at least 1 topic.
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) > 0
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Gets subject with given id.
     * @param id - id of subject.
     */
    public function getSubjectByIDAdmin($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.hidden,
                    (
                        SELECT
                            COUNT(topics.id)
                        FROM
                            topics
                        WHERE
                            topics.subject_id = subjects.id
                    ) AS 'topicCount'
                FROM
                    subjects
                WHERE
                    subjects.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return false;
        }
    }





    /**
     * Creates new subject record with given name / description / hidden status
     * @param name - name of subject.
     * @param description - description of subject.
     * @param hidden - whether subject is hidden.
     */
    public function addSubject($name, $description, $hidden) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    subjects (name, description, hidden)
                VALUES
                    (
                        :_name,
                        :_desc,
                        :_hidden
                    )",
                array(
                    ':_name' => $name,
                    ':_desc' => $description,
                    ':_hidden' => $hidden
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Modifies values of existing subject.
     * @param id - id of subject.
     * @param name - name for subject. Is ignored if null.
     * @param description - description for subject. Is ignored if null.
     * @param homepageContent - homepageContent for subject. Is ignored if null.
     */
    public function modifySubject($id, $name, $description, $hidden) {
        // Build string with variable number of fields.
        $queryString = "UPDATE subjects SET ";
        $queryParams = array();
        // name
        if (isset($name)) {
            $queryString = $queryString . "subjects.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // description
        if (isset($description)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "subjects.description = :_desc";
            $queryParams[':_desc'] = $description;
        }
        // hidden
        if (isset($hidden)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "subjects.hidden = :_hidden";
            $queryParams[':_hidden'] = $hidden;
        }

        // end query string.
        $queryString = $queryString . " WHERE subjects.id = :_id LIMIT 1";
        $queryParams[':_id'] = $id;
        try {
            return $result = $this->query(
                $queryString,
                $queryParams,
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Deletes an existing subject.
     * @param id - id of subject.
     */
    public function deleteSubject($id) {
        try {
            return $results = $this->query(
                "DELETE FROM
                    subjects
                WHERE
                    subjects.id = :_id",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return false;
        }
    }
}