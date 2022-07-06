<?php
class Bookingmodel extends CI_Model {

	
public function Get_Active_Pickup_Points_By_Customer_id($cid){
$query="SELECT *, `saimtech_pickup_points`.`is_enable` as `enable` FROM `saimtech_pickup_points` 
	INNER JOIN `saimtech_country` ON `saimtech_country`.`country_id`=`saimtech_pickup_points`.`country_id`
	INNER JOIN `saimtech_city` ON `saimtech_city`.`city_id`=`saimtech_pickup_points`.`city_id`
	WHERE `saimtech_pickup_points`.`is_del_enable`='0' AND `customer_id`=? AND `saimtech_pickup_points`.`is_enable`=1";
$res = $this->db->query($query,array($cid));
return $res->result();
}

public function Get_Active_Cities(){
$query="SELECT * FROM `saimtech_city` INNER JOIN `saimtech_country` ON `saimtech_country`.`country_id`=`saimtech_city`.`country_id` where `saimtech_city`.`is_enable`=1 and (`city_type`='DP' OR `city_type`='D')";
$res = $this->db->query($query);
return $res->result();
}

public function Get_All_Cities(){
$query="SELECT * FROM `saimtech_city` INNER JOIN `saimtech_country` ON `saimtech_country`.`country_id`=`saimtech_city`.`country_id` where (`city_type`='DP' OR `city_type`='D') and `is_delete`=0";
$res = $this->db->query($query);
return $res->result();
}


public function Get_Active_Cities_api(){
$query="SELECT city_id,city_name,city_code FROM `saimtech_city` INNER JOIN `saimtech_country` ON `saimtech_country`.`country_id`=`saimtech_city`.`country_id` where `saimtech_city`.`is_enable`=1 and (`city_type`='DP' OR `city_type`='D')";
$res = $this->db->query($query);
return $res->result();
}


public function Get_Last_Order(){
$id=0;
$code=0;
$year=0;
$sy_y=0;
$select_query="SELECT * from saimtech_order_code";
$res = $this->db->query($select_query);
$row=$res->result_array();
$id=$row[0]['order_code'];
$sys_y=$row[0]['order_year'];
if($sys_y==date('y')){
$code=(($id)+1);
$year=$sys_y;
} else {
$code=1;
$year=date('y');	
}
$query="UPDATE `saimtech_order_code` SET `order_code`=?,`order_year`=? WHERE 1";
$res = $this->db->query($query,array($code,$year));
return $code;
}
	

public function Get_Orders_By_CID($cid){
$query="SELECT *  FROM `saimtech_order` WHERE (`order_status`='Order' OR `order_status`='Booked') AND `customer_id`=? ";
$res = $this->db->query($query,array($cid));
return $res->result();
}

public function Get_After_Orders_By_CID($cid){
$query="SELECT *  FROM `saimtech_order` WHERE (`order_status`<>'RTS' AND `order_status`<>'Deliverd' AND `order_status`<>'On Route' ) AND `customer_id`=?  AND `is_invoice`<>1  AND `order_status`<>'Cancelled' AND `is_final`<>1 ";
$res = $this->db->query($query,array($cid));
return $res->result();
}

public function Get_After_Orders_By_Order_ID($id){
$query="SELECT *  FROM `saimtech_order` WHERE (`order_status`<>'RTS' AND `order_status`<>'Deliverd' AND `order_status`<>'On Route' ) AND `order_id`=?  AND `is_invoice`<>1 AND `is_final`<>1  ";
$res = $this->db->query($query,array($id));
return $res->result_array();
}


public function Get_Selected_label_address($cid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_print_label_temp` on `saimtech_print_label_temp`.`print_cn` =`saimtech_order`.`order_code`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`customer_id`=? order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($cid));
return $res->result();
}
public function Get_Selected_label_address1($orderid){
// $query="SELECT *,`saimtech_oper_user`.`oper_user_name` AS `createdby`  FROM `saimtech_order`
// INNER JOIN `saimtech_oper_user` ON `saimtech_oper_user`.`oper_user_id`=`saimtech_order`.`created_by`
// INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
// INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type` 
//WHERE `saimtech_order`.`order_id`=? order by `saimtech_order`.`order_date`";
$query="SELECT *, IF(LENGTH((SELECT user_name FROM `saimtech_user` WHERE `saimtech_user`.`user_id` = `saimtech_order`.`created_by`)) > 1,(SELECT user_name FROM `saimtech_user` WHERE `saimtech_user`.`user_id` = `saimtech_order`.`created_by`), (SELECT oper_user_name FROM `saimtech_oper_user` WHERE `saimtech_oper_user`.`oper_user_id` = `saimtech_order`.`created_by`)) AS `createdby`
FROM `saimtech_order`
        INNER JOIN `saimtech_customer` ON `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
        INNER JOIN `saimtech_service` ON `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`order_id` = ? ORDER BY `saimtech_order`.`order_date`";
$res = $this->db->query($query,array($orderid));
return $res->result();
}

public function Get_Single_label_address($orderid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`order_id`=? order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($orderid));
return $res->result();
}

