<?php
class Progress {
    //DB stuff
    private $conn;
    private $table = 'progress';

    //Answer props
    public $name;
    public $answernumber;
    public $time;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getting the number of answered questions for a person
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        a.name,
        a.answernumber,
        a.time
        FROM
         ' . $this->table . ' a';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    // Create new progress instance for a person
    public function create() {
        // Create the query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name';
      
        // Prepare the statement
        $stmt = $this->conn->prepare($query);      
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
            
        // Bind the data
        $stmt->bindParam(':name', $this->name);
      
        // Execute query
        if($stmt->execute()) {
           return true;
        }
    }

    public function update() {
        // Create the query
        $query = 'UPDATE ' . $this->table . '
                            SET answernumber = :answernumber, time = :time
                            WHERE name = :name';
  
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->answernumber = htmlspecialchars(strip_tags($this->answernumber));
  
        // Bind the data
        $stmt->bindParam(':answernumber', $this->answernumber);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':name', $this->name);
  
        // Execute query
        if($stmt->execute()) {
          return true;
        }
  
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
     }
}
?>