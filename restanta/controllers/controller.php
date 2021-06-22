<?php

/**
 * @OA\Info(title="LeHS API", version="0.1")
 */


class Answers {
    //DB stuff
    private $conn;
    private $table = 'answers';

    //Answer props
    public $id;
    public $question;
    public $hint;
    public $answer;
    public $lang;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * @OA\Get(path="/TW-Project/api/getanswers", tags={"Answers"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        a.id,
        a.question,
        a.hint,
        a.answer,
        a.lang
        FROM
         ' . $this->table . ' a';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }
}

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

    /**
     * @OA\Get(path="/TW-Project/api/getleaderboard", tags={"Leaderboard"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        l.name,
        l.time,
        l.level,
        l.difficulty
        FROM
         ' . $this->table . ' l ORDER BY time ASC';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    /**
     * @OA\POST(path="/TW-Project/api/addleaderboard", tags={"Leaderboard"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","time","level","difficulty"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="time", type="integer"),
     *              @OA\Property(property="level", type="integer"),
     *              @OA\Property(property="difficulty", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
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

class Progress {
    //DB stuff
    private $conn;
    private $table = 'progress';

    //Answer props
    public $name;
    public $answernumber;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * @OA\Get(path="/TW-Project/api/getprogress", tags={"Progress"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function read(){
        // Create the querry
        $querry = 'SELECT 
        a.name,
        a.answernumber
        FROM
         ' . $this->table . ' a';

        // Preparing the statement
        $stmt = $this->conn->prepare($querry);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    public function readOne($name){
        $querry = 'SELECT 
        a.name, 
        a.answernumber
        FROM ' . $this->table. ' a WHERE a.name = :name' ;

        $stmt = $this->conn->prepare($querry);

        $stmt->bindParam(':name', $name);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

        /**
     * @OA\POST(path="/TW-Project/api/addprogress", tags={"Progress"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","answernumber"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="answernumber", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function create() {
        // Create the query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, answernumber = :answernumber';
      
        // Prepare the statement
        $stmt = $this->conn->prepare($query);      
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->answernumber = htmlspecialchars(strip_tags($this->answernumber));
        // Bind the data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':answernumber', $this->answernumber);

        // Execute query
        if($stmt->execute()) {
           return true;
        }
    }

    /**
     * @OA\PUT(path="/TW-Project/api/updateprogress", tags={"Progress"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","answernumber"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="answernumber", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function update() {
        // Create the query
        $query = 'UPDATE ' . $this->table . '
                            SET answernumber = :answernumber
                            WHERE name = :name';
  
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->answernumber = htmlspecialchars(strip_tags($this->answernumber));
  
        // Bind the data
        $stmt->bindParam(':answernumber', $this->answernumber);
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

    /**
     * @OA\GET(path="/TW-Project/api/getuser", tags={"User"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
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


    public function readUser($id){
      $querry = 'SELECT u.id, 
                        u.name, 
                        u.password 
                        FROM ' . $this->table. ' u WHERE u.id = :id ' ;
      
      $stmt = $this->conn->prepare($querry);

      $stmt->bindParam(':id', $id);

        // Executing the querry
        $stmt->execute();

        return $stmt;
    }

    /**
     * @OA\POST(path="/TW-Project/api/adduser", tags={"User"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","password"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
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

    /**
     * @OA\PUT(path="/TW-Project/api/updateuser", tags={"User"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","password"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
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

    /**
     * @OA\DELETE(path="/TW-Project/api/deleteuser", tags={"User"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="json",
     *          @OA\Schema(required={"name","password"}, 
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              ),
     *          ),
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not Found"),
     * )
     */
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
?>
