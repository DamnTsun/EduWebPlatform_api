<?php

class Topics extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.topic.php';
        $this->db = new Model_Topic();
    }


    public function getAllTopicsBySubject($id) {
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
        $results = $this->db->getTopicsBySubject($id, $count, $offset);
        // Check successful.
        if (!isset($results)) {
            http_response_code(400); return;
        }
        
        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }


    public function getTopicByID($id) {
        // Validate $id.
        if (!isset($id) || !App::stringIsInt($id)) {
            http_response_code(400); return;
        }
        $id = (int)$id;

        // Attempt query.
        $results = $this->db->getTopicByID($id);
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


    public function createTopic($subjectID) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Get POST params.
        if (!isset($_POST['name'])) {
            http_response_code(400);
            $this->printMessage('`name` parameter not given in POST body.');
            return;
        }
        if (!isset($_POST['imageUrl'])) {
            http_response_code(400);
            $this->printMessage('`imageUrl` parameter not given in POST body.');
            return;
        }
        $name = $_POST['name'];
        $imageUrl = $_POST['imageUrl'];
        
        // Check subject exists.
        require_once $_ENV['dir_controllers'] . 'Subjects.php';
        $subjectController = new Subjects();
        if (!$subjectController->checkSubjectExists($subjectID)) {
            http_response_code(400);
            $this->printMessage('Specified subject does not exist.');
            return;
        }
        // Check no topic with name and subject id.
        if ($this->db->checkTopicExists($id, $name)) {
            http_response_code(400);
            $this->printMessage('Subject with name `' . $name . '` already exists in the specified subject.');
            return;
        }

        // Attempt to create.
        $result = $this->db->addTopic($subjectID, $name, $imageUrl);
        if (!isset($result)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to add topic.');
            return;
        }

        // Get newly created resource and return it.
        $record = $this->db->getTopicByID($id);
        if (!isset($record)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Topic was created, but cannot be retrieved.');
            return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }

    public function deleteTopic($id) {
        // Get session user. They must be admin.
        $user = $this->handleSessionUser(true);

        // Check topic exists.
        $exists = $this->db->checkTopicExistsByID($id);
        if (!isset($exists) || !$exists) {
            http_response_code(404);
            $this->printMessage('Specified topic does not exist.');
            return;
        }

        // Attempt to delete.
        $result = $this->db->deleteTopic($id);
        if (!$result) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete topic.');
            return;
        }
        http_response_code(200);
    }


    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'name' => $rec['name'],
                    'imageUrl' => $rec['imageUrl']
                )
            );
        }
        return $results;
    }
}