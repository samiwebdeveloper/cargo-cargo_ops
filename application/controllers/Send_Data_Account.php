<?php

class Send_Data_Account extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('SendDataAccoountModel');
    }


    public function rider_data()
    {
		$result_rider = $this->SendDataAccoountModel->display_rider();
        foreach ($result_rider as $row) {
            echo " <option value='" . $row['rider_id'] . "'>" . $row['rider_name'] . "</option>";
        }
    }
    
    public function route_data()
    {
        $result_route= $this->SendDataAccoountModel->display_route();
        foreach ($result_route as $row) {
            echo " <option value='" . $row['route_id'] . "'>" . $row['route_name'] . "</option>";
        }
    }

}