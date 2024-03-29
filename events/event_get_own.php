<?php
include_once "../base_conf.php";
header('Access-Control-Allow-Origin: *');
$user = check_login($REQ['user_token'],$REQ['session']);

if (isset($REQ['lat']) && isset($REQ['long'])) {
    $lat = $REQ['lat'];
    $long = $REQ['long'];
    $events = fetch_all("SELECT id, title, description, address, starttime, longitude, latitude, creator_id,
    (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longtitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
    FROM events
    HAVING distance < 15
    ORDER BY distance WHERE creator_id = ?", [$lat, $long, $lat,$user['id']]);
} else {
    $events = fetch_all("SELECT id,token, title, description, address, starttime, longitude, latitude, creator_id FROM events WHERE creator_id = ?", [$user['id']]);
}

//$events = fetch_all("SELECT id,title, description, address, longitude, latitude, creator_id FROM events",[]);
foreach ($events as $event) {
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

api_response($api_response);


?>
