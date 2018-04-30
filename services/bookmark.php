<?php

session_start();
require_once 'class.user.php';

$user = new USER();

header('Content-type: application/json');

$token = $_REQUEST['token'];

$event_ID = $_REQUEST['event_id'];


if(!$user->validateToken($token)){

    session_destroy();
    exit();

}else{


    $bookMarkIsSet = $user->setUserBookmark($token,$event_ID);
    $data = array();
    if($bookMarkIsSet == True){
        $data['status'] = 'success';
    }else{
        $data['status'] = 'failed';
    }
    echo json_encode($data);


}



?>