<?php

header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$performer_id = $_REQUEST['performers_id'];

$datetime_utc_lt = $_REQUEST['datetime_utc_lt'];
$datetime_utc_gt = $_REQUEST['datetime_utc_gt'];
$datetime_utc_lte = $_REQUEST['datetime_utc_lte'];
$datetime_utc_gte = $_REQUEST['datetime_utc_gte'];

$datetime_local_lt = $_REQUEST['datetime_local_lt'];
$datetime_local_gt = $_REQUEST['datetime_local_gt'];
$datetime_local_lte = $_REQUEST['datetime_local_lte'];
$datetime_local_gte = $_REQUEST['datetime_local_gte'];

$postal_code = $_REQUEST['postal_code'];

$taxonomies_name = $_REQUEST['taxonomies_name'];
$taxonomies_id = $_REQUEST['taxonomies_id'];


$url = "https://api.seatgeek.com/2/recommendations?client_id=". $api_key;

if(isset($performer_id)){
    $url .= "&performer_id=" . $performer_id;
}

if(isset($datetime_utc_lt)){
    $url .= "&datetime_utc_lt=" . $datetime_utc_lt;
}
if(isset($datetime_utc_gt)){
    $url .= "&datetime_utc_gt=" . $datetime_utc_gt;
}
if(isset($datetime_utc_lte)){
    $url .= "&datetime_utc_lte=" . $datetime_utc_lte;
}
if(isset($datetime_utc_gte)){
    $url .= "&datetime_utc_gte=" . $datetime_utc_gte;
}

if(isset($datetime_local_lt)){
    $url .= "&datetime_local_lt=" . $datetime_local_lt;
}
if(isset($datetime_local_gt)){
    $url .= "&datetime_local_gt=" . $datetime_local_gt;
}
if(isset($datetime_local_lte)){
    $url .= "&datetime_local_lte=" . $datetime_local_lte;
}
if(isset($datetime_local_gte)){
    $url .= "&datetime_local_gte=" . $datetime_local_gte;
}

if(isset($postal_code)){
    $url .= "&postal_code=" . $postal_code;
}
if(isset($taxonomies_name)){
    $url .= "&taxonomies_name=" . $taxonomies_name;
}
if(isset($taxonomies_id)){
    $url .= "&taxonomies_id=" . $taxonomies_id;
}


$data = file_get_contents($url);

echo $data;
?>