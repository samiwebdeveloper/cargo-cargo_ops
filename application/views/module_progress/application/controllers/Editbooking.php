<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Editbooking extends CI_Controller {

	function __construct() {
    parent::__construct();
     date_default_timezone_set('Asia/Karachi');
    $this->load->model('Commonmodel');
    $this->load->model('Bookingmodel');
    $this->load->model('Pickmodel');
    }

    
    public function index($order_id){
	$cid=$_SESSION['customer_id'];
	$shipment_data=$this->Commonmodel->Get_record_by_double_condition_array('saimtech_order', 'order_id', $order_id, 'order_status', 'Order');
	if(!empty($shipment_data)){
	$data['shipment_data']=$shipment_data;
	$data['shipment_types']=$this->Commonmodel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
	$data['pick_up_point']=$this->Bookingmodel->Get_Active_Pickup_Points_By_Customer_id($cid);
	$data['cities_data']=$this->Bookingmodel->Get_Active_Cities();
	$this->load->view('module_booking/editsingleView',$data);}
	else {
	echo("<center><p class='alert alert-danger'>This shipment is not eligible for updatation.</p></center>");    
	}
	}
    
    
    
	public function after(){
	$cid=$_SESSION['customer_id'];
	$data['order_data']=$this->Bookingmodel->Get_After_Orders_By_CID($cid);
	$this->load->view('module_report/afterView',$data);
	}
	
	public function after_edit($order_id){
	$cid=$_SESSION['customer_id'];
	$shipment_data=$this->Bookingmodel->Get_After_Orders_By_Order_ID($order_id);
	if(!empty($shipment_data)){
	$data['shipment_data']=$shipment_data;
	$data['shipment_types']=$this->Commonmodel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
	$data['pick_up_point']=$this->Bookingmodel->Get_Active_Pickup_Points_By_Customer_id($cid);
	$data['cities_data']=$this->Bookingmodel->Get_Active_Cities();
	$this->load->view('module_booking/aftereditsingleView',$data);
	} else {
	echo("<center><p class='alert alert-danger'>This shipment is not eligible for updatation.</p></center>");    
	}
	} 
	
		public function cancel_cn($order_id){
	$ip 	  = $_SERVER['REMOTE_ADDR'];
	if($order_id!=""){
	$data = array(
	'order_status'		=> 'Cancelled',
	'modify_by'			=>	$_SESSION['customer_id'],
	'modify_date'		=>	date('Y-m-d H:i:s')	
	);	
	$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);	
	$this->insert_tracking_detail($order_id,'Cancelled',$_SESSION['origin_id'],$_SESSION['origin_name'],'Your order has been Cancelled',date('Y-m-d H:i:s'),$ip,$_SESSION['customer_id'],date('Y-m-d H:i:s'));
	}	
	redirect('module_report/afterView');	
	}

	public function edit_shipment(){
	//==============Get Values From Booking Form=================		
	$message			 = "";
	$cash_limit 		 = 100000000;					
	$order_id            = $this->input->post('order_id');
	$ship_type           = $this->input->post('shipment_type');
	$o_date              = $this->input->post('order_date');
	$o_piece             = $this->input->post('order_piece');
	$o_weight            = $this->input->post('order_weight');
	$cod              	 = $this->input->post('cod_amount');
	$c_ref_no   		 = $this->input->post('customer_reference_no');
	$pick_point          = $this->input->post('pick_point');
	$re_ship     		 = $this->input->post('return_shipment');	
	$c_name              = $this->input->post('c_name');
	$c_phone             = $this->input->post('c_phone');
	$c_email             = $this->input->post('c_email');
	$d_city              = $this->input->post('d_city');
	$c_address           = $this->input->post('c_address');
	$remark              = $this->input->post('remark');
	$sp_handling         = $this->input->post('sp_handling');
	$product_detail		 = $this->input->post('product_detail');
	$d_city_name 		 = "";
	$d_city_zone 		 = "";
	$o_city 		 	 = "";
	$o_city_name 		 = "";
	$o_city_zone 		 = "";
	$rate_type 			 = "";
	$order_rate 		 = "";
	$order_add_rate 	 = "";
	$order_gst 	 		 = "";
	$order_fuel 	 	 = "";
	$order_handling 	 = "";
	$order_cash_handling = "";
	$rate_id             = "";
	$d_city_reporting    = "";
	$o_city_reporting    = "";
	$first_char_customer =substr($c_ref_no, 0, 1);
	$first_char_phone    =substr($c_phone, 0, 1);
	if($first_char_customer!="#"){
	$c_ref_no   		 = "#".$c_ref_no;    
	}
	if($first_char_phone !=0){
	$c_phone   		     = "0".$c_phone;    
	}
	//=========================================================END
	//==============Missing Main Attribute Coditions===============
	if($ship_type !="" && $o_date!="" && $o_piece!="" && $o_weight!=""  &&
	   $cod!="" && $pick_point!="" && $re_ship!="" && $c_name!="" && $c_phone!="" && $c_email!=""
	   && $d_city!="" && $c_address!="" && $remark!="" && $sp_handling!=""  && $product_detail!=""){
	$this->db->trans_start();
	//==============Get Destination City ID & Name================
	$dest=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'city_id', $d_city);
	if(!empty($dest)){foreach($dest as $rows){
	$d_city_name=$rows->city_name;
	$d_city_zone=$rows->city_zone;
	$d_city_code=$rows->city_code;
	$d_city_reporting=$rows->reporting_city;
	}}
	//=========================================================END
	$origin=$this->Commonmodel->Get_Pickup_Points_By_pickup_id($pick_point);
	$o_city=$origin[0]['city_id'];	
	$o_city_name=$origin[0]['city_name'];
	$o_city_code=$origin[0]['city_code'];
	$o_city_zone=$origin[0]['city_zone'];
	$o_city_reporting=$origin[0]['reporting_city'];
	//==============Get Origin City ID & Name=====================	
	//=========================================================END

	//==============Get Rate Type and Rate Detail=================	
	if($d_city==3 || $d_city==4){$d_city=4;}
	if($o_city==3 || $o_city==4){$o_city=4;}
	if($o_city_zone==$d_city_zone && $o_city==$d_city){ $rate_type="WC";}
	else if($o_city_zone==$d_city_zone && $o_city!=$d_city){ $rate_type="SZ";}
	else if($o_city_zone!=$d_city_zone){$rate_type="DZ"; }
	else {$rate_type="UK";}
	
	$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_rate', 'customer_id', $_SESSION['customer_id'], 'service_id', $ship_type, 'is_enable', 1);
	//=WC============With in CITY
	$sc_wgt1=$rate_detail[0]['sc_wgt1'];
	$sc_rate1=$rate_detail[0]['sc_rate1']; 
	$sc_wgt2=$rate_detail[0]['sc_wgt2']; 
	$sc_rate2=$rate_detail[0]['sc_rate2']; 
	$sc_add_wgt=$rate_detail[0]['sc_add_wgt'];
	$sc_add_rate=$rate_detail[0]['sc_add_rate'];
	$sc_gst_rate=$rate_detail[0]['sc_gst_rate'];
	$sc_fuel_formula=$rate_detail[0]['sc_fuel_formula'];
	$sc_fuel_rate=$rate_detail[0]['sc_fuel_rate']; 
	$sc_sp_handling_formula=$rate_detail[0]['sc_sp_handling_formula']; 
	$sc_sp_handling_rate=$rate_detail[0]['sc_sp_handling_rate'];
	//=END============With in CITY
	//=SZ============Same Zone
	$sz_wgt1=$rate_detail[0]['sz_wgt1'];
	$sz_rate1=$rate_detail[0]['sz_rate1']; 
	$sz_wgt2=$rate_detail[0]['sz_wgt2']; 
	$sz_rate2=$rate_detail[0]['sz_rate2'];
	$sz_add_wgt=$rate_detail[0]['sz_add_wgt']; 
	$sz_add_rate=$rate_detail[0]['sz_add_rate']; 
	$sz_gst_rate=$rate_detail[0]['sz_gst_rate']; 
	$sz_fuel_formula=$rate_detail[0]['sz_fuel_formula']; 
	$sz_fuel_rate=$rate_detail[0]['sz_fuel_rate']; 
	$sz_sp_handling_formula=$rate_detail[0]['sz_sp_handling_formula']; 
	$sz_sp_handling_rate=$rate_detail[0]['sz_sp_handling_rate']; 
	//=END============Same Zone
	//=DZ============Different Zone
	$dz_wgt1=$rate_detail[0]['dz_wgt1']; 
	$dz_rate1=$rate_detail[0]['dz_rate1']; 
	$dz_wgt2=$rate_detail[0]['dz_wgt2']; 
	$dz_rate2=$rate_detail[0]['dz_rate2'];
	$dz_add_wgt=$rate_detail[0]['dz_add_wgt']; 
	$dz_add_rate=$rate_detail[0]['dz_add_rate'];
	$dz_fuel_formula=$rate_detail[0]['dz_fuel_formula'];
	$dz_fuel_rate=$rate_detail[0]['dz_fuel_rate'];
	$dz_sp_handling_formula=$rate_detail[0]['dz_sp_handling_formula'];
	$dz_sp_handling_rate=$rate_detail[0]['dz_sp_handling_rate'];
	$dz_gst_rate=$rate_detail[0]['dz_gst_rate']; 
	//=END============Different Zone
	$cash_handling_formula=$rate_detail[0]['cash_handling_formula']; 
	$cash_handling_rate=$rate_detail[0]['cash_handling_rate'];
	$flyer_rate=$rate_detail[0]['flyer_rate']; 
    $rate_id=$rate_detail[0]['rate_id']; 
	//================Calculate Rate
	if($rate_type=="WC"){
	$calcu=$this->calculate_rate($o_weight,$sc_wgt1, $sc_rate1, $sc_wgt2, $sc_rate2, $sc_add_wgt, $sc_add_rate, $sc_gst_rate, $sc_fuel_formula, $sc_fuel_rate, $sc_sp_handling_formula, $sc_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					=$sc_rate1;
	$order_add_rate 				=$sc_add_rate;
	$order_gst 						=$calcu->my_gst;
	$order_sc 						=$calcu->my_amount;
	$order_sp_handling_rate 		=$calcu->my_handling;
	$order_cash_handling_rate 		=$calcu->my_cash_handling;
	$order_fuel 					=$calcu->my_fuel;
	$order_flyer_rate 				=$flyer_rate;
	$order_total_amount_with_flyer 	=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));
	} else if($rate_type=="SZ"){
	$calcu=$this->calculate_rate($o_weight,$sz_wgt1, $sz_rate1, $sz_wgt2, $sz_rate2, $sz_add_wgt, $sz_add_rate, $sz_gst_rate, $sz_fuel_formula, $sz_fuel_rate, $sz_sp_handling_formula, $sz_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					=$sz_rate1;
	$order_add_rate 				=$sz_add_wgt;
	$order_gst 						=$calcu->my_gst;
	$order_sc 						=$calcu->my_amount;
	$order_sp_handling_rate 		=$calcu->my_handling;
	$order_cash_handling_rate 		=$calcu->my_cash_handling;
	$order_fuel 					=$calcu->my_fuel;
	$order_flyer_rate 				=$flyer_rate;
	$order_total_amount_with_flyer 	=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));

	} else if($rate_type=="DZ"){
	$calcu=$this->calculate_rate($o_weight,$dz_wgt1, $dz_rate1, $dz_wgt2, $dz_rate2, $dz_add_wgt, $dz_add_rate, $dz_gst_rate, $dz_fuel_formula, $dz_fuel_rate, $dz_sp_handling_formula, $dz_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					= $dz_rate1;
	$order_add_rate 				= $dz_add_wgt;
	$order_gst 						= $calcu->my_gst;
	$order_sc 						= $calcu->my_amount;
	$order_sp_handling_rate 		= $calcu->my_handling;
	$order_cash_handling_rate 		= $calcu->my_cash_handling;
	$order_fuel 					= $calcu->my_fuel;
	$order_flyer_rate 				= $flyer_rate;
	$order_total_amount_with_flyer 	= (($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			= (($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));

	}
	//=END============Calculate Rate
	//$order_code=$this->get_order_code($o_city_code);
	$ip= $_SERVER['REMOTE_ADDR'];
	//$this->set_barcode($order_code);
	//=========================================================END	
	$data = array(
	'cod_amount'					=> 	$cod,
	'customer_reference_no'			=> 	$c_ref_no,
	'destination_city'				=> 	$d_city,
	'destination_city_name'			=> 	$d_city_name,
	'origin_city'					=> 	$o_city,
	'origin_city_name'				=> 	$o_city_name,
	'pickup_point_id'				=>	$pick_point,
	'order_rate_type'				=> 	$rate_type,
	'order_service_type'			=> 	$ship_type,
	'order_receive_from'			=> 	'PSB',
	'weight'						=>	$o_weight,
	'pieces'						=>	$o_piece,
	'consignee_name'				=>	$c_name,
	'consignee_email'				=>	$c_email,
	'consignee_address'				=>	$c_address,
	'consignee_mobile'				=>	$c_phone,
	'product_detail'				=>	$product_detail,
	'order_remark'					=>	$remark,
	'order_rate'					=>	$order_rate,
	'order_add_rate'				=>	$order_add_rate,
	'order_gst'						=>	$order_gst,
	'order_sc'						=>	$order_sc,
	'order_sp_handling_rate'		=>	$order_sp_handling_rate,
	'order_cash_handling_rate'		=>  $order_cash_handling_rate,
	'order_fuel'					=>	$order_fuel,
	'order_flyer_rate'				=>	$order_flyer_rate,
	'order_total_amount_with_flyer' =>  $order_total_amount_with_flyer,
	'order_total_amount'            =>  $order_total_amount, 
	'pickup_rider_id'				=>	'0',
	'delivery_rider_id'				=>	'0',
	'order_cr'						=>	'N',
	'order_receive_amount'			=> 	'0',
	'origin_reporting'              =>  $o_city_reporting,
	'destination_reporting'         =>  $d_city_reporting, 
	'rate_id'						=>	$rate_id,
	'modify_by'                     =>  $_SESSION['user_id'],
    'modify_date'                     =>  date('Y-m-d H:i:s'),
	);
	
    $effective_rows=$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);
	if($effective_rows>0){
	$message="<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong>Updated !</strong> Successfully update changes.</div></div>";    
	}
	$this->db->trans_complete();
	
	} 
	else {$message = "<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong>Missing Error !</strong> Something is missing please try again.</div></div>";	}
	//=========================================================END
	echo $message;	
	}
	
	
	public function after_edit_shipment(){
	//==============Get Values From Booking Form=================		
	$message			 = "";
	$cash_limit 		 = 100000000;					
	$order_id            = $this->input->post('order_id');
	$ship_type           = $this->input->post('shipment_type');
	$o_date              = $this->input->post('order_date');
	$o_piece             = $this->input->post('order_piece');
	$o_weight            = $this->input->post('order_weight');
	$cod              	 = $this->input->post('cod_amount');
	$c_ref_no   		 = $this->input->post('customer_reference_no');
	$pick_point          = $this->input->post('pick_point');
	$re_ship     		 = $this->input->post('return_shipment');	
	$c_name              = $this->input->post('c_name');
	$c_phone             = $this->input->post('c_phone');
	$c_email             = $this->input->post('c_email');
	$d_city              = $this->input->post('d_city');
	$c_address           = $this->input->post('c_address');
	$remark              = $this->input->post('remark');
	$sp_handling         = $this->input->post('sp_handling');
	$product_detail		 = $this->input->post('product_detail');
	$d_city_name 		 = "";
	$d_city_zone 		 = "";
	$o_city 		 	 = "";
	$o_city_name 		 = "";
	$o_city_zone 		 = "";
	$rate_type 			 = "";
	$order_rate 		 = "";
	$order_add_rate 	 = "";
	$order_gst 	 		 = "";
	$order_fuel 	 	 = "";
	$order_handling 	 = "";
	$order_cash_handling = "";
	$rate_id             = "";
	$d_city_reporting    = "";
	$o_city_reporting    = "";
	$first_char_customer =substr($c_ref_no, 0, 1);
	$first_char_phone    =substr($c_phone, 0, 1);
	if($first_char_customer!="#"){
	$c_ref_no   		 = "#".$c_ref_no;    
	}
	if($first_char_phone !=0){
	$c_phone   		     = "0".$c_phone;    
	}
	//=========================================================END
	//==============Missing Main Attribute Coditions===============
	if($ship_type !="" && $o_date!="" && $o_piece!="" && $o_weight!=""  &&
	   $cod!="" && $pick_point!="" && $re_ship!="" && $c_name!="" && $c_phone!="" && $c_email!=""
	   && $d_city!="" && $c_address!="" && $remark!="" && $sp_handling!=""  && $product_detail!=""){
	$this->db->trans_start();
	//==============Get Destination City ID & Name================
	$dest=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'city_id', $d_city);
	if(!empty($dest)){foreach($dest as $rows){
	$d_city_name=$rows->city_name;
	$d_city_zone=$rows->city_zone;
	$d_city_code=$rows->city_code;
	$d_city_reporting=$rows->reporting_city;
	}}
	//=========================================================END
	$origin=$this->Commonmodel->Get_Pickup_Points_By_pickup_id($pick_point);
	$o_city=$origin[0]['city_id'];	
	$o_city_name=$origin[0]['city_name'];
	$o_city_code=$origin[0]['city_code'];
	$o_city_zone=$origin[0]['city_zone'];
	$o_city_reporting=$origin[0]['reporting_city'];
	//==============Get Origin City ID & Name=====================	
	//=========================================================END

	//==============Get Rate Type and Rate Detail=================	
	if($d_city==3 || $d_city==4){$d_city=4;}
	if($o_city==3 || $o_city==4){$o_city=4;}
	if($o_city_zone==$d_city_zone && $o_city==$d_city){ $rate_type="WC";}
	else if($o_city_zone==$d_city_zone && $o_city!=$d_city){ $rate_type="SZ";}
	else if($o_city_zone!=$d_city_zone){$rate_type="DZ"; }
	else {$rate_type="UK";}
	
	$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_rate', 'customer_id', $_SESSION['customer_id'], 'service_id', $ship_type, 'is_enable', 1);
	//=WC============With in CITY
	$sc_wgt1=$rate_detail[0]['sc_wgt1'];
	$sc_rate1=$rate_detail[0]['sc_rate1']; 
	$sc_wgt2=$rate_detail[0]['sc_wgt2']; 
	$sc_rate2=$rate_detail[0]['sc_rate2']; 
	$sc_add_wgt=$rate_detail[0]['sc_add_wgt'];
	$sc_add_rate=$rate_detail[0]['sc_add_rate'];
	$sc_gst_rate=$rate_detail[0]['sc_gst_rate'];
	$sc_fuel_formula=$rate_detail[0]['sc_fuel_formula'];
	$sc_fuel_rate=$rate_detail[0]['sc_fuel_rate']; 
	$sc_sp_handling_formula=$rate_detail[0]['sc_sp_handling_formula']; 
	$sc_sp_handling_rate=$rate_detail[0]['sc_sp_handling_rate'];
	//=END============With in CITY
	//=SZ============Same Zone
	$sz_wgt1=$rate_detail[0]['sz_wgt1'];
	$sz_rate1=$rate_detail[0]['sz_rate1']; 
	$sz_wgt2=$rate_detail[0]['sz_wgt2']; 
	$sz_rate2=$rate_detail[0]['sz_rate2'];
	$sz_add_wgt=$rate_detail[0]['sz_add_wgt']; 
	$sz_add_rate=$rate_detail[0]['sz_add_rate']; 
	$sz_gst_rate=$rate_detail[0]['sz_gst_rate']; 
	$sz_fuel_formula=$rate_detail[0]['sz_fuel_formula']; 
	$sz_fuel_rate=$rate_detail[0]['sz_fuel_rate']; 
	$sz_sp_handling_formula=$rate_detail[0]['sz_sp_handling_formula']; 
	$sz_sp_handling_rate=$rate_detail[0]['sz_sp_handling_rate']; 
	//=END============Same Zone
	//=DZ============Different Zone
	$dz_wgt1=$rate_detail[0]['dz_wgt1']; 
	$dz_rate1=$rate_detail[0]['dz_rate1']; 
	$dz_wgt2=$rate_detail[0]['dz_wgt2']; 
	$dz_rate2=$rate_detail[0]['dz_rate2'];
	$dz_add_wgt=$rate_detail[0]['dz_add_wgt']; 
	$dz_add_rate=$rate_detail[0]['dz_add_rate'];
	$dz_fuel_formula=$rate_detail[0]['dz_fuel_formula'];
	$dz_fuel_rate=$rate_detail[0]['dz_fuel_rate'];
	$dz_sp_handling_formula=$rate_detail[0]['dz_sp_handling_formula'];
	$dz_sp_handling_rate=$rate_detail[0]['dz_sp_handling_rate'];
	$dz_gst_rate=$rate_detail[0]['dz_gst_rate']; 
	//=END============Different Zone
	$cash_handling_formula=$rate_detail[0]['cash_handling_formula']; 
	$cash_handling_rate=$rate_detail[0]['cash_handling_rate'];
	$flyer_rate=$rate_detail[0]['flyer_rate']; 
    $rate_id=$rate_detail[0]['rate_id']; 
	//================Calculate Rate
	if($rate_type=="WC"){
	$calcu=$this->calculate_rate($o_weight,$sc_wgt1, $sc_rate1, $sc_wgt2, $sc_rate2, $sc_add_wgt, $sc_add_rate, $sc_gst_rate, $sc_fuel_formula, $sc_fuel_rate, $sc_sp_handling_formula, $sc_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					=$sc_rate1;
	$order_add_rate 				=$sc_add_rate;
	$order_gst 						=$calcu->my_gst;
	$order_sc 						=$calcu->my_amount;
	$order_sp_handling_rate 		=$calcu->my_handling;
	$order_cash_handling_rate 		=$calcu->my_cash_handling;
	$order_fuel 					=$calcu->my_fuel;
	$order_flyer_rate 				=$flyer_rate;
	$order_total_amount_with_flyer 	=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));
	} else if($rate_type=="SZ"){
	$calcu=$this->calculate_rate($o_weight,$sz_wgt1, $sz_rate1, $sz_wgt2, $sz_rate2, $sz_add_wgt, $sz_add_rate, $sz_gst_rate, $sz_fuel_formula, $sz_fuel_rate, $sz_sp_handling_formula, $sz_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					=$sz_rate1;
	$order_add_rate 				=$sz_add_wgt;
	$order_gst 						=$calcu->my_gst;
	$order_sc 						=$calcu->my_amount;
	$order_sp_handling_rate 		=$calcu->my_handling;
	$order_cash_handling_rate 		=$calcu->my_cash_handling;
	$order_fuel 					=$calcu->my_fuel;
	$order_flyer_rate 				=$flyer_rate;
	$order_total_amount_with_flyer 	=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			=(($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));

	} else if($rate_type=="DZ"){
	$calcu=$this->calculate_rate($o_weight,$dz_wgt1, $dz_rate1, $dz_wgt2, $dz_rate2, $dz_add_wgt, $dz_add_rate, $dz_gst_rate, $dz_fuel_formula, $dz_fuel_rate, $dz_sp_handling_formula, $dz_sp_handling_rate, $cash_handling_formula, $cash_handling_rate, $cash_limit, $cod);
	$calcu=json_decode($calcu);
	
	$order_rate 					= $dz_rate1;
	$order_add_rate 				= $dz_add_wgt;
	$order_gst 						= $calcu->my_gst;
	$order_sc 						= $calcu->my_amount;
	$order_sp_handling_rate 		= $calcu->my_handling;
	$order_cash_handling_rate 		= $calcu->my_cash_handling;
	$order_fuel 					= $calcu->my_fuel;
	$order_flyer_rate 				= $flyer_rate;
	$order_total_amount_with_flyer 	= (($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel) + ($order_flyer_rate));
	$order_total_amount 			= (($order_gst) + ($order_sc) + ($order_sp_handling_rate) + ($order_cash_handling_rate) + ($order_fuel));

	}
	//=END============Calculate Rate
	//$order_code=$this->get_order_code($o_city_code);
	$ip= $_SERVER['REMOTE_ADDR'];
	//$this->set_barcode($order_code);
	//=========================================================END	
	$data = array(
	'cod_amount'					=> 	$cod,
	'customer_reference_no'			=> 	$c_ref_no,
	'destination_city'				=> 	$d_city,
	'destination_city_name'			=> 	$d_city_name,
	'origin_city'					=> 	$o_city,
	'origin_city_name'				=> 	$o_city_name,
	'pickup_point_id'				=>	$pick_point,
	'order_rate_type'				=> 	$rate_type,
	'order_service_type'			=> 	$ship_type,
	'order_receive_from'			=> 	'PSB',
	'weight'						=>	$o_weight,
	'pieces'						=>	$o_piece,
	'consignee_name'				=>	$c_name,
	'consignee_email'				=>	$c_email,
	'consignee_address'				=>	$c_address,
	'consignee_mobile'				=>	$c_phone,
	'product_detail'				=>	$product_detail,
	'order_remark'					=>	$remark,
	'order_rate'					=>	$order_rate,
	'order_add_rate'				=>	$order_add_rate,
	'order_gst'						=>	$order_gst,
	'order_sc'						=>	$order_sc,
	'order_sp_handling_rate'		=>	$order_sp_handling_rate,
	'order_cash_handling_rate'		=>  $order_cash_handling_rate,
	'order_fuel'					=>	$order_fuel,
	'order_flyer_rate'				=>	$order_flyer_rate,
	'order_total_amount_with_flyer' =>  $order_total_amount_with_flyer,
	'order_total_amount'            =>  $order_total_amount, 
	'order_cr'						=>	'N',
	'order_receive_amount'			=> 	'0',
	'origin_reporting'              =>  $o_city_reporting,
	'destination_reporting'         =>  $d_city_reporting, 
	'rate_id'						=>	$rate_id,
	'modify_by'                     =>  $_SESSION['user_id'],
    'modify_date'                     =>  date('Y-m-d H:i:s'),
	);
	
    $effective_rows=$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);
	if($effective_rows>0){
	$message="<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong>Updated !</strong> Successfully update changes.</div></div>";    
	}
	$this->db->trans_complete();
	
	} 
	else {$message = "<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong>Missing Error !</strong> Something is missing please try again.</div></div>";	}
	//=========================================================END
	echo $message;	
	}
	
	
	
	
	
	
	public function calculate_rate($wgt,$wgt1, $rate1, $wgt2, $rate2, $add_wgt, $add_rate, $gst, $fuel_formula, $fuel_rate, $sp_formula, $sp_rate, $cash_handling_rate, $cash_handling_formula, $cash_limit, $cod){
		//-----Initiate Varibles
		$my_amount=0;
		$my_wht=0;
		$f_wht=0;
		$total_wht=0;
		$my_gst=0;
		$my_fuel=0;
		$my_handling=0;
		$my_cash_handling=0;
		$sum=0;
		//---------------------
		$f_weight=0;
		$my_additional_rate=0;
		//------Order Weight Under Weight1
		if($wgt <= $wgt1){
		$my_amount	 = $rate1;}
		//END---Order Weight Under Weight1
        //------Order Weight Under Weight2
        else if($wgt <= $wgt2){
		$my_amount 	 =  $rate2; }
		//END---Order Weight Under Weight2
		//------Order Weight Above Weight2 (Additonal Rate)
        else if($wgt > $add_wgt){
		$my_wht 	 = $wgt - $wgt2;
		$f_wht 		 = ceil($my_wht) /  $add_wgt;
		$total_wht 	 =  $add_rate * $f_wht;
        $my_amount 	 = $rate2 + $total_wht; }
        //END---Order Weight Above Weight2 (Additonal Rate)	
        //------Fuel Calculation 
        if($fuel_formula=="PER"){
        $my_fuel=round(((($my_amount)*($fuel_rate))/100),2);} 
        else if($fuel_formula=="FIX"){
        $my_fuel=$fuel_rate;}
        //END---Fuel Calculation 
        //------Sp Handling Calculation 
        if($sp_formula=="PER"){
        $my_handling=round(((($my_amount)*($sp_rate))/100),2);} 
        else if($sp_formula=="FIX"){
        $my_handling=$sp_rate;}
        //END---Sp Handling Calculation 
        //------Cash Handling Calculation 
        if($cash_limit>=$cod){
        if($cash_handling_formula=="PER"){	
        $my_cash_handling=round(((($my_amount)*($cash_handling_rate))/100),2);} 
        else if($cash_handling_formula=="FIX"){
        $my_cash_handling=$cash_handling_rate;}} 
        else { $my_cash_handling=0;}
        //END---Cash Handling Calculation 
         //------GST Calculation 
        $sum=(($my_amount)+($my_cash_handling)+($my_fuel)+($my_handling));
        $my_gst=round(((($sum)*($gst))/100),2);
        //END---GST Calculation
        $arr= array(
        'my_amount'			=> $my_amount,
		'my_wht'			=> $my_wht,
		'f_wht'				=> $f_wht,
		'total_wht'			=> $total_wht,
		'my_gst'			=> $my_gst,
		'my_fuel'			=> $my_fuel,
		'my_handling'		=> $my_handling,
		'my_cash_handling'	=> $my_cash_handling);
        return json_encode($arr);

	}
	

	
	
	


	
	
	
	

	

	




	
}