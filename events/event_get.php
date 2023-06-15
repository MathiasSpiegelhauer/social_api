<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');

if (isset($REQ['token'])) {
    $event = fetch_assoc("SELECT title,token, description, starttime, address, longitude, latitude, creator_id FROM events where token = ?", [$REQ['token']]) ?? false;

    if ($event) {
        $user = fetch_assoc("SELECT name, phone, email FROM users where id = ?", [$event['creator_id']]) ?? false;
        $api_response = [
            'token' => $event['token'],
            'title' => $event['title'],
            'description' => $event['description'],
            'address' => $event['address'],
            'starttime' => $event['starttime'],
            'coords' => [
                "latitude" => $event['latitude'],
                "longitude" => $event['longitude'],
            ],
            "creator" => [
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
            ]
        ];
    }
}else{
    if (isset($REQ['lat']) && isset($REQ['long'])) {
        $lat = $REQ['lat'];
        $long = $REQ['long'];
        $events = fetch_all("SELECT id, title, description, address, starttime, longitude, latitude, creator_id,
        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longtitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        FROM events
        HAVING distance < 15
        ORDER BY distance", [$lat, $long, $lat]);
    } else {
        $events = fetch_all("SELECT id,token, title, description, address, starttime, longitude, latitude, creator_id FROM events", []);
    }

    //$events = fetch_all("SELECT id,title, description, address, longitude, latitude, creator_id FROM events",[]);
    foreach ($events as $event) {
        $user = fetch_assoc("SELECT name, phone, email FROM users where id = ?", [$event['creator_id']]) ?? false;
        $api_response[] = [
            'token' => $event['token'],
            'title' => $event['title'],
            'description' => $event['description'],
            'address' => $event['address'],
            'starttime' => $event['starttime'],
            'coords' => [
                "latitude" => $event['latitude'],
                "longitude" => $event['longitude'],
            ],
            "creator" => [
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
            ]
        ];
    }
}
api_response($api_response);


?>
