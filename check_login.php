<?php
function check_login($id,$token){
    $user = fetch_assoc("SELECT token_exp FROM users WHERE id = ? AND token = ?", [$id,$token])['token_exp']??false;
    if ($user && $user < date("Y-m-d H:i:s", strtotime('+10 hours'))){
        return true;
    }else{
        api_response(["authentication failed"]);
        die();
    }
}