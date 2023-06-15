<?php
function api_response($data=[], $status = 200){
    $api_response = [
        "status" => $status,
        "content" => $data  
    ];
    echo json_encode($api_response);
}