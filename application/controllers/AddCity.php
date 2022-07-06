<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AddCity extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		/*load Model*/
		$this->load->model('AddCityModel');
		$this->load->model('Commonmodel');
	}
	// Default function
	public function index()
	{
		$data['country_data'] = $this->Commonmodel->Get_all_record('saimtech_country');
		$data['city_data'] = $this->Commonmodel->Get_all_record('saimtech_city');
		$this->load->view('add_city', $data);
	}
	
		// update opt_User status
		public function status($type)
		{
			$id = $this->input->get('id');
			$this->AddCityModel->update_status($type, $id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
		<strong>Successfuly!</strong> Records Update.
		<button type="button" class="close" data-dismiss="alert">
		  <span aria-hidden="true">&times;</span></button></div>');
			redirect("AddCity");
		}
		// insert record in opt_user tbl
		public function savedata()
		{
			$data['country_data'] = $this->Commonmodel->Get_all_record('saimtech_country');
			if ($this->input->post('save')) {
				$this->form_validation->set_rules('city_name', 'City Name', 'required|alpha|max_length[50]|min_length[3]');
				$this->form_validation->set_rules('city_full_name', 'City Full Name', 'required|alpha|max_length[70]|min_length[3]');
				$this->form_validation->set_rules('city_short_code', 'City Short Code', 'required|min_length[3]');
				$this->form_validation->set_rules('city_code', 'City Code', 'required|numeric|is_unique[saimtech_city.city_code]');
				$this->form_validation->set_rules('city_zone', 'City Zone', 'required');
				if ($this->form_validation->run() != true) {
					$this->load->view('add_city', $data);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger  fade show" role="alert">
                    <strong>Alert!</strong> Data is Not inserted.
                    <button type="button" class="close" data-dismiss="alert">
                      <span aria-hidden="true">&times;</span>
                    </button></div>');
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
					<strong>Successfully!</strong> Data is  inserted.
					<button type="button" class="close" data-dismiss="alert">
					  <span aria-hidden="true">&times;</span>
					</button>
					</div>');
					date_default_timezone_set('Asia/karachi');
					$CreationDate = date("Y-m-d h-i-s", time());
					$userby = $_SESSION['user_id'];
					$data = array(
						'city_name' => $this->input->post('city_name'),
						'city_full_name' => $this->input->post('city_full_name'),
						'city_short_code' => $this->input->post('city_short_code'),
						'city_code' => $this->input->post('city_code'),
						'country_id' => $this->input->post('country'),
						'city_zone' => $this->input->post('city_zone'),
						'ex_punjab' => $this->input->post('ex_punjab'),
						'ex_kpk' => $this->input->post('ex_kpk'),
						'ex_sindh' => $this->input->post('mixture'),
						'mixture' => $this->input->post('ex_kpk'),
						'city_region' => $this->input->post('city_region'),
						'city_type' => $this->input->post('city_type'),
						'is_enable' => $this->input->post('city_status'),
						'tm_network' => $this->input->post('tm_network'),
						'tm_remark' => $this->input->post('remark'),
						'created_by' => $userby,
						'created_date' => $CreationDate
					);
					// print_r($data);
					$id = $this->Commonmodel->Insert_record('saimtech_city', $data);

					$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
			  <strong>Successfully!</strong> Data is  inserted.
			  <button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			  </button>
			  </div>');
					redirect("AddCity");
				}
			}
		}
	}
