<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Web extends CI_Controller {

	function __construct() {
    parent::__construct();
    date_default_timezone_set('Asia/Karachi');
    $this->load->model('Commonmodel');
    $this->load->model('Bookingmodel');
    $this->load->model('Pickmodel');
    }



	public function api_json(){
	$data=file_get_contents('php://input');
    $mdata=json_decode($data);  
    $customer_detail=$this->Bookingmodel->Get_customer_by_api_key($mdata->api_key);
    if(!empty($customer_detail)){
	//==============Get Values From Booking Form=================		
	$message			 = "";
	$error               = 0;
	$order_code_new      = "";
	$cash_limit 		 = $customer_detail[0]['handling_limit'];					
	$ship_type           = $mdata->shipment_type;
	$o_date              = date('Y-m-d H:i:s');
	$o_piece             = $mdata->order_piece;
	$o_weight            = $mdata->order_weight;
    $cod              	 = $mdata->cod_amount;
    $c_ref_no   		 = $mdata->customer_reference_no;
    $pick_point          = $mdata->pick_point;
    $re_ship     		 = 'No';	
    $c_name              = $mdata->c_name;
    $c_phone             = $mdata->c_phone;
    if($mdata->c_email!=""){
    $c_email             = $mdata->c_email;
    } else {
    $c_email             = "test@test.com";   
    }
    $d_city              = $mdata->d_city;
    $c_address           = $mdata->c_address;
    $remark              = $mdata->remark;
    $sp_handling         = $mdata->sp_handling;
    $product_detail		 = $mdata->product_detail;
    $payment_mode		 = $mdata->payment_mode;
    $packing_type		 = $mdata->packing_type;
    $customer_id 		 = $customer_detail[0]['customer_id'];
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
	//=========================================================END
	//==============Missing Main Attribute Coditions===============
	if($ship_type !="" && $o_date!="" && $o_piece!="" && $o_weight!=""   && $pick_point!="" && $re_ship!="" && $c_name!="" && $c_phone!="" && $c_email!=""
	   && $d_city!="" && $c_address!=""  && $sp_handling!="" && $customer_id!="" && $product_detail!=""){
	$this->db->trans_start();
	//==============Get Destination City ID & Name================
	$dest=$this->Commonmodel->Get_record_by_condition('saimtech_city', 'city_id', $d_city);
	if(!empty($dest)){foreach($dest as $rows){
	$d_city_name=$rows->city_name;
	$d_city_zone=$rows->city_zone;
	$d_city_code=$rows->city_code;
	$d_city_id=$rows->city_id;
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
	if($d_city_id==3 || $d_city_id==4){$d_city_id=4;}
	if($o_city==3 || $o_city==4){$o_city=4;}
	if($o_city_zone==$d_city_zone && $o_city==$d_city){ $rate_type="WC";}
	else if($o_city_zone==$d_city_zone && $o_city!=$d_city){ $rate_type="SZ";}
	else if($o_city_zone!=$d_city_zone){$rate_type="DZ"; }
	else {$rate_type="UK";}
	
	/*$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_rate', 'customer_id', $customer_id, 'service_id', $ship_type, 'is_enable', 1);
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

	} */
	//=END============Calculate Rate
	$order_rate 					= 0;
	$order_add_rate 				= 0;
	$order_gst 						= 0;
	$order_sc 						= 0;
	$order_sp_handling_rate 		= 0;
	$order_cash_handling_rate 		= 0;
	$order_fuel 					= 0;
	$order_flyer_rate 				= 0;
	$order_total_amount_with_flyer 	= 0;
	$order_total_amount 			= 0;

	$order_code=$this->get_order_code($o_city_code);
	$ip= $_SERVER['REMOTE_ADDR'];
	//=========================================================END	
	$data = array(
	'customer_id'					=> 	$customer_id,
	'cod_amount'					=> 	$cod,
	'order_date'					=> 	$o_date,
	'order_code'					=> 	$order_code,
	'customer_reference_no'			=> 	$c_ref_no,
	'order_booking_date'			=> 	'0000-00-00 00:00:00',
	'order_arrival_date'			=> 	'0000-00-00 00:00:00',
	'order_deliver_date'			=> 	'0000-00-00 00:00:00',
	'order_rr_date'					=> 	'0000-00-00 00:00:00',
	'order_cr_date'					=> 	'0000-00-00 00:00:00',
	'order_status'					=> 	'Order',
	'destination_city'				=> 	$d_city_id,
	'destination_city_name'			=> 	$d_city_name,
	'origin_city'					=> 	$o_city,
	'origin_city_name'				=> 	$o_city_name,
	'pickup_point_id'				=>	$pick_point,
	'order_rate_type'				=> 	$rate_type,
	'order_service_type'			=> 	$ship_type,
	'order_receive_from'			=> 	'WAB',
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
	'order_pay_mode'                =>  $payment_mode,
	'order_packing_type'            =>  $packing_type,
	'pickup_rider_id'				=>	'0',
	'delivery_rider_id'				=>	'0',
	'order_cr'						=>	'N',
	'order_receive_amount'			=> 	'0',
	'origin_reporting'              =>  $o_city_reporting,
	'destination_reporting'         =>  $d_city_reporting,
	'rate_id'						=>	$o_piece,
	'created_by'					=>	$customer_id,
	'created_date'					=>	date('Y-m-d H:i:s')
	);
	
	$insert_id=$this->Commonmodel->Insert_record('saimtech_order', $data);
	// Unique ID Finding SaimTech Ultra Plugin V 09.8 Activated============
	$new_code=$this->get_api_order_code($insert_id);
	$data = array('order_code' => $new_code);	
	$this->Commonmodel->Update_record('saimtech_order', 'order_id', $insert_id, $data);	
	$order_code_new=$new_code;
    $this->set_barcode($new_code);
	// Unique ID Finding SaimTech Ultra Plugin V 09.8 Activated =========END
	$status_msg="Your Order Has Been Generated.";
	$this->insert_tracking_detail($insert_id,'Order',$o_city,$o_city_name,$status_msg,date('Y-m-d H:i:s'),$ip,$customer_id,date('Y-m-d H:i:s'));
	$this->db->trans_complete();
	if($insert_id>0){
	$error=0;    
	$message = 	$order_code_new."Your Shippment is successfully Booked";
	} else { $message = "Something Went Wrong";
	$error=1;   }
	} else { $message = "Missing Error ! Something is missing please try again"; 
	$error=1;	}
	} else {  $message = "Invalid Web Api Key"; 
	$error=1;	}
	//=========================================================END
	 $arr = array(
    'message'    => $message, 
    'order_code' => $order_code_new,
    'error'      => $error,
    );
     echo json_encode($arr);
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
	

	public function get_order_code($city_code){
	$code=$this->Bookingmodel->Get_Last_Order();
	if(strlen($city_code)==2){ $prefix=$city_code."0".date('y');} 
	else if(strlen($city_code)==3){ $prefix=$city_code.date('y');}
	if(strlen($code)==1){ $precode=$prefix."00000".$code;} 
	else if(strlen($code)==2){ $precode=$prefix."0000".$code;} 
	else if(strlen($code)==3){ $precode=$prefix."000".$code;} 
	else if(strlen($code)==4){ $precode=$prefix."00".$code;} 
	else if(strlen($code)==5){ $precode=$prefix."0".$code;} 
	else if(strlen($code)==6){ $precode=$prefix.$code;}
	return $precode;
	}
	
	
	public function get_api_order_code($code){;
	$precode="00000000000";
	if(strlen($code)==1){      $precode=date('y')."00000000".$code;} 
	else if(strlen($code)==2){ $precode=date('y')."0000000".$code;} 
	else if(strlen($code)==3){ $precode=date('y')."000000".$code;} 
	else if(strlen($code)==4){ $precode=date('y')."00000".$code;} 
	else if(strlen($code)==5){ $precode=date('y')."0000".$code;} 
	else if(strlen($code)==6){ $precode=date('y')."000".$code;}
	else if(strlen($code)==7){ $precode=date('y')."00".$code;}
	else if(strlen($code)==8){ $precode=date('y')."0".$code;}
	return $precode;
	}
	
	public function insert_tracking_detail($id,$event,$locationid,$location,$message,$date,$ip,$userid,$cdate){
	$data = array(	
	'order_id' 				=> $id,
	'order_event'			=> $event,	
	'order_location'		=> $locationid,
	'order_location_name'	=> $location,
	'order_message'			=> $message,
	'order_event_date'		=> $date,
	'order_ip'				=> $ip,
	'created_by'			=> $userid,
	'created_date'			=> $cdate
	);
	$insert_id=$this->Commonmodel->Insert_record('saimtech_order_tracking', $data);
	} 

	


	public function set_barcode($code){
    $targetDir = FCPATH."assets/barcode/cn/";
    $this->load->library('zend');
    $this->zend->load('Zend/Barcode');
    $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
    $code = $code;
    $store_image = imagepng($file,$targetDir."/{$code}.png");
    }	


	public function cancel_shipment(){
	$order_id = $this->input->post('id');
	$ip 	  = $_SERVER['REMOTE_ADDR'];
	if($order_id!=""){
	$data = array(
	'order_status'		=> 'Cancelled',
	'modify_by'			=>	$_SESSION['customer_id'],
	'modify_date'		=>	date('Y-m-d H:i:s')	
	);	
	$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);	
	$this->insert_tracking_detail($order_id,'Cancelled',$_SESSION['origin_id'],$_SESSION['origin_name'],'Your shipment has been cancelled by shipper',date('Y-m-d H:i:s'),$ip,$_SESSION['customer_id'],date('Y-m-d H:i:s'));
	}
	$this->redraw_order_table();	
	}
	
	public function tracking($cn){
	$order_detail=$this->Commonmodel->Get_record_by_condition_array('saimtech_order', 'order_code', $cn);
	$order_archive_detail=$this->Commonmodel->Get_record_by_condition_array('saimtech_archive_order', 'order_code', $cn);
	if(!empty($order_detail)){
	$arr = array(
	'Error'             => 0,
	'Message'           => "Record Found",    
    'Order_Code'        => $order_detail[0]['order_code'],
    'Reference_No'      => $order_detail[0]['customer_reference_no'],
    'Order_Status'      => $order_detail[0]['order_status'],
    'Order_Date'        => $order_detail[0]['order_date'],
    'Booking_Date'      => $order_detail[0]['order_booking_date'],
    'Arrival_Date'      => $order_detail[0]['order_arrival_date'],
    'On_Route_Date'     => $order_detail[0]['on_route_date'],
    'Delivery_Date'     => $order_detail[0]['order_deliver_date'],
    'Last_Activity_Date'=> $order_detail[0]['modify_date'],
    'Order_Cod'         => $order_detail[0]['cod_amount'],
    'Order_Origin'      => $order_detail[0]['origin_city_name'],
    'Order_Destination' => $order_detail[0]['destination_city_name'],
    'Consignee_Name'    => $order_detail[0]['consignee_name'],
    'Consignee_Phone'   => $order_detail[0]['consignee_mobile'],
    'Consignee_Email'   => $order_detail[0]['consignee_email'],
    'Consignee_Address' => $order_detail[0]['consignee_address'],
    'Invoice_Code'      => $order_detail[0]['invoice_id'],
    'Product_Detail'    => $order_detail[0]['product_detail'],
    'Order_Remark'      => $order_detail[0]['order_remark']
    );
	} else if(!empty($order_archive_detail)){
	$arr = array(
	'Error'             => 0,    
	'Message'           => "Record Found",        
    'Order_Code'        => $order_archive_detail[0]['order_code'],
    'Reference_No'      => $order_archive_detail[0]['customer_reference_no'],
    'Order_Status'      => $order_archive_detail[0]['order_status'],
    'Order_Date'        => $order_archive_detail[0]['order_date'],
    'Booking_Date'      => $order_archive_detail[0]['order_booking_date'],
    'Arrival_Date'      => $order_archive_detail[0]['order_arrival_date'],
    'On_Route_Date'     => $order_archive_detail[0]['on_route_date'],
    'Delivery_Date'     => $order_archive_detail[0]['order_delivery_date'],
    'Last_Activity_Date'=> $order_detail[0]['modify_date'],
    'Order_Cod'         => $order_archive_detail[0]['cod_amount'],
    'Order_Origin'      => $order_archive_detail[0]['origin_city_name'],
    'Order_Destination' => $order_archive_detail[0]['destination_city_name'],
    'Consignee_Name'    => $order_archive_detail[0]['consignee_name'],
    'Consignee_Phone'   => $order_archive_detail[0]['consignee_phone'],
    'Consignee_Email'   => $order_archive_detail[0]['consignee_email'],
    'Consignee_Address' => $order_archive_detail[0]['consignee_address'],
    'Invoice_Code'      => $order_archive_detail[0]['invoice_id'],
    'Product_Detail'    => $order_archive_detail[0]['product_detail'],
    'Order_Remark'      => $order_archive_detail[0]['order_remark']
    );    
	} else {
	$arr = array(
	'Error'             => 1,    
	'Message'           => "Record Not Found",        
    'Order_Code'        => "",
    'Reference_No'      => "",
    'Order_Status'      => "",
    'Order_Date'        => "",
    'Booking_Date'      => "",
    'Arrival_Date'      => "",
    'On_Route_Date'     => "",
    'Delivery_Date'     => "",
    'Last_Activity_Date'=> "",
    'Order_Cod'         => "",
    'Order_Origin'      => "",
    'Order_Destination' => "",
    'Consignee_Name'    => "",
    'Consignee_Phone'   => "",
    'Consignee_Email'   => "",
    'Consignee_Address' => "",
    'Invoice_Code'      => "",
    'Product_Detail'    => "",
    'Order_Remark'      => ""
    );        
	}    
    echo json_encode($arr);
	}

    public function Get_pickup_points(){
    $api_key = $this->input->post('api_key');
    if($api_key!=""){
    $customer_detail=$this->Bookingmodel->Get_customer_by_api_key($api_key);
    $message="";
    $points="";
    if(!empty($customer_detail)){
    $points=$this->Pickmodel->Get_Pickup_Points_By_Customer_id_api($customer_detail[0]['customer_id']);  
    $message="Success";  
    } else {
    $message="Invalid API Key Error";    
    }
    } else{
    $message="Key Not Found";        
    }
    $arr = array(
    'message'    => $message,
    'points'    => $points
    );
    echo json_encode($arr);
    }
    
    
    
    public function Cancelled_shipment_api(){
    $api_key = $this->input->post('api_key');
    $cn = $this->input->post('cn');
    if($api_key!="" && $cn!=""){
    $customer_detail=$this->Bookingmodel->Get_customer_by_api_key($api_key);
    $message="";
    $points="";
    if(!empty($customer_detail)){
    $points=$this->Pickmodel->Cancelled_Cn_By_Customer_ID_And_Cn_Api($customer_detail[0]['customer_id'],$cn);  
    $message=$cn."is Successfully Cancelled";  
    } else {
    $message="Invalid API Key Error";    
    }
    } else{
    $message="Key Not Found Or Invalid CN";        
    }
    $arr = array(
    'message'    => $message,
    'cn'    => $cn
    );
    echo json_encode($arr);
    }
    
    
    public function Cancelled_After_Booking_shipment_api(){
    $api_key = $this->input->post('api_key');
    $cn = $this->input->post('cn');
    if($api_key!="" && $cn!=""){
    $customer_detail=$this->Bookingmodel->Get_customer_by_api_key($api_key);
    $message="";
    $points="";
    if(!empty($customer_detail)){
    $points=$this->Pickmodel->Cancelled_Cn_After_Booking_By_Customer_ID_And_Cn_Api($customer_detail[0]['customer_id'],$cn);  
    $message=$cn."is Successfully Cancelled";  
    } else {
    $message="Invalid API Key Error";    
    }
    } else{
    $message="Key Not Found Or Invalid CN";        
    }
    $arr = array(
    'message'    => $message,
    'cn'    => $cn
    );
    echo json_encode($arr);
    }
    
    
    
    public function Get_Cities(){
    $cities=$this->Bookingmodel->Get_Active_Cities_api(); 
    $arr = array(
    'cities'    => $cities
    );
    echo json_encode($arr);
    }
	
	
	
	
	
	

    

	
    

	


	
}
