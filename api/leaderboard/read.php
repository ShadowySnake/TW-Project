<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Leaderboard.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 // Instantiate the request
 $leaderBoard = new Leaderboard($db);

 // The querry
 $result = $leaderBoard->read();

 $leader_arr = array();
     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);
         $item_arr = array(
             'name' => $name,
             'time' => $time
         );
    array_push($leader_arr, $item_arr);
  }
echo json_encode($leader_arr);
?>