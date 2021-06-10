<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Leaderboard.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate leaderboard object
  $lBoard = new Leaderboard($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $lBoard->name = $data->name;
  $lBoard->time = $data->time;


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