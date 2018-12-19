<?php

class Model {
    
    // Constants
    const TYPE_FETCHALL = 'fetchAll';
    const TYPE_ROWCOUNT = 'rowcount';
    const TYPE_BOOL = 'boolean';
    const TYPE_INSERT = 'insert';
    const TYPE_UPDATE = 'update';
    const TYPE_DELETE = 'delete';

    // Connection to database.
    private $conn;


    /**
     * Initializes new instance of Model.
     * Automatically attempts to connect to MySQL database based on values in $_ENV.
     */
    public function __construct() {
        $this->connect();
    }


    /**
     * Attempts to connect to MySQL database based on values in $_ENV.
     */
    private function connect() {
        $dsn = 'mysql:host=' . $_ENV['db_host'] . ';dbname=' . $_ENV['db_name'] . ';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $this->conn = new PDO($dsn, $_ENV['db_user'], $_ENV['db_pass'], $options);
    }





    /**
     * Performs a query on the database.
     * @param query - query to be executed.
     * @param params - parameters for query (parameterized queries)
     * @param type - type of query. (fetchall, insert, rowcount, etc) (use constants defined by this class)
     */
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
                case $this::TYPE_UPDATE:
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


    /**
     * Sets whether parameter values can be implicitly converted when executing a query with parameters.
     * Sometimes it can be a problem. Only disable if necessary.
     * @param state - boolean. whether implicit conversions should be enabled.
     */
    protected function setPDOPerformanceMode($state) {
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, $state);
    }

}