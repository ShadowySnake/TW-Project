<?php
    session_start();
    unset($_SESSION['my-access-token']);
    header('Location:../WelcomingPage.php');
    die();
?>