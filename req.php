<?php
function collect_variables()
{
    $_POST = json_decode(file_get_contents('php://input'), true);
    $REQ = [];
    foreach ($_GET as $key=>$item){
        $REQ[$key]=$item;
    }
    foreach ($_POST as $key=>$item){
        $REQ[$key]=$item;
    }
    return $REQ;
}