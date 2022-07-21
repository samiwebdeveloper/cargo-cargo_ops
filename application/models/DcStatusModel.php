<?php
class DcStatusModel extends CI_Model
{
    public function Insert_record($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return  $this->db->last_query();
    }

    public function get_customer_id($customer_name)
    {
        echo $query = "select * from saimtech_customer where customer_name='$customer_name'";
        exit;
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_complete_dc($customer_id, $get_month)
    {
        $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by from dc_status
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id 
        left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id 
        left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id
        left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
        where saimtech_customer.customer_id='$customer_id' and DATE_FORMAT(DATE(saimtech_order.order_arrival_date),'%b-%y')='$get_month' and dc_status.soft_copy_check in(0,1) and saimtech_order.order_status in('Deliverd','Delivered') order by dc_status.row_id desc";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function soft_copy_pending($customer_id, $get_month)
    {
        $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by from dc_status
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id 
        left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id 
        left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id
        left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
        where saimtech_customer.customer_id='$customer_id' and DATE_FORMAT(DATE(saimtech_order.order_arrival_date),'%b-%y')='$get_month' and dc_status.soft_copy_check in(0) and saimtech_order.order_status in('Deliverd','Delivered') order by dc_status.row_id desc";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function hard_copy_pending($customer_id, $get_month)
    {
        $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by from dc_status
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id 
        left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id 
        left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id
        left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
        where saimtech_customer.customer_id='$customer_id' and DATE_FORMAT(DATE(saimtech_order.order_arrival_date),'%b-%y')='$get_month' and dc_status.hard_copy_check in(0) and saimtech_order.order_status in('Deliverd','Delivered') order by dc_status.row_id desc";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function pending_dc_status($start_date, $end_date)
    {
        if ($start_date == '' && $end_date == '') {
            $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by   from dc_status 
            inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
            inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
            left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id
            left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id 
            left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
            where (soft_copy_check = 0 or hard_copy_check = 0)
            order by dc_status.row_id desc ";
        } else {
            $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by   from dc_status 
            inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
            inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
            left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id
            left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id 
            left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
            where   saimtech_order.order_arrival_date between '$start_date' and '$end_date' and (soft_copy_check =0 OR hard_copy_check = 0 )
            order by dc_status.row_id desc ";
        }


        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function complete_dc_status($start_date, $end_date)
    {
        if ($start_date != '' && $end_date != '') {


            $query = " SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by   from dc_status 
            inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
            inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
            left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id
            left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id 
            left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
            where saimtech_order.order_arrival_date between'$start_date' and '$end_date'  and soft_copy_check =1 and hard_copy_check =1
            order by dc_status.row_id desc";
        } else {
            $query = " SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date,a.oper_user_name as soft_by,b.oper_user_name as hard_by ,c.oper_user_name as request_by   from dc_status 
              inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
              inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
              left join saimtech_oper_user a on dc_status.soft_copy_by = a.oper_user_id
              left join saimtech_oper_user b on dc_status.hard_copy_by=b.oper_user_id 
              left join saimtech_oper_user c on dc_status.requested_by=c.oper_user_id 
              where  soft_copy_check =1 and hard_copy_check =1 order by dc_status.row_id desc";
        }

        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function Get_Order_By_Code($cn)
    {
        $query = "SELECT saimtech_order.* , saimtech_customer.customer_name FROM saimtech_order INNER JOIN saimtech_customer ON saimtech_order.customer_id=saimtech_customer.customer_id WHERE  (`order_code`='$cn' OR `manual_cn`='$cn') ";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function dc_summary_soft_copy_pending()
    {
        $query = "SELECT a.customer_name, a.customer_id, group_concat(a.`Month`,'|', a.`Total` ORDER BY a.`Month`) as `data` FROM
        ( SELECT  c.customer_name,c.customer_id, DATE_FORMAT(DATE(o.order_arrival_date),'%b-%y') as `Month`, count(row_id) as `Total` 
        FROM `dc_status` s join saimtech_order o on o.order_id = s.order_id join saimtech_customer c on c.customer_id = s.customer_id 
        where s.soft_copy_check = 0  and o.order_status in('Deliverd','Delivered') GROUP BY c.customer_name, `Month`) a group by a.customer_name";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function dc_summary_soft_copy_summary()
    {
        $query = "SELECT a.customer_name, a.customer_id, group_concat(a.`Month`,'|', a.`Total` ORDER BY a.`Month`) as `data` FROM
        ( SELECT c.customer_name,c.customer_id, DATE_FORMAT(DATE(o.order_arrival_date),'%b-%y') as `Month`, count(row_id) as `Total` 
         FROM `dc_status` s join saimtech_order o on o.order_id = s.order_id join saimtech_customer c on c.customer_id = s.customer_id 
        where (s.soft_copy_check = 0 OR  s.soft_copy_check = 1)  and o.order_status in('Deliverd','Delivered') GROUP BY c.customer_name, `Month`) a group by a.customer_name";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function dc_summary_hard_copy_pending()
    {
        $query = "SELECT a.customer_name, a.customer_id, group_concat(a.`Month`,'|', a.`Total` ORDER BY a.`Month`) as `data` FROM
        ( SELECT c.customer_name,c.customer_id, DATE_FORMAT(DATE(o.order_arrival_date),'%b-%y') as `Month`, count(row_id) as `Total` 
        FROM `dc_status` s join saimtech_order o on o.order_id = s.order_id join saimtech_customer c on c.customer_id = s.customer_id 
        where s.hard_copy_check = 0 and o.order_status in('Deliverd','Delivered') GROUP BY c.customer_name, `Month`) a group by a.customer_name";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function dc_summary_soft_copy_pending_month()
    {
        $query = "SELECT DATE_FORMAT(DATE(order_arrival_date),'%b-%y') as `Month`   from dc_status 
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
        where soft_copy_check = 0 and saimtech_order.order_status in('Deliverd','Delivered') GROUP by Month order by  DATE_FORMAT(DATE(order_arrival_date),'%m')";
        $res = $this->db->query($query);
        return $res->result_array();
    }
    public function dc_summary_hard_copy_pending_month()
    {
        $query = "SELECT DATE_FORMAT(DATE(order_arrival_date),'%b-%y') as `Month`   from dc_status 
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id  
        where hard_copy_check = 0 and saimtech_order.order_status in('Deliverd','Delivered') GROUP by Month order by  DATE_FORMAT(DATE(order_arrival_date),'%m')";
        $res = $this->db->query($query);
        return $res->result_array();
    }


    public function Get_Dc_Status_order_id($order_id)
    {
        $query = "SELECT `row_id`, `dc_No`, `Units_Detail`, `soft_copy_check`, `soft_copy_by`, `soft_copy_at`, `hard_copy_check`, `hard_copy_by`, `hard_copy_at`, `request_by_check`, `requested_by` ,saimtech_customer.customer_name,saimtech_order.order_code,saimtech_order.manual_cn,saimtech_order.order_status,saimtech_order.consignee_name,saimtech_order.destination_city_name,saimtech_order.order_arrival_date from dc_status 
        inner join saimtech_customer on dc_status.customer_id=saimtech_customer.customer_id 
        inner join saimtech_order on dc_status.order_id=saimtech_order.order_id 
        where dc_status.order_id='$order_id' order by dc_status.row_id desc";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function check_unique($order_id)
    {
        $query = " SELECT order_id from dc_status where order_id='$order_id'";
        $res = $this->db->query($query);
        return $res->num_rows();
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
    public function update_dc($row_id, $edit_dc)
    {
        $query = "UPDATE `dc_status` SET `dc_No`='$edit_dc' WHERE `row_id`='$row_id' ";
        $this->db->query($query);
    }
}
