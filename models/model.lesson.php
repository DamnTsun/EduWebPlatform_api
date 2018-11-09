<?php

class Model_Lesson extends Model {

    public function getLessonsByTopic($id) {
        //$this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    lessons.id,
                    lessons.title,
                    lessons.body
                FROM
                    lessons
                WHERE
                    lessons.topic_id = :_id",
                array(':_id' => $id),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
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