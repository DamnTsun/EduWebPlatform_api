<?php

class Model_Subject extends Model {

    /**
     * Checks a subject exists with the given name.
     * @param $name - Name of subject being looked for.
     */
    public function checkSubjectExists($name) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id
                FROM
                    subjects
                WHERE
                    subjects.name = :_name
                LIMIT 1",
                array(
                    ':_name' => $name
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Checks a subject exists with the given id.
     * @param $id - ID of subject being looked for.
     */
    public function checkSubjectExistsByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id
                FROM
                    subjects
                WHERE
                    subjects.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_BOOL
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    public function getAllSubjects($count, $offset) {
        $this->setPDOPerformanceMode(false);
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.homepageContent
                FROM
                    subjects
                ORDER BY
                    subjects.name
                LIMIT :_count OFFSET :_offset",
                array(
                    ':_count' => $count,
                    ':_offset' => $offset
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return null;
        }
    }


    public function getSubjectByID($id) {
        try {
            return $results = $this->query(
                "SELECT
                    subjects.id,
                    subjects.name,
                    subjects.description,
                    subjects.homepageContent
                FROM
                    subjects
                WHERE
                    subjects.id = :_id
                LIMIT 1",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_FETCHALL
            );
        } catch (PDOException $e) {
            return false;
        }
    }





    public function addSubject($name, $description, $homepageContent) {
        try {
            return $results = $this->query(
                "INSERT INTO
                    subjects (name, description, homepageContent)
                VALUES
                    (
                        :_name,
                        :_desc,
                        :_hpContent
                    )",
                array(
                    ':_name' => $name,
                    ':_desc' => $description,
                    ':_hpContent' => $homepageContent
                ),
                Model::TYPE_INSERT
            );
        } catch (PDOException $e) {
            return null;
        }
    }





    /**
     * Modifies values of existing subject.
     * @param id - id of subject.
     * @param name - name for subject. Is ignored if null.
     * @param description - description for subject. Is ignored if null.
     * @param homepageContent - homepageContent for subject. Is ignored if null.
     */
    public function modifySubject($id, $name, $description, $homepageContent) {
        // Build string with variable number of fields.
        $queryString = "UPDATE subjects SET ";
        $queryParams = array();
        // name
        if (isset($name)) {
            $queryString = $queryString . "subjects.name = :_name";
            $queryParams[':_name'] = $name;
        }
        // description
        if (isset($description)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "subjects.description = :_desc";
            $queryParams[':_desc'] = $description;
        }
        // homepageContent
        if (isset($homepageContent)) {
            // Add ', ' if another field has already been added.
            if (sizeof($queryParams) > 0) { $queryString = $queryString . ", "; }
            $queryString = $queryString . "subjects.homepageContent = :_hpContent";
            $queryParams[':_hpContent'] = $homepageContent;
        }

        // end query string.
        $queryString = $queryString . " WHERE subjects.id = :_id LIMIT 1";
        $queryParams[':_id'] = $id;
        try {
            return $result = $this->query(
                $queryString,
                $queryParams,
                Model::TYPE_UPDATE
            );
        } catch (PDOException $e) {
            echo $e;
            return null;
        }
    }





    public function deleteSubject($id) {
        try {
            return $results = $this->query(
                "DELETE FROM
                    subjects
                WHERE
                    subjects.id = :_id",
                array(
                    ':_id' => $id
                ),
                Model::TYPE_DELETE
            );
        } catch (PDOException $e) {
            return false;
        }
    }
}