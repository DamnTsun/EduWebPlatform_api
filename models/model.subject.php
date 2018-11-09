<?php

class Model_Subject extends Model {

    public function getAllSubjects($count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name
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
                    subjects.name
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


    public function addSubject($name) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    subjects (name)
                VALUES
                    (
                        :_name
                    )",
                array(
                    ':_name' => $name
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