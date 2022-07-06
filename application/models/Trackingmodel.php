<?php
class Trackingmodel extends CI_Model
{


    public function Get_Shipment_Date_By_Cn($cn)
    {
        $query = "SELECT * FROM `saimtech_order` 
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` = `saimtech_order`.`customer_id`
WHERE (`order_code`=? OR `manual_cn`=?) ";
        $res = $this->db->query($query, array($cn, $cn));
        return $res->result_array();
    }
    public function Get_Shipment_Detail($cn)
    {
        $query = "SELECT `saimtech_order`.*,`saimtech_service`.`service_name`  FROM `saimtech_order` 
INNER JOIN `saimtech_service` on `saimtech_service`.`service_id` = `saimtech_order`.`order_service_type`
WHERE order_status not in ('Order','Booking') and (`order_code`='$cn' OR `manual_cn`='$cn')  ";
        $res = $this->db->query($query, array($cn, $cn));
        return $res->result_array();
    }
    public function Get_trackinghistory($order_id)
    {
        $query = "SELECT * FROM `saimtech_order_tracking` 
WHERE order_event not in ('Order','Booking') and `order_id`='$order_id' order by `order_event_date` DESC";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function Get_Shipment_Date_By_Cn_Archive($cn)
    {
        $query = "SELECT * FROM `saimtech_archive_order` 
INNER JOIN `saimtech_customer` on `saimtech_customer`.`customer_id` = `saimtech_archive_order`.`customer_id`
WHERE (`order_code`=?  OR `manual_cn`=?)";
        $res = $this->db->query($query, array($cn, $cn));
        return $res->result_array();
    }
   
    public function Get_Shipment_detail_by_orderID($id)
    {
        $query = "SELECT * FROM `saimtech_order_tracking` 
Left JOIN `saimtech_status`ON `saimtech_status`.`status_id`=`saimtech_order_tracking`.`order_reason`
Left JOIN `saimtech_oper_user` ON  `saimtech_oper_user`.`oper_user_id` = `saimtech_order_tracking`.`created_by`
WHERE `order_id`=? order by `order_event_date` ASC";
        $res = $this->db->query($query, array($id));
        // echo $this->db->last_query();
        return $res->result();
    }
}
