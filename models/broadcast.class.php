<?php

class BroadCast {

    //Properties
    private $broadcast_id;
    private $date;
    private $link;
    private $theme;
    

    public function __construct($broadcast_id, $date, $link,
                                $theme){
        $this-> set_broadcast_id($broadcast_id);
        $this-> set_date($date);
        $this-> set_link($link);
        $this-> set_theme($theme);
        
    }

    //Methods
    function set_broadcast_id($broadcast_id) {
        $this->broadcast_id = $broadcast_id;
    }
    function get_broadcast_id() {
        return $this->broadcast_id;
    }
    function set_date($date) {
        $this->date = $date;
    }
    function get_date() {
        return $this->date;
    }
    function set_link($link) {
        $this->link = $link;
    }
    function get_link() {
        return $this->link;
    }
    function set_theme($theme) {
        $this->theme = $theme;
    }
    function get_theme() {
        return $this->theme;
    }
}