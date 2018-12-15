<?php

class Topics extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['topics'];
        $this->db = new Model_Topic();
    }


    /**
     * Checks whether topic with given id exists within the subject with the given id.
     */
    public function checkTopicExists($subjectid, $topicid) {
        $results = $this->db->checkTopicExistsByID($subjectid, $topicid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether the subject with given id exists.
     */
    public function checkSubjectExists($subjectid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
        $subjectsController = new Subjects();
        $results = $subjectsController->checkSubjectExists($subjectid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets all topics within the given subject (by subject_id)
     */
    public function getAllTopicsBySubject($id) {
        // Validate $id.
        if (!isset($id) || !App::stringIsInt($id)) {
            http_response_code(400); return;
        }
        $id = (int)$id;

        // Check subject exists.
        if (!$this->checkSubjectExists($id)) {
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
        $results = $this->db->getTopicsBySubject($id, $count, $offset);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }
        
        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }


    /**
     * Gets topic record with given id and given subject_id.
     */
    public function getTopicByID($subjectid, $topicid) {
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
            http_response_code(404);
            $this->printMessage('Specified topic does not exist.'); return;
        }

        // Attempt query.
        $results = $this->db->getTopicByID($topicid);
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
     * Creates new topic record.
     */
    public function createTopic($subjectID) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Get POST params.
        $name = '';
        $description = '';
        // Name (REQ)
        if (!isset($_POST['name'])) {
            http_response_code(400);
            $this->printMessage('`name` parameter not given in POST body.');
            return;
        }
        // Description
        if (isset($_POST['description'])) {
            $description = $_POST['description'];
        }
        $name = $_POST['name'];
        
        // Check subject exists.
        if (!$this->checkSubjectExists($subjectID)) {
            http_response_code(400);
            $this->printMessage('Specified subject does not exist.');
            return;
        }
        // Check no topic with name and subject id.
        if ($this->db->checkTopicExists($subjectID, $name)) {
            http_response_code(400);
            $this->printMessage('Topic with name `' . $name . '` already exists in the specified subject.');
            return;
        }

        // Attempt to create.
        $result = $this->db->addTopic($subjectID, $name, $description);
        if (!isset($result)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to add topic.');
            return;
        }

        // Get newly created resource and return it.
        $record = $this->db->getTopicByID($result);
        if (!isset($record)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Topic was created, but cannot be retrieved.');
            return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Deletes topic with given id and subject_id.
     */
    public function deleteTopic($subjectid, $topicid) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Check topic exists.
        if (!$this->checkTopicExists($subjectid, $topicid)) {
            http_response_code(404);
            $this->printMessage('Specified topic does not exist.');
            return;
        }

        // Attempt to delete.
        $result = $this->db->deleteTopic($topicid);
        if (!$result) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete topic.');
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
                    'description' => $rec['description']
                )
            );
        }
        return $results;
    }
}