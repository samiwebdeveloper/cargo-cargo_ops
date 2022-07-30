<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class GTracking extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Trackingmodel');
    }


	public function index($cn=0)
	{
	$data['Shipment_id']=$cn;	
	$this->load->view('module_trackingo/GHomeView',$data); 	
	}
	
	public function Search($cn){
	$lenght=strlen($cn);
	//if($lenght==11){
	//------Get Shipment Information
	$shipment_data=$this->Trackingmodel->Get_Shipment_Date_By_Cn($cn);
	//------
	//------Check Array-----Start---
	if(!empty($shipment_data)){
	//----Get Values----------
	$id 			      	= $shipment_data[0]['order_id'];	
	$cn 			      	= $shipment_data[0]['order_code'];
	$manul_cn 			    = $shipment_data[0]['manual_cn'];
	$status 			    = $shipment_data[0]['order_status'];
	$customer_name 			= $shipment_data[0]['customer_name'];
	$shipper_name 			= $shipment_data[0]['shipper_name'];
	$shipper_mobile 		= $shipment_data[0]['shipper_phone'];
	$shipper_address 		= $shipment_data[0]['shipper_address'];
	$reference_no			= $shipment_data[0]['customer_reference_no'];  
	$order_date 	      	= $shipment_data[0]['order_date'];
    $booking_date 	      	= $shipment_data[0]['order_booking_date'];
    $arrival_date 		  	= $shipment_data[0]['order_arrival_date'];
	$deliver_date 		  	= $shipment_data[0]['order_deliver_date'];
    $order_status 		  	= $shipment_data[0]['order_status'];
    $destination			= $shipment_data[0]['destination_city_name'];
    $origin 		 		= $shipment_data[0]['origin_city_name'];
    $weight 				= $shipment_data[0]['weight'];
    $pieces 				= $shipment_data[0]['pieces'];
    $order_pay_mode 		= $shipment_data[0]['order_pay_mode'];
    $cod_amount 			= $shipment_data[0]['cod_amount'];
    $consignee_name 		= $shipment_data[0]['consignee_name'];
	$consignee_email 		= $shipment_data[0]['consignee_email'];
	$consignee_address 		= $shipment_data[0]['consignee_address'];
	$consignee_mobile 		= $shipment_data[0]['consignee_mobile'];
	$order_remark 			= $shipment_data[0]['order_remark'];
	$product_detail 		= $shipment_data[0]['product_detail'];
	$order_receive_from		= $shipment_data[0]['order_receive_from'];
	$receive_by             = $shipment_data[0]['shipment_received_by'];
	//----Get Values-------End--	
	//-------Load TabMenu----End--
	echo "<br><table class='table table-bordered'>";
	//-2-----Line one status & ids------
	$this->LineOne($cn,$manul_cn,$pieces,$weight);
	//-------Line one status & ids----End--
	//-3------Line Two------
	$this->LineTwo($status,$origin,$destination,$cod_amount);
	//-------Line Two----End--
	//-4-----Line Three------
	//$this->LineThree($shipper_mobile,$shipper_address,$consignee_mobile,$consignee_address);
	//-------Line Three----End--
	//-5-----Line Four------
	//$this->LineFour($product_detail,$customer_name);
	//-------Line Four----End--
	//-7-----Line Six------
	$this->LineSix($order_date,$arrival_date,$deliver_date,$receive_by);
	//------Line Six----End--
	
	echo "</table>";
	//-8-----Iframe-------------
	echo ("<div class='col-lg-7' style='background-color:#212529'> <iframe style='margin-left:1%' width='100%' height='700px' name='lact' frameborder='0' style='background-color:#212529' scrolling='no' src='".base_url()."Trackingo/ShowLact/".$id."' id='iframe' onload='javascript:resizeIframe(this);' ></iframe></div>");
	//-------Iframe---------End--
	//------Check Array-----Else PART---	
	} else {
	echo "<center><div width='50%'>";	
	echo "<p class='alert alert-danger'>No Shipment Found  :(</p></div></center>";	
	}
	//------Check Array-----END--
	/*} else {
	    
	
	
	
	//------Get Shipment Information
	$shipment_data=$this->Trackingmodel->Get_Shipment_Date_By_Cn_Old($cn);
	//------
	//------Check Array-----Start---
	if(!empty($shipment_data)){
	//----Get Values----------
	$id 			      	= $shipment_data[0]['order_id'];	
	$cn 			      	= $shipment_data[0]['cn'];
	$status 			    = $shipment_data[0]['status'];
	$customer_name 			= $shipment_data[0]['customer_name'];
	$reference_no			= $shipment_data[0]['refer'];  
	$order_date 	      	= date('Y-m-d', strtotime($shipment_data[0]['order_date']));
    $booking_date 	      	= date('Y-m-d', strtotime($shipment_data[0]['booking_date']));
    $arrival_date 		  	= date('Y-m-d', strtotime($shipment_data[0]['arrival_date']));
	$deliver_date 		  	= date('Y-m-d', strtotime($shipment_data[0]['onroute_date']));
    $destination			= $shipment_data[0]['destination'];
    $origin 		 		= $shipment_data[0]['origin'];
    $weight 				= $shipment_data[0]['weight'];
    $pieces 				= $shipment_data[0]['pieces'];
    $cod_amount 			= $shipment_data[0]['cod'];
    $consignee_name 		= $shipment_data[0]['consignee_name'];
	$consignee_email 		= $shipment_data[0]['consignee_email'];
	$consignee_address 		= $shipment_data[0]['consignee_address'];
	$consignee_mobile 		= $shipment_data[0]['consignee_mobile_no'];
	$order_remark 			= 'From Old Portal';
	$product_detail 		= $shipment_data[0]['product_detail'];
	$last_activity_date 	= date('Y-m-d', strtotime($shipment_data[0]['last_activity_date']));

	$order_receive_from		= 'OLD Portal';
	//----Get Values-------End--	
	//-------Load TabMenu----End--
	echo "<br><table class='table table-bordered'>";
	//-2-----Line one status & ids------
	$this->OldLineOne($status,$cn,$weight,$cod_amount);
	//-------Line one status & ids----End--
	//-3------Line Two------
	$this->OldLineTwo($pieces,$origin,$destination,$product_detail);
	//-------Line Two----End--
	//-4-----Line Three------
	$this->OldLineThree($order_date,$booking_date,$arrival_date,$deliver_date);
	//-------Line Three----End--
	//-5-----Line Four------
	$this->OldLineFour($consignee_name,$consignee_email,$consignee_mobile,$consignee_address);
	//-------Line Four----End--
	//-7-----Line Six------
	$this->OldLineSix($reference_no,$order_remark,$customer_name,$booking_date,$deliver_date);
	//------Line Six----End--
	
	echo "</table>";
	//-8-----Iframe-------------
	echo ("<div class='col-lg-7' style='background-color:#212529'> <iframe style='margin-left:1%' width='100%' height='700px' name='lact' frameborder='0' style='background-color:#212529' scrolling='no' src='".base_url()."Trackingo/ShowLactOld/".$status."/".$last_activity_date."' id='iframe' onload='javascript:resizeIframe(this);' ></iframe></div>");
	//-------Iframe---------End--
	//------Check Array-----Else PART---	
	} else {
	echo "<center><div width='50%'>";	
	echo "<p class='alert alert-danger'>No Shipment Found  :(</p></div></center>";	
	}
	//------Check Array-----END--
	
	
	
	*/
//}
	}
	
	
	public function ShowLact($id){
	$data['tracking_data']=$this->Trackingmodel->Get_Shipment_detail_by_orderID($id);
	$this->load->view('module_trackingo/ShowLactView',$data); 	
	}


    public function ShowLactOld($status,$date){
	$data['status']=$status;
	$data['date']=$date;
	$this->load->view('module_trackingo/ShowLactOldView',$data); 	
	}	
	
	
	
	public function LineOne($cn,$manul_cn,$pieces,$weight){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>CN</center></td>";
	//-------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cn."</code><center></td>";
	//---------------------------------------
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Manual CN</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$manul_cn."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Pieces</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$pieces."</code></center></td>";
	//--------------------------------------
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Weight</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$weight."</code></center></td>";
	echo "</tr>";		
	}
	
	public function LineTwo($status,$origin,$destination,$cod_amount){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Status</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$status."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Origin</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$origin."</code></center></td>";
	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Destination</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$destination."</code></center></td>";
	echo "<td  width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>COD/Cash</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cod_amount."</code></center></td>";
	echo "</tr>";
	}	
	
