<?php
class Loginmodel extends CI_Model
{


	public function Get_User_Detail_By_Username($email)
	{
		$query = "SELECT * FROM `saimtech_oper_user` 
		INNER JOIN saimtech_city on `saimtech_city`.`city_id` = `saimtech_oper_user`. `oper_user_city_id`
		WHERE `oper_account_no`=?  and `saimtech_oper_user`.`is_enable`=1";
		$res = $this->db->query($query, array($email));
		return $res->result();
	}

	public function Update_Login_Date($userid)
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
		);
		$this->db->where('oper_user_id', $userid);
		$this->db->update('saimtech_oper_user', $data);
		return $this->db->affected_rows();
	}

	public function Update_Logout_Date($userid)
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
		);
		$this->db->where('oper_user_id', $userid);
		$this->db->update('saimtech_oper_user', $data);
		return $this->db->affected_rows();
	}
}
