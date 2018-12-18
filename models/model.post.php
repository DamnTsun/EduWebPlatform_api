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

    public function addPost($subjectid, $title, $body, $user_id) {

    }

    public function deletePost($id) {

    }
}