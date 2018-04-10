<?php

header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$perf_id = $_REQUEST['id'];

$perf_name = $_REQUEST['name'];

$perf_sname = $_REQUEST['short_name'];

$perf_slug = $_REQUEST['slug'];

$perf_tax_name = $_REQUEST['taxonomies_name'];

$perf_tax_id = $_REQUEST['taxonomies_id'];

$perf_tax_pid = $_REQUEST['taxonomies_parent_id'];

$perf_up_coming_events = $_REQUEST['has_upcoming_events'];

$perf_genres = $_REQUEST['genres[primary]'];

$perf_genres_slug = $_REQUEST['genres_slug'];


$url = "https://api.seatgeek.com/2/performers?client_id=". $api_key;

if(isset($perf_id)){
    $url .= "&id=" . $perf_id;
}

if(isset($perf_name)){
    $url .= "&name=" . $perf_name;
}

if(isset($perf_sname)){
    $url .= "&short_name=" . $perf_sname;
}

if(isset($perf_slug)){
    $url .= "&slug=" . $perf_slug;
}

if(isset($perf_tax_name)){
    $url .= "&taxonomies.name=" . $perf_tax_name;
}

if(isset($perf_tax_id)){
    $url .= "&taxonomies.id=" . $perf_tax_id;
}

if(isset($perf_tax_pid)){
    $url .= "&taxonomies.parent_id=" . $perf_tax_pid;
}

if(isset($perf_up_coming_events)){
    $url .= "&has_upcoming_events=" . $perf_up_coming_events;
}

if(isset($perf_genres)){
    $url .= "&genres[primary]=" . $perf_genres;
}

if(isset($perf_genres_slug)){
    $url .= "&genres.slug=" . $perf_genres_slug;
}

//var_dump($url);

$data = file_get_contents($url);


echo $data;


?>