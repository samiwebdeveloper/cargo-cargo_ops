<?php
class AddCityModel extends CI_Model
{
    function update_status($data, $id)
    {
        $querys = "update saimtech_city SET is_enable='$data' where city_id='$id'";
        $this->db->query($querys);
    }
    function Get_all_record()
    {
        $query = "SELECT city_id, city_name FROM `saimtech_city` where city_id in (select distinct reporting_city from saimtech_city)";
        $res = $this->db->query($query);
        return $res->result();
    }
}
