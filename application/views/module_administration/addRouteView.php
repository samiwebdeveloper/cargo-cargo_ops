<?php
error_reporting(0);
$this->load->view('inc/header');
?>

<style>
    .alert .close {
        top: 1.5px;
        left: 10px;
    }
</style>

<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Administraion</li>
                        <li class="breadcrumb-item">Add Route</li>
                        <li class="breadcrumb-item">Route</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d h:i:a'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="pgn-wrapper" data-position="top" style="top: 48px;" id="msg_div"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">Add Route</div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo  $this->session->flashdata('msg'); ?>
                                        <form id="myForm" role="form" method="post" action="<?= base_url() ?>AddRoute/savedata">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default required ">
                                                    <label>Route Service </label>
                                                    <select class="form-control" id="service_name" name="service_name" value="<?php echo set_value('service_name'); ?>" tabindex=4>
                                                        <option value="0" selected>Select Route Service</option>
                                                        <?php foreach ($route_service as $city) { ?>
                                                            <option value="<?php echo $city->service_name; ?> <?php echo set_select('service_name', $city->service_name); ?>"><?php echo $city->service_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span style="color: red;" id="service_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group form-group-default required ">
                                                    <label>Select Route Origin</label>
                                                    <select class="form-control" id="route_origin" name="route_origin" value="<?php echo set_value('route_origin'); ?>" tabindex=4>
                                                        <option value="0" selected>Select Origin City</option>
                                                        <?php foreach ($route_origin as $city) { ?>
                                                            <option value=<?php echo $city->city_id; ?> <?php echo set_select('route_origin', $city->city_id); ?>><?php echo $city->city_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span style="color: red;" id="origin_error"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default required ">
                                                    <label>Select Route Destination</label>
                                                    <select class="form-control" id="route_des" name="route_des" value="<?php echo set_value('route_des'); ?>" tabindex=4>
                                                        <option value='0' selected>Select Route Destination</option>
                                                        <?php foreach ($route_origin as $city) { ?>
                                                            <option value=<?php echo $city->city_id; ?> <?php echo set_select('route_des', $city->city_id); ?>><?php echo $city->city_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span style="color: red;" id="des_error"></span>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default required ">
                                                    <label>Select Transit City</label>
                                                    <select class="form-control" id="transit_city" name="transit_city[]" multiple value="<?php echo set_value('transit_city[]'); ?>" tabindex=4>
                                                        <?php $locs = array_column($route_origin, 'city_full_name', 'city_id'); ?>
                                                        <?php foreach ($route_transit_city as $city) { ?>
                                                            <option value=<?php echo $city->reporting_city; ?> <?php echo set_select('transit_city[]', $city->reporting_city); ?>><?php echo   $locs[$city->reporting_city]  ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span style="color: red;" id="transit_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div>
                                                <input type="submit" id="save" name="save" class='btn btn-primary pull-right' />
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">Route List</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class='table table-bordered compact' style="border-top:1px solid black ;" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr#</th>
                                                        <th>Route Name</th>
                                                        <th>Route Service</th>
                                                        <th>Route Code</th>
                                                        <th>Route city Count</th>
                                                        <th>Route city Name</th>
                                                        <th>Created By</th>
                                                        <th>Created Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultTable">
                                                    <?php
                                                    $i = 0;   
                                                    foreach ($route_list_history as $rows) {
                                                        $userid = $rows->oper_user_id;
                                                        echo ("<tr>");
                                                        echo ("<td>" . ($i+1) . "</td>");
                                                        echo ("<td>" . $rows->route_name . "</td>");
                                                        echo ("<td>" . $rows->route_service_name . "</td>");
                                                        echo ("<td>" . $rows->route_code . "</td>");
                                                        echo ("<td>" . $rows->route_city_count . "</td>");
                                                        echo "<td>";
                                                        for ($k = 0; $k < count($route_city_name[$i]); $k++) {
                                                            echo $route_city_name[$i][$k]['city'].",<br>";
                                                        }
                                                        echo"</td>";
                                                        echo ("<td>" . $rows->oper_user_name . "</td>");
                                                        echo ("<td>" . $rows->created_date . "</td>");
                                                        echo ("</tr>");
                                                        $i = $i + 1;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END card -->
                        </div>
                    </div>
                    <!-- END PLACE PAGE CONTENT HERE -->
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
    </div>

    <?php $this->load->view('inc/footer'); ?>
    <style>
        .is-invalid {
            border-color: #dc3545 !important;
            font-size: 20px !important;
        }
    </style>
    <script type="text/javascript">
        $("select,input").on({change: function() {

                if ($('#service_name').val() == '0') {
                    $('#service_error').html("The Route Service field is required.");
                } else {
                    $('#service_error').html("");
                }

                if ($('#route_des').val() == '0') {
                    $('#des_error').html("The Destination City field is required.");
                } else {
                    $('#des_error').html("");
                }

                if ($('#route_origin').val() == '0') {
                    $('#origin_error').html("The Origin City field is required.");
                } else {
                    $('#origin_error').html("");
                }
                
                if ($('#transit_city').length==0) {
                    $('#transit_error').html("The Transit City field is required.");
                } else {
                    $('#transit_error').html("");
                }

            }
        });

        $(document).ready(function() {
            $('#transit_city').select2();
            $('#service_name').select2();
            $('#route_des').select2();
            $('#route_origin').select2();

            $('form').on('submit', function(e) {
                var transit_city = $('#transit_city').val();
                var service_name = $('#service_name').val();
                var route_des = $('#route_des').val();
                var route_origin = $('#route_origin').val();
                if (transit_city.length==0 || service_name == 0 || route_des == '0' || route_origin == '0') {
                    e.preventDefault();
                    if (transit_city.length == 0) {
                        $('#transit_error').html("The Transit City field is required.");
                    }
                    if (service_name == 0) {
                        $('#service_error').html("The Route Service field is required.");
                    }
                    if (route_des == '0') {
                        $('#des_error').html("The Destination City field is required.");
                    }
                    if (route_origin == '0') {
                        $('#origin_error').html("The Origin City field is required.");
                    }
                }
            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "displayLength": 15,
                "lengthMenu": [
                    [15, 25, 50, 100, 200, 500, -1],
                    [15, 25, 50, 100, 200, 500, "All"]
                ],
                fixedHeader: true,
                "searching": true,
                "paging": true,
                "ordering": true,
                "bInfo": true,
                dom: 'Blfrtip',
                buttons: [
                    'colvis',

                    {
                        extend: 'excelHtml5',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                        text: "<i class='fs-14 pg-form'></i> Excel",
                        titleAttr: 'Excel',
                        sheetName: 'User Report',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        footer: 'true',
                        text: "<i class='fs-14 pg-note'></i> Copy",
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'print',
                        text: "<i class='fs-14 pg-ui'></i> Print",
                        titleAttr: 'Print',
                        footer: 'true',
                        title: "User Report",
                        message: "Delivery Express <br> System Developer M.Saim <br>Date:<?php echo $start_date . " To " . $end_date; ?> <br>  QSR Report<br>"
                    },
                ]
            });

        });
    </script>

   