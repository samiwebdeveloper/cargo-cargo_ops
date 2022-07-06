<?php
class SendDataAccoountModel extends CI_Model {
   
    function display_route()
	{
        
        $this->db->select('route_id,route_name');
        $this->db->where('is_enable', '1');
		$this->db->order_by("route_id", "asc");
		$query = $this->db->get("saimtech_route");
		return $query->result_array();
	}

	function display_rider()
	{
        $this->db->select('rider_id,rider_name');
        $this->db->where('is_enable', '1');
		$this->db->order_by("rider_id", "asc");
		$query = $this->db->get("saimtech_rider");
		return $query->result_array();
	}

}