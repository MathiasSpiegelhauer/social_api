<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

$name = $REQ['name']??'';
$phone = $REQ['phone']??'';
$email = $REQ['email']??false;
$password = md5($REQ['password'])??false;
$token = generateRandomString(25);

if ($email&&$password){
    $id = insert("INSERT INTO users (token, name, phone, email, password) VALUES (?,?, ?, ?, ?)", [$token,$name, $phone, $email, $password]);
}

api_response(["update_time" => date("d/m-y"),"id"=>$id??false]);
?>