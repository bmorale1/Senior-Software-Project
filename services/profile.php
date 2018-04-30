<?php

session_start();
require_once 'class.user.php';

$user = new USER();

header('Content-type: application/json');

$token = $_REQUEST['token'];

if(!$user->validateToken($token)){

    session_destroy();
    exit();

}else{


    $data = $user->getUserProfileData($token);
    $data['status'] = 'success';
  
    echo json_encode($data);


}




?>
