<?php
    function getPass($method, $pass){
        $curlConn = curl_init('localhost/TW-Project/api/users/getuser');

        curl_setopt($curlConn, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        curl_setopt($curlConn, CURLOPT_RETURNTRANSFER, 1);
        

        $output = curl_exec($curlConn);

        $data = json_decode($output, true);
        
        foreach($data as $x => $y){
          if(password_verify($pass, $y["password"])){
              $finalResult = true;
              break;
          }
          else{
              $finalResult = false;
          }
        }

        
        curl_close($curlConn);
        

        return $finalResult;
    }

    if ( isset( $_GET['submit'] ) ) 
    { 
        $username = $_GET['username']; $password = $_GET['password']; 
        if(isset($_GET['prepeat'])) {
            session_start();
            if($_GET['prepeat'] == $password) {
                echo '<div id="username">' . $username .'</div>';
                echo '<div id="password">' . $password .'</div>';
                $_SESSION['message'] = "Log in using the newly created user credentials";
                echo '<script src="js/submitter.js" onload="submitData()"></script>';
            }
            else {
                $_SESSION['message'] = "The passwords did not match!";
                header('Location: ../auth/Signup.php');
            }
        }
        else {
            echo '<div id="username">' . $username .'</div>';
            echo '<div id="password">' . $password .'</div>';
            if(getPass("GET", $password)){
                echo '<script src="js/userFinder.js"></script>';
            }
            else{
                echo "NO USER FOUND.";
            }
        }
        
    }
?>