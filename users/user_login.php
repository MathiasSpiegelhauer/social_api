<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

$user = fetch_assoc("SELECT id,token,email,phone,name FROM users where email = ? AND password = ?", [$REQ['email'],hash("sha512", $REQ['password'])])??false;

if ($user){
    $session_token = bin2hex(random_bytes(20));
    $session_token_exp = date("Y-m-d H:i:s", strtotime('+10 hours'));
    update("UPDATE users SET session = ?, session_exp = ? WHERE id = ?",[$session_token,$session_token_exp,$user['id']]);
    $api_response = [
        "token" => $user['token'],
        "email" => $user['email'],
        "phone" => $user['phone'],
        "name" => $user['name'],
        "session" => $session_token,
        "session_exp" => $session_token_exp
    ];
    api_response($api_response);
}else{
    api_response([],401);
}
?>