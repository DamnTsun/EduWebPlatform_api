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
     * Creates a new post.
     * @param subjectid - subject_id for post.
     */
    public function createPost($subjectid) {
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
        $title =                $json['title'];
        $body =                 (isset($json['body'])) ? $json['body'] : '';

        // Check subject exists.
        if (!$this->checkSubjectExists($subjectid)) {
            $this->printMessage('Specified subject does not exists.');
            http_response_code(404); return;
        }

        // Attempt to create.
        $result = $this->db->addPost($subjectid, $user['id'], $title, $body);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to add post.');
            http_response_code(500); return;
        }

        // Get newly create resource and return it.
        $record = $this->db->getPostByID($result);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Post was created, but cannot be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Modifies existing post.
     * @param subjectid - subject the post is within.
     * @param postid - id of post.
     */
    public function modifyPost($subjectid, $postid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check post exists.
        if (!$this->checkPostExists($subjectid, $postid)) {
            $this->printMessage('Specified post does not exist.');
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
        $title =                (isset($json['title'])) ? $json['title'] : null;
        $body =                 (isset($json['body'])) ? $json['body'] : null;
        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($title, $body) ) == null) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }


        // Attempt query.
        $result = $this->db->modifyPost($postid, $user['id'], $title, $body);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update post.');
            http_response_code(500);return;
        }

        // Get updated resource and return it.
        $record = $this->db->getPostByID($postid);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Post was updated, but cannot be retrieved.');
            http_response_code(500); return;
        }

        $this->printJSON($this->formatRecords($record));
        http_response_code(200);
    }





    /**
     * Delets post with given subject_id and id.
     * @param subjectid - subject_id of post.
     * @param postid - id of post.
     */
    public function deletePost($subjectid, $postid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check post exists.
        if (!$this->checkPostExists($subjectid, $postid)) {
            $this->printMessage('Specified post does not exists.');
            http_response_code(404); return;
        }

        // Attempt to delete.
        $result = $this->db->deletePost($postid);
        if (!$result) {
            $this->printMessage('Something went wrong. Unable to delete post.');
            http_response_code(500); return;
        }
        // Success.
        http_response_code(200);
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
            !isset($object['title'])) {
            return null;
        }
        return $object;
    }
}