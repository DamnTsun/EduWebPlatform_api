<?php

class Model_Topic extends Model {

    /**
     * Checks topic with given name exists within the specified subject.
     * @param subjectid - id of subject topic is in.
     * @param name - name of topic.
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
     * @param subjectid - id of subject topic is in.
     * @param topicid - id of topic.
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
     * @param subjectID - id of subject.
     * @param count - how many records to get. Optional, default 10.
     * @param offset - how many records to skip. Optional, default 0.
     */
    public function getTopicsBySubject($subjectID, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try{
            return $results = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description
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
     * Gets topic with the given id and subjectid.
     * @param subjectid - subjectid of topic.
     * @param topicid - id of topic.
     */
    public function getTopicByID($subjectid, $topicid) {
        try {
            return $result = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description
                FROM
                    topics
                WHERE
                    topics.id = :_topicid
                    AND
                    topics.subject_id = :_subjectid",
                array(
                    ':_topicid' => $topicid,
                    ':_subjectid' => $subjectid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Creates a new topic in the given subject with the given name and description.
     * @param subjectID - id of subject.
     * @param name - name for topic.
     * @param description - description for topic.
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
     * Modifies values of existing topic.
     * @param topicid - id of topic.
     * @param name - name for topic. Is ignored if null.
     * @param description - description for topic. Is ignored if null.
     */
    public function modifyTopic($topicid, $name, $description) {
        // Build string with variable number of fields.
        $queryString = "UPDATE topics SET ";
        $queryParams = array();
        // name
        if (isset($name)) {
            $queryString = $queryString . "topics.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // description
        if (isset($description)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "topics.description = :_desc";
            $queryParams[':_desc'] = $description;
        }
        // end query string.
        $queryString = $queryString . " WHERE topics.id = :_id LIMIT 1";
        $queryParams[':_id'] = $topicid;
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
     * Deletes topic with given id.
     * @param id - id of topic.
     */
    public function deleteTopic($id) {
        try {
            return $result = $this->query(
                "DELETE FROM
                    topics
                WHERE
                    topics.id = :_id
                LIMIT 1",
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