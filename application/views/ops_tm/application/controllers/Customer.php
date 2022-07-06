<?php

class Customer extends CI_Controller {

	function __construct() {
    parent::__construct();
    date_default_timezone_set('Asia/Karachi');
    $this->load->model('Commonmodel');
    $this->load->model('Customermodel');
    }


	public function index(){
	//echo($_SESSION['origin_id']);	
	$data['sub_nav_active']="Customer";
	$data['nav_active']="Add Customer";	
	$data['event_name']="Add Customer";
	if($_SESSION['user_power']=='BM'){
    $data['customer_data']=$this->Customermodel->Get_Customers_Data_By_Created_ID($_SESSION['user_id']);}
    else if($_SESSION['user_power']=='SE' || $_SESSION['user_power']=='Accounts'){
    $data['customer_data']=$this->Customermodel->Get_All_Customers(); }   
    else if($_SESSION['user_power']=='SM'){
    $data['customer_data']=$this->Customermodel->Get_Customers_Data_By_Created_ID($_SESSION['user_id']);}
    $this->load->view('module_customer/customerView',$data);	
	}

	
	
    public function update_status($status,$id){
        
    }

    public function add_customer_view($error){
    $data['event_name']="Add Customer"; 
    $data['cities_data']=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'is_enable', 1);
    $data['freelancer_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'FL', 'is_enable', 1);
    $data['reference_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'Emp', 'is_enable', 1);
    $data['error']=$error;
    $this->load->view('module_customer/addcustomerView',$data);	   
    }
    
    
    
    public function show_customer_view($customer_id){
    $get_rate_id=$this->Commonmodel->Get_record_by_double_condition_array('saimtech_rate', 'customer_id', $customer_id, 'is_enable', 1);
    $rate_id=$get_rate_id[0]['rate_id'];
    $data['cities_data']=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'is_enable', 1);    
    $data['customer_data']=$this->Commonmodel->Get_record_by_condition_array('saimtech_customer', 'customer_id', $customer_id); 
    $data['freelancer_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'FL', 'is_enable', 1);
    $data['reference_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'Emp', 'is_enable', 1);
    $this->load->view('module_customer/showcustomerView',$data);
    }
	
	public function show_rate_view($customer_id){
    $get_rate_id=$this->Commonmodel->Get_record_by_double_condition_array('saimtech_rate', 'customer_id', $customer_id, 'is_enable', 1);
    $rate_id=$get_rate_id[0]['rate_id'];
    $data['cities_data']=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'is_enable', 1);    
    $data['customer_data']=$this->Commonmodel->Get_record_by_condition_array('saimtech_customer', 'customer_id', $customer_id); 
    $data['freelancer_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'FL', 'is_enable', 1);
    $data['reference_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'Emp', 'is_enable', 1);
    $data['rate_data']=$this->Commonmodel->Get_record_by_condition_array('saimtech_rate', 'rate_id', $rate_id);
    $data['dest_data']=$this->Customermodel->Get_Destination_Rate( $customer_id);
    $this->load->view('module_customer/rateshowView',$data);
    }

	
	public function add_customer(){
	$brand_city 	 	     = $this->input->post('brand_city');    
	$message                 ="";    
	$gst                     = 16;
	if($brand_city==2){$gst  = 13;   }
	$brand_name 	 	     = $this->input->post('brand_name');
	$brand_name 	 	     = $this->input->post('brand_name');
	$service_type 	 	     = $this->input->post('serivce_type');
	$brand_url   	 	     = $this->input->post('brand_url');
	$brand_cnic 	 	     = $this->input->post('brand_cnic');
	$account_type 	         = $this->input->post('operating_type');
	$gst_type 	             = $this->input->post('gst_type');
	$brand_product 	         = $this->input->post('brand_product');
	$calculation_type 	     = $this->input->post('calculation_type');
	$pay_mode 	             = $this->input->post('pay_mode');
	$pickup_points 	         = $this->input->post('pickup_points');
	$brand_ntn 	             = $this->input->post('brand_ntn');
	$brand_email 	         = $this->input->post('brand_email');
	$brand_phone 	         = $this->input->post('brand_phone');
	$brand_note 	         = $this->input->post('brand_note');
	$bank_name 	 	         = $this->input->post('bank_name');
	$bank_address 	 	     = $this->input->post('brand_address');
    $account_title 	 	     = $this->input->post('account_title');
    $account_no 	 	     = $this->input->post('account_no');
    $account_iban 	 	     = $this->input->post('account_iban');
	$display_name            = $this->input->post('display_name');
	$reference_by            = $this->input->post('reference_by');
	$secondary_reference_by  = $this->input->post('secondary_reference_by');
	$user_name               = $this->input->post('user_name');
	$user_password           = $this->input->post('user_password');
	$date 			         = date('Y-m-d H:i:s');
	$pay_mode_id             = $this->input->post('pay_mode');
	if($pay_mode_id=="1"){
	$paymode ="Account";    
	} else if($pay_mode_id=="2"){
	$paymode ="FOD";    
	} else if($pay_mode_id=="3"){
	$paymode ="Account & FOD";    
	} else if($pay_mode_id=="4"){
	$paymode ="Cash";    
	} else if($pay_mode_id=="5"){
	$paymode ="FOC";    
	} 
	$api_key                 = uniqid();
	if($brand_name!="" && $brand_city!="" && $user_name!="" && $brand_cnic!="" && $pay_mode_id!="" && $service_type!=""){
	$this->db->trans_start();	
	//--- INSERT INTO Invoice Customer
	$data = array(
	'customer_name'                 => $brand_name,
	'type'                          => 'Customer',
	'customer_contact'              => $brand_phone,
	'customer_contact2'             => $brand_email,
	'customer_address'              => $bank_address,
	'customer_city'                 => $brand_city,
	'customer_cnic'                 => $brand_cnic,
	'customer_ntn'                  => $brand_ntn,
	'customer_bank'                 => $bank_name,
	'customer_bank_account_title'   => $account_title,
	'customer_bank_account_no'      => $account_no,
	'customer_iban'                 => $account_iban,
	'customer_url'                  => $brand_url,
	'customer_note'                 => $brand_note,
	'handling_limit'                => '500000',
	'customer_account_type'         => $account_type,
	'is_gst'                        => $gst_type,
	'customer_product_type'         => $brand_product,
	'cal_type'                      => $calculation_type,
	'customer_contact_person'       => $pickup_points,
	'serivce_name'                  => $serivce_name,
	'gst'                           => $gst,
	'is_enable'                     => 1,
	'api_key'                       => $api_key,
	'reference_by'                  => $reference_by,
	'pay_mode_id'                   => $pay_mode,
	'pay_mode'                      => $paymode,
	'serivce_name'                  => $service_type,
	'secondary_reference_by'        => $secondary_reference_by,
	'created_by'                    => $_SESSION['user_id'],
	'created_date'                  => date('Y-m-d H:i:s'),
	'modify_by'                     => 0,
	'modify_date'                   => '0000-00-00 00:00:00'
	);	
	$customer_id=$this->Commonmodel->Insert_record('saimtech_customer', $data);
	$ccity_data=$this->Commonmodel->Get_record_by_condition_array('saimtech_city', 'city_id', $brand_city);
	$city_code=$ccity_data[0]['city_code'].$customer_id;
	$data =array('customer_account_no'  => $city_code);
	$this->Commonmodel->Update_record('saimtech_customer', 'customer_id', $customer_id, $data);    
	$data = array(
	'user_name'         =>$display_name, 
	'account_no'        =>$user_name, 
	'user_password'     =>md5($user_password), 
	'user_power'        =>'AGENT',
	'user_city'         =>$brand_city, 
	'is_enable'         =>1,
	'customer_id'       =>$customer_id, 
	'last_login'        =>'0000-00-00', 
	'last_logout'       =>'0000-00-00', 
	'created_date'      =>$date, 
	'created_by'        =>$_SESSION['user_id'],
	'modify_date'       =>'0000-00-00 00:00:00', 
	'modify_by'         =>1 
	);	
	$user_id=$this->Commonmodel->Insert_record('saimtech_user', $data);
	
	$data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>1, 
	'sc_wgt1'               =>1, 
	'sc_rate1'              =>500, 
	'sc_wgt2'               =>10, 
	'sc_rate2'              =>500, 
	'sc_add_wgt'            =>1, 
	'sc_add_rate'           =>50,
	'sc_gst_rate'           =>0, 
	'sc_fuel_formula'       =>'Fix', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'Fix',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'Fix', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>1, 
	'sz_rate1'              =>500, 
	'sz_wgt2'               =>10, 
	'sz_rate2'              =>500,
	'sz_add_wgt'            =>1, 
	'sz_add_rate'           =>50, 
	'sz_gst_rate'           =>16,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>1, 
	'dz_rate1'              =>500, 
	'dz_wgt2'               =>10, 
	'dz_rate2'              =>500, 
	'dz_add_wgt'            =>1, 
	'dz_add_rate'           =>50, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>0, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>1,
	'zz_rate1'              =>50, 
	'zz_wgt2'               =>10, 
	'zz_rate2'              =>500, 
	'zz_add_wgt'            =>1, 
	'zz_add_rate'           =>50, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>0,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
	$rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);
	$data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>2, 
	'sc_wgt1'               =>1, 
	'sc_rate1'              =>200, 
	'sc_wgt2'               =>10, 
	'sc_rate2'              =>200, 
	'sc_add_wgt'            =>1, 
	'sc_add_rate'           =>20,
	'sc_gst_rate'           =>16, 
	'sc_fuel_formula'       =>'Fix', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'Fix',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'Fix', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>1, 
	'sz_rate1'              =>250, 
	'sz_wgt2'               =>10, 
	'sz_rate2'              =>250,
	'sz_add_wgt'            =>1, 
	'sz_add_rate'           =>25, 
	'sz_gst_rate'           =>16,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>1, 
	'dz_rate1'              =>350, 
	'dz_wgt2'               =>10, 
	'dz_rate2'              =>350, 
	'dz_add_wgt'            =>1, 
	'dz_add_rate'           =>35, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>0, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>1,
	'zz_rate1'              =>500, 
	'zz_wgt2'               =>10, 
	'zz_rate2'              =>500, 
	'zz_add_wgt'            =>1, 
	'zz_add_rate'           =>50, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>0,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
	$rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);
	$data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>3, 
	'sc_wgt1'               =>1, 
	'sc_rate1'              =>450,
	'sc_wgt2'               =>10, 
	'sc_rate2'              =>450, 
	'sc_add_wgt'            =>1, 
	'sc_add_rate'           =>45,
	'sc_gst_rate'           =>16, 
	'sc_fuel_formula'       =>'Fix', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'Fix',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'Fix', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>1, 
	'sz_rate1'              =>450, 
	'sz_wgt2'               =>10, 
	'sz_rate2'              =>450,
	'sz_add_wgt'            =>1, 
	'sz_add_rate'           =>45, 
	'sz_gst_rate'           =>16,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>1, 
	'dz_rate1'              =>450, 
	'dz_wgt2'               =>10, 
	'dz_rate2'              =>450, 
	'dz_add_wgt'            =>1, 
	'dz_add_rate'           =>45, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>0, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>1,
	'zz_rate1'              =>450, 
	'zz_wgt2'               =>10, 
	'zz_rate2'              =>450, 
	'zz_add_wgt'            =>1, 
	'zz_add_rate'           =>45, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>0,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
	$rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);
	$data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>4, 
	'sc_wgt1'               =>1, 
	'sc_rate1'              =>500, 
	'sc_wgt2'               =>10, 
	'sc_rate2'              =>500, 
	'sc_add_wgt'            =>1, 
	'sc_add_rate'           =>50,
	'sc_gst_rate'           =>16, 
	'sc_fuel_formula'       =>'Fix', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'Fix',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'Fix', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>1, 
	'sz_rate1'              =>500, 
	'sz_wgt2'               =>10, 
	'sz_rate2'              =>500,
	'sz_add_wgt'            =>1, 
	'sz_add_rate'           =>50, 
	'sz_gst_rate'           =>16,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>1, 
	'dz_rate1'              =>500, 
	'dz_wgt2'               =>10, 
	'dz_rate2'              =>500, 
	'dz_add_wgt'            =>1, 
	'dz_add_rate'           =>50, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>1, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>1,
	'zz_rate1'              =>0, 
	'zz_wgt2'               =>10, 
	'zz_rate2'              =>0, 
	'zz_add_wgt'            =>1, 
	'zz_add_rate'           =>0, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>0,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
	$rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);
	$this->db->trans_complete();
    redirect('Customer/add_customer_view/1');
	} else {
	redirect('Customer/add_customer_view/2');
	}	
	}	


    public function edit_customer_view($customer_id){
    $get_rate_id=$this->Commonmodel->Get_record_by_double_condition_array('saimtech_rate', 'customer_id', $customer_id, 'is_enable', 1);
    $rate_id=$get_rate_id[0]['rate_id'];
    $data['customer_id']=$customer_id;
    $data['cities_data']=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'is_enable', 1);    
    $data['customer_data']=$this->Commonmodel->Get_record_by_condition_array('saimtech_customer', 'customer_id', $customer_id); 
    $data['freelancer_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'FL', 'is_enable', 1);
    $data['reference_data']=$this->Commonmodel->Get_record_by_double_condition('saimtech_reference', 'reference_type', 'Emp', 'is_enable', 1);
    $this->load->view('module_customer/editcustomerView',$data);
    }
    
    
    
    public function edit_customer(){
	$message                             ="";    
	$gst                                 = 16;
	$service_type 	 	     = $this->input->post('serivce_type');
	$customer_id 	 	     = $this->input->post('customer_id');
	$rate_id 	 	         = $this->input->post('rate_id');
	$brand_name 	 	     = $this->input->post('brand_name');
	$brand_url   	 	     = $this->input->post('brand_url');
	$brand_cnic 	 	     = $this->input->post('brand_cnic');
	$account_type 	         = $this->input->post('operating_type');
	$gst_type 	             = $this->input->post('gst_type');
    $brand_product 	         = $this->input->post('brand_product');
    $calculation_type 	     = $this->input->post('calculation_type');
	$pickup_points 	         = $this->input->post('pickup_points');
	$brand_ntn 	             = $this->input->post('brand_ntn');
	$brand_email 	         = $this->input->post('brand_email');
	$brand_phone 	         = $this->input->post('brand_phone');
	$brand_note 	         = $this->input->post('brand_note');
	$bank_name 	 	         = $this->input->post('bank_name');
	$bank_address 	 	     = $this->input->post('brand_address');
	$pay_mode_id 	         = $this->input->post('pay_mode');
    $brand_city 	 	     = $this->input->post('brand_city');
    if($brand_city==2){$gst  = 13;   }
    $account_title 	 	     = $this->input->post('account_title');
    $account_no 	 	     = $this->input->post('account_no');
    $account_iban 	 	     = $this->input->post('account_iban');
	$display_name            = $this->input->post('display_name');
	$reference_by            = $this->input->post('reference_by');
	$secondary_reference_by  = $this->input->post('secondary_reference_by');
	$user_name               = $this->input->post('user_name');
	$user_password           = $this->input->post('user_password');
	$date 			         = date('Y-m-d H:i:s');
	$api_key                 = uniqid();
		if($pay_mode_id=="1"){
	$paymode ="Account";    
	} else if($pay_mode_id=="2"){
	$paymode ="FOD";    
	} else if($pay_mode_id=="3"){
	$paymode ="Account & FOD";    
	} else if($pay_mode_id=="4"){
	$paymode ="Cash";    
	} else if($pay_mode_id=="5"){
	$paymode ="FOC";    
	} 
	if($customer_id!="" && $brand_name!="" && $brand_city!="" &&  $brand_cnic!="" && $service_type!=""){
	$this->db->trans_start();	
	//--- Update INTO Customer
	$data = array(
	'customer_name'                 => $brand_name,
	'customer_contact'              => $brand_phone,
	'customer_contact2'             => $brand_email,
	'customer_address'              => $bank_address,
	'customer_city'                 => $brand_city,
	'customer_cnic'                 => $brand_cnic,
	'customer_ntn'                  => $brand_ntn,
	'customer_bank'                 => $bank_name,
	'customer_bank_account_title'   => $account_title,
	'customer_bank_account_no'      => $account_no,
	'customer_iban'                 => $account_iban,
	'customer_url'                  => $brand_url,
	'customer_note'                 => $brand_note,
	'handling_limit'                => '500000',
	'customer_product_type'         => $brand_product,
	'cal_type'                      => $calculation_type,
	'customer_contact_person'       => $pickup_points,
	'customer_account_type'         => $account_type,
	'is_gst'                        => $gst_type,
	'gst'                           => $gst,
	'reference_by'                  => $reference_by,
	'secondary_reference_by'        => $secondary_reference_by,
	'pay_mode'                      => $paymode,
	'serivce_name'                  => $service_type,
	'pay_mode_id'                   => $pay_mode_id,
	'modify_by'                     => $_SESSION['user_id'],
	'modify_date'                   =>  date('Y-m-d H:i:s')
	);	
	$effective_rows=$this->Commonmodel->Update_record('saimtech_customer', 'customer_id', $customer_id, $data);
	$this->db->trans_complete();
	$message="<p class='alert alert-success'>Successfully Done</p>";    
	redirect(base_url().'Customer/edit_customer_view/'.$customer_id);
	} else {
	    
	echo"<p class='alert alert-danger'>Something Went Wrong Please Try Again</p>";
	}
    }
    
    
    public function check_username(){
    $username=$this->input->post('username');
    $check=0;
    if($username!=""){
    $check=$this->Commonmodel->Duplicate_check('saimtech_user', 'account_no', $username);   
    } else {
    $check=0;    
    }
    echo($check);
    }
    
    public function zone_wise_rate_view($customer_id){
    if($customer_id){
    $query="SELECT *, `saimtech_rate`.`is_enable` as rate_status  FROM `saimtech_rate` INNER JOIN saimtech_service ON saimtech_service.service_id=saimtech_rate.service_id WHERE customer_id=".$customer_id;
    $data['service_data']=$this->Commonmodel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
    $data['customer_id']=$customer_id;
    $data['rate_data']=$this->Commonmodel->Raw_Query_Execution($query);
    $this->load->view('module_customer/ratecreateView',$data);
    } else {
    echo("<center><h1><mark>Access Blocked.....</mark></h1></center>");    
    }
    }
    
    public function add_zone_wise_rate(){
    $service_type           =$this->input->post('service_type');
    $customer_id            =$this->input->post('customer_id');
    $zone_a_wgt_1           =$this->input->post('zone_a_wgt_1');
    $zone_a_rate_1          =$this->input->post('zone_a_rate_1');
    $zone_a_wgt_2           =$this->input->post('zone_a_wgt_2');
    $zone_a_rate_2          =$this->input->post('zone_a_rate_2');
    $zone_a_add_wgt         =$this->input->post('zone_a_add_wgt');
    $zone_a_add_rate        =$this->input->post('zone_a_add_rate');
    $zone_a_gst             =$this->input->post('zone_a_gst');
    $zone_b_gst             =$this->input->post('zone_b_gst');
    $zone_c_gst             =$this->input->post('zone_c_gst');
    $zone_d_gst             =$this->input->post('zone_d_gst');
    $zone_b_wgt_1           =$this->input->post('zone_b_wgt_1');
    $zone_b_rate_1          =$this->input->post('zone_b_rate_1');
    $zone_b_wgt_2           =$this->input->post('zone_b_wgt_2');
    $zone_b_rate_2          =$this->input->post('zone_b_rate_2');
    $zone_b_add_wgt         =$this->input->post('zone_b_add_wgt');
    $zone_b_add_rate        =$this->input->post('zone_b_add_rate');
    $zone_c_wgt_1           =$this->input->post('zone_c_wgt_1');
    $zone_c_rate_1          =$this->input->post('zone_c_rate_1');
    $zone_c_wgt_2           =$this->input->post('zone_c_wgt_2');
    $zone_c_rate_2          =$this->input->post('zone_c_rate_2');
    $zone_c_add_wgt         =$this->input->post('zone_c_add_wgt');
    $zone_c_add_rate        =$this->input->post('zone_c_add_rate');
    $zone_d_wgt_1           =$this->input->post('zone_d_wgt_1');
    $zone_d_rate_1          =$this->input->post('zone_d_rate_1');
    $zone_d_wgt_2           =$this->input->post('zone_d_wgt_2');
    $zone_d_rate_2          =$this->input->post('zone_d_rate_2');
    $zone_d_add_wgt         =$this->input->post('zone_d_add_wgt');
    $zone_d_add_rate        =$this->input->post('zone_d_add_rate');
    $check                  =0;
    if(
    $service_type!="" && 
    $customer_id!="" &&
    $zone_a_wgt_1>0 && 
    $zone_b_wgt_1>0 &&
    $zone_c_wgt_1>0 &&
    $zone_d_wgt_1>0 &&
    $zone_a_wgt_2>0 && 
    $zone_b_wgt_2>0 &&
    $zone_c_wgt_2>0 &&
    $zone_d_wgt_2>0 &&
    $zone_a_add_wgt>0 && 
    $zone_b_add_wgt>0 &&
    $zone_c_add_wgt>0 &&
    $zone_d_add_wgt>0 &&
    $zone_a_rate_1>0 && 
    $zone_b_rate_1>0 &&
    $zone_c_rate_1>0 &&
    $zone_d_rate_1>0 &&
    $zone_a_rate_2>0 && 
    $zone_b_rate_2>0 &&
    $zone_c_rate_2>0 &&
    $zone_d_rate_2>0 &&
    $zone_a_add_rate>0 && 
    $zone_b_add_rate>0 &&
    $zone_c_add_rate>0 &&
    $zone_d_add_rate>0){
    //---------Duplicate Check----------------
    $check=$this->Commonmodel->Duplicate_double_check('saimtech_rate', 'service_id', $service_type, 'customer_id', $customer_id);
    if($check==0){
    $data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>$service_type, 
	'sc_wgt1'               =>$zone_a_wgt_1, 
	'sc_rate1'              =>$zone_a_rate_1, 
	'sc_wgt2'               =>$zone_a_wgt_2, 
	'sc_rate2'              =>$zone_a_rate_2, 
	'sc_add_wgt'            =>$zone_a_add_wgt, 
	'sc_add_rate'           =>$zone_a_add_rate,
	'sc_gst_rate'           =>$zone_a_gst, 
	'sc_fuel_formula'       =>'FIX', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'FIX',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'FIX', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>$zone_b_wgt_1, 
	'sz_rate1'              =>$zone_b_rate_1, 
	'sz_wgt2'               =>$zone_b_wgt_2, 
	'sz_rate2'              =>$zone_b_rate_2,
	'sz_add_wgt'            =>$zone_b_add_wgt, 
	'sz_add_rate'           =>$zone_b_add_rate, 
	'sz_gst_rate'           =>$zone_b_gst,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>$zone_c_wgt_1, 
	'dz_rate1'              =>$zone_c_rate_1, 
	'dz_wgt2'               =>$zone_c_wgt_2, 
	'dz_rate2'              =>$zone_c_rate_2, 
	'dz_add_wgt'            =>$zone_c_add_wgt, 
	'dz_add_rate'           =>$zone_c_add_rate, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>$zone_c_gst, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>$zone_d_wgt_1,
	'zz_rate1'              =>$zone_d_rate_1, 
	'zz_wgt2'               =>$zone_d_wgt_2, 
	'zz_rate2'              =>$zone_d_rate_2, 
	'zz_add_wgt'            =>$zone_d_add_wgt, 
	'zz_add_rate'           =>$zone_d_add_rate, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>$zone_d_gst,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
    $rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);
    } else {
    $data = array(
    'is_enable'     => 0,
    'deactive_date' => date('Y-m-d'),
    'modify_by'     => $_SESSION['user_id'],
    'modify_date'   => date('Y-m-d H:i:s'));
    $rate_id=$this->Commonmodel->Update_double_record('saimtech_rate', 'service_id', $service_type, 'customer_id', $customer_id, $data);
    $data = array(
	'customer_id'           =>$customer_id, 
	'service_id'            =>$service_type, 
	'sc_wgt1'               =>$zone_a_wgt_1, 
	'sc_rate1'              =>$zone_a_rate_1, 
	'sc_wgt2'               =>$zone_a_wgt_2, 
	'sc_rate2'              =>$zone_a_rate_2, 
	'sc_add_wgt'            =>$zone_a_add_wgt, 
	'sc_add_rate'           =>$zone_a_add_rate,
	'sc_gst_rate'           =>$zone_a_gst, 
	'sc_fuel_formula'       =>'FIX', 
	'sc_fuel_rate'          =>0, 
	'sc_sp_handling_formula'=>'FIX',
	'sc_sp_handling_rate'   =>0, 
	'sc_return_formula'     =>'FIX', 
	'sc_return_rate'        =>0, 
	'sz_wgt1'               =>$zone_b_wgt_1, 
	'sz_rate1'              =>$zone_b_rate_1, 
	'sz_wgt2'               =>$zone_b_wgt_2, 
	'sz_rate2'              =>$zone_b_rate_2,
	'sz_add_wgt'            =>$zone_b_add_wgt, 
	'sz_add_rate'           =>$zone_b_add_rate, 
	'sz_gst_rate'           =>$zone_b_gst,
	'sz_fuel_formula'       =>'FIX',
	'sz_fuel_rate'          =>0,
	'sz_sp_handling_formula'=>'FIX',
	'sz_sp_handling_rate'   =>0,
	'sz_return_formula'     =>'FIX', 
	'sz_return_rate'        =>0, 
	'dz_wgt1'               =>$zone_c_wgt_1, 
	'dz_rate1'              =>$zone_c_rate_1, 
	'dz_wgt2'               =>$zone_c_wgt_2, 
	'dz_rate2'              =>$zone_c_rate_2, 
	'dz_add_wgt'            =>$zone_c_add_wgt, 
	'dz_add_rate'           =>$zone_c_add_rate, 
	'dz_fuel_formula'       =>'FIX', 
	'dz_fuel_rate'          =>0,
	'dz_sp_handling_formula'=>'FIX', 
	'dz_sp_handling_rate'   =>0, 
	'dz_gst_rate'           =>$zone_c_gst, 
	'dz_return_formula'     =>'FIX', 
	'dz_return_rate'        =>0,
	'zz_wgt1'               =>$zone_d_wgt_1,
	'zz_rate1'              =>$zone_d_rate_1, 
	'zz_wgt2'               =>$zone_d_wgt_2, 
	'zz_rate2'              =>$zone_d_rate_2, 
	'zz_add_wgt'            =>$zone_d_add_wgt, 
	'zz_add_rate'           =>$zone_d_add_rate, 
	'zz_fuel_formula'       =>'FIX', 
	'zz_fuel_rate'          =>0, 
	'zz_sp_handling_formula'=>'FIX', 
	'zz_sp_handling_rate'   =>0, 
	'zz_gst_rate'           =>$zone_d_gst,
	'zz_return_formula'     =>'FIX',
	'zz_return_rate'        =>0,
	'cash_handling_formula' =>'FIX', 
	'cash_handling_rate'    =>0, 
	'reference_formula'     =>'FIX', 
	'reference_rate'        =>0, 
	'flyer_rate'            =>0, 
	'is_enable'             =>1, 
	'deactive_date'         =>'0000-00-00 00:00:00', 
	'delete_date'           =>'0000-00-00 00:00:00', 
	'created_by'            =>$_SESSION['user_id'], 
	'created_date'          =>date('Y-m-d H:i:s'), 
	'modify_by'             =>0, 
	'modify_date'           =>'0000-00-00 00:00:00', 
	);	
    $rate_id=$this->Commonmodel->Insert_record('saimtech_rate', $data);}
    $this->redraw_table_zone_rate($customer_id);
    //======================================END
    } else {
    echo("Fail");    
    }
    }

    public function redraw_table_zone_rate($customer_id){
    $query="SELECT *, `saimtech_rate`.`is_enable` as rate_status  FROM `saimtech_rate` INNER JOIN saimtech_service ON saimtech_service.service_id=saimtech_rate.service_id WHERE customer_id=".$customer_id;
    $rate_data=$this->Commonmodel->Raw_Query_Execution($query);
    if(!empty($rate_data)){
    foreach($rate_data as $rows){
    echo("<tr>");
    echo("<td><center>".$rows->service_name." (".$rows->service_code.")<p><b>Rate ID:</b>".$rows->rate_id."</p>");
    if($rows->rate_status==1){
    echo("<a href='".base_url()."customer/destination_wise_rate_view/".$rows->customer_id."/".$rows->service_id."' class='btn btn-info'>Destination Wise</a>");
    }
    echo("</center></td>");
    echo("<td style='border-color:#6f42c1'>
    <p><b>WGT1:</b> ".$rows->sc_wgt1."    <b>Rate1:</b> ".$rows->sc_rate1."</p>
    <p><b>WGT2:</b> ".$rows->sc_wgt2."    <b>Rate2:</b> ".$rows->sc_rate2."</p>
    <p><b>AWGT:</b> ".$rows->sc_dd_wgt."        <b>ARate:</b> ".$rows->sc_add_rate."</p>
    <p><b>GST:</b> ".$rows->sc_gst_rate."</p>
    </td>");
    echo("<td style='border-color:#007bff'>
    <p><b>WGT1:</b> ".$rows->sz_wgt1."    <b>Rate1:</b> ".$rows->sz_rate1."</p>
    <p><b>WGT2:</b> ".$rows->sz_wgt2."    <b>Rate2:</b> ".$rows->sz_rate2."</p>
    <p><b>AWGT:</b> ".$rows->sz_add_wgt."        <b>ARate:</b> ".$rows->sz_add_rate."</p>
    <p><b>GST:</b> ".$rows->sz_gst_rate."</p>
    </td>");
    echo("<td style='border-color:#17a2b8'>
    <p><b>WGT1:</b> ".$rows->dz_wgt1."    <b>Rate1:</b> ".$rows->dz_rate1."</p>
    <p><b>WGT2:</b> ".$rows->dz_wgt2."    <b>Rate2:</b> ".$rows->dz_rate2."</p>
    <p><b>AWGT:</b> ".$rows->dz_add_wgt."        <b>ARate:</b> ".$rows->dz_add_rate."</p>
    <p><b>GST:</b> ".$rows->dz_gst_rate."</p>
    </td>");
    echo("<td style='border-color:#20c997'>
    <p><b>WGT1:</b> ".$rows->zz_wgt1."    <b>Rate1:</b> ".$rows->zz_rate1."</p>
    <p><b>WGT2:</b> ".$rows->zz_wgt2."    <b>Rate2:</b> ".$rows->zz_rate2."</p>
    <p><b>AWGT:</b> ".$rows->zz_add_wgt." <b>ARate:</b> ".$rows->zz_add_rate."</p>
    <p><b>GST:</b> ".$rows->zz_gst_rate."</p>
    </td>");
    if($rows->rate_status==1){
    echo("<td class='bg-success text-white'><center>Active</center></td>");     
    } else {
    echo("<td class='bg-danger text-white'><center>Blocked</center></td>");     
    }
    echo("</tr>");    
    }}   
    }
    
    public function destination_wise_rate_view($customer_id,$service_type){
    $data['city_data']=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'is_enable', 1);    
    $data['customer_id']=$customer_id;    
    $data['service_type']=$service_type;
    $data['service_data']=$this->Commonmodel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
    
    
    $data['destination_data']=$this->Commonmodel->Get_Destination_Wise_Rate($customer_id,$service_type);    
    $this->load->view('module_customer/dratecreateView',$data);
    }
    
    public function destination_wise_rate(){
    $service_type   =$this->input->post('service_type');
    $customer_id    =$this->input->post('customer_id');
    $wgt1           =$this->input->post('wgt1');
    $rate1          =$this->input->post('rate1');
    $wgt2           =$this->input->post('wgt2');
    $rate2          =$this->input->post('rate2');
    $addwgt         =$this->input->post('addwgt');
    $addrate        =$this->input->post('addrate');
    $gst            =$this->input->post('gst');
    $origin         =$this->input->post('origin');
    $destination    =$this->input->post('destination');
    $j              =sizeof($destination);   
    if($service_type!="" && $customer_id!="" && $wgt1!="" &&  $rate1!="" &&  $wgt2!="" &&  $rate2!="" && $addwgt!="" && $addrate!="" && $gst!="" && $origin!="" && $j!=""){
    

    for($i=0; $i<=$j; $i++){
    if($destination[$i]!="ex_punjab" && $destination[$i]!="ex_sindh" && $destination[$i]!="ex_kpk"){    
    $check = $this->Commonmodel->five_double_check('saimtech_destination_rate', 'service_id', $service_type, 'customer_id', $customer_id, 'dest_city_id', $destination[$i], 'origin_city_id', $origin, 'is_enable', 1);
    if($check>0){
    $data =array(
    'is_enable'    =>0,
    'modify_by'    =>$_SESSION['user_id'],
    'modify_date'  =>date('Y-m-d H:i:s')
    );
    $this->Commonmodel->Update_Five_record('saimtech_destination_rate', 'service_id', $service_type, 'customer_id', $customer_id, 'dest_city_id', $destination[$i], 'origin_city_id', $origin, 'is_enable', 1,$data);    
    }    
    $data =array(
    'customer_id'   =>$customer_id,
    'service_id'    =>$service_type,
    'origin_city_id'=>$origin,
    'dest_city_id'  =>$destination[$i],
    'city_wgt1'     =>$wgt1,
    'city_rate1'    =>$rate1,
    'city_wgt2'     =>$wgt2,
    'city_rate2'    =>$rate2,
    'city_add_wgt'  =>$addwgt,
    'city_add_rate' =>$addrate,
    'city_gst'      =>$gst,
    'is_enable'     =>1,
    'created_by'    =>$_SESSION['user_id'],
    'created_date'  =>date('Y-m-d H:i:s'),
    'modify_by'     =>0,
    'modify_date'   =>'0000-00-00 00:00:00'    
    );
    $this->Commonmodel->Insert_record('saimtech_destination_rate', $data);
    } else {
    $dest_cities_data=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'mixture', $destination[$i]);
    if(!empty($dest_cities_data)){
    foreach($dest_cities_data as $rows){
    $check = $this->Commonmodel->five_double_check('saimtech_destination_rate', 'service_id', $service_type, 'customer_id', $customer_id, 'dest_city_id', $rows->city_id, 'origin_city_id', $origin, 'is_enable', 1);
    if($check>0){
    $data =array(
    'is_enable'    =>0,
    'modify_by'    =>$_SESSION['user_id'],
    'modify_date'  =>date('Y-m-d H:i:s')
    );
    $this->Commonmodel->Update_Five_record('saimtech_destination_rate', 'service_id', $service_type, 'customer_id', $customer_id, 'dest_city_id', $rows->city_id, 'origin_city_id', $origin, 'is_enable', 1, $data);    
    }    
    $data =array(
    'customer_id'   =>$customer_id,
    'service_id'    =>$service_type,
    'origin_city_id'=>$origin,
    'dest_city_id'  =>$rows->city_id,
    'city_wgt1'     =>$wgt1,
    'city_rate1'    =>$rate1,
    'city_wgt2'     =>$wgt2,
    'city_rate2'    =>$rate2,
    'city_add_wgt'  =>$addwgt,
    'city_add_rate' =>$addrate,
    'city_gst'      =>$gst,
    'is_enable'     =>1,
    'created_by'    =>$_SESSION['user_id'],
    'created_date'  =>date('Y-m-d H:i:s'),
    'modify_by'     =>0,
    'modify_date'   =>'0000-00-00 00:00:00'    
    );
    $this->Commonmodel->Insert_record('saimtech_destination_rate', $data);
    }}
    }
    }

    $this->redraw_table_destination_wise($customer_id,$service_type);
    }
    }
    
    public function redraw_table_destination_wise($customer_id,$service_type){
    $destination_data=$this->Commonmodel->Get_Destination_Wise_Rate($customer_id,$service_type);
    if(!empty($destination_data)){
    foreach($destination_data as $rows){
    echo("<tr>");
    echo("<td>".$rows->Service."</td>");
    echo("<td>".$rows->Origin."</td>");
    echo("<td>".$rows->Destination."</td>");
    echo("<td>".$rows->city_wgt1."</td>");
    echo("<td>".$rows->city_rate1."</td>");
    echo("<td>".$rows->city_wgt2."</td>");
    echo("<td>".$rows->city_rate2."</td>");
    echo("<td>".$rows->city_add_wgt."</td>");
    echo("<td>".$rows->city_add_rate."</td>");
    echo("<td>".$rows->city_gst."</td>");
    if($rows->wenable==1){
    echo("<td class='bg-success text-white'>Active</td>");
    } else {
    echo("<td class='bg-danger text-white'>Blocked</td>");
    }
    echo("</tr>");
    }    
    }
    }

    public function update_status_customer($customerid,$status){
    $this->db->trans_start();	    
    if($customerid!="" && $status!=""){
    $narration="Profile Suspended";
    if($status==1){$narration="Reactive Customer Profile";}
    $data =array(
    'is_enable'                 => $status,
    'modify_by'                 => $_SESSION['user_id'],
	'modify_date'               => date('Y-m-d H:i:s ')
	);	
	
	$this->Commonmodel->Update_record('saimtech_customer', 'customer_id', $customerid, $data);    
    //print_r($data);
    $data =array(
    'customer_id'      => $customerid,
    'narration'        => $narration,
    'user_id'          => $_SESSION['user_id']
    );
    $this->Commonmodel->Insert_record('saimtech_customer_log', $data);
    //print_r($data);
    $this->db->trans_complete();    
    } 
    redirect('customer');
    }
	
}
