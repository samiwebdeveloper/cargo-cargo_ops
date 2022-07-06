<?php
class MainDashbordModel extends CI_Model
{
    public function city_origin_wise($start_date, $end_date, $origin_city)
    {
        if ($origin_city == 'All') {
            $query = "SELECT round(SUM(weight)) AS Total,saimtech_city.city_short_code As origin_city_name FROM `saimtech_order`  inner join saimtech_city on saimtech_order.origin_city=saimtech_city.city_id   WHERE date(order_arrival_date) BETWEEN ? and ?  GROUP by origin_city_name order by Total desc ";
        } else {
            $query = "SELECT round(SUM(weight)) AS Total,saimtech_city.city_short_code As origin_city_name FROM `saimtech_order`  inner join saimtech_city on saimtech_order.origin_city=saimtech_city.city_id    WHERE date(order_arrival_date) BETWEEN ? and ? AND destination_city_name = '$origin_city' GROUP by origin_city_name order by Total desc ";
        }
        $res = $this->db->query($query, array($start_date, $end_date));
        return $res->result_array();
    }

    public function city_destination_wise($start_date, $end_date, $origin_city)
    {
        if ($origin_city == 'All') {
            $query = " SELECT  round(SUM(weight)) AS Total,saimtech_city.city_short_code As destination_city_name FROM `saimtech_order`  inner join saimtech_city on 
            saimtech_order.destination_city=saimtech_city.city_id  WHERE date(order_arrival_date) BETWEEN ? and ?  GROUP by destination_city order by Total desc ";
        } else {
            $query = "SELECT  round(SUM(weight)) AS Total,saimtech_city.city_short_code As destination_city_name FROM `saimtech_order`  inner join saimtech_city on 
            saimtech_order.destination_city=saimtech_city.city_id  WHERE date(order_arrival_date) BETWEEN ? and ? AND origin_city_name = '$origin_city' GROUP by destination_city order by Total desc ";
        }
        $res = $this->db->query($query, array($start_date, $end_date));
        return $res->result_array();
    }

    public function booking_service_wise($start_date, $end_date, $origin_city)
    {
        if ($origin_city == 'All') {
            $query = "SELECT s.service_name, count(weight) AS Total FROM `saimtech_order` o join saimtech_service s on o.order_service_type = s.service_id WHERE date(order_arrival_date) BETWEEN ? and ?  GROUP BY order_service_type order by Total desc";
        } else {
            $query = "SELECT s.service_name, count(weight) AS Total FROM `saimtech_order` o join saimtech_service s on o.order_service_type = s.service_id WHERE date(order_arrival_date) BETWEEN ? and ? AND `origin_city_name` = '$origin_city' GROUP BY order_service_type order by Total desc";
        }
        $res = $this->db->query($query, array($start_date, $end_date));
        return $res->result_array();
    }

    public function booking_weight($start_date, $end_date, $origin_city)
    {

        if ($origin_city == "All") {
            $query = "SELECT date_format(order_arrival_date,'%d-%m-%y') as 'Booking_Date', count(order_code) AS booking, SUM(`pieces`) AS pieces, ROUND(SUM(`weight`), 0) AS weight FROM `saimtech_order` WHERE date(order_arrival_date) BETWEEN ? and ?  GROUP BY date(order_arrival_date) ORDER BY date(order_arrival_date) ";
        } else {
            $query = "SELECT date_format(order_arrival_date,'%d-%m-%y') as 'Booking_Date', count(order_code) AS booking, SUM(`pieces`) AS pieces, ROUND(SUM(`weight`), 0) AS weight FROM `saimtech_order` WHERE date(order_arrival_date) BETWEEN ? and ? AND `origin_city_name` = '$origin_city' GROUP BY date(order_arrival_date) ORDER BY date(order_arrival_date) ";
        }
        $res = $this->db->query($query, array($start_date, $end_date));
        return $res->result_array();
    }

    public function booking_full_month($origin_city, $start_date, $end_date)
    {
        if ($origin_city == "All") {
            $query = "SELECT date_format(date(order_arrival_date), '%b %y') AS 'Booking_Date',COUNT(order_code) AS booking,SUM(`pieces`) AS pieces,ROUND(SUM(`weight`),0) AS weight FROM`saimtech_order`WHERE DATE(order_arrival_date) BETWEEN '$start_date' and '$end_date' 
           GROUP BY `Booking_Date`  ORDER BY order_arrival_date ASC";
        } else {
            $query = "SELECT date_format(date(order_arrival_date), '%b %y') AS 'Booking_Date',COUNT(order_code) AS booking,SUM(`pieces`) AS pieces,ROUND(SUM(`weight`),0) AS weight FROM`saimtech_order` WHERE DATE(order_arrival_date) BETWEEN '$start_date' and '$end_date'  AND `origin_city_name` = '$origin_city'
            GROUP BY `Booking_Date`  ORDER BY order_arrival_date ASC";
        }
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function booking_status_wise($start_date, $end_date, $origin_city)
    {
        if ($origin_city == 'All') {
            $query = "SELECT order_status, count(order_code) as Total FROM `saimtech_order` where  date(order_arrival_date) between ? and ? and  order_status
             NOT IN ('Order' ,'Booking' ,'Cancelled','RTS','LOST') group by order_status order by Total desc ";
        } else {
            $query = "SELECT order_status, count(order_code) as Total FROM `saimtech_order` where origin_city_name = '$origin_city'
        and date(order_arrival_date) between ? and ? and  order_status NOT IN ('Order' ,'Booking' ,'Cancelled','RTS','LOST') group by order_status order by Total desc ";
        }
        $res = $this->db->query($query, array($start_date, $end_date));
        return $res->result_array();
    }


    public function not_delivered($start_date, $end_date, $origin_city)
    {
        $query = "SELECT
        `saimtech_city`.`city_short_code` AS `Destination`,
        round(SUM(`saimtech_order`.`weight`)) AS `Total`
    FROM
        `saimtech_order`
    JOIN `saimtech_city` ON `saimtech_city`.`city_id` = `saimtech_order`.`destination_city`
    WHERE
        `saimtech_order`.`order_status` NOT IN(
            'Order',
            'Cancelled',
            'RTS',
            'Deliverd',
            'Delivered',
            'LOST'
        ) AND CAST(
            `saimtech_order`.`order_arrival_date` AS DATE
        ) BETWEEN '$start_date' AND '$end_date'
    GROUP BY
        `saimtech_order`.`destination_city` order by  Total desc";
        $res = $this->db->query($query);
        return $res->result_array();
    }
}

