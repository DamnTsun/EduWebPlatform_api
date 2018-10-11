<?php

class Model_Subject extends Model {

    public function getAllSubjects($count, $offset) {
        $this->setPDOPerformanceMode(false);
        return $results = $this->query(
            "SELECT
                subjects.id,
                subjects.name
            FROM
                subjects
            ORDER BY
                subjects.name
            LIMIT :_count OFFSET :_offset",
            array(
                ':_count' => $count,
                ':_offset' => $offset
            ),
            Model::TYPE_FETCHALL
        );
    }

    public function checkSubjectExists($subjectName) {
        return sizeof($this->query(
            "SELECT
                subjects.id
            FROM
                subjects
            WHERE
                subjects.name = :_name
            LIMIT 1",
            array(
                ':_name' => $subjectName
            ),
            Model::TYPE_FETCHALL
        )) > 0;
    }
}