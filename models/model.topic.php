<?php

class Model_Topic extends Model {

    public function getAllTopics() {
        return $results = $this->query(
            "SELECT
                topics.id,
                topics.name,
                topics.imageUrl
            FROM
                topics
            ORDER BY
                topics.id ASC",
            null,
            Model::TYPE_FETCHALL
        );
    }

    public function addTopic() {
        // Not implemented.
    }

    public function deleteTopic() {
        // Not implemented.
    }
}