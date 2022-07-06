<?php
class RouteModel extends CI_Model {
        public function route_detail()
        {
            $query = "SELECT DISTINCT
            l.route_name,
            l.route_service_name,
            l.route_code,
            t.city_full_name as `origin_city`,
            t.city_short_code as `origin_code`,
            c.city_full_name as `reporting_city`,
            c.city_short_code as `reporting_code`,
            i.city_full_name as `destination_city`,
            i.city_short_code as `destination_code`
        FROM
            tm_cargo.saimtech_route_list l
                LEFT JOIN
            tm_cargo.saimtech_route_detail d ON d.route_list_id = l.route_list_id
                LEFT JOIN
            tm_cargo.saimtech_city c ON c.city_id = d.city_id
                LEFT JOIN
            tm_cargo.saimtech_city i ON i.reporting_city = c.city_id
                LEFT JOIN
            tm_cargo.saimtech_city t ON t.city_id = l.route_origin_id
        ORDER BY l.route_name , c.city_full_name , i.city_full_name;";
            $res = $this->db->query($query);
            return $res->result_array();
            
        }

}