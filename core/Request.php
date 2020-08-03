<?php
class Request{

    public $url; // URL called by the user

    function __construct(){
        $this->url = $_SERVER['PATH_INFO'];
    }

}