<?php

class Messages extends Controller {

    public function __construct() {
        require_once $_ENV['dir_models'] . $_ENV['models']['messages'];
        $this->db = new Model_Message();
    }



    /**
     * Gets messages sent to a user, ordered by date.
     * Received messages can be changed with the count and offset GET parameters.
     */
    public function getCurrentUserMessages() {
        // Check user is signed in. Authorization not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }

        // Get GET params if set.
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);


        // Get messages.
        $results = $this->db->getUserMessages($user['id'], $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup messages.');
            http_response_code(500); return;
        }

        
        // Format and return messages.
        $this->printJSON($this->formatRecords($results));
    }



    /**
     * Gets messages sent to a user, from a specific user.
     * @param id - sender of messages.
     */
    public function getCurrentUserMessagesFromUser($id) {
        // Check user is signed in. Authorization not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Get GET params if set.
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);


        // Get messages.
        $results = $this->db->getUserMessagesFromUser($user['id'], $id, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup messages.');
            http_response_code(500); return;
        }


        // Format and return messages.
        $this->printJSON($this->formatRecords($results));
    }



    /**
     * Gets messages sent by a user.
     */
    public function getCurrentUserSentMessages() {
        // Check user is signed in. Authorization not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Get GET params if set.
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);


        // Get messages.
        $results = $this->db->getUserMessagesSent($user['id'], $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup messages.');
            http_response_code(500); return;
        }


        // Format and display messages.
        $this->printJSON($this->formatRecords($results));
    }


    /**
     * Gets messages sent by a user to another user.
     * @param userid - id of other user.
     */
    public function getCurrentUserSentMessagesToUser($userid) {
        // Check user is signed in. Authorization not required.
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Get GET params if set.
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);


        // Get messages.
        $results = $this->db->getUserMessagesSentToUser($user['id'], (int)$userid, $count, $offset);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup messages.');
            http_response_code(500); return;
        }


        // Format and display messages.
        $this->printJSON($this->formatRecords($results));
    }





    /**
     * Sends a user message to another user.
     */
    public function sendUserMessage($receiver_id) {
        // Check user is signed in. Authorization not required. (gets sender)
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Check content param given.
        if (!isset($_POST['content'])) {
            $this->printMessage('`content` parameter not given in POST body.');
            http_response_code(400); return;
        }

        // Get and validate content.
        $json = $this->validateJSON($_POST['content']);
        if (!isset($json)) {
            $this->printMessage('`content` parameter is invalid or does not contain required fields.');
            http_response_code(400); return;
        }


        // Attempt to create message and user_message records.
        $results = $this->db->createUserMessage($user['id'], (int)$receiver_id, $json['message']);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to send message.');
            http_response_code(500); return;
        }
    }




    /**
     * Deletes a user message by id. Deleting the message will automaticaly delete the associated user_message/group_messages record.
     * @param id - id of message.
     */
    public function deleteUserMessage($id) {
        // Check user is signed in. Authorization not required. (gets sender)
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Attempt delete.
        $results = $this->db->deleteUserMessage((int)$id, $user['id']);
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to delete message.');
            http_response_code(500); return;
        }
    }



    /**
     * Formats records for output.
     * @param records - records to be formatted.
     */
    public function formatRecords($records) {
        $results = array();
        foreach ($records as $rec) {
            $values = array();
            $values['id'] = (int)$rec['id'];
            $values['message'] = $rec['message'];
            $values['date'] = $rec['date'];
            // Sender values.
            if (isset($rec['sender_id'])) { $values['sender_id'] = $rec['sender_id']; }
            if (isset($rec['sender_displayname'])) { $values['sender_displayname'] = $rec['sender_displayname']; }
            // Receiver values.
            if (isset($rec['receiver_id'])) { $values['receiver_id'] = $rec['receiver_id']; }
            if (isset($rec['receiver_displayname'])) { $values['receiver_displayname'] = $rec['receiver_displayname']; }
            array_push(
                $results,
                $values
            );
        }
        return $results;
    }


    /**
     * Validates incoming json to ensure it is valid and contains required values.
     * @param json - json to be validated.
     */
    public function validateJSON($json) {
        // Try to parse.
        try {
            $object = json_decode($json, true);
        } catch (Exception $e) {
            return null;
        }

        // Check if has required fields.
        if (!isset($object) ||
            !isset($object['message'])) {
            return null;
        }

        return $object;
    }























    // *******************************************************
    // ***** EXPERIMENTAL IM CHAT MESSAGE SYSTEM METHODS *****
    // ***** MAY OR MAY NOT BE USED (CURRENTLY TESTING)  *****
    // *******************************************************
    /**
     * Gets messages sent between the current user (determined by authorization token) and the specified other user.
     * @param otherUserId - id of other user in the chat.
     */
    public function getCurrentUserChat($otherUserId) {
        // Check user is signed in. Authorization not required. (gets sender)
        $user = Auth::validateSession(false);
        if (!isset($user)) {
            http_response_code(401); return;
        }


        // Get GET params if set.
        $date = App::getGETParameter('date', null, false);
        $count = App::getGETParameter('count', 10, true);
        $offset = App::getGETParameter('offset', 0, true);


        // If date param given, get messages sent after date, ignoring count and offset.
        // Else get all messages between users, based on count and offset.
        if (isset($date)) {
            // Validate date with regex.
            if (!preg_match('/^\d{4}\-\d{2}\-\d{2} ([01][0-9]|2[0-3]):[0-5]\d:[0-5]\d$/', $date)) {
                $this->printMessage('Given date is not valid.');
                http_response_code(400); return;
            }
            $results = $this->db->getUserChatSinceDate($user['id'], $otherUserId, $date);
        } else {
            $results = $this->db->getUserChat($user['id'], $otherUserId, $count, $offset);
        }


        // Check results fetched successfully.
        if (!isset($results)) {
            $this->printMessage('Something went wrong. Unable to lookup messages between specified users.');
            http_response_code(500); return;
        }


        // Output results.
        $this->printJSON($this->formatRecords($results));
    }

}