<?php

class Lesson extends Controller {

    const ACTION_GET_BY_TOPIC_ID = 'topic';            // Param for getting list of lessons in a topic.
    const ACTION_GET_BY_ID = 'id';                  // Param for getting a specific lesson using it's id.


    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . 'model.lesson.php';
        $this->db = new Model_Lesson();
    }

    public function index($action = null, $value = null) {
        // Check params given.
        if (!isset($action) || !isset($value)) { http_response_code(400); return; }
        // Check value is an integer.
        if (!App::stringIsInt($value)) { http_response_code(400); return;}

        $value = (int)$value; // Cast to int.
        
        // Check action.
        switch (strtolower($action)) {
            case $this::ACTION_GET_BY_TOPIC_ID:
                // Check method.
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        $this->getByTopic($value);
                        break;
                    case 'POST':
                        http_response_code(405);
                        break;
                }
                break;
            case $this::ACTION_GET_BY_ID:
                // Check method.
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        $this->getByID($value);
                        break;
                    case 'POST':
                        http_response_code(405);
                        break;
                }
                break;
            default:
                http_response_code(405);
                break;
        }
    }


    /**
     * Gets all lessons with the specified topic_id.
     */
    private function getByTopic($id) {
        $results = array();
        $results = $this->db->getLessonsByTopic($id);

        $output = array();
        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => $res['id'],
                    'title' => $res['title'],
                    'body' => addslashes($res['body'])
                )
            );
        }
        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    /**
     * Get the lesson with the specified id.
     */
    private function getByID($id) {
        $results = array();
        $results = $this->db->getLessonByID($id);

        $output = array();
        foreach ($results as $res) {
            array_push(
                $output,
                array(
                    'id' => $res['id'],
                    'title' => $res['title'],
                    'body' => addslashes($res['body'])
                )
            );
        }
        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }
}