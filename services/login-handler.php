<?php
 session_start();
 require_once 'class.user.php';

 $user = new USER();

 if(isset($_POST['btn-login']))
 {
  $user_email = trim($_POST['user_email']);
  $user_password = trim($_POST['password']);

  $res = array('status' => '');

  try
  {

   $session_token = $user->login($user_email, $user_password);
   if($session_token != NULL){

    $res['status'] = 'success';
    $res['token'] = $session_token;


    echo json_encode($res); // log in

   }
   else{
       
    $res['status'] = 'fail';
    echo json_encode($res); // log in failed
   }

  }
  catch(PDOException $e){
   echo $e->getMessage();
  }
 }

?>
