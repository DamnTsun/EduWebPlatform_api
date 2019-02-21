<?php

class SubjectAdmins extends Controller {

    /**
     * Initializes new instance of SubjectAdmins controller.
     * Automatically gets instance of subject admins model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['subject_admins'];
        $this->db = new Model_Subject_Admin();
    }


    /**
     * Checks if subject_admin exists.
     * @param subjectid - id of subject.
     * @param userid - id of user.
     */
    public function checkSubjectAdminExists($subjectid, $userid) {
        $results = $this->db->checkUserIsSubjectAdmin($subjectid, $userid);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether the specified group exists.
     * @param subjectid - id of subject.
     */
    public function checkSubjectExists($subjectid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['subjects'];
        $controller = new Subjects();
        return $controller->checkSubjectExists($subjectid);
    }





    /**
     * Gets subject admins for the specified subject.
     * @param subjectid - id of subject.
     */
    public function getSubjectAdmins($subjectid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Check specified group exist.
        if (!$this->checkSubjectExists($subjectid)) {
            $this->printMessage('Specified subject does not exist.');
            http_response_code(404); return;
        }


        // Get GET params.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);


        // Attempt query.
        $results = $this->db->getSubjectAdminsBySubject($subjectid, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup subject admins for subject.');
            http_response_code(500); return;
        }

        // Format and display results.
        $this->printJSON($this->formatRecords($results));
    }





    /**
     * Adds the current user (via auth token) as a subject admin to the specified subject.
     * @param subjectid - id of subject.
     */
    public function addSubjectAdmin($subjectid) {
        // Check user authorized. Admin required.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Check subject exists.
        if (!$this->checkSubjectExists($subjectid)) {
            $this->printMessage('Specified subject does not exist.');
            http_response_code(404); return;
        }


        // Check user is not already a subject admin.
        if ($this->checkSubjectAdminExists($subjectid, $user['id'])) {
            $this->printMessage('You are already a subject_admin for this group.');
            http_response_code(400); return;
        }


        // Add user as a subject admin.
        $results = $this->db->addSubjectAdminToSubject($subjectid, $user['id']);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to add subject_admin.');
            http_response_code(500); return;
        }

        // Get and return their record.
        $record = $this->db->getSubjectAdminByIDs($subjectid, $user['id']);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Subject_admin was added, but could not be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
        http_response_code(201);
    }





    /**
     * Removes the current user (via auth token) as a subject_admin for the specified subject.
     * @param subjectid - id of subject.
     */
    public function removeSubjectAdmin($subjectid) {
        // Check user authorized. Admin required.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Check subject exists.
        if (!$this->checkSubjectExists($subjectid)) {
            $this->printMessage('Specified subject does not exist.');
            http_response_code(404); return;
        }


        // Check user is a subject admin.
        if (!$this->checkSubjectAdminExists($subjectid, $user['id'])) {
            $this->printMessage('You are not a subject_admin for this group.');
            http_response_code(400); return;
        }


        // Remove subject_admin.
        $results = $this->db->removeSubjectAdminFromSubject($subjectid, $user['id']);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Could not remove subject_admin.');
            http_response_code(500); return;
        }
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
                    'displayname' => $rec['displayName']
                )
            );
        }
        return $results;
    }


    /**
     * Validates incoming JSON for requests.
     * Not used. Do not call. Will throw a NotImplementedException.
     */
    protected function validateJSON($json) {
        throw new NotImplementedException();
    }
}