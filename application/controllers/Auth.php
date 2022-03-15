<?php

class Auth extends CI_Controller{

    function notfound(){
        jsonoutput(404,array('status'=>'failed','message'=>'Endpoint Not Found'));
    }

    function login(){
        if(checkrequesttoken() && isPost()){
            $data = json_decode(file_get_contents('php://input'));
            $login = $this->Authentication->memberlogin($data->username,$data->password);
            if($login){
                $data = $this->Authentication->getmemberdatabyusername($data->username);
                dataresponse("member",$data);
            }

        }
    }
    
    function register(){
        if(checkrequesttoken() && isPost()){
            $data = json_decode(file_get_contents('php://input'));
            $x = array(
                'fullname'=>$data->fullname,
                'idnumber'=>$data->idnumber,
                'gender'=>$data->gender,
                'title'=>$data->title,
                'dob'=>$data->dob,
                'phone'=>$data->phone,
                'address'=>$data->address,
                'username'=>$data->username,
                'status'=>$data->status,
                'password'=>$data->password,
                'passwordconfirm'=>$data->password,
            );
            $register = $this->Authentication->memberregister($x);
            if($register){
                $data = $this->Authentication->getmemberdatabyusername($data->username);
                dataresponse("member",$data);
            }
        }
    }
    
}