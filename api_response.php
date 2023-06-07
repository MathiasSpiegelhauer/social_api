<?php
function api_response($data=[]){
    $api_response['content']=$data;
    echo json_encode($api_response);
}