<?php


$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$performer_id = $_REQUEST['performer.id'];

$datetime_utc_lt = $_REQUEST['datetime_utc.lt'];
$datetime_utc_gt = $_REQUEST['datetime_utc.gt'];
$datetime_utc_lte = $_REQUEST['datetime_utc.lte'];
$datetime_utc_gte = $_REQUEST['datetime_utc.gte'];

$datetime_local_lt = $_REQUEST['datetime_local.lt'];
$datetime_local_gt = $_REQUEST['datetime_local.gt'];
$datetime_local_lte = $_REQUEST['datetime_local.lte'];
$datetime_local_gte = $_REQUEST['datetime_local.gte'];

$postal_code = $_REQUEST['postal_code'];

$taxonomies_name = $_REQUEST['taxonomies.name'];
$taxonomies_id = $_REQUEST['taxonomies.id'];


$url = "https://api.seatgeek.com/2/recommendations?client_id=". $api_key;

if(isset($performer_id)){
    $url .= "&performer.id=" . $performer_id;
}

if(isset($datetime_utc_lt)){
    $url .= "&datetime_utc.lt=" . $datetime_utc_lt;
}
if(isset($datetime_utc_gt)){
    $url .= "&datetime_utc.gt=" . $datetime_utc_gt;
}
if(isset($datetime_utc_lte)){
    $url .= "&datetime_utc.lte=" . $datetime_utc_lte;
}
if(isset($datetime_utc_gte)){
    $url .= "&datetime_utc.gte=" . $datetime_utc_gte;
}

if(isset($datetime_local_lt)){
    $url .= "&datetime_local.lt=" . $datetime_local_lt;
}
if(isset($datetime_local_gt)){
    $url .= "&datetime_local.gt=" . $datetime_local_gt;
}
if(isset($datetime_local_lte)){
    $url .= "&datetime_local.lte=" . $datetime_local_lte;
}
if(isset($datetime_local_gte)){
    $url .= "&datetime_local.gte=" . $datetime_local_gte;
}

if(isset($postal_code)){
    $url .= "&postal_code=" . $postal_code;
}
if(isset($taxonomies_name)){
    $url .= "&taxonomies.name=" . $taxonomies_name;
}
if(isset($taxonomies_id)){
    $url .= "&taxonomies.id=" . $taxonomies_id;
}


$data = file_get_contents($url);

echo $data;
?>