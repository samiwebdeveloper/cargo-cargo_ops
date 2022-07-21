<?php
class DcStatus extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Karachi');
        $this->load->model('DcStatusModel');
    }


    public function upload()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {
            $this->load->view('module_dcstatus/dcuploadView');
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }

    public function dc_summary()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {
            $dc_summary['summary'] = $this->DcStatusModel->dc_summary_soft_copy_pending();
            $dc_summary['month'] = $this->DcStatusModel->dc_summary_soft_copy_pending_month();
            $dc_summary['hsummary'] = $this->DcStatusModel->dc_summary_hard_copy_pending();
            $dc_summary['hmonth'] = $this->DcStatusModel->dc_summary_hard_copy_pending_month();
            $dc_summary['dc_summary_soft_copy_summary'] = $this->DcStatusModel->dc_summary_soft_copy_summary();

            $this->load->view('module_dcstatus/dcsummary', $dc_summary);
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }

    public function get_all_record()
    {

        $customer_id = $_GET['get_customer'];
        $table_name = $_GET['table_name'];
        $get_month = $_GET['get_month'];

        if ($table_name == "completed") {
            echo $message = base_url() . "DcStatus/get_complete_dc_record/" . $customer_id . "/" . $get_month;
        } else if ($table_name == "soft_copy_pending") {
            echo $message = base_url() . "DcStatus/soft_copy_pending/" . $customer_id . "/" . $get_month;
        } else if ($table_name == "hard_copy_pending") {
            echo $message = base_url() . "DcStatus/hard_copy_pending/" . $customer_id . "/" . $get_month;
        }
    }
    public function soft_copy_pending()
    {
        $customer_id = $this->uri->segment(3);
        $get_month = $this->uri->segment(4);
        $soft_copy_pending['soft_copy_pending'] = $this->DcStatusModel->soft_copy_pending($customer_id, $get_month);
        $this->load->view('module_dcstatus/dc_soft_copy_cust', $soft_copy_pending);
    }
    public function hard_copy_pending()
    {
        $customer_id = $this->uri->segment(3);
        $get_month = $this->uri->segment(4);
        $hard_copy_pending['hard_copy_pending'] = $this->DcStatusModel->hard_copy_pending($customer_id, $get_month);
        $this->load->view('module_dcstatus/dc_hard_copy_cust', $hard_copy_pending);
    }
    public function get_complete_dc_record()
    {
        $customer_id = $this->uri->segment(3);
        $get_month = $this->uri->segment(4);
        $get_complete_dc['get_complete_dc'] = $this->DcStatusModel->get_complete_dc($customer_id, $get_month);
        $this->load->view('module_dcstatus/dc_complete_cust', $get_complete_dc);
    }

    public function pending_dc_status()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $pending = $this->DcStatusModel->pending_dc_status($start_date, $end_date);
            $date = array();
            array_push($date, $start_date);
            array_push($date, $end_date);
            $get_record['date'] = $date;
            $get_record['pending'] = $pending;
            $this->load->view('module_dcstatus/dcstatus', $get_record);
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }
    public function pending_dc_report()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $pending = $this->DcStatusModel->pending_dc_status($start_date, $end_date);
            $date = array();
            array_push($date, $start_date);
            array_push($date, $end_date);
            $get_record['date'] = $date;
            $get_record['pending'] = $pending;
            $this->load->view('module_dcstatus/dcpendingreport', $get_record);
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }


    public function complete_dc_status()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $complete = $this->DcStatusModel->complete_dc_status($start_date, $end_date);
            $date = array();
            array_push($date, $start_date);
            array_push($date, $end_date);
            $get_record['date'] = $date;
            $get_record['pending'] = $complete;
            $this->load->view('module_dcstatus/dccomplete', $get_record);
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }

    public function submit_import_file()
    {

        if (($_FILES['file']['tmp_name']) != "") {
            // read csv file
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            // Read CSV 's Record  one by one
            $record = array();
            $errors = array();
            $insert_record_id = array();
            $csv_row = 0;
            $skip_row_number = array("0");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (!in_array($csv_row, $skip_row_number)) {
                    $customer_name     = $data[1];
                    $cn                = $data[2];
                    $Units_Detail      = $data[3];
                    $destination_city  = $data[4];
                    $dc_no             = $data[5];
                    $origin            = $_SESSION['origin_id'];
                    $ip                = $this->get_client_ip();
                    if ($cn != "" && $customer_name != "" && $destination_city != "") {
                        $order_detail = $this->DcStatusModel->Get_Order_By_Code($cn);
                        $order_id            = $order_detail[0]['order_id'];
                        $customer_id         = $order_detail[0]['customer_id'];
                        $db_customer_name    = $order_detail[0]['customer_name'];
                        $city_id             = $order_detail[0]['destination_city'];
                        $db_destination_city = $order_detail[0]['destination_city_name'];
                        $order_status        = $order_detail[0]['order_status'];
                        $insert_record_id[] = $order_id;
                        if ($destination_city != $db_destination_city) {
                            $destinationerror = '<div class="  col-md-3 alert alert-warning" role="alert"> <button class="close "  data-dismiss="alert"></button>
                            <strong>Alert!: </strong> <u class="text-danger">' . $destination_city . '</u> is not a valid destination city for this order ' . $cn . '</div>';
                            array_push($errors, $destinationerror);
                        }

                        if ($customer_name != $db_customer_name) {
                            $cusotmererror = '<div class=" col-md-3 alert alert-warning" role="alert"> <button class="close "  data-dismiss="alert"></button>
                            <strong>Alert!: </strong> <u class="text-danger">' . $customer_name . '</u> is not a valid Customer for this order ' . $cn . '</div>';
                            array_push($errors, $cusotmererror);
                        }

                        if ($order_id == null) {
                            $cnerror = '<div class="  col-md-3 alert alert-danger" role="alert"> <button class="close "  data-dismiss="alert"></button>
                            <strong>Alert!: </strong> <b>' . $cn . '</b> is not a valid CN Number.</div>';
                            array_push($errors, $cnerror);
                        } elseif ($order_id > 0) {
                            // insert record in dc_status if order_id is zero in dc_status
                            $check_unique = $this->DcStatusModel->check_unique($order_id);

                            if ($check_unique != 1) {
                                $datainsert = array(
                                    'dc_No'       => $dc_no,
                                    'order_id'    => $order_id,
                                    'customer_id' => $customer_id,
                                    'city_id'     => $city_id,
                                    'order_status' => $order_status,
                                    'Units_Detail' => $Units_Detail,
                                    'uploaded_by' => $_SESSION['user_id'],
                                    'uploaded_at' => date('Y-m-d H:i:s'),
                                    'soft_copy_at' => '0000-00-00 00:00:00',
                                    'hard_copy_at' => '0000-00-00 00:00:00',
                                    'requested_at' => '0000-00-00 00:00:00'
                                );
                                $this->DcStatusModel->Insert_record('dc_status', $datainsert);
                            }
                        }
                    } else {
                        $column_errror = '<div class="  col-md-3 alert alert-danger" role="alert"> <button class="close "  data-dismiss="alert"></button>
                    <strong>Alert!: </strong> Row Number <b>' . $csv_row . '</b> has missing some Required fields.</div>';
                        array_push($errors, $column_errror);
                    }
                }
                $csv_row++;
            }

            fclose($handle);
            foreach ($insert_record_id as $get_order_id) {
                $order_id = $get_order_id;
                $get_records_by_id = $this->DcStatusModel->Get_Dc_Status_order_id($order_id);

                if (!empty($get_records_by_id)) {
                    foreach ($get_records_by_id as $value) {
                        if (!in_array($value['row_id'], array_column($record, 'row_id'))) {
                            array_push($record, $value);
                        }
                    }
                }
            }
            $get_record['record'] = $record;
            $get_record['errors'] = $errors;
            $this->load->view('module_dcstatus/dcstatuscheck', $get_record);
        } else {
            echo ("<p class='alert alert-danger'>Please Select a CSV import File :(</p>");
        }
    }

    public function update_record()
    {
        $row_id = $_POST['order_id'];
        $soft_copy_check = $_POST['soft_copy_check'];
        $hard_copy_check = $_POST['hard_copy_check'];
        $request_by_check = $_POST['request_by_check'];
        $edit_dc = $_POST['edit_dc'];
        $created_by = $_SESSION['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $response = $this->DcStatusModel->Update_Record($row_id, $soft_copy_check, $hard_copy_check, $request_by_check, $created_by, $created_at, $edit_dc);
        echo (' <div class="alert alert-info" role="alert"> <button class="close "  data-dismiss="alert"></button>
      <strong>Successfully: </strong> Record is updated.</div>');
    }

    public function update_dc()
    {
        $row_id = $_POST['row_id'];
        $edit_dc = $_POST['edit_dc'];
        $response = $this->DcStatusModel->update_dc($row_id, $edit_dc);
        echo (' <div class="alert alert-info" role="alert"> <button class="close "  data-dismiss="alert"></button>
      <strong>Successfully: </strong> CN  is updated.</div>');
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

