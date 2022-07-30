<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Shopify extends CI_Controller {

	function __construct() {
    parent::__construct();
     date_default_timezone_set('Asia/Karachi');
    $this->load->model('Commonmodel');
    $this->load->model('Bookingmodel');
    $this->load->model('Pickmodel');
    }
    
    
    


	public function index(){
	$data['sub_nav_active']="Shopify";
	$data['nav_active']="Remote Data";	
	$data['event_name']="Booking";
	$cid=$_SESSION['customer_id'];
	$data['fetched_data']=$this->Commonmodel->Get_record_by_condition('saimtech_shopify', 'customer_id', $cid);
	$data['shipment_types']=$this->Commonmodel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
	$data['pick_up_point']=$this->Bookingmodel->Get_Active_Pickup_Points_By_Customer_id($cid);
	$data['is_error']=$this->Commonmodel->Duplicate_double_check('saimtech_shopify', 'city_id', '0', 'customer_id', $cid);
	$data['cities_data']=$this->Bookingmodel->Get_Active_Cities();
	$this->load->view('shopifyView',$data);	
	}
	
	
	
	public function testing(){
	$url="https://8982325f0658e80c9d2c836625965b35:b41456fda9ac95a3cd8261151fa5b173@clicknchoose-pk.myshopify.com/admin/api/2020-01/orders/1963268571187.json"; 
	$ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    $mdata=json_decode($result);
    $order= $mdata->order;
    $item=$order->line_items;
    $refunds=$order->refunds;
    echo "Order ID  ".$order->id;
    echo "<br>Note  ".$order->note;
    echo "<br>Total_price  ".$order->total_price;
    echo "<br>Items  ".count($item);
    echo "<br>Refunds  ".count($refunds);
    $product_detail="";
    $product_details="";
    $pieces=0;
    $piecess=0;
    foreach($item  as $rows){
    $product_detail= $product_detail." | ".$rows->title;    
    $pieces= $pieces + $rows->quantity;    
    }
    
    echo "<br>".$product_detail;
    echo "<br>".$pieces;
     
    echo "<br>".$product_details;
     echo "<br>".$piecess;
	}
	
	
	public function update_orders(){
	// Get Customer ID    
	$cid=$_SESSION['customer_id'];    
	// Get Orders ID
	$orders_data=$this->Commonmodel->Get_record_by_condition('saimtech_shopify', 'customer_id', $cid);    
	$message=1;
	// Check Condition
	if(!empty($orders_data)){
	foreach($orders_data as $rows){
	$order_id=$rows->order_id;  
	// Call Api By Order ID
	
	 $url = "https://".$rows->username.":".$rows->password."@".$rows->webname.".myshopify.com/admin/api/".$rows->version."/orders/".$order_id.".json";
	$ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    $mdata=json_decode($result);
    $order= $mdata->order;
    $item=$order->line_items;
    $refunds=$order->refunds;
    $customer=$order->customer;
    $address=$order->shipping_address;
    $product_detail="";
    $pieces=0;
    foreach($item  as $rows){
    $product_detail= $product_detail." | ".$rows->title." (".$rows->variant_title.")";  
    $pieces= $pieces + $rows->quantity;  
    }
    // Update Shopify Data
    $data = array(
    'product_detail'    => $product_detail,
    'cod_amount'        => $order->total_price,
    'pieces'            => $pieces,
    'customer_phone'    => "#".$order->phone." / ".$customer->phone." / ".$address->phone, 
    'weight'            => (($order->total_weight)/(1000)),
    'remark'            => count($refunds)."- ".$order->note.'(Call Before Delivery)',
    );
    $this->load->helper('string');
    $this->Commonmodel->Update_record('saimtech_shopify', 'order_id',$order_id , $data);
	}
	redirect("Shopify");
	} else {
	$message=0;    
	}    
	}
	
	
	public function fullfillment($username,$password,$webname,$version,$order_id,$tracking_id,$location){
	    //GET /admin/api/2020-01/locations.json
    $url ="https://delex.pk/Gtracking/index/".$tracking_id;
    $tracking =$this->input->post('tracking');
    $tracking_urls = array($url);
    $json_data = json_encode($post_data);
    //API Url
    $url = "https://".$username.":".$password."@".$webname.".myshopify.com/admin/api/".$version."/orders/".$order_id."/fulfillments.json";
    //Initiate cURL.
    $ch=curl_init($url);
    //The JSON data.
    $post_data = array(
    'location_id'     => $location,
    'tracking_number' => $tracking_id,
   // 'tracking_company'=> 'DELEX',
    'tracking_urls'   => $tracking_urls
    );
    //Encode the array into JSON.
    $json_data = json_encode(array('fulfillment' => $post_data));
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
    //Execute the request
    curl_exec($ch);
    //$result = curl_exec($ch);
    }
	
	
	public function clean($string){
	$string = trim($string);
	$num = array(0,1,2,3,4,5,6,7,8,9);
    $string = str_replace($num, null, $string);    
    $string = str_replace('-', '', $string);
    $string = str_replace('.', '', $string);
    // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
	
	
	
    public function update_order($order_id){
	// Get Customer ID    
	// Get Orders ID
	$orders_data=$this->Commonmodel->Get_record_by_condition('saimtech_shopify', 'order_id', $order_id);    
	$message=1;
	// Check Condition
	if(!empty($orders_data)){
	foreach($orders_data as $rows){
	$order_id=$rows->order_id;  
	// Call Api By Order ID
	$url = "https://".$rows->username.":".$rows->password."@".$rows->webname.".myshopify.com/admin/api/".$rows->version."/orders/".$order_id.".json";
	$ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    $mdata=json_decode($result);
    $order= $mdata->order;
    $item=$order->line_items;
    $refunds=$order->refunds;
    $customer=$order->customer;
    $address=$order->shipping_address;
    $product_detail="";
    $pieces=0;
    foreach($item  as $rows){
    $product_detail= $product_detail." | ".$rows->title." (".$rows->variant_title.")";  
    $pieces= $pieces + $rows->quantity;  
    }
    // Update Shopify Data
    $data = array(
    'product_detail'    => $product_detail,
    'cod_amount'        => $order->total_price,
    'pieces'            => $pieces,
    'customer_phone'    => "#".$order->phone." / ".$customer->phone." / ".$address->phone, 
    'weight'            => (($order->total_weight)/(1000)),
    'remark'            => count($refunds)."- ".$order->note.'(Call Before Delivery)',
    );
    $this->load->helper('string');
    $this->Commonmodel->Update_record('saimtech_shopify', 'order_id',$order_id , $data);
	}
	redirect("Shopify");
	} else {
	$message=0;    
	}    
	}
    
	
	public function data_fetcher($api,$username,$password,$webname,$version,$location){
	//https://delex.pk/Shopify/data_fetcher/5f080446d85a5/ba840a39d247def085626f35de11ea5e/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/store_name/version/34946940992   
	    
    $webhook_data   = file_get_contents('php://input');
    $mdata          = json_decode($webhook_data);
    $customer_detail=$this->Bookingmodel->Get_customer_by_api_key($api);
    if(!empty($customer_detail)){
    $address        = $mdata->shipping_address;
    $product        = $mdata->line_items;
    $fullfil        = $mdata->fulfillments;
    $customer       = $mdata->customer;
    $customer_email = $customer->email; 
    if($customer->email ==""){ 
    $customer_email     = "test@test.com"; }
    $weight             = ($mdata->total_weight/1000);
    $customer_phone     = "#".$mdata->phone; 
    if($mdata->phone ==""){ 
    $customer_phone = "#".$customer->phone."/".$addtess->phone; } 
    $d_city_id=0;
    $clean_city=trim(ucwords($this->clean($address->city)));
   	$dest=$this->Commonmodel->Get_record_by_double_condition('saimtech_city', 'city_name',$clean_city, 'is_enable',1);
	if(!empty($dest)){foreach($dest as $rows){
	$d_city_id=$rows->city_id;
	}} else { $d_city_id=0;}
    $data = array(
    'order_id'          => $mdata->id,
    'location_id'       => $location,
    'order_no'          => $mdata->order_number,
    'fullfillment_id'   => $product[0]->id, 
    'customer_name'     => $address->name, 
    'customer_email'    => $customer_email, 
    'customer_address'  => $address->address1." ".$address->city, 
    'customer_phone'    => $customer_phone, 
    'city_name'         => $clean_city, 
    'city_id'           => $d_city_id,
    'product_detail'    => $product[0]->title,
    'api_key'           => $api, 
    'cod_amount'        => $mdata->total_price,
    'pieces'            => '1',
    'weight'            =>  $weight,
    'order_code'        => 'N/A', 
    'remark'            =>  $mdata->note.'(Call Before Delivery)',
    'order_status'      => 'N/A',
    'username'          => $username,
    'password'          => $password,
    'webname'           => $webname,
    'version'           => $version,
    'customer_id'       => $customer_detail[0]['customer_id'],
    );

    $this->load->helper('string');
    $last_insert_id=$this->Commonmodel->Insert_record('saimtech_shopify', $data); 
    } else {
    echo ("Invalid API key");    
    }
    }
	
	
	public function order_now(){
	$shipment_type           = $this->input->post('shipment_type');    
	$pick_point              = $this->input->post('pick_point');    
	$special_handing         = $this->input->post('special_handing');    
	$order_id                = $this->input->post('order_id');    
	$shopify_id              = $this->input->post('shopify_id');    
	$fullfillment_id         = $this->input->post('fullfillment_id');    
	$instruction             = $this->input->post('instruction');
	$notification            = 1;
	if($shipment_type!="" && $pick_point!="" && $special_handing !="" && $order_id!="" && $shopify_id!="" && $fullfillment_id!=""){
	$shpify_data=$this->Commonmodel->Get_record_by_condition('saimtech_shopify', 'shopify_id', $shopify_id );  
	if(!empty($shpify_data)){foreach($shpify_data as $rows){
	$piece           = $rows->pieces;
    $weight          = $rows->weight;
    $location        = $rows->location_id;
    $cod             = $rows->cod_amount;
    $reference_no    = $rows->order_no;
    $c_name          = $rows->customer_name;
    $c_phone         = $rows->customer_phone;  
    $c_email         = $rows->customer_email;
    $d_city          = $rows->city_id;
    $c_address       = $rows->customer_address;
    $remark          = $instruction." (".$rows->remark.")";
    $username        = $rows->username;
    $password        = $rows->password;
    $webname         = $rows->webname;
    $version         = $rows->version;
    $product_detail  = $rows->product_detail;
    $tracking_id     = $this->add_shipment($shipment_type,$piece,$weight,$cod,$reference_no,$pick_point,$c_name,$c_phone,$c_email,$d_city,$c_address,$remark,$special_handing,$product_detail);
	$this->fullfillment($username,$password,$webname,$version,$order_id,$tracking_id,$location);
	$this->Commonmodel->Delete_record('saimtech_shopify', 'shopify_id', $shopify_id);
	$notification=1000000;
	}
	} else {$notification=2;}    
	} else {$notification=2;}
	echo  $notification;   
	}
	
	
	
	public function all_order_now(){
	$shipment_type           = $this->input->post('all_shipment_type');    
	$pick_point              = $this->input->post('all_pick_point');    
	$special_handing         = $this->input->post('all_special_handing');    
	$instruction             = $this->input->post('instruction');
	$notification            = 1;
	if($shipment_type!="" && $pick_point!="" && $special_handing!="" ){
	$shpify_data=$this->Commonmodel->Get_record_by_double_condition('saimtech_shopify', 'city_id <>', '0', 'customer_id', $_SESSION['customer_id']);  
	if(!empty($shpify_data)){foreach($shpify_data as $rows){
    $piece          =$rows->pieces;
    $weight         =$rows->weight;
    $location       =$rows->location_id;
    $cod            =$rows->cod_amount;
    $reference_no   =$rows->order_no;
    $c_name         =$rows->customer_name;
    $c_phone        =$rows->customer_phone;  
    $c_email        =$rows->customer_email;
    $d_city         =$rows->city_id;
    $c_address      =$rows->customer_address;
    $remark         =$instruction." (".$rows->remark.")";
    $username       =$rows->username;
    $password       =$rows->password;
    $webname        =$rows->webname;
    $order_id       =$rows->order_id;
    $shopify_id     =$rows->shopify_id;
    $version        =$rows->version;
    $product_detail =$rows->product_detail;
    $this->db->trans_start();
	$tracking_id     = $this->add_shipment($shipment_type,$piece,$weight,$cod,$reference_no,$pick_point,$c_name,$c_phone,$c_email,$d_city,$c_address,$remark,$special_handing,$product_detail);
	$this->fullfillment($username,$password,$webname,$version,$order_id,$tracking_id,$location);
	$this->Commonmodel->Delete_record('saimtech_shopify', 'shopify_id', $shopify_id);
	$this->db->trans_complete();
	$notification=1;
	}
	} else {$notification=21;}    
	} else {$notification=22;}
	echo  $notification;      
	}
	
	
	
	
	
	
	
	
	

	public function add_shipment($shipment_type,$piece,$weight,$cod,$reference_no,$pick_point,$c_name,$c_phone,$c_email,$d_city,$c_address,$remark,$sp_handling,$product_detail){
	//==============Get Values From Booking Form=================		
	 $message			 = "";
	 $cash_limit 		 =100000000;					
	 $ship_type           = $shipment_type;
	 $o_date              = date('Y-m-d H:i:s');
	 $o_piece             = $piece;
	 $o_weight            = $weight;
	 $cod              	  = $cod;
	 $c_ref_no   		  = $reference_no;
	 $pick_point          = $pick_point;
	 $re_ship     		  = 'No';	
     $c_name              = $c_name;
	 $c_phone             = $c_phone;
	 $c_email             = $c_email;
	 $d_city              = $d_city;
	 $c_address           = $c_address;
	 $remark              = $remark;
	 $sp_handling         = $sp_handling;
     $product_detail	  = $product_detail;
     $customer_id 		  = $_SESSION['customer_id'];
	 $d_city_name 		  = "";
	 $d_city_zone 		  = "";
	 $o_city 		 	  = "";
	 $o_city_name 		  = "";
	 $o_city_zone 		  = "";
	 $rate_type 		  = "";
	 $order_rate 		  = "";
	 $order_add_rate 	  = "";
	 $order_gst 	 	  = "";
	 $order_fuel 	 	  = "";
	 $order_handling 	  = "";
	 $order_cash_handling = "";
	 $rate_id             = "";
	 $d_city_reporting    = "";
	 $o_city_reporting    = "";
	 $first_char_customer =substr($c_ref_no, 0, 1);
	
	if($first_char_customer!="#"){
	$c_ref_no   		 = "#".$c_ref_no;    
	}
	//=========================================================END
	//==============Missing Main Attribute Coditions===============
	if($ship_type !="" && $o_date!="" && $o_piece!="" && $o_weight!=""  &&
	   $cod!="" && $pick_point!="" && $re_ship!="" && $c_name!="" && $c_phone!="" && $c_email!=""
	   && $d_city!="" && $c_address!="" && $remark!="" && $sp_handling!="" && $customer_id!="" && $product_detail!=""){
	$this->db->trans_start();
	//==============Get Destination City ID & Name================
	$dest=$this->Commonmodel->Get_record_by_double_condition('saimtech_city', 'city_id', $d_city, 'is_enable', 1);
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
	
	$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_rate', 'customer_id', $customer_id, 'service_id', $ship_type, 'is_enable', 1);
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
	$order_add_rate 				=$sz_add_rate;
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
	$order_add_rate 				= $dz_add_rate;
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
    $order_code=$this->get_order_code($o_city_code);
    $ip= $_SERVER['REMOTE_ADDR'];
	$this->set_barcode($order_code);
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
	'destination_city'				=> 	$d_city,
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
	'pickup_rider_id'				=>	'0',
	'delivery_rider_id'				=>	'0',
	'order_cr'						=>	'N',
	'order_receive_amount'			=> 	'0',
	'origin_reporting'              =>  $o_city_reporting,
	'destination_reporting'         =>  $d_city_reporting, 
	'rate_id'						=>	$rate_id,
	'created_by'					=>	$customer_id,
	'created_date'					=>	date('Y-m-d H:i:s')
	);
	$insert_id=$this->Commonmodel->Insert_record('saimtech_order', $data);
	$status_msg="Your Order Has Been Generated.";
	$this->insert_tracking_detail($insert_id,'Order',$o_city,$o_city_name,$status_msg,date('Y-m-d H:i:s'),$ip,$customer_id,date('Y-m-d H:i:s'));
	 $this->db->trans_complete();
	if($insert_id>0){	
	$message = $order_code;
	} else {
		
	}
	} 
	else {$message = "Missing Error !";	}
	//=========================================================END
	return $message;	
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
		$f_wht 		 = ceil(($my_wht)/($add_wgt));
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
	$prefix="110".date('y'); 
	if(strlen($code)==1){ $precode=$prefix."00000".$code;} 
	else if(strlen($code)==2){ $precode=$prefix."0000".$code;} 
	else if(strlen($code)==3){ $precode=$prefix."000".$code;} 
	else if(strlen($code)==4){ $precode=$prefix."00".$code;} 
	else if(strlen($code)==5){ $precode=$prefix."0".$code;} 
	else if(strlen($code)==6){ $precode=$prefix.$code;}
	return $precode;
	}
	
		public function set_barcode($code){
    $targetDir = FCPATH."assets/barcode/cn/";
    $this->load->library('zend');
    $this->zend->load('Zend/Barcode');
    $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
    $code = $code;
    $store_image = imagepng($file,$targetDir."/{$code}.png");
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
	
	
	
	 public function error_data(){

    //get records from database
    $error_data=$this->Commonmodel->Get_record_by_double_condition('saimtech_shopify', 'city_id', '0', 'customer_id', $_SESSION['customer_id']);
	$delimiter = ",";
    $filename = "DELEX Shopify_Erro_File " . date('Y-m-d') . ".csv";
    //create a file pointer
    $f = fopen('php://memory', 'w');
    //set column headers
    	
    $fields = array('Error','Shipment Type', 'Pieces', 'Weight', 'COD Amount', 'Reference No', 'Product Detail', 'Pickup Point ID', 'Consignee Name', 'Consignee Phone', 'Consignee Email', 'Destination City Code', 'Consignee Address', 'Remark', 'Speical Handling');
    fputcsv($f, $fields, $delimiter);
    //output each row of the data, format line as csv and write to file pointer
    foreach($error_data as $rows){    
        $lineData = array('City Error/PickUp',1, $rows->pieces, $rows->weight, $rows->cod_amount, $rows->order_no, $rows->product_detail, 0, $rows->customer_name, "#".$rows->customer_phone, $rows->customer_email, $rows->city_name, $rows->customer_address, $rows->remark, 'No');
        fputcsv($f, $lineData, $delimiter);
    }
    //move back to beginning of file
    fseek($f, 0);
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    //output all remaining data on a file pointer
    fpassthru($f);
    exit;
    }
    
    
    
    public function catea_data(){

    //get records from database
    $error_data=$this->Commonmodel->Get_record_by_double_condition('saimtech_shopify', 'city_id <>', '0', 'customer_id', $_SESSION['customer_id']);
	$delimiter = ",";
    $filename = "DELEX Shopify_File " . date('Y-m-d') . ".csv";
    //create a file pointer
    $f = fopen('php://memory', 'w');
    //set column headers
    	
    $fields = array('Shipment Type', 'Pieces', 'Weight', 'COD Amount', 'Reference No', 'Product Detail', 'Pickup Point ID', 'Consignee Name', 'Consignee Phone', 'Consignee Email', 'Destination City Code', 'Consignee Address', 'Remark', 'Speical Handling');
    fputcsv($f, $fields, $delimiter);
    //output each row of the data, format line as csv and write to file pointer
    foreach($error_data as $rows){    
        $lineData = array(1, $rows->pieces, $rows->weight, $rows->cod_amount, $rows->order_no, $rows->product_detail, 0, $rows->customer_name, "#".$rows->customer_phone, $rows->customer_email, $rows->city_name, $rows->customer_address, $rows->remark, 'No');
        fputcsv($f, $lineData, $delimiter);
    }
    //move back to beginning of file
    fseek($f, 0);
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    //output all remaining data on a file pointer
    fpassthru($f);
    exit;
    }

    public function delete_data(){
    $this->Commonmodel->Delete_record_double_condition('saimtech_shopify', 'city_id', '0', 'customer_id', $_SESSION['customer_id']);
    redirect('Shopify');
    }

	
    public function adelete_data(){
    $this->Commonmodel->Delete_record_double_condition('saimtech_shopify', 'city_id <>', '0', 'customer_id', $_SESSION['customer_id']);
    redirect('Shopify');
    }

	
}
