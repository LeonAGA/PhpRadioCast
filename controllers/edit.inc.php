<?php

 session_start();
 if(!isset($_SESSION['user_id'])){
    header("Location: views/login.php");
    exit();
 }

 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcast.class.php";
 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";


//obtain the 
function search_broadcast($broadcast_id){
        
        $user_id = $_SESSION['user_id'];
        $Dao = new BroadcastDao();
        $ResultSet = $Dao->search_broadcast($broadcast_id, $user_id);
        if(is_array($ResultSet)){
             
                $broadcast = new BroadCast( $ResultSet['broadcast_id'], $ResultSet['date'],$ResultSet['link'],
                                            $ResultSet['theme'], $ResultSet['user_id'], $ResultSet['user_account']); 
                                       
                $theme  = $broadcast->get_theme();
                $createDate = new DateTime($broadcast->get_date());
                $date = $createDate->format('Y-m-d');
                $time = $createDate->format('h:i');
                $link = $broadcast->get_link();       
                $broadcastId = $broadcast->get_broadcast_id();
                $user = $broadcast->get_user_id();
                $result = array($theme, $date, $time, $link, $broadcastId , $user);
                return $result;
        }else{
            
            return $ResultSet;
        }

}

if(empty($_GET)){
if($_POST['action'] == 'update'){
        
     //Prepare statement to avoid SQL inyections.
     $theme = filter_var($_POST['theme'], FILTER_SANITIZE_STRING);
     $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
     $hour = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
     $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
     $userid = $_POST['user'];
     $broadcastid = $_POST['broadcastid'];
     $date = $date." ".$hour.":00";

     //Instances
     $Dao = new BroadcastDao();

    try{
            $response = $Dao->update_broadcast($theme, $date, $link, $userid, $broadcastid);

    }catch(Exception $ex){
        $response = array(
            'error'=> $ex->getMessage()
        );
    }
    echo json_encode($response);  
    exit();
    
}
}