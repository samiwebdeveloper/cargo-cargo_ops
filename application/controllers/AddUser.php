<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AddUser extends CI_Controller
{
	public function __construct()
	{
		/*call CodeIgniter's default Constructor*/
		parent::__construct();
		$this->load->model('AddUserModel');
		$this->load->model('Commonmodel');
	}
	// Default function
	public function index()
	{
		$data['result'] = $this->AddUserModel->display_records();
		$data['result_rider'] = $this->AddUserModel->display_rider();
		$data['customer_data'] = $this->AddUserModel->display_user('saimtech_oper_user');
		$this->load->view('add_ope_user', $data);
	}
	// Send Data to opt_user view on the behalf of js page lenght
	public function ajaxview()
	{
		$pagelimit = $_POST['company_data'];
		$data = $this->AddUserModel->display_records_with_minimize($pagelimit);
		$i = 1;
		foreach ($data as $row) {
			$userid = $row->oper_user_id;
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "<td>" . $row->oper_user_name . "</td>";
			echo "<td>" . $row->oper_account_no . "</td>";
			echo "<td>" . $row->oper_user_power . "</td>";
			echo "<td>" . $row->city . "</td>";
			if ($row->is_enable) { ?>
						<?php echo '<td class="bg-success text-white" ><a  style="text-decoration: none; font-weight: bold;">Enable</a></td>' ?>
					<?php } else { ?>
						<?php echo ' <td class="bg-danger text-white"><a  style="text-decoration: none; font-weight: bold;">Disable</a></td>' ?>
					<?php }
				if ($row->is_enable) { ?>
						<?php echo '<td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #dc3545;color: white; border-radius: 5px;border: 1px solid #dc3545;padding: 2px 9px;" href="adduser/status/0/?id=<?=' . $userid . '?>">Disable</a></td>'; ?>
					<?php } else { ?>
						<?php echo '<td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #28a745;color: white;border-radius: 5px;border: 1px solid #28a745;padding: 2px 11px;" href="adduser/status/1/?id=<?= ' . $userid . ' ?>">Enable</a></td>'; ?>
				<?php }
				echo "<td>" . $row->created_date . "</td>";
				echo "</tr>";
				$i++;
			}
		}
		// Send Data to Dashbord view on the behalf of js page lenght

		public function pending_record()
		{
			$pagelimit = $_POST['company_data'];
			$data = $this->AddUserModel->display_pending_record($pagelimit);

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
		// update opt_User status
		public function status($type)
		{
			$id = $this->input->get('id');
			$this->AddUserModel->update_status($type, $id);
			$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
		<strong>Successfully!</strong> Records Update.
		<button type="button" class="close" data-dismiss="alert">
		  <span aria-hidden="true">&times;</span>
		</button>
		</div>');
			redirect("Adduser");
		}
		// insert record in opt_user tbl
		public function savedata()
		{
			$data['result'] = $this->AddUserModel->display_records();
			$data['result_rider'] = $this->AddUserModel->display_rider();
			$data['customer_data'] = $this->AddUserModel->display_user('saimtech_oper_user');
			// $this->load->view('add_ope_user', $data);
			if ($this->input->post('save')) {
				$this->form_validation->set_rules('oper_user_name', 'User Name', 'required|alpha|max_length[25]|min_length[3]');
				$this->form_validation->set_rules('oper_user_password', 'Password', 'required|min_length[6]');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[6]|matches[oper_user_password]');
				$this->form_validation->set_rules('oper_user_power', 'User Role', 'required');
				$this->form_validation->set_rules('is_enable', 'Select Status', 'required');
				$this->form_validation->set_rules('oper_account_no', 'User ID', 'required|is_unique[saimtech_oper_user.oper_account_no]');
				if ($this->form_validation->run() != true) {
					$this->load->view('add_ope_user', $data);
				} else {
					date_default_timezone_set('Asia/karachi');
					$CreationDate = date("Y-m-d h-i-s", time());
					$data = array(
						'oper_user_name' => $this->input->post('oper_user_name'),
						'oper_account_no' => $this->input->post('oper_account_no'),
						'oper_user_password' => md5($this->input->post('oper_user_password')),
						'oper_user_power' => $this->input->post('oper_user_power'),
						'oper_user_city_id' => $this->input->post('oper_user_city_id'),
						'opr_reporting_station' => $this->input->post('oper_user_city_id'),
						'rider_id' => $this->input->post('rider_id'),
						'is_enable' => $this->input->post('is_enable'),
						'last_login' => '0000-00-00 00:00:00',
						'last_logout' => '0000-00-00 00:00:00',
						'thrid_party_id' => '0',
						'created_date' => $CreationDate
					);
					$id = $this->Commonmodel->Insert_record('saimtech_oper_user', $data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success  fade show" role="alert">
			  <strong>Successfully!</strong> Data is  inserted.
			  <button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span>
			  </button>
			  </div>');
					redirect("Adduser");
				}
			}
		}
	}
