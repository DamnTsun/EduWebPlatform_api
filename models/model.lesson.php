<?php

class Model_Lesson extends Model {

    /**
     * Check if a lesson exists with the given name and topic_id.
     * @param topic_id - id of topic.
     * @param name - name of lesson.
     */
    public function checkLessonExists($topic_id, $name) {
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id
                FROM
                    lessons
                WHERE
                    lessons.topic_id = :_id
                    AND
                    lessons.name = :_name
                LIMIT 1",
                array(
                    ':_id' => $topic_id,
                    ':_name' => $name
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Check if a lesson exists with the given id, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param id - id of lesson.
     */
    public function checkLessonExistsByID($subjectid, $topicid, $lessonid) {
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id
                FROM
                    lessons
                WHERE
                    lessons.id = :_lessonid
                    AND
                    lessons.topic_id = (
                        SELECT
                            topics.id
                        FROM
                            topics
                        WHERE
                            topics.id = :_topicid
                            AND
                            topics.subject_id = :_subjectid
                    )",
                array(
                    ':_lessonid' => $lessonid,
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
     * Gets all lessons inside the given topic (by id), inside the given subject (by id).
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param count - how many records to get. Optional, default 10.
     * @param offset - how many records to skip. Optional, default 0.
     */
    public function getLessonsByTopic($subjectid, $topicid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id,
                    lessons.name,
                    lessons.body,
                    lessons.hidden
                FROM
                    lessons
                WHERE
                    lessons.topic_id = (
                        SELECT
                            topics.id
                        FROM
                            topics
                        WHERE
                            topics.id = :_topicid
                            AND
                            topics.subject_id = :_subjectid
                    )
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_subjectid' => $subjectid,
                    ':_topicid' => $topicid,
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
     * Gets the lesson with the given id, inside the given topic (by id), inside the given subject (by id).
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param lessonid - id of lesson.
     */
    public function getLessonByID($subjectid, $topicid, $lessonid) {
        try {
            return $this->query(
                "SELECT
                    lessons.id,
                    lessons.name,
                    lessons.body,
                    lessons.hidden
                FROM
                    lessons
                WHERE
                    lessons.id = :_lessonid
                    AND
                    lessons.topic_id = (
                        SELECT
                            topics.id
                        FROM
                            topics
                        WHERE
                            topics.id = :_topicid
                            AND
                            topics.subject_id = :_subjectid
                    )",
                array(
                    ':_lessonid' => $lessonid,
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
     * Creates a new lesson record with the given values.
     * @param topic_id - id of topic.
     * @param name - name of lesson.
     * @param body - body of lesson.
     * @param hidden - hidden status of lesson.
     */
    public function addLesson($topic_id, $name, $body, $hidden) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    lessons (name, body, hidden, topic_id)
                VALUES
                    (
                        :_name,
                        :_body,
                        :_hidden,
                        :_topicid
                    )",
                array(
                    ':_name' => $name,
                    ':_body' => $body,
                    ':_hidden' => $hidden,
                    ':_topicid' => $topic_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return false;
        }
    }





    /**
     * Modifies values of existing lesson.
     * @param id - id of lesson.
     * @param name - name for lesson. Is ignored if null.
     * @param body - body for lesson. Is ignored if null.
     * @param hidden - hidden status for lessons.
     */
    public function modifyLesson($id, $name, $body, $hidden) {
        // Build string with variable number of fields.
        $queryString = "UPDATE lessons SET ";
        $queryParams = array();
        // name
        if (isset($name)) {
            $queryString = $queryString . "lessons.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // body
        if (isset($body)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "lessons.body = :_body";
            $queryParams[':_body'] = $body;
        }
        // hidden
        if (isset($hidden)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "lessons.hidden = :_hidden";
            $queryParams[':_hidden'] = $hidden;
        }

        // end query string.
        $queryString = $queryString . " WHERE lessons.id = :_id LIMIT 1";
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
     * Delete the lesson record with the given id.
     * @param id - id of lesson.
     */
    public function deleteLesson($id) {
        try {
            return $result = $this->query(
                "DELETE FROM
                    lessons
                WHERE
                    lessons.id = :_id",
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