public function Get_ALL_Label_Address($cid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`customer_id`=? and  order_status='Order' order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($cid));
return $res->result();
}

public function Get_Eligible_Load_Sheet($cid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`customer_id`=? and  order_status='Order' and temp_LS=0 and load_sheet_id=0 order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($cid));
return $res->result();
}


public function Get_Eligible_Load_Sheet_UID($uid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`created_by`=? and  order_status='Order' and temp_LS=0 and load_sheet_id=0 order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($uid));
return $res->result();
}


public function Get_Select_Cn_Sheet($cid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`customer_id`=? and  order_status='Order' and temp_LS=1 and load_sheet_id=0 order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($cid));
return $res->result();
}


public function Get_Select_Cn_Sheet_UID($cid){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`created_by`=? and  order_status='Order' and temp_LS=1 and load_sheet_id=0 order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($cid));
return $res->result();
}


public function Get_Load_Sheet_By_Customer($cid){
$query="SELECT load_sheet_code as sheet_code, `load_sheet_date`, load_sheet_cn as `cn`  FROM `saimtech_load_sheet` where customer_id= ? group by  load_sheet_code order by Load_sheet_date DESC";
$res = $this->db->query($query,array($cid));
return $res->result();
}



public function Get_Load_Sheet_By_Customer_UID($uid){
$query="SELECT load_sheet_code as sheet_code, `load_sheet_date`, load_sheet_cn as `cn`  FROM `saimtech_load_sheet` where created_by= ? group by  load_sheet_code order by Load_sheet_date DESC";
$res = $this->db->query($query,array($uid));
return $res->result();
}

public function Get_load_sheet_label_address($sheetcode){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` =`saimtech_order`.`order_service_type`
WHERE `saimtech_order`.`load_sheet_id`=? order by `saimtech_order`.`order_date` ";
$res = $this->db->query($query,array($sheetcode));
return $res->result();	
}

public function Get_load_sheet_by_code($sheetcode){
$query="SELECT *  FROM `saimtech_order`
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` =`saimtech_order`.`customer_id`
WHERE `saimtech_order`.`load_sheet_id`=? ";
$res = $this->db->query($query,array($sheetcode));
return $res->result();	
}


public function Get_Last_Load_Sheet_Code(){
$id=0;
$code=0;
$year=0;
$sy_y=0;
$select_query="SELECT * from saimtech_order_code";
$res = $this->db->query($select_query);
$row=$res->result_array();
$id=$row[0]['load_sheet_code'];
$sys_y=$row[0]['order_year'];
if($sys_y==date('y')){
$code=(($id)+1);
$year=$sys_y;
} else {
$code=1;
$year=date('y');	
}
$query="UPDATE `saimtech_order_code` SET `load_sheet_code`=?,`order_year`=? WHERE 1";
$res = $this->db->query($query,array($code,$year));
return $code;
}

public function Get_All_Cancelled_Order($userid){
$query="SELECT * FROM `saimtech_order` WHERE order_status='Cancelled' and customer_id=?";
$res = $this->db->query($query,array($userid));
return $res->result();
}


public function Get_All_Cancelled_Order_UID($userid){
$query="SELECT * FROM `saimtech_order` WHERE order_status='Cancelled' and created_by=?";
$res = $this->db->query($query,array($userid));
return $res->result();
}

public function Get_customer_by_api_key($api_key){
$query="SELECT * FROM `saimtech_customer` WHERE `api_key`=?";
$res = $this->db->query($query,array($api_key));
return $res->result_array();
}

}
 