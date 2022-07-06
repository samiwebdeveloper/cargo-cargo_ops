<?php
class AddUserModel extends CI_Model
{

	public function saverecords($data)
	{

		$this->db->insert('saimtech_oper_user', $data);
		return true;
	}

	function display_records()
	{
		$query = $this->db->get("saimtech_city");
		return $query->result_array();
	}

	function display_rider()
	{
		$qur = $this->db->get("saimtech_rider");
		return $qur->result_array();
	}
	function display_user()
	{
	//   $user=$this->db->get("saimtech_oper_user");
	  $user=$this->db->query("SELECT * from saimtech_oper_user  ORDER BY oper_user_id DESC ");
	  return $user->result();
	}

	function display_records_with_minimize($pagelimit)
	{
		if ($pagelimit>1) {
			$query=$this->db->query(" SELECT saimtech_oper_user.* , saimtech_city.city_name as city FROM saimtech_oper_user 
			INNER join saimtech_city on saimtech_oper_user.oper_user_city_id = saimtech_city.city_id  ORDER BY
			saimtech_oper_user.oper_user_id DESC limit $pagelimit ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}else{
			$query=$this->db->query(" SELECT saimtech_oper_user.* , saimtech_city.city_name as city FROM saimtech_oper_user 
		INNER join saimtech_city on saimtech_oper_user.oper_user_city_id = saimtech_city.city_id ORDER BY
			saimtech_oper_user.oper_user_id DESC  ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}
		
	} 

	function qsr_report_record($pagelimit,$start_date,$end_date)
	{
//   echo$pagelimit.$start_date.$end_date;
// exit;
		if ($pagelimit>1) {
			$query=$this->db->query("SELECT `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,
			`order_sc`,`order_deliver_date`,`order_status`, `destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,
			`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`, `consignee_address`,`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,
			`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`, `on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,
			`product_detail`,`shipment_received_by`,`saimtech_rider`.`rider_name` AS `rider`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order` LEFT JOIN `saimtech_rider`
			 ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id` LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by` LEFT JOIN `saimtech_customer`
			 ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id` LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code` LEFT JOIN `saimtech_service`
			 ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type` WHERE date(`saimtech_arrival_detail`.`arrival_date`) between'$start_date' and '$end_date' AND order_status NOT IN ('Order','Cancelled') limit $pagelimit");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		// return $this->db->last_query();
		}else{
			$query=$this->db->query("SELECT `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,
			`order_sc`,`order_deliver_date`,`order_status`, `destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,
			`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`, `consignee_address`,`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,
			`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`, `on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,
			`product_detail`,`shipment_received_by`,`saimtech_rider`.`rider_name` AS `rider`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order` LEFT JOIN `saimtech_rider`
			 ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id` LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by` LEFT JOIN `saimtech_customer`
			 ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id` LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code` LEFT JOIN `saimtech_service`
			 ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type` WHERE date(`saimtech_arrival_detail`.`arrival_date`) between'$start_date' and '$end_date' AND order_status NOT IN ('Order','Cancelled') ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}
		
	} 
	
	function update_status($data,$id)
    {
        // $this->db->where('id',$id);
        // $this->db->update('tblcrud',$data);
      echo  $querys="update saimtech_oper_user SET is_enable='$data' where oper_user_id='$id'";
    //   die();
        $query = $this->db->query($querys);
    }
	
	
}
