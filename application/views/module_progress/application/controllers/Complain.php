<?php

class Complain extends CI_Controller {
    
	function __construct() {
    parent::__construct();
    $this->load->model('Commonmodel');
    $this->load->model('Complainmodel');
    }
    public function index(){
    $data['success_msg']="";    
    $data['nature_data']=$this->Complainmodel->Get_All_Complain_Nature();
    $this->load->view('complainView',$data);
 }
    public function Complain_type_By_Nature_Id(){
      //echo"<pre>";print_r("ok");echo"</pre>";  
	$nature_id=$this->input->post('nature');
	$complain_type=$this->Complainmodel->Get_Complain_type_By_Nature_Id($nature_id);
    echo "<option value='' >Select Type</option>"; 
 	foreach($complain_type as $rows){
 	echo "<option value='".$rows->type_id."'>".$rows->type_name."</option>";
	}
	}
	public function Insert_Complain(){
	$cn_no=$this->input->post('cn_no');
	$nature_id=$this->input->post('nature');
	$types_id=$this->input->post('types');
	$name=$this->input->post('name');
	$number=$this->input->post('number');
	$remarks=$this->input->post('remarks');
	$user_id = -1;
	$assign_to = -1;
	$date=date('Y-m-d');
	$chk=$this->Complainmodel->Duplicate_double_check('saimtech_complain', 'cn', $cn_no,'is_complete',0);	
	$data_array= array();
	$data_array['ticket_no']        =$chk[0]['ticket_no'];
	if($chk!=[]){
	    $this->session->set_flashdata('error','You already have a complain! </br> Ticket#: '.$data_array['ticket_no']);
	    redirect('Complain/index');
	}
	elseif($cn_no!="" && $nature_id!="" && $types_id!="" && $name!="" && $number!=""  && $user_id!="" && $date!=""){
	    	$data = array(
		 	'cn' 			 => $cn_no, 
		 	'nature_id' 		 => $nature_id, 
		 	'type_id' 	 => $types_id, 
		 	'complainant_name'=> $name, 
		 	'complainant_phone' 	 => $number, 
		 	'complainant_remarks'			 =>	$remarks,
		 	'date'			 =>	$date,
		 	'status'			 =>	'Pending',
		 	'is_complete'	 =>	0,
		 	'created_by' 		 => $user_id,
		 	'assign_to'           => $assign_to);	
		 	 $detail_id=$this->Complainmodel->Insert_record('saimtech_complain', $data);
		 	 $ticket_no =2000 +$detail_id;
		 	 $this->Complainmodel->update_complain_ticket_by_id($detail_id,$ticket_no);
		 	 $this->session->set_flashdata('success','Complain Registered Successfully!</br><code>Ticket# '.$ticket_no.'</code>');
	         redirect('Complain/index');
	}
	else {
	echo("<tr><td><p class='alert alert-danger'>Something Went Wrong Please Try Again :(</p></td><td></td><td></td><td></td></tr>");
	 }

	}
	

     
}
?>