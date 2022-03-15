<?php

    function format($number){
        return number_format($number);
    }

    function dateformat($date,$format=NULL){
        if(empty($date)){
            return "-";
        }
        else{
            if($format=="dmy"){
                $var =  date("d-m-Y", strtotime($date));
            }
            else if ($format=="dMY"){
                $var =  date("d-M-Y", strtotime($date));
            }
            else if ($format=="ymd"){
                $var =  date("Y-m-d", strtotime($date));
            }
            else if($format=="mdy"){
                $var =  date("M d Y", strtotime($date));
            }
            else if($format=="dMYHis"){
                $var =  date("d-M-Y H:i:s", strtotime($date));
            }
            else if($format=="YmdHis"){
                $var =  date("Y-m-d H:i:s", strtotime($date));
            }
            else{
                $var =  date("Y-m-d", strtotime($date));
            }
            
            return $var;
        }
    }

    function howdays($from, $to) {
        $first_date = strtotime($from);
        $second_date = strtotime($to);
        $offset = $second_date-$first_date; 
        return (floor($offset/60/60/24) +1);
    }

    function today($format=NULL){
        date_default_timezone_set('Asia/Jakarta');
        if($format=="dmy"){
            $var = date('d-M-Y');
        }
        else if ($format=="ymd"){
            $var = date("Y-m-d");
        }
        else if($format=="mdy"){
            $var = date("d M Y");
        }
        else if($format=="YmdHis"){
            $var = date("Y-m-d H:i:s");
        }
        else{
            $var = date("Ymd");
        }
        return $var;
    }

    function getconfig($configname){
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT value AS val FROM configurations WHERE config='$configname' LIMIT 1";
        $q = $ci->db->query($sql)->row()->val??"";
        return $q;
    }

    function jsonoutput($statusHeader,$response){
        $ci =& get_instance();
        $ci->output->set_content_type('application/json');
        $ci->output->set_status_header($statusHeader);
        $ci->output->set_output(json_encode($response));
    }

    function generatepassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function isPost(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            return true;
        }
        else{
            jsonoutput(405,array('status'=>'failed','message'=>'method not allowed'));
        }
    }

    function generatetoken(){
        return md5(randomchar(20).date("YmdHis"));
    }

    function randomchar($length = NULL){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < $length; $i++){
            $result .= $characters[mt_rand(0, 61)];
        }
        return $result;
    }

    function assetsdir(){
        return base_url('assets/');
    }

    function yesorno($bool){
        if($bool==1){
            $result = "Ya";
        }
        else{
            $result = "Tidak";
        }
        return $result;
    }

    function sudahbelum($bool){
        if($bool==1){
            $result = "Sudah";
        }
        else{
            $result = "Belum";
        }
        return $result;
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "Minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

    function basecontroller(){
        $ci =& get_instance();
        $ctrl = $ci->session->userdata('controller');
        return base_url($ctrl);
    }
    
    function activeusername(){
        $ci =& get_instance();
        $username = $ci->session->userdata("username")??"Anonymous";
        return $username;
    }
    
    function getsessiondata($sessiondata){
        $ci =& get_instance();
        $data = $ci->session->userdata($sessiondata)??"";
        return $data;
    }
    
    function getmenubar(){
        $ci =& get_instance();
        $menus = getsessiondata('menu');
        return './application/views/includes/'.$menus;
    }
    
    function getheaderfile(){
        $ci =& get_instance();
        return './application/views/includes/headerstaff.php';
    }
    
    function getfooterfile(){
        $ci =& get_instance();
        return './application/views/includes/footerstaff.php';
    }

    function getheadermemberfile(){
        $ci =& get_instance();
        return './application/views/includes/headermember.php';
    }
    
    function getfootermemberfile(){
        $ci =& get_instance();
        return './application/views/includes/footermember.php';
    }

    function spanflag($flag){
        if($flag=="1"){
            $result = "Aktif";
        }
        else{
            $result = "Nonaktif";
        }
        return $result;
    }

    function spanpayment($flag){
        if($flag=="1"){
            $result = "<span class='badge bg-success'>LUNAS</span>";
        }
        else{
            $result = "<span class='badge bg-danger'>BELUM LUNAS</span>";
        }
        return $result;
    }

    function spanstatus($status){
        if($status=="APPOINMENT"){
            $view = "<span class='badge bg-warning'>APPOINMENT</span>";
        }
        else if($status=="UNVERIFIED"){
            $view = "<span class='badge bg-warning'>UNVERIFIED</span>";
        }
        else if($status=="VERIFIED"){
            $view = "<span class='badge bg-success'>VERIFIED</span>";
        }
        else if($status=="PENDING"){
            $view = "<span class='badge bg-warning'>Pending / Menunggu Respon</span>";
        }
        else if($status=="APPROVED"){
            $view = "<span class='badge bg-success'>APPROVED</span>";
        }
        else if($status=="DECLINED"){
            $view = "<span class='badge bg-danger'>Ditolak / Dibatalkan</span>";
        }
        else{
            $view = "<span class='badge bg-info'>Status Error</span>";
        }
        return $view;
    }

    function spanlabelstatus($status){
        if($status=="APPOINMENT" || $status=="appoinment"){
            $view = "<span class='badge bg-warning'>Belum Ada Hasil</span>";
        }
        else if($status=="UNVERIFIED"  || $status=="unverified"){
            $view = "<span class='badge bg-warning'>Belum Diverifikasi</span>";
        }
        else if($status=="VERIFIED"  || $status=="verified"){
            $view = "<span class='badge bg-success'>Telah Diverifikasi</span>";
        }
        else{
            $view = "<span class='badge bg-info'>Status Error</span>";
        }
        return $view;
    }

    function spanmemberaccount($isaccount){
        if($isaccount=="1"){
            $view = "<span class='badge bg-success'>Account</span>";
        }
        else{
            $view = "<span class='badge bg-danger'>Bukan</span>";
        }
        return $view;
    }

    function spanisactivatemember($isaccount){
        if($isaccount=="1"){
            $view = "<span class='badge bg-success'>Telah Diaktivasi</span>";
        }
        else{
            $view = "<span class='badge bg-danger'>Belum Diaktivasi</span>";
        }
        return $view;
    }

    function spaninvoicestatus($status){
        if($status=="PAYED"){
            $view = "<span class='badge bg-success'>LUNAS</span>";
        }
        else{
            $view = "<span class='badge bg-danger'>BELUM LUNAS</span>";
        }
        return $view;
    }

    function invoicestatus($status){
        if($status=="PAYED"){
            $view = "LUNAS";
        }
        else{
            $view = "BELUM LUNAS";
        }
        return $view;
    }

    function invalidurl(){
        jsonoutput(404,array('status'=>'failed','message'=>'Invalid Url'));
    }
    
    function failedresponse($message){
        jsonoutput(200,array('status'=>'failed','message'=>$message));
    }
    
    function successresponse($message,$data=NULL){
        jsonoutput(200,array('status'=>'success','message'=>$message,));
    }
    
    function dataresponse($object,$data){
        jsonoutput(200,array('status'=>'success','message'=>"Query OK","$object"=>$data));
    }
    
    function redirectresponse($url){
        jsonoutput(200,array('status'=>'success','message'=>"Redirect time",'url'=>$url));
    }

    function generateorderid($mode=NULL){
        $date = date("ymd");
        if($mode=="ONLINE"){
            $id = "M".$date.codegenerator();
        }
        else{
            $branchid = getsessiondata('branchid');
            $id = $branchid.$date.codegenerator();
        }
        return $id;
    }

    function generatememberid(){
        $date = date("ymd");
        return getsessiondata('branchid').$date.rand(11111,99999);   
    }

    function generatebranchid(){
        return rand(1005,1100);
    }

    function codegenerator(){
        return rand(11111,99999);
    }

    function importbatchidgenerator(){
        $date = date("ymd");
        return $date.getsessiondata('branchid').rand(11,99);   
    }

    function getimageasset($type,$name){
        $ci =& get_instance();
        if($type=="user"){
            $var = base_url('documents/users/'.$name);
        }
        else if($type=="resultbackground"){
            $var = base_url('documents/resultbackgrounds/'.$name);
        }
        else if($type=="service"){
            $var = base_url('documents/services/'.$name);
        }
        else if($type=="package"){
            $var = base_url('documents/packages/'.$name);
        }
        else{
            $var = base_url('documents/others/'.$name);
        }
        return $var;
    }

    function getimageasseturl($type){
        $ci =& get_instance();
        if($type=="user"){
            $var = base_url('documents/users/');
        }
        else if($type=="resultbackground"){
            $var = base_url('documents/resultbackgrounds/');
        }
        else if($type=="service"){
            $var = base_url('documents/services/');
        }
        else if($type=="package"){
            $var = base_url('documents/packages/');
        }
        else{
            $var = base_url('documents/others/');
        }
        return $var;
    }

    function imageupload($type){
        $basepath = "./documents/";
        if($type=="receipt"){
            $path = $basepath."receipts/";
        }
        else if($type=="resultbackground"){
            $path = $basepath."resultbackgrounds/";
        }
        else if($type=="service"){
            $path = $basepath."services/";
        }
        else if($type=="package"){
            $path = $basepath."packages/";
        }

        else{
            $path = $basepath."others/";
        }

        $ci =& get_instance();
        $config['upload_path']          = "$path";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']			= true;
        $config['max_size']             = 10000;
        $config['encrypt_name']         = TRUE;
        $ci->load->library('upload', $config);
        if ($ci->upload->do_upload("photo")) {
            $uploaddata = $ci->upload->data();
            return array('status'=>'success','message'=>'foto berhasil diupload','filename'=>$uploaddata['file_name'],'path'=>$path);
        }
        else{
            $error = $ci->upload->display_errors();
            if($error=="<p>You did not select a file to upload.</p>"){
                $message = "Tidak ada foto diupload"; 
                $flag = 1;
            }
            else if($error=="<p>The uploaded file exceeds the maximum allowed size in your PHP configuration file.</p>"){
                $message = "Ukuran gambar terlalu besar"; 
                $flag = 0;
            }
            else if($error=="<p>The file you are attempting to upload is larger than the permitted size.</p>"){
                $message = "Ukuran gambar terlalu besar"; 
                $flag = 0;
            }
            else if($error=="<p>The filetype you are attempting to upload is not allowed.</p>"){
                $message = "Ekstensi file salah"; 
                $flag = 0;
            }
            else{
                $message = $error;
                $flag = 0;
            }
            return array('status'=>'failed','message'=>$message,'flag'=>$flag);
        } 
    }

    function compressimage($fullpath,$width,$height){
        $ci =& get_instance();
        $config = array(
            array(
                'image_library' => 'GD2',
                'source_image'  => $fullpath,
                'maintain_ratio'=> FALSE,
                'width'         => $width,
                'height'        => $height,
                'new_image'     => $fullpath,
            ));
        $ci->load->library('image_lib', $config[0]);
        foreach ($config as $item){
            $ci->image_lib->initialize($item);
            if(!$ci->image_lib->resize()){
                return false;
            }
            else{
                return true;
            }
            $ci->image_lib->clear();
        }
    }

    

    function qrlink($type=NULL){
        if($type=="invoice"){
            return base_url('validation/invoice/');
        }
        else if($type=="result"){
            return base_url('validation/result/');
        }
        else{
            return base_url('validation/other/');
        }
    }

    function cleansymbol($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('&', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
     }

    function getageindo($from,$to){
        $birthDate = new DateTime($from);
        $today = new DateTime($to);
        if ($birthDate > $today) { 
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y." tahun ".$m." bulan ".$d." hari";
    }

    function getageen($from,$to){
        $birthDate = new DateTime($from);
        $today = new DateTime($to);
        if ($birthDate > $today) { 
            exit("0 Yrs 0 Mns 0 Days");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y." yrs ".$m." mnths ".$d." days";
    }

    function genderen($gender){
        if($gender=="Pria"){
            $result = "Male";
        }
        else if($gender=="Wanita"){
            $result = "Female";
        }
        else{
            $result = "Unknown";
        }
        return $result;
    }

    function generateqrcode($token){
        $ci =& get_instance();
        $config['cacheable']    = true;
        $config['cachedir']     = './documents/qr/caches/';
        $config['errorlog']     = './documents/qr/errors/';
        $config['imagedir']     = './documents/qr/images/';
        $config['quality']      = true;
        $config['size']         = '640';
        $config['black']        = array(224,255,255);
        $config['white']        = array(70,130,180);
        $config['text'] = "Validasi";
        $ci->ciqrcode->initialize($config);
        $imageName=$token.'.png';
        $params['data'] = qrlink("result").$token;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$imageName;
        $ci->ciqrcode->generate($params);
    }

    function generateqrcodesample($id){
        $ci =& get_instance();
        $config['cacheable']    = true;
        $config['cachedir']     = './documents/qr/caches/';
        $config['errorlog']     = './documents/qr/errors/';
        $config['imagedir']     = './documents/qr/images/';
        $config['quality']      = true;
        $config['size']         = '640';
        $config['black']        = array(224,255,255);
        $config['white']        = array(70,130,180);
        $ci->ciqrcode->initialize($config);
        $imageName=$id.'.png';
        $params['data'] = $id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$imageName;
        $ci->ciqrcode->generate($params);
    }

    function qrcodepath($qrcode){
        $link = base_url('documents/qr/images/'.$qrcode);
        return $link;
    }

    function isintepretation($intepretation){
        if(empty($intepretation) || $intepretation=="" || $intepretation == NULL || $intepretation =="-"){
            $result = "";
        }
        else{
            $result = $intepretation;
        }
        return $result;
    }

    function getlabresultbylabidandpackageid($labid,$serviceid){
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT result FROM labdetails WHERE labid='$labid' AND serviceid='$serviceid' LIMIT 1";
        $q = $ci->db->query($sql)->row()->val??"-";
        return $q;
    }

    function getfullnamebyusername($username){
        $ci =& get_instance();
        $ci->load->database();
        $q = "SELECT fullname FROM users WHERE username='$username' LIMIT 1";
        return $ci->db->query($sql)->row()->val??"-";
    }
    
    function escapehtmltcpdf($text){
        return str_replace( "\n","<br />",htmlspecialchars( str_replace(array("<br />", "<br/>", "<br>"),"\n", $text),ENT_QUOTES,'UTF-8'));
    }

    function tobase64($fullpath){
        $imagedata = file_get_contents($fullpath);
        $base64 = base64_encode($imagedata);
        return $base64;
    }

    function checkrequesttoken($method = NULL){
        $ci =& get_instance();
        $default = 'abc';
        $requesttoken = $ci->input->get_request_header('SECRET', TRUE);
        if($requesttoken == $default){
            return true;
        } 
        else {    
            return jsonoutput(401,array('status' => 401,'message' => 'Unauthorized Request'));
        }
    }