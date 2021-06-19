<?php
function getUserDB($users, $result){

 $num = $result->rowCount();

 if(isset($_GET['id']) && (trim($_GET['id']) == '')) {
   echo json_encode(array('errmsg' => 'ID has not been set properly!'));
   die();
 }

 if($num > 0){
    // The array

    $users_arr = array();

    if(!isset($_GET['id'])) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $item_arr = array(
            'id' => $id,
            'name' => $name,
            'password' => $password
        );
     array_push($users_arr, $item_arr);
    }
   } else {
       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
           extract($row);
           
           if($id == $_GET['id']) {
           $item_arr = array(
               'id' => $id,
               'name' => $name,
               'password' => $password
           );
           array_push($users_arr, $item_arr);
           break;
          }
       }
   }

   // Turning it to JSON
   echo json_encode($users_arr);
 } else {
   // Nothing found
   http_response_code(404);
   $res = [
    "status" => false,
    "message" => "User not found"
    ];
    echo json_encode($res);
 }
}

function getUsers($connect){

    $users = new Users($connect);
    // The querry
    $result = $users->read();

    getUserDB($users,$result);

}


function getUser($connect, $id){

    $users = new Users($connect);

    $result = $users->readUser($id);

    getUserDB($users, $result);
}


function createUser($connect){
    $user = new Users($connect);
        $data = json_decode(file_get_contents("php://input"));
        $user->name = $data->name;
        $user->password = password_hash($data->password, PASSWORD_DEFAULT);
      if($user->create()) {
        $res = ["status" => true,
                "message" => 'User created'];
        echo json_encode($res);
      } else {
        $res = ["status" => false,
                "message" => 'Cannot create user'];
        echo json_encode($res);
      };

}

function deleteUser($connect){
    $user = new Users($connect);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $user->id = $data->id;

  // Delete user
    if($user->delete()) {
        $res = ["status" => true,
                "message" => 'User deleted'];
        echo json_encode($res);
    } else {
        $res = ["status" => false,
                "message" => 'Cannot delete user'];
        echo json_encode($res);
  }
}

function updateUser($connect){
  $user = new Users($connect);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $user->id = $data->id;
  $user->name = $data->name;
  $user->password = $data->password;

  // Update user
  if($user->update()) {
    $res = ["status" => true,
    "message" => 'User Updated'];
    echo json_encode($res);
  } else {
    $res = ["status" => false,
    "message" => 'Cannot update user'];
    echo json_encode($res);
  }
}

function showForbidden($method){
    http_response_code(405);
    $res = ["status" => false,
            "message" => "$method forbidden"];
    echo json_encode($res);
}

function getAnswer($connect){ 

 $answers = new Answers($connect);

 // The querry
 $result = $answers->read();
 // Get the number of rows
 $num = $result->rowCount();

 if(isset($_GET['id']) && (trim($_GET['id']) == '')) {
    echo json_encode(array('errmsg' => 'ID has not been set properly!'));
    die();
 }

 if($num > 0){
     // The array
     $answers_arr = array();

     if(!isset($_GET['id'])) {
     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);
         $item_arr = array(
             'id' => $id,
             'question' => $question,
             'hint' => $hint,
             'answer' => $answer

         );
      array_push($answers_arr, $item_arr);
     }
    } else {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            if($id == $_GET['id']) {
            $item_arr = array(
              'id' => $id,
              'question' => $question,
              'hint' => $hint,
              'answer' => $answer
            );
            array_push($answers_arr, $item_arr);
            break;
           }
        }
    }

    // Turning it to JSON
    echo json_encode($answers_arr);
 } else {
    // Nothing found
    echo json_encode(array(
        'errmsg' => 'Nothing found') );
 }
}

function getLeaderboard($connect){
 $leaderBoard = new Leaderboard($connect);

 // The querry
 $result = $leaderBoard->read();

 $leader_arr = array();
     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);
         $item_arr = array(
             'name' => $name,
             'time' => $time,
             'level' => $level,
             'difficulty' => $difficulty
         );
    array_push($leader_arr, $item_arr);
  }
 echo json_encode($leader_arr);
}

function addToLeaderboard($connect){
      // Instantiate leaderboard object
  $lBoard = new Leaderboard($connect);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $lBoard->name = $data->name;
  $lBoard->time = $data->time;
  $lBoard->level = $data->level;
  $lBoard->difficulty = $data->difficulty;


  // Create progress
  if($lBoard->create()) {
    echo json_encode(
      array('message' => 'Created success!')
    );
  } else {
    echo json_encode(
      array('message' => 'Could not create!')
    );
  }
}

function getProgress($progresser, $result){
 // Get the number of rows
 $num = $result->rowCount();

 if(isset($_GET['name']) && (trim($_GET['name']) == '')) {
    echo json_encode(array('errmsg' => 'ID has not been set properly!'));
    die();
 }

  if($num > 0){
     // The array
     $progress_arr = array();
     if(!isset($_GET['name'])) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $item_arr = array(
                'name' => $name,
                'answernumber' => $answernumber
            );
            array_push($progress_arr, $item_arr);
          }
      } else {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          if($name == $_GET['name']) {
          $item_arr = array(
              'name' => $name,
              'answernumber' => $answernumber
          );
          array_push($progress_arr, $item_arr);
          break;
         }
        }
      }
    // Turning it to JSON
    echo json_encode($progress_arr);
  } else {
    // Nothing found
    echo json_encode(array(
        'errmsg' => 'Nothing found') );
  }
}

function getAllProgress($connect){
    // Instantiate the request
  $progresser = new Progress($connect);

 // The querry
  $result = $progresser->read();

  getProgress($progresser, $result);

}

function getOneProgress($connect, $name){
     // Instantiate the request
     $progresser = new Progress($connect);

     // The querry
     $result = $progresser->readOne($name);
    
     getProgress($progresser, $result);
     
}

function addProgress($connect){
  $progress = new Progress($connect);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $progress->name = $data->name;
  $progress->answernumber = $data->answernumber;

  // Create progress
  if($progress->create()) {
    echo json_encode(
      array('message' => 'Created success!')
    );
  } else {
    echo json_encode(
      array('message' => 'Could not create!')
    );
  }
}

function updateProgress($connect){
  $progress = new Progress($connect);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set name to update
  $progress->name = $data->name;
  $progress->answernumber = $data->answernumber;

  // Update progress
  if($progress->update()) {
    echo json_encode(
      array('message' => 'User Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Updated')
    );
  }
}