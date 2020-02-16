<?php

if(isset($_POST['signup-submit'])){

include_once '../db/db.php';

 class SignUp {
    
    //Properties
    private $user;
    private $name;
    private $lastName;
    private $lastName2;
    private $email;
    private $password;
    private $passwordConfirmation;
    private $db;

    public function __construct($user, $name, $lastName, $lastName2,
     $email, $password, $passwordConfirmation){
        $this->set_user($user);
        $this->set_name($name);
        $this->set_lastName($lastName);
        $this->set_lastName2($lastName2);
        $this->set_email($email);
        $this->set_password($password);
        $this->set_passwordConfirmation($passwordConfirmation);
        $this->db = new DB();
    }

     //Methods
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    function set_lastName($lastName) {
        $this->lastName = $lastName;
    }
    function get_lastName() {
        return $this->lastName;
    }
    function set_lastName2($lastName2) {
        $this->lastName2 = $lastName2;
    }
    function get_lastName2() {
        return $this->lastName2;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }
    function set_password($password) {
        $this->password= $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_passwordConfirmation($passwordConfirmation) {
        $this->passwordConfirmation = $passwordConfirmation;
    }
    function get_passwordConfirmation() {
        return $this->passwordConfirmation;
    }
     // Function to search register users
    function search_user(){
        
        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "SELECT user_account FROM users WHERE user_account = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           return 'sqlError';
        }else {
            mysqli_stmt_bind_param($stmt, "s", $this->user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
           
            
            if($resultCheck > 0){
               mysqli_stmt_close($stmt);
               mysqli_close($conn);
               return 'user'; 
            }else{
            
                $sql = "SELECT user_email FROM users WHERE user_email = ?";
                if(!mysqli_stmt_prepare($stmt, $sql)){
                return 'sqlError';
                }else{
                mysqli_stmt_bind_param($stmt, "s", $this->email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);   
                if($resultCheck > 0){
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return 'email'; 
                    }else{
                    return 'valid';
                    }

                }
                      
            }
        }     
    }

       //Function to register a new user
    function user_registration(){ 

        $name = $this->name;
        $lastname = $this->lastName;
        $lastname2 = $this->lastName2;
        $email = strtolower($this->email);
        $account = strtolower($this->user);
        $password = $this->password;
 
        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "INSERT INTO users (user_name, user_lastname, user_lastname2, user_email, user_account, user_password)
                VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            return 'sqlError';
        }else {
           
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $lastname,
                                    $lastname2, $email, $account, $hashedPwd);
             mysqli_stmt_execute($stmt);     
             mysqli_stmt_close($stmt);
             mysqli_close($conn);  
            return 'valid';
        }
    }

} 

}else{
  header("Location: ../views/signup.php");
  exit();
} 

