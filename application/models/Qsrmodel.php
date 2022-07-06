<?php
class Qsrmodel extends CI_Model
{




	public function Get_Shipments_By_Cid($cid, $start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE `saimtech_order`.`customer_id`=? and  (`saimtech_order`.`order_date`>=? and  `saimtech_order`.`order_date`<=?) Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($cid, $start_date, $end_date));
		return $res->result();
	}


	public function Get_Shipments_By_Cid_Archive($cid, $start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_archive_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_archive_order`.`pickup_point_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			WHERE `saimtech_archive_order`.`customer_id`=? and  (`saimtech_archive_order`.`order_date`>=? and  `saimtech_archive_order`.`order_date`<=?) Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($cid, $start_date, $end_date));
		return $res->result();
	}



	public function Get_Shipments_Admin($start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}


	//--------------Admin Shipments Start-------------------------------------------	
	public function Get_Shipments_Admin_Tm($start_date, $end_date)
	{
		/*$query="SELECT * , `saimtech_city`.`is_enable` as `TM`,`saimtech_oper_user`.`oper_user_name` AS `createdby`,`saimtech_transit_list`.`vehicle_no` AS `vehicle`,`saimtech_rider`.`rider_name` AS `rider`,`saimtech_route`.`route_name` as `route_name` FROM `saimtech_order`
 	        LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_code`=`saimtech_order`.`loading_id`
 	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
 			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
 			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
 			LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_order`.`destination_reporting`
 			LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id`
 			LEFT JOIN `saimtech_delivery_list` ON `saimtech_delivery_list`.`delivery_code`=`saimtech_order`.`on_route_id`
            LEFT JOIN `saimtech_route` ON `saimtech_delivery_list`.`route_id`=`saimtech_route`.`route_id`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? 
			AND (order_status not in ('Order','Cancelled'))";*/
		$query = "SELECT
		row_number() OVER(
	ORDER BY
		order_id
	) AS 'row_number',
	`saimtech_customer`.`customer_name`,
	`saimtech_order`.`order_code`,
	`saimtech_order`.`manual_cn`,
	`saimtech_order`.`order_date`,
	`saimtech_order`.`order_booking_date`,
	`saimtech_order`.`order_status`,
	`saimtech_order`.`shipment_received_by`,
	`saimtech_order`.`shipper_name`,
	`saimtech_order`.`consignee_name`,
	`saimtech_order`.`consignee_mobile`,
	`saimtech_order`.`consignee_address`,
	`saimtech_order`.`origin_city_name`,
	`saimtech_order`.`destination_city_name`,
	`saimtech_order`.`pieces`,
	`saimtech_order`.`weight`,
	`saimtech_order`.`cod_amount`,
	`saimtech_order`.`order_pay_mode`,
	`saimtech_order`.`loading_id`,
	IFNULL(`on_route_id`, 0) `on_route_id`,
	`saimtech_service`.`service_name`,
	`saimtech_order`.`product_detail`,
	`saimtech_order`.`order_arrival_date`,
	`saimtech_order`.`order_deliver_date`,
	`saimtech_oper_user`.`oper_user_name`,
	`saimtech_city`.`is_enable` AS `TM`,
	`saimtech_oper_user`.`oper_user_name` AS `createdby`,
	`saimtech_transit_list`.`vehicle_no` AS `vehicle`,
	`saimtech_rider`.`rider_name` AS `rider`,
	`saimtech_route`.`route_name` AS `route_name`
	FROM
		`saimtech_order`
	LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_code` = `saimtech_order`.`loading_id`
	LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id` = `saimtech_order`.`created_by`
	LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
	LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id` = `saimtech_order`.`destination_reporting`
	LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id` = `saimtech_order`.`delivery_rider_id`
	LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
	LEFT JOIN `saimtech_delivery_list` ON `saimtech_delivery_list`.`delivery_code` = `saimtech_order`.`on_route_id`
	LEFT JOIN `saimtech_route` ON `saimtech_delivery_list`.`route_id` = `saimtech_route`.`route_id`
	WHERE date(`saimtech_order`.`order_date`) between ? and ? 
			        AND (order_status not in ('Order','Cancelled')) limit 2  ";
		$res = $this->db->query($query, array($start_date, $end_date));
		// echo	$this->db->last_query();
		// exit;
		// // echo"<pre>";
		// // echo json_encode($res->result());
		// // print_r($res->result());
		return $res->result();
	}

	public function Get_Shipments_Admin_Customer_Tm($start_date, $end_date, $customer)
	{
		$query = "SELECT * , `saimtech_city`.`is_enable` as `TM`,`saimtech_oper_user`.`oper_user_name` AS `createdby`,`saimtech_transit_list`.`vehicle_no` AS `vehicle`,`saimtech_rider`.`rider_name` AS `rider`,`saimtech_route`.`route_name` as `route_name` FROM `saimtech_order`
 	        -- LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_code`=`saimtech_order`.`loading_id`
 	        -- LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
 			-- LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
 			-- LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
 			-- LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_order`.`destination_reporting`
 			-- LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id`
 			-- LEFT JOIN `saimtech_delivery_list` ON `saimtech_delivery_list`.`delivery_code`=`saimtech_order`.`on_route_id`
            --  LEFT JOIN `saimtech_route` ON `saimtech_delivery_list`.`route_id`=`saimtech_route`.`route_id`
			LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id` = `saimtech_order`.`created_by`
LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id` = `saimtech_order`.`destination_reporting`
LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id` = `saimtech_order`.`delivery_rider_id`
LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_list_id` = `saimtech_order`.`loading_id`
LEFT JOIN `saimtech_route` ON `saimtech_route`.`route_id` = `saimtech_order`.`on_route_id`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? 
			AND `saimtech_order`.`customer_id`= ? 
			AND  order_status <> 'Cancelled'
			Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}
	//--------------Admin Shipments End---------------------------------------------

	//--------------BM/CS Shipments Start-------------------------------------------	
	// 	public function Get_Shipments_CS_Tm($start_date,$end_date){
	// 	$query="SELECT * , `saimtech_city`.`is_enable` as `TM`,`saimtech_oper_user`.`oper_user_name` AS `createdby`,`saimtech_transit_list`.`vehicle_no` AS `vehicle`,`saimtech_rider`.`rider_name` AS `rider`,`saimtech_route`.`route_name` as `route_name` FROM `saimtech_order`
	// 	        LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_code`=`saimtech_order`.`loading_id`
	// 	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
	// 			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
	// 			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
	// 			LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_order`.`destination_reporting`
	// 			LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id`
	// 			LEFT JOIN `saimtech_delivery_list` ON `saimtech_delivery_list`.`delivery_code`=`saimtech_order`.`on_route_id`
	//             LEFT JOIN `saimtech_route` ON `saimtech_delivery_list`.`route_id`=`saimtech_route`.`route_id`
	// 			WHERE (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) AND (order_status<>'Order' and order_status<>'Cancelled' )";
	// 	$res = $this->db->query($query,array($start_date,$end_date));
	//     return $res->result();
	// 	}
	public function Get_Shipments_CS_Tm($start_date, $end_date)
	{
		$query = "SELECT  row_number() over(order by order_id) as 'row_number',`saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	         LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between? and ? AND order_status NOT IN ('Order','Cancelled') ";
		$res = $this->db->query($query, array($start_date, $end_date));
		// echo	$this->db->last_query();
		// exit;
		return $res->result();
	}

	public function Get_Shipments_CS_Customer_Tm($start_date, $end_date, $customer)
	{
		$query = "SELECT  row_number() over(order by order_id) as 'row_number', `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between ? and ? and `saimtech_order`.`customer_id`=? AND order_status<>'Cancelled'  Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}
	//--------------BM/CS Shipments End---------------------------------------------

	//--------------Super Shipments Start---------------------------------------------
	public function Get_Shipments_Super_Tm($start_date, $end_date)
	{

		$query = " SELECT  row_number() over(order by order_id) as 'row_number', ifnull(`saimtech_order`.`order_code`,0) order_code,ifnull(`manual_cn`,0) manual_cn,ifnull(`order_date`,0)`order_date`,ifnull(`order_booking_date`,0)`order_booking_date`,ifnull(`order_arrival_date`,0)`order_arrival_date`,ifnull(`order_sc`,0)`order_sc`,ifnull(`order_deliver_date`,0)`order_deliver_date`,ifnull(`order_status`,0)`order_status`,
	ifnull(`destination_city_name`,0)`destination_city_name`,ifnull(`origin_city_name`,0)`origin_city_name`,ifnull(`saimtech_order`.`pieces`,0) `pieces`,ifnull(`saimtech_order`.`weight`,0)`weight`,ifnull(`saimtech_order`.`cod_amount`,0)`cod_amount`,ifnull(`consignee_name`,0)`consignee_name`,ifnull(`consignee_mobile`,0)`consignee_mobile`,
	ifnull(`consignee_address`,0)`consignee_address`,ifnull(`shipper_name`,0)`shipper_name`,ifnull(`shipper_phone`,0)`shipper_phone`,ifnull(`shipper_address`,0)`shipper_address`,ifnull(`order_pay_mode`,0)`order_pay_mode`,ifnull(`saimtech_order`.`arrival_id`,0)`arrival_id`,ifnull(`unloading_id`,0)`unloading_id`,ifnull(`loading_id`,0)`loading_id`,ifnull(`payment_mode`,0)`payment_mode`,
	ifnull(`on_route_id`,0)`on_route_id`,ifnull(`on_route_date`,0)`on_route_date`,ifnull(`saimtech_customer`.`customer_name`,0)`customer_name`,ifnull(`saimtech_service`.`service_name`,0)`service_name`,ifnull(`product_detail`,0)`product_detail`,ifnull(`shipment_received_by`,0)`shipment_received_by`,ifnull(`saimtech_rider`.`rider_name`,0) rider,
	ifnull(`saimtech_oper_user`.`oper_user_name`,0) `createdby` FROM `saimtech_order`

	        LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between? and ? AND order_status NOT IN ('Order','Cancelled') ";

		$res = $this->db->query($query, array($start_date, $end_date));

		$countrows = $res->num_rows();

		// for ( $i = 1; $i <= $countrows; $i++) {
		// 	return  $SrNo = $i;
		// 	//  echo "<pre>";
		// 	//  echo $SrNo;
		//  }

		return $res->result();
	}

	public function Get_Shipments_Super_Customer_Tm($start_date, $end_date, $customer)
	{
		$query = " SELECT  row_number() over(order by order_id) as 'row_number',`saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_sc`,`order_deliver_date`,`order_status`,
	`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,
	`consignee_address`,`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,
	`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`,`saimtech_rider`.`rider_name` AS `rider`,
	`saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_order`.`delivery_rider_id`
 			
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between ? and ? and `saimtech_order`.`customer_id`=? AND order_status<>'Cancelled'  Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}
	//--------------Super Shipments End---------------------------------------------

	//------------Pending Shipments Start-------------------------------------------
	public function Get_Shipments_Pending_Tm($start_date, $end_date)
	{
		$query = "SELECT row_number() over(order by order_id) as 'row_number',vehicle_no, `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_list_id`=`saimtech_order`.`loading_id`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between ? and ? AND order_status NOT IN ('Order','Cancelled','RTS','Deliverd','Delivered','Delivered','LOST')";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Pending_Customer_Tm($start_date, $end_date, $customer)
	{
		$query = "SELECT row_number() over(order by order_id) as 'row_number',vehicle_no, `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_list_id`=`saimtech_order`.`loading_id`
			WHERE date(`saimtech_arrival_detail`.`arrival_date`) between ? and ? AND `saimtech_order`.`customer_id`=? AND order_status NOT IN ('Order','Cancelled','RTS','Deliverd','Delivered','Delivered','LOST')  Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}
	//--------------Pending Shipments End-------------------------------------------	



	//------------complete Shipments Start-------------------------------------------
	public function Get_Shipments_Complete_Qsr($start_date, $end_date)
	{
		$query = "SELECT row_number() over(order by order_id) as 'row_number',vehicle_no, `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_list_id`=`saimtech_order`.`loading_id`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Complete_Qsr_Customer($start_date, $end_date, $customer)
	{
		$query = "SELECT row_number() over(order by order_id) as 'row_number',vehicle_no, `saimtech_order`.`order_code`,`manual_cn`,`order_date`,`order_booking_date`,`order_arrival_date`,`order_deliver_date`,`order_status`,`destination_city_name`,`origin_city_name`,`saimtech_order`.`pieces`,`saimtech_order`.`weight`,`saimtech_order`.`cod_amount`,`consignee_name`,`consignee_mobile`,`consignee_address`,
`shipper_name`,`shipper_phone`,`shipper_address`,`order_pay_mode`,`saimtech_order`.`arrival_id`,`unloading_id`,`loading_id`,`payment_mode`,`on_route_id`,`on_route_date`,`saimtech_customer`.`customer_name`,`saimtech_service`.`service_name`,`product_detail`,`shipment_received_by`, `saimtech_oper_user`.`oper_user_name` AS `createdby` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_transit_list` ON `saimtech_transit_list`.`transit_list_id`=`saimtech_order`.`loading_id`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? and `saimtech_order`.`customer_id`=?  Order By `saimtech_order`.`order_date` DESC ";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		// echo"<pre>";
		return $res->result();
	}
	//--------------complete Shipments End-------------------------------------------	


	public function Get_Shipments_Admin_Tm_DEO($start_date, $end_date)
	{
		$query = "SELECT * , `saimtech_city`.`is_enable` as `TM`,`saimtech_oper_user`.`oper_user_name` FROM `saimtech_order`
	        LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_order`.`destination_reporting`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? 
			AND order_status NOT IN ('Order','Cancelled' ) 
			AND `saimtech_order`.`created_by` IN ('7','12','34','30') 
			Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Admin_Customer_Tm_DEO($start_date, $end_date, $customer)
	{
		$query = "SELECT * , `saimtech_city`.`is_enable` as `TM`,`saimtech_oper_user`.`oper_user_name` FROM `saimtech_order` 
			LEFT JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
			LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			LEFT JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_order`.`destination_reporting`
			WHERE date(`saimtech_order`.`order_date`) between ? and ? 
			and `saimtech_order`.`customer_id` = ? 
			AND  order_status<>'Cancelled' 
			AND `saimtech_order`.`created_by` in ('7','12')
			Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}

	//----------------------Booking-Arrival Difference Check Start----------------------------

	public function Get_Shipments_Booking_difference($start_date, $end_date)
	{
		$query = "SELECT row_number() over(order by order_id) as 'row_number',`order_date`,`saimtech_order`.`order_code`,`manual_cn`,`saimtech_order`.`pieces` as pcs,`saimtech_order`.`weight` as wgt,
	`saimtech_arrival_detail`.`new_pieces` as Apieces,`saimtech_arrival_detail`.`new_weight` AS Aweight FROM `saimtech_order` 
	INNER JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code` 
	Where ((`saimtech_arrival_detail`.`new_weight`<>`saimtech_order`.`weight` AND `saimtech_arrival_detail`.`new_weight`<>'0')
	OR (`saimtech_arrival_detail`.`new_pieces`<>`saimtech_order`.`pieces` AND `saimtech_arrival_detail`.`new_pieces`<>'0'))
    AND (date(`order_date`)>=? and  date(`order_date`)<=?)  ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	//----------------------Booking-Arrival Difference Check End------------------------------

	//----------------------Arrival-Manifest Difference Check Start----------------------------

	public function Get_Shipments_Manifest_difference($start_date, $end_date)
	{
		$query = "SELECT `order_date`,`saimtech_order`.`order_code`,`saimtech_order`.`manual_cn`,`saimtech_order`.`pieces` as pcs,`saimtech_order`.`weight` as wgt,
	`saimtech_transit_detail`.`pieces` as Tpieces,`saimtech_transit_detail`.`weight` AS Tweight FROM `saimtech_order` 
    INNER JOIN  `saimtech_transit_detail` ON `saimtech_transit_detail`.`transit_cn` =`saimtech_order`.`order_code`
    Where ((`saimtech_transit_detail`.`weight`<>`saimtech_order`.`weight`) OR (`saimtech_transit_detail`.`pieces`<>`saimtech_order`.`pieces` ))
    AND (date(`order_date`)>=? and  date(`order_date`)<=?)  ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	//----------------------Arrival-Manifest Difference Check End------------------------------

	//----------------------Total Weight Check Start----------------------------
	public function Get_Shipments_Admin_Tm_OPS($start_date, $end_date)
	{
		$query = "SELECT COUNT(`order_code`) AS `TShip`,SUM(`pieces`) AS `TP`,ROUND(SUM(`weight`)) AS `TW` FROM `saimtech_order` 
	WHERE date(`order_date`) between ? and ? 
	AND  order_status<>'Cancelled' ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Admin_Customer_Tm_OPS($start_date, $end_date, $customer)
	{
		$query = "SELECT COUNT(`order_code`) AS `TShip`,SUM(`pieces`) AS `TP`,ROUND(SUM(`weight`)) AS `TW` FROM `saimtech_order` 
			WHERE date(`order_date`) between ? and ?
			and `customer_id`=? 
			AND  order_status<>'Cancelled'  ";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}

	//----------------------Total Weight Check End------------------------------


	public function Get_Shipments_Admin_Customer($start_date, $end_date, $customer)
	{
		$query = "SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) and `saimtech_order`.`customer_id`=? Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}


	public function Get_Shipments_Admin_Archive_Customer_Tm($start_date, $end_date, $customer)
	{
		$query = "SELECT * , `saimtech_city`.`is_enable` as `TM` FROM `saimtech_archive_order` 
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_archive_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_archive_order`.`destination_reporting`
			WHERE date(`saimtech_archive_order`.`order_date`) between ? and ?
			and `saimtech_archive_order`.`customer_id` = ? 
			Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}


	public function Get_Shipments_Admin_Archive_Customer($start_date, $end_date, $customer)
	{
		$query = "SELECT * FROM `saimtech_archive_order` 
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_archive_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			WHERE (date(`saimtech_archive_order`.`order_date`)>=? and  date(`saimtech_archive_order`.`order_date`)<=?) and `saimtech_archive_order`.`customer_id`=? Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}

	public function Get_Shipments_Admin_Archive($start_date, $end_date)
	{
		$query = "SELECT * 
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_archive_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			WHERE (date(`saimtech_archive_order`.`order_date`)>=? and  date(`saimtech_archive_order`.`order_date`)<=?)  Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Admin_Archive_Tm($start_date, $end_date)
	{
		$query = "SELECT *, row_number() over(order by order_id) as 'row_number', `saimtech_city`.`is_enable` as `TM` FROM `saimtech_archive_order` 
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_archive_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_archive_order`.`destination_reporting`
			WHERE date(`saimtech_archive_order`.`order_date`) between ? and ?
			Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Admin_Old($start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_old_portal` 
	        LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`old_portal_id`= `saimtech_old_portal`.`customer_id`
			WHERE (date(`order_date`)>=? and  date(`order_date`)<=?) Order By `order_date` DESC";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}



	public function Get_Shipments_Admin_Summary($start_date, $end_date)
	{
		$query = "SELECT `order_status`, COUNT(order_code) as `shipments`  FROM `saimtech_order` 
			WHERE date(`saimtech_order`.`order_date`) between ? and ?
			Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Pending_Summary($start_date, $end_date)
	{
		$query = "SELECT `order_status`, COUNT(`saimtech_order`.order_code) as `shipments`  FROM `saimtech_order` 
			 LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			WHERE (date(`saimtech_arrival_detail`.`arrival_date`)>=? and  date(`saimtech_arrival_detail`.`arrival_date`)<=?) AND `order_status`<>'Deliverd' AND `order_status`<>'Delivered' AND `order_status`<>'RTS' AND `order_status`<>'Cancelled' AND `order_status`<>'LOST'  Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}
	public function Get_Shipments_complete_Summary($start_date, $end_date)
	{
		$query = "SELECT `order_status`, COUNT(`saimtech_order`.order_code) as `shipments`  FROM `saimtech_order` 
			WHERE (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?)   Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}
	public function Get_Shipments_CS_Summary($start_date, $end_date)
	{
		$query = "SELECT `order_status`, COUNT(`saimtech_order`.order_code) as `shipments`  FROM `saimtech_order` 
	LEFT JOIN `saimtech_arrival_detail` ON `saimtech_arrival_detail`.`order_code`=`saimtech_order`.`order_code`
			WHERE (date(`saimtech_arrival_detail`.`arrival_date`)>=? and  date(`saimtech_arrival_detail`.`arrival_date`)<=?) AND  `order_status`<>'Cancelled' AND `order_status`<>'LOST'  Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Admin_Customer_Summary($start_date, $end_date, $customer)
	{
		$query = "SELECT `order_status`, COUNT(order_code) as `shipments`  FROM `saimtech_order`
	        LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			WHERE (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) and `customer_id`=? Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date, $customer));
		return $res->result();
	}

	public function Get_Shipments_Admin_Summary_archive($start_date, $end_date)
	{
		$query = "SELECT `order_status`, COUNT(order_code) as `shipments`  FROM `saimtech_archive_order` 
			WHERE date(`saimtech_archive_order`.`order_date`) between ? and  ? 
			Group By `order_status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}


	public function Get_Shipments_Admin_Summary_Old($start_date, $end_date)
	{
		$query = "SELECT `status` as `order_status`, COUNT(cn) as `shipments`  FROM `saimtech_old_portal` 
			WHERE date(`order_date`) between ? and ?
			Group By `status` ";
		$res = $this->db->query($query, array($start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Branch($oid, $start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE (`origin_reporting`=? OR `destination_reporting`=? ) and (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}


	public function Get_Shipments_Branch_Archive($oid, $start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_archive_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_archive_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_archive_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_archive_order`.`order_service_type`
			WHERE (`origin_reporting`=? OR `destination_reporting`=? ) and (date(`saimtech_archive_order`.`order_date`)>=? and  date(`saimtech_archive_order`.`order_date`)<=?) Order By `saimtech_archive_order`.`order_date` DESC";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}
	public function Get_Shipments_Branch_Old($oid, $start_date, $end_date)
	{
		$query = "SELECT * FROM `saimtech_old_portal`
	        LEFT JOIN `saimtech_customer` ON `saimtech_customer`.`old_portal_id`= `saimtech_old_portal`.`customer_id`
			WHERE (`origin`=? OR `destination`=? ) and (date(`order_date`)>=? and  date(`order_date`)<=?) Order By `order_date` DESC";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}


	public function Get_Shipments_Branch_Summary($oid, $start_date, $end_date)
	{
		$query = "SELECT  `order_status`, COUNT(order_code) as `shipments` FROM `saimtech_order` 
			WHERE (`origin_reporting`=? OR `destination_reporting`=? ) and  (date(`saimtech_order`.`order_date`)>=? and  date(`saimtech_order`.`order_date`)<=?) Group By `order_status` ";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Branch_Summary_Archive($oid, $start_date, $end_date)
	{
		$query = "SELECT  `order_status`, COUNT(order_code) as `shipments` FROM `saimtech_archive_order` 
			WHERE (`origin_reporting`=? OR `destination_reporting`=? ) and  (date(`saimtech_archive_order`.`order_date`)>=? and  date(`saimtech_archive_order`.`order_date`)<=?) Group By `order_status` ";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}

	public function Get_Shipments_Branch_Summary_Old($oid, $start_date, $end_date)
	{
		$query = "SELECT  `status` as `order_status`, COUNT(cn) as `shipments` FROM `saimtech_old_portal` 
			WHERE (`origin`=? OR `destination`=?  ) and  ((`order_date`)>=? and  date(`order_date`)<=?) Group By `status` ";
		$res = $this->db->query($query, array($oid, $oid, $start_date, $end_date));
		return $res->result();
	}


	//-------------------------------------------------------------
	/* public function Get_Pendding_Shipments_Admin(){
	$query="SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE order_status<>'ORDER' AND order_status<>'Booking' AND order_status<>'Deliverd' AND order_status<>'RTS' Order By `saimtech_order`.`order_date` DESC";
	$res = $this->db->query($query);
    return $res->result();
	}
	
	public function Get_Pendding_Shipments_Admin_Summary(){
	$query="SELECT `order_status`, COUNT(order_code) as `shipments`  FROM `saimtech_order` 
			WHERE order_status<>'ORDER' AND order_status<>'Booking' AND order_status<>'Deliverd' AND order_status<>'RTS' Group By `order_status` ";
	$res = $this->db->query($query);
    return $res->result();
	}
	
*/
	public function Get_Pending_Shipments_Branch($oid)
	{
		$query = "SELECT *, DATEDIFF(CURDATE(),date(order_arrival_date)) as `DOS`,`saimtech_order`.`modify_date` as `lastactivitydate` FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE DATEDIFF(CURDATE(),date(order_arrival_date))>3 AND (`origin_reporting`=? OR `destination_reporting`=? ) AND (order_status<>'ORDER' AND order_status<>'Booking' AND order_status<>'Cancelled' AND order_status<>'Deliverd' AND order_status<>'RTS') and is_final='0' Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($oid, $oid));
		return $res->result();
	}


	public function Get_Pending_Shipments_Sale($uid)
	{
		$query = "SELECT *, DATEDIFF(CURDATE(),date(order_arrival_date)) as `DOS`,`saimtech_order`.`modify_date` as `lastactivitydate` FROM `saimtech_order` 
			INNER JOIN `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE DATEDIFF(CURDATE(),date(order_arrival_date))>3 AND (`saimtech_customer`.`created_by`=?) AND (order_status<>'ORDER' AND order_status<>'Booking' AND order_status<>'Cancelled' AND order_status<>'Deliverd' AND order_status<>'RTS') and is_final='0' Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($uid));
		return $res->result();
	}

	public function Get_Pending_Shipments_admin()
	{

		$query = "SELECT*,
            DATEDIFF(CURDATE(), DATE(order_date)) AS `DOS`,
            `saimtech_order`.`modify_date` AS `lastactivitydate`
        FROM
            `saimtech_order`
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
            INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
        WHERE
            DATEDIFF(CURDATE(), DATE(order_date)) > 3 
            AND order_status NOT IN ('ORDER','Booking','Cancelled','Deliverd','RTS') 
            AND is_final = '0' 
            AND date(`order_date`) >= date(DATE_SUB(NOW(), INTERVAL 60 DAY))
        ORDER BY
            `DOS` DESC limit 10";

		$res = $this->db->query($query);
		return $res->result();
	}

	public function Get_Pending_Pickups($origin_id)
	{
		$query = "SELECT * FROM `saimtech_order` 
			INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
			INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id`=`saimtech_order`.`order_service_type`
			WHERE order_status='Booking' and is_final='0' AND `origin_city`=?  AND `manual_cn`='' AND `saimtech_order`.`order_date`>='2021-02-15'  Order By `saimtech_order`.`order_date` DESC";
		$res = $this->db->query($query, array($origin_id));
		return $res->result();
	}


	//	public function Get_Pendding_Shipments_Branch_Summary($oid){
	//	$query="SELECT  `order_status`, COUNT(order_code) as `shipments` FROM `saimtech_order` 
	//			WHERE (`origin_reporting`=? OR `destination_reporting`=? ) Group By `order_status` ";
	//	$res = $this->db->query($query,array($oid,$oid));
	//  return $res->result();
	//}

	public function Get_Incomming_Pendings_By_Orgin($origin_id)
	{
		$query = "SELECT COUNT(order_code) as `cns` FROM `saimtech_order` WHERE `destination_reporting`=? AND order_status='Loading'";
		$res = $this->db->query($query, array($origin_id));
		$row = $res->result_array();
		return $row[0]['cns'];
	}


	public function Get_Incomming_Pendings_By_Sale($uid)
	{
		$query = "SELECT COUNT(order_code) as `cns` FROM `saimtech_order`
        INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
        WHERE `saimtech_customer`.`created_by`=? AND order_status='Loading'";
		$res = $this->db->query($query, array($uid));
		$row = $res->result_array();
		return $row[0]['cns'];
	}

	public function Get_Incomming_Pendings_By_Admin()
	{
		$query = "SELECT COUNT(order_code) as `cns` FROM `saimtech_order` WHERE order_status='Loading'";
		$res = $this->db->query($query);
		$row = $res->result_array();
		return $row[0]['cns'];
	}


	public function Get_Incomming_Pendings_By_Orgin_detail($origin_id)
	{
		$query = "SELECT * FROM `saimtech_order` WHERE `destination_reporting`=? AND order_status='Loading'";
		$res = $this->db->query($query, array($origin_id));
		return $res->result();
	}

	public function Get_Incomming_Pendings_By_Sale_detail($uid)
	{
		$query = "SELECT * FROM `saimtech_order` INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
        WHERE `saimtech_customer`.`created_by`=?  AND order_status='Loading'";
		$res = $this->db->query($query, array($uid));
		return $res->result();
	}

	public function Get_Incomming_Pendings_By_Admin_detail()
	{
		$query = "SELECT * FROM `saimtech_order` WHERE order_status='Loading'";
		$res = $this->db->query($query);
		return $res->result();
	}


	public function Get_Pendings_DD_By_Orgin_detail($origin_id)
	{
		$query = "SELECT delivery_code as Sheet,
          date(`saimtech_delivery_list`.delivery_date) as Date, 
          rider_name, 
          city_name, 
          COUNT(`saimtech_delivery_detail`.`order_code`) as `Pending_DD` 
          FROM `saimtech_delivery_list` 
          INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
          INNER JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_delivery_list`.`rider_id`
          INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_delivery_list`.`delivery_origin` 
          WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0  and `saimtech_delivery_list`.`delivery_origin`=?
          Group By `delivery_code`";
		$res = $this->db->query($query, array($origin_id));
		return $res->result();
	}


	public function Get_Pendings_Manifest_By_Orgin_detail($origin_id)
	{
		$query = "SELECT `transit_code` as manifest,
  COUNT(`saimtech_transit_detail`.`transit_cn`) AS `Total_CN`,
  `saimtech_city`.`city_name` AS City,
  `complete_sheet_date` AS date 
  FROM `saimtech_transit_list`
LEFT JOIN `saimtech_order` ON `saimtech_order`.`loading_id`=`saimtech_transit_list`.`transit_code`
LEFT JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_transit_list`.`transit_origin`
LEFT JOIN `saimtech_transit_detail` ON `saimtech_transit_detail`.`transit_list_id`=`saimtech_transit_list`.`transit_list_id`
WHERE `saimtech_order`.`order_status`<>'Deliverd' AND `saimtech_order`.`order_status`<>'Booking' 
AND `saimtech_order`.`order_status`<>'Arrival' AND `saimtech_order`.`order_status`<>'RTS' 
AND `saimtech_order`.`order_status`<>'Cancelled' AND date(`saimtech_transit_list`.`created_date`)<='2021-02-01' AND  `transit_origin`=?
 group by `transit_code`";
		$res = $this->db->query($query, array($origin_id));
		return $res->result();
	}


	public function Get_Pendings_DD_By_Sale_detail($uid)
	{
		$query = "SELECT delivery_code as Sheet,
          date(`saimtech_delivery_list`.delivery_date) as Date, 
          rider_name, 
          city_name, 
          COUNT(`saimtech_delivery_detail`.`order_code`) as `Pending_DD` 
          FROM `saimtech_delivery_list` 
          INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
          INNER JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_delivery_list`.`rider_id`
          INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_delivery_list`.`delivery_origin` 
          INNER JOIN `saimtech_order` ON `saimtech_order`.`customer_id`=`saimtech_order`.`on_route_id`=`saimtech_delivery_list`.`delivery_code` 
          INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
          WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0  and `saimtech_customer`.`created_by`=?
          Group By `delivery_code`";
		$res = $this->db->query($query, array($uid));
		return $res->result();
	}


	public function Get_Pendings_DD_By_Admin_detail()
	{
		$query = "SELECT delivery_code as Sheet,
          date(`saimtech_delivery_list`.delivery_date) as Date, 
          rider_name, 
          city_name, 
          COUNT(`saimtech_delivery_detail`.`order_code`) as `Pending_DD` 
          FROM `saimtech_delivery_list` 
          INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
          INNER JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_delivery_list`.`rider_id`
          INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_delivery_list`.`delivery_origin` 
          WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0  
          Group By `delivery_code`";
		$res = $this->db->query($query);
		return $res->result();
	}


	public function Get_Pendings_DD_By_TPT_detail($uid)
	{
		$query = "SELECT delivery_code as Sheet,
          date(`saimtech_delivery_list`.delivery_date) as Date, 
          rider_name, 
          city_name, 
          COUNT(`saimtech_delivery_detail`.`order_code`) as `Pending_DD` 
          FROM `saimtech_delivery_list` 
          INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
          INNER JOIN `saimtech_rider` ON `saimtech_rider`.`rider_id`=`saimtech_delivery_list`.`rider_id`
          INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_delivery_list`.`delivery_origin` 
          WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0  and  `saimtech_delivery_list`.`delivery_created_by`=? 
          Group By `delivery_code`";
		$res = $this->db->query($query, array($uid));
		return $res->result();
	}

	public function Get_Pendings_DD_By_Orgin_Count($origin_id)
	{
		$query = "SELECT COUNT(DISTINCT(`delivery_code`))as `Sheet` FROM `saimtech_delivery_list` 
            INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
            WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0 and  `saimtech_delivery_list`.`delivery_origin`=?";
		$res = $this->db->query($query, array($origin_id));
		$row = $res->result_array();
		return $row[0]['Sheet'];
	}


	public function Get_Pendings_DD_By_Sale_Count($uid)
	{
		$query = "SELECT COUNT(DISTINCT(`delivery_code`))as `Sheet` FROM `saimtech_delivery_list` 
            INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
            INNER JOIN `saimtech_order` ON `saimtech_order`.`customer_id`=`saimtech_order`.`on_route_id`=`saimtech_delivery_list`.`delivery_code` 
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0 and `saimtech_customer`.`created_by`=?";
		$res = $this->db->query($query, array($uid));
		$row = $res->result_array();
		return $row[0]['Sheet'];
	}

	public function Get_Pendings_DD_By_TPT_Count($uid)
	{
		$query = "SELECT COUNT(DISTINCT(`delivery_code`)) as `Sheet` FROM `saimtech_delivery_list` 
            INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
            WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0 and  `saimtech_delivery_list`.`delivery_created_by`=?";
		$res = $this->db->query($query, array($uid));
		$row = $res->result_array();
		return $row[0]['Sheet'];
	}



	public function Get_Pendings_DD_By_Admin_Count()
	{
		$query = "SELECT COUNT(DISTINCT(`delivery_code`))as `Sheet` FROM `saimtech_delivery_list` 
            INNER JOIN `saimtech_delivery_detail` ON `saimtech_delivery_detail`.`delivery_list_id` = `saimtech_delivery_list`.`delivery_list_id` 
            WHERE `delivery_type` is null and `saimtech_delivery_detail`.`is_delivery2`=0 ";
		$res = $this->db->query($query);
		$row = $res->result_array();
		return $row[0]['Sheet'];
	}

	public function Get_Pendings_Pickup_By_Orgin_Count($origin_id)
	{
		$query = "SELECT Count(DISTINCT(`load_sheet_id`)) as `LoadSheet` FROM `saimtech_order` WHERE `order_status`='Booking' and `origin_city`=?";
		$res = $this->db->query($query, array($origin_id));
		$row = $res->result_array();
		return $row[0]['LoadSheet'];
	}

	public function Get_Pendings_Pickup_By_Sale_Count($uid)
	{
		$query = "SELECT Count(DISTINCT(`load_sheet_id`)) as `LoadSheet` FROM `saimtech_order` 
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            WHERE `saimtech_customer`.`created_by`=? and `order_status`='Booking' ";
		$res = $this->db->query($query, array($uid));
		$row = $res->result_array();
		return $row[0]['LoadSheet'];
	}


	public function Get_Pendings_Pickup_By_Admin_Count()
	{
		$query = "SELECT Count(DISTINCT(`load_sheet_id`)) as `LoadSheet` FROM `saimtech_order` WHERE `order_status`='Booking' ";
		$res = $this->db->query($query);
		$row = $res->result_array();
		return $row[0]['LoadSheet'];
	}

	public function Get_Pendings_Pickup_By_Orgin_Detail($origin_id)
	{
		$query = "SELECT `customer_name` as `Shipper`,
            `load_sheet_id` as `LoadSheet`, 
            `origin_city_name` as `Origin`,
            `order_booking_date` as `BookingDate`,
            `saimtech_pickup_points`.`point` as `Pickup_Address`, 
            `saimtech_pickup_points`.`name`  as `Name`, 
            `saimtech_pickup_points`.`phone` as `Phone`,  
            COUNT(`order_id`) as `Shipments` 
            FROM `saimtech_order` 
            INNER JOIN  `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            INNER JOIN  `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
            WHERE `order_status`='Booking' and `origin_city`=? group by `load_sheet_id` ";
		$res = $this->db->query($query, array($origin_id));
		return $res->result();
	}


	public function Get_Pendings_Pickup_By_Sale_Detail($uid)
	{
		$query = "SELECT `customer_name` as `Shipper`,
            `load_sheet_id` as `LoadSheet`, 
            `origin_city_name` as `Origin`,
            `order_booking_date` as `BookingDate`,
            `saimtech_pickup_points`.`point` as `Pickup_Address`, 
            `saimtech_pickup_points`.`name`  as `Name`, 
            `saimtech_pickup_points`.`phone` as `Phone`,  
            COUNT(`order_id`) as `Shipments` 
            FROM `saimtech_order` 
            INNER JOIN  `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            INNER JOIN  `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
            WHERE `order_status`='Booking' and `saimtech_customer`.`created_by`=? group by `load_sheet_id` ";
		$res = $this->db->query($query, array($uid));
		return $res->result();
	}


	public function Get_Pendings_Pickup_By_Admin_Detail()
	{
		$query = "SELECT `customer_name` as `Shipper`,
            `load_sheet_id` as `LoadSheet`, 
            `origin_city_name` as `Origin`,
            `order_booking_date` as `BookingDate`,
            `saimtech_pickup_points`.`point` as `Pickup_Address`, 
            `saimtech_pickup_points`.`name`  as `Name`, 
            `saimtech_pickup_points`.`phone` as `Phone`,  
            COUNT(`order_id`) as `Shipments` 
            FROM `saimtech_order` 
            INNER JOIN  `saimtech_customer` ON `saimtech_customer`.`customer_id`=`saimtech_order`.`customer_id`
            INNER JOIN  `saimtech_pickup_points` ON `saimtech_pickup_points`.`points_id`=`saimtech_order`.`pickup_point_id`
            WHERE `order_status`='Booking' group by `load_sheet_id` ";
		$res = $this->db->query($query);
		return $res->result();
	}

	public function Get_TPT_Pending_Shipments($agent_id)
	{
		$query = "SELECT * FROM `saimtech_agent_order`
            WHERE (`agent_status`<> 'Deliverd' AND `agent_status`<> 'RTD' AND `agent_status`<> 'Hand Over To') and  agent_id=?";
		$res = $this->db->query($query, array($agent_id));
		return $res->result();
	}

	function display_pending_record($pagelimit)
	{
		if ($pagelimit>1) {
			$query=$this->db->query(" SELECT*,
            DATEDIFF(CURDATE(), DATE(order_date)) AS `DOS`,
            `saimtech_order`.`modify_date` AS `lastactivitydate`
        FROM
            `saimtech_order`
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
            INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
        WHERE
            DATEDIFF(CURDATE(), DATE(order_date)) > 3 
            AND order_status NOT IN ('ORDER','Booking','Cancelled','Deliverd','RTS') 
            AND is_final = '0' 
            AND date(`order_date`) >= date(DATE_SUB(NOW(), INTERVAL 60 DAY))
        ORDER BY
            `DOS` DESC limit $pagelimit ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}else{
			$query=$this->db->query("SELECT*,
            DATEDIFF(CURDATE(), DATE(order_date)) AS `DOS`,
            `saimtech_order`.`modify_date` AS `lastactivitydate`
        FROM
            `saimtech_order`
            INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
            INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
        WHERE
            DATEDIFF(CURDATE(), DATE(order_date)) > 3 
            AND order_status NOT IN ('ORDER','Booking','Cancelled','Deliverd','RTS') 
            AND is_final = '0' 
            AND date(`order_date`) >= date(DATE_SUB(NOW(), INTERVAL 60 DAY))
        ORDER BY
            `DOS` DESC   ");
		// $query=$this->db->query(" SELECT * FROM saimtech_oper_user LIMIT $pagelimit ");
		return $query->result();
		}
		
	} 
function display_md_booking_30days()
	{
	//   $user=$this->db->get("saimtech_oper_user");
	  $user=$this->db->query("SELECT * from saimtech_oper_user  ORDER BY oper_user_id DESC ");
	  return $user->result();
	}
	public function Get_Pendings_Pickup_By_TPT_Count($agent_id)
	{
		$query = "SELECT Count(DISTINCT(`agent_order_code`)) as `countt` FROM `saimtech_agent_order` WHERE `agent_status`='Hand Over To' and `agent_id`=?  ";
		$res = $this->db->query($query, array($agent_id));
		$row = $res->result_array();
		return $row[0]['countt'];
	}

	public function Get_Pendings_Pickup_By_TPT_Detail($agent_id)
	{
		$query = "SELECT * FROM `saimtech_agent_order` WHERE `agent_status`='Hand Over To' and `agent_id`=?  ";
		$res = $this->db->query($query, array($agent_id));
		return $res->result();
	}

	public function Get_All_Deliverd_TPT_Detail($agent_id)
	{
		$query = "SELECT * FROM `saimtech_agent_order` WHERE `agent_status`='Deliverd' and `agent_id`=?  ";
		$res = $this->db->query($query, array($agent_id));
		return $res->result();
	}

	public function Get_All_RTD_TPT_Detail($agent_id)
	{
		$query = "SELECT * FROM `saimtech_agent_order` WHERE `agent_status`='RTD' and `agent_id`=?  ";
		$res = $this->db->query($query, array($agent_id));
		return $res->result();
	}
}

