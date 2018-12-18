<?php

class Lessons extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['lessons'];
        $this->db = new Model_Lesson();
    }


    /**
     * Check whether lesson with given id exists, within the given toic, within the given subject.
     */
    public function checkLessonExists($subjectid, $topicid, $lessonid) {
        // Check topic is within given subject.
        if (!$this->checkTopicExists($subjectid, $topicid)) { return false; }
        // Check lesson is within the topic.
        $results = $this->db->checkLessonExistsByID($topicid, $lessonid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether topic with given id exists and is within given subject.
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
     * Gets all lessons within the given topic. (checks topic is within given subject.)
     */
    public function getAllLessonsByTopic($subjectid, $topicid) {
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
        $results = $this->db->getLessonsByTopic($topicid, $count, $offset);
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
        // Validate id values.
        // subjectid
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        // topicid
        if (!isset($topicid) || !App::stringIsInt($topicid)) {
            http_response_code(400); return;
        }
        // lessonid
        if (!isset($lessonid) || !App::stringIsInt($lessonid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;
        $topicid = (int)$topicid;
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


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Creates new lesson record.
     */
    public function createLesson($subjectid, $topicid) {
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
        $name =                     $json['name']; // Required.
        $body =                     $json['body']; // Required.
        
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
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

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
                    'body' => addslashes($rec['body'])
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
            !isset($object['body'])) {
            return null;
        }
        return $object;
    }
}