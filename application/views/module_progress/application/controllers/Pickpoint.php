<?php


class Pickpoint extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Pickmodel');
    }


	public function index(){
	$data['sub_nav_active']="PickUP";
	$data['nav_active']="PickUP";	
	$data['event_name']="Mange PickUP";
	$cid=$_SESSION['customer_id'];
	$data['pick_up_point']=$this->Pickmodel->Get_Pickup_Points_By_Customer_id($cid);
	$data['pick_up_cities']=$this->Pickmodel->Get_Pickup_Cities();
	$data['pick_up_count']=$this->Pickmodel->Count_pickup_points($cid);
	$this->load->view('module_pickup/pickView',$data);	
	}
	
	
	public function add_new_record(){
	$name 	 	= $this->input->post('name');
	$phone	 	= $this->input->post('phone');
	$email	 	= $this->input->post('email');
	$city_id 	= $this->input->post('city_id');
	$address 	= $this->input->post('address');
	$map_url  	= $this->input->post('url');
	$customer_id= $_SESSION['customer_id'];
	$msg	= "";
	$pick_up_count=$this->Pickmodel->Count_pickup_points($customer_id);
	$pick_up_limit=$_SESSION['pickup_points'];
	if($name!="" && $phone!="" && $city_id!="" && $address!="" && $customer_id!=""){
	$check=$this->Pickmodel->Duplicate_Pick_Point_Check($city_id,$address,$customer_id);
	$country_id=$this->Pickmodel->Get_country_id_by_city_id($city_id);	  
	if($check==0){
	$data = array(
	'point' 					=> $address,
	'name' 						=> $name,
	'phone' 					=> $phone,
	'email'						=> $email,
	'city_id'					=> $city_id,
	'country_id'				=> $country_id,
 	'google_map_url' 			=> $map_url,
	'is_enable' 				=> 1,	
	'is_del_enable' 			=> 0,
	'customer_id' 				=> $customer_id,
	'created_by'				=> 1,
	'created_date' 				=> date("Y-m-d h:i:sa") );
	if($pick_up_count<$pick_up_limit){
    $id=$this->Commonmodel->Insert_record("saimtech_pickup_points", $data);	
	$msg="<p class='alert alert-success'>Data Save successfully</p>";
	} else { $msg="<p class='alert alert-danger'><strong>Limit Reached !</strong> Your pick up points limit is ".$_SESSION['pickup_points'].".</p>"; }		
	} else { $msg="<p class='alert alert-warning'><strong>Duplicate Error!</strong> Already save in data base.</p>";	}	
	} else { $msg="<p class='alert alert-danger'><strong>Missing Error !</strong> Something is missing please try again.</p>";}	
	 $response=array(
	 'notification'=> $msg
	 );
	 echo json_encode($response);
	}

	
	public function redraw_table(){
	$cid=$_SESSION['customer_id'];	
	$pick_up_point=$this->Pickmodel->Get_Pickup_Points_By_Customer_id($cid);
	if(!empty($pick_up_point)){
    foreach($pick_up_point as $rows){
    $cstatus=$rows->enable;
    echo("<tr>");
    echo("<td>".$rows->name."</td>");
    echo("<td>".$rows->phone."</td>");
    echo("<td>".$rows->email."</td>");
    echo("<td>".$rows->point."</td>");
    echo("<td>".$rows->city_name."</td>");
    if($rows->google_map_url!=""){
    echo("<td><a href='".$rows->google_map_url."'>View</a></td>");
    } else { echo("<td><code>N/A</code></td>");}
    if($cstatus==0){
    echo("<td><a href='".base_url()."Pickpoint/delete_pickup/".$rows->points_id."'  class='btn btn-xs btn-danger'>Delete</a> <a href='".base_url()."Pickpoint/update_pickup/".$rows->points_id."/0'   class='btn btn-xs  btn-default'>Block</a></td>"); 
    } else {
    echo("<td><a href='".base_url()."Pickpoint/delete_pickup/".$rows->points_id."'  class='btn btn-xs btn-danger'>Delete</a> <a href='".base_url()."Pickpoint/update_pickup/".$rows->points_id."/1'   class='btn btn-xs  btn-default'>Active</a></td>"); 	
    } 
    echo("</tr>"); 
    }
    } 
	}

	public function delete_pickup($pick_id){
	if($pick_id!=""){	
	$pcount=$this->Pickmodel->Get_pickup_count_from_orders($pick_id);	
	if($pcount==0){
	$this->Commonmodel->Delete_record('saimtech_pickup_points', 'points_id', $pick_id);	
	} else {
	$data= array('is_del_enable'=>1);	
	$this->Commonmodel->Update_record('saimtech_pickup_points', 'points_id', $pick_id, $data);
	}
	}
	redirect('Pickpoint');
	}

	public function update_pickup($pick_id,$status){
	if($pick_id!="" && $status!=""){		
	$data= array('is_enable'=>$status);	
	$this->Commonmodel->Update_record('saimtech_pickup_points', 'points_id', $pick_id, $data);
	}
	redirect('Pickpoint');	
	}


	


	


	
	
}
