
<?php

header('Content-type: application/json');

$api_key = "MTA0NTE3MTN8MTUxNzUyMDU4OC41Mw";

$event_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
//$geo_ip = $_REQUEST['geoip'];
// $lat = $_REQUEST['lat'];
// $lon = $_REQUEST['lon'];
// $range = $_REQUEST['range'];
// $type = $_REQUEST['type'];

// $datetime_local = $_REQUEST['datetime_local'];
// $datetime_local_gt = $_REQUEST['datetime_local_gt'];
// $datetime_local_gte = $_REQUEST['datetime_local_gte'];
// $datetime_local_lt = $_REQUEST['datetime_local_lt'];
// $datetime_local_lte = $_REQUEST['datetime_local_lte'];

// $datetime_utc = $_REQUEST['datetime_utc'];
 $datetime_utc_gt = isset($_REQUEST['datetime_utc_gt']) ? $_REQUEST['datetime_utc_gt'] : '';
// $datetime_utc_gte = $_REQUEST['datetime_utc_gte'];
// $datetime_utc_lt = $_REQUEST['datetime_utc_lt'];
// $datetime_utc_lte = $_REQUEST['datetime_utc_lte'];

// $date_tbd = $_REQUEST['date_tbd'];

// $sort = $_REQUEST['sort'];

// $listing_count = $_REQUEST['listing_count'];
// $listing_count_gt = $_REQUEST['listing_count_gt'];
// $listing_count_gte = $_REQUEST['listing_count_gte'];
// $listing_count_lt = $_REQUEST['listing_count_lt'];
// $listing_count_lte = $_REQUEST['listing_count_lte'];

// $average_price = $_REQUEST['average_price'];
// $average_price_gt = $_REQUEST['average_price_gt'];
// $average_price_gte = $_REQUEST['average_price_gte'];
// $average_price_lt = $_REQUEST['average_price_lt'];
// $average_price_lte = $_REQUEST['average_price_lte'];

// $lowest_price = $_REQUEST['lowest_price'];
// $lowest_price_gt = $_REQUEST['lowest_price_gt'];
// $lowest_price_gte = $_REQUEST['lowest_price_gte'];
// $lowest_price_lt = $_REQUEST['lowest_price_lt'];
// $lowest_price_lte = $_REQUEST['lowest_price_lte'];

// $highest_price = $_REQUEST['highest_price'];
// $highest_price_gt = $_REQUEST['highest_price_gt'];
// $highest_price_gte = $_REQUEST['highest_price_gte'];
// $highest_price_lt = $_REQUEST['highest_price_lt'];
// $highest_price_lte = $_REQUEST['highest_price_lte'];

$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';

$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

$url = "https://api.seatgeek.com/2/events?client_id=". $api_key;

if($event_id){
    $url .= "&id=" . $event_id;
}

// if(isset($geo_ip)){
//     $url .= "&geoip=" . $geo_ip;
// }

// if(isset($lat)){
//     $url .= "&lat=" . $lat;
// }

// if(isset($lon)){
//     $url .= "&lon=" . $lon;
// }

// if(isset($range)){
//     $url .= "&range=" . $range;
// }

// if(isset($type)){
//     $url .= "&type=" . $type;
// }

// if(isset($datetime_local)){
//     $url .= "&datetime_local=" . $datetime_local;
// }

// if(isset($datetime_local_gt)){
//     $url .= "&datetime_local.gt=" . $datetime_local_gt;
// }

// if(isset($datetime_local_gte)){
//     $url .= "&datetime_local.gt=" . $datetime_local_gte;
// }

// if(isset($datetime_local_lt)){
//     $url .= "&datetime_local.lt=" . $datetime_local_lt;
// }

// if(isset($datetime_local_lte)){
//     $url .= "&datetime_local.lte=" . $datetime_local_lte;
// }

// if(isset($datetime_utc)){
//     $url .= "&datetime_utc=" . $datetime_utc;
// }

if($datetime_utc_gt){
    $url .= "&datetime_utc.gt=" . $datetime_utc_gt;
}

// if(isset($datetime_utc_gte)){
//     $url .= "&datetime_utc.gt=" . $datetime_utc_gte;
// }

// if(isset($datetime_utc_lt)){
//     $url .= "&datetime_utc.lt=" . $datetime_utc_lt;
// }

// if(isset($datetime_utc_lte)){
//     $url .= "&datetime_utc.lte=" . $datetime_utc_lte;
// }

// if(isset($date_tbd)){
//     $url .= "&date_tbd=" . $date_tbd;
// }

// if(isset($sort)){
//     $url .= "&sort=" . $sort;
// }

// if(isset($listing_count)){
//     $url .= "&listing_count=" . $listing_count;
// }

// if(isset($listing_count_gt)){
//     $url .= "&listing_count.gt=" . $listing_count_gt;
// }

// if(isset($listing_count_gte)){
//     $url .= "&listing_count.gt=" . $listing_count_gte;
// }

// if(isset($listing_count_lt)){
//     $url .= "&listing_count.lt=" . $listing_count_lt;
// }

// if(isset($listing_count_lte)){
//     $url .= "&listing_count.lte=" . $listing_count_lte;
// }

// if(isset($lowest_price)){
//     $url .= "&lowest_price=" . $lowest_price;
// }

// if(isset($lowest_price_gt)){
//     $url .= "&lowest_price.gt=" . $lowest_price_gt;
// }

// if(isset($lowest_price_gte)){
//     $url .= "&lowest_price.gt=" . $lowest_price_gte;
// }

// if(isset($lowest_price_lt)){
//     $url .= "&lowest_price.lt=" . $lowest_price_lt;
// }

// if(isset($lowest_price_lte)){
//     $url .= "&lowest_price.lte=" . $lowest_price_lte;
// }

// if(isset($highest_price)){
//     $url .= "&highest_price=" . $highest_price;
// }

// if(isset($highest_price_gt)){
//     $url .= "&highest_price.gt=" . $highest_price_gt;
// }

// if(isset($highest_price_gte)){
//     $url .= "&highest_price.gt=" . $highest_price_gte;
// }

// if(isset($highest_price_lt)){
//     $url .= "&highest_price.lt=" . $highest_price_lt;
// }

// if(isset($highest_price_lte)){
//     $url .= "&highest_price.lte=" . $highest_price_lte;
// }
if($page){
    $url .= "&page=" . $page;
}
if($query){
    $url .= "&q=" . urlencode($query);
}





//var_dump($url);


$data = file_get_contents($url);


echo ($data);


?>


