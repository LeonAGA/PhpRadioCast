<?php

 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcast.class.php";
 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";

//obtain all the transmitions
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
            
            return 'no hay monitos';
        }
        
}

//obtain single one

function obtainContact($id){
    include 'db.php';
    try{
        return $conn->query("SELECT id, name, company, phone FROM contacts WHERE id = $id");
    }catch(Exception $e){
        echo "Error!", $e->getMessage() . "<br>";
        return false;
    }

}