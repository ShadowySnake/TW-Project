<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Progress.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog progress object
  $progress = new Progress($db);

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