<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AddRoute extends CI_Controller
{
	public function __construct()
	{
		/*call CodeIgniter's default Constructor*/
		parent::__construct();
		$this->load->model('AddRouteModel');
	}
	// Default function
	public function index()
	{
		$data['route_service']      = $this->AddRouteModel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
		$data['route_origin']       = $this->AddRouteModel->Get_record_by_condition('saimtech_city', 'is_enable', 1);
		$data['route_transit_city']  = $this->AddRouteModel->transit_city();
		$data['route_list_history']  = $this->AddRouteModel->route_list_history();
		$route_list_id_arr = array();
		$route_list_city = array();
		$route_city_name = array();
		foreach ($data['route_list_history'] as $route_list_id) {
			$route_list_id_arr[] = $route_list_id->route_list_id;
		}

		foreach ($route_list_id_arr as $route_id) {
			$list_city = $this->AddRouteModel->route_detail_history($route_id);
			array_push($route_list_city, $list_city);
		}
		$i = 0;
		foreach ($route_list_city as $outter_value) {
			foreach ($outter_value as $key => $inner_value) {
				$list_city_name = $this->AddRouteModel->get_route_city_name($inner_value['city_id']);
				$route_city_name[$i][$key]['city'] = $list_city_name;
			}
			$i++;
		}
		$data['route_city_name']  = $route_city_name;

		$this->load->view('module_administration/addRouteView', $data);
	}

	public function savedata()
	{

		if ($this->input->post('save')) {
			$this->form_validation->set_rules('route_origin', 'Route Origin', 'required');
			$this->form_validation->set_rules('route_des', 'Route Destination', 'required');

			if ($this->form_validation->run() != true) {
				$data['route_service']      = $this->AddRouteModel->Get_record_by_condition('saimtech_service', 'is_enable', 1);
				$data['route_origin']       = $this->AddRouteModel->Get_record_by_condition('saimtech_city', 'is_enable', 1);
				$data['route_transit_city']  = $this->AddRouteModel->transit_city();
				$this->load->view('module_administration/addRouteView', $data);
			} else {
				$service_name = $this->input->post('service_name');
				$route_code   = $this->input->post('route_code');
				$route_origin = $this->input->post('route_origin');
				$route_des    = $this->input->post('route_des');
				$transit_city = $this->input->post('transit_city');

				date_default_timezone_set('Asia/karachi');
				$CreationDate = date("Y-m-d h-i-s", time());
				$route_city_count = (count($transit_city) + 2);
				$city_code_origin = $this->AddRouteModel->city_code($route_origin);
				$city_code_des = $this->AddRouteModel->city_code($route_des);
				$route_code = 0;
				$get_route_code = $this->AddRouteModel->get_route_code($route_origin);

				if (isset($get_route_code)) {
					$data_route_list = array(
						'route_name' =>  $city_code_origin[0]['city_short_code'] . "-" . $city_code_des[0]['city_short_code'],
						'route_service_name' => $service_name,
						'route_code' =>  $get_route_code,
						'route_origin_id' => $route_origin,
						'route_city_count' => $route_city_count,
						'is_enable' => 1,
						'created_by' => $_SESSION['user_id'],
						'created_date' => $CreationDate
					);
				} else {
					$route_code = $route_origin . "001";
					$data_route_list = array(
						'route_name' =>  $city_code_origin[0]['city_short_code'] . "-" . $city_code_des[0]['city_short_code'],
						'route_service_name' => $service_name,
						'route_code' =>  $route_code,
						'route_origin_id' => $route_origin,
						'route_city_count' => $route_city_count,
						'is_enable' => 1,
						'created_by' => $_SESSION['user_id'],
						'created_date' => $CreationDate
					);
				}

				$id = $this->AddRouteModel->Insert_record('saimtech_route_list', $data_route_list);

				$final_array = array($route_origin, $transit_city, $route_des);
				$outter_arr_num = count($final_array[1]);
				$inner_loop = 2;
				foreach ($final_array as $key => $value) {
					if ($key == 0) {
						$data_route_detail_O = array(
							'route_list_id' => $id,
							'city_id' => $value,
							'type' => "O",
							'power' => "1",
							'created_by' => $_SESSION['user_id'],
							'created_date' => $CreationDate
						);
						$this->AddRouteModel->Insert_record('saimtech_route_detail', $data_route_detail_O);
					}

					foreach ($value as $key2 => $value2) {
						$data_route_detail_T = array(
							'route_list_id' => $id,
							'city_id' => $value2,
							'type' => "T",
							'power' => $inner_loop,
							'created_by' => $_SESSION['user_id'],
							'created_date' => $CreationDate
						);
						$inner_loop++;
						$this->AddRouteModel->Insert_record('saimtech_route_detail', $data_route_detail_T);
					}

					if ($key == 2) {
						$data_route_detail_D = array(
							'route_list_id' => $id,
							'city_id' => $value,
							'type' => "D",
							'power' => 2 + $outter_arr_num,
							'created_by' => $_SESSION['user_id'],
							'created_date' => $CreationDate
						);
						$this->AddRouteModel->Insert_record('saimtech_route_detail', $data_route_detail_D);
					}
				}

				$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
			  <strong>Successfully!</strong> Data is  inserted.
			  <button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			  </button>
			  </div>');
				redirect("AddRoute");
			}
		}
	}
}
