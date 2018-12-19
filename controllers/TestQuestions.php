<?php

class TestQuestions extends Controller {

    /**
     * Initializes new instance of TestQuestions controller.
     * Automatically gets instance of testQuestions model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['test_questions'];
        $this->db = new Model_TestQuestion();
    }


    /**
     * Checks whether test question with given id exists,
     *  within the given test, within the given topic, within the given subject.
     * @param subjectid - id of subject the question is in. (via topic)
     * @param topicid - id of topic the question is in. (via test)
     * @param testid - id of test the question is in.
     * @param testquestionid - id of question.
     */
    public function checkTestQuestionExists($subjectid, $topicid, $testid, $testquestionid) {
        // Check test is within given topic.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) { return false; }
        // Check test question is within given test.
        $results = $this->db->checkTestQuestionExistsByID($testid, $testquestionid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether test with given id exists, within the given topic, within the given subject.
     * @param subjectid - id of subject the test is in. (via topic)
     * @param topicid - id of topic the test is in.
     * @param testid - id of test.
     */
    public function checkTestExists($subjectid, $topicid, $testid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['tests'];
        $testsController = new Tests();
        $results = $testsController->checkTestExists($subjectid, $topicid, $testid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets all test questions within the given test.
     * @param subjectid - subject test questions are inside of. (via topic)
     * @param topicid - topic test questions are inside of. (via test)
     * @param testid - test test questions are inside of.
     */
    public function getAllTestQuestionsByTest($subjectid, $topicid, $testid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Validate id values.
        // subjectid
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        // topicid
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


        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getTestQuestionsByTest($testid, $count, $offset);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Gets the test question with the given id, in the given test, in the given topic, in the given subject.
     * @param subjectid - subject test question is in. (via topic)
     * @param topicid - topic test question is in. (via test)
     * @param testid - test test question is in.
     * @param testquestionid - id of test question.
     */
    public function getTestQuestionByID($subjectid, $topicid, $testid, $testquestionid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Validate id values.
        // subjectid
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        // topicid
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        // testid
        if (!isset($testid) || !App::stringIsInt($testid)) {
            http_response_code(400); return;
        }
        // testquestionid
        if (!isset($testquestionid) || !App::stringIsInt($testquestionid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;
        $topicid = (int)$topicid;
        $testid = (int)$testid;
        $testquestionid = (int)$testquestionid;

        // Check testquestion exists.
        if (!$this->checkTestQuestionExists($subjectid, $topicid, $testid, $testquestionid)) {
            http_response_code(404); return;
        }


        // Attempt query.
        $results = $this->db->getTestQuestionByID($testquestionid);
        // Check successful.
        if (!isset ($results)) {
            http_response_code(400); return;
        }


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Creates a new test question record.
     * @param subjectid - id of subject that the test question is being added to. (via topic)
     * @param topicid - id of topic that the test question is being added to. (via test)
     * @param testid - id of test that the test question is being added to.
     */
    public function createTestQuestion($subjectid, $topicid, $testid) {
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
        $question =         $json['question']; // Required.
        $answer =           $json['answer']; // Required.
        $imageUrl =         (isset($json['imageUrl'])) ? $json['imageUrl'] : '';

        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            $this->printMessage('Specified test does not exists.');
            http_response_code(400); return;
        }
        

        // Attempt to create.
        $results = $this->db->addTestQuestion($testid, $question, $answer, $imageUrl);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to add test.');
            http_response_code(500); return;
        }

        // Get newly created test question and return it.
        $record = $this->db->getTestQuestionByID($results);
        if (!isset($record)) {
            $this->printMessage('something went wrong. Test question was created, but cannot be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
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
                    'question' => $rec['question'],
                    'answer' => $rec['answer'],
                    'imageUrl' => $rec['imageUrl']
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
            !isset($object['question']) ||
            !isset($object['answer'])) {
            return null;
        }
        return $object;
    }
}