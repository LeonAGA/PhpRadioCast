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

    if($_POST['action'] == 'update'){
        
        // Create new registry
        require_once('../functions/db.php');

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






