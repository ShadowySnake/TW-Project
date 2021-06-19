<?php

 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 require '../functions.php';
 include_once '../../config/Database.php';
 include_once '../../models/Answers.php';

 $database = new Database();
 $db = $database->connect();

 $method = $_SERVER['REQUEST_METHOD'];

 $q = $_GET['q'];


 if($q == "getanswers"){
    switch($method){
        case "POST":
            showForbidden("POST");
            break;
        case "GET":
            getAnswer($db);
            break;
        case "DELETE":
            showForbidden("DELETE");
            break;
        case "PUT":
            showForbidden("PUT");
            break;
        default:
            http_response_code(405);
            break;
     }
 } else{
    http_response_code(404);
 }
 