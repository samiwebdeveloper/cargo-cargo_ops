<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Tracking extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Trackingmodel');
    }


	public function index($cn=0)
	{
	$data['Shipment_id']=$cn;	
	$this->load->view('module_tracking/HomeView',$data); 	
	}
	
	public function Search($cn){
	//------Get Shipment Information
	$shipment_data=$this->Trackingmodel->Get_Shipment_Date_By_Cn($cn);
	//------
	//------Check Array-----Start---
	if(!empty($shipment_data)){
	//----Get Values----------
	$id 			      	= $shipment_data[0]['order_id'];	
	$cn 			      	= $shipment_data[0]['order_code'];
	$status 			    = $shipment_data[0]['order_status'];
	$customer_name 			= $shipment_data[0]['customer_name'];
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
    $cod_amount 			= $shipment_data[0]['cod_amount'];
    $consignee_name 		= $shipment_data[0]['consignee_name'];
	$consignee_email 		= $shipment_data[0]['consignee_email'];
	$consignee_address 		= $shipment_data[0]['consignee_address'];
	$consignee_mobile 		= $shipment_data[0]['consignee_mobile'];
	$order_remark 			= $shipment_data[0]['order_remark'];
	$product_detail 		= $shipment_data[0]['product_detail'];
	$order_receive_from		= $shipment_data[0]['order_receive_from'];
	//----Get Values-------End--	
	//-------Load TabMenu----End--
	echo "<br><table class='table table-bordered'>";
	//-2-----Line one status & ids------
	$this->LineOne($status,$cn,$weight,$cod_amount);
	//-------Line one status & ids----End--
	//-3------Line Two------
	$this->LineTwo($pieces,$origin,$destination,$product_detail);
	//-------Line Two----End--
	//-4-----Line Three------
	$this->LineThree($order_date,$booking_date,$arrival_date,$deliver_date);
	//-------Line Three----End--
	//-5-----Line Four------
	$this->LineFour($consignee_name,$consignee_email,$consignee_mobile,$consignee_address);
	//-------Line Four----End--
	//-7-----Line Six------
	$this->LineSix($reference_no,$order_remark,$customer_name,$booking_date,$deliver_date);
	//------Line Six----End--
	
	echo "</table>";
	//-8-----Iframe-------------
	echo ("<div class='col-lg-7' style='background-color:#212529'> <iframe style='margin-left:1%' width='100%' height='700px' name='lact' frameborder='0' style='background-color:#212529' scrolling='no' src='".base_url()."Tracking/ShowLact/".$id."' id='iframe' onload='javascript:resizeIframe(this);' ></iframe></div>");
	//-------Iframe---------End--
	//------Check Array-----Else PART---	
	} else {
	echo "<center><div width='50%'>";	
	echo "<p class='alert alert-danger'>No Shipment Found  :(</p></div></center>";	
	}
	//------Check Array-----END--
	}
	
	
	public function ShowLact($id){
	$data['tracking_data']=$this->Trackingmodel->Get_Shipment_detail_by_orderID($id);
	$this->load->view('module_tracking/ShowLactView',$data); 	
	}
	
	
	
	
	public function LineOne($status,$cn,$weight,$cod_amount){
	echo "<tr  style='border:0px solid #a01c21'>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Status</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$status."</code><center></td>";
	//---------------------------------------
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>CN</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$cn."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Weight</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$weight."</code></center></td>";
	//--------------------------------------
	echo "<td  width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>COD</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$cod_amount."</code></center></td>";
	echo "</tr>";	
	}
	
	public function LineTwo($pieces,$origin,$destination,$product_detail){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Pieces</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$pieces."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Origin</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$origin."</code></center></td>";
	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Destination</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$destination."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Inside</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$product_detail."</code></center></td>";
	echo "</tr>";
	}	
	
	public function LineThree($order_date,$booking_date,$arrival_date,$deliver_date){
	
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Order Date</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px'>".$order_date."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Booking</center></td>";
	if($booking_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center>".$booking_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Arrival</center></td>";
	if($arrival_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center>".$arrival_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:13px'>---</code><center></td>";	
	}
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Deliver</center></td>";
	if($deliver_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center>".$deliver_date."<center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px'>---</code><center></td>";	
	}
	echo "</tr>";
	}
	
	
	public function LineFour($con_name,$consignee_email,$consignee_mobile,$consignee_address){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$con_name."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Email</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:11px'>".$consignee_email."</code></center></td>";	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Mobile</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px'>".$consignee_mobile."</code></center></td>";	
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Consignee Address</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:10px'>".$consignee_address."</code></center></td>";
	}
	
	
	public function LineSix($reference_no,$order_remark,$customer_name,$booking,$deliver){
	echo "<tr>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Customer Ref#</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='font-size:13px'>".$reference_no."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Note</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='font-size:13px'>".$order_remark."</code><center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Shipper</center></td>";
	echo "<td width=12% bgcolor=#fff style='font-size:13px'><center><code style='font-size:13px'>".$customer_name."</code></center></td>";
	echo "<td width=12% style='color:white;font-size:13px;background-image:linear-gradient(45deg, #1f3953, #a01c21);'><center>Age</center></td></td>";
	if($deliver=="0000-00-00 00:00:00"){
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
	echo "<td width=13% bgcolor=#fff style='font-size:13px'><center><code style='font-size:13px'>".$age."</code><center></td>";
	echo "</tr>";
	}

	
	
}
