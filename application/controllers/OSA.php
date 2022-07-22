<?php
// OSA Output Service Area
// Sd Special Area
class OSA extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Karachi');
        $this->load->model('OSAModel');
    }

    public function pending_osa_status()
    {
        if ($_SESSION['user_power'] == 'CS' || $_SESSION['user_power'] == 'SE' || $_SESSION['user_power'] == 'BM') {

            if ($_POST['start_date'] == "" && $_POST['end_date'] == "") {
                // $start_date = date("Y-m-d", strtotime("first day of previous month"));
                // $end_date = date("Y-m-j", strtotime("last day of previous month"));
                $start_date = date("Y-m-d", strtotime("-25 days"));
                $end_date = date("Y-m-d", strtotime("now"));
            } else {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
            }
            $pending = $this->OSAModel->pending_osa_status($start_date, $end_date);
            $date = array();
            array_push($date, $start_date);
            array_push($date, $end_date);
            $get_record['date'] = $date;
            $get_record['pending'] = $pending;
            $this->load->view('module_osa/osatatus', $get_record);
        } else {
            echo ("<center><h1>Access Denied.........<BR>Name: " . $_SESSION['user_name'] . " <BR>IP: " . $this->get_client_ip() . "</h1></center>");
        }
    }

    public function update_osa()
    {
        
        $row_id = $_POST['row_id'];
        $edit_osa = $_POST['edit_order_osa'];
        $this->OSAModel->update_osa($row_id, $edit_osa);
        echo ("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong> Successfully! </strong> Order <b><u>".$row_id."</u></b>  OSA has Applied.</div></div>");
    }

    public function update_sd()
    {
        $row_id = $_POST['row_id'];
        $order_osa_sd_total = $_POST['order_osa_sd_total'];
        $edit_order_osa = $_POST['edit_order_osa'];
        $this->OSAModel->update_sd($row_id, $order_osa_sd_total,$edit_order_osa);
        echo ("<div class='pgn push-on-sidebar-open pgn-bar'><div class='d alert-success'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><strong> Successfully! </strong> Order <b><u>".$row_id."</u></b>  Charges has Applied.</div></div>");

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
