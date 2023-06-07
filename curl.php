<?php
function curl_get_api($url, $parameters){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url."?".$parameters);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return json_decode($response);
}