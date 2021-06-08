<?php
    if ( isset( $_GET['submit'] ) ) 
    { 
        $username = $_GET['username']; $password = $_GET['password']; 
        if(isset($_GET['prepeat'])) {
            if($_GET['prepeat'] == $password) {
                echo '<div id="username">' . $username .'</div>';
                echo '<div id="password">' . $password .'</div>';
                echo '<script src="./submitter.js" onload="submitData()"></script>';
                header('Location:../auth/Login.php');
                die();
            }
            else echo 'THE PASSWORDS DONT MATCH';
        }
        else {
            echo 'Logging in...';
        }
    }
?>