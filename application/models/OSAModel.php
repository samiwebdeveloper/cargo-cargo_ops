<?php
class OSAModel extends CI_Model
{
    public function Insert_record($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return  $this->db->last_query();
    }

    public function get_customer_id($customer_name)
    {
         $query = "select * from saimtech_customer where customer_name='$customer_name'";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function pending_osa_status($start_date, $end_date)
    {
        
            $query = "SELECT date(order_arrival_date) arrival_date, order_code, manual_cn, order_status, consignee_name, shipper_name, origin_city_name, destination_city_name, order_osa, order_osa_sd_total,saimtech_customer.customer_name FROM `saimtech_order` INNER JOIN  saimtech_customer on saimtech_order.customer_id=saimtech_customer.customer_id
            where  date(order_arrival_date) between '$start_date' and '$end_date'
            and order_service_type = 2 and destination_city not in (2,161,1,8,5,7,17,112,102,22,15,4,3,6,9,82,87,19,74,140) order by order_date desc";
    
        $res = $this->db->query($query);
        return $res->result_array();
    }


    public function Update_Record($row_id, $soft_copy_check, $hard_copy_check, $request_by_check, $created_by, $created_at, $edit_dc)
    {
        if ($soft_copy_check == 1) {
            $query = "UPDATE `dc_status` SET `dc_No`='$edit_dc',`soft_copy_check`='$soft_copy_check',`soft_copy_by`='$created_by',`soft_copy_at`='$created_at' WHERE `row_id`='$row_id' ";
            $this->db->query($query);
        }

        if ($hard_copy_check == 1) {
            $query = "UPDATE `dc_status` SET `dc_No`='$edit_dc',`hard_copy_check`='$hard_copy_check',`hard_copy_by`='$created_by',`hard_copy_at`='$created_at' WHERE `row_id`='$row_id' ";
            $this->db->query($query);
        }

        if ($request_by_check == 1) {
            $query = "UPDATE `dc_status` SET `dc_No`='$edit_dc',`request_by_check`='$request_by_check',`requested_by`='$created_by',`requested_at`='$created_at' WHERE `row_id`='$row_id' ";
            $this->db->query($query);
        }
    }
    public function update_osa($row_id, $edit_osa)
    {
        $query = "UPDATE `saimtech_order` SET `order_osa`='$edit_osa' WHERE `order_code`='$row_id' ";
        $this->db->query($query);
    }
    
    public function update_sd($row_id, $edit_sd,$edit_order_osa)
    {
        $query = "UPDATE `saimtech_order` SET `order_osa_sd_total`='$edit_sd',`order_osa`='$edit_order_osa'  WHERE `order_code`='$row_id' ";
        $this->db->query($query);
    }
}
