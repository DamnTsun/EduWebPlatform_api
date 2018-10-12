<?php

class Subjects extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.subject.php';
        $this->db = new Model_Subject();
    }


    /**
     * Base method used for getting (public), adding (admin), or deleting (admin) subjects.
     * Note due to being default method, $methodValue should always be null.
     */
    public function index($subjectID = null, $methodValue = null, $remainingParams = null) {
        // Subject name should not be given for index method.
        if (isset($subjectID)) {
            $this->getSubjectByID($subjectID);
            return;
        }

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->getAllSubjects();
                break;
            case 'POST':
                // Check what the action is.
                if (!isset($_POST['action'])) {
                    echo json_encode(array('message' => 'No `action` POST parameter given.'));
                    http_response_code(400); return;
                }
                
                switch (strtolower($_POST['action'])) {
                    case App::ADD_KEYWORD:
                        $this->createSubject();
                        break;
                    case App::DELETE_KEYWORD:
                        $this->deleteSubject();
                        break;
                    default:
                        echo json_encode(array('message' => 'Invalid `action` POST paramter given.'));
                        http_response_code(400); break;
                }
                break;

            default:
                http_response_code(405);
                break;
        }
    }
    // GET
    private function getAllSubjects() {
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }
        $results = $this->db->getAllSubjects($count, $offset);

        $output = array();
        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => (int)$res['id'],
                    'name' => $res['name']
                )
            );
        }
        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }
    // POST
    private function createSubject() {
        // Check POST params.
        // ***@@@ ADD ADMIN CHECK!!! @@@***
        if (!isset($_POST['name'])) {
            echo json_encode(array('message' => 'No name given in POST body.'));
            http_response_code(400); return;
        }
        $name = $_POST['name'];

        $result = $this->db->addSubject($name);
        
        http_response_code(($result) ? 201 : 400); // 201 - Created / 400 - Bad request.
    }
    // DELETE
    private function deleteSubject() {
        // Check POST params.
        // ***@@@ ADD ADMIN CHECK!!! @@***
        if (!isset($_POST['id'])) {
            http_response_code(400); return;
        }
        $id = $_POST['id'];

        $result = $this->db->deleteSubject($id);
        
        http_response_code(($result) ? 200 : 400);
    }

    /**
     * Gets a specific subject record based on the given ID.
     * param $id - ID of subject record.
     */
    private function getSubjectByID($id) {
        $results = $this->db->getSubjectByID($id);
        if (is_null($results)) {
            http_response_code(400); return;
        }

        $output = array();
        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => $res['id'],
                    'name' => $res['name']
                )
            );
        }
        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }



    // /subject/<subjectName>/topic
    public function topics($subjectID = null, $topicID = null, $remainingParams = null) {
        // Get instance of Topic subcontroller.
        require_once $_ENV['dir_subcontrollers'] . 'Topics.php';
        $topicController = new Topics();

        // METHOD
        $topicMethod = 'index';
        // If method specified it will be first item in array.
        if (isset($remainingParams) && isset($remainingParams[0])) {
            if (method_exists($topicController, $remainingParams[0])) {
                $topicMethod = $remainingParams[0];
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
        $params = array($subjectID, $topicID, $methodValue); // Add method / main parameter.
        array_push($params, ($remainingParams) ? array_values($remainingParams) : null); // Add remaining parameters as array.
        
        // Call methods.
        call_user_func_array([$topicController, $topicMethod], $params);
    }

}