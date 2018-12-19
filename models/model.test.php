<?php

class Model_Test extends Model {

    /**
     * Checks if a test exists with the given name and topic_id.
     * @param topic_id - topic_id of test being looked for.
     * @param name - name of test being looked for.
     */
    public function checkTestExists($topic_id, $name) {
        try {
            return $results = $this->query(
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
     * Checks if a test exists with the given id and topic_id.
     * @param topic_id - topic_id of test being looked for.
     * @param testid - id of test being looked for.
     */
    public function checkTestExistsByID($topic_id, $testid) {
        try {
            return $results = $this->query(
                "SELECT
                    tests.id
                FROM
                    tests
                WHERE
                    tests.topic_id = :_topicid
                    AND
                    tests.id = :_id
                LIMIT 1",
                array(
                    ':_topicid' => $topic_id,
                    ':_id' => $testid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }
    




    /**
     * Gets all tests with the given topic_id.
     * @param topicid - topic_id of tests being looked for.
     * @param count - Number of records to be returned. - Optional, default 10.
     * @param offset - Number of records to skip when getting records. - Optional, default 0.
     */
    public function getTestsByTopic($topicid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description
                FROM
                    tests
                WHERE
                    tests.topic_id = :_topicid
                LIMIT :_count OFFSET :_offset",
                array(
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
     * Gets test record with given id.
     * @param id - id of test record to be looked for.
     */
    public function getTestByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    tests.id,
                    tests.name,
                    tests.description
                FROM
                    tests
                WHERE
                    tests.id = :_id
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





    /**
     * Creates a new test record with the given values.
     * @param topic_id - value for topic_id field of new record.
     * @param name - value for name field of new record.
     * @param description - value for description field of new record.
     */
    public function addTest($topic_id, $name, $description) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    tests (name, description, topic_id)
                VALUES
                    (
                        :_name,
                        :_description,
                        :_topic_id
                    )",
                array(
                    ':_name' => $name,
                    ':_description' => $description,
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
     */
    public function modifyTest($id, $name, $description) {
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