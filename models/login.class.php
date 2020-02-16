<?php

if(isset($_POST['login-submit'])){

include_once '../db/db.php';

class LogIn {

    //Properties
    private $user;
    private $password;
    private $db;

    public function __construct($user, $password){
        $this-> set_user($user);
        $this-> set_password($password);
        $this->db = new DB();
    }

    //Methods
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }

    function search_user(){
            
        $email = strtolower($this->user);
        $account = strtolower($this->user);
        $password = $this->password;

        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "SELECT * FROM users WHERE user_account = ? OR user_email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           return 'sqlError';
        }else {
            mysqli_stmt_bind_param($stmt, "ss", $account, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($result)){
               
               
               $pwdCheck = password_verify($password, $row['user_password']);
       
               if($pwdCheck == false){
                  mysqli_stmt_close($stmt);
                  mysqli_close($conn);
                  return 'wrong'; 
               }else if($pwdCheck == true){
                    session_start();
                    $_SESSION['user_id'] = $row['user_id']; 
                    $_SESSION['user_account'] = $row['user_account']; 
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);                   
                    return 'valid';
               }else{
                  mysqli_stmt_close($stmt);
                  mysqli_close($conn);
                  return 'wrong'; 
               }
            }else{
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return 'nofound';                      
            }
        }     
    }

}

}else{
    header("Location: ../views/signup.php");
    exit();
} 