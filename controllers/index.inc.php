<?php


function obtainContacts(){
    include 'db.php';
    try{
        return $conn->query("SELECT id, name, company, phone FROM contacts");
    }catch(Exception $e){
        echo "Error!", $e->getMessage() . "<br>";
        return false;
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