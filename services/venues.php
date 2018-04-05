<?php

header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$venue_id = $_REQUEST['id'];

$venue_name = $_REQUEST['name'];

$venue_address = $_REQUEST['address'];

$venue_ext_address = $_REQUEST['extended_address'];

$venue_city = $_REQUEST['city'];

$venue_zip = $_REQUEST['postal_code'];

$venue_state = $_REQUEST['state'];

$venue_country = $_REQUEST['country'];

$query = $_REQUEST['q'];

$url = "https://api.seatgeek.com/2/venues?client_id=" . $api_key;


if(isset($venue_id)){
    $url .= "&id=" . $venue_id;
}

if(isset($venue_name)){
    $url .= "&name=" . $venue_name;
}

if(isset($venue_address)){
    $url .= "&address=" . $venue_address;
}

if(isset($venue_ext_address)){
    $url .= "&extended_address=" . $venue_ext_address;
}

if(isset($venue_city)){
    $url .= "&city=" . $venue_city;
}

if(isset($venue_zip)){
    $url .= "&postal_code=" . $venue_zip;
}

if(isset($venue_state)){
    $url .= "&state=" . $venue_state;
}

if(isset($venue_country)){
    $url .= "&country=" . $venue_country;
}

if(isset($query)){
    $url .= "&q=" . $query;
}



//var_dump($url);

$data = file_get_contents($url);


echo $data;


?>