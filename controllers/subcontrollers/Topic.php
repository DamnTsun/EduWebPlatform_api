<?php

class Topic extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.topic.php';
        $this-> db = new Model_Topic();
    }

    // /subject/<subjectName>/topic (GET, POST, DELETE)
    public function index($subjectName, $topicName = null) {

        // If topic name specified, handle it.
        if (isset($topicName)) {
            return;
        }

        // Otherwise handle /topic request.
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->getTopicsBySubject($subjectName);
                break;
            case 'POST':
                $this->createNewTopic($subjectName);
                break;
            case 'DELETE':
                http_response_code(405);
                break;
            default:
                http_response_code(405);
                break;
        }
    }
    // GET
    private function getTopicsBySubject($subjectName) {
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }

        // Run query. Ensure successful.
        $results = $this->db->getTopicsBySubject($subjectName, $count, $offset);
        if (!isset($results)) {
            http_response_code(400); return;
        }
        $output = array();

        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => (int)$res['id'],
                    'name' => $res['name'],
                    'imageUrl' => $res['imageUrl']
                )
            );
        }
        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }
    // POST
    private function createNewTopic($subjectName) {
        // Check required parameters in POST body are being given.
        // ***@@@ CHECK id_token!!! @@@*** Not done for easy testing.
        // Topic name
        if (!isset($_POST['name'])
                || !isset($_POST['imageUrl'])) {
            http_response_code(405);
            return;
        }
        $name = $_POST['name'];
        $imageUrl = $_POST['imageUrl'];

        $result = $this->db->addTopic($subjectName, $name, $imageUrl);

        http_response_code(($result) ? 201 : 400); // 201 - Created or 400 - Bad request.
    }
    // DELETE
    private function deleteTopic($subjectName, $topicName) {

    }


    private function getTopics() {
        $values = array();

        $results = $this->db->getAllTopics();
        
        foreach ($results as $res) {
            array_push(
                $values,
                array(
                    'id' => (int)$res['id'],
                    'name' => $res['name'],
                    'imageUrl' => $res['imageUrl']
                )
            );
        }

        echo json_encode($values);
    }
}