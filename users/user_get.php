<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

$user = fetch_assoc("SELECT name, phone, email FROM users where id = ?", [$REQ['id']])??false;

if ($user){
    $api_response['name'] = $user['name'];
    $api_response['phone'] = $user['phone'];
    $api_response['email'] = $user['email'];
}

api_response($api_response);


?>