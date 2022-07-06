<?php
class AddRouteModel extends CI_Model
{

	public function Insert_record($tablename, $data)
	{
		$this->db->insert($tablename, $data);
		return $this->db->insert_id();   
	}

	function city_code($city_id)
	{
		$qur = $this->db->query("SELECT city_short_code FROM `saimtech_city` WHERE city_id=$city_id");
		return $qur->result_array();
	}
	function route_list_history()
	{
		$qur = $this->db->query("SELECT *,saimtech_oper_user.oper_user_name from saimtech_route_list
		INNER JOIN saimtech_oper_user on saimtech_route_list.created_by=saimtech_oper_user.oper_user_id ORDER by saimtech_route_list.route_list_id DESC");
		return $qur->result();
	}
	function route_detail_history($list_id)
	{
		$qur = $this->db->query("SELECT city_id from saimtech_route_detail where route_list_id='$list_id'");
		return $qur->result_array();
	}
	function get_route_code($route_origin_id)
	{
		$query = $this->db->query("SELECT MAX(route_code)+1 as route_code FROM `saimtech_route_list` WHERE route_origin_id='$route_origin_id'");
		$row = $query->row();
		return $row->route_code;
	}
	function get_route_city_name($route_origin_id)
	{
		$query = $this->db->query("SELECT city_name FROM `saimtech_city` WHERE city_id='$route_origin_id'");
		$row = $query->row();
		return $row->city_name;
	}

	function transit_city()
	{
		$user = $this->db->query("SELECT DISTINCT(reporting_city) as reporting_city FROM `saimtech_city` order by reporting_city");
		return $user->result();
	}
	public function Get_record_by_condition($tablename, $columnname, $conditionvalue)
	{
		$this->db->where($columnname, $conditionvalue);
		$query = $this->db->get($tablename);
		return $query->result();
	}
}
