<?php

class Model_User_Test extends Model {

    public function checkQuestionsInTest($testid, $questionids) {
        // Holds parameters, and the IN part of query. (testquestions.id IN ( x, y, z ))
        $queryParams = array();
        $INsubstring = '(';
        // build question ids IN substring and add necessary params to array.
        for ($i = 0; $i < sizeof($questionids); $i++) {
            // Add ', ' if queryParams contains 1 or more items. (To separate IN substring.)
            if (sizeof($queryParams) > 0) { $INsubstring = $INsubstring . ', '; }

            // Add param to substring. (:_0, :_1, etc)
            $INsubstring = $INsubstring . ':_' . $i;
            // Set param. (:_0 = $questionids[0], etc)
            $queryParams[':_' . $i] = $questionids[$i];
        }
        // End substring.
        $INsubstring = $INsubstring . ')';

        // Add testid param.
        $queryParams[':_testid'] = $testid;

        // Do query.
        try {
            return $this->query(
                "SELECT
                    COUNT(testQuestions.id) AS 'COUNT'
                FROM
                    testQuestions
                WHERE
                    testQuestions.id IN " . $INsubstring . "
                    AND
                    testQuestions.test_id = :_testid",
                $queryParams,
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets a user_test by id, associated with a specific user.
     * @param userid - id of user.
     * @param user_testid - id of user_test
     */
    public function getUserTestByID($userid, $user_testid) {
        try {
            return $this->query(
                "SELECT
                user_tests.id AS 'User_Test id',
                user_tests.title,
                user_tests.date,
                tests.id AS 'Test id',
                (
                    SELECT
                        COUNT(user_testquestions.id)
                       FROM
                        user_testquestions
                    WHERE
                        user_testquestions.user_Test_id = user_tests.id
                ) AS 'QuestionCount',
                (
                    SELECT
                        COUNT(user_testquestions.id)
                    FROM
                        user_testquestions
                    JOIN
                        testquestions
                    ON
                        user_testquestions.testQuestion_id = testquestions.id
                    WHERE
                        user_testquestions.user_Test_id = user_tests.id
                        AND
                        user_testquestions.userAnswer = testquestions.answer
                ) AS 'Score'
            FROM
                user_tests,
                tests
            WHERE
                user_tests.id = :_user_testid
                AND
                user_tests.user_id = :_userid
                AND
                tests.id = user_tests.test_id",
                array(
                    ':_user_testid' => $user_testid,
                    ':_userid' => $userid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Creates a new user_tests record with given title, test_id and user_id.
     * Then adds user_testQuestion records, associated with user_tests record, for given question ids / answers.
     * @param title - title for user_test.
     * @param testid - test_id for user_test.
     * @param userid - user_id for user_test.
     * @param questionids - ids of questions for each user_testQuestions record.
     * @param answers - answers of questions for each user_testQuestions record.
     */
    public function addUserTest($title, $testid, $userid, $questionids, $answers) {
        // Create user test.
        $user_testid = $this->addUserTestRecord($title, $testid, $userid);
        // Check successful.
        if (!isset($user_testid)) { return null; }

        // Create the user_testQuestions records for user_test.
        $results = $this->addUserTestQuestionRecords($user_testid, $questionids, $answers);
        if (!isset($results)) { return null; }

        // Get and return created user_test.
        return $this->getUserTestByID($userid, $user_testid);
    }
    
    /**
     * Creates new user_test for specific test and user.
     * @param title - title for user_test.
     * @param testid - test_id for user_test.
     * @param userid - user_id for user_test.
     */
    private function addUserTestRecord($title, $testid, $userid) {
        try {
            return $this->query(
                "INSERT INTO
                    user_tests
                (
                    title, test_id, user_id
                )
                VALUES
                ( :_title, :_testid, :_userid )",
                array(
                    ':_title' => $title,
                    ':_testid' => $testid,
                    ':_userid' => $userid
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    
    /**
     * Adds a number of user_testQuestons records, based on number of question ids / answers given.
     * @param user_testid - id of user_test.
     * @param questionids - ids of test question being answers.
     * @param questionanswers - users answers to test questions.
     */
    private function addUserTestQuestionRecords($user_testid, $questionids, $questionanswers) {
        // Should be same number of ids and answers.
        if (sizeof($questionids) !== sizeof($questionanswers)) { return null; }
        $queryParams = array();
        $valuesPart = '';

        // Add each id / answer.
        for ($i = 0; $i < sizeof($questionids); $i++) {
            // Add ', ' if not first part. (to separate elements)
            if (sizeof($queryParams) > 0) { $valuesPart = $valuesPart . ', '; }

            // Add VALUES substring. ( user_testid, testQuestion_id, userAnswer )
            $valuesPart = $valuesPart . '( :_user_testid, :_qid' . $i . ', :_qa' . $i . ' )';

            // Add id and answer to params array.
            $queryParams[':_qid' . $i] = $questionids[$i];
            $queryParams[':_qa' . $i] = $questionanswers[$i];
        }

        // Add user_testid to params list.
        $queryParams[':_user_testid'] = $user_testid;

        try {
            return $this->query(
                "INSERT INTO
                    user_testQuestions
                (
                    user_Test_id, testQuestion_id, userAnswer
                )
                VALUES
                " . $valuesPart,
                $queryParams,
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}