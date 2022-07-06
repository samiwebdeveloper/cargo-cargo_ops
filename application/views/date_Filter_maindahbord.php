<?php
error_reporting(0);
$this->load->view('inc/header');
$start_date = $default;
$end_date = $default;
$default_10day = $default;
foreach (array_slice($md_booking_30days, 0, 1) as $start_date);
foreach (array_slice($md_booking_30days, 0, 30) as $end_date);
$start_date = $start_date["Booking_Date"];
$end_date = $end_date["Booking_Date"];
$now = date("Y-m-d", strtotime("-1 day"));
$before_ten_day = date("Y-m-d", strtotime("-15 days"));
?>

<style>
    .nav-nav li a:hover {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .nav-nav li a:focus {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .nav-nav li a {
        color: #212529 !important;
        background-color: #f8f9fa !important;
        border: 1px solid #6d5eac !important;
        border-radius: 5px;
        margin-left: 9px;
    }

    .card-header a:not(.btn) {
        color: #575757 !important;
        opacity: 1;
    }

    .windows h5 {
        font-size: 13px;
        line-height: 4px;
        font-weight: normal;
    }

    label,
    input,
    button,
    select,
    textarea {
        font-size: 12px;
        font-weight: normal;
        line-height: 20px;
        cursor: pointer;
    }
</style>
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0" style="background-color: #575757 !important; color:white">
                <div class="inner">
                    <marquee class="font-montserrat fs-13 all-caps p-t-3">This Will Show TM Cargo & Logistics News Update. http://www.tmcargo.net</marquee>
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="row">
                <!-- <div class="col-md-3 m-b-10">
                    <div class="widget-9 card no-border bg-primary no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #6d5eac)">
                        <div class="full-height d-flex flex-column">
                            <div class="card-header ">
                                <div class="card-title text-white">
                                    <span class="font-montserrat fs-11 all-caps">QSR<i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                                <div class="card-controls">
                                    <ul>
                                        <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-l-20">
                                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                                </a>
                                <a href="<?= base_url(); ?>Home/cs_qsr"><span class="small hint-text text-white">Click here for more detail</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-b-10">
                    <div class="widget-9 card no-border bg-info no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #949AEF)">
                        <div class="full-height d-flex flex-column">
                            <div class="card-header ">
                                <div class="card-title text-white">
                                    <span class="font-montserrat fs-11 all-caps">Manage Your Mail <iclass="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                                <div class="card-controls">
                                    <ul>
                                        <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-l-20">
                                <h3 class="no-margin p-b-5 text-white">Inbox</h3>
                                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                                </a>
                                <a href="https://tmcargo.net:2096/" target="_blank"><span class="small hint-text text-white">Click here for more detail</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-b-10">
                    <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #28a745)">
                        <div class="full-height d-flex flex-column">
                            <div class="card-header ">
                                <div class="card-title text-white">
                                    <span class="font-montserrat fs-11 all-caps">Pending Sheets <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                                <div class="card-controls">
                                    <ul>
                                        <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="fa fa-search"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-l-20">
                                <h3 class="no-margin p-b-5 text-white"><?php echo $pendings_dd_count; ?></h3>
                                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                                </a>
                                <a href="<?php echo base_url(); ?>home/pending_sheets"><span class="small hint-text text-white">Click here for more detail</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-b-10">
                    <div class="widget-9 card no-border bg-danger no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #a01c21);">
                        <div class="full-height d-flex flex-column">
                            <div class="card-header ">
                                <div class="card-title text-white">
                                    <span class="font-montserrat fs-11 all-caps">Pickup Pending <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                                <div class="card-controls">
                                    <ul>
                                        <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-l-20">
                                <h3 class="no-margin p-b-5 text-white"><?php echo $incomming_pendings_count; ?></h3>
                                <a href="<?php echo base_url(); ?>Pendingpickup" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i></a>
                                <a href="<?php echo base_url(); ?>Pendingpickup"><span class="small hint-text text-white">Click here for more detail</span></a>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- date filter  -->
                <div class="col-md-12 m-b-10">
                    <div class="form-group-attached">
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group form-group-default required" id="user_name_div">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required="" value="<?php echo $before_ten_day ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-group-default required">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required="" value="<?php echo $now; ?>">
                                </div>
                            </div>
                            <div class="form-group col-sm-4 form-group-default " ria-required="true" id="o_city_div">
                                <label>Select Origin City </label>
                                <select class="form-control" required id="o_city" name="oper_user_city_id" tabindex=4>
                                    <?php
                                    foreach ($city_data as $city) {
                                        if ($_SESSION['city_code'] == $city['city_code']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        }
                                        echo "<option {$select} value='{$city['city_code']}' >{$city['city_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button class='btn btn-primary ' id="update_row" style="height:100%">GO</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start tabs -->
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <ul class="nav nav-nav my-3">
                                <li><a data-toggle="pill" href="#menu1">Booking Origin </a></li>
                                <li><a data-toggle="pill" href="#menu2">Booking Destination </a></li>
                                <!-- <li><a data-toggle="pill" href="#menu3">Booking On Route Weight Wise</a></li>
                                <li><a data-toggle="pill" href="#menu4">Booking On Route Order Wise</a></li>
                                <li class="active"><a data-toggle="pill" href="#menu6">Not Manifested</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div id="menu1" class="tab-pane fade mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking Origin City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking Origin City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='myTable' width='100%'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>Origin City Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h3>Loading...</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="menu2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking Destination City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking Destination City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='desTable' width='100%'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>Origin City Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h3>Loading...</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="menu3" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking On Route weight Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking On Route weight Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='routeTable' width='100%'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Total Weight</th>
                                                                    <th>Rider|Route Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h3>Loading...</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu4" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking On Route Order Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking On Route Order Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='routepiecesTable' width='100%'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Total Booking</th>
                                                                    <th>Rider|Route Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h3>Loading...</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu5" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Order Not Delivered Destination City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div id="menu6" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Order Not Manifested City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart10">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Order Not Manifested City Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='manifestedTable' width='100%'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Total Order</th>
                                                                    <th>City Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h3>Loading...</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Weight  Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Piece Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chartp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Order Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chartb">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Service Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chart6">
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Status Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chart7">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Order Not Delivered</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="chartd">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Weight Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="wmonth">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Piece Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="pmonth">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-1 mt-1">
                        <div class="card-header">Booking Order Wise</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart" id="bmonth">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $this->load->view('inc/footer');
    ?>
    

    <script>
        $("#update_row").click(function() {
            $('#myTable,#desTable,#notdeliveredTable,#manifestedTable,#routepiecesTable,#routeTable').DataTable().destroy();
            $('tbody').html('');
            $('tbody').html('<tbody><tr><td colspan="2"><h3>Loading...</h3></td></tr><tbody>');;

            booking_weight();
            booking_pieces();
            booking_order();
           booking_full_wieght();
           booking_full_piece();
           booking_full_order();
            booking_city();
            city_destination_wise();
            booking_service_wise();
            booking_status_wise();
            not_manifested();
            not_delivered();
            weight_on_route_30days();
            booking_on_route_30days();
        });

        $(document).ready(function() {
            booking_weight();
            booking_pieces();
            booking_order();
            booking_full_wieght();
           booking_full_piece();
           booking_full_order();
            booking_city();
            city_destination_wise();
            booking_service_wise();
            booking_status_wise();
            not_manifested();
            not_delivered();
            weight_on_route_30days();
            booking_on_route_30days();
        });

        function booking_weight() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart').html('');
            $('#chart').html('<canvas id="Chartcanvas" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_weight",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    var weight = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        weight.push(data[count].weight);
                        color.push(data[count].color);
                    }
                    var data = {
                        labels: Booking_Date,
                        datasets: [{
                            label: 'Booking Weight Wise',
                            data: weight,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    labels: {
                                        boxWidth: 35,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "value",
                                    fontColor: "white",
                                    fontStyle: "bolder",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                              // for value element
                        // plugins: [ChartDataLabels]
                        },
                    };

                    const myChart = new Chart(
                        document.getElementById('Chartcanvas'),
                        config
                    );

                   

                  
                }
            })
        }

        function booking_pieces() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chartp').html('');
            $('#chartp').html('<canvas id="Chartcanvasp" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_weight",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    // var booking = [];
                    var pieces = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        pieces.push(data[count].pieces);
                        color.push(data[count].color);
                    }

                        var data = {
                        labels: Booking_Date,
                        datasets: [{
                            label: 'Booking Piece Wise',
                            data: pieces,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    labels: {
                                        boxWidth: 35,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "value",
                                    fontColor: "white",
                                    fontStyle: "bolder",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                    };

                    const myChart = new Chart(
                        document.getElementById('Chartcanvasp'),
                        config
                    );

                  
                   
                }
            })
        }
        function booking_order() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chartb').html('');
            $('#chartb').html('<canvas id="Chartcanvasb" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_weight",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    var booking = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        booking.push(data[count].booking);
                        color.push(data[count].color);
                    }
                    var data = {
                        labels: Booking_Date,
                        datasets: [{
                            label: 'Booking Order Wise',
                            data: booking,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    labels: {
                                        boxWidth: 35,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "value",
                                    fontColor: "white",
                                    fontStyle: "bolder",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                    };

                    const myChart = new Chart(
                        document.getElementById('Chartcanvasb'),
                        config
                    );
                }
            })
        }

        function booking_full_wieght() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#wmonth').html('');
            $('#wmonth').html('<canvas id="wmonthcanvas" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_full_year",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    var weight = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        weight.push(data[count].weight);
                        color.push(data[count].color);
                    }

                    var data = {
                        labels: Booking_Date,
                        datasets: [
                            {
                            label: 'Booking Weight Wise',
                            data: weight,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        },
                    ]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: {
                                    bottom:10
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "center",
                                    position:'top',
                                    labels: {
                                        boxWidth: 20,
                                       padding:2
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 5,
                                    fontSize: 10,
                                }
                            },
                        },
                        
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('wmonthcanvas'),
                        config
                    );


                   

                }
            })
        }
        function booking_full_piece() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#pmonth').html('');
            $('#pmonth').html('<canvas id="pmonthcanvas" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_full_year",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    var pieces = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        pieces.push(data[count].pieces);
                        color.push(data[count].color);
                    }

                    var data = {
                        labels: Booking_Date,
                        datasets: [
                            {
                            label: 'Booking Piece Wise',
                            data: pieces,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        },
                    ]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: {
                                    bottom:10
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "center",
                                    position:'top',
                                    labels: {
                                        boxWidth: 20,
                                       padding:2
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 5,
                                    fontSize: 10,
                                }
                            },
                        },
                        
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('pmonthcanvas'),
                        config
                    );


                   

                }
            })
        }
        function booking_full_order() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#bmonth').html('');
            $('#bmonth').html('<canvas id="omonthcanvas" style="height: 350px;"></canvas>');
            $.ajax({
                url: "booking_full_year",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var Booking_Date = [];
                    var booking = [];     
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        booking.push(data[count].booking);
                        color.push(data[count].color);
                    }

                    var data = {
                        labels: Booking_Date,
                        datasets: [
                            {
                            label: 'Booking Order Wise',
                            data: booking,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        },
                    ]
                    };

                    // config 
                    var config = {
                        type: 'doughnut',
                        data,
                        options: {
                            layout: {
                                padding: {
                                    bottom:10
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "center",
                                    position:'top',
                                    labels: {
                                        boxWidth: 20,
                                       padding:2
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 5,
                                    fontSize: 10,
                                }
                            },
                        },
                        
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('omonthcanvas'),
                        config
                    );


                   

                }
            })
        }
       

        function booking_city() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart1').html('');
            $('#chart1').html('<canvas id="origin_city_name" height="340"></canvas>');
            $.ajax({
                url: "booking_city",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city,
                },
                dataType: "JSON",
                success: function(data) {
                    var dataSet1 = data;
                    var table6 = $('#myTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        data: dataSet1,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "origin_city_name"
                            }
                        ],
                        "lengthMenu": [
                            [10, 100, 500, -1],
                            [10, 100, 500, "All"]
                        ],
                        dom: 'Blfrtip',
                        buttons: [{
                            extend: 'print',
                            text: "<i class='fs-14 pg-ui'></i> Print",
                            titleAttr: 'Print',
                            footer: 'true',
                            title: "Booking Origin City Wise",
                            message: start_date + "To" + end_date,
                        }]
                    });

                    var origin_city_name = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        origin_city_name.push(data[count].origin_city_name);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }
                    var data = {
                        labels: origin_city_name,
                        datasets: [{
                            label: 'Booking Origin City Wise',
                            data: Total,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 2,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    position:"bottom",

                                    labels: {
                                        boxWidth: 30,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('origin_city_name'),
                        config
                    );

                }
            })
        }

        function city_destination_wise() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart2').html('');
            $('#chart2').html('<canvas id="city_destination_wise"  height="340"></canvas>');
            $.ajax({
                url: "city_destination_wise",
                method: "Get",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",
                success: function(data) {
                    var dataSet2 = data;
                    var table5 = $('#desTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        data: dataSet2,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "destination_city_name"
                            }
                        ],
                        "lengthMenu": [
                            [10, 100, 500, -1],
                            [10, 100, 500, "All"]
                        ],
                        dom: 'Blfrtip',
                        buttons: [

                            {
                                extend: 'print',
                                text: "<i class='fs-14 pg-ui'></i> Print",
                                titleAttr: 'Print',
                                footer: 'true',
                                title: "Booking Destination City Wise",
                                message: start_date + "To" + end_date,

                            },

                        ]
                    });

                    var destination_city_name = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        destination_city_name.push(data[count].destination_city_name);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }
                    var data = {
                        labels: destination_city_name,
                        datasets: [{
                            label: 'Booking Destination City Wise',
                            data: Total,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    position:"bottom",

                                    labels: {
                                        boxWidth: 30,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('city_destination_wise'),
                        config
                    );


                }

            })
        }

        function booking_service_wise() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart6').html('');
            $('#chart6').html('<canvas id="service_name" height="350"></canvas>');
            $.ajax({
                url: "booking_service_wise",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {
                    var service_name = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        service_name.push(data[count].service_name);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }

                    var data = {
                        labels: service_name,
                        datasets: [{
                            label: 'Booking Service Wise',
                            data: Total,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 20
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    position:"bottom",

                                    labels: {
                                        boxWidth: 35,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                        // for value element
                        plugins: [ChartDataLabels]
                    };

                    const myChart = new Chart(
                        document.getElementById('service_name'),
                        config
                    );



                }

            })
        }

        function booking_status_wise() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text();
            $('#chart7').html('');
            $('#chart7').html('<canvas id="booking_status" height="340"></canvas>');
            $.ajax({
                url: "booking_status_wise",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {
                    var order_status = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        order_status.push(data[count].order_status);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }


                    var data = {
                        labels: order_status,
                        datasets: [{
                            label: 'Booking Status Wise',
                            data: Total,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white",
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 15
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    position:'bottom',
                                    labels: {
                                        boxWidth: 35,
                                       padding:10
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: data.datasets[0].borderColor,
                                    fontStyle: "bolder",
                                    position: "outside",
                                    textMargin: 6,
                                    fontSize: 15,
                                }
                            },
                        },
                        // for value element
                        plugins: [ChartDataLabels],
                    };

                    const myChart = new Chart(
                        document.getElementById('booking_status'),
                        config
                    );

                   

                }

            })
        }

        function not_manifested() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart10').html('');
            $('#chart10').html('<canvas id="not_manifested"  height="340"></canvas>');
            $.ajax({
                url: "not_manifested",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {
                    var dataSet3 = data;
                    var table1 = $('#manifestedTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        data: dataSet3,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "destination_city_name"
                            }
                        ],
                        "lengthMenu": [
                            [10, 100, 500, -1],
                            [10, 100, 500, "All"]
                        ],
                        dom: 'Blfrtip',
                        buttons: [

                            {
                                extend: 'print',
                                text: "<i class='fs-14 pg-ui'></i> Print",
                                titleAttr: 'Print',
                                footer: 'true',
                                title: "Order Not Manifested City Wise",
                                message: start_date + "To" + end_date,
                            }
                        ]
                    });

                    // location.reload(true);
                    var destination_city_name = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        destination_city_name.push(data[count].destination_city_name);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: destination_city_name,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            data: Total
                        }]
                    };

                    var options = {
                        responsive: true,
                        legend: {
                            display: false,
                            align: "start",
                            position: "bottom",
                            labels: {
                                boxWidth: 10,
                            },
                        },
                        animation: {
                            duration: 500,
                            easing: "easeInOutBounce",
                        },
                    };

                    var group_chart3 = $('#not_manifested');
                    var graph3 = new Chart(group_chart3, {
                        type: 'pie',
                        data: chart_data,
                        options: options
                    });

                }

            })
        }

        function not_delivered() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chartd').html('');
            $('#chartd').html('<canvas id="not_delivered"  height="340"></canvas>');
            $.ajax({
                url: "not_delivered",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {
                 

                    // location.reload(true);
                    var Destination = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        Destination.push(data[count].Destination);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }

                    var data = {
                        labels: Destination,
                        datasets: [{
                            label: 'Order Not Delivered Destination Wise',
                            data: Total,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            datalabels:{
                                color:"white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 15
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    align: "start",
                                    position:"bottom",
                                    labels: {
                                        boxWidth: 35,
                                       padding:5
                                    },
                                },
                                labels: {
                                    render: "percentage",
                                    fontColor: color,
                                    fontStyle: "bolder",
                                    position:'outside',
                                    textMargin: 6,
                                    fontSize: 12,
                                }
                            },
                        },
            plugins: [ChartDataLabels]

                    };

                    const myChart = new Chart(
                        document.getElementById('not_delivered'),
                        config
                    );


                }

            });
        }

        function weight_on_route_30days() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart3').html('');
            $('#chart3').html('<canvas id="weight_on_route_30days"  height="340"></canvas>');
            $.ajax({
                url: "weight_on_route_30days",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {
                    // location.reload(true);

                    var dataSet = data;
                    var table3 = $('#routeTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        data: dataSet,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "rider_route"
                            }


                        ],
                        "lengthMenu": [
                            [10, 100, 500, -1],
                            [10, 100, 500, "All"]
                        ],
                        dom: 'Blfrtip',
                        buttons: [

                            {
                                extend: 'print',
                                text: "<i class='fs-14 pg-ui'></i> Print",
                                titleAttr: 'Print',
                                footer: 'true',
                                title: "QSR <?php echo $start_date . " To " . $end_date; ?>",
                                message: "Delivery Express <br> System Developer M.Saim <br>Date:<?php echo $start_date . " To " . $end_date; ?> <br>  QSR Report<br>"
                            }
                        ]
                    });

                    var rider_route = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        rider_route.push(data[count].rider_route);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: rider_route,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            data: Total
                        }]
                    };

                    var options = {
                        responsive: true,
                        legend: {
                            display: false,
                            align: "left",
                            position: "bottom",
                            labels: {
                                boxWidth: 20,
                            },
                        },
                        animation: {
                            duration: 500,
                            easing: "easeInOutBounce",
                        },

                    };

                    var group_chart3 = $('#weight_on_route_30days');
                    var graph3 = new Chart(group_chart3, {
                        type: 'pie',
                        data: chart_data,
                        options: options
                    });

                }

            })
        }

        function booking_on_route_30days() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var origin_city = $('#o_city :selected').text()
            $('#chart4').html('');
            $('#chart4').html('<canvas id="booking_on_route_30days" height="340"></canvas>');
            $.ajax({
                url: "booking_on_route_30days",
                method: "GET",
                data: {
                    action: 'fetch',
                    start_date: start_date,
                    end_date: end_date,
                    origin_city: origin_city
                },
                dataType: "JSON",

                success: function(data) {

                    $(document).ready(function() {
                        var dataSet5 = data;
                        var table4 = $('#routepiecesTable').DataTable({
                            "order": [
                                [0, 'desc']
                            ],
                            data: dataSet5,
                            "columns": [{
                                    "data": "Total"
                                },
                                {
                                    "data": "rider_route"
                                }
                            ],
                            "lengthMenu": [
                                [10, 100, 500, -1],
                                [10, 100, 500, "All"]
                            ],
                            fixedHeader: true,
                            "searching": true,
                            "paging": true,
                            "ordering": true,
                            "bInfo": true,
                            dom: 'Blfrtip',
                            buttons: [

                                {
                                    extend: 'print',
                                    text: "<i class='fs-14 pg-ui'></i> Print",
                                    titleAttr: 'Print',
                                    footer: 'true',
                                    title: "Booking On Route Order Wise",
                                    message: start_date + "To" + end_date,
                                }
                            ]
                        });

                    });
                    // location.reload(true);
                    var rider_route = [];
                    var Total = [];
                    var color = [];
                    for (var count = 0; count < data.length; count++) {
                        rider_route.push(data[count].rider_route);
                        Total.push(data[count].Total);
                        color.push(data[count].color);
                    }
                    var chart_data = {
                        labels: rider_route,
                        datasets: [{
                            label: 'Total',
                            backgroundColor: color,
                            data: Total
                        }]
                    };
                    var options = {
                        responsive: true,
                        legend: {
                            display: false,
                            align: "start",
                            labels: {
                                boxWidth: 50,
                            },
                        },
                        animation: {
                            duration: 500,
                            easing: "easeInOutBounce",
                        },
                    };
                    var group_chart3 = $('#booking_on_route_30days');
                    var graph3 = new Chart(group_chart3, {
                        type: 'pie',
                        data: chart_data,
                        options: options
                    });
                }
            })
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#o_city').select2();
            $('input[type="number"]').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });
        });
    </script>