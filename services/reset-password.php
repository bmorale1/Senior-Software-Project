<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code'])){
 $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code'])){
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];

 $stmt = $user->runQuery("SELECT * FROM Users WHERE UserID=:uid AND RecoveryToken=:token");
 $stmt->execute(array(":uid"=>$id,":token"=>$code));
 $rows = $stmt->fetch(PDO::FETCH_ASSOC);

 if($stmt->rowCount() == 1){
  if(isset($_POST['btn-reset-pass'])){
   $pass = $_POST['pass'];
   $cpass = $_POST['confirm-pass'];

   if($cpass!==$pass){
    $msg = "<div class='alert alert-block'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Sorry!</strong>Passwords do not match.
      </div>";
   }
   else{
    $cpass = password_hash($cpass, PASSWORD_BCRYPT);
    $code = md5(uniqid(rand()));
    $stmt = $user->runQuery("UPDATE Users SET Password=:upass WHERE UserID=:uid");
    $stmt->execute(array(":upass"=>$cpass,":uid"=>$rows['UserID']));
    $stmt = $user->runQuery("UPDATE Users SET RecoveryToken=:code WHERE UserID=:uid");
    $stmt->execute(array(":code"=>$code,":uid"=>$rows['UserID']));

    $msg = "<div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      Password Changed, please wait while we redirect you to login...
      </div>";
    header("refresh:5;../client-side-login.html");
   }
  }
 }
 else{
  $msg = "<div class='alert alert-fail'>
  <button class='close' data-dismiss='alert'>&times;</button>
  Invalid recovery token!
  </div>";
  exit;
 }


}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">
     <div class='alert alert-success'>
   <strong>Hello!</strong>  <?php echo htmlspecialchars($rows['FirstName'] . ' '. $rows['LastName']) ?> you are here to reset your forgotten password.
  </div>
        <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Password Reset.</h3><hr />
        <?php
        if(isset($msg)){
            echo $msg;
          }
  ?>
        <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
      <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>

      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
