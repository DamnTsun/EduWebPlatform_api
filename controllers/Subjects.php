<?php

class Subjects extends Controller {

    /**
     * Initializes new instace on Subjects controllers.
     * Automatically gets instance of subjects model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['subjects'];
        $this->db = new Model_Subject();
    }


    /**
     * Checks subject exists.
     * @param id - id of subject.
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
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

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
     * @param id - id of subject.
     */
    public function getSubjectByID($id) {
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
            $this->printMessage('`content` parameter not given in POST body.');
            http_response_code(400); return;
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
            $this->printMessage('Subject with name `' . $name . '` already exists. Subject names must be unique.');
            http_response_code(400); return;
        }

        // Attempt to create new resource.
        $result = $this->db->addSubject($name, $description, $homepageContent);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to add subject.');
            http_response_code(500); return;
        }

        // Get newly create resource and return it.
        $record = $this->db->getSubjectByID($result);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Subject was created, but cannot be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }




    /**
     * Modifies existing subject.
     * @param subjectid - id of subject.
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
        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($name, $description, $homepageContent) ) == null) {
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
     * @param id - id of subject.
     */
    public function deleteSubject($id) {
        // Check user signed into a session. Require that they be an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check subject with id exists.
        if (!$this->checkSubjectExists($id)) {
            $this->printMessage('Cannot delete. No subject found with given id.');
            http_response_code(404); return;
        }

        // Attempt to delete.
        $success = $this->db->deleteSubject($id);
        if (!$success) {
            http_response_code(500);
            $this->printMessage('Something went wrong. Unable to delete subject.');
            http_response_code(500); return;
        }

        http_response_code(200);
    }



    

    /**
     * Formats records so they look better.
     * @param records - Records to be formatted.
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