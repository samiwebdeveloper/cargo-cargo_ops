<?php
class AddCityModel extends CI_Model
{
	function update_status($data,$id)
    {
        $querys="update saimtech_city SET is_enable='$data' where city_id='$id'";
       $this->db->query($querys);
    }
	
	
}
