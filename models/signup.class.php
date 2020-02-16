<?php

if(isset($_POST['signup-submit'])){

 class SignUp {
    
    //Properties
    private $user;
    private $name;
    private $lastName;
    private $lastName2;
    private $email;
    private $password;
    private $passwordConfirmation;

    public function __construct($user, $name, $lastName, $lastName2,
     $email, $password, $passwordConfirmation){
        $this->set_user($user);
        $this->set_name($name);
        $this->set_lastName($lastName);
        $this->set_lastName2($lastName2);
        $this->set_email($email);
        $this->set_password($password);
        $this->set_passwordConfirmation($passwordConfirmation);
    }

     //Methods
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    function set_lastName($lastName) {
        $this->lastName = $lastName;
    }
    function get_lastName() {
        return $this->lastName;
    }
    function set_lastName2($lastName2) {
        $this->lastName2 = $lastName2;
    }
    function get_lastName2() {
        return $this->lastName2;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }
    function set_password($password) {
        $this->password= $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_passwordConfirmation($passwordConfirmation) {
        $this->passwordConfirmation = $passwordConfirmation;
    }
    function get_passwordConfirmation() {
        return $this->passwordConfirmation;
    }
    
} 

}else{
  header("Location: ../views/signup.php");
  exit();
} 

