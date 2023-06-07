<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

$name = $REQ['name']??false;
$phone = $REQ['phone']??false;
$email = $REQ['email']??false;
$password = md5($REQ['password'])??false;

if ($name&&$phone&&$email&&$password){
    $id = insert("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)", [$name, $phone, $email, $password]);
}

api_response(["update_time" => date("d/m-y"),"id"=>$id??false]);
?>