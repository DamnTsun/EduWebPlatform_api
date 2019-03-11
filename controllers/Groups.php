<?php

class Groups extends Controller {

    /**
     * Initializes new instace on Lessons controllers.
     * Automatically gets instance of groups model.
     */
    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['groups'];
        $this->db = new Model_Group();
    }


    // *** utility functions ***
    /**
     * Checks whether a group exists.
     * @param groupid - id of group.
     */
    private function checkGroupExists($groupid) {
        $result = $this->db->checkGroupExists($groupid);
        if (!isset($result)) {
            return false;
        }
        return $result;
    }

    /**
     * Checks if the given user (by id) is part of the given group (by id).
     * Used as non-admins may only view groups/group-members for groups that they are a part of.
     * @param userid - id of user.
     * @param groupdid - id of group.
     */
    public function checkUserInGroup($userid, $groupid) {
        $result = $this->db->checkUserInGroup($userid, $groupid);
        if (!isset($result)) {
            return false;
        }
        return $result;
    }

    /**
     * Checks whether a user exists by id.
     * @param userid - id of user.
     */
    private function checkUserExists($userid) {
        require_once $_ENV['dir_controllers'] . $_ENV['controllers']['users'];
        $controller = new Users();
        $result = $controller->checkUserExists($userid);
        if (!isset($result)) {
            return false;
        }
        return $result;
    }
    // **********





    // *** group / user group related (not members) ***
    /**
     * Gets groups that the current user is a member of.
     */
    public function getCurrentUserGroups() {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Get groups.
        $results = $this->db->getCurrentUserGroups($user['id'], $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup groups.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupRecords($results));
    }

    /**
     * Gets all groups. (admin only)
     */
    public function getAllUserGroups() {
        // Check user authorized. Admin required.
        $user = Auth::validateSession(true);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Get groups.
        $results = $this->db->getAllGroups($count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup groups.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupRecords($results));
    }


    /**
     * Gets a user group.
     * @param groupid - id of group.
     */
    public function getUserGroupByID($groupid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot lookup group. You are not a member of the group.');
                http_response_code(401); return;
            }
        }


        // Attempt to get.
        $result = $this->db->getGroupByID($groupid);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to lookup group.');
            http_response_code(500); return;
        }
        if (sizeof($result) == 0) {
            http_response_code(404); return;
        }
        $this->printJSON($this->formatGroupRecords($result));
    }





    




    /**
     * Creates a new group (if validation passed).
     */
    public function createGroup() {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
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
        $name =                 $json['name']; // Required.
        $description =          (isset($json['description'])) ? $json['description'] : '';
        $imageUrl =             (isset($json['imageUrl'])) ? $json['imageUrl'] : '';

        // Validate values.
        $validation = $this->validateValues($name, $description, $imageUrl);
        if (isset($validation)) {
            $this->printMessage($validation);
            http_response_code(400); return;
        }
        
        // Attempt to create.
        $result = $this->db->createGroup($user['id'], $name, $description, $imageUrl);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to create group.');
            http_response_code(500); return;
        }

        // Get newly created group and return it.
        $record = $this->db->getGroupByID($result);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Group created, but unable to be retreived.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupRecords($record));
        http_response_code(201);
    }










    /**
     * Modifies an existing group.
     * @param groupid - id of group.
     */
    public function modifyGroup($groupid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot modify group. You are not a member of the group.');
                http_response_code(401); return;
            }
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
        $name =             (isset($json['name'])) ? $json['name'] : null;
        $description =      (isset($json['description'])) ? $json['description'] : null;
        $imageUrl =           (isset($json['imageUrl'])) ? $json['imageUrl'] : null;

        // Ensure a value is actually being changed. (max is only null if all array items are null)
        if (max( array($name, $description, $imageUrl) ) == null) {
            $this->printMessage('No fields specified to update.');
            http_response_code(400); return;
        }

        // Validate values.
        $validation = $this->validateValues($name, $description, $imageUrl);
        if (isset($validation)) {
            $this->printMessage($validation);
            http_response_code(400); return;
        }


        // Attempt to update.
        $result = $this->db->modifyGroup($groupid, $name, $description, $imageUrl);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to update group.');
            http_response_code(500); return;
        }

        // Get updated resource and return it.
        $record = $this->db->getGroupByID($groupid);
        if (!isset($record)) {
            $this->printMessage('Something went wrong. Group updated, but unable to be retrieved.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupRecords($record));
    }










    /**
     * Deletes an existing group.
     * @param groupid - id of group.
     */
    public function deleteGroup($groupid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot delete group. You are not a member of the group.');
                http_response_code(401); return;
            }
        }

        // Delete the group.
        $result = $this->db->deleteGroup($groupid);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to delete group.');
            http_response_code(500); return;
        }
    }
    // **********









    // *** Group members ***
    /**
     * Gets users who are a member of the specified group.
     * @param groupid - id of group.
     */
    public function getUsersInGroup($groupid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot view members listing. You are not a member of the group.');
                http_response_code(401); return;
            }
        }

        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getUsersInGroup($groupid, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup members of group.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupMemberRecords($results));
    }


    /**
     * Gets users who are not a member of the specified group.
     * @param groupid - id of group.
     */
    public function getUsersNotInGroup($groupid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot view non-members listing. You are not a member of the group.');
                http_response_code(401); return;
            }
        }

        // Get count / offset GET params if given.
        $count = App::getGETParameter('count', 10);
        $offset = App::getGETParameter('offset', 0);

        // Attempt query.
        $results = $this->db->getUsersNotInGroup($groupid, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup members of group.');
            http_response_code(500); return;
        }
        $this->printJSON($this->formatGroupMemberRecords($results));
    }





    /**
     * Adds specified user to the specified group.
     * Only if current user is an admin or already in group.
     * @param groupid - id of group.
     * @param userid - id of user.
     */
    public function addUserToGroup($groupid, $userid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // Check user exists.
        if (!$this->checkUserExists($userid)) {
            $this->printMessage('Cannot add member to group. Specified user does not exist.');
            http_response_code(400); return;
        }


        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot add member to group. You are not a member of the group.');
                http_response_code(401); return;
            }
        }

        // Check that user is not already in the group.
        if ($this->checkUserInGroup($userid, $groupid)) {
            $this->printMessage('Specified user is already a member of the group.');
            http_response_code(400); return;
        }


        // Add user to group.
        $result = $this->db->addUserToGroup($userid, $groupid);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to add user to group.');
            http_response_code(500); return;
        }
    }


    /**
     * Removes specified user from the specified group.
     * Only if current user is admin or already in group.
     * @param groupid - id of group.
     * @param userid - id of user.
     */
    public function removeUserFromGroup($groupid, $userid) {
        // Check user authorized. Admin not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Check group exists.
        if (!$this->checkGroupExists($groupid)) {
            http_response_code(404); return;
        }

        // Check user exists.
        if (!$this->checkUserExists($userid)) {
            $this->printMessage('Cannot add member to group. Specified user does not exist.');
            http_response_code(400); return;
        }


        // If user is NOT admin, check they are part of the specified group.
        if ($user['privilegeLevel'] != 'Admin') {
            if (!$this->checkUserInGroup($user['id'], $groupid)) {
                $this->printMessage('Cannot remove member from group. You are not a member of the group.');
                http_response_code(401); return;
            }
        }

        // Check that user is in the group.
        if (!$this->checkUserInGroup($userid, $groupid)) {
            $this->printMessage('Specified user is already not a member of the group.');
            http_response_code(400); return;
        }


        // Remove user from group.
        $result = $this->db->removeUserFromGroup($userid, $groupid);
        if (!isset($result)) {
            $this->printMessage('Something went wrong. Unable to remove from group.');
            http_response_code(500); return;
        }
    }
    // **********
    // todo: addUserToGroup, removeUserFromGroup





    /**
     * Formats group member (user) records for display.
     * @param records - records to be formatted.
     */
    private function formatGroupMemberRecords($records) {
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
     * Formats group records for display.
     * @param records - records to be formatted.
     */
    private function formatGroupRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            array_push(
                $results,
                array(
                    'id' => (int)$rec['id'],
                    'name' => $rec['name'],
                    'description' => $rec['description'],
                    'imageUrl' => $rec['imageUrl']
                )
            );
        }
        return $results;
    }

    /**
     * Not implemented for this controller.
     * Please use provided formatGroupMemberRecords and formatGroupRecords methods.
     * @param records - records to be formatted.
     */
    protected function formatRecords($records) {
        throw new NotImplementedException();
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

    /**
     * Validates given values. Returns message if invalid. Returns null if valid.
     * @param name - name to be validated.
     * @param description - description to be validated.
     * @param imageUrl - imageUrl to be validated.
     */
    protected function validateValues($name, $description, $imageUrl) {
        // NAME
        if (isset($name)) {
            if (strlen($name) == 0) { return 'Name cannot be blank.'; }
            if (strlen($name) > 100) { return 'Name cannot be longer than 100 characters.'; }
        }
        // DESCRIPTION
        if (isset($description)) {
            if (strlen($description) > 4096) { return 'Description cannot be longer than 4096 characters.'; }
        }
        // IMAGEURL
        if (isset($imageUrl)) {
            if (strlen($imageUrl) > 255) { return 'ImageUrl cannot be longer than 255 characters.'; }
        }
        return null;
    }
}

