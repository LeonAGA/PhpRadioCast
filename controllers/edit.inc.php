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
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    try{

        $statement = $conn->prepare("UPDATE contacts SET name = ?, company = ?, phone = ? WHERE id = ?");
        $statement->bind_param("sssi", $name, $company, $phone, $id);
        $statement->execute();
        if($statement->affected_rows == 1){
            $response = array(
                'response' => 'correct'
            );
        }else{
            $response = array(
                'response' => 'error'
            );
        }
        $statement->close();
        $conn->close();
    }catch(Exception $e){
        $response = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($response);
    exit;
}
}