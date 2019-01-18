<?php

class User_Tests extends Controller {

    /**
     * Initializes new instance of User_Tests controller.
     * Automatically gets instance of user_test model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['user_tests'];
        $this->db = new Model_User_Test();
    }




    // TESTING CURRENTLY
    public function createUserTest() {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check JSON given as POST param
        if (!isset($_POST['content'])) {
            $this->printMessage('`content` parameter not given in POST body.');
            http_response_code(400); return;
        }
        // Check JSON given is valid.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            http_response_code(400); return;
        }

        // Set values. (all required)
        $title =        $json['title'];
        $testid =      $json['test_id'];
        // Add each question.
        $questionids = array();
        $questionanswers = array();
        foreach ($json['questions'] as $q) {
            array_push($questionids, $q['id']);
            array_push($questionanswers, $q['answer']);
        }

        // Check given questions are inside of given test. (by ids)
        $results = $this->db->checkQuestionsInTest($testid, $questionids);
        if (!isset($results) || !isset($results[0]) || !isset($results[0]['COUNT'])) {
            $this->printMessage('Something went wrong. Unable to validate given questions.');
            http_response_code(500); return;
        }
        // Check number of found questions is same as number of questions given.
        if ((int)$results[0]['COUNT'] !== sizeof($questionids)) {
            $this->printMessage('You have given questions which are not inside of the specified test.');
            http_response_code(400); return;
        }


        // Create user_tests record.
        $userTest = $this->db->addUserTest($title, $testid, $user['id'], $questionids, $questionanswers);
        if (!isset($userTest)) {
            $this->printMessage('Somethign went wrong. Unable to add user_test.');
            http_response_code(500); return;
        }
        
        $this->printJSON($this->formatRecords($userTest));
        http_response_code(201);
    }





    /**
     * Deletes ALL of the user tests associated with the current user. (Based on idToken header)
     */
    public function deleteAllCurrentUserUserTests() {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Attempt query.
        $result = $this->db->deleteAllUserTests($user['id']);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to delete user tests.');
            http_response_code(500); return;
        }
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
                    'id' => (int)$rec['User_Test id'],
                    'title' => $rec['title'],
                    'date' => $rec['date'],
                    'questionCount' => (int)$rec['QuestionCount'],
                    'score' => (int)$rec['Score'],
                    'test_id' => (int)$rec['Test id']
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

        // Check it has required fields, and they are correct type (were necessary).
        // Check object actually set...
        if (!isset($object)) {
            return null;
        }
        // Title.
        if (!isset($object['title'])) { return null; }
        // Test id (int).
        if (!isset($object['test_id'])) { return null; }
        if (gettype($object['test_id']) != 'integer') { return null; }
        // Questions.
        if (!isset($object['questions'])) { return null; }
        if (gettype($object['questions']) != 'array') { return null; }
        if (sizeof($object['questions']) == 0) { return null; }
        // Inside of questions array...
        foreach ($object['questions'] as $q) {
            // question id (int).
            if (!isset($q['id'])) { return null; }
            if (gettype($q['id']) != 'integer') { return null; }
            // question answers.
            if (!isset($q['answer'])) { return null; }
        }

        return $object;
    }
}

/* Structure of content when adding a user test:
{
    "name": "...",      // User defined name for this user test.
    "test_id": n,       // Id of test this user_test is based on.
    "questions": [      // The questions in the test.
        {
            "id": m,            // Id of question being answered.
            "answer": "..."     // Users answer to the question.
        },
        ...
    ]
}
User id should be automatically added.
test_id and id of each question should be checked, to ensure all questions are inside of specified test.


// Checking question id correspond to a test. (Do before adding user_test record)
SELECT
    COUNT(testQuestions.id) AS 'count'
FROM
    testQuestions
WHERE
    testQuestions.id IN ( 1, 2, 3, ... )
    AND
    testQuestions.test_id = 1

Reject if 'count' is less than the number of ids given for the IN part.
19, 6, not 7...





// Queries (user params...)
// Inserting a user_test:
INSERT INTO
    user_tests
(
    title,
    test_id,
    user_id
)
VALUES
(
    'test01',
    1,
    1
)



// Inserting user_testQuestions (ex. 3) (get user_test insert id first!!!):
INSERT INTO
    user_testQuestions
(
    testQuestion_id,
    userAnswer,
    user_Test_id
)
VALUES
( 1, '19', 1 ),
( 2, '6', 1 ),
( 3, '11', 1 )



// Getting user_testQuestions and corresponding testQuestion data, and whether the user answer was correct.
SELECT
	user_testquestions.id,
    testquestions.question,
    testquestions.answer,
    user_testquestions.userAnswer,
    (testquestions.answer = user_testquestions.userAnswer) as 'Correct'
FROM
	user_testquestions,
    testquestions
WHERE
	user_testquestions.user_Test_id = 1
    AND
    testquestions.id = user_testquestions.testQuestion_id



// Getting user_test, with questionCount, and score.
SELECT
	user_tests.id,
    user_tests.title,
    user_tests.date,
    tests.name AS 'Test Name',
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
	user_tests.user_id = 1
    AND
    tests.id = user_tests.test_id


*/