<?php

require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";

if(empty($_GET)){

    if($_POST['action'] == 'create'){
    
        //Prepare statement to avoid SQL inyections.
        $theme = filter_var($_POST['theme'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $hour = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
        $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
        $userid = $_POST['user'];
        $date = $date." ".$hour.":00";
        
        //Instances
        $Dao = new BroadcastDao();
        
        try{

            $response = $Dao->insert_broadcast($theme, $date, $link, $userid);

        }catch(Exception $ex){
            $response = array(
                'error'=> $ex->getMessage()
            );
        }
        echo json_encode($response);  
        exit();
    }

}






