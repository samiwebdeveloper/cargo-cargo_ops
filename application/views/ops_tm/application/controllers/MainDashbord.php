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

	public function booking_weight()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_weight($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'Booking_Date'		=>	$row["Booking_Date"],
					'booking'			=>	$row["booking"],
					'pieces'			=>	$row["pieces"],
					'weight'			=>	$row["weight"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function booking_full_year()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_full_year($origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'Booking_Date'		=>	$row["Booking_Date"],
					'booking'			=>	$row["booking"],
					'pieces'			=>	$row["pieces"],
					'weight'			=>	$row["weight"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}

	public function booking_city()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->city_origin_wise($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'origin_city_name'		=>	$row["origin_city_name"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function city_destination_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->city_destination_wise($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'destination_city_name'		=>	$row["destination_city_name"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function booking_service_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_service_wise($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'service_name'		=>	$row["service_name"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function booking_status_wise()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_status_wise($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'order_status'		=>	$row["order_status"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function not_manifested()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->not_manifested($start_date, $end_date,$origin_city );
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'destination_city_name'	=>	$row["destination_city_name"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function not_delivered()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->not_delivered($start_date, $end_date,$origin_city );
		
			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'Destination'	=>	$row["Destination"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}
	public function weight_on_route_30days()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->weight_on_route_30days($start_date, $end_date,$origin_city );

			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'rider_route'	=>	$row["rider_route"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}

	public function booking_on_route_30days()
	{
		if ($_GET["action"] == 'fetch') {
			$start_date = $_GET["start_date"];
			$end_date = $_GET["end_date"];
			$origin_city = $_GET["origin_city"];
			$result = $this->MainDashbordModel->booking_on_route_30days($start_date, $end_date,$origin_city );

			$data = array();
			foreach ($result as $row) {
				$data[] = array(
					'rider_route'	=>	$row["rider_route"],
					'Total'			=>	$row["Total"],
					'color'			=>	'#' . rand(100000, 999999) . ''
				);
			}
			echo json_encode($data);
		}
	}

	public function main_home()
	{
		$data['city_data'] = $this->Commonmodel->Get_all_record_inarray('saimtech_city');
		$data['pending_data'] = $this->Qsrmodel->Get_Pending_Shipments_admin();
		$data['md_booking_30days'] = $this->MainDashbordModel->md_booking_30days();
		$this->load->view('maindashbord', $data);
	}


	public function pending_record()
	{
		$pagelimit = $_GET['company_data'];
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
}
