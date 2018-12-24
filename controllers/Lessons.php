<?php

class Lessons extends Controller {

    /**
     * Initializes new instace on Lessons controllers.
     * Automatically gets instance of lessons model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['lessons'];
        $this->db = new Model_Lesson();
    }


    /**
     * Check whether lesson with given id exists, within the given toic, within the given subject.
     * @param subjectid - subject lesson is in. (via topic)
     * @param topicid - topic lesson is in.
     * @param lessonid - id of lesson.
     */
    public function checkLessonExists($subjectid, $topicid, $lessonid) {
        // Check lesson exists.
        $results = $this->db->checkLessonExistsByID($subjectid, $topicid, $lessonid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether topic with given id exists and is within given subject.
     * @param subjectid - subject topic is in.
     * @param topicid - id of topic.
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
     * @param subjectid - subject topic is in.
     * @param topicid - id of topic.
     */
    public function getAllLessonsByTopic($subjectid, $topicid) {
        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            http_response_code(404); return;
        }

        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getLessonsByTopic($subjectid, $topicid, $count, $offset);
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
     * @param subjectid - subject lesson is in. (via topic)
     * @param topicid - topic lesson is in.
     * @param lessonid - id of lesson.
     */
    public function getLessonByID($subjectid, $topicid, $lessonid) {
        // Attempt query.
        $results = $this->db->getLessonByID($subjectid, $topicid, $lessonid);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }
        // Check found.
        if (sizeof($results) == 0) {
            http_response_code(404); return;
        }


        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }





    /**
     * Creates new lesson record inside the given topic.
     * @param subject - subject topic is within.
     * @param topicid - id of topic.
     */
    public function createLesson($subjectid, $topicid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check JSON sent as POST param.
        if (!isset($_POST['content'])) {
            $this->printMessage('`content` parameter not given in POST body.');
            http_response_code(400); return;
        }

        // Validate JSON.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            http_response_code(400); return;
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
            $this->printMessage('Lesson with name `' . $name . '` already exists in the specified topic.');
            http_response_code(400); return;
        }

        // Attempt to create.
        $result = $this->db->addLesson($topicid, $name, $body);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to add lesson.');
            http_response_code(500); return;
        }

        // Get newly created lesson and return it.
        $record = $this->db->getLessonByID($result);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Lesson was created, but cannot be retreived.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Modifies existing lesson
     * @param subjectid - subject the lesson is within. (via topic)
     * @param topicid - topic the lesson is within.
     * @param lessonid - id of lesson.
     */
    public function modifyLesson($subjectid, $topicid, $lessonid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check lesson exists.
        if (!$this->checkLessonExists($subjectid, $topicid, $lessonid)) {
            $this->printMessage('Specified lesson does not exist.');
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
        $name =             (isset($json['name'])) ? $json['name'] : null;
        $body =             (isset($json['body'])) ? $json['body'] : null;
        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($name, $body) ) == null) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }


        // Attempt query.
        $result = $this->db->modifyLesson($lessonid, $name, $body);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update lesson.');
            http_response_code(500); return;
        }

        // Get updated resource and return it.
        $record = $this->db->getLessonByID($subjectid, $topicid, $lessonid);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Lesson was updated, but cannot be retrieved.');
            http_response_code(500); return;
        }

        $this->printJSON($this->formatRecords($record));
        http_response_code(200);
    }





    /**
     * Deletes lesson with the given id.
     * @param subjectid - subject lesson is in. (via topic)
     * @param topicid - topic lesson is in.
     * @param lessonid - id of lesson.
     */
    public function deleteLesson($subjectid, $topicid, $lessonid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check lesson exists.
        if (!$this->checkLessonExists($subjectid, $topicid, $lessonid)) {
            $this->printMessage('Specified lesson does not exists.');
            http_response_code(404); return;
        }

        // Attempt to delete.
        $result = $this->db->deleteLesson($lessonid);
        if (!$result) {
            $this->printMessage('Something went wrong. Unable to delete lesson.');
            http_response_code(500); return;
        }
        // Success.
        http_response_code(200);
    }





    /**
     * Formats records so they look better.
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