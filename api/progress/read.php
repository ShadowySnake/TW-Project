<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Progress.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 // Instantiate the request
 $progresser = new Progress($db);

 // The querry
 $result = $progresser->read();
 // Get the number of rows
 $num = $result->rowCount();

 if(isset($_GET['name']) && (trim($_GET['name']) == '')) {
    echo json_encode(array('errmsg' => 'ID has not been set properly!'));
    die();
}

 if($num > 0){
     // The array
     $progress_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            
            if($name == $_GET['name']) {
            $item_arr = array(
                'answernumber' => $answernumber,
                'time' => $time
            );
            array_push($progress_arr, $item_arr);
            break;
           }
        }

    // Turning it to JSON
    echo json_encode($progress_arr);
 } else {
    // Nothing found
    echo json_encode(array(
        'errmsg' => 'Nothing found') );
 }