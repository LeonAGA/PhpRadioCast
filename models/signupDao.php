<?php

if(isset($_POST['signup-submit'])){

include_once '../db/db.php';

 class SignUpDao {
    
    //Properties
    private $db;

    public function __construct(){ 
        $this->db = new DB();
    }

    // Function to search register users
    function search_user($user, $email){
        
        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "SELECT user_account FROM users WHERE user_account = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
           return 'sqlError';
        }else {
            mysqli_stmt_bind_param($stmt, "s", $user);
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
                mysqli_stmt_bind_param($stmt, "s", $email);
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
    function user_registration($nameIn, $lastNameIn, $lastName2In, 
                               $emailIn, $accountIn, $passwordIn){ 

        $name = $nameIn;
        $lastName = $lastNameIn;
        $lastName2 = $lastName2In;
        $email = strtolower($emailIn);
        $account = strtolower($accountIn);
        $password = $passwordIn;
 
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
            
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $lastName,
                                    $lastName2, $email, $account, $hashedPwd);
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

