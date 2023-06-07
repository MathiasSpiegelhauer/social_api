<?php
function collect_variables()
{
    $REQ = [];
    foreach ($_GET as $key=>$item){
        $REQ[$key]=$item;
    }
    foreach ($_POST as $key=>$item){
        $REQ[$key]=$item;
    }
    return $REQ;
}