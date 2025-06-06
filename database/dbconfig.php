<?php

class DatabaseConnection {
    private $host = 'localhost';
    private $database = 'u568098831_gamedistro';
    private $user = 'u568098831_gamedistro';
    private $password = 'gamedistro1A!';
    private $conn;

    /**
     * @return PDO
     */
    public function getConn()
    {
        return $this->conn;
    }

    // Constructor to initialize the connection
    public function __construct() {

        try {
            // Create the PDO connection
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Method to execute a query
    public function query($sql) {
        return $this->conn->query($sql);
    }

    /**
     * Method to create a prepared query for prevention of SQL injection.
     * It will also sanitize the inputs to prevent insertion of html entities.
     */
    public function executePreparedQuery($sql, $args) {
        $statement = $this->conn->prepare($sql);
        foreach ($args as $key => $value){
            $args[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        $statement->execute($args);
        return $statement;
    }

    // Destructor to close the connection when the object is destroyed
    public function __destruct() {
        if ($this->conn) {
            $this->conn = null;
        }
    }
}