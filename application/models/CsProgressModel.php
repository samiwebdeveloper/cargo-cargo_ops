<?php
class CsProgressModel extends CI_Model
{

	public function cs_progress($start_date, $end_date, $location)
	{
		$query = "SELECT u.oper_user_name, date(o.order_arrival_date) as arrival_date, date(t.order_event_date) as evevnt_date, t.order_event, count(o.order_code) as total_code FROM `saimtech_order_tracking` t join `saimtech_order` o on o.order_id = t.order_id join `saimtech_oper_user` u on u.oper_user_id = t.created_by where t.order_event not in ('Order','Booking') and date(o.order_arrival_date) between '$start_date' and '$end_date' and t.order_location = '$location' group by date(o.order_arrival_date), date(t.order_event_date), u.oper_user_name, t.order_event ORDER BY u.oper_user_name, date(o.order_arrival_date), date(t.order_event_date), t.order_event";
		$res = $this->db->query($query);
		return $res->result();
	}
	public function cs_progress_detail($start_date, $end_date, $location)
	{
		$query = "SELECT o.order_code, o.manual_cn, t.order_event, t.order_location_name, date(o.order_arrival_date) as arrival_date, date(t.order_event_date) as event_date, u.oper_user_name FROM `saimtech_order_tracking` t join `saimtech_order` o on o.order_id = t.order_id join `saimtech_oper_user` u on u.oper_user_id = t.created_by where t.order_event not in ('Order','Booking') and date(o.order_arrival_date) between '$start_date' and '$end_date' and t.order_location = $location order by date(o.order_arrival_date), o.order_code, date(t.order_event_date)";
		$res = $this->db->query($query);
		return $res->result();
	}
}
