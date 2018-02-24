<?php
 session_start();
 require_once 'class.user.php';

 $user = new USER();

 $res = array('status' => '', 'reason' => '');

 if(isset($_POST['btn-recover'])){
    $email = $_POST['email'];

    $stmt = $user->runQuery("SELECT UserID FROM Users WHERE Email=:email LIMIT 1");
    $stmt->execute(array(":email"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() == 1){
     $id = base64_encode($row['UserID']);
     $code = md5(uniqid(rand()));

     $stmt = $user->runQuery("UPDATE Users SET RecoveryToken=:token WHERE Email=:email");
     $stmt->execute(array(":token"=>$code,"email"=>$email));


   //Change URLs in emails, also add formating if desired
     $message= "
          Hello , $email
          <br /><br />
          You recently requested to reset your password. If that was not you please ignore this email, otherwise click the link below to reset your password!
          <br /><br />
          <a href='http://localhost/reset-password.php?id=$id&code=$code'>click here to reset your password</a>
          <br /><br />
          Thanks!
          <br/>
          Injection
          ";
     $subject = "Password Reset";

     //$user->send_mail($email,$message,$subject);

     $res['status'] = 'success';
 
     echo json_encode($res);
    }
    else{
      $res['status'] = 'fail';
      $res['reason'] = 'email';
 
      echo json_encode($res);
    }
   }

?>
