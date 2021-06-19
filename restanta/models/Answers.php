<?php

class Answers {
    //DB stuff
    private $conn;
    private $table = 'answers';

    //Answer props
    public $id;
    public $question;
    public $hint;
    public $answer;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getting the answers
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        a.id,
        a.question,
        a.hint,
        a.answer
        FROM
         ' . $this->table . ' a';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }
}

?>