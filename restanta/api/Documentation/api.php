<?php 

require($_SERVER['DOCUMENT_ROOT'].'/TW-Project/api/vendor/autoload.php');
$openapi = \OpenApi\scan($_SERVER['DOCUMENT_ROOT'].'/TW-Project/controllers');
header('Content-type: application/json');
echo $openapi->toJSON();