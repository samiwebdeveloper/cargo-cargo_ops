<?php 
class MainDashbord extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->model('MainDashbordModel');
		$this->load->model('Commonmodel');
		$this->load->model('Qsrmodel');
	}

	public function index()
	{
        $data['pending_data'] = $this->Qsrmodel->Get_Pending_Shipments_admin();
		$data['md_booking_30days'] = $this->MainDashbordModel->md_booking_30days();
		$data['city_booking_wise'] = $this->MainDashbordModel->test();
		// print_r($data['md_booking_30days']);
		// exit;
		// echo"<pre>";
		// print_r( $data['md_booking_30days']);
		// exit;
		$this->load->view('maindashbord', $data);
	}

}
?>