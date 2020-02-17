<?php

 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcast.class.php";
 require $_SERVER['DOCUMENT_ROOT']."/RadioCast/models/broadcastDao.php";

//obtain all the transmitions
function search_Allbroadcast(){
    
        $Dao = new BroadCastManager();
        $ResultSet = $Dao->search_Allbroadcast();
        if(is_array($ResultSet)){
            return ' hay monitos';
            // foreach ($ResultSet as $value) {
             
            // }
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