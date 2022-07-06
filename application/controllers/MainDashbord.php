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

	public function booking_full_month()
	{
		if ($_GET["action"] == 'fetch') {

			$start_date =   date("Y-m-j", strtotime("first day of -11 month"));
			$end_date = date('Y-m-d', strtotime('now'));
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_full_month($origin_city, $start_date, $end_date);
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'Booking_Date'		=>	$row["Booking_Date"],
					'booking'			=>	$row["booking"],
					'pieces'			=>	$row["pieces"],
					'weight'			=>	$row["weight"]
				);
			}
			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}
	public function city_origin_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->city_origin_wise($start_date, $end_date, $origin_city);
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'origin_city_name'		=>	$row["origin_city_name"],
					'Total'			=>	$row["Total"]
				);
			}

			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}
	public function city_destination_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->city_destination_wise($start_date, $end_date, $origin_city);
			$result = $this->MainDashbordModel->city_destination_wise($start_date, $end_date, $origin_city);
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'destination_city_name'		=>	$row["destination_city_name"],
					'Total'			=>	$row["Total"]
				);
			}
			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}
	public function booking_service_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_service_wise($start_date, $end_date, $origin_city);
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'service_name'		=>	$row["service_name"],
					'Total'			=>	$row["Total"]
				);
			}
			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}
	public function booking_status_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_status_wise($start_date, $end_date, $origin_city);
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'order_status'		=>	$row["order_status"],
					'Total'			=>	$row["Total"]
				);
			}
			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}

	public function not_delivered()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->not_delivered($start_date, $end_date, $origin_city);

			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'Destination'	=>	$row["Destination"],
					'Total'			=>	$row["Total"]
				);
			}
			$encoded = json_encode($data, JSON_NUMERIC_CHECK);
			echo $encoded;
		}
	}

	public function main_home()
	{
		$data['city_data'] = $this->Commonmodel->Get_all_record_inarray('saimtech_city');
		
		$this->load->view('maindashbord', $data);
	}
}
