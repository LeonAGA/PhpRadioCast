<?php

class BroadCast {

    //Properties
    private  $broadcast_id;
    private  $date;
    private  $link;
    private  $theme;
    private  $user_id;
    private  $user_account;
    

    public function __construct($broadcast_id, $date, $link,
                                $theme, $user_id, $user_account){
        $this-> set_broadcast_id($broadcast_id);
        $this-> set_date($date);
        $this-> set_link($link);
        $this-> set_theme($theme);
        $this-> set_user_id($user_id);
        $this-> set_user_account($user_account);
    }

    //Methods
    function set_broadcast_id($broadcast_id){
        $this->broadcast_id = $broadcast_id;
    }
    function get_broadcast_id(){
        return $this->broadcast_id;
    }
    function set_date($date){
        $this->date = $date;
    }
    function get_date(){
        return $this->date;
    }
    function set_link($link){
        $this->link = $link;
    }
    function get_link(){
        return $this->link;
    }
    function set_theme($theme){
        $this->theme = $theme;
    }
    function get_theme(){
        return $this->theme;
    }
    function set_user_id($user_id){
        $this->user_id = $user_id;
    }
    function get_user_id(){
        return $this->user_id;
    }
    function set_user_account($user_account){
        $this->user_account = $user_account;
    }
    function get_user_account(){
        return $this->user_account;
    }
}