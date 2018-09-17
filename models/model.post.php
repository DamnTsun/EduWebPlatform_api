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
            'SELECT `title`, `body`, `date` FROM `posts` LIMIT :_count OFFSET :_offset',
            array(':_count' => $count, ':_offset' => $offset),
            Model::TYPE_FETCHALL
        );
    }



    /**
     * Adds a new post with the given title, body, and current timestamp.
     */
    public function addPost($title, $body) {
        $result = $this->query(
            'INSERT INTO `posts` (`title`, `body`, `date`) VALUES (:title, :body, CURRENT_TIMESTAMP())',
            array(':title' => $title, ':body' => $body),
            Model::TYPE_INSERT
        );

        return $result;
    }
}