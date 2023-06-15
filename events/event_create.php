<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');
$user = check_login($REQ['user_token'],$REQ['session']);

$title = $REQ['title']??false;
$address = $REQ['address']??false;
$description = $REQ['description']??false;
$lat = $REQ['latitude']??false;
$long = $REQ['longitude']??false;
$token = generateRandomString(25);


if ($title&&$description&&$address&&$lat&&$long){
    $id = insert("INSERT INTO events (token, title, description, creator_id, address, latitude, longtitude) VALUES (?,?, ?, ?, ?, ?, ?)", [$token, $title, $description, $user['id'], $address, $lat, $long]);
}
if(isset($id)){
    api_response(["created_time" => date("d/m-y")],201);
}else{
    api_response([],400);
}
?>