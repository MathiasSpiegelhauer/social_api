<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');
check_login($REQ['user_id'],$REQ['token']);

$title = $REQ['title']??false;
$description = $REQ['description']??false;
$creator_id = fetch_assoc("SELECT id FROM users WHERE id = ?",[$REQ['user_id']])['id']??false;
$address = $REQ['address']??false;
$lat = $REQ['lat']??false;
$long = $REQ['long']??false;

if ($title&&$description&&$creator_id&&$address&&$lat&&$long){
    $id = insert("INSERT INTO events (title, description, creator_id, address, latitude, longtitude) VALUES (?, ?, ?, ?, ?, ?)", [$title, $description, $creator_id, $address, $lat, $long]);
}

api_response(["update_time" => date("d/m-y"),"id"=>$id??false]);
?>