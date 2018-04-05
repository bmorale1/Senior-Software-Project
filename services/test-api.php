<?php

header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$event_id = $_REQUEST['id'];

$url = "https://api.seatgeek.com/2/events?client_id=". $api_key;

if(isset($event_id)){
    $url .= "&id=" . $event_id;
}



//var_dump($url);

$data = file_get_contents($url);


echo $data;


?>