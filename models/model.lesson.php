<?php

class Model_Lesson extends Model {

    /**
     * Check if a lesson exists with the given name and topic_id.
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
     * Check if a lesson exists with the given id and topic_id.
     */
    public function checkLessonExistsByID($topic_id, $id) {
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id
                FROM
                    lessons
                WHERE
                    lessons.topic_id = :_topicid
                    AND
                    lessons.id = :_id
                LIMIT 1",
                array(
                    ':_topicid' => $topic_id,
                    ':_id' => $id
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets all lessons with the given topic_id.
     */
    public function getLessonsByTopic($id, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id,
                    lessons.name,
                    lessons.body
                FROM
                    lessons
                WHERE
                    lessons.topic_id = :_id
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_id' => $id,
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
     * Gets the lesson with the given id.
     */
    public function getLessonByID($id) {
        return $results = $this->query(
            "SELECT
                lessons.id,
                lessons.name,
                lessons.body
            FROM
                lessons
            WHERE
                lessons.id = :id
            LIMIT 1",
            array(':id' => $id),
            Model::TYPE_FETCHALL
        );
    }





    /**
     * Creates a new lesson record with the given values.
     */
    public function addLesson($topic_id, $name, $body) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    lessons (name, body, topic_id)
                VALUES
                    (
                        :_name,
                        :_body,
                        :_topicid
                    )",
                array(
                    ':_name' => $name,
                    ':_body' => $body,
                    ':_topicid' => $topic_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return false;
        }
    }





    /**
     * Delete the lesson record with the given id.
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