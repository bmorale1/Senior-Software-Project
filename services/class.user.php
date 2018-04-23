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

    $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email=:email");
    $stmt->execute(array(":email"=>$email));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
 
  if($stmt->rowCount() == 1){
    return false;
  }else{
   $password = password_hash($password, PASSWORD_BCRYPT);
   $code = md5(uniqid(rand()));

   $stmt = $this->conn->prepare("INSERT INTO Users(Email,Password,FirstName, LastName, City, State, PostalCode, RecoveryToken, SessionToken)
                                                VALUES(:email, :user_pass, :first_name, :last_name, :city, :state, :postal_code, :recovery_token, NULL)");
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":first_name",$first_name);
   $stmt->bindparam(":last_name",$last_name);
   $stmt->bindparam(":city",$city);
   $stmt->bindparam(":state",$state);
   $stmt->bindparam(":postal_code",$postal_code);
   $stmt->bindparam(":recovery_token", $code);
   $stmt->execute();
   return $stmt;
  }
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }


public function validateToken($token){
  try{
    $stmt = $this->conn->prepare("SELECT * FROM Users WHERE SessionToken=:session_token");
    $stmt->execute(array(":session_token"=>$token));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
 
    if($stmt->rowCount() == 1){
       return true;
    }else{
      return false;
    }
   }catch(PDOException $ex){
    echo $ex->getMessage();
   }
}


public function getUserProfileData($token){

  try{

    // Get User Data
    $stmt = $this->conn->prepare("SELECT Email, FirstName, LastName, City, State, PostalCode FROM Users WHERE SessionToken=:session_token");
    $stmt->execute(array(":session_token"=>$token));

    
    $data = array();

    while ($userRow=$stmt->fetch(PDO::FETCH_ASSOC)){

      $data['profile'] = $userRow;

    }

    // Get ticket data
    $stmt = $this->conn->prepare("SELECT UserID FROM Users WHERE SessionToken=:session_token");
    $stmt->execute(array(":session_token"=>$token));
    
    $event_data = array();
    while ($userRow=$stmt->fetch(PDO::FETCH_ASSOC)){
      $ticket_stmt = $this->conn->prepare("SELECT EventID FROM Tickets WHERE UserID=:user_id");
      $ticket_stmt->execute(array(":user_id"=>$userRow['UserID']));

      while($ticketRow=$ticket_stmt->fetch(PDO::FETCH_ASSOC)){
        $event_data[] = $ticketRow['EventID'];
      }

    }

    $event_list = implode(",", $event_data);

    $data['events'] = $event_list;

    if($stmt->rowCount() == 1){
       return $data;
    }else{
      return false;
    }
   }catch(PDOException $ex){
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
      $token = md5(uniqid(rand()));

      $stmt = $this->conn->prepare("UPDATE Users 
      SET SessionToken=:session_token WHERE Email=:email");
      $stmt->bindparam(":email", $email);
      $stmt->bindparam(":session_token", $token);
      $stmt->execute();
      return $token;
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
