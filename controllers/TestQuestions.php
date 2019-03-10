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
        // Check test question is within given test.
        $results = $this->db->checkTestQuestionExistsByID($subjectid, $topicid, $testid, $testquestionid);
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

        
        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            http_response_code(404); return;
        }


        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getTestQuestionsByTest($subjectid, $topicid, $testid, $count, $offset);
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
    public function getTestQuestionByID($subjectid, $topicid, $testid, $questionid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }
        
        // Attempt query.
        $results = $this->db->getTestQuestionByID($subjectid, $topicid, $testid, $questionid);
        // Check successful.
        if (!isset ($results)) {
            http_response_code(400); return;
        }
        if (sizeof($results) == 0) {
            http_response_code(404); return;
        }


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Gets test questions, chosen randomly, inside a specific test, inside a specific topic,
     *  inside a specific subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     */
    public function getRandomTestQuestionsByTest($subjectid, $topicid, $testid) {
        // Check user signed into a session. Admin NOT required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Get count as GET parameter. Default to 10. Param must be int.
        $count = App::getGETParameter('count', 10, true);
        if ($count < 1) {
            $count = 1;
        }

        // Attempt to get questions.
        $results = $this->db->getRandomTestQuestionsByTest($subjectid, $topicid, $testid, $count);
        if (!isset($results)) {
            http_response_code(500); return;
        }
        if (sizeof($results) == 0) {
            http_response_code(404); return;
        }


        // Format and display results.
        $this->printJSON($this->formatRecords($results));
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


        // validate values
        $validate = $this->validateValues($question, $answer, $imageUrl);
        if (isset($validate)) {
            $this->printMessage($validate);
            http_response_code(400); return;
        }

        // Check test exists.
        if (!$this->checkTestExists($subjectid, $topicid, $testid)) {
            $this->printMessage('Specified test does not exists.');
            http_response_code(400); return;
        }

        // Check no question with 'question' and test id.
        if ($this->db->checkTestQuestionExists($testid, $question)) {
            $this->printMessage('Test question with question value `' . $question . '` already exists in the specified test.');
            http_response_code(400); return;
        }
        

        // Attempt to create.
        $results = $this->db->addTestQuestion($testid, $question, $answer, $imageUrl);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to add test.');
            http_response_code(500); return;
        }

        // Get newly created test question and return it.
        $record = $this->db->getTestQuestionByID($subjectid, $topicid, $testid, $results);
        if (!isset($record)) {
            $this->printMessage('something went wrong. Test question was created, but cannot be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }




    /**
     * Modifies existing test question, in the given test, in the given topic, in the given subject.
     * @param subjectid - id of subject.
     * @param topicid - id of topic.
     * @param testid - id of test.
     * @param testquestionid - id of question.
     */
    public function modifyTestQuestion($subjectid, $topicid, $testid, $testquestionid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check test exists.
        if (!$this->checkTestQuestionExists($subjectid, $topicid, $testid, $testquestionid)) {
            $this->printMessage('Specified test question does not exist.');
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
        $question =             (isset($json['question'])) ? $json['question'] : null;
        $answer =               (isset($json['answer'])) ? $json['answer'] : null;
        $imageUrl =             (isset($json['imageUrl'])) ? $json['imageUrl'] : null;
        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($question, $answer, $imageUrl) ) == null) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }


        // validate values
        $validate = $this->validateValues($question, $answer, $imageUrl);
        if (isset($validate)) {
            $this->printMessage($validate);
            http_response_code(400); return;
        }

        // Check no test question exists with testid and question value.
        if ($this->db->checkTestQuestionExists($testid, $question)) {
            $this->printMessage('Test question with question value `' . $question . '` already exists in the specified test.');
            http_response_code(400); return;
        }


        // Attempt query.
        $result = $this->db->modifyTestQuestion($testquestionid, $question, $answer, $imageUrl);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update test question.');
            http_response_code(500); return;
        }

        // Get updated resource and return it.
        $record = $this->db->getTestQuestionByID($subjectid, $topicid, $testid, $testquestionid);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Test question was updated, but cannot be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(200);
    }





    /**
     * Deletes test question with given id.
     * @param subjectid - id of subject that the test question is in. (via topic)
     * @param topcid - id of topic that the test question is in. (via test)
     * @param testid - id of test that the test question is in.
     * @param testquestionid - id of test question being deleted.
     */
    public function deleteTestQuestion($subjectid, $topicid, $testid, $testquestionid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check test exists.
        if (!$this->checkTestQuestionExists($subjectid, $topicid, $testid, $testquestionid)) {
            $this->printMessage('Specified test question does not exists.');
            http_response_code(404); return;
        }

        // Attempt to delete.
        $result = $this->db->deleteTestQuestion($testquestionid);
        if (!$result) {
            $this->printMessage('Something went wrong. Unable to delete test.');
            http_response_code(500); return;
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
            // Build array for pushing. Question may or may not be included.
            $arr = array();
            $arr['id'] = (int)$rec['id'];
            $arr['question'] = $rec['question'];
            if (isset($rec['answer'])) { $arr['answer'] = $rec['answer']; }
            $arr['imageUrl'] = $rec['imageUrl'];

            array_push(
                $results,
                $arr
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



    /**
     * Validates values. Returns message if invalid. Returns null if valid.
     */
    protected function validateValues($question, $answer, $imageUrl) {
        // QUESTION
        if (isset($question)) {
            if (strlen($question) == 0) { return 'Answer cannot be blank.'; }
            if (strlen($question) > 255) { return 'Answer cannot be longer than 255 characters.'; }
        }
        // ANSWER
        if (isset($answer)) {
            if (strlen($answer) == 0) { return 'Answer cannot be blank.'; }
            if (strlen($answer) > 255) { return 'Answer cannot be longer than 255 characters.'; }
        }
        // IMAGEURL
        if (isset($imageUrl)) {
            if (strlen($imageUrl) > 255) { return 'Image Url cannot be longer than 255 characters.'; }
        }
        return null;
    }
}