<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CS_Progress extends CI_Controller
{
	public function __construct()
	{
		/*call CodeIgniter's default Constructor*/
		parent::__construct();
		$this->load->model('CsProgressModel');
	}
	// Default function

	public function cs_progress_summary()
	{

		if ($_POST['start_date'] == "" && $_POST['end_date'] == "") {
			$start_date = date("Y-m-d", strtotime("-3 days"));
			$end_date = date("Y-m-d", strtotime("now"));
		} else {
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
		}
		$pending = $this->CsProgressModel->cs_progress($start_date, $end_date, $_SESSION['origin_id']);
		$date = array();
		array_push($date, $start_date);
		array_push($date, $end_date);
		$get_record['date'] = $date;
		$get_record['pending'] = $pending;
		$this->load->view('csprogresssummaryView', $get_record);
	}
	public function cs_progress_detail()
	{

		if ($_POST['start_date'] == "" && $_POST['end_date'] == "") {
			$start_date = date("Y-m-d", strtotime(" -3 days"));
			$end_date = date("Y-m-d", strtotime("now"));
		} else {
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
		}
		$pending = $this->CsProgressModel->cs_progress_detail($start_date, $end_date, $_SESSION['origin_id']);
		$date = array();
		array_push($date, $start_date);
		array_push($date, $end_date);
		$get_record['date'] = $date;
		$get_record['pending'] = $pending;
		$this->load->view('csprogressdetailView', $get_record);
	}
}
