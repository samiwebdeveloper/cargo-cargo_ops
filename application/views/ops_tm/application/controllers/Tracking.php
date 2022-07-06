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
	$lenght=strlen($cn);
	//------Get Shipment Information
	$shipments_data=$this->Trackingmodel->Get_Shipment_Date_By_Cn($cn);
	$shipmenta_data=$this->Trackingmodel->Get_Shipment_Date_By_Cn_Archive($cn);
	$shipment_data=array_merge($shipments_data,$shipmenta_data);
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
	echo ("<a href='https://tmdelex.com/cargo/ops_tm/home' target='_blank' id='fixedbutton' class='btn ' style='border-radius:50px; color:white; margin-top: -10px; margin-bottom: 10px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'>Home</a>");
	echo ("<a href='https://cargo.tmcargoexpress.com/ops_tm/Booking/Booking/print_address_label1/".$id ."' target='_blank' id='fixedbutton' class='btn ' style='border-radius:50px; color:white;margin-left: 10px; margin-top: -10px; margin-bottom: 10px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'>Address Label</a>");
	
	//-------Load TabMenu----End--
	echo "<br><table class='table table-bordered' style='border:1px solid #8c363d' >";
	//-2-----Line one status & ids------
	$this->LineOne($status,$manul_cn,$pieces,$weight);
	//-------Line one status & ids----End--
	//-3------Line Two------
	$this->LineTwo($shipper_name,$origin,$destination,$consignee_name);
	//-------Line Two----End--
	//-4-----Line Three------
	$this->LineThree($shipper_mobile,$shipper_address,$consignee_mobile,$consignee_address);
	//-------Line Three----End--
	//-5-----Line Four------
	$this->LineFour($cn,$product_detail,$cod_amount,$customer_name,$order_pay_mode);
	//-------Line Four----End--
	//-7-----Line Six------
	$this->LineSix($order_date,$arrival_date,$deliver_date,$receive_by);
	//------Line Six----End--
	
	echo "</table>";
	//-8-----Iframe-------------
	echo ("<div class='col-lg-7' style='background-color:#fff'> <iframe style='margin-left:1%' width='100%' height='700px' name='lact' frameborder='0' style='background-color:#fff' scrolling='no' src='".base_url()."Tracking/ShowLact/".$id."' id='iframe' onload='javascript:resizeIframe(this);' ></iframe></div>");
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
	

	
	
	
	public function LineOne($status,$manul_cn,$pieces,$weight){
	echo "<tr style='border:1px solid #8c363d;'>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%); '><center>Status</center></td>";
	//-------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$status."</code><center></td>";
	//---------------------------------------
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Manual CN</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d; '>".$manul_cn."</code></center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);' ><center>Pieces</center></td>";
	//--------------------------------------
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px ;color:#8c363d'>".$pieces."</code></center></td>";
	//--------------------------------------
	echo "<td  width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Weight</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$weight."</code></center></td>";
	echo "</tr>";	
	}
	
    public function LineTwo($shipper_name,$origin,$destination,$consignee_name){
	echo "<tr style='border:1px solid #8c363d;'>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Shipper Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$shipper_name."</code><center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Origin</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$origin."</code></center></td>";
	
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Destination</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$destination."</code></center></td>";
	echo "<td  width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Consignee Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$consignee_name."</code></center></td>";
	echo "</tr>";
	}	
	
	public function LineThree($shipper_mobile,$shipper_address,$consignee_mobile,$consignee_address){
	
	echo "<tr style='border:1px solid #8c363d;'>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Shipper Phone</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>".$shipper_mobile."</code><center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Shipper Address</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>".$shipper_address."</code><center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Consignee Phone</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>".$consignee_mobile."</code><center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Consignee Address</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>".$consignee_address."</code><center></td>";
	echo "</tr>";
	}
	
	
	public function LineFour($cn,$product_detail,$cod_amount,$customer_name,$order_pay_mode){
	echo "<tr style='border:1px solid #8c363d;'>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Electron ID</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$cn."</code></center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%); '><center>Comodity</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:11px;color:#8c363d'>".$product_detail."</code></center></td>";
    if($order_pay_mode=="Cash"){
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Cash</center></td>";	
    } else if($order_pay_mode=="Account"){
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Account</center></td>";	
    }
    else {
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>COD</center></td>";	
	}
	if($order_pay_mode=="Account" ){
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>---</code></center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$cod_amount."</code></center></td>";	
	}
    //echo "<td width=12% bgcolor=#009a66 style='color:white;font-size:13px;'><center>COD/Cash</center></td>";
	//echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#009a66'>".$cod_amount."</code></center></td>";

	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Customer Account</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$customer_name."</code></center></td>";
	}
	
	
	
	public function LineSix($order_date,$arrival_date,$deliver_date,$receive_by){
	echo "<tr style='border:1px solid #8c363d;'>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Booking Date</center></td>";
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>".$order_date."</code><center></td>";
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Arrival</center></td>";
	if($arrival_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff ><center><code style='font-size:13px;color:#8c363d;'>".$arrival_date."</code><center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:13px;color:#8c363d'>---</code><center></td>";	
	}
	echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%); '><center>Deliver</center></td>";
	if($deliver_date!="0000-00-00 00:00:00"){
	echo "<td width=13% bgcolor=#fff ><center><code style='font-size:13px;color:#8c363d'>".$deliver_date."</code><center></td>";	
	} else {
	echo "<td width=13% bgcolor=#fff style='font-size:12px'><center><code style='font-size:12px;color:#8c363d'>---</code><center></td>";	
	}
		echo "<td width=12%  style='color:white;font-size:13px; background: linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Receiver Name</center></td>";
	echo "<td width=13% bgcolor=#fff><center><code style='font-size:13px;color:#8c363d'>".$receive_by."</code></center></td>";
	echo "</tr>";
	}
	
	
	

	
	
}
