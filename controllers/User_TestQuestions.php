<?php

class User_TestQuestions extends Controller {

    /**
     * Initializes new instance of User_TestQuestions controller.
     * Automatically gets instance of user_test_question model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['user_test_questions'];
        $this->db = new Model_User_Test_Question();
    }


    /**
     * Checks if a user_test exists via User_Tests controller.
     * @param userid - id of user associated with user_test.
     * @param subjectid - id of subject user_test is associated with (via topic)
     * @param topicid - id of topic user_test is associated with (via test)
     * @param testid - id of test user_test is associated with
     * @param utestid - id of user_test.
     */
    private function checkUserTestExists($userid, $subjectid, $topicid, $testid, $utestid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['user_tests'];
        $controller = new User_Tests();
        return $controller->checkUserTestExists($userid, $subjectid, $topicid, $testid, $utestid);
    }





    /**
     * Gets user_test_questions within the given user_tests.
     * Requires that the user_test be associated with the current user. (Based on id_token header)
     * @param subjectid - id of subject user_test is associated with (via topic).
     * @param topicid - id of topic user_test is associated with (via test).
     * @param testid - id of test user_test is associated with.
     * @param utestid - id of user_test.
     */
    public function getCurrentUserUserTestQuestionsByUserTest($subjectid, $topicid, $testid, $utestid) {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Check specified user_test exists.
        if (!$this->checkUserTestExists($user['id'], $subjectid, $topicid, $testid, $utestid)) {
            http_response_code(404); return;
        }


        // Attempt to get.
        $results = $this->db->getUserTestQuestionsByUserTest($user['id'], $subjectid, $topicid, $testid, $utestid);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup user test questions for given user tests.');
            http_response_code(500); return;
        }


        // Format and output results.
        $this->printJSON($this->formatRecords($results));
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
                    'question' => $rec['question'],
                    'userAnswer' => $rec['userAnswer'],
                    'correctAnswer' => $rec['correctAnswer']
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
        // NOT IMPLEMENTED. Should not be added user_test_questions here. (See User_Tests Controller)
        throw new NotImplementedException();
    }
}