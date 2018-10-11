<?php

class Model_Topic extends Model {

    public function getTopicsBySubject($subjectName, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try{
            return $results = $this->query(
                "SELECT
                    topics.id,
                    topics.name,
                    topics.imageUrl
                FROM
                    topics
                WHERE
                    topics.subject_id = (
                        SELECT
                            subjects.id
                        FROM
                            subjects
                        WHERE
                            subjects.name = :_name
                        LIMIT 1
                    )
                ORDER BY
                    topics.name
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_name' => $subjectName,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addTopic($subjectName, $name, $imageUrl) {
        try {
            return $result = $this->query(
                "INSERT INTO
                    topics (name, imageUrl, subject_id)
                VALUES
                    (
                        :_name,
                        :_imageUrl,
                        (
                            SELECT
                                subjects.id
                            FROM
                                subjects
                            WHERE
                                subjects.name = :_subjectName
                            LIMIT 1
                        )
                    )", 
                array(
                    ':_name' => $name,
                    ':_imageUrl' => $imageUrl,
                    ':_subjectName' => $subjectName
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return false;
        }
    }
}