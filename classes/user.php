<?php
class User{
  private $_loggedIn = False;
  private $servername = "localhost";
  private $dbname = "onlineDB";
  private $username = "root";
  private $password = "";
  public $conn;
  public function __construct(){
    $this->_loggedIn= False;
    try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
      catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  }

  public function userCheck($user,$pass){
    $sql  = "SELECT user,pass FROM user WHERE user=:user";
    $conn = $this->conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user',$user);
    if($stmt->execute()){
      if($stmt->rowCount()==1){
        if($row = $stmt->fetch()){
            $hashed_password = $row['pass'];
            if(password_verify($pass, $hashed_password)){
              Session::set('username',$user);
              $this->_loggedIn = True;
            }
          }
      }
    }
    else{
      $this->_loggedIn = False;
    }
  }
  public function checkUserName($data){
    $conn = $this->conn;
    $sql= "SELECT user from user WHERE user=:user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user',$data);
    $stmt->execute();
    if($stmt->rowCount()>0){
      return True;
    }
    else{
      return False;
    }
  }
  public function userInsert($user,$pass){
    if(!$this->checkUserName($user)){
      $conn= $this->conn;
      $sql = "INSERT into user (user,pass) VALUES(:user,:pass)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':user',$user);
      $stmt->bindParam(':pass',$pass);
      if($stmt->execute()){
        if($stmt->rowCount()==1){
          $this->_loggedIn = True;
          Session::set('username',$user);
          return True;
        }
      }
    }
    else{
      return False;
    }
  }
  public function getUserId($user){
    $sql = "SELECT user_id FROM user WHERE user =:user";
    $conn = $this->conn;
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':user',$user);
    if($stmt->execute()){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['user_id'];
    }
  }
  public function getYourPosts(){
    $conn = $this->conn;
    $user = Session::get('username');
    $sql = "SELECT * FROM `posts` WHERE `user_id` = :user_id";
    $user_id = $this->getUserId($user);
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':user_id',$user_id);
    if($stmt->execute()){
      if($stmt->rowCount()){
        $row = $stmt->fetchAll();
        return $row;
      }else{
        return $row="You have not created any posts yet.";
      }
    }
  }
  public function isLoggedIn(){
    if(Session::isset('user')&&!Session::isEmpty('user')){
      $this->_loggedIn = true;
    }
    return $this->_loggedIn;
  }
}
