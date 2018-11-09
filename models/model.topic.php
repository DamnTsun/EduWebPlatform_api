<?php

class Model_Topic extends Model {

    public function checkTopicExists($subjectId, $name) {
        try {
            return $results = $this->query(
                "SELECT
                    topics.id
                FROM
                    topics
                WHERE
                    topics.subject_id = :_subjectID
                LIMIT 1",
                array(
                    ':_subjectID' => $subjectId,
                    ':_name' => $name
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    public function checkTopicExistsByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    topics.id
                FROM
                    topics
                WHERE
                    topics.id = :_id
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


    // READ
    public function getTopicsBySubject($subjectID, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try{
            return $results = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.imageUrl,
                    topics.subject_id,
                    (SELECT subjects.name FROM subjects WHERE subjects.id = topics.subject_id LIMIT 1) AS 'subjectName'
                FROM
                    topics
                WHERE
                    topics.subject_id = :_id
                ORDER BY
                    topics.name
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_id' => $subjectID,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getTopicByID($id) {
        try {
            return $result = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.imageUrl
                FROM
                    topics
                WHERE
                    topics.id = :_id
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


    // CREATE
    public function addTopic($subjectID, $name, $imageUrl) {
        try {
            return $result = $this->query(
                "INSERT INTO
                    topics (name, imageUrl, subject_id)
                VALUES
                    (
                        :_name,
                        :_imageUrl,
                        :_id
                    )", 
                array(
                    ':_name' => $name,
                    ':_imageUrl' => $imageUrl,
                    ':_id' => $subjectID
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return false;
        }
    }


    // DELETE
    public function deleteTopic($id) {
        try {
            return $result = $this->query(
                "DELETE FROM
                    topics
                WHERE
                    topics.id = :_id",
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