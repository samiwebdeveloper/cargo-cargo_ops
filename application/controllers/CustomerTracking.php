<?php
header('Access-Control-Allow-Origin: https://tmcargo.net');
class CustomerTracking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trackingmodel');
    }
    public function Tracking()
    {
        if (isset($_POST['cn'])) {
            $cn  = $_POST['cn'];
            $row = $this->Trackingmodel->Get_Shipment_Detail($cn);
            if (!empty($row)) {
                $order_id = $row[0]['order_id'];
                $origin = $row[0]['origin_city_name'];
                $destination = $row[0]['destination_city_name'];
                $bookingdate     =  date('d-M-Y', strtotime($row[0]['order_booking_date']));
                $shipperName = $row[0]['shipper_name'];
                $consigneeName = $row[0]['consignee_name'];
                $currentstatus = $row[0]['order_status'];
                $piece = $row[0]['pieces'];
                $weight = $row[0]['weight'];
                $service_name = $row[0]['service_name'];
                if ($currentstatus == 'Deliverd') {
                    $currentstatus = "Delivered";
                }
                echo '
                <div class="col-md-8 " >
                    <div class="opening-hours vc_opening-hours">
                    <address>
                <h3 id="top30" style="padding:2px !important; width:100% ;background-color: #ff0000; color: white; text-align: center;">Shipment Detail</h3>
                <h4 class="box-title"> </h4>
                <div style="padding-left: 20px;">
                <p style="font-weight:600;">Tracking Number : <span style="color:#ff0000 ;line-height:20px !important;">' . $cn . '</span> </p>
                    <p><b>Origin :</b> ' . $origin . '</p>
                    <p><b>Destination :</b> ' . $destination . ' </p>
                    <p><b>Booking Date :</b> ' . $bookingdate . ' </p>
                    <p><b>Shipper Name :</b> ' . $shipperName . ' </p>
                    <p><b>Consignee Name :</b> ' . $consigneeName . ' </p>
                </div>
                        </address>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="opening-hours vc_opening-hours">
                        <address>
                <h3 style="width:100% ;background-color: #ff0000; color: white; text-align: center;">Tracking Summary</h3>
                <div class="fh-contact-box type-address ">
                    <h4 class="box-title"> </h4>
                    <div style=" padding-left: 20px;">
                        <p style="font-weight:600;">Current Status : <span style="color:#ff0000  ;">' . $currentstatus . '</span> </p>
                        <p><b>Service Type :</b> ' . $service_name . ' </p>
                        <p><b>Piece :</b> ' . $piece . ' </p>
                        <p><b>Weight :</b> ' . $weight . ' </p>
                        <p><b>Signed By :</b> ' . $consigneeName . ' </p>
                    </div>
                </div>
                        </address>
                    </div>
                </div>
                <div class="col-md-12 shadow-lg mb-5 mt-5 bg-white rounded" >
                    <address >
                        <h3><span id="tracktext">Tracking History:</span></h3>
                        <div class="fh-contact-box type-address "  >
                            <table class="table table-striped table-hover">
                    <thead style="width:100% ;background-color: #ff0000; color: white; text-align: center;">
                        <tr>
                            <th scope="col">Date Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Location</th>
                        </tr>
                    </thead>
                    <tbody>';
                $trackinghistory = $this->Trackingmodel->Get_trackinghistory($order_id);
                if (!empty($trackinghistory)) {
                    foreach ($trackinghistory as $trackinghistory) {
                        $orderDate     =  date('d-M-Y h:i a', strtotime($trackinghistory['order_event_date']));
                        $status  =  $trackinghistory['order_event'];
                        $location =  $trackinghistory['order_location_name'];
                        echo '
                        <tr>
                        <td>' . $orderDate . '</td>
                        <td>' . $status . '</td>
                        <td>' . $location . '</td>
                        </tr> ';
                    }
                }
                echo '</tbody></table></div></address></div>';
            } else {
                echo '<div class="alert alert-danger" style="border-bottom: 4px solid red !important;margin:0px 20px; "> Please Enter the Valid Tracking Numbe Thank You.</div>';
            }
        }
    }
}
