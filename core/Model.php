<?php

class Model {
    const TYPE_FETCHALL = 'fetchAll';
    const TYPE_ROWCOUNT = 'rowcount';
    const TYPE_BOOL = 'boolean';
    const TYPE_INSERT = 'insert';
    const TYPE_DELETE = 'delete';

    private $conn;

    public function __construct() {
        $this->connect();
    }

    protected function query($query, $params = null, $type = null) {
        $stmt = $this->conn->prepare($query);
        if (!is_null($params)) {
            $result = $stmt->execute($params);
        } else {
            $result = $stmt->execute();
        }

        if (isset($type)) {
            switch ($type) {
                case $this::TYPE_FETCHALL:
                    // Return all matched records.
                    return $stmt->fetchAll();
                    break;
                case $this::TYPE_ROWCOUNT:
                    // Return rowcoiunt.
                    return $stmt->rowcount();
                    break;
                case $this::TYPE_BOOL:
                    // Return whether rowcount > 0.
                    $count = $stmt->rowcount();
                    return ($count > 0);
                    break;
                case $this::TYPE_INSERT:
                    // Return whether insert was successful.
                    return $this->conn->lastInsertId();
                    break;
                case $this::TYPE_DELETE:
                    return $stmt->rowCount() > 0;
                    break;

                default:
                    break;
            }
        }
    }


    private function connect() {
        $dsn = 'mysql:host=' . $_ENV['db_host'] . ';dbname=' . $_ENV['db_name'] . ';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $this->conn = new PDO($dsn, $_ENV['db_user'], $_ENV['db_pass'], $options);
    }


    protected function setPDOPerformanceMode($state) {
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, $state);
    }

}