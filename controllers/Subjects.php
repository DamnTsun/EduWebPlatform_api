<?php

class Subjects extends Controller {

    public function __construct() {
        parent::__construct();
        require_once $_ENV['dir_models'] . $_ENV['models']['subjects'];
        $this->db = new Model_Subject();
    }


    /**
     * Checks subject exists.
     */
    public function checkSubjectExists($id) {
        $results = $this->db->checkSubjectExistsByID($id);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets all subjects.
     */
    public function getAllSubjects() {
        // Get count / offset GET params if given.
        $count = 10; $offset = 0;
        if (isset($_GET['count']) && App::stringIsInt($_GET['count'])) {
            $count = (int)$_GET['count'];
        }
        if (isset($_GET['offset']) && App::stringIsInt($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        }

        // Attempt query.
        $results = $this->db->getAllSubjects($count, $offset);
        if (!isset($results)) {
            http_response_code(400); return;
        }

        // Format and display results.
        $output = $this->formatRecords($results);
        $this->printJSON($output);
    }


    /**
     * Gets subject with given id.
     */
    public function getSubjectByID($id) {
        // Validate $id.
        if (!isset($id) || !App::stringIsInt($id)) {
            http_response_code(400); return;
        }
        $id = (int)$id;

        // Attempt query.
        $results = $this->db->getSubjectByID($id);
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
     * Creates a new subject record if validation is passed. Then returns new record as JSON.
     */
    public function createSubject() {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check JSON sent as POST param.
        if (!isset($_POST['content'])) {
            http_response_code(400);
            $this->printMessage('`content` parameter not given in POST body.');
            return;
        }

        // Validate JSON.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            return;
        }

        // Set values.
        $name =                         $json['name']; // Required
        $description =                  (isset($json['description'])) ? $json['description'] : '';
        $homepageContent =              (isset($json['homepageContent'])) ? $json['homepageContent'] : '';

        // Check subject with name does not exist.
        if ($this->db->checkSubjectExists($name)) {
            http_response_code(400);
            $this->printMessage('Subject with name `' . $name . '` already exists. Subject names must be unique.');
            return;
        }

        // Attempt to create new resource.
        $result = $this->db->addSubject($name, $description, $homepageContent);
        if (!isset($result)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to add subject.');
            return;
        }

        // Get newly create resource and return it.
        $record = $this->db->getSubjectByID($result);
        if (!isset($record)) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Subject was created, but cannot be retrieved.');
            return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }




    /**
     * 
     */
    public function modifySubject($subjectid) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check subject exists.
        if (!$this->checkSubjectExists($subjectid)) {
            $this->printMessage('Specified subject does not exist.');
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
        $name =                     (isset($json['name'])) ? $json['name'] : null;
        $description =              (isset($json['description'])) ? $json['description'] : null;
        $homepageContent =          (isset($json['homepageContent'])) ? $json['homepageContent'] : null;
        // Ensure a value is actually being changed.
        if (!isset($name) &&
            !isset($description) &&
            !isset($homepageContent)) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }


        // Attempt query.
        $result = $this->db->modifySubject($subjectid, $name, $description, $homepageContent);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update subject.');
            http_response_code(500); return;
        }

        // Get updated resource and return it.
        $record = $this->db->getSubjectByID($subjectid);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Subject was updated, but cannot be retrieved.');
            http_response_code(500); return;
        }

        $this->printJSON($this->formatRecords($record));
        http_response_code(200);
    }





    /**
     * Deletes subject with given id.
     */
    public function deleteSubject($id) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        if (!App::stringIsInt($id)) {
            http_response_code(400);
            $this->printMessage('Cannot delete. Given id value is not an integer.');
            return;
        }

        // Check subject with id exists.
        $record = $this->db->getSubject($id);
        if (!isset($record) || sizeof($record) == 0) {
            http_response_code(404);
            $this->printMessage('Cannot delete. No subject found with given id.');
            return;
        }

        $success = $this->db->deleteSubject($id);
        if (!$success) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete subject.');
            return;
        }

        http_response_code(200);
    }



    

    /**
     * Formats array containing record data, for use before encoding as JSON.
     */
    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'name' => $rec['name'],
                    'description' => $rec['description'],
                    'homepageContent' => $rec['homepageContent']
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

        // Check if has required fields.
        if (!isset($object) ||
            !isset($object['name'])) {
            return null;
        }
        return $object;
    }
}