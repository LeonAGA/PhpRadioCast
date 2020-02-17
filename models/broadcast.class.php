<?php

class BroadCast {

    //Properties
    private  $broadcast_id;
    private  $date;
    private  $link;
    private  $theme;
    

    public function __construct($broadcast_id, $date, $link,
                                $theme){
        $this-> set_broadcast_id($broadcast_id);
        $this-> set_date($date);
        $this-> set_link($link);
        $this-> set_theme($theme);    
    }

    //Methods
    function set_broadcast_id($broadcast_id) : void {
        $this->broadcast_id = $broadcast_id;
    }
    function get_broadcast_id() : int {
        return $this->broadcast_id;
    }
    function set_date($date) : void {
        $this->date = $date;
    }
    function get_date() : string{
        return $this->date;
    }
    function set_link($link) : void {
        $this->link = $link;
    }
    function get_link() : string {
        return $this->link;
    }
    function set_theme($theme) : void {
        $this->theme = $theme;
    }
    function get_theme() : string {
        return $this->theme;
    }
}