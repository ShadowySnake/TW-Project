<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Answers.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 // Instantiate the request
 $answers = new Answers($db);

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
             'answer' => $answer,
             'description' => $description,
             'beginner' => $beginner,
             'intermediate' => $intermediate

         );
      array_push($answers_arr, $item_arr);
     }
    } else {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            if($id == $_GET['id']) {
            $item_arr = array(
                'id' => $id,
                'answer' => $answer,
                'description' => $description,
                'beginner' => $beginner,
                'intermediate' => $intermediate
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