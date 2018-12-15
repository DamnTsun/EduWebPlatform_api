<?php

class Model_Topic extends Model {

    /**
     * Checks topic with given name exists within the specified subject.
     */
    public function checkTopicExists($subjectId, $name) {
        try {
            return $results = $this->query(
                "SELECT
                    topics.id
                FROM
                    topics
                WHERE
                    topics.subject_id = :_subjectID
                    AND
                    topics.name = :_name
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


    /**
     * Checks topic with given id exists.
     */
    public function checkTopicExistsByID($subjectid, $topicid) {
        try {
            return $results = $this->query(
                "SELECT
                    topics.id
                FROM
                    topics
                WHERE
                    topics.id = :_topicid
                    AND
                    topics.subject_id = :_subjectid
                LIMIT 1",
                array(
                    ':_topicid' => $topicid,
                    ':_subjectid' => $subjectid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    


    /**
     * Gets all topics within the given subject.
     */
    public function getTopicsBySubject($subjectID, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try{
            return $results = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description,
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


    /**
     * Gets topic with the given id.
     */
    public function getTopicByID($id) {
        try {
            return $result = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description
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





    /**
     * Creates a new topic in the given subject with the given name and description.
     */
    public function addTopic($subjectID, $name, $description) {
        try {
            return $result = $this->query(
                "INSERT INTO
                    topics (name, description, subject_id)
                VALUES
                    (
                        :_name,
                        :_desc,
                        :_id
                    )", 
                array(
                    ':_name' => $name,
                    ':_desc' => $description,
                    ':_id' => $subjectID
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return false;
        }
    }


    


    /**
     * Deletes topic with given id.
     */
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