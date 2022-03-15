<?php

class Member extends CI_Controller{

    function list(){
        if(checkrequesttoken()){
            $imageassetdir = 
            $q = "SELECT memberid,fullname,dob,'https://staff.lab-arkatama.com/documents/users/default.png' as photo FROM members ORDER BY fullname LIMIT 50";
            $result = $this->db->query($q)->result();
            dataresponse('members',$result);
        }
    }

    function add(){
        if(checkrequesttoken() && isPost()){
            $fullname = $this->input->post('fullname');
            $idnumber = $this->input->post('idnumber');
            $phone = $this->input->post('phone');
            $gender = $this->input->post('gender');
            if(empty($fullname)){
                failedresponse("Tidak Boleh Kosong");
            }
            else{
                $data = array(
                    'memberid'=>generatememberid(),
                    'fullname'=>$fullname,
                    'idnumber'=>$idnumber,
                    'phone'=>$phone,
                    'gender'=>$gender,
                    'address'=>'Online',
                    'title'=>'Your Title',
                    'email'=>'Your Email',
                    'password'=>'Your Password',
                    'isaccount'=>0,
                    'token'=>generatetoken(),
                    'branchid'=>0001,
                    'createdby'=>'API'
                );
                $exec = $this->db->insert('members',$data);
                if($exec){
                    successresponse("$fullname Berhasil Disimpan");
                }
                else{
                    failedresponse("$fullname Gagal Disimpan");
                }
            }
        }
    }
}