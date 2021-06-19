<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../functions.php';
include_once '../../config/Database.php';
include_once '../../models/Leaderboard.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 $method = $_SERVER['REQUEST_METHOD'];

 $q = $_GET['q'];
 $params = explode('/', $q);
 $type = $params[0];

 switch($type){
     case "getleaderboard":
        switch($method){
            case "GET":
                getLeaderboard($db);
                break;
            case "POST":
                showForbidden("POST");
                break;
            case "DELETE":
                showForbidden("DELETE");
                break;
            case "PUT":
                showForbidden("PUT");
                break;
        }
        break;
     case "addleaderboard":
        switch($method){
            case "GET":
                showForbidden("GET");
                break;
            case "POST":
                addToLeaderboard($db);
                break;
            case "DELETE":
                showForbidden("DELETE");
                break;
            case "PUT":
                showForbidden("PUT");
                break;
        }
        break;

     default:
        http_response_code(404);
        break;
 }