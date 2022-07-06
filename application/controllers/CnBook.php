<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CnBook extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CnBookModel');
    }


    public function default_load()
    {
        // $data['sub_nav_active'] = "Manage";
        // $data['nav_active'] = "Route";
        // $data['event_name'] = "Route";
        // if ($_SESSION['user_power'] != "TPT") {
        //     $data['route_data'] = $this->Commonmodel->Get_record_by_double_condition('saimtech_route', 'route_origin', $_SESSION['origin_id'], 'agent_id', 0);
        // } else {
        //     $data['route_data'] = $this->Commonmodel->Get_record_by_condition('saimtech_route', 'agent_id', $_SESSION['thrid_party_id']);
        // }
        $this->load->view('cnbookView');
    }

}