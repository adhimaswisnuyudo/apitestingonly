<?php

class Dashboard extends CI_Controller{

    function sales(){
        dataresponse("sales",codegenerator());
    }

    function balances(){
        dataresponse("balances",codegenerator());
    }

    function labs(){
        dataresponse("balances",codegenerator());
    }
}