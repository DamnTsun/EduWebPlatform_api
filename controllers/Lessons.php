<?php

class Lessons extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['lessons'];
        $this->db = new Model_Lesson();
    }


    /**
     * Checks whether lesson with given id exists within the given topic, and that the given topic exists within the given subject.
     */
    public function checkLessonExists($subjectid, $topicid, $lessonid) {
        // Check topic is within given subject.
        if (!$this->checkTopicExists($subjectid, $topicid)) { return false; }
        // Check lesson is within subject.
        $results = $this->db->checkLessonExistsByID($topicid, $lessonid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether topic with given id exists and is within given subject.
     */
    public function checkTopicExists($subjectid, $topicid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['topics'];
        $topicsController = new Topics();
        $results = $topicsController->checkTopicExists($subjectid, $topicid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets all lessons within the given topic. (checks topic is within given subject.)
     */
    public function getAllLessonsByTopic($subjectid, $topicid) {
        // Validate $subjectid.
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;

        // Validate $topicid.
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        $topicid = (int)$topicid;

        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            http_response_code(404); return;
        }


        // Get count / offset GET params if given.
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }

        // Attempt query.
        $results = $this->db->getLessonsByTopic($topicid);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }


    /**
     * Gets the lesson with the given id in the given topic in the given subject.
     */
    public function getLessonByID($subjectid, $topicid, $lessonid) {
        // Validate $subjectid.
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;

        // Validate $topicid.
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        $topicid = (int)$topicid;
        // Validate $lessonid.
        if (!isset($lessonid) || !App::stringIsInt($lessonid)) {
            http_response_code(400); return;
        }
        $lessonid = (int)$lessonid;

        // Check lesson exists.
        if (!$this->checkLessonExists($subjectid, $topicid, $lessonid)) {
            http_response_code(404); return;
        }


        // Attempt query.
        $results = $this->db->getLessonByID($lessonid);
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
    public function createLesson($subjectid, $topicid) {
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
        if (!$this->checkTopicExists($subjectid, $topicid)) {
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
    public function deleteLesson($subjectid, $topicid, $lessonid) {
        // Get session user. They must be admin.
        //$user = $this->handleSessionUser(true);

        // Check lesson exists.
        if (!$this->checkLessonExists($subjectid, $topicid, $lessonid)) {
            http_response_code(404);
            $this->printMessage('Specified lesson does not exists.');
            return;
        }

        // Attempt to delete.
        $result = $this->db->deleteLesson($lessonid);
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