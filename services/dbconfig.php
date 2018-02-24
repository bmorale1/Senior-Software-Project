<?php
class Database{

    //change all of this
    private $host = "localhost"; //site url
    private $db_name = "TicketGeek"; //db_name
    private $username = "root"; //sql user
    private $password = "root"; //sql pass
    public $conn;

  public function dbConnection(){

       $this->conn = null;

          try{
              $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
        catch(PDOException $exception){
                  echo "Connection error: " . $exception->getMessage();
              }

            return $this->conn;
        }
}
?>
