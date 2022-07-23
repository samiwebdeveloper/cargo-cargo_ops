<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CS_Progress extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CsProgressModel');
	}


	public function cs_progress_summary()
	{
		$this->load->view('csprogresssummaryView');
	}

	public function cs_progress_summary_data()
	{
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$summary_data = $this->CsProgressModel->cs_progress($start_date, $end_date, $_SESSION['origin_id']);
		echo json_encode($summary_data);
	}
	


	public function cs_progress_detail()
	{
		$this->load->view('csprogressdetailView');
	}
	public function cs_progress_detail_data()
	{
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$pending = $this->CsProgressModel->cs_progress_detail($start_date, $end_date, $_SESSION['origin_id']);
		echo json_encode($pending);
	}
}
