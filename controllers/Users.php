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
        $results = $this->db->getUserBySocialMediaID($socialMediaID, $socialMediaProviderName);
        if (!isset($results) || sizeof($results) == 0) {
            return null;
        }
        return $results;
    }









    // OLD
    /**
     * Creates new user record with default values.
     */
    public function createUser() {
        $result = $this->db->createUser();
        if (!isset($result)) {
            return null;
        }
        return $result;
    }


    /**
     * Creates new users_google record. Linking an internal users account with a googleid.
     * @param user_id - id of user.
     * @param googleid - googleid being linked.
     */
    public function createGoogleUser($user_id, $googleid) {
        $result = $this->db->createGoogleUser((int)$user_id, $googleid);
        if (!isset($result)) {
            return null;
        }
        return $result;
    }

    /**
     * Creates new users_facebook record. Linking an internal users account with a facebookid.
     * @param user_id - id of user.
     * @param facebookid - facebookid being linked.
     */
    public function createFacebookUser($user_id, $facebookid) {
        throw new NotImplementedException();
    }

    /**
     * Creates new users_linkedin record. Linking an internal users account with a linkedinid.
     * @param user_id - id of user.
     * @param linkedinid - facebookid being linked.
     */
    public function createLinkedInUser($user_id, $linkedinid) {
        throw new NotImplementedException();
    }





    /**
     * Deletes a user record.
     * @param user_id - id of record.
     */
    public function deleteUser($user_id) {

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
                    'admin' => ($rec['admin']) ? true : false,
                    'banned' => ($rec['banned']) ? true : false
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
        // Not currently needed. Update later.
        throw new NotImplementedException();
    }

}