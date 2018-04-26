<?php

session_start();
require_once 'class.user.php';

$user = new USER();

$token = $_REQUEST['token'];

$event_ID = $_REQUEST['event_id'];


if(!$user->validateToken($token)){

    session_destroy();
    exit();

}else{


    $data = $user->setUserBookmark($token,$event_ID);
    $data['status'] = 'success';
  
    echo json_encode($data);


}



?>