<?php


class Remote extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    }

    
	public function index(){
	$this->load->view('remoteView');
    }

    public function cr_amount(){
    $this->Cr_Amount_Data();
    $data['old_cr_amount']="";
    $data['new_cr_amount']="";
    $data['cr_date']="";
    $this->load->view('module_pickup/crreportView',$data);    
    }
    
    public function cr_amount_submit(){
    $cr_date = $this->input->post('cr_date');    
    $data['old_cr_amount']=$this->Commonmodel->Get_record_by_condition('saimtech_old_cr_amount_data', 'cr_date',  $cr_date);
    $data['new_cr_amount']=$this->Commonmodel->Get_Deposit_Cns($cr_date);
    $data['cr_date']=$cr_date;
    $this->load->view('module_pickup/crreportView',$data);      
    }
	
	public function get_json_object(){
	$url = "https://delex.com.pk/welcome/remote_host_json";
	//Curl Start
	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch,CURLOPT_URL, $url) ;
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
	$response = curl_exec($ch) ;
	curl_close($ch) ; 
	//Write out the response
    $json_data          = json_decode($response);
    foreach($json_data as $rows){
    $this->db->trans_start();    
    $this->Commonmodel->Delete_record('saimtech_old_portal', 'order_id', $rows->order_id);   
    $data= array(
    'order_id'              => $rows->order_id,
    'customer_id'           => $rows->customer_id,
    'cn'                    => $rows->CN,
    'refer'                 => $rows->Refer,
    'status'                => $rows->Status,
    'origin'                => $rows->Origin,
    'destination'           => $rows->Destination,
    'weight'                => $rows->Weight,
    'pieces'                => $rows->Pieces,
    'cod'                   => $rows->COD,
    'consignee_mobile_no'   => $rows->consignee_mobile_no,
    'consignee_email'       => $rows->consignee_email,
    'consignee_name'        => $rows->consignee_name,
    'consignee_address'     => $rows->consignee_address,
    'product_detail'        => $rows->product_detail,
    'order_date'            => $rows->Order_Date,
    'booking_date'          => $rows->Booking_Date,
    'arrival_date'          => $rows->Arrival_Date,
    'onroute_date'          => $rows->OnRoute_Date,
    'last_activity_date'    => $rows->Last_Activity_Date,
    'invoice_code'          => $rows->invoice_code,
    'payment_deposit_date'  => $rows->payment_deposit_date,
    'payment_deposit_mode'  => $rows->payment_deposit_mode,
    'is_deposit'            => 0,
    'is_temp_deposit'       => 0,
    'payment_deposit_reference'=>$rows->payment_deposit_reference);  
	$insert_id=$this->Commonmodel->Insert_record('saimtech_old_portal', $data); 
	$this->db->trans_complete();
	
    }
    echo ("<p class='alert alert-success'>All BackUp Done</p>");
	}
	
	
	
	public function get_json_object_date(){
	$url = "https://delex.com.pk/welcome/remote_host_json_date";
	//Curl Start
	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch,CURLOPT_URL, $url) ;
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
	$response = curl_exec($ch) ;
	curl_close($ch) ; 
	//Write out the response
    $json_data          = json_decode($response);
    foreach($json_data as $rows){
    $this->db->trans_start();    
    $this->Commonmodel->Delete_record('saimtech_old_portal', 'order_id', $rows->order_id);   
    $data= array(
    'order_id'              => $rows->order_id,
    'customer_id'           => $rows->customer_id,
    'cn'                    => $rows->CN,
    'refer'                 => $rows->Refer,
    'status'                => $rows->Status,
    'origin'                => $rows->Origin,
    'destination'           => $rows->Destination,
    'weight'                => $rows->Weight,
    'pieces'                => $rows->Pieces,
    'cod'                   => $rows->COD,
    'consignee_mobile_no'   => $rows->consignee_mobile_no,
    'consignee_email'       => $rows->consignee_email,
    'consignee_name'        => $rows->consignee_name,
    'consignee_address'     => $rows->consignee_address,
    'product_detail'        => $rows->product_detail,
    'order_date'            => $rows->Order_Date,
    'booking_date'          => $rows->Booking_Date,
    'arrival_date'          => $rows->Arrival_Date,
    'onroute_date'          => $rows->OnRoute_Date,
    'last_activity_date'    => $rows->Last_Activity_Date,
    'invoice_code'          => $rows->invoice_code,
    'payment_deposit_date'  => $rows->payment_deposit_date,
    'payment_deposit_mode'  => $rows->payment_deposit_mode,
    'is_deposit'            => 0,
    'is_temp_deposit'       => 0,
    'payment_deposit_reference'=>$rows->payment_deposit_reference);  
    print_r($data);
	$insert_id=$this->Commonmodel->Insert_record('saimtech_old_portal', $data); 
	$this->db->trans_complete();
    }
    echo ("<p class='alert alert-success'>Last Date BackUp Done</p>");
	}
	
	
	public function Cr_Amount_Data(){
	$url = "https://delex.com.pk/Web/cr_amount_data";
	//Curl Start
	$ch  =  curl_init();
	$timeout  =  30;
	curl_setopt ($ch,CURLOPT_URL, $url) ;
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
	$response = curl_exec($ch) ;
	curl_close($ch) ; 
	//Write out the response
    $json_data          = json_decode($response); 
 
    if(!empty($json_data)){
    foreach($json_data as $rows){
    
    $cr_origin=0;
    if($rows->City=="Lahore"){
    $cr_origin=1;     
    } else if($rows->City=="Karachi"){
    $cr_origin=2;     
    } else if($rows->City=="Hyderabad"){
    $cr_origin=8;     
    } else if($rows->City=="Quetta"){
    $cr_origin=10;     
    }  else if($rows->City=="Peshawar"){
    $cr_origin=9;     
    } else if($rows->City=="Multan"){
    $cr_origin=7;     
    } else if($rows->City=="Rawalpindi" || $rows->City=="Islamabad" ){
    $cr_origin=4;     
    } else if($rows->City=="Faisalabad"){
    $cr_origin=5;     
    } else if($rows->City=="Gujranwala"){
    $cr_origin=6;     
    } else if($rows->City=="Daska"){
    $cr_origin=12;     
    } else if($rows->City=="Sargodha"){
    $cr_origin=13;     
    } else if($rows->City=="Bahawalpur"){
    $cr_origin=15;     
    } else if($rows->City=="RaheemYar Khan"){
    $cr_origin=17;     
    } else if($rows->City=="Sialkot"){
    $cr_origin=14;     
    } else if($rows->City=="Zafar Wal"){
    $cr_origin=18;     
    }
    $check=$this->Commonmodel->Duplicate_triple_check('saimtech_old_cr_amount_data', 'cr_date', $rows->Ddate, 'cr_status', '1', 'cr_origin',$cr_origin);
    if($check==0){
    $this->db->trans_start();    
    $this->Commonmodel->Delete_double_record('saimtech_old_cr_amount_data', 'cr_date', $rows->Ddate, 'cr_origin',$cr_origin);
    $data= array(
    'city_name'     => $rows->City, 
    'cr_amount'     => $rows->Amount, 
    'cr_shipments'  => $rows->Shipment, 
    'cr_date'       => $rows->Ddate, 
    'cr_rr'         => 'OLDRR'.$rows->Ddate,  
    'cr_origin'     => $cr_origin, 
    'cr_status'     => 0);
    $insert_id=$this->Commonmodel->Insert_record('saimtech_old_cr_amount_data', $data); 
	$this->db->trans_complete();
    }
    }}
	}
	
}
