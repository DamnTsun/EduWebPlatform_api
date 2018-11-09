<?php

class Model_Post extends Model {

    /**
     * Gets posts ordered by creation date.
     * Gets the specified number of posts. (default 10)
     */
    public function getNewestPosts($count = 10, $offset = 0) {
        // Disable performance mode since it converts ints to strings. Re-enable after.
        $this->setPDOPerformanceMode(false);
        return $result = $this->query(
            "SELECT
                posts.title,
                posts.body,
                posts.date,
                CONCAT (users.forename, ' ', users.surname) AS 'author'
            FROM
                posts,
                users
            WHERE
                posts.user_id = users.id
            ORDER BY
                posts.date DESC
            LIMIT :_count OFFSET :_offset",
            array(
                ':_count' => $count,
                ':_offset' => $offset
            ),
            Model::TYPE_FETCHALL
        );
    }



    /**
     * Adds a new post with the given title, body, and current timestamp.
     */
    public function addPost($title, $body, $user_id) {
        $result = $this->query(
            'INSERT INTO
                `posts` (`title`, `body`, `date`, `user_id`)
            VALUES
                (:title, :body, CURRENT_TIMESTAMP(), :userId)',
            array(
                ':title' => $title,
                ':body' => $body,
                ':userId' => $user_id),
            Model::TYPE_INSERT
        );

        return $result;
    }
}