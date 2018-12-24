<?php

class Model_TestQuestion extends Model {


    /**
     * Checks if a test question exists with the given question, in the given test.
     * @param testid - id of test.
     * @param question - question of testQuestion record.
     */
    public function checkTestQuestionExists($testid, $question) {
        try {
            return $this->query(
                "SELECT
                    testQuestions.id
                FROM
                    testQuestions
                WHERE
                    testQuestions.test_id = :_testid
                    AND
                    testQuestions.question = :_question",
                array(
                    ':_testid' => $testid,
                    ':_question' => $question
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }
    

    /**
     * Checks if a test question exists with the given id, in the given test, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     * @param questionid - id of question.
     */
    public function checkTestQuestionExistsByID($subjectid, $topicid, $testid, $questionid) {
        try {
            return $results = $this->query(
                "SELECT
                    testQuestions.id
                FROM
                    testQuestions
                WHERE
                    testQuestions.id = :_id
                    AND
                    testQuestions.test_id = (
                        SELECT
                            tests.id
                        FROM
                            tests
                        WHERE
                            tests.id = :_testid
                            AND
                            tests.topic_id = (
                                SELECT
                                    topics.id
                                FROM
                                    topics
                                WHERE
                                    topics.id = :_topicid
                                    AND
                                    topics.subject_id = :_subjectid
                            )
                    )",
                array(
                    ':_id' => $questionid,
                    ':_testid' => $testid,
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
     * Gets all test questions in the given test, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     * @param count - number of records to be returned. - Optional, default 10.
     * @param offset - number of records to be skipped. - Optional, default 0.
     */
    public function getTestQuestionsByTest($subjectid, $topicid, $testid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    testQuestions.id,
                    testQuestions.question,
                    testQuestions.answer,
                    testQuestions.imageUrl
                FROM
                    testQuestions
                WHERE
                    testQuestions.test_id = (
                        SELECT
                            tests.id
                        FROM
                            tests
                        WHERE
                            tests.id = :_testid
                            AND
                            tests.topic_id = (
                                SELECT
                                    topics.id
                                FROM
                                    topics
                                WHERE
                                    topics.id = :_topicid
                                    AND
                                    topics.subject_id = :_subjectid
                            )
                    )
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_testid' => $testid,
                    ':_topicid' => $topicid,
                    ':_subjectid' => $subjectid,
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
     * Gets test question record with given id, in the given test, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     * @param questionid - id of question.
     */
    public function getTestQuestionByID($subjectid, $topicid, $testid, $questionid) {
        try {
            return $this->query(
                "SELECT
                    testQuestions.id,
                    testQuestions.question,
                    testQuestions.answer,
                    testQuestions.imageUrl
                FROM
                    testQuestions
                WHERE
                    testQuestions.id = :_questionid
                    AND
                    testQuestions.test_id = (
                        SELECT
                            tests.id
                        FROM
                            tests
                        WHERE
                            tests.id = :_testid
                            AND
                            tests.topic_id = (
                                SELECT
                                    topics.id
                                FROM
                                    topics
                                WHERE
                                    topics.id = :_topicid
                                    AND
                                    topics.subject_id = :_subjectid
                            )
                    )",
                array(
                    ':_questionid' => $questionid,
                    ':_testid' => $testid,
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
     * Creates a new test question record with given values.
     * @param test_id - test_id for test question.
     * @param question - question for test question.
     * @param answer - answer for test question.
     * @param imageUrl - imageUrl for test question.
     */
    public function addTestQuestion($test_id, $question, $answer, $imageUrl) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    testQuestions (question, answer, imageUrl, test_id)
                VALUES
                    (
                        :_question,
                        :_answer,
                        :_imageUrl,
                        :_testid
                    )",
                array(
                    ':_question' => $question,
                    ':_answer' => $answer,
                    ':_imageUrl' => $imageUrl,
                    ':_testid' => $test_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Modifies values of existing test question.
     * @param id - id of test question.
     * @param question - question for test question.
     * @param answer - answer for test question.
     * @param imageUrl - imageUrl for test question.
     */
    public function modifyTestQuestion($id, $question, $answer, $imageUrl) {
        // Build string with variable number of fields.
        $queryString = "UPDATE testQuestions SET ";
        $queryParams = array();
        // question
        if (isset($question)) {
            $queryString = $queryString . "testQuestions.question = :_question";
            $queryParams[':_question'] = $question;
        }
        // answer
        if (isset($answer)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "testQuestions.answer = :_answer";
            $queryParams[':_answer'] = $answer;
        }
        // imageUrl
        if (isset($imageUrl)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "testQuestions.imageUrl = :_imageUrl";
            $queryParams[':_imageUrl'] = $imageUrl;
        }
        // end query string.
        $queryString = $queryString . " WHERE testQuestions.id = :_id LIMIT 1";
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
     * Delete the test question record with given id.
     * @param id - id of record to be deleted.
     */
    public function deleteTestQuestion($id) {
        try {
            return $results = $this->query(
                "DELETE FROM
                    testQuestions
                WHERE
                    testQuestions.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}