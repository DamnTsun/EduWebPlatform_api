<?php

class Model_Test extends Model {

    /**
     * Checks if a test exists with the given name and topic_id.
     * @param topic_id - topic_id of test being looked for.
     * @param name - name of test being looked for.
     */
    public function checkTestExists($topic_id, $name) {
        try {
            return $this->query(
                "SELECT
                    tests.id
                FROM
                    tests
                WHERE
                    tests.topic_id = :_topicid
                    AND
                    tests.name = :_name
                LIMIT 1",
                array(
                    ':_topicid' => $topic_id,
                    ':_name' => $name
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Checks if a test exists with the given id, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test being looked for.
     */
    public function checkTestExistsByID($subjectid, $topicid, $testid) {
        try {
            return $this->query(
                "SELECT
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
                    )",
                array(
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
     * Gets all tests within the given topic, within the given subject.
     * Does not get hidden tests or tests with less than 10 associated questions.
     * @param topicid - topic_id of tests being looked for.
     * @param count - Number of records to be returned. - Optional, default 10.
     * @param offset - Number of records to skip when getting records. - Optional, default 0.
     */
    public function getTestsByTopic($subjectid, $topicid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description,
                    tests.hidden,
                    (
                        SELECT
                            COUNT(testQuestions.id)
                        FROM
                            testQuestions
                        WHERE
                            testQuestions.test_id = tests.id
                    ) as 'testQuestionCount'
                FROM
                    tests
                WHERE
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
                    AND
                    -- Not hidden
                    tests.hidden != 1
                    AND
                    -- Contains at least 10 questions.
                    (
                        SELECT COUNT(testQuestions.id)
                        FROM testQuestions
                        WHERE testQuestions.test_id = tests.id
                    ) >= 10
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_subjectid' => $subjectid,
                    ':_topicid' => $topicid,
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
     * Gets all tests within the given topic, within the given subject.
     * @param topicid - topic_id of tests being looked for.
     * @param count - Number of records to be returned. - Optional, default 10.
     * @param offset - Number of records to skip when getting records. - Optional, default 0.
     */
    public function getTestsByTopicAdmin($subjectid, $topicid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description,
                    tests.hidden,
                    (
                        SELECT
                            COUNT(testQuestions.id)
                        FROM
                            testQuestions
                        WHERE
                            testQuestions.test_id = tests.id
                    ) as 'testQuestionCount'
                FROM
                    tests
                WHERE
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
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_subjectid' => $subjectid,
                    ':_topicid' => $topicid,
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
     * Gets test record with given id, in the given topic, in the given subject.
     * Does not get tests that are hidden or contain less than 10 questions.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     */
    public function getTestByID($subjectid, $topicid, $testid) {
        try {
            return $results = $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description,
                    tests.hidden,
                    (
                        SELECT
                            COUNT(testQuestions.id)
                        FROM
                            testQuestions
                        WHERE
                            testQuestions.test_id = tests.id
                    ) as 'testQuestionCount'
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
                    AND
                    -- Not hidden
                    tests.hidden != 1
                    AND
                    -- Contains at least 10 questions.
                    (
                        SELECT COUNT(testQuestions.id)
                        FROM testQuestions
                        WHERE testQuestions.test_id = tests.id
                    ) >= 10",
                array(
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
     * Gets test record with given id, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     */
    public function getTestByIDAdmin($subjectid, $topicid, $testid) {
        try {
            return $results = $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description,
                    tests.hidden,
                    (
                        SELECT
                            COUNT(testQuestions.id)
                        FROM
                            testQuestions
                        WHERE
                            testQuestions.test_id = tests.id
                    ) as 'testQuestionCount'
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
                    )",
                array(
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
     * Creates a new test record with the given values.
     * @param topic_id - value for topic_id field of new record.
     * @param name - value for name field of new record.
     * @param description - value for description field of new record.
     * @param hidden - hidden status for test.
     */
    public function addTest($topic_id, $name, $description, $hidden) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    tests (name, description, hidden, topic_id)
                VALUES
                    (
                        :_name,
                        :_description,
                        :_hidden,
                        :_topic_id
                    )",
                array(
                    ':_name' => $name,
                    ':_description' => $description,
                    ':_hidden' => $hidden,
                    ':_topic_id' => $topic_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Modifies values of existing test.
     * @param id - id of test.
     * @param name - name for test. Is ignored if null.
     * @param description - description for test. Is ignored if null.
     * @param hidden - hidden status for test.
     */
    public function modifyTest($id, $name, $description, $hidden) {
        // Build string with variable number of fields.
        $queryString = "UPDATE tests SET ";
        $queryParams = array();
        // name
        if (isset($name)) {
            $queryString = $queryString . "tests.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // description
        if (isset($description)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "tests.description = :_desc";
            $queryParams[':_desc'] = $description;
        }
        // hidden
        if (isset($hidden)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "tests.hidden = :_hidden";
            $queryParams[':_hidden'] = $hidden;
        }

        // end query string.
        $queryString = $queryString . " WHERE tests.id = :_id LIMIT 1";
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
     * Delete the test record with the given id.
     * @param id - id of record to be deleted.
     */
    public function deleteTest($id) {
        try {
            return $results = $this->query(
                "DELETE FROM
                    tests
                WHERE
                    tests.id = :_id
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