<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Login extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Loginmodel');
    $this->load->library('session');
    }

    
	public function index(){
	$root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    if($root=="https"){        
	$data['error']="N";	
	$this->load->view('loginView',$data);
   } else if($root=="http"){
   header('Location: https://stage.tmcargoexpress.com/ops_tm');    
  }
	}

	public function process_login(){
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	if($email!="" && $password!="" ){
	$user_data=$this->Loginmodel->Get_User_Detail_By_Username($email);
	if(!empty($user_data)){
	foreach($user_data as $rows){	
	$userpassword=$rows->oper_user_password;
	if($userpassword==md5($password)){
	$_SESSION['user_id']			= $rows->oper_user_id;
	$_SESSION['user_name']			= $rows->oper_user_name;
	$_SESSION['account_no']			= $rows->oper_account_no;
	$_SESSION['origin_id']			= $rows->oper_user_city_id;
	$_SESSION['city_code']			= $rows->city_code;
	$_SESSION['origin_name']		= $rows->city_name;	
	$_SESSION['reporting_orign_id']	= $rows->reporting_city;	
    $_SESSION['user_power']			= $rows->oper_user_power;
    $_SESSION['reproting_station']	= $rows->opr_reporting_station;
    $_SESSION['thrid_party_id'] 	= $rows->thrid_party_id;
    $_SESSION['portal'] 	        = "ops";
	$this->Loginmodel->Update_Login_Date($_SESSION['user_id']);
	redirect('Home');
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
