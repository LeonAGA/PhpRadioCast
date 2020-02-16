<?php

if(isset($_POST['signup-submit'])){

    require '../models/signup.class.php';

    $signUp = new SignUp(clean_input($_POST["user"]), clean_input($_POST["name"]), clean_input($_POST["lastName"]),
                        clean_input($_POST["lastName2"]), clean_input($_POST["email"]), $_POST["password"],
                        $_POST["passwordConfirmation"]); 

    $valid = validation_input($signUp);
    
    if($valid  == 'valid'){
        
         switch($signUp->user_registration()){
            case 'sqlError':
                header("Location: ../views/signup.php?error=sqlerror");
                exit();
            break; 
            default:         
                header("Location: ../views/login.php?signIn=success"); 
                exit();
            break;
        }
     }

}else{
    header("Location: ../views/signup.php");
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
function validation_input($Instance){
    if(empty($Instance->get_user()) || empty($Instance->get_name()) || empty($Instance->get_lastName()) || 
       empty($Instance->get_lastName2()) || empty($Instance->get_email()) || empty($Instance->get_password()) || 
       empty($Instance->get_passwordConfirmation())) {
        header("Location: ../views/signup.php?error=emptyfields&user=".$Instance->get_user()."&name=".$Instance->get_name().
        "&lastName=".$Instance->get_lastName()."&lastName2=".$Instance->get_lastName2()."&email=".$Instance->get_email()); 
        exit();
    } else if(!filter_var($Instance->get_email(), FILTER_VALIDATE_EMAIL)){
        header("Location: ../views/signup.php?error=invalidemail&user=".$Instance->get_user()."&name=".$Instance->get_name().
        "&lastName=".$Instance->get_lastName()."&lastName2=".$Instance->get_lastName2()); 
        exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $Instance->get_user()) || str_word_count($Instance->get_user()) > 1){
        header("Location: ../views/signup.php?error=invaliduser&name=".$Instance->get_name()."&lastName="
        .$Instance->get_lastName()."&lastName2=".$Instance->get_lastName2()."&email=".$Instance->get_email()); 
        exit();
    } else if(!preg_match("/^[a-zA-Z]*$/", $Instance->get_name()) || str_word_count($Instance->get_name()) > 1){
        header("Location: ../views/signup.php?error=invalidname&user=".$Instance->get_user()."&lastName=".
        $Instance->get_lastName()."&lastName2=".$Instance->get_lastName2()."&email=".$Instance->get_email());
        exit(); 
    } else if(!preg_match("/^[a-zA-Z]*$/", $Instance->get_lastName()) || str_word_count($Instance->get_lastName()) > 1){
        header("Location: ../views/signup.php?error=invalidlastName&user=".$Instance->get_user()."&name=".$Instance->get_name().
        "&lastName2=".$Instance->get_lastName2()."&email=".$Instance->get_email()); 
        exit();
    } else if(!preg_match("/^[a-zA-Z]*$/", $Instance->get_lastName2()) || str_word_count($Instance->get_lastName2()) > 1){
        header("Location: ../views/signup.php?error=invalidlastName2&user=".$Instance->get_user()."&name=".$Instance->get_name().
        "&lastName=".$Instance->get_lastName()."&email=".$Instance->get_email());
        exit();
    } else if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $Instance->get_password()) || 
       str_word_count($Instance->get_lastName2()) > 1){
        header("Location: ../views/signup.php?error=invalidpassword&user=".$Instance->get_user().
        "&name=".$Instance->get_name()."&lastName=".$Instance->get_lastName()."&lastName2=".$Instance->get_lastName2().
        "&email=".$Instance->get_email()); 
        exit();
    } else if($Instance->get_password() !== $Instance->get_passwordConfirmation()){
        header("Location: ../views/signup.php?error=notequalpassword&user=".$Instance->get_user().
        "&name=".$Instance->get_name()."&lastName=".$Instance->get_lastName()."&lastName2=".
        $Instance->get_lastName2()."&email=".$Instance->get_email()); 
        exit();
    } else{

       switch($Instance->search_user()){
        case 'sqlError':
        header("Location: ../views/signup.php?error=sqlerror"); 
        exit();     
        break;
        case 'user':
        header("Location: ../views/signup.php?error=useralreadytaken&name=".$Instance->get_name()."&lastName=".$Instance->get_lastName().
        "&lastName2=".$Instance->get_lastName2()."&email=".$Instance->get_email()); 
        exit();
        break;
        case 'email':
        header("Location: ../views/signup.php?error=emailalreadytaken&name=".$Instance->get_name()."&lastName=".$Instance->get_lastName().
        "&lastName2=".$Instance->get_lastName2()); 
        exit();
        break;
        default:         
        return 'valid';
        break;
       }
      
    }
}    