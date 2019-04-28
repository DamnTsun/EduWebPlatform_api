<?php

class Model_User_Test_Question extends Model {


    /**
     * Gets user_testquestions inside a specific user_test, associated with a specific user.
     * @param userid - id of user.
     * @param subjectid - id of subject that user_test associated with (via topic).
     * @param topicid - id of topic that user_test is associated with (via test).
     * @param testid - id of test that user_test is associated with.
     * @param utestid - id of user_test.
     */
    public function getUserTestQuestionsByUserTest($userid, $subjectid, $topicid, $testid, $utestid) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    testQuestions.question,
                    user_TestQuestions.userAnswer,
                    testQuestions.answer AS 'correctAnswer'
                FROM
                    user_TestQuestions
                JOIN testQuestions ON
                    testQuestions.id = user_TestQuestions.testQuestion_id
                WHERE
                    -- Require association with specified user_test
                    user_TestQuestions.user_Test_id = (
                        SELECT
                            user_tests.id
                        FROM
                            user_tests
                        WHERE
                            user_tests.id = :_utestid
                            AND
                            -- Require association with specified user.
                            user_tests.user_id = :_userid
                            AND
                            -- Check user_test is associated with given test.
                            user_tests.test_id = (
                                SELECT
                                    tests.id
                                FROM
                                    tests
                                WHERE
                                    tests.id = :_testid
                                    AND
                                    -- Check test is associated with given topic.
                                    tests.topic_id = (
                                        SELECT
                                            topics.id
                                        FROM
                                            topics
                                        WHERE
                                            topics.id = :_topicid
                                            AND
                                            -- Check topic is associated with given subject.
                                            topics.subject_id = :_subjectid
                                    )
                            )
                    )",
                array(
                    ':_userid' => $userid,
                    ':_subjectid' => $subjectid,
                    ':_topicid' => $topicid,
                    ':_testid' => $testid,
                    ':_utestid' => $utestid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}