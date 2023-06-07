<?php

include_once "db_con.php";
include_once "req.php";
include_once "api_response.php";
include_once "formats.php";
include_once "curl.php";
include_once "check_login.php";
header('Access-Control-Allow-Origin: *');

$tools = [];

$tools[] = $REQ = collect_variables();
$tools[] = $api_response = ["status"=>200];

return $tools;