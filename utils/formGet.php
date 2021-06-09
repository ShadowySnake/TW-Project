<?php
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
            echo '<script src="js/userFinder.js"></script>';
        }
    }
?>