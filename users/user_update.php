<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/api/base_conf.php";
header('Access-Control-Allow-Origin: *');
check_login($REQ['user_id'],$REQ['token']);

$allowed_updates = [
    "phone"
];

$sql = "UPDATE users SET ";
$keys = "";
$values_real = [];

foreach ($REQ as $key => $value) {
    if (in_array($key, $allowed_updates)) {
        $keys = $keys . $key . " = ?,";
        $values_real[] = $value;
    }
}
$keys = rtrim($keys, ",");
$sql = $sql . $keys . " WHERE id = ?";
$values_real[] = $REQ['id'];

update($sql, $values_real);


api_response(["update_time" => date("d/m-y")]);
?>