<?php

class Products extends CI_Controller{


    function all(){
        $q = "SELECT * FROM products";
        $result = $this->db->query($q)->result();
        $response = array();
        foreach($result as $r){
            array_push($response,array(
                'id'=>$r->productid,
                'name'=>$r->name,
                'price'=>$r->price,
                'photo'=>getimageasset("products",$r->photo)
            ));
        }
        dataresponse("products",$response);
    }

    function add(){
        if(checkrequesttoken() && isPost()){
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $upload = imageupload("others");
            if($name=="" || $price==""){
                failedresponse("Nama / Harga Tidak Boleh Kosong");
            }
            else{
                if($upload['status']=='failed'){
                    if($upload['flag']=="1"){
                        $product = array(
                            'name'=>$name,
                            'price'=>$price,
                            'photo'=>'default.png'
                        );
                        $this->db->insert('products',$product,);
                        successresponse("Produk Berhasil Ditambahkan");
                    }
                    else{
                        failedresponse($upload['message']);
                    }
                }
                else{
                    $product = array(
                        'name'=>$name,
                        'price'=>$price,
                        'photo'=>$upload['filename'],
                    );
                    $this->db->insert('products',$product,);
                    successresponse("Produk Berhasil Ditambahkan");
                }
            }
        }
    }

    function delete(){
        if(checkrequesttoken() && isPost()){
            $productid = $this->input->post('productid');
            $this->db->delete('products',array('productid'=>$productid));
            successresponse("Produk Berhasil Dihapus");
        }
    }

    function byid($id=NULL){
        $id = $this->input->get('id');
        $q = "SELECT * FROM products WHERE productid='$id' LIMIT 1";
        if($this->db->query($q)->num_rows() < 1){
            failedresponse("Produk Tidak Ditemukan");
        }
        else{
            $r = $this->db->query($q)->row();
            $response = array(
                'id'=>$r->productid,
                'name'=>$r->name,
                'price'=>$r->price,
                'photo'=>getimageasset("products",$r->photo)
            );
            dataresponse("products",$response);
        }
        
    }
}