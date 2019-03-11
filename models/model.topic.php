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
     * Gets all topics within the given subject. Does not return topics that are hidden or contain no lessons/tests.
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
                    topics.description,
                    topics.hidden,
                    (
                        SELECT
                            COUNT(lessons.id)
                        FROM
                            lessons
                        WHERE
                            lessons.topic_id = topics.id
                    ) as 'lessonCount',
                    (
                        SELECT
                            COUNT(tests.id)
                        FROM
                            tests
                        WHERE
                            tests.topic_id = topics.id
                    ) as 'testCount'
                FROM
                    topics
                WHERE
                    -- Topic not hidden
                    topics.hidden != 1
                    AND
                    -- Topic contains at least 1 lesson/test.
                    (
                        SELECT COUNT(lessons.id)
                        FROM lessons
                        WHERE lessons.topic_id = topics.id
                    ) + (
                        SELECT COUNT(tests.id)
                        FROM tests
                        WHERE tests.topic_id = topics.id
                    ) > 0

                    AND
                    -- Topic in specified subject and subject not hidden.
                    topics.subject_id = (
                        SELECT subjects.id
                        FROM subjects
                        WHERE subjects.id = :_id AND subjects.hidden != 1
                    )
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
     * Gets all topics within the given subject.
     * @param subjectID - id of subject.
     * @param count - how many records to get. Optional, default 10.
     * @param offset - how many records to skip. Optional, default 0.
     */
    public function getTopicsBySubjectAdmin($subjectID, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try{
            return $results = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description,
                    topics.hidden,
                    (
                        SELECT
                            COUNT(lessons.id)
                        FROM
                            lessons
                        WHERE
                            lessons.topic_id = topics.id
                    ) as 'lessonCount',
                    (
                        SELECT
                            COUNT(tests.id)
                        FROM
                            tests
                        WHERE
                            tests.topic_id = topics.id
                    ) as 'testCount'
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
     * Gets topic with the given id and subjectid. Does not get hidden topics or topic which contain no lessons/tests.
     * @param subjectid - subjectid of topic.
     * @param topicid - id of topic.
     */
    public function getTopicByID($subjectid, $topicid) {
        try {
            return $result = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description,
                    topics.hidden,
                    (
                        SELECT
                            COUNT(lessons.id)
                        FROM
                            lessons
                        WHERE
                            lessons.topic_id = topics.id
                    ) as 'lessonCount',
                    (
                        SELECT
                            COUNT(tests.id)
                        FROM
                            tests
                        WHERE
                            tests.topic_id = topics.id
                    ) as 'testCount'
                FROM
                    topics
                WHERE
                    topics.id = :_topicid
                    AND
                    -- Topic not hidden
                    topics.hidden != 1
                    AND
                    -- Topic contains at least 1 lesson/test.
                    (
                        SELECT COUNT(lessons.id)
                        FROM lessons
                        WHERE lessons.topic_id = topics.id
                    ) + (
                        SELECT COUNT(tests.id)
                        FROM tests
                        WHERE tests.topic_id = topics.id
                    ) > 0
                    
                    AND
                    -- Topic in specified subject and subject not hidden.
                    topics.subject_id = (
                        SELECT subjects.id
                        FROM subjects
                        WHERE subjects.id = :_subjectid AND subjects.hidden != 1
                    )",
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
     * Gets topic with the given id and subjectid.
     * @param subjectid - subjectid of topic.
     * @param topicid - id of topic.
     */
    public function getTopicByIDAdmin($subjectid, $topicid) {
        try {
            return $result = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.description,
                    topics.hidden,
                    (
                        SELECT
                            COUNT(lessons.id)
                        FROM
                            lessons
                        WHERE
                            lessons.topic_id = topics.id
                    ) as 'lessonCount',
                    (
                        SELECT
                            COUNT(tests.id)
                        FROM
                            tests
                        WHERE
                            tests.topic_id = topics.id
                    ) as 'testCount'
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
     * Creates a new topic in the given subject with the given name, description, and hidden status.
     * @param subjectID - id of subject.
     * @param name - name for topic.
     * @param description - description for topic.
     * @param hidden - hidden status for topic.
     */
    public function addTopic($subjectID, $name, $description, $hidden) {
        try {
            return $result = $this->query(
                "INSERT INTO
                    topics (name, description, hidden, subject_id)
                VALUES
                    (
                        :_name,
                        :_desc,
                        :_hidden,
                        :_id
                    )", 
                array(
                    ':_name' => $name,
                    ':_desc' => $description,
                    ':_hidden' => $hidden,
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
     * @param hidden - hidden status for topic.
     */
    public function modifyTopic($topicid, $name, $description, $hidden) {
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
        // hidden
        if (isset($hidden)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "topics.hidden = :_hidden";
            $queryParams[':_hidden'] = $hidden;
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