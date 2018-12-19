<?php

class Model_TestQuestion extends Model {

    /**
     * Checks if a test question exists with the given test_id and id.
     * @param test_id - test_id of question being looked for.
     * @param question_id - id of question being looked for.
     */
    public function checkTestQuestionExistsByID($test_id, $question_id) {
        try {
            return $results = $this->query(
                "SELECT
                    testQuestions.id
                FROM
                    testQuestions
                WHERE
                    testQuestions.test_id = :_testid
                    AND
                    testQuestions.id = :_id
                LIMIT 1",
                array(
                    ':_testid' => $test_id,
                    ':_id' => $question_id
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets all test questions with the given test_id.
     * @param testid - test_id of questions being looked for.
     * @param count - number of records to be returned. - Optional, default 10.
     * @param offset - number of records to be skipped. - Optional, default 0.
     */
    public function getTestQuestionsByTest($testid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    testQuestions.id,
                    testQuestions.content,
                    testQuestions.answer,
                    testQuestions.imageUrl
                FROM
                    testQuestions
                WHERE
                    testQuestions.test_id = :_testid
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_testid' => $testid,
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
     * Gets test question record with given id.
     * @param id - id of test question.
     */
    public function getTestQuestionByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    testQuestions.id,
                    testQuestions.content,
                    testQuestions.answer,
                    testQuestions.imageUrl
                FROM
                    testQuestions
                WHERE
                    testQuestions.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}