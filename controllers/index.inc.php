<?php

 session_start();
 if(!isset($_SESSION['user_id'])){
    header("Location: views/login.php");
    exit();
 }

 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcast.class.php";
 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";


//obtain all the broadcasts
function search_Allbroadcast(){
    
        $Dao = new BroadcastDao();
        $ResultSet = $Dao->search_Allbroadcast();
        if(is_array($ResultSet)){
            $broadcasts = array();

            foreach ($ResultSet as $value) {
                
                $broadcast = new BroadCast( $value[0], $value[1],$value[2],
                                            $value[3], $value[4], $value[5]);
                 array_push($broadcasts, $broadcast);   
            }
                return $broadcasts;
        }else{
            
            return $ResultSet;
        }
        
}

//obtain single one
function search_broadcast($id){
        
        $Dao = new BroadcastDao();
        $ResultSet = $Dao->search_Allbroadcast();
        if(is_array($ResultSet)){
            $broadcasts = array();

            foreach ($ResultSet as $value) {
                
                $broadcast = new BroadCast( $value[0], $value[1],$value[2],
                                            $value[3], $value[4], $value[5]);
                 array_push($broadcasts, $broadcast);   
            }
                return $broadcasts;
        }else{
            
            return $ResultSet;
        }

}

// function search_Allbroadcast($id){
//     include 'db.php';
//     try{
//         return $conn->query("SELECT id, name, company, phone FROM contacts WHERE id = $id");
//     }catch(Exception $e){
//         echo "Error!", $e->getMessage() . "<br>";
//         return false;
//     }

// }


    if( isset($_GET['action']) && ($_GET['action'] == 'delete')){

        //Prepare statement to avoid SQL inyections.
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $userid = $_SESSION['user_id'];

        //Instances
        $Dao = new BroadcastDao();
        
        try{

             $response = $Dao->delete_broadcast($id, $userid );

        }catch(Exception $ex){
            $response = array(
                'error'=> $ex->getMessage()
            );
        }

        echo json_encode($response);  
        exit();
    }
