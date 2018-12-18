<?php

class Posts extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['posts'];
        $this->db = new Model_Post();
    }


    /**
     * Check whether post with given subject_id and id exists.
     * @param subjectid - subject_id of record.
     * @param postid - id of record.
     */
    public function checkPostExists($subjectid, $postid) {
        $results = $this->db->checkPostExistsByID($subjectid, $postid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }

    /**
     * Checks whether the subject with given id exists.
     * @param subjectid - id of subject.
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
     * Gets all posts within the given subject.
     * @param subjectid - id of subject.
     */
    public function getAllPostsBySubject($subjectid) {
        // Validate id.
        if (!isset($subjectid) || !App::stringIsInt($subjectid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;

        // Check subject exists.
        if (!$this->checkSubjectExists($subjectid)) {
            http_response_code(404); return;
        }

        // Get count / offset.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getPostsBySubject($subjectid, $count, $offset);
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }

    /**
     * Gets post with given subject_id and id.
     * @param subjectid - subject_id of record.
     * @param postid - id of record.
     */
    public function getPostByID($subjectid, $postid) {
        // Validate ids.
        if (!isset($subjectid) || !App::stringIsInt($subjectid) ||
            !isset($postid) || !App::stringIsInt($postid)) {
            http_response_code(400); return;
        }
        $subjectid = (int)$subjectid;
        $postid = (int)$postid;

        // Check post exists.
        if (!$this->checkPostExists($subjectid, $postid)) {
            http_response_code(404); return;
        }

        // Attempt query.
        $results = $this->db->getPostByID($postid);
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
     * Formats records for output.
     * @param records - records to be formatted.
     */
    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'title' => $rec['title'],
                    'body' => $rec['body'],
                    'creationDate' => $rec['creationDate'],
                    'modificationDate' => $rec['modificationDate']
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

        // Check if has required fields. Also check type if necessary.
        if (!isset($object) ||
            !isset($object['title']) ||
            !isset($object['body']) ||
            !isset($object['subject_id'])||
            !isset($object['user_id'])) {
            return null;
        }
        return $object;
    }
}