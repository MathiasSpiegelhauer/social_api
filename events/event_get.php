<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

if (isset($REQ['id'])) {
    $event = fetch_assoc("SELECT title, description, address, longtitude, latitude, creator_id FROM events where id = ?", [$REQ['id']]) ?? false;

    if ($event) {
        $user = fetch_assoc("SELECT name, phone, email FROM users where id = ?", [$event['creator_id']]) ?? false;
        $api_response['title'] = $event['title'];
        $api_response['description'] = $event['description'];
        $api_response['address'] = $event['address'];
        $api_response['longtitude'] = $event['longtitude'];
        $api_response['latitude'] = $event['latitude'];
        $api_response['creator_name'] = $user['name'];
        $api_response['creator_phone'] = $user['phone'];
        $api_response['creator_email'] = $user['email'];
    }
}else{
    if (isset($REQ['lat']) && isset($REQ['long'])) {
        $lat = $REQ['lat'];
        $long = $REQ['long'];
        $events = fetch_all("SELECT id, title, description, address, longtitude, latitude, creator_id,
        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longtitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        FROM events
        HAVING distance < 15
        ORDER BY distance", [$lat, $long, $lat]);
    } else {
        $events = fetch_all("SELECT id, title, description, address, longtitude, latitude, creator_id FROM events", []);
    }

    $events = fetch_all("SELECT id,title, description, address, longtitude, latitude, creator_id FROM events",[]);
    foreach ($events as $event) {
        $user = fetch_assoc("SELECT name, phone, email FROM users where id = ?", [$event['creator_id']]) ?? false;
        $api_response[$event['id']]['title'] = $event['title'];
        $api_response[$event['id']]['description'] = $event['description'];
        $api_response[$event['id']]['address'] = $event['address'];
        $api_response[$event['id']]['longtitude'] = $event['longtitude'];
        $api_response[$event['id']]['latitude'] = $event['latitude'];
        $api_response[$event['id']]['creator_name'] = $user['name'];
        $api_response[$event['id']]['creator_phone'] = $user['phone'];
        $api_response[$event['id']]['creator_email'] = $user['email'];
    }
}
api_response($api_response);


?>