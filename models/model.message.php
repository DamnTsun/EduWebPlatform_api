<?php

class Model_Message extends Model {

    
    /**
     * Gets messages sent to a user, ordered by date (newest).
     * @param id - id of user.
     * @param count - number of messages to get.
     * @param offset - number of messages to skip.
     */
    public function getUserMessages($id, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    users.id AS 'sender_id',
                    users.displayName as 'sender_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    messages.sender_id = users.id
                WHERE
                    user_messages.user_id = :_id
                ORDER BY
                    messages.date DESC
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_id' => $id,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets messages sent by a user.
     * @param id - id of user.
     * @param count - number of messages to get.
     * @param offset - number of messages to skip.
     */
    public function getUserMessagesSent($id, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    users.id AS 'receiver_id',
                    users.displayName AS 'receiver_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    user_messages.user_id = users.id
                WHERE
                    messages.sender_id = :_id
                ORDER BY
                    messages.date DESC
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_id' => $id,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets messages sent by a user to another user.
     * @param senderid - id of sender.
     * @param id - id of user.
     * @param count - number of messages to get.
     * @param offset - number of messages to skip.
     */    
    public function getUserMessagesSentToUser($senderid, $id, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    users.id AS 'receiver_id',
                    users.displayName AS 'receiver_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    user_messages.user_id = users.id
                WHERE
                    messages.sender_id = :_senderid
                    AND
                    user_messages.user_id = :_id
                ORDER BY
                    messages.date DESC
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_senderid' => $senderid,
                    ':_id' => $id,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Gets messages sent to a user, from a specified user, ordered by date.
     * @param id - id of user.
     * @param sender_id - id of sender.
     * @param count - number of messages to get.
     * @param offset - number of messages to skip.
     */
    public function getUserMessagesFromUser($id, $sender_id, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    users.id AS 'sender_id',
                    users.displayName as 'sender_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    messages.sender_id = users.id
                WHERE
                    user_messages.user_id = :_id
                    AND
                    messages.sender_id = :_senderid
                ORDER BY
                    messages.date DESC
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_id' => $id,
                    ':_senderid' => $sender_id,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }



    /**
     * Creates a message.
     * @param sender_id - sender of message.
     * @param message - contents of message.
     */
    private function createMessageRecord($sender_id, $message) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "INSERT INTO
                    messages
                    (
                        sender_id,
                        message
                    )
                    VALUES
                    (
                        :_senderid,
                        :_message
                    )",
                array(
                    ':_senderid' => $sender_id,
                    ':_message' => $message
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Creates user_messages record, linking a user and a message they have received.
     * @param user_id - receiver of message.
     * @param message_id - id of messages record for message.
     */
    private function createUserMessageRecord($user_id, $message_id) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "INSERT INTO
                    user_messages
                    (
                        user_id,
                        message_id
                    )
                    VALUES
                    (
                        :_userid,
                        :_messageid
                    )",
                array(
                    ':_userid' => $user_id,
                    ':_messageid' => $message_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }



    /**
     * Sends a user message to the specified user.
     * @param id - receiver of message.
     */
    public function createUserMessage($sender_id, $receiver_id, $message) {
        // Create messages record.
        $messageid = $this->createMessageRecord($sender_id, $message);
        if (!isset($messageid)) { return null; }

        // Create userMessages record associated with messages record.
        $userMessageid = $this->createUserMessageRecord($receiver_id, $messageid);

        return $messageid;
    }



    /**
     * Deletes the user_messages record with given id.
     * If and only if the given user_id is for the sender or receiver of message.
     * @param message_id - id of message.
     * @param user_id - id of sender/receiver.
     */
    public function deleteUserMessage($message_id, $user_id) {
        $this->setPDOPerformanceMode(false);
        try {
            // Only need to delete messages record. Delete will cascade and delete associated user_messages record.
            return $this->query(
                "DELETE FROM
                    messages
                WHERE
                    messages.id = :_messageid
                    AND
                    (
                        messages.sender_id = :_senderid
                        OR
                        (
                            SELECT
                                user_messages.user_id
                            FROM
                                user_messages
                            WHERE
                                user_messages.message_id = messages.id
                                AND
                                user_messages.user_id = :_receiverid1
                        ) = :_receiverid2
                    )",
                array(
                    ':_messageid' => $message_id,
                    ':_senderid' => $user_id,
                    ':_receiverid1' => $user_id,
                    ':_receiverid2' => $user_id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            echo $e;
            return null;
        }
    }

























    // *******************************************************
    // ***** EXPERIMENTAL IM CHAT MESSAGE SYSTEM METHODS *****
    // ***** MAY OR MAY NOT BE USED (CURRENTLY TESTING)  *****
    // *******************************************************
    /**
     * Get message sent between 2 specified user, with the specified id.
     * @param userid1 - id of one user.
     * @param userid2 - id of other user.
     * @param messageid - id of message.
     */
    public function getUserChatMessageByID($userid1, $userid2, $messageid) {
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    messages.sender_id,
                    users.displayName AS 'sender_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    messages.sender_id = users.id
                WHERE
                    -- Get messages sent between the 2 users.
                    (
                        -- Sent to user 1 from user 2
                        user_messages.user_id = :_userid1_0 AND messages.sender_id = :_userid2_0
                        OR
                        -- Sent to user 2 from user 1
                        user_messages.user_id = :_userid2_1 AND messages.sender_id = :_userid1_1
                    )
                    AND
                    -- Get message with specified id.
                    messages.id = :_messageid",
                array(
                    ':_userid1_0' => $userid1,
                    ':_userid1_1' => $userid1,
                    ':_userid2_0' => $userid2,
                    ':_userid2_1' => $userid2,
                    ':_messageid' => $messageid
                    
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Gets messages sent between 2 specified users, ordered by date (newest).
     * @param userid1 - id of one user in chat.
     * @param userid2 - id of other user in chat.
     * @param count - how many messages to get.
     * @param offset - how many messages to skip.
     */
    public function getUserChat($userid1, $userid2, $count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    messages.sender_id,
                    users.displayName AS 'sender_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    messages.sender_id = users.id
                WHERE
                    -- Get messages sent between the 2 users.
                    (
                        -- Sent to user 1 from user 2
                        user_messages.user_id = :_userid1_0 AND messages.sender_id = :_userid2_0
                        OR
                        -- Sent to user 2 from user 1
                        user_messages.user_id = :_userid2_1 AND messages.sender_id = :_userid1_1
                    )
                -- Order by newest date. Should sort messages into order, forming a chain of messages.
                ORDER BY messages.date DESC
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_userid1_0' => $userid1,
                    ':_userid1_1' => $userid1,
                    ':_userid2_0' => $userid2,
                    ':_userid2_1' => $userid2,
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Gets messages sent between 2 specified users, ordered by date (newest), sent after the specified timestamp.
     * @param userid1 - id of one user in chat.
     * @param userid2 - id of other user in chat.
     * @param date - date to get messages after.
     */
    public function getUserChatSinceDate($userid1, $userid2, $date) {
        try {
            return $this->query(
                "SELECT
                    messages.id,
                    messages.message,
                    messages.date,
                    messages.sender_id,
                    users.displayName AS 'sender_displayname'
                FROM
                    user_messages
                JOIN messages ON
                    user_messages.message_id = messages.id
                JOIN users ON
                    messages.sender_id = users.id
                WHERE
                    -- Get messages sent between the 2 users.
                    (
                        -- Sent to user 1 from user 2
                        user_messages.user_id = :_userid1_0 AND messages.sender_id = :_userid2_0
                        OR
                        -- Sent to user 2 from user 1
                        user_messages.user_id = :_userid2_1 AND messages.sender_id = :_userid1_1
                    )
                    AND
                    messages.date > :_date
                -- Order by newest date. Should sort messages into order, forming a chain of messages.
                ORDER BY messages.date DESC",
                array(
                    ':_userid1_0' => $userid1,
                    ':_userid1_1' => $userid1,
                    ':_userid2_0' => $userid2,
                    ':_userid2_1' => $userid2,
                    ':_date' => $date
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}