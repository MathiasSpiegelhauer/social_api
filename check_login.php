<?php
function check_login($token,$session){
    $user = fetch_assoc("SELECT * FROM users WHERE token = ? AND session = ?", [$token,$session]) ?? false;
    if ($user && $user['session_exp'] < date("Y-m-d H:i:s", strtotime('+10 hours'))){
        return $user;
    }else{
        api_response(["authentication failed"],401);
        die();
    }
}