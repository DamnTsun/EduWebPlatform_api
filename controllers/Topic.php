<?php

class Topic extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.topic.php';
        $this-> db = new Model_Topic();
    }

    public function index() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->getTopics();
                break;
            case 'POST':
                echo 'Adding / deleting topics not implemented.';
                http_response_code(400);
                break;
        }
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