/****	public function LineThree($shipper_mobile,$shipper_address,$consignee_mobile,$consignee_address){
	
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Shipper Phone</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$shipper_mobile."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Shipper Address</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$shipper_address."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Phone</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$consignee_mobile."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Address</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$consignee_address."</code><center></td>";
	echo "</tr>";
	}
	******/
	
/****	public function LineFour($cn,$product_detail,$cod_amount,$customer_name){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Electron ID</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cn."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Comodity</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$product_detail."</code></center></td>";
    /***if($order_pay_mode=="Cash"){
	//echo "<td width=12% bgcolor=#009a66 style='color:white;font-size:13px;'><center>Cash</center></td>";	
    } else {
	echo "<td width=12% bgcolor=#009a66 style='color:white;font-size:13px;'><center>COD</center></td>";	
	}
	if($order_pay_mode!="Account" ){
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#009a66'>---</code></center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#009a66'>".$cod_amount."</code></center></td>";	
	}***/
    //echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>COD/Cash</center></td>";
	//echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cod_amount."</code></center></td>";

//	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Customer Account</center></td>";
//	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$customer_name."</code></center></td>";
//	}****//
	
	
	public function LineSix($order_date,$arrival_date,$deliver_date,$receive_by){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Booking Date</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$order_date."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Arrival</center></td>";
	if($arrival_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$arrival_date."</code><center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:13px;color:#009a66'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Deliver</center></td>";
	if($deliver_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$deliver_date."</code><center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#009a66'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Receiver Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$receive_by."</code></center></td>";
	echo "</tr>";
	}



    public function OldLineOne($status,$cn,$weight,$cod_amount){
	echo "<tr  style='border:0px solid #a01c21'>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Status</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$status."</code><center></td>";
	//---------------------------------------
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>CN</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cn."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Weight</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$weight."</code></center></td>";
	//--------------------------------------
	echo "<td  width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>COD</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$cod_amount."</code></center></td>";
	echo "</tr>";	
	}
	
	public function OldLineTwo($pieces,$origin,$destination,$product_detail){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Pieces</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$pieces."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Origin</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$origin."</code></center></td>";
	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Destination</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$destination."</code></center></td>";
	echo "<td  width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Inside</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>||||||</code></center></td>";
	echo "</tr>";
	}	
	
	public function OldLineThree($order_date,$booking_date,$arrival_date,$deliver_date){
	
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Order Date</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='color:#1f3953;font-size:12px'>".$order_date."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Booking</center></td>";
	if($booking_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center>".$booking_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center><code style='font-size:12px'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Arrival</center></td>";
	if($arrival_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center>".$arrival_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center><code style='font-size:13px'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Deliver</center></td>";
	if($deliver_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center>".$deliver_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='color:#1f3953;font-size:12px'><center><code style='font-size:12px'>---</code><center></td>";	
	}
	echo "</tr>";
	}
	
	
	public function OldLineFour($con_name,$consignee_email,$consignee_mobile,$consignee_address){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$con_name."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Email</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:11px'>".$consignee_email."</code></center></td>";	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Mobile</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:13px'>".$consignee_mobile."</code></center></td>";	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Address</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='color:#1f3953;font-size:10px'>".$consignee_address."</code></center></td>";
	}
	
	
	public function OldLineSix($reference_no,$order_remark,$customer_name,$booking,$deliver){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Customer Ref#</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='color:#1f3953;font-size:13px'>".$reference_no."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Note</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='color:#1f3953;font-size:13px'>".$order_remark."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Shipper</center></td>";
	echo "<td width=12% bgcolor=#fff style='font-size:13px'><center><code style='color:#1f3953;font-size:13px'>".$customer_name."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Age</center></td></td>";
	if($deliver=="0000-00-00"){
	$tdate = strtotime(date('Y-m-d'));
	$bdate = strtotime($booking);
	$datediff = $tdate - $bdate;
	$age =floor($datediff / (60 * 60 * 24))."-Days";	
	} else {
	$ddate = strtotime($deliver);
	$bdate = strtotime($booking);
	$datediff = $ddate - $bdate;
	$age =floor($datediff / (60 * 60 * 24))."-Days";	
	}
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='color:#1f3953;font-size:13px'>---</code><center></td>";
	echo "</tr>";
	}


    
	
	
}
