<?php

 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 require './functions.php';
 include_once '../config/Database.php';
 include_once '../controllers/controller.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 // Instantiate the request
 $method = $_SERVER['REQUEST_METHOD'];

 $q = $_GET['q'];
 $params = explode('/', $q);
 $type = $params[0];
 $paramsOTHER = explode('?', $q);
 $typeOTHER = $paramsOTHER[0];

    switch($type){
        case "getuser":
            switch($method){
                case "GET":
                if(isset($params[1])){ 
                    $id = $params[1]; 
                };
                if(isset($id)){
                    getUser($db, $id);
                }
                else{
                    getUsers($db);
                };
                break;
                default:
                http_response_code(405);
                break;
            }
            break;
        case "adduser":
            switch($method){
                case "POST":
                createUser($db);
                break;
                default:
                http_response_code(405);
                break;
            }
            break;
        case "updateuser":
            switch($method){
                case "PUT":
                    updateUser($db);
                    break;
                default:
                    http_response_code(404);
                    break;
            }
            break;
        case "getprogress":
            switch($method){
                case "GET":
                 if(isset($params[1])){ 
                     $name = $params[1]; 
                 };
                 if(isset($name)){
                     getOneProgress($db, $name);
                 }
                 else{
                     getAllProgress($db);
                 };
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
        case "addprogress":
            switch($method){
                case "POST":
                    addProgress($db);
                    break;
                default:
                    http_response_code(405);
                    break;
            }
            break;
        case "updateprogress":
             switcH($method){
                 case "GET":
                     showForbidden("GET");
                     break;
                 case "POST":
                     showForbidden("POST");
                     break;
                 case "DELETE":
                     showForbidden("DELETE");
                     break;
                 case "PUT":
                     updateProgress($db);
                     break;
             }
             break;
            
             
      
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
         
        case "getanswers":
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
         break;

        }
    

 ?>