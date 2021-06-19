<?php

 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 require '../functions.php';
 include_once '../../config/Database.php';
 include_once '../../models/Users.php';

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

 switch($method){
     case "GET":
        
        switch($type){
            case("getuser"):
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
            case("createuser"):
                showForbidden("GET");
                break;
            case("deleteuser"):
                showForbidden("GET");
                break;
            case("updateuser"):
                showForbidden("GET");
                break;
            default:
                http_response_code(404);
                break;
        }
        
         break;
    case "POST":
        switch($typeOTHER){
            case("getuser"):
                showForbidden("POST");
                break;
            case("createuser"):
                createUser($db);
                break;
            case("deleteuser"):
                showForbidden("POST");
                break;
            case("updateuser"):
                showForbidden("POST");
                break;
            default:
                http_response_code(404);
                break;
        }

        break;
    case "DELETE":
        switch($typeOTHER){
            case("getuser"):
                showForbidden("DELETE");
                break;
            case("createuser"):
                showForbidden("DELETE");
                break;
            case("deleteuser"):
                deleteUser($db);
                break;
            case("updateuser"):
                showForbidden("DELETE");
                break;
            default:
                http_response_code(404);
                break;
        }

        break;
    case "UPDATE":
        switch($typeOTHER){
            case("getuser"):
                showForbidden("PUT");
                break;
            case("createuser"):
                showForbidden("PUT");
                break;
            case("deleteuser"):
                showForbidden("PUT");
                break;
            case("updateuser");
                updateUser($db);
                break;
            default:
                http_response_code(404);
                break;
        }

        break;
    default:
        http_response_code(404);
        break;
 }