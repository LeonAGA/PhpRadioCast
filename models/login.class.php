<?php

if(isset($_POST['login-submit'])){

class LogIn {

    //Properties
    private $user;
    private $password;

    public function __construct($user, $password){
        $this-> set_user($user);
        $this-> set_password($password);
    }

    //Methods
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }

}

}else{
    header("Location: ../views/login.php");
    exit();
} 