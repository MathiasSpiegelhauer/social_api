<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

$user = fetch_assoc("SELECT id FROM users where email = ? AND password = ?", [$REQ['email'],md5($REQ['password'])])??false;

if ($user){
    $token = bin2hex(random_bytes(20));
    update("UPDATE users SET token = ?, token_exp = ? WHERE id = ?",[$token,date("Y-m-d H:i:s", strtotime('+10 hours')),$user['id']]);
    $api_response['token'] = $token;
    $api_response['user_id'] = $user['id'];
}
api_response($api_response);
?>