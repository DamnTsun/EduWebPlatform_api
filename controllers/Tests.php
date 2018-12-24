<?php

class Tests extends Controller {

    /**
     * Initializes new instance of Tests controller.
     * Automatically gets instance of tests model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['tests'];
        $this->db = new Model_Test();
    }


    /**
     * Checks whether test with given id exists, within the given topic, within the given subject.
     * @param subjectid - id of subject the topic is supposedly in.
     * @param topicid - id of topic the test is supposedly in.
     * @param testid - id of test being checked.
     */
    public function checkTestExists($subjectid, $topicid, $testid) {
        // Check test is within the topic.
        $results = $this->db->checkTestExistsByID($subjectid, $topicid, $testid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether topic with given id exists, within the given subject.
     * @param subjectid - id of subject the topic is supposedly in.
     * @param topicid - id of topic being checked.
     */
    private function checkTopicExists($subjectid, $topicid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
        $topicsController = new Topics();
        $results = $topicsController->checkTopicExists($subjectid, $topicid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets all tests within the given topic.
     * @param subjectid - subject that the test is inside of. (via its topic)
     * @param topicid - topic that the test is inside of.
     */
    public function getAllTestsByTopic($subjectid, $topicid) {
        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            http_response_code(404); return;
        }


        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getTestsByTopic($subjectid, $topicid, $count, $offset);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Gets the lesson with the given id, in the given topic, in the given subject.
     * @param subjectid - subject test is in. (via topic)
     * @param topicid - topic test is in.
     * @param testid - id of test.
     */
    public function getTestByID($subjectid, $topicid, $testid) {
        // Attempt query.
        $results = $this->db->getTestByID($subjectid, $topicid, $testid);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }
        // Check exists.
        if (sizeof($results) == 0) {
            http_response_code(404); return;
        }


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Creates a new test record.
     * @param subjectid - id of subject that the test is being added to. (via its topic)
     * @param topicid - id of topic that the test is being added to.
     */
    public function createTest($subjectid, $topicid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check JSON sent as POST param.
        if (!isset($_POST['content'])) {
            http_response_code(400);
            $this->printMessage('`content` parameter not given in POST body.');
            return;
        }

        // Validate JSON.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            return;
        }

        // Set values.
        $name =                         $json['name']; // Required
        $description =                  $json['description']; // Required.

        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            $this->printMessage('Specified topic does not exists.');
            http_response_code(404); return;
        }
        // Check no test with name and topic id.
        if ($this->db->checkTestExists($topicid, $name)) {
            $this->printMessage('Test with name `' . $name . '` already exists in the specified topic.');
            http_response_code(400); return;
        }


        // Attempt to create.
        $results = $this->db->addTest($topicid, $name, $description);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to add test.');
            http_response_code(500); return;
        }

        // Get newly created test and return it.
        $record = $this->db->getTestByID($subjectid, $topicid, $results);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Test was created, but cannot be retreived.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Modifies existing test.
     * @param subjectid - subject the test is within. (via topic)
     * @param topicid - topic the test is within.
     * @param testid - id of test.
     */
    public function modifyTest($subjectid, $topicid, $testid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            //http_response_code(401); return;
        }

        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            $this->printMessage('Specified test does not exist.');
            http_response_code(404); return;
        }

        // Check JSON sent as POST param.
        if (!isset($_POST['content'])) {
            $this->printMessage('`content` parameter not given in POST body.');
            http_response_code(400); return;
        }

        // Check JSON is valid.
        $invalid = false;
        try {
            $json = json_decode($_POST['content'], true);
            if (!isset($json)) { $invalid = true; }
        } catch (Exception $e) {
            $invalid = true;
        }
        if ($invalid) {
            $this->printMessage('`content` parameter is invalid.');
            http_response_code(400); return;
        }

        // Set values.
        $name =                 (isset($json['name'])) ? $json['name'] : null;
        $description =          (isset($json['description'])) ? $json['description'] : null;
        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($name, $description) ) == null) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }

        // Check no test with name and topic id.
        if (isset($name) && $this->db->checkTestExists($topicid, $name)) {
            $this->printMessage('Test with name `' . $name . '` already exists in the specified topic.');
            http_response_code(400); return;
        }

        // Attempt query.
        $result = $this->db->modifyTest($testid, $name, $description);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update test.');
            http_response_code(500); return;
        }

        // Get updated resource and return it.
        $record = $this->db->getTestByID($subjectid, $topicid, $testid);
        if (!isset($record)) {
            $this->printJSON('Something went wrong. Test was updated, but cannot be retrieved.');
            http_response_code(500); return;
        }

        $this->printJSON($this->formatRecords($record));
        http_response_code(200);
    }





    /**
     * Deletes test with given id.
     * @param subjectid - id of subject that the test is part of. (via its topic)
     * @param topicid - id of topic that the test is part of.
     * @param testid - id of test being deleted.
     */
    public function deleteTest($subjectid, $topicid, $testid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            http_response_code(404);
            $this->printMessage('Specified test does not exists.');
            return;
        }

        // Attempt to delete.
        $result = $this->db->deleteTest($testid);
        if (!$result) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete test.');
            return;
        }
        // Success.
        http_response_code(200);
    }





    /**
     * Formats record so they look better.
     * @param records - Records to be formatted.
     */
    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'name' => $rec['name'],
                    'description' => $rec['description']
                )
            );
        }
        return $results;
    }


    /**
     * Validates incoming JSON (for create / modify resource) so that it contains all necessary fields.
     * @param json - the json of the object.
     */
    protected function validateJSON($json) {
        // Try to parse.
        try {
            $object = json_decode($json, true);
        } catch (Exception $e) {
            return null;
        }

        // Check if has required fields.
        if (!isset($object) ||
            !isset($object['name']) ||
            !isset($object['description'])) {
            return null;
        }
        return $object;
    }
}