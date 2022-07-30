<?php


class Login extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Loginmodel');
    $this->load->library('session');
    }

    public function check_ssl(){
    echo("If this page load without any warning then its mean ssl configured");    
    }
    
	public function index(){
	$root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    if($root=="https"){    
	$data['error']="N";	
	$this->load->view('loginView',$data);
    } else if($root=="http"){
    header('Location: https://cargo.tmcargoexpress.com');    
    }
	}
	
	public function web(){
	$this->load->view('webhomeView');    
	}
	
	public function about(){
	$this->load->view('webhomeView');    
	}
	
	

	public function process_login(){
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	if($email!="" && $password!="" ){
	$user_data=$this->Loginmodel->Get_User_Detail_By_Username($email);
	if(!empty($user_data)){
	foreach($user_data as $rows){	
	$userpassword=$rows->user_password;
	if($userpassword==md5($password)){
	$_SESSION['customer_name']	= $rows->customer_name;
	$_SESSION['old_portal_id']	= $rows->old_portal_id;
	$_SESSION['customer_id']	= $rows->customer_id;
	$_SESSION['pickup_points']	= $rows->customer_pickup_points;
	$_SESSION['account_type']	= $rows->customer_account_type;
	$_SESSION['origin_id']		= $rows->customer_city;
	$_SESSION['origin_name']	= $rows->city_name;	
    $_SESSION['user_id']		= $rows->user_id;
    $_SESSION['user_name']		= $rows->user_name;
    $_SESSION['account_no']		= $rows->user_name;
	$_SESSION['user_power']		= $rows->user_power;
	$_SESSION['is_tm']		    = $rows->is_tm;
	$_SESSION['portal'] 	    = "customer";
	$this->Loginmodel->Update_Login_Date($_SESSION['user_id']);
	if($_SESSION['user_power']=="AGENT"){
	redirect('Home');
	} else if($_SESSION['user_power']=="CADMIN"){
	redirect('Home/dashboard2');
	} else if($_SESSION['user_power']=="SUBAGENT"){
	redirect('Home');
	}    
	} else {
	$data['error']="YN";	
	$this->load->view('loginView',$data);	
	}
	}
	} else {
	$data['error']="Y";	
	$this->load->view('loginView',$data);		
	}
	} else {
	$data['error']="Y";	
	$this->load->view('loginView',$data);			
	}
	}

	public function logout(){
	$this->Loginmodel->Update_Logout_Date($_SESSION['user_id']);
	session_destroy();
    $data['error']="N";	
	$this->load->view('loginView',$data);	
	}



	
	




	


	


	
	
}
