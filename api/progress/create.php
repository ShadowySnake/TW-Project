<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Progress.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate progress object
  $progress = new Progress($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $progress->name = $data->name;

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