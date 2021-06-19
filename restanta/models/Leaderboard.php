<?php

class Leaderboard {
    //DB stuff
    private $conn;
    private $table = 'leaderboard';

    //Answer props
    public $name;
    public $time;
    public $level;
    public $difficulty;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getting the answers
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        l.name,
        l.time,
        l.level,
        l.difficulty
        FROM
         ' . $this->table . ' l';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    //Create a new entity
    public function create() {
        // Create the query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, time = :time, level = :level, difficulty = :difficulty';
      
        // Prepare the statement
        $stmt = $this->conn->prepare($query);      
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->difficulty = htmlspecialchars(strip_tags($this->difficulty));
            
        // Bind the data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':level', $this->level);
        $stmt->bindParam(':difficulty', $this->difficulty);
      
        // Execute query
        if($stmt->execute()) {
           return true;
        }
    }
}