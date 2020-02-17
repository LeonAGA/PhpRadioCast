<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/RadioCast/db/db.php';

class BroadCastManager{
    
    private $db;

    public function __construct(){
        $this->db = new DB();   
    }

    function search_Allbroadcast(){
            
        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "SELECT * FROM broadcasts;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           return 'sqlError';
        }else {          
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultSet = $result->fetch_all();           
            if(count($resultSet) < 1){
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return 'noBroadCast';
            }else{
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return $resultSet;
            }
                
        }     
    }

}










