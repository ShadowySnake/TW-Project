<?php

class Users {
    // DB Stuff
    private $conn;
    private $table = 'users';

    // Users Properties
    public $id;
    public $name;
    public $password;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get the users from database
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        u.id,
        u.name,
        u.password 
        FROM
         ' . $this->table . ' u';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    // Create User
    public function create() {
      // Create the query
      $query = 'INSERT INTO ' . $this->table . ' SET name = :name, password = :password';

      // Prepare the statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->password = htmlspecialchars(strip_tags($this->password));

      // Bind the data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':password', $this->password);

      // Execute query
      if($stmt->execute()) {
        return true;
   }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

   public function update() {
      // Create the query
      $query = 'UPDATE ' . $this->table . '
                          SET name = :name, password = :password
                          WHERE id = :id';

      // Prepare the statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind the data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
   }

   // Delete Post
   public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
   }

}