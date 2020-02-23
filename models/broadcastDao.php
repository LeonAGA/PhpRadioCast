<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/RadioCast/db/db.php';

class BroadcastDao{
    
    private $db;

    public function __construct(){
        $this->db = new DB();   
    }

    function search_Allbroadcast(){
            
        $conn= mysqli_connect($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName); 
        
        if(!$conn){
            die("Connection failed".mysqli_connect_error());
        }
    
        $sql = "SELECT b.broadcast_id, b.date, b.link, b.theme,
                u.user_id, u.user_account
                FROM broadcasts b, users u
                WHERE b.user_id = u.user_id
                AND b.date >= NOW() - INTERVAL 1 DAY;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           return 'sqlError';
        }else {          
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultSet = $result->fetch_all();           
            if(count($resultSet) < 0){
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

    function insert_broadcast($theme, $date, $link, $userid){

        $conn = new mysqli($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName);

        if(!$conn){
            die( array('error' => "Connection failed".mysqli_connect_error()));
        }
          
        try{
            $statement = $conn->prepare("INSERT INTO broadcasts (date, link, theme, user_id) VALUES (?, ?, ?, ?)");
            $statement->bind_param("sssi", $date, $link, $theme , $userid); 
            $statement->execute();
            if($statement->affected_rows == 1){
            $response = array(
                'correct' => 'success',
                'data'=> array(
                    'theme' => $theme,
                    'date'=> $date,
                )
             ); 
            }
            $statement->close();
            $conn->close();
            
        }catch(Exception $ex){
            $response = array(
                'error' => $ex->getMessage()
            );
        }
        return $response;
    }

    function delete_broadcast($broadcast_id, $user_id){

        $conn = new mysqli($this->db->dbServername, $this->db->dbUsername, $this->db->dbPassword, $this->db->dbName);

        if(!$conn){
            die( array('error' => "Connection failed".mysqli_connect_error()));
        }

        try{
            $statement = $conn->prepare("DELETE FROM broadcasts WHERE broadcast_id = ? AND user_id = ?;");
            $statement->bind_param("ii", $broadcast_id, $user_id);   
            $statement->execute();
           if($statement->affected_rows == 1){
            $response = array(
                'correct' => 'success',
            );
           }
            $statement->close();
            $conn->close();

        }catch(Exception $ex){
            $response = array(
             'error'=> $ex->getMessage()
            );
        }
        return $response;

    }

}










