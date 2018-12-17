<?php

class Tests extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['tests'];
        $this->db = new Model_Test();
    }


    /**
     * Checks whether test with given id exists, within the given topic, within the given subject.
     * @param $subjectid - id of subject the topic is supposedly in.
     * @param $topicid - id of topic the test is supposedly in.
     * @param $testid - id of test being checked.
     */
    public function checkTestExists($subjectid, $topicid, $testid) {
        // Check topic is within given subject.
        if (!$this->checkTopicExists($subjectid, $topicid)) { return false; }
        // Check test is within the topic.
        $results = $this->db->checkTestExistsByID($topicid, $testid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether topic with given id exists, within the given subject.
     * @param $subjectid - id of subject the topic is supposedly in.
     * @param $topicid - id of topic being checked.
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
     * @param $subjectid - subject that the test is inside of. (via its topic)
     * @param $topicid - topic that the test is inside of.
     */
    public function getAllTestsByTopic($subjectid, $topicid) {
        // Validate id values.
        // subjectid.
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        // topicid.
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;
        $topicid = (int)$topicid;
        
        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            http_response_code(404); return;
        }


        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getTestsByTopic($topicid, $count, $offset);
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
     */
    public function getTestByID($subjectid, $topicid, $testid) {
        // Validate id values.
        // subjectid.
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        // topicid.
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        // testid
        if (!isset($testid) || !App::stringIsInt($testid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;
        $topicid = (int)$topicid;
        $testid = (int)$testid;

        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            http_response_code(404); return;
        }


        // Attempt query.
        $results = $this->db->getTestByID($testid);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Creates a new test record.
     * @param $subjectid - id of subject that the test is being added to. (via its topic)
     * @param $topicid - id of topic that the test is being added to.
     */
    public function createTest($subjectid, $topicid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);

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
            http_response_code(400);
            $this->printMessage('Specified topic does not exists.');
            return;
        }
        // Check no test with name and topic id.
        if ($this->db->checkTestExists($topicid, $name)) {
            http_response_code(400);
            $this->printMessage('Test with name `' . $name . '` already exists in the specified topic.');
            return;
        }


        // Attempt to create.
        $results = $this->db->addTest($topicid, $name, $description);
        if (!isset($results)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to add test.');
            return;
        }

        // Get newly created test and return it.
        $record = $this->db->getTestByID($results);
        if (!isset($record)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Test was created, but cannot be retreived.');
            return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Deletes test with given id.
     * @param $subjectid - id of subject that the test is part of. (via its topic)
     * @param $topicid - id of topic that the test is part of.
     * @param $testid - id of test being deleted.
     */
    public function deleteTest($subjectid, $topicid, $testid) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

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
     * @param $records - Records to be formatted.
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