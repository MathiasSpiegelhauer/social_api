<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');
$user = check_login($REQ['user_token'],$REQ['session']);

$allowed_updates = [
    "title",
    "address",
    "description",
    "latitude",
    "longitude",
];

$sql = "UPDATE events SET ";
$keys = "";
$values_real = [];

foreach ($REQ as $key => $value) {
    if (in_array($key, $allowed_updates)) {
        $keys = $keys . $key . " = ?,";
        $values_real[] = $value;
    }
}
$keys = rtrim($keys, ",");
$sql = $sql . $keys . " WHERE token = ?";
$values_real[] = $REQ['token'];

update($sql, $values_real);

api_response(["update_time" => date("d/m-y")]);
?>