<?php

class Leaderboard {
    //DB stuff
    private $conn;
    private $table = 'leaderboard';

    //Answer props
    public $name;
    public $time;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getting the answers
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        l.name,
        l.time
        FROM
         ' . $this->table . ' l';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }
}