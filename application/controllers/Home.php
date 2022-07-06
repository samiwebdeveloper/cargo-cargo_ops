<?php


class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Qsrmodel');
		$this->load->model('Commonmodel');
		$this->load->model('AddUserModel');
		//$this->load->model('Pickmodel');
		//$this->load->model('Bookingmodel');
	}


	public function index()
	{
		//$this->Commonmodel->Seprate_Tm_Cities();    

		/* $root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    if($root=="https"){ 
    //-------------PERMISSONS------------------
    
	} else if($root=="http"){
    // header('Location: https://cargo.tmcargoexpress.com/ops_tm/Home');   
    header('Location: http://localhost:88/cargo/ops_tm/Home');    
    // header('Location: http://localhost:88/cargo/ops_tm/Home/');    


    }*/

		if ($_SESSION['user_power'] != "SE" && $_SESSION['user_power'] != "TM" && $_SESSION['user_power'] != "TP" && $_SESSION['user_power'] != "SM" && $_SESSION['user_power'] != "TPT" && $_SESSION['user_power'] != "RIDER" && $_SESSION['user_power'] != "Accounts" && $_SESSION['user_power'] != "CS") {
			// $data['pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Branch($_SESSION['origin_id']);
			// $data['incomming_pendings_count']=$this->Qsrmodel->Get_Incomming_Pendings_By_Orgin($_SESSION['origin_id']);
			//$data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_Orgin_Count($_SESSION['origin_id']);
			//$data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_Orgin_Count($_SESSION['origin_id']);
		} else  if ($_SESSION['user_power'] == "SE") {
			$data['pending_data'] = $this->Qsrmodel->Get_Pending_Shipments_admin();
			
			//$data['incomming_pendings_count']=$this->Qsrmodel->Get_Incomming_Pendings_By_Admin();
			//$data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_Admin_Count();
			// $data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_Admin_Count();
		} else  if ($_SESSION['user_power'] == "CS") {
			$data['pending_data'] = $this->Qsrmodel->Get_Pending_Shipments_admin();
			//$data['incomming_pendings_count']=$this->Qsrmodel->Get_Incomming_Pendings_By_Admin();
			//$data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_Admin_Count();
			// $data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_Admin_Count();
		} else  if ($_SESSION['user_power'] == "TM") {
			redirect('Importfile');
		} else  if ($_SESSION['user_power'] == "TP") {
			redirect('Agent');
		} else if ($_SESSION['user_power'] == "SM") {
			// $data['pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Sale($_SESSION['user_id']);
			//$data['incomming_pendings_count']=$this->Qsrmodel->Get_Incomming_Pendings_By_Sale($_SESSION['user_id']);
			// $data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_Sale_Count($_SESSION['user_id']);
			// $data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_Sale_Count($_SESSION['user_id']);
		} else  if ($_SESSION['user_power'] == "TPT") {
			redirect('Home/TPT');
		} else  if ($_SESSION['user_power'] == "Accounts") {
			redirect('invoice/unpaid_cn_all');
		} else  if ($_SESSION['user_power'] == "RIDER") {
			redirect('Delivery2');
		}

		//-------------PERMISSONS------------------	   
		$this->load->view('dashboardView', $data);
	}



	public function TPT()
	{
		$root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
		if ($root == "https") {
			// $data['pending_data']=$this->Qsrmodel->Get_TPT_Pending_Shipments($_SESSION['thrid_party_id']);
			// $data['incomming_pendings_count']="";
			//$data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_TPT_Count($_SESSION['user_id']);
			// $data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_TPT_Count($_SESSION['thrid_party_id']);
			// $this->load->view('dashboardTPTView', $data);
			$this->load->view('dashboardTPTView');
		} else if ($root == "http") {
			header('Location: https://tmdelex.com/cargo/ops_tm/Home');
		}
	}

	public function sm()
	{
		$root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
		if ($root == "https") {
			//-------------PERMISSONS------------------
			if ($_SESSION['user_power'] == "SM") {
				// $data['pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Sale($_SESSION['user_id']);
				//$data['incomming_pendings_count']=$this->Qsrmodel->Get_Incomming_Pendings_By_Sale($_SESSION['user_id']);
				//$data['pendings_dd_count']=$this->Qsrmodel->Get_Pendings_DD_By_Sale_Count($_SESSION['user_id']);
				//$data['pendings_pickup_count']=$this->Qsrmodel->Get_Pendings_Pickup_By_Sale_Count($_SESSION['user_id']);
			}
			//-------------PERMISSONS------------------	   
			$this->load->view('dashboardView');
		} else if ($root == "http") {
			header('Location: https://tmdelex.com/cargo/ops_tm/Home/sm');
		}
	}


	//public function branch_pending(){
	//	$data['pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Branch($_SESSION['origin_id']);	
	//	$data['summary_pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Branch_Summary($_SESSION['origin_id']);	
	//	$this->load->view('module_pending/brnachpendingView',$data);	
	//	}


	//	public function admin_pending(){
	//	$data['pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Admin();	
	//	$data['summary_pending_data']=$this->Qsrmodel->Get_Pending_Shipments_Admin_Summary();	
	//	$this->load->view('module_pending/adminpendingView',$data);	
	//	}

	public function branch_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsrbranchView', $data);
	}
	//-------------------Admin QSR--------------------------------------------------	
	public function admin_qsr()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsradminView', $data);
	}
	//-------------------SuperAdmin QSR--------------------------------------------------	
	public function super_admin_qsr()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/superqsrView', $data);
	}
	//-------------------CS QSR--------------------------------------------------	
	public function cs_qsr()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsrcsView', $data);
	}

	//-------------------Booking-Arrival QSR--------------------------------------------------	
	public function booking_qsr()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsrbookingView', $data);
	}
	//-------------------Booking-Arrival QSR--------------------------------------------------	
	public function manifest_report_qsr()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsrmanifestreportView', $data);
	}

	//-------------------DEO QSR----------------------------------------------------	
	public function admin_qsr1()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsradmin1View', $data);
	}

	public function admin_pending()
	{
		$data['qsr_data'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$data['start_date'] = "";
		$data['customer_id'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsrpendingView', $data);
	}
	//-------------------OPS QSR----------------------------------------------------
	//-------------------Complete QSR----------------------------------------------------
	public function complete_qsr()
	{
		// $data['qsr_data']="";	
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		// $data['start_date']="";	
		// $data['customer_id']="";	
		// $data['end_date']="";
		// $data['msg']="";	
		$this->load->view('module_qsr/completeqsrView', $data);
	}
	//-------------------Complete QSR End----------------------------------------------------	
	public function old_branch_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsroldbranchView', $data);
	}


	public function old_admin_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$this->load->view('module_qsr/qsroldadminView', $data);
	}


	public function submit_branch_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');

		if ($start_date != "" && $end_date != "") {
			$data['msg'] = "";
			$qsr_data = $this->Qsrmodel->Get_Shipments_Branch($_SESSION['origin_id'], $start_date, $end_date);
			$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Branch_Archive($_SESSION['origin_id'], $start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Branch_Summary($_SESSION['origin_id'], $start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Branch_Summary_Archive($_SESSION['origin_id'], $start_date, $end_date);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		$this->load->view('module_qsr/qsrbranchView', $data);
	}


	public function submit_old_branch_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		if ($start_date != "" && $end_date != "") {
			$data['msg'] = "";
			$data['qsr_data'] = $this->Qsrmodel->Get_Shipments_Branch_Old($_SESSION['origin_name'], $start_date, $end_date);
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Branch_Summary_Old($_SESSION['origin_name'], $start_date, $end_date);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		$this->load->view('module_qsr/qsroldbranchView', $data);
	}

	public function submit_admin_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Tm($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Customer_Tm($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary($start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/qsradminView', $data);
	}

	//-----------------------        	
	public function submit_booking_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		if ($start_date != "" && $end_date != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Booking_difference($start_date, $end_date);
			}
			$data['qsr_data'] = array_merge($qsr_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		$this->load->view('module_qsr/qsrbookingView', $data);
	}
	//-----------------------------------------------------------------------------    
	//-----------------------        	
	public function submit_manifest_report_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		if ($start_date != "" && $end_date != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Manifest_difference($start_date, $end_date);
			}
			$data['qsr_data'] = array_merge($qsr_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		$this->load->view('module_qsr/qsrmanifestreportView', $data);
	}
	//-----------------------------------------------------------------------------    
	public function qsr_report()
	{
		$pagelimit = $_POST['company_data'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
//   echo$pagelimit.$start_date.$end_date;
//  exit;
		$data = $this->AddUserModel->qsr_report_record($pagelimit,$start_date,$end_date);
		$i = 1;
		foreach ($data as $row) {	
			echo ("<tr>");
			echo ("<td>" . $i . "</td>");
			echo ("<td>" . $row->customer_name . "</td>");
			echo ("<td>" . $row->order_code . "</td>");
			echo ("<td>" . $row->manual_cn . "</td>");
			echo ("<td>" . $row->order_date . "</td>");
			echo ("<td>" . $row->order_booking_date . "</td>");
			echo ("<td>" . $row->order_status . "</td>");
			echo ("<td>" . $row->shipment_received_by . "</td>");
			echo ("<td>" . $row->shipper_name . "</td>");
			echo ("<td>" . $row->consignee_name . "</td>");
			echo ("<td>" . $row->consignee_mobile . "</td>");
			echo ("<td>" . $row->consignee_address . "</td>");
			echo ("<td>" . $row->origin_city_name . "</td>");
			echo ("<td>" . $row->destination_city_name . "</td>");
			echo ("<td>" . $row->pieces . "</td>");
			echo ("<td>" . $row->weight . "</td>");
			echo ("<td>" . $row->order_sc . "</td>");
			echo ("<td>" . number_format($row->cod_amount) . "</td>");
			echo ("<td>" . $row->order_pay_mode . "</td>");
			echo ("<td>" . $row->loading_id . "</td>");
			echo ("<td>" . $row->on_route_id . "</td>");
			echo ("<td>" . $row->rider . "</td>");
			echo ("<td>" . $row->service_name . "</td>");
			echo ("<td>" . $row->product_detail . "</td>");
			echo ("<td>" . $row->order_arrival_date . "</td>");
			echo ("<td>" . $row->order_deliver_date . "</td>");
			echo ("<td>" . $row->createdby . "</td>");
			echo ("</tr>");
			$i++;
			
		}
		$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
		<strong>Successfully!</strong> Records Update.
		<button type="button" class="close" data-dismiss="alert">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>');

		}

	public function submit_super_qsr()
	{
		
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');

		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
			
				// exit;
				$qsr_data = $this->Qsrmodel->Get_Shipments_Super_Tm($start_date, $end_date);

				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
				 
			} else {

				$qsr_data = $this->Qsrmodel->Get_Shipments_Super_Customer_Tm($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			//$data['summary_customer_qsr_data']=$this->Qsrmodel->Get_Shipments_Admin_Customer_Summary($start_date,$end_date,$customer);
			$data['cs_summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_CS_Summary($start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/superqsrView', $data);
	}
	//----------------------------------------------------------------	

	public function pending_record()
	{
		$pagelimit = $_POST['company_data'];
		$data = $this->Qsrmodel->display_pending_record($pagelimit);
		$i = 1;
		foreach ($data as $row) {
			echo ("<tr>");
			echo ("<td>" . $i . "</td>");
			echo ("<td>" . $row->customer_name . "</td>");
			echo ("<td>" . $row->order_code . "</td>");
			echo ("<td>" . $row->manual_cn . "</td>");
			echo ("<td>" . $row->order_status . "</td>");
			echo ("<td>" . $row->origin_city_name . "</td>");
			echo ("<td>" . $row->destination_city_name . "</td>");
			echo ("<td>" . $row->pieces . "</td>");
			echo ("<td>" . $row->weight . "</td>");
			echo ("<td>" . number_format($row->cod_amount) . "</td>");
			echo ("<td class='bg-danger text-white' style='box-shadow:5px 5px 10px #888888;'><center><h5 class='text-white'>" . $row->DOS . "<h5></center></td>");
			echo ("<td>" . $row->order_date . "</td>");
			echo ("<td>" . $row->order_booking_date . "</td>");
			echo ("<td>" . $row->order_arrival_date . "</td>");
			echo ("<td>" . $row->lastactivitydate . "</td>");
			echo ("</tr>");
		
			$i++;
		}
		}

	public function submit_cs_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_CS_Tm($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {

				$qsr_data = $this->Qsrmodel->Get_Shipments_CS_Customer_Tm($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			//$data['summary_customer_qsr_data']=$this->Qsrmodel->Get_Shipments_Admin_Customer_Summary($start_date,$end_date,$customer);
			$data['cs_summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_CS_Summary($start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/qsrcsView', $data);
	}

	

	public function submit_admin_qsr1()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Tm_DEO($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Customer_Tm_DEO($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary($start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/qsradmin1View', $data);
	}

	public function submit_pending_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Pending_Tm($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Pending_Customer_Tm($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			$data['pending_summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Pending_Summary($start_date, $end_date);
			//echo"<pre>";print_r($data['summary_qsr_data']);exit();
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/qsrpendingView', $data);
	}

	//-------------------------------------------------------------------
	public function submit_complete_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Complete_Qsr($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Complete_Qsr_Customer($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			$data['pending_summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_complete_Summary($start_date, $end_date);
			//echo"<pre>";print_r($data['summary_qsr_data']);exit();
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/completeqsrView', $data);
	}
	//-------------------------------------------------------------------



	public function submit_admin_opslhe()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$data['customer_id'] = "";
		$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		$customer    = $this->input->post('customer_id');
		if ($start_date != "" && $end_date != "" && $customer != "") {
			$data['msg'] = "";
			if ($customer == 0) {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Tm_OPS($start_date, $end_date);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Tm($start_date, $end_date);
			} else {
				$qsr_data = $this->Qsrmodel->Get_Shipments_Admin_Customer_Tm_OPS($start_date, $end_date, $customer);
				$qsr_archive_data = $this->Qsrmodel->Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer);
			}
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary($start_date, $end_date);
			$data['summary_archive_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_Archive($start_date, $end_date);
			$data['qsr_data'] = array_merge($qsr_data, $qsr_archive_data);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$data['customer_id'] = $customer;
			$data['customer_data'] = $this->Commonmodel->Get_all_record('saimtech_customer');
		}
		$this->load->view('module_qsr/qsropslheView', $data);
	}




	public function submit_old_admin_qsr()
	{
		$data['qsr_data'] = "";
		$data['start_date'] = "";
		$data['end_date'] = "";
		$data['msg'] = "";
		$start_date  = $this->input->post('start_date');
		$end_date    = $this->input->post('end_date');
		if ($start_date != "" && $end_date != "") {
			$data['msg'] = "";
			$data['qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Old($start_date, $end_date);
			$data['summary_qsr_data'] = $this->Qsrmodel->Get_Shipments_Admin_Summary_old($start_date, $end_date);
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		} else {
			$data['msg'] = "<p class='alert alert-danger'><strong>Something is Missing.</strong></p>";
			$data['qsr_data'] = "";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		$this->load->view('module_qsr/qsroldadminView', $data);
	}

	public function incoming_pending()
	{
		if ($_SESSION['user_power'] != "SE" && $_SESSION['user_power'] != "SM") {
			$data['incomming_pendings_data'] = $this->Qsrmodel->Get_Incomming_Pendings_By_Orgin_detail($_SESSION['origin_id']);
		} else if ($_SESSION['user_power'] == "SE") {
			$data['incomming_pendings_data'] = $this->Qsrmodel->Get_Incomming_Pendings_By_Admin_detail();
		} else if ($_SESSION['user_power'] == "SM") {
			$data['incomming_pendings_data'] = $this->Qsrmodel->Get_Incomming_Pendings_By_Sale_detail($_SESSION['user_id']);
		}
		$this->load->view('module_report/incomingpendingView', $data);
	}



	public function pending_sheets()
	{
		if ($_SESSION['user_power'] != "SE" && $_SESSION['user_power'] != "SM" && $_SESSION['user_power'] != "TPT") {
			$data['pending_sheets_data'] = $this->Qsrmodel->Get_Pendings_DD_By_Orgin_detail($_SESSION['origin_id']);
		} else if ($_SESSION['user_power'] == "SE") {
			$data['pending_sheets_data'] = $this->Qsrmodel->Get_Pendings_DD_By_Admin_detail();
		} else if ($_SESSION['user_power'] == "SM") {
			$data['pending_sheets_data'] = $this->Qsrmodel->Get_Pendings_DD_By_Sale_detail($_SESSION['user_id']);
		} else if ($_SESSION['user_power'] == "TPT") {
			$data['pending_sheets_data'] = $this->Qsrmodel->Get_Pendings_DD_By_TPT_detail($_SESSION['user_id']);
		}
		$this->load->view('module_report/pendingsheetView', $data);
	}
	public function pending_manifest_sheet()
	{
		if ($_SESSION['user_power'] = "SE" && $_SESSION['user_power'] != "SM" && $_SESSION['user_power'] != "TPT") {
			$data['pending_manifest_data'] = $this->Qsrmodel->Get_Pendings_Manifest_By_Orgin_detail($_SESSION['origin_id']);
		} // else if($_SESSION['user_power']=="SE"){
		//$data['pending_sheets_data']=$this->Qsrmodel->Get_Pendings_DD_By_Admin_detail();
		//} else if($_SESSION['user_power']=="SM"){
		//$data['pending_sheets_data']=$this->Qsrmodel->Get_Pendings_DD_By_Sale_detail($_SESSION['user_id']);
		//}  else if($_SESSION['user_power']=="TPT"){
		//$data['pending_sheets_data']=$this->Qsrmodel->Get_Pendings_DD_By_TPT_detail($_SESSION['user_id']);
		//}
		$this->load->view('module_report/pendingmanifestView', $data);
	}

	public function pending_pickups()
	{
		if ($_SESSION['user_power'] != "SE" && $_SESSION['user_power'] != "SM" && $_SESSION['user_power'] != "TPT") {
			$data['pending_pickups_data'] = $this->Qsrmodel->Get_Pendings_Pickup_By_Orgin_Detail($_SESSION['origin_id']);
			$this->load->view('module_report/pendingpickupView', $data);
		} else if ($_SESSION['user_power'] == "SE") {
			$data['pending_pickups_data'] = $this->Qsrmodel->Get_Pendings_Pickup_By_Admin_Detail();
			$this->load->view('module_report/pendingpickupView', $data);
		} else if ($_SESSION['user_power'] == "SM") {
			$data['pending_sheets_data'] = $this->Qsrmodel->Get_Pendings_Pickup_By_Sale_Detail($_SESSION['user_id']);
			$this->load->view('module_report/pendingpickupView', $data);
		} else if ($_SESSION['user_power'] == "TPT") {
			$data['pending_sheets'] = $this->Qsrmodel->Get_Pendings_Pickup_By_TPT_Detail($_SESSION['thrid_party_id']);
			$this->load->view('module_report/pendingpickupTPTView', $data);
		}
	}
function display_pending_record($pagelimit)
	{
		if ($pagelimit>1) {
			$query=$this->db->query(" SELECT*,
            DATEDIFF(CURDATE(), DATE(order_date)) AS `DOS`,
            `saimtech_order`.`modify_date` AS `lastactivitydate`
        FROM
            `saimtech_order`
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
            INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
        WHERE
            DATEDIFF(CURDATE(), DATE(order_date)) > 3 
            AND order_status NOT IN ('ORDER','Booking','Cancelled','Deliverd','RTS') 
            AND is_final = '0' 
            AND date(`order_date`) >= date(DATE_SUB(NOW(), INTERVAL 60 DAY))
        ORDER BY
            `DOS` DESC limit $pagelimit ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}else{
			$query=$this->db->query("SELECT*,
            DATEDIFF(CURDATE(), DATE(order_date)) AS `DOS`,
            `saimtech_order`.`modify_date` AS `lastactivitydate`
        FROM
            `saimtech_order`
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
            INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
        WHERE
            DATEDIFF(CURDATE(), DATE(order_date)) > 3 
            AND order_status NOT IN ('ORDER','Booking','Cancelled','Deliverd','RTS') 
            AND is_final = '0' 
            AND date(`order_date`) >= date(DATE_SUB(NOW(), INTERVAL 60 DAY))
        ORDER BY
            `DOS` DESC   ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}
		
	} 
	public function all_ok()
	{
		$data['title'] = "All Delivered Data";
		$data['sheet_data'] = $this->Qsrmodel->Get_All_Deliverd_TPT_Detail($_SESSION['thrid_party_id']);
		$this->load->view('module_report/tptView', $data);
	}

	public function all_rtd()
	{
		$data['title'] = "All Return To Delex Data";
		$data['sheet_data'] = $this->Qsrmodel->Get_All_RTD_TPT_Detail($_SESSION['user_id']);
		$this->load->view('module_report/tptView', $data);
	}

	public function mail()
	{
		$this->load->view('module_report/inboxView');
	}


	public function setting_view()
	{
		$data['msg'] = "";
		$this->load->view('module_report/settingView', $data);
	}

	public function submit_setting()
	{
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$retype_password = $this->input->post('retype_password');
		$db_password  = "";
		if ($old_password != "" && $new_password != "" && $retype_password != "") {
			$db_data = $this->Commonmodel->Get_record_by_condition('saimtech_oper_user', 'oper_user_id', $_SESSION['user_id']);
			if (!empty($db_data)) {
				foreach ($db_data as $row) {
					$db_password = $row->oper_user_password;
				}
			}
			if ($db_password == md5($old_password)) {
				if ($new_password == $retype_password) {
					$data = array('oper_user_password' => md5($new_password));
					$this->Commonmodel->Update_record('saimtech_oper_user', 'oper_user_id', $_SESSION['user_id'], $data);
					$data['msg'] = "<p class='alert alert-success'>Your password is successfully changed.</p>";
				} else {
					$data['msg'] = "<p class='alert alert-danger'>Retype password not matched.</p>";
				}
			} else {
				$data['msg'] = "<p class='alert alert-danger'>Incorrect old password.</p>";
			}
		} else {
			$data['msg'] = "<p class='alert alert-danger'>Something is missing please try again.</p>";
		}
		$this->load->view('module_report/settingView', $data);
	}
}
