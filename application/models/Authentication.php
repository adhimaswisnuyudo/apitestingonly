<?php

class Authentication extends CI_Model{

    function memberlogin($username,$password){
        $qcheckuser = "SELECT username,password FROM members WHERE username='$username' LIMIT 1";
        if($this->db->query($qcheckuser)->num_rows() > 0){
            $storedpassword = $this->db->query($qcheckuser)->row()->password;
                $checkpassword = password_verify($password, $storedpassword);
                if($checkpassword){
                    $qcheckisactive = "SELECT flag FROM members WHERE username='$username'";
                    $isactive = $this->db->query($qcheckisactive)->row()->flag;
                    if($isactive==1){
                        $this->Authentication->submitlog($username,"SUCCESS","$username Login Berhasil",current_url());
                        return true;
                    }
                    else{
                        failedresponse("Akun anda dinonaktifkan, silahkan hubungi Tim Admin");
                        $this->Authentication->submitlog($username,"FAILED","$username Akun Nonaktif",current_url());
                    }
                }
                else{
                    failedresponse("Password tidak sesuai");
                    $this->Authentication->submitlog($username,"FAILED","$username Password Tidak Sesuai",current_url());
                }
        }
        else{
            failedresponse("username Tidak Ditemukan");
            $this->Authentication->submitlog($username,"FAILED","$username username Tidak Ditemukan",current_url());
        }
    }

    function memberregister($data){
        $check = $this->db->get_where('members',array('username'=>$data['username']));
        if($check->num_rows() > 0){
            failedresponse("username telah terdaftar, silahkan login untuk melanjutkan");
        }
        else{
            $nik = $data['idnumber'];
            // $qchecknik = "SELECT * FROM members WHERE idnumber='$nik'";
            // $checknik = $this->db->query($qchecknik);
            // if($checknik->num_rows() > 0){
            //     failedresponse("NIK anda telah terdaftar. Silahkan hubungi Tim Admin");
            // }
            // else{
                if($data['password'] != $data['passwordconfirm']){
                    failedresponse("Password tidak sesuai");
                }
                else{
                    $newpassword = $data['password'];
                    $newmember = array(
                        'memberid'=>generatememberid(),
                        'fullname'=>$data['fullname'],
                        'idnumber'=>$data['idnumber'],
                        'phone'=>$data['phone'],
                        'gender'=>$data['gender'],
                        'title'=>$data['title'],
                        'address'=>$data['address'],
                        'status'=>$data['status'],
                        'dob'=>$data['dob'],
                        'username'=>$data['username'],
                        'password'=>generatepassword($newpassword),
                        'isaccount'=>1,
                        'token'=>generatetoken(),
                        'photo'=>'default.png',
                        'createdby'=>$data['fullname']
                    );
                    $insert = $this->db->insert('members',$newmember);
                    if($insert){
                        // $this->setmembersession($data['username']);
                        return true;
                    }
                    else{
                        failedresponse("Registrasi Gagal");
                    }
                }   
            // }
        }
    }

    function getmemberdatabyusername($username){
        $q = "SELECT memberid,fullname,phone,gender,idnumber,title,address,dob,username,isaccount,token,flag,photo,status
            FROM members WHERE username='$username' LIMIT 1";
        $member = $this->db->query($q)->row();
        $memberdata = array(
            'memberid'=>$member->memberid,
            'fullname'=>$member->fullname,
            'phone'=>$member->phone,
            'gender'=>$member->gender,
            // 'idnumber'=>$member->idnumber,
            // 'title'=>$member->title,
            // 'address'=>$member->address,
            'dob'=>$member->dob,
            'username'=>$member->username,
            // 'isaccount'=>$member->isaccount,
            'token'=>$member->token,
            'photo'=>getimageasset("user",$member->photo),
            // 'flag'=>$member->flag,
            'status'=>$member->status,
            'islogin'=>TRUE,
        );
        // $setsession = $this->session->set_userdata($memberdata);
        return $memberdata;
    }

    function submitlog($status,$note){

        return true;
    }


    function checkpassword($oldpassword){
        $userid = $this->session->userdata('userid');
        $qcheckuser = "SELECT userid,password FROM users WHERE userid='$userid' LIMIT 1";
        if($this->db->query($qcheckuser)->num_rows() > 0){
            $storedpassword = $this->db->query($qcheckuser)->row()->password;
            $checkpassword = password_verify($oldpassword, $storedpassword);
            if($checkpassword){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    function checkpasswordmember($oldpassword){
        $memberid = $this->session->userdata('memberid');
        $qcheckuser = "SELECT memberid,password FROM members WHERE memberid='$memberid' LIMIT 1";
        if($this->db->query($qcheckuser)->num_rows() > 0){
            $storedpassword = $this->db->query($qcheckuser)->row()->password;
            $checkpassword = password_verify($oldpassword, $storedpassword);
            if($checkpassword){
                return true;
            }
            else{
                return false;
            }
        }
    }
}