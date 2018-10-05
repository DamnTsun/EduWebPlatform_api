<?php

class Model_Lesson extends Model {

    public function getLessonsByTopic($topic_id) {
        $this->setPDOPerformanceMode(false);
        return $results = $this->query(
            "SELECT
                lessons.id,
                lessons.title,
                lessons.body
            FROM
                lessons
            WHERE
                lessons.topic_id = :topicId",
            array(':topicId' => $topic_id),
            Model::TYPE_FETCHALL
        );
    }

    public function getLessonByID($id) {
        $this->setPDOPerformanceMode(false);
        return $results = $this->query(
            "SELECT
                lessons.id,
                lessons.title,
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
}