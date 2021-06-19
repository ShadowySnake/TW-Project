<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../functions.php';
include_once '../../config/Database.php';
include_once '../../models/Progress.php';

 // Instantiating DB & connection
 $database = new Database();
 $db = $database->connect();

 $method = $_SERVER['REQUEST_METHOD'];

 $q = $_GET['q'];
 $params = explode('/', $q);
 $type = $params[0];
 

 switch($type){
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
    default:
       http_response_code(404);
       break;
}