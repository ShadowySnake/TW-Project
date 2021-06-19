<?php
    session_start();
    unset($_SESSION['my-access-token']);
    unset($_SESSION['id']);
    header('Location:../WelcomingPage.php');
    die();
?>