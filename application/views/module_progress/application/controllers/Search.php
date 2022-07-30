<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Search extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Trackingmodel');
    }

    public function index(){
     
    $this->load->view('module_report/searchView');
    }

    public function add_row_in_table(){
    echo $cn = $this->input->post('cn');
    echo $refer_first =substr($cn, 0,1);
    $refer ="";
    if($refer_first=="#"){$refer=$cn;} 
    else {$refer="#".$cn;}
    if($cn!=""){
    $order_detail=$this->Trackingmodel->Get_Shipment_Date_By_Cn_OR_Refer($_SESSION['customer_id'],$cn,$refer);
    $order_archive_detail=$this->Trackingmodel->Get_Shipment_Date_By_Cn_OR_Refer_Archive($_SESSION['customer_id'],$cn,$refer);
    $order_detail=array_merge($order_detail,$order_archive_detail);    
    if(!empty($order_detail)){
    foreach($order_detail as $rows){
    echo("<tr>");
    echo("<td><center>".$rows->order_code."</center></td>");
    echo("<td><center>".$rows->customer_reference_no."</center></td>");
    echo("<td><center>".$rows->order_status."</center></td>");
    echo("<td><center>PKR ".number_format($rows->cod_amount)."/-</center></td>");
    echo("<td><center>".$rows->weight."</center></td>");
    echo("<td><center>".$rows->origin_city_name."</center></td>");
    echo("<td><center>".$rows->destination_city_name."</center></td>");
    echo("<td><center><a href='https://delex.pk/Booking/single_print_address_label/".$rows->order_id."' target='_blank' class='btn btn-info btn-xs'>Print</a></center></td>");
    echo("<td><center><a href='https://delex.pk/Trackingo/index/".$rows->order_code."' target='_blank' class='btn btn-info btn-xs'>View</a></center></td>");
    echo("</tr>"); 
    }
    } else {
    echo("<td><p class='alert lert-danger'>No Shippment Found.</p></td>");}
    } else {
    echo("<td><p class='alert lert-danger'>Something Went Wrong.</p></td>");}
    }
	





	
}
