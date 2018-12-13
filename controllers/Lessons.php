<?php

class Lessons extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['lessons'];
        $this->db = new Model_Lesson();
    }


    /**
     * Gets all lessons within the given topic. (by topic_id)
     */
    public function getAllLessonsByTopic($id) {
        // Validate $id.
        if (!isset($id) || !App::stringIsInt($id)) {
            http_response_code(400); return;
        }
        $id = (int)$id;

        // Get count / offset GET params if given.
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }

        // Attempt query.
        $results = $this->db->getLessonsByTopic($id);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }


    /**
     * Gets the lesson with the given id.
     */
    public function getLessonByID($id) {
        // Validate $id.
        if (!isset($id) || !App::stringIsInt($id)) {
            http_response_code(400); return;
        }
        $id = (int)$id;

        // Attempt query.
        $results = $this->db->getLessonByID($id);
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
     * Creates new lesson record.
     */
    public function createLesson($topicid) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Get POST params.
        $name = '';
        $body = '';
        // Name (REQ)
        if (!isset($_POST['name'])) {
            http_response_code(400);
            $this->printMessage('`name` parameter not given in POST body.');
            return;
        }
        // Body (REQ)
        if (!isset($_POST['body'])) {
            http_response_code(400);
            $this->printMessage('`body` parameter not given in POST body.');
            return;
        }
        // Set values.
        $name = $_POST['name'];
        $body = $_POST['body'];


        // Check topic exists.
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
        $topicController = new Topics();
        if (!$topicController->checkTopicExists($topicid)) {
            http_response_code(400);
            $this->printMessage('Specified topic does not exists.');
            return;
        }
        // Check no lesson with name and topic id.
        if ($this->db->checkLessonExists($topicid, $name)) {
            http_response_code(400);
            $this->printMessage('Lesson with name `' . $name . '` already exists in the specified topic.');
            return;
        }

        // Attempt to create.
        $result = $this->db->addLesson($topicid, $name, $body);
        if (!isset($result)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to add lesson.');
            return;
        }

        // Get newly created lesson and return it.
        $record = $this->db->getLessonByID($result);
        if (!isset($record)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Lesson was created, but cannot be retreived.');
            return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Deletes lesson with the given id.
     */
    public function deleteLesson($topicid, $id) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Check lesson exists.
        $exists = $this->db->checkLessonExistsByID($topicid, $id);
        if (!isset($exists) || !$exists) {
            http_response_code(404);
            $this->printMessage('Specified lesson does not exists.');
            return;
        }

        // Attempt to delete.
        $result = $this->db->deleteLesson($id);
        if (!$result) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete lesson.');
            return;
        }
        // Success.
        http_response_code(200);
    }





    /**
     * Formats records so they look better.
     */
    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'name' => $rec['name'],
                    'body' => addslashes($rec['body'])
                )
            );
        }
        return $results;
    }
}