<?php

class Model_Subject extends Model {

    public function getAllSubjects($count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.homepageContent
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


    public function getSubject($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.homepageContent
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
     * Checks a subject exists with the given name.
     * @param $name - Name of subject being looked for.
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
     * @param $id - ID of subject being looked for.
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


    public function addSubject($name, $description, $homepageContent) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    subjects (name, description, homepageContent)
                VALUES
                    (
                        :_name,
                        :_desc,
                        :_hpContent
                    )",
                array(
                    ':_name' => $name,
                    ':_desc' => $description,
                    ':_hpContent' => $homepageContent
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    
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