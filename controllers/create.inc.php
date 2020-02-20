<?php

require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";

if(empty($_POST)){

    if($_GET['action'] == 'delete'){

        require_once('../functions/db.php');
    
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        
        try{
            $statement = $conn->prepare("DELETE FROM contacts WHERE id = ?");
            $statement->bind_param("i", $id);   
            $statement->execute();
           if($statement->affected_rows == 1){
            $response = array(
                'response' => 'correct'
            );
           }
            $statement->close();
            $conn->close();
        }catch(Exception $e){
            $response = array(
             'error'=> $e->getMessage()
            );
        }
        echo json_encode($response);
        exit;
    }
}

if(empty($_GET)){

    if($_POST['action'] == 'create'){
     
        $Dao = new BroadcastDao();
        //Prepare statement to avoid SQL inyections.
        $theme = filter_var($_POST['theme'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $hour = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
        $link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
        $user = $_POST['user'];
        $date = $date." ".$hour.":00";
        echo json_encode($date);
        
        // $Result = $Dao->insert_broadcast();

            // if(is_array($ResultSet)){
            //     $broadcasts = array();
    
            //     foreach ($ResultSet as $value) {
                    
            //         $broadcast = new BroadCast( $value[0], $value[1],$value[2],
            //                                     $value[3], $value[4], $value[5]);
            //          array_push($broadcasts, $broadcast);   
            //     }
            //         return $broadcasts;
            // }else{
                
            //     return $ResultSet;
            // }
           
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






