<?php

require_once 'dbconfig.php';

class USER{

 private $conn;

 public function __construct(){
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }

 public function runQuery($sql){
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }

 public function lasdID(){
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }

 public function register($email,$password,$first_name,$last_name,$city,$state,$postal_code){
  try{
   $password = password_hash($password, PASSWORD_BCRYPT);

   $stmt = $this->conn->prepare("INSERT INTO Users(Email,Password,FirstName, LastName, City, State, PostalCode)
                                                VALUES(:email, :user_pass, :first_name, :last_name, :city, :state, :postal_code)");
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":first_name",$first_name);
   $stmt->bindparam(":last_name",$last_name);
   $stmt->bindparam(":city",$city);
   $stmt->bindparam(":state",$state);
   $stmt->bindparam(":postal_code",$postal_code);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function login($email,$password){
  try{
   $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email=:email");
   $stmt->execute(array(":email"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

   if($stmt->rowCount() == 1){
     if(password_verify($password, $userRow['Password'])){
      $_SESSION['userSession'] = $userRow['UserID'];
      return true;
     }
   }
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }


 public function is_logged_in(){
  if(isset($_SESSION['userSession'])){
   return true;
  }
 }

 public function redirect($url){
  header("Location: $url");
 }

 public function logout(){
  session_destroy();
  $_SESSION['userSession'] = false;
 }


//currently configured for gmail usage
 function send_mail($email,$message,$subject){
  require_once('mailer/PHPMailerAutoload.php');
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host       = "smtp.gmail.com";
  $mail->Port       = 465;
  $mail->AddAddress($email);
  $mail->Username="somegmail@gmail.com";
  $mail->Password="yourpasswordhere";
  $mail->SetFrom('casey@injecti0n.org','Injection'); //Make this the same as your actual email it is sending from, or don't, consistency is up to you
  $mail->AddReplyTo("casey@injecti0n.org","Injection");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 }
}

?>
