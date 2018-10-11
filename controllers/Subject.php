<?php

class Subject extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.subject.php';
        $this->db = new Model_Subject();
    }


    // /subject
    public function index($subjectName = null, $method = null) {
        switch ($_SERVER['REQUEST_METHOD']) {

            case 'GET':
                $this->getAllSubjects();
                break;
            case 'POST':
                http_response_code(405);
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
    private function createSubject($name) {

    }
    // DELETE
    private function deleteSubject($name) {

    }


    // /subject/<subjectName>/topic
    public function topic($subjectName = null, $topicName = null, $topicMethod = 'index', $topicMethodValue = null) {
        // Get instance of Topic subcontroller.
        require_once $_ENV['dir_subcontrollers'] . 'Topic.php';
        $topicController = new Topic();

        // Check specified method exists.
        if (!method_exists($topicController, $topicMethod)) {
            $topicMethod = 'index';
        }
        // Call methods.
        call_user_func_array([$topicController, $topicMethod], array($subjectName, $topicName, $topicMethodValue));
    }



    public function aa() {
        echo 'aa';
    }
}