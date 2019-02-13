<?php

class Users extends Controller {

    /**
     * Initializes new instace on Users controllers.
     * Automatically gets instance of users model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['users'];
        $this->db = new Model_User();
    }





    /**
     * Checks whether user exists with given id.
     * @param id - id of user record.
     */
    public function checkUserExists($id) {
        $results = $this->db->checkUserExistsByID($id);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }


    /**
     * Checks whether a user exists with the given socialMediaID and the given socialMediaProvider_id.
     * @param socialMediaID - id of the social media account the user is signed in with.
     * @param socialMediaProviderName - name of socialMediaProvider. Should match the unique 'name' field of a socialMediaProviders record.
     */
    public function checkUserExistsBySocialMediaID($socialMediaID, $socialMediaProviderName) {
        $results = $this->db->checkUserExistsBySocialMediaID($socialMediaID, $socialMediaProviderName);
        if (!isset($results)) {
            return null;
        }
        return $results;
    }





    /**
     * Gets users record with given id.
     * @param id - id of record.
     */
    public function getUserByID($id) {
        // Attempt query.
        $results = $this->db->getUserByID((int)$id);
        if (!isset($results) || sizeof($results) == 0) {
            return null;
        }
        return $results;
    }


    /**
     * Gets user record with given socialMediaID, that is associated with a specified social media provider.
     * @param socialMediaID - socialMediaID of record.
     * @param socialMediaProviderName - name field of a socialMediaProviders record. Used to get records id.
     */
    public function getUserBySocialMediaID($socialMediaID, $socialMediaProviderName) {
        // Attempt query.
        return $this->db->getUserBySocialMediaID($socialMediaID, $socialMediaProviderName);
    }




    /**
     * Gets all users in system, ordered by id.
     */
    public function getAllUsers() {
        // Check user is signed in. Authorization not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Get GET params if set.
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);
        $name = App::getGETParameter('name', null);
        // If name given, search by name instead.
        if (isset($name)) {
            $this->getAllUsersByName(('%' . $name . '%'), $count, $offset);
            return;
        }

        // Lookup users.
        $results = $this->db->getUsers($count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup users.');
            http_response_code(500); return;
        }

        // Display results.
        $this->printJSON($this->formatRecords($results));
    }



    /**
     * Get all users in system where the name is like a term.
     */
    private function getAllUsersByName($name, $count, $offset) {
        // Lookup users.
        $results = $this->db->getUsersByName($name, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup users.');
            http_response_code(500); return;
        }

        // Display results.
        $this->printJSON($this->formatRecords($results));
    }





    /**
     * Creates a new user record with default displayName, the given socialMediaID, for the specified social media provider.
     * Optionally may specify their user privilege level. (default 'normal')
     * @param socialMediaID - socialMediaID for user.
     * @param socialMediaProviderName - name of socialMediaProviders record. ID will be looked up using this.
     * @param privilegeLevelName - name of privilegeLevels record. ID will be looked up using this.
     */
    public function createUser($socialMediaID, $socialMediaProviderName, $privilegeLevelName = 'normal') {
        // Attempt to create user.
        return $this->db->createUser($socialMediaID, $socialMediaProviderName, $privilegeLevelName);
    }








    /**
     * Gets details about the current user, based on the user associated with the given idToken header.
     */
    public function getCurrentUserDetails() {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Get the users record.
        $record = $this->getUserByID($user['id']);
        if (!isset($record)) {
            $this->printMessage('Unable to retrieve user record.');
            http_response_code(500); return;
        }
        if (sizeof($record) == 0) {
            $this->printMessage('User record could not be found.');
            http_response_code(404); return;
        }

        // Format and return record.
        $this->printJSON($this->formatRecords($record));
    }


    /**
     * Updates the current users name.
     * @param name - new name for user.
     */
    public function updateCurrentUserName() {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check content parameter given.
        if (!isset($_POST['content'])) {
            $this->printMessage('`content` parameter not given in post body.');
            http_response_code(400); return;
        }

        // Check content parameter is valid.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            http_response_code(400); return;
        }

        // Check name is not blank or more than 50 characters.
        if (strlen($json['name']) > 50 || strlen($json['name']) < 1) {
            $this->printMessage('Given name is not valid. Name must be between 1 and 50 characters.');
            http_response_code(400); return;
        }


        // Attempt query.
        $result = $this->db->changeUserName($user['id'], $json['name']);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update user name.');
            http_response_code(500); return;
        }

        // Return the users new details.
        $this->getCurrentUserDetails();
    }





    /**
     * Updates lastSignInDate field of specified user.
     * @param userid - id of user.
     */
    public function updateUserLastSignInDate($userid) {
        $result = $this->db->updateUserLastSignInDate($userid);
        if (!isset($result)) {
            return null;
        }
        return $result;
    }





    /**
     * Deletes account of current user. (Based on idToken header)
     */
    public function deleteCurrentAccount() {
        // Check user signed in. (Does not need to be admin).
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Attempt query.
        $result = $this->db->deleteUser($user['id']);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to delete user account.');
            http_response_code(500); return;
        }
    }








    // Admin stuff.
    /**
     * Sets a given users admin status.
     * @param id - id of user.
     * @param value - boolean. Whether to set the user to admin or not.
     */
    public function setUserAdminStatus($id, $value) {
        // Check user is an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Attempt to set admin status.
        $results = $this->db->setUserAdminStatus($id, $value);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to change user privilege level.');
            http_response_code(500); return;
        }

        // Return users updated record.
        $record = $this->getUserByID($id);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. User admin status updated, but unable to get user details.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
    }


    /**
     * Sets a given users banned status.
     * @param id - id of user.
     * @param value - boolean. Whether to set the user to banned or not.
     */
    public function setUserBannedStatus($id, $value) {
        // Check user is an admin.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Attempt to set admin status.
        $results = $this->db->setUserBannedStatus($id, $value);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to change user privilege level.');
            http_response_code(500); return;
        }

        // Return users updated record.
        $record = $this->getUserByID($id);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. User admin status updated, but unable to get user details.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatRecords($record));
    }



    /**
     * Formats records for output.
     * @param records - Records to be formatted.
     */
    protected function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'displayname' => $rec['displayName'],
                    'admin' => ($rec['level'] == 'Admin') ? true : false,
                    'banned' => ($rec['level'] == 'Banned') ? true : false
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