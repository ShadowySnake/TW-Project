<?php
    $code = $_GET['code'];

    if ($code == ""){
        header("Location:./Login.php");
        die();
    };

    $CLIENT_ID = "76145ce672ea3feedf50";
    $CLIENT_SECRET = "8e6aa62bab35cfcce007ec02715b0735e4c66c46";
    $URL = "https://github.com/login/oauth/access_token";


    $postParams = array(
        'client_id' => $CLIENT_ID,
        'client_secret' => $CLIENT_SECRET,
        'code' => $code
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
    
    if($data->access_token != ""){
        session_start();
        $_SESSION['my-access-token'] = $data->access_token;
        header("Location:../WelcomingPage.php");
        die();
    }

    //This callback is used only when logging in with github
?>