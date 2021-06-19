<?php

class GitName {

    function getName($access_token){
            $apiURL = 'https://api.github.com/user';
            $userAgentHeader = 'User-Agent: DemoAut';
            $authHeader = 'Authorization: token ' . $access_token;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response);
            return $data->login;
    }
}
?>