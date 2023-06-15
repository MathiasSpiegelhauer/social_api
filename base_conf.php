<?php

include_once "db_con.php";
include_once "req.php";
include_once "api_response.php";
include_once "formats.php";
include_once "curl.php";
include_once "check_login.php";
header('Access-Control-Allow-Origin: *');
ini_set("display_errors", 0);

$tools = [];

$tools[] = $REQ = collect_variables();
$tools[] = $api_response = [];


function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

return $tools;