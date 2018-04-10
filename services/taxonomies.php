<?php
header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$taxonomies_name = $_REQUEST['taxonomies_name'];
$taxonomies_id = $_REQUEST['taxonomies_id'];

$url = "https://api.seatgeek.com/2/taxonomies?client_id=". $api_key;

if(isset($taxonomies_name)){
    $url .= "&taxonomies_name=" . $taxonomies_name;
}
if(isset($taxonomies_id)){
    $url .= "&taxonomies_id=" . $taxonomies_id;
}


$data = file_get_contents($url);

echo $data;
?>