<?php

class Topics extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.topic.php';
        $this-> db = new Model_Topic();
    }

    /**
     * Default method for topics.
     * Note $methodValues should always be null. It is used by other methods.
     */
    public function index($subjectID = null, $topicID = null, $methodValue = null ,$remainingParams = null) {

        // If topic id specified, handle it.
        if (isset($topicID)) {
            $this->getTopicByID($topicID);
            return;
        }

        // Otherwise handle /topic request.
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->getTopicsBySubject($subjectID);
                break;
            case 'POST':
                // Check what action is.
                if (!isset($_POST['action'])) {
                    http_response_code(400); return;
                }

                switch (strtolower($_POST['action'])) {

                    case App::ADD_KEYWORD:
                        $this->createNewTopic($subjectID);
                        break;
                    case App::DELETE_KEYWORD:
                        $this->deleteTopic();
                        break;
                }
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
    private function getTopicsBySubject($subjectID) {
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }

        // Run query. Ensure successful.
        $results = $this->db->getTopicsBySubject($subjectID, $count, $offset);
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
    private function createNewTopic($subjectID) {
        // Check required parameters in POST body are being given.
        // ***@@@ CHECK id_token!!! @@@*** Not done for easy testing.
        // Topic name
        if (!isset($_POST['name'])
                || !isset($_POST['imageUrl'])) {
            http_response_code(400); return;
        }
        $name = $_POST['name'];
        $imageUrl = $_POST['imageUrl'];

        $result = $this->db->addTopic($subjectID, $name, $imageUrl);

        http_response_code(($result) ? 201 : 400); // 201 - Created or 400 - Bad request.
    }
    // DELETE
    private function deleteTopic() {
        // Check required parameters in POST body are being given.
        // ***@@@ CHECK id_token!!! @@@*** Not done for easy testing.
        // Topic ID
        if (!isset($_POST['id'])) {
            http_response_code(400); return;
        }
        $id = $_POST['id'];

        $result = $this->db->deleteTopic($id);

        http_response_code(($result) ? 200 : 400);
    }


    /**
     * Gets specific topic based on the given id.
     * param $id - ID of topic record.
     */
    private function getTopicByID($id) {
        $results = $this->db->getTopicByID($id);
        if (is_null($results)) {
            http_response_code(400); return;
        }

        $output = array();
        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => (int)$res['id'],
                    'name' => $res['name'],
                    'imageUrl' => $res['imageUrl'],
                    'subjectId' => (int)$res['subject_id'],
                    'subjectName' => $res['subject']
                )
            );
        }

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }


    

    public function lessons($subjectID = null, $topicID = null, $lessonID = null, $remainingParams = null) {
        // Get lessons subcontrolller.
        require_once $_ENV['dir_subcontrollers'] . 'Lessons.php';
        $lessonsController = new Lessons();


        // METHOD
        $lessonMethod = 'index';
        if (isset($remainingParams) && isset($remainingParams[0])) {
            if (method_exists($lessonsController, $remainingParams[0])) {
                $lessonMethod = $remainingParams[0];
                unset($remainingParams[0]);
            }
        }

        // METHOD VALUE
        $methodValue = null;
        if (isset($remainingParams) && isset($remainingParams[1])) {
            $methodValue = $remainingParams[1];
            unset($remainingParams[1]);
        }


        // PREPARE PARAMETERS
        $params = array($subjectID, $topicID, $lessonID, $methodValue);
        array_push($params, ($remainingParams) ? array_values($remainingParams) : null);
        
        var_dump($params);
    }
}