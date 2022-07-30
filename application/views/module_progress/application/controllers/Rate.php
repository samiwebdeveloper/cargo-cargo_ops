<?php
//WC=With in City
//SZ=Same in Zone
//DZ=Different in Zone
//UK=Unknown
//PSB=Portal Single Booking
//PIB=Portal Import Booking
//WAB=Web Api Booking

class Rate extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Bookingmodel');
    $this->load->model('Pickmodel');
    $this->load->model('Ratingmodel');
    }

    public function index(){
    echo("<center>All Done</center>");    
    }

	public function rating($customer_id){
	//$this->Commonmodel->Update_Rate_Type();
	$rate_id                        = 0;
	$rate_type                      ="";
	$o_weight                       = "";//---Order Weight
	$cash_limit                     = 10000000;   
	$cod                            = "";
	$order_id                       = 0;
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
	//------------------------------------------------    
	//$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_ratess', 'customer_id', $customer_id, 'service_id', $ship_type, 'is_enable', 1);
	$order_detail=$this->Commonmodel->Get_record_by_condition('saimtech_order', 'customer_id', $customer_id);
	if(!empty($order_detail)){
	foreach($order_detail as $rows){
	echo $ratee_id                       = $rows->rate_id;
	$o_weight                       = $rows->weight;
	$cash_limit                     = 10000000;   
	$cod                            = $rows->cod_amount;
	$order_id                       = $rows->order_id;
	$rate_type                      = $rows->order_rate_type;
	$dest_zone                      = $rows->destination_zone;
	if($rate_type=="DW"){$calcu=$this->new_destination_rating_module($ratee_id,$o_weight);
	$order_rate 					= 0;
	$order_add_rate 				= 0;
	$order_gst 						= $calcu->my_gst;
	$order_sc 						= $calcu->my_amount;
	$order_sp_handling_rate 		= 0;
	$order_cash_handling_rate 		= 0;
	$order_fuel 					= 0;
	$order_flyer_rate 				= 0;
	$order_total_amount_with_flyer 	= 0;
	$order_total_amount 			= (($order_gst) + ($order_sc));
	$rate_type                      ='DW';
	$rate_id                        = $calcu->my_rate_id;    
	} else if($rate_type=="ZW"){$calcu2=$this->new_zone_rating_module($ratee_id,$o_weight,$dest_zone);
	print_r($calcu2);
	$order_rate 					= 0;
	$order_add_rate 				= 0;
	$order_gst 						= $calcu2->my_gst;
	$order_sc 						= $calcu2->my_amount;
	$order_sp_handling_rate 		= 0;
	$order_cash_handling_rate 		= 0;
	$order_fuel 					= 0;
	$order_flyer_rate 				= 0;
	$order_total_amount_with_flyer 	= 0;
	$order_total_amount 			= (($order_gst) + ($order_sc));
	$rate_type                      ='ZW';
	$rate_id                        = $calcu2->my_rate_id;    
	}
	$data = array(
	'order_rate'					=>	$order_rate,
	'order_add_rate'				=>	$order_add_rate,
	'order_gst'						=>	$order_gst,
	'order_sc'						=>	$order_sc,
	'order_sp_handling_rate'		=>	$order_sp_handling_rate,
	'order_cash_handling_rate'		=>  $order_cash_handling_rate,
	'order_fuel'					=>	$order_fuel,
	'order_flyer_rate'				=>	$order_flyer_rate,
	'order_total_amount_with_flyer' =>  $order_total_amount_with_flyer,
	'order_total_amount'            =>  $order_total_amount
	);
	$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);
	//redirect('Rate');
	} 
	} else {echo "Something Went Wrong";    }
	}
	
	
	 public function calculate_rate($wgt,$wgt1, $rate1, $wgt2, $rate2, $add_wgt, $add_rate, $gst, $rate_id,$cal_type){
		//-----Initiate Varibles
		$my_amount=0;
		$my_wht=0;
		$f_wht=0;
		$total_wht=0;
		$my_gst=0;
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
        else if($wgt > $add_wgt && $cal_type!="Multiplication"){
		$my_wht 	 = $wgt - $wgt2;
		$f_wht 		 = ceil(($my_wht) /  ($add_wgt));
		$total_wht 	 =  $add_rate * $f_wht;
        $my_amount 	 = $rate2 + $total_wht; }
        else if($wgt > $add_wgt && $cal_type=="Multiplication" ){
        $wgt = ceil($wgt);    
        $my_amount 	 = $add_rate * $wgt;
        }
        //END---Order Weight Above Weight2 (Additonal Rate)	
         //------GST Calculation 
        $sum=$my_amount;
        $my_gst=round(((($sum)*($gst))/100),2);
        //END---GST Calculation
        $arr= array(
        'my_amount'			=> $my_amount,
		'my_wht'			=> $my_wht,
		'f_wht'				=> $f_wht,
		'total_wht'			=> $total_wht,
		'my_gst'			=> $my_gst,
		'my_rate_id'		=> $rate_id);
        return json_encode($arr);

	}
	  
    public function cal_all_rating(){
        $customer=$this->Commonmodel->Get_all_record('saimtech_customer'); 
        if(!empty($customer)){
        foreach($customer as $rows){
        $this->rating($rows->customer_id);
        echo("<br>".$rows->customer_name." Rating Done");
        }    
        }
        }
        
    
    public function new_zone_rating_module($rate_id,$wgt,$dest_zone){
    $origin_region="";
    $dest_zone=$dest_zone;
    $calcu="";
    //-------------
    //-------------Get Zone By (Destination)City ID
    $zone_rate_data=$this->Commonmodel->Get_record_by_condition_array('saimtech_rate', 'rate_id', $rate_id);
    if(!empty($zone_rate_data)){
    $rate_id=$zone_rate_data[0]['rate_id'];    
    //=A============Zone A
    $zone_a_wgt1=$zone_rate_data[0]['sc_wgt1'];	
    $zone_a_wgt2=$zone_rate_data[0]['sc_wgt2'];	
    $zone_a_add_wgt=$zone_rate_data[0]['sc_add_wgt'];	
    $zone_a_rate1=$zone_rate_data[0]['sc_rate1'];	
    $zone_a_rate2=$zone_rate_data[0]['sc_rate2'];
    $zone_a_add_rate=$zone_rate_data[0]['sc_add_rate'];
    $zone_a_gst=$zone_rate_data[0]['sc_gst_rate'];
    if($dest_zone=="A"){
    $zone_A=$this->calculate_rate($wgt,$zone_a_wgt1, $zone_a_rate1, $zone_a_wgt2, $zone_a_rate2, $zone_a_add_wgt, $zone_a_add_rate, $zone_a_gst, $rate_id);
    $calcu=json_decode($zone_A);
    }
	//=A============END
    //=B============Zone B
    $zone_b_wgt1=$zone_rate_data[0]['sz_wgt1'];	
    $zone_b_wgt2=$zone_rate_data[0]['sz_wgt2'];	
    $zone_b_add_wgt=$zone_rate_data[0]['sz_add_wgt'];	
    $zone_b_rate1=$zone_rate_data[0]['sz_rate1'];	
    $zone_b_rate2=$zone_rate_data[0]['sz_rate2'];
    $zone_b_add_rate=$zone_rate_data[0]['sz_add_rate'];
    $zone_b_gst=$zone_rate_data[0]['sz_gst_rate'];
    if($dest_zone=="B"){
    $zone_B=$this->calculate_rate($wgt,$zone_b_wgt1, $zone_b_rate1, $zone_b_wgt2, $zone_b_rate2, $zone_b_add_wgt, $zone_b_add_rate, $zone_b_gst, $rate_id);
    $calcu=json_decode($zone_B);
    }
	//=B============END
	//=C============Zone C
	$zone_c_wgt1=$zone_rate_data[0]['dz_wgt1'];	
    $zone_c_wgt2=$zone_rate_data[0]['dz_wgt2'];	
    $zone_c_add_wgt=$zone_rate_data[0]['dz_add_wgt'];	
    $zone_c_rate1=$zone_rate_data[0]['dz_rate1'];	
    $zone_c_rate2=$zone_rate_data[0]['dz_rate2'];
    $zone_c_add_rate=$zone_rate_data[0]['dz_add_rate'];
    $zone_c_gst=$zone_rate_data[0]['dz_gst_rate'];
    if($dest_zone=="C"){
    $zone_C=$this->calculate_rate($wgt,$zone_c_wgt1, $zone_c_rate1, $zone_c_wgt2, $zone_c_rate2, $zone_c_add_wgt, $zone_c_add_rate, $zone_c_gst, $rate_id);
    $calcu=json_decode($zone_C);
    }
	//=C============END
	//=D============Zone D
	$zone_d_wgt1=$zone_rate_data[0]['zz_wgt1'];	
    $zone_d_wgt2=$zone_rate_data[0]['zz_wgt2'];	
    $zone_d_add_wgt=$zone_rate_data[0]['zz_add_wgt'];	
    $zone_d_rate1=$zone_rate_data[0]['zz_rate1'];	
    $zone_d_rate2=$zone_rate_data[0]['zz_rate2'];
    $zone_d_add_rate=$zone_rate_data[0]['zz_add_rate'];
    $zone_d_gst=$zone_rate_data[0]['zz_gst_rate'];
    if($dest_zone=="D"){
    $zone_D=$this->calculate_rate($wgt,$zone_d_wgt1, $zone_d_rate1, $zone_d_wgt2, $zone_d_rate2, $zone_d_add_wgt, $zone_d_add_rate, $zone_d_gst, $rate_id);
    $calcu=json_decode($zone_D);
    }
	//=D============END
    } else {echo("|ZR|Something Went Wrong."); } 
    return $calcu;
    }
    
    public function new_destination_rating_module($rate_id,$wgt){
    $calcu=0;
    $rate_detail=$this->Commonmodel->Get_record_by_condition_array('saimtech_destination_rate', 'dest_rate_id', $rate_id);
    if(!empty($rate_detail)){
    $calcu=$this->calculate_rate($wgt,$rate_detail[0]['city_wgt1'], $rate_detail[0]['city_rate1'], $rate_detail[0]['city_wgt2'], $rate_detail[0]['city_rate2'], $rate_detail[0]['city_add_wgt'], $rate_detail[0]['city_add_rate'], $rate_detail[0]['city_gst'], $rate_id);    
    $calcu=json_decode($calcu);
    }    
    return $calcu;
    }


    public function zone_wise_rating_full($origin_city_id,$destination_city_id,$customer_id,$service_type_id,$wgt,$cal_type){
    $origin_region="";
    $dest_zone="";
    $calcu="";
    //-------------Get Region By (Origin)City ID    
    $origin_region_data=$this->Commonmodel->Get_record_by_condition_array('saimtech_city', 'city_id', $origin_city_id);
    if(!empty($origin_region_data)){
    $origin_region=$origin_region_data[0]['mixture'];    
    //-------------
    //-------------Get Zone By (Destination)City ID
    $query="SELECT ".$origin_region." FROM `saimtech_city` WHERE `city_id`=".$destination_city_id;
    $dest_zone_data=$this->Commonmodel->Custom_Query_Array($query);
    if(!empty($dest_zone_data)){
    $dest_zone=$dest_zone_data[0][$origin_region];    
    //$zone_rate_data=$this->Commonmodel->Get_record_by_condition_double_array('saimtech_rate', 'customer_id', $customer_id, 'service_id' ,$service_type_id);
    $zone_rate_data=$this->Commonmodel->Get_record_by_triple_condition('saimtech_rate', 'customer_id', $customer_id, 'service_id' ,$service_type_id,'is_enable', '1');
    if(!empty($zone_rate_data)){
    $rate_id=$zone_rate_data[0]['rate_id'];    
    //SELECT `rate_id`, `customer_id`, `service_id`, `sc_wgt1`, `sc_rate1`, `sc_wgt2`, `sc_rate2`, `sc_add_wgt`, `sc_add_rate`, `sc_gst_rate`, `sc_fuel_formula`, `sc_fuel_rate`, `sc_sp_handling_formula`, `sc_sp_handling_rate`, `sc_return_formula`, `sc_return_rate`, `sz_wgt1`, `sz_rate1`, `sz_wgt2`, `sz_rate2`, `sz_add_wgt`, `sz_add_rate`, `sz_gst_rate`, `sz_fuel_formula`, `sz_fuel_rate`, `sz_sp_handling_formula`, `sz_sp_handling_rate`, `sz_return_formula`, `sz_return_rate`, `dz_wgt1`, `dz_rate1`, `dz_wgt2`, `dz_rate2`, `dz_add_wgt`, `dz_add_rate`, `dz_fuel_formula`, `dz_fuel_rate`, `dz_sp_handling_formula`, `dz_sp_handling_rate`, `dz_gst_rate`, `dz_return_formula`, `dz_return_rate`, `zz_wgt1`, `zz_rate1`, `zz_wgt2`, `zz_rate2`, `zz_add_wgt`, `zz_add_rate`, `zz_fuel_formula`, `zz_fuel_rate`, `zz_sp_handling_formula`, `zz_sp_handling_rate`, `zz_gst_rate`, `zz_return_formula`, `zz_return_rate`, `cash_handling_formula`, `cash_handling_rate`, `reference_formula`, `reference_rate`, `flyer_rate`, `is_enable`, `deactive_date`, `delete_date`, `created_by`, `created_date`, `modify_by`, `modify_date`, `timestamp` FROM `saimtech_rate`
    //=A============Zone A
    $zone_a_wgt1=$zone_rate_data[0]['sc_wgt1'];	
    $zone_a_wgt2=$zone_rate_data[0]['sc_wgt2'];	
    $zone_a_add_wgt=$zone_rate_data[0]['sc_add_wgt'];	
    $zone_a_rate1=$zone_rate_data[0]['sc_rate1'];	
    $zone_a_rate2=$zone_rate_data[0]['sc_rate2'];
    $zone_a_add_rate=$zone_rate_data[0]['sc_add_rate'];
    $zone_a_gst=$zone_rate_data[0]['sc_gst_rate'];
    if($dest_zone=="A"){
    $zone_A=$this->calculate_rate($wgt,$zone_a_wgt1, $zone_a_rate1, $zone_a_wgt2, $zone_a_rate2, $zone_a_add_wgt, $zone_a_add_rate, $zone_a_gst, $rate_id,$cal_type);
    $calcu=json_decode($zone_A);
    }
	//=A============END
    //=B============Zone B
    $zone_b_wgt1=$zone_rate_data[0]['sz_wgt1'];	
    $zone_b_wgt2=$zone_rate_data[0]['sz_wgt2'];	
    $zone_b_add_wgt=$zone_rate_data[0]['sz_add_wgt'];	
    $zone_b_rate1=$zone_rate_data[0]['sz_rate1'];	
    $zone_b_rate2=$zone_rate_data[0]['sz_rate2'];
    $zone_b_add_rate=$zone_rate_data[0]['sz_add_rate'];
    $zone_b_gst=$zone_rate_data[0]['sz_gst_rate'];
    if($dest_zone=="B"){
    $zone_B=$this->calculate_rate($wgt,$zone_b_wgt1, $zone_b_rate1, $zone_b_wgt2, $zone_b_rate2, $zone_b_add_wgt, $zone_b_add_rate, $zone_b_gst, $rate_id,$cal_type);
    $calcu=json_decode($zone_B);
    }
	//=B============END
	//=C============Zone C
	$zone_c_wgt1=$zone_rate_data[0]['dz_wgt1'];	
    $zone_c_wgt2=$zone_rate_data[0]['dz_wgt2'];	
    $zone_c_add_wgt=$zone_rate_data[0]['dz_add_wgt'];	
    $zone_c_rate1=$zone_rate_data[0]['dz_rate1'];	
    $zone_c_rate2=$zone_rate_data[0]['dz_rate2'];
    $zone_c_add_rate=$zone_rate_data[0]['dz_add_rate'];
    $zone_c_gst=$zone_rate_data[0]['dz_gst_rate'];
    if($dest_zone=="C"){
    $zone_C=$this->calculate_rate($wgt,$zone_c_wgt1, $zone_c_rate1, $zone_c_wgt2, $zone_c_rate2, $zone_c_add_wgt, $zone_c_add_rate, $zone_c_gst, $rate_id,$cal_type);
    $calcu=json_decode($zone_C);
    }
	//=C============END
	//=D============Zone D
	$zone_d_wgt1=$zone_rate_data[0]['zz_wgt1'];	
    $zone_d_wgt2=$zone_rate_data[0]['zz_wgt2'];	
    $zone_d_add_wgt=$zone_rate_data[0]['zz_add_wgt'];	
    $zone_d_rate1=$zone_rate_data[0]['zz_rate1'];	
    $zone_d_rate2=$zone_rate_data[0]['zz_rate2'];
    $zone_d_add_rate=$zone_rate_data[0]['zz_add_rate'];
    $zone_d_gst=$zone_rate_data[0]['zz_gst_rate'];
    if($dest_zone=="D"){
    $zone_D=$this->calculate_rate($wgt,$zone_d_wgt1, $zone_d_rate1, $zone_d_wgt2, $zone_d_rate2, $zone_d_add_wgt, $zone_d_add_rate, $zone_d_gst, $rate_id,$cal_type);
    $calcu=json_decode($zone_D);
    }
	//=D============END
    } else {echo("|ZR|Something Went Wrong."); } 
    } else {echo("|Z|Something Went Wrong."); }    
    } else {echo("|R|Something Went Wrong.");}
    return $calcu;    
    }
    
    
    public function destination_wise_rating_full($origin_city_id,$destination_city_id,$customer_id,$service_id,$wgt,$cal_type){
    $calcu=0;
    $check=$this->Commonmodel->five_double_check('saimtech_destination_rate', 'service_id', $service_id, 'customer_id', $customer_id, 'origin_city_id', $origin_city_id, 'dest_city_id', $destination_city_id, 'is_enable', '1');
    if($check>0){
    $rate_detail=$this->Commonmodel->Get_record_by_five_condition('saimtech_destination_rate', 'service_id', $service_id, 'customer_id', $customer_id, 'origin_city_id', $origin_city_id, 'dest_city_id', $destination_city_id, 'is_enable', '1');
    //SELECT `dest_rate_id`, `customer_id`, `service_id`, `origin_city_id`, `dest_city_id`, `city_wgt1`, `city_rate1`, `city_wgt2`, `city_rate2`, `city_add_wgt`, `city_add_rate`, `is_enable`, `created_by`, `created_date`, `modify_by`, `modify_date` FROM `saimtech_destination_rate` WHERE 1
    if(!empty($rate_detail)){
    $calcu=$this->calculate_rate($wgt,$rate_detail[0]['city_wgt1'], $rate_detail[0]['city_rate1'], $rate_detail[0]['city_wgt2'], $rate_detail[0]['city_rate2'], $rate_detail[0]['city_add_wgt'], $rate_detail[0]['city_add_rate'], $rate_detail[0]['city_gst'], $rate_detail[0]['dest_rate_id'],$cal_type);    
    $calcu=json_decode($calcu);}}
    return $calcu;    
    }

    public function rating_0($customer_id){
	//$this->Commonmodel->Update_Rate_Type();
	$rate_id                        = 0;
	$rate_type                      ="";
	$o_weight                       = "";//---Order Weight
	$cash_limit                     = 10000000;   
	$cod                            = "";
	$order_id                       = 0;
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
	//------------------------------------------------    
	//$rate_detail=$this->Commonmodel->Get_record_by_triple_condition('saimtech_ratess', 'customer_id', $customer_id, 'service_id', $ship_type, 'is_enable', 1);
	$customer_data=$this->Commonmodel->Get_record_by_condition_array('saimtech_customer', 'customer_id', $customer_id);
    $cal_type=$customer_data[0]['cal_type'];
	$order_detail=$this->Commonmodel->Get_record_by_double_condition('saimtech_order', 'customer_id', $customer_id,'rate_id',0);
	echo "<pre>";print_r($order_detail);
	if(!empty($order_detail)){
	foreach($order_detail as $rows){
	$ratee_id                       = $rows->rate_id;
	$o_weight                       = $rows->weight;
	$cash_limit                     = 10000000;   
	$cod                            = $rows->cod_amount;
	$order_id                       = $rows->order_id;
	$rate_type                      = $rows->order_rate_type;
	$dest_zone                      = $rows->destination_zone;
	$d_city                         = $rows->destination_city;
    $o_city                         = $rows->origin_city;
    $ship_type                      = $rows->order_service_type;
//=END============Calculate Rate
	$calcu=$this->zone_wise_rating_full($o_city,$d_city,$customer_id,$ship_type,$o_weight,$cal_type);
	$order_rate 					= 0;
	$order_add_rate 				= 0;
	$order_gst 						= $calcu->my_gst;
	$order_sc 						= $calcu->my_amount;
	$order_sp_handling_rate 		= 0;
	$order_cash_handling_rate 		= 0;
	$order_fuel 					= 0;
	$order_flyer_rate 				= 0;
	$order_total_amount_with_flyer 	= 0;
	$order_total_amount 			= (($order_gst) + ($order_sc));
	$rate_type                      ='ZW';
	$rate_id                        = $calcu->my_rate_id;
	echo $dcheck=$this->Commonmodel->five_double_check('saimtech_destination_rate', 'service_id', $ship_type, 'customer_id', $customer_id, 'origin_city_id', $o_city, 'dest_city_id', $d_city, 'is_enable', '1');
	if($dcheck!=0){
	$calcu2=$this->destination_wise_rating_full($o_city,$d_city,$customer_id,$ship_type,$o_weight,$cal_type);
	$order_rate 					= 0;
	$order_add_rate 				= 0;
	$order_gst 						= $calcu2->my_gst;
	$order_sc 						= $calcu2->my_amount;
	$order_sp_handling_rate 		= 0;
	$order_cash_handling_rate 		= 0;
	$order_fuel 					= 0;
	$order_flyer_rate 				= 0;
	$order_total_amount_with_flyer 	= 0;
	$order_total_amount 			= (($order_gst) + ($order_sc));
	$rate_type                      ='DW';
	$rate_id                        = $calcu2->my_rate_id;    
	}
 
	$data = array(
	'order_rate'					=>	$order_rate,
	'order_rate_type'				=>	$rate_type,
	'order_add_rate'				=>	$order_add_rate,
	'order_gst'						=>	$order_gst,
	'order_sc'						=>	$order_sc,
	'order_sp_handling_rate'		=>	$order_sp_handling_rate,
	'order_cash_handling_rate'		=>  $order_cash_handling_rate,
	'order_fuel'					=>	$order_fuel,
	'order_flyer_rate'				=>	$order_flyer_rate,
	'order_total_amount_with_flyer' =>  $order_total_amount_with_flyer,
	'order_total_amount'            =>  $order_total_amount,
	'rate_id'                       =>  $rate_id 
	);
	$this->Commonmodel->Update_record('saimtech_order', 'order_id', $order_id, $data);
	//redirect('Rate');
	} 
	} else {echo "Something Went Wrong";    }
	}
	
}
