<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<script>
    window.onload = function() {
        window.setTimeout(function() {
            $('#loaderinpage').css('display', 'none')
            $('.page-content-wrapper').css('visibility', 'visible')
        }, 200);
    }
</script>
<div class="col-md-12" id='loaderinpage' style="height:60vh ;text-align: center;position: relative;top: 250px;">
    <img src='<?php echo base_url(); ?>assets/ajax-loader.gif' width="150px">
</div>

<style>
    .page-content-wrapper {
        visibility: hidden;
    }

    .col-md-4 {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 2px;
        padding-left: 2px;
    }

    @media (max-width: 1380px) {
        .card .card-body {
            padding: 1px;
            padding-top: 0;
        }
    }

    @media (max-width: 700px) {
        .nav-tabs>li>a {
            border-radius: 0;
            padding: 6px 10px;
            font-size: 11.5px;
            min-width: 54px;

        }
    }

    .nav-nav li a:hover {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .nav-nav li .btncolor:hover {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .btn-outline-light:hover {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .btn-outline-light:focus {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .nav-nav li .btncolor {
        color: #212529 !important;
        background-color: #f8f9fa !important;
        border: 1px solid #6d5eac !important;
        border-radius: 5px;
        margin-left: 9px;
    }

    .color {
        color: #fff !important;
        background-color: #6d5eac !important;
        border-color: #6d5eac !important;
        border-radius: 5px;
    }

    .btn-outline-light {
        color: #212529;
        background-color: #f8f9fa;
        border: 1px solid #6d5eac;
        border-radius: 5px;
        margin-left: 9px;
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

    li {
        list-style-type: none !important;
        margin-top: 10px !important;
        margin-left: 10px !important;
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

    .nav-tabs-fillup>li>a:after {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        backface-visibility: hidden;
        background: none repeat scroll 0 0 #6d5eac;
        border: 1px solid #6d5eac;

    }

    a:not([href]):not([tabindex]),
    a:not([href]):not([tabindex]):focus,
    a:not([href]):not([tabindex]):hover {
        color: inherit;
        text-decoration: none;
        font-size: 15px;
    }

    .record_label {
        position: absolute;
        top: 3px;
        left: 12px;
        /* padding: 5px 0px; */
    }

    .mobile_padd {
        display: flex;
        justify-content: start;
        align-items: end;
    }

    .record_btn {
        display: flex !important;
        position: relative !important;
        right: 51px;
        top: 11px;
    }

    @media only screen and (max-width: 600px) {

        a:not([href]):not([tabindex]),
        a:not([href]):not([tabindex]):focus,
        a:not([href]):not([tabindex]):hover {
            font-size: 12px;
        }

        .btn-outline-light {
            border-radius: 1px;
            margin-left: -1px;
            padding: 2px 6px;
            border: 1px solid rgb(109, 93, 172) !important;
        }

        .btn-outline-light:hover {
            color: #fff !important;
            background-color: #6d5eac !important;
            border-color: #6d5eac !important;
            border-radius: 2px;
        }

        .record_label {
            top: -1px;
        }

        .record_btn {
            display: flex !important;
            position: relative !important;
            right: 49px;
            top: 5px;
        }

        .mobile_padd {
            margin-top: 5px;
            padding: 10px;
        }
    }
</style>
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->

        <!-- <br> -->
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg  mb-1  mt-1">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="row">
                <!-- date filter  -->
                <div class="col-md-12  mb-1 " >
                    <div class="form-group-attached">
                        <div class="row clearfix">
                            <div class="form-group col-md-4 form-group-default " ria-required="true" id="o_city_div">
                                <label> &nbsp;Select Origin City </label>
                                <select class="form-control" required id="o_city" name="oper_user_city_id" tabindex=4>
                                    <option value='All'>All</option>
                                    <?php
                                    foreach ($city_data as $city) {
                                        echo "<option value='{$city['city_name']}' >{$city['city_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-8 form-group-default mobile_padd " ria-required="true" id="o_city_div">
                                <label class="record_label">Records </label>
                                <ul class="record_btn">
                                    <li class="active"><a class=" btn btn-outline-light  color " id="btn3">Last 3Days</a></li>
                                    <li><a class=" btn btn-outline-light" id="btn1"><?php echo date("M", strtotime("now")) ?></a></li>
                                    <li><a class=" btn btn-outline-light" id="btn5"> <?php echo date("M", strtotime("-1 month")) ?></a></li>
                                    <li><a class=" btn btn-outline-light" id="btn10"><?php echo date("M", strtotime("-2 month")) ?></a></li>
                                    <li><a class=" btn btn-outline-light" id="btn20"><?php echo date("M", strtotime("-3 month")) ?></a></li>
                                    <li><a class=" btn btn-outline-light" id="btn25"><?php echo date("M", strtotime("-4 month")) ?></a></li>
                                    <li><a class=" btn btn-outline-light" id="btn30"><?php echo date("M", strtotime("-5 month")) ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start tabs -->
                <div class="col-md-12">
                    <div class="card mb-1">
                        <div class="panel">
                            <ul class="nav nav-tabs nav-tabs-fillup">
                                <li class="active"> <a data-toggle="tab" href="#maindashbord" class="active show" id="main">Main</a></li>
                                <li><a data-toggle="tab" href="#OriginCityWise" id="origin_city">Origin City</a></li>
                                <li> <a data-toggle="tab" href="#destinationCityWise" id="des_city">Destination City</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane slide-right active" id="maindashbord">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">Booking Count Service Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header" style="font-size: 13px;">Status Undelivered <br><span style="font-size: 12px;" class="total_delivered_count"></span><span style="font-size: 12px;" class="total_other_count"></span></div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chart7">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header">UnDelivered Station Wise</div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="chartd">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card  mb-1 mt-1">
                                                <div class="card-header ">Weight Month Wise <span class="total_weight"></span></div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="wmonth">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header ">Piece Month Wise <span class="total_piece"></span></div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="pmonth">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-1 mt-1">
                                                <div class="card-header ">Booking Month Wise <span class="total_booking"></span></div>
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart" id="bmonth">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane slide-left" id="OriginCityWise">
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
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='myTable' width='100%' style="border:1px solid gray ;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Total Weight</th>
                                                                    <th>Origin City </th>
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
                                <div class="tab-pane slide-left" id="destinationCityWise">
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
                                                <div class="card-body">
                                                    <div class="chart-container pie-chart">
                                                        <table class="display cell-border compact" id='desTable' width='100%' style="border:1px solid gray ;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Total Weight</th>
                                                                    <th>Origin City </th>
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
            </div>
        </div>
    </div>
    <input hidden type="text" id="startdate">
    <input hidden type="text" id="enddate">
    <?php $this->load->view('inc/footer'); ?>
    <script>
        var mydata = {};
        var origin_city = 'All';
        var start_date = $('#startdate').val();
        var end_date = $('#enddate').val();
        start_date = '<?php echo date("Y-m-d", strtotime("-5 day")) ?>';
        end_date = '<?php echo date("Y-m-d", strtotime("-3 day")) ?>';
        mydata = {
            action: 'fetch',
            start_date: start_date,
            end_date: end_date,
            origin_city: origin_city,
        };
        $("#btn3").click(function() {
            start_date = '<?php echo date("Y-m-d", strtotime("-5 day")) ?>';
            end_date = '<?php echo date("Y-m-d", strtotime("-3 day")) ?>';
            load_data();
        })
        $("#btn1").click(function() {
            start_date = '<?php echo date("Y-m-01") ?>';
            end_date = '<?php echo date("Y-m-j", strtotime("now")) ?>';
            load_data();
        })
        $("#btn5").click(function() {
            start_date = '<?php echo date("Y-n-j", strtotime("first day of previous month")) ?>';
            end_date = '<?php echo date("Y-n-j", strtotime("last day of previous month")) ?>';
            load_data();
        })
        $("#btn10").click(function() {
            start_date = '<?php echo date("Y-n-j", strtotime("first day of -2 month")) ?>';
            end_date = '<?php echo date("Y-n-j", strtotime("last day of -2 month")) ?>';
            load_data();
        })
        $("#btn20").click(function() {
            start_date = '<?php echo date("Y-n-j", strtotime("first day of -3 month")) ?>';
            end_date = '<?php echo date("Y-n-j", strtotime("last day of -3 month")) ?>';
            load_data();
        })
        $("#btn25").click(function() {
            start_date = '<?php echo date("Y-n-j", strtotime("first day of -4 month")) ?>';
            end_date = '<?php echo date("Y-n-j", strtotime("last day of -4 month")) ?>';
            load_data();
        })
        $("#btn30").click(function() {
            start_date = '<?php echo date("Y-n-j", strtotime("first day of -5 month")) ?>';
            end_date = '<?php echo date("Y-n-j", strtotime("last day of -5 month")) ?>';
            load_data();
        })
    </script>

    <script>
        $(document).ready(function() {
            weight_full_month();
            city_origin_wise();
            city_destination_wise();
            booking_service_wise();
            booking_status_wise();
            not_delivered();
        });
        $('#o_city').change(function() {
            origin_city = $(this).val();
            load_data();
        })

        function load_data() {
            mydata = {
                action: 'fetch',
                start_date: start_date,
                end_date: end_date,
                origin_city: origin_city,
            }
            $('#myTable,#desTable,#notdeliveredTable,#manifestedTable,#routepiecesTable,#routeTable').DataTable().destroy();
            $('tbody').html('');
            $('tbody').html('<tbody><tr><td colspan="2"><h3>Loading...</h3></td></tr><tbody>');
            weight_full_month();
            city_origin_wise();
            city_destination_wise();
            booking_service_wise();
            booking_status_wise();
            not_delivered();
        }

        function weight_full_month() {
            $('#wmonth').html('');
            $('#bmonth').html('');
            $('#pmonth').html('');
            $.ajax({
                url: "booking_full_month",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#wmonth').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                    $('#pmonth').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                    $('#bmonth').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                },
                success: function(data) {
                    $('#wmonth').html('<canvas id="wcanvas" style="height: 450px; width="350px !important"></canvas>');
                    $('#bmonth').html('<canvas id="bcanvas" style="height: 350px;"></canvas>');
                    $('#pmonth').html('<canvas id="pcanvas" style="height: 350px;"></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")
                    var Booking_Date = [];
                    var weight = [];
                    var pieces = [];
                    var booking = [];

                    var weight_k = [];
                    var pieces_K = [];
                    var booking_k = [];

                    var backgroundColor = [];
                    var backgroundColor_piece = [];
                    var backgroundColor_booking = [];

                    for (var count = 0; count < data.length; count++) {
                        Booking_Date.push(data[count].Booking_Date);
                        if (data[count].weight >= 1000000) {
                            var weight_x = " " + (data[count].weight / 1000000).toFixed(1) + "M";
                            weight_k.push(data[count].Booking_Date);
                        } else {
                            var weight_x = " " + (data[count].weight / 1000).toFixed(0) + "k";
                            weight_k.push(data[count].Booking_Date);
                        }

                        if (data[count].pieces >= 1000000) {
                            var pieces_x = " " + (data[count].pieces / 1000000).toFixed(1) + "M";
                            pieces_K.push(data[count].Booking_Date);
                        } else {
                            var pieces_x = " " + (data[count].pieces / 1000).toFixed(0) + "k";
                            pieces_K.push(data[count].Booking_Date);
                        }

                        if (data[count].booking >= 1000) {
                            var booking_x = " " + (data[count].booking / 1000).toFixed(0) + "k";
                            booking_k.push(data[count].Booking_Date);
                        } else {
                            booking_k.push(data[count].Booking_Date);

                        }
                        weight.push(data[count].weight);
                        pieces.push(data[count].pieces);
                        booking.push(data[count].booking);
                    }

                    for (var i = 0; i < weight.length; i++) {
                        if (weight[i] < 800000) {
                            backgroundColor.push("#FF4136")
                        } else if (weight[i] >= 80000 && weight[i] <= 1700000) {
                            backgroundColor.push("#0074D9")
                        } else if (weight[i] > 1700000) {
                            backgroundColor.push("#2ECC40")
                        }
                    }

                    for (var i = 0; i < pieces.length; i++) {
                        if (pieces[i] < 65000) {
                            backgroundColor_piece.push("#FF4136")
                        } else if (pieces[i] >= 65000 && pieces[i] <= 130000) {
                            backgroundColor_piece.push("#0074D9")
                        } else if (pieces[i] > 130000) {
                            backgroundColor_piece.push("#2ECC40")
                        }
                    }

                    for (var i = 0; i < booking.length; i++) {
                        if (booking[i] < 14000) {
                            backgroundColor_booking.push("#FF4136")
                        } else if (booking[i] >= 14000 && booking[i] <= 30000) {
                            backgroundColor_booking.push('#0074D9')
                        } else if (booking[i] > 30000) {
                            backgroundColor_booking.push("#2ECC40")
                        }
                    }
                    const labelswrap_1 = weight_k.map(label => label.split(' '))
                    const labelswrap_2 = pieces_K.map(label => label.split(' '))
                    const labelswrap_3 = booking_k.map(label => label.split(' '))
                    var data = {
                        labels: labelswrap_1,
                        datasets: [{
                            label: 'Weight Month Wise',
                            data: weight,
                            backgroundColor: backgroundColor,
                            borderColor: backgroundColor,
                            borderWidth: 2
                        }]
                    };
                    const config_weight = {
                        type: 'bar',
                        data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                labels: {
                                    percision: 1,
                                    fontStyle: "bolder",
                                    position: "border",
                                    textMargin: 1,
                                    fontSize: 10,
                                    render: (arg) => {
                                        if (arg.value >= 1000) {
                                            return (arg.value / 1000).toFixed(0) + "t"
                                        } else {
                                            return arg.value
                                        }
                                    },
                                },
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        },
                                        callback: function(value) {
                                            const valuelagend = this.getLabelForValue(value);
                                            const valuelagendrep = valuelagend.replaceAll(',', '');
                                            if (valuelagendrep >= 1000) {
                                                return valuelagendrep / 1000 + 't';
                                            } else {
                                                return valuelagendrep;
                                            }
                                        },
                                    },
                                    grace: '5%',
                                    grid: {
                                        display: false
                                    }
                                }
                            },

                        }
                    };
                    var data = {
                        labels: labelswrap_2,
                        datasets: [{
                            label: 'Piece Month Wise',
                            data: pieces,
                            backgroundColor: backgroundColor_piece,
                            borderColor: backgroundColor_piece,
                            borderWidth: 2
                        }]
                    };

                    const config_peice = {
                        type: 'bar',
                        data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                labels: {
                                    percision: 1,
                                    fontStyle: "bolder",
                                    position: "border",
                                    textMargin: 2,
                                    fontSize: 11,
                                    render: (arg) => {
                                        if (arg.value >= 1000000) {
                                            return (arg.value / 1000000).toFixed(1) + "M"
                                        } else {
                                            return (arg.value / 1000).toFixed(0) + "k"
                                        }
                                    },
                                },
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        },
                                        callback: function(value) {
                                            const valuelagend = this.getLabelForValue(value);
                                            const valuelagendrep = valuelagend.replaceAll(',', '');
                                            if (valuelagendrep >= 1000 && valuelagendrep < 1000000) {
                                                return valuelagendrep / 1000 + 'K';
                                            } else if (valuelagendrep >= 1000000) {
                                                return valuelagendrep / 1000000 + 'M';
                                            } else {
                                                return valuelagendrep;
                                            }
                                        },
                                    },
                                    grace: '5%',
                                    grid: {
                                        display: false
                                    }
                                }
                            },

                        }
                    };
                    var data = {
                        labels: labelswrap_3,
                        datasets: [{
                            label: 'Booking Month Wise',
                            data: booking,
                            backgroundColor: backgroundColor_booking,
                            borderColor: backgroundColor_booking,
                            borderWidth: 2
                        }]
                    };
                    const config_booking = {
                        type: 'bar',
                        data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                labels: {
                                    percision: 1,
                                    fontStyle: "bolder",
                                    position: "border",
                                    textMargin: 2,
                                    fontSize: 11,
                                    render: (arg) => {
                                        if (arg.value >= 1000000) {
                                            return (arg.value / 1000000).toFixed() + "M"
                                        } else {
                                            return (arg.value / 1000).toFixed(0) + "k"
                                        }
                                    },
                                },
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    ticks: {
                                        font: {
                                            size: 10
                                        },
                                        callback: function(value) {
                                            const valuelagend = this.getLabelForValue(value);
                                            const valuelagendrep = valuelagend.replaceAll(',', '');
                                            if (valuelagendrep >= 1000) {
                                                return valuelagendrep / 1000 + 'K';
                                            } else if (valuelagendrep >= 100000) {
                                                return valuelagendrep / 100000 + 'M';
                                            } else {
                                                return valuelagendrep;
                                            }
                                        },
                                    },
                                    grace: '5%',
                                    grid: {
                                        display: false
                                    }
                                }
                            },

                        }
                    };
                    const myChart_weight = new Chart(document.getElementById('wcanvas'), config_weight);
                    const myChart_peice = new Chart(document.getElementById('pcanvas'), config_peice);
                    const myChart_booking = new Chart(document.getElementById('bcanvas'), config_booking);
                }
            })
        }

        function booking_service_wise() {
            $('#chart6').html('');
            $.ajax({
                url: "booking_service_wise",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#chart6').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                },
                success: function(data) {
                    $('#chart6').html('<canvas id="service_name" ></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")
                    var service_name = [];
                    var Total = [];
                    for (var count = 0; count < data.length; count++) {
                        service_name.push(data[count].service_name);
                        Total.push(data[count].Total);
                    }

                    var data = {
                        labels: service_name,
                        datasets: [{
                            label: 'Booking Service Wise',
                            data: Total,
                            datalabels: {
                                color: "white",
                            },
                            backgroundColor: [
                                "#2ECC40",
                                "#0074D9",
                                'rgba(255, 206, 86, 1)',
                                "#FF4136",
                            ],

                            borderColor: [
                                "#2ECC40",
                                "#0074D9",
                                'rgba(255, 206, 86, 1)',
                                "#FF4136",
                            ],
                            borderWidth: 5
                        }]
                    };
                    const config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 25
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    align: "start",
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 10,
                                        boxHeight: 4,
                                    },
                                },

                                labels: {
                                    percision: 1,
                                    arc: true,
                                    position: "outside",
                                    textMargin: 1,
                                    fontSize: 11,
                                    render: (arg) => {
                                        if (arg.percentage > 5) {
                                            if (arg.value >= 1000000) {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            } else {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            }
                                        } else {
                                            return "(" + arg.percentage + "%)"
                                        }
                                    },
                                },
                            },
                        },
                        plugins: [ChartDataLabels],

                    };
                    const myChart = new Chart(
                        document.getElementById('service_name'),
                        config
                    );
                }

            })
        }

        function booking_status_wise() {
            $('#chart7').html('');
            $.ajax({
                url: "booking_status_wise",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#chart7').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                },
                success: function(data) {
                    $('#chart7').html('<canvas id="booking_status" style="height: 350px;"></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")

                    var order_status = [];
                    var Total = [];
                    var delivered = 0;
                    var count_other = 0;
                    var count_booking = 0;
                    for (var count = 0; count < data.length; count++) {
                        if (data[count].order_status == "Deliverd" || data[count].order_status == "Delivered") {
                            delivered = delivered + data[count].Total;
                        } else {
                            order_status.push(data[count].order_status);
                            Total.push(data[count].Total);
                            count_other = count_other + data[count].Total;
                        }
                        count_booking = count_booking + data[count].Total;

                    }

                    if (delivered >= 1000) {
                        $('.total_delivered_count').html(" [  Delivered:" + (delivered / 1000).toFixed(1) + "k (" + ((delivered / count_booking) * 100).toFixed(1) + "%) , ");
                    } else {
                        $('.total_delivered_count').html(" [  Delivered:" + delivered + " (" + ((delivered / count_booking) * 100).toFixed(1) + "%) , ");
                    }

                    if (count_other >= 1000) {
                        $('.total_other_count').html("UnDelivered:" + (count_other / 1000).toFixed(1) + "k (" + ((count_other / count_booking) * 100).toFixed(1) + "%) ]");
                    } else {
                        $('.total_other_count').html("UnDelivered:" + count_other + " (" + ((count_other / count_booking) * 100).toFixed(1) + "%)  ]");
                    }

                    var data = {
                        labels: order_status,
                        datasets: [{
                            label: 'Status UnDelivered ',
                            data: Total,
                            backgroundColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", , "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderWidth: 1,
                            datalabels: {
                                color: "white",
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 21
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    align: "start",
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 10,
                                        boxHeight: 4,
                                    },
                                },
                                labels: {
                                    arc: true,
                                    render: (arg) => {
                                        if (arg.percentage > 5) {
                                            return arg.label + "(" + arg.percentage + "%)"
                                        } else {
                                            if (arg.percentage < 2) {
                                                return ""

                                            } else {
                                                if (arg.label == "DE Manifest") {
                                                    return " DEM "
                                                } else if (arg.label == "Refused") {
                                                    return " Ref "
                                                } else {
                                                    return arg.label
                                                }
                                            }
                                        }
                                    },
                                    fontColor: "black",
                                    position: 'outside',
                                    textMargin: 1,
                                    fontSize: 12,
                                }
                            },
                        },
                        plugins: [ChartDataLabels],
                    };
                    const myChart = new Chart(document.getElementById('booking_status'), config);
                }

            })
        }

        function city_origin_wise() {
            $('#chart1').html('');
            $.ajax({
                url: "city_origin_wise",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#chart1').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                },
                success: function(data) {
                    if (data=="") {
                       $('tbody').html('<tr><td colspan="2"><div class="  col-md-6 alert alert-info" role="alert"> <button class="close "  data-dismiss="alert"></button> <strong>Info!: </strong>No record found.</div></td></tr>');
                    }
                    $('#chart1').html('<canvas id="origin_city_name" style="height: 350px;"></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")
                    var origin_city_name = [];
                    var Total = [];
                    for (var count = 0; count <= 4; count++) {
                        origin_city_name.push(data[count].origin_city_name);
                        Total.push(data[count].Total);
                    }

                    var Total_1 = 0;
                    for (var count = 5; count < data.length; count++) {
                        Total_1 = Total_1 + data[count].Total;
                    }
                    Total.push(Total_1);
                    origin_city_name.push('other')
                    const a = [];
                    for (var count = 0; count <= 5; count++) {
                        const obj = {
                            origin_city_name: '' + origin_city_name[count] + '',
                            Total: (Total[count]/1000).toFixed(1)+"t"
                        }
                        a.push(obj);
                    }
                    var dataSet1 = a;
                    var table5 = $('#myTable').DataTable({
                        "bPaginate": false,
                        "bPaginate": false,
                        "searching": false,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "ordering": false,
                      
                        data: dataSet1,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "origin_city_name"
                            }
                        ],
                        "lengthMenu": [
                            [6],
                            [6]
                        ],
                    });
                    var data = {
                        labels: origin_city_name,
                        datasets: [{
                            label: 'Booking Origin City Wise',
                            data: Total,
                            backgroundColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderWidth: 2,
                            datalabels: {
                                color: "white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 25
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    align: "start",
                                    position: "bottom",

                                    labels: {
                                        boxWidth: 30,
                                        boxHeight: 8
                                    },
                                },

                                labels: {
                                    percision: 1,
                                    arc: true,
                                    position: "outside",
                                    textMargin: 5,
                                    fontSize: 11,
                                    render: (arg) => {
                                        if (arg.percentage > 4) {
                                            if (arg.value >= 1000000) {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            } else {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            }
                                        } else {
                                            return arg.label
                                        }
                                    },
                                },
                                datalabels: {
                                    font: {
                                        size: 11,
                                    },
                                    anchor: 'end',
                                    align: 'end',
                                    offset: -90,
                                }
                            },
                        },
                    };
                    const myChart = new Chart(document.getElementById('origin_city_name'), config);
                }
            })
        }

        function city_destination_wise() {
            $('#chart2').html('');
            $.ajax({
                url: "city_destination_wise",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#chart2').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>")
                },
                success: function(data) {
                    $('#chart2').html('<canvas id="city_destination_wise" style="height: 350px;"></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")

                    var destination_city_name = [];
                    var Total = [];
                    for (var count = 0; count <= 4; count++) {
                        destination_city_name.push(data[count].destination_city_name);
                        Total.push(data[count].Total);
                    }

                    var Total_1 = 0;
                    for (var count = 5; count < data.length; count++) {
                        Total_1 = Total_1 + data[count].Total;
                    }

                    Total.splice(9, 0, Total_1);
                    destination_city_name.push('other')
                    const a = [];
                    for (var count = 0; count <= 5; count++) {
                        const obj = {
                            destination_city_name: '' + destination_city_name[count] + '',
                            Total: (Total[count]/1000).toFixed(1)+"t"
                        }
                        a.push(obj);
                    }
                    var dataSet2 = a;
                    var table5 = $('#desTable').DataTable({
                        "bPaginate": false,
                        "searching": false,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "ordering": false,

                        data: dataSet2,
                        "columns": [{
                                "data": "Total"
                            },
                            {
                                "data": "destination_city_name"
                            }
                        ],
                        "lengthMenu": [
                            [6],
                            [6]
                        ],
                    });


                    var data = {
                        labels: destination_city_name,
                        datasets: [{
                            label: 'Booking Destination City Wise',
                            data: Total,
                            backgroundColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderColor: ["#2ECC40", "#0074D9", "#FF4136", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            datalabels: {
                                color: "white",
                            },
                            borderWidth: 3,
                            datalabels: {
                                color: "white"
                            }
                        }]
                    };

                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 25
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    align: "start",
                                    position: "bottom",

                                    labels: {
                                        boxWidth: 30,
                                        boxHeight: 8
                                    },
                                },

                                labels: {
                                    percision: 1,
                                    arc: true,
                                    position: "outside",
                                    textMargin: 1,
                                    fontSize: 12,
                                    render: (arg) => {
                                        if (arg.percentage > 5) {
                                            if (arg.value >= 1000000) {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            } else {
                                                return arg.label + "(" + arg.percentage + "%)"
                                            }
                                        } else {
                                            return arg.label
                                        }
                                    },
                                },
                                datalabels: {
                                    font: {
                                        size: 11,
                                    },
                                    anchor: 'end',
                                    align: 'end',
                                    offset: -90,
                                }
                            },
                        },
                    };
                    const myChart = new Chart(document.getElementById('city_destination_wise'), config);
                }

            })
        }

        function not_delivered() {
            $('#chartd').html('');
            $.ajax({
                url: "not_delivered",
                method: "GET",
                data: mydata,
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", true).css("cursor", "not-allowed")
                    $('#chartd').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>");
                },
                success: function(data) {
                    $('#chartd').html('<canvas id="not_delivered" style="height: 350px;"></canvas>');
                    $('#btn1,#btn5,#btn10,#btn20').attr("disabled", false).css("cursor", "pointer")
                    var Destination = [];
                    var Total = [];
                    for (var count = 0; count <= 4; count++) {
                        Destination.push(data[count].Destination);
                        Total.push(data[count].Total);
                    }

                    var Total_1 = 0;
                    for (var count = 5; count < data.length; count++) {
                        Total_1 = Total_1 + data[count].Total;
                    }
                    Total.push(Total_1)
                    Destination.push('other')
                    var data = {
                        labels: Destination,
                        datasets: [{
                            label: 'Order UnDelivered ',
                            data: Total,
                            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderColor: ["#0074D9", "#FF4136", "#2ECC40", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                            borderWidth: 3,
                            datalabels: {
                                color: "white"
                            }
                        }]
                    };
                    // config 
                    var config = {
                        type: 'pie',
                        data,
                        options: {
                            layout: {
                                padding: 21
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    align: "start",
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 10,
                                        boxHeight: 4,
                                    },
                                },
                                labels: {
                                    arc: true,
                                    render: (arg) => {
                                        if (arg.percentage > 5) {
                                            return arg.label + "(" + arg.percentage + "%)"
                                        } else {
                                            return arg.label
                                        }
                                    },
                                    fontColor: "black",
                                    position: 'outside',
                                    textMargin: 1,
                                    fontSize: 12,
                                }
                            },
                        },
                        plugins: [ChartDataLabels],
                    };
                    const myChart = new Chart(document.getElementById('not_delivered'), config);
                }
            });
        }
    </script>
    <!-- change records btn list's color on click -->
    <script>
        $(document).ready(function() {
            $(".record_btn > li a").click(function() {
                $('.record_btn > li a').removeClass('color');
                $(this).addClass('color');
            });
        });
    </script>
    <!-- search plugin for city  dropdown  -->
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