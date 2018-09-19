<?php

class Model_Test extends Test {

    public function getTest($user_id, $test_id) {
        $result = $this->query(
            "SELECT
                tests.title,
                (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = test.id) AS 'Questions',
                (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = test.id AND questions.userAnswer = questions.answer) AS 'Score',
                tests.date
            FROM
                tests
            WHERE
                tests.user_id = :userId AND tests.id = :testId
            ORDER BY
                tests.date DESC",
            array(
                ':userId' => $user_id,
                ':testId' => $test_id
            ),
            Model::TYPE_FETCH
        );
        return $result;
    }

    public function getTests($user_id, $count = 10, $offset = 0) {
        $result = $this->query(
            "SELECT
                tests.title,
                (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = test.id) AS 'Questions',
                (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = test.id AND questions.userAnswer = questions.answer) AS 'Score',
                tests.date
            FROM
                tests
            WHERE
                tests.user_id = :userId
            ORDER BY
                tests.date DESC",
            array(':userId' => $user_id),
            Model::TYPE_FETCHALL
        );
        return $result;
    }
}