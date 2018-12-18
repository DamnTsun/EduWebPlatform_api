<?php

class Model_Post extends Model {

    /**
     * Checks whether a post exists with the given subject_id and id.
     * @param subjectid - subject_id of record.
     * @param postid - id of post.
     */
    public function checkPostExistsByID($subjectid, $postid) {
        try {
            return $results = $this->query(
                "SELECT
                    posts.id
                FROM
                    posts
                WHERE
                    posts.subject_id = :_subjectid
                    AND
                    posts.id = :_id
                LIMIT 1",
                array(
                    ':_subjectid' => $subjectid,
                    ':_id' => $postid
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Gets all posts within the given subject.
     * @param subjectid - subject_id of posts to get.
     * @param count - number of posts to get - optional, default 10.
     * @param offset - number of posts to skip - optional, default 0.
     */
    public function getPostsBySubject($subjectid, $count = 10, $offset = 0) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    posts.id,
                    posts.title,
                    posts.body,
                    posts.creationDate,
                    posts.modificationDate
                FROM
                    posts
                WHERE
                    posts.subject_id = :_subjectid
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_subjectid' => $subjectid,
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
     * Gets post with the given id.
     * @param postid - id of record.
     */
    public function getPostByID($postid) {
        try {
            return $results = $this->query(
                "SELECT
                    posts.id,
                    posts.title,
                    posts.body,
                    posts.creationDate,
                    posts.modificationDate
                FROM
                    posts
                WHERE
                    posts.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $postid
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Creates a new post in the given subject, by the given user, with the given title and body.
     * @param subject_id - subject_id of post.
     * @param user_id - user_id of post.
     * @param title - title of post.
     * @param body - body of post.
     */
    public function addPost($subject_id, $user_id, $title, $body) {
        $this->setPDOPerformanceMode(false);
        try {
            return $result = $this->query(
                "INSERT INTO
                    posts (title, body, subject_id, `user_id`)
                VALUES
                    (
                        :_title,
                        :_body,
                        :_subjectid,
                        :_userid
                    )",
                array(
                    ':_title' => $title,
                    ':_body' => $body,
                    ':_subjectid' => $subject_id,
                    ':_userid' => $user_id
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            echo $e;
            return null;
        }
    }





    /**
     * Deletes post with given id.
     * @param id - id of post.
     */
    public function deletePost($id) {
        try {
            return $results = $this->query(
                "DELETE FROM
                    posts
                WHERE
                    posts.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return null;
        }
    }
}