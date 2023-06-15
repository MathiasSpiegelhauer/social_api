<?php

function dk_date_format($date)
{
    $pieces = explode(" ", $date);
    $dage = explode("-", $pieces[0]);
    $newformat = $dage[2] . "/" . $dage[1] . "-" . substr($dage[0], 2);
    return $newformat;
}

function api_str_contains($haystack, $needle)
{
    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}
