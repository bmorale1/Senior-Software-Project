<?php
 session_start();
 require_once 'class.user.php';

 $reg_user = new USER();

 if(isset($_POST['btn-register'])){

 $email = trim($_POST['email']);
 $password = trim($_POST['password']);
 $first_name = trim($_POST['first_name']);
 $last_name = trim($_POST['last_name']);
 $city = trim($_POST['city']);
 $state = trim($_POST['state']);
 $postal_code = trim($_POST['postal_code']);

 $stmt = $reg_user->runQuery("SELECT * FROM Users WHERE Email=:email");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);


 $res = array('status' => '', 'reason' => '');

 if($stmt->rowCount() > 0){
  
  $res['status'] = 'fail';
  $res['reason'] = 'email';

  echo json_encode($res);

 }
 else{
  if($reg_user->register($email,$password,$first_name,$last_name,$city,$state,$postal_code)){
    
    $res['status'] = 'success';
    $res['reason'] = '';

    echo json_encode($res);
  }
  else
  {
    $res['status'] = 'fail';
    $res['reason'] = 'query';
  
    echo json_encode($res);
  }
 }
 }

?>
