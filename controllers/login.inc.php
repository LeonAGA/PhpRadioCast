<?php 

if(isset($_POST['login-submit'])){

    require '../models/login.class.php';
    require '../models/loginDao.php';

    $logIn = new LogIn(clean_input($_POST["user"]), $_POST["password"]); 
    $Dao = new LogInDao();

    $valid = validation_input($logIn,$Dao);

    if($valid == 'valid'){
        header("Location: ../index.php?logIn=success");
    exit();
    }

}else{
    header("Location: ../views/login.php");
    exit();
}

//Function to clean the data
function clean_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
    return $data;
}

//Function to validate the data
function validation_input($Instance, $Dao){
        
    if(empty($Instance->get_user())){
        header("Location: ../views/login.php?error=emptyuser");
        exit(); 
    } else if(empty($Instance->get_password())){
        header("Location: ../views/login.php?error=emptypassword&user=".$Instance->get_user());
        exit();
    } else{          
        switch($Dao->search_user($Instance->get_user(), $Instance->get_password())){
            case 'sqlError':
                header("Location: ../views/login.php?error=sqlerror");  
                exit();   
                break;
            case 'wrong':
                header("Location: ../views/login.php?error=wrongpassword&user=".$Instance->get_user());
                exit();   
                break;
            case 'nofound':
                header("Location: ../views/login.php?error=usernofound&user=".$Instance->get_user());
                exit(); 
                break;
            default:         
            return 'valid';
            break;
        }                             
    }
}