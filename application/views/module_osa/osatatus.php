<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<style>
    .lds-ring {
        display: inline-block;
        position: relative;
        width: 9px;
        height: 14px;
        top: 0px;
        right: 6px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 16px;
        height: 16px;
        margin: 3px;
        border: 3px solid #fff;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #fff transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<style>
    .table thead tr th {
        text-transform: capitalize;
        font-weight: 600;
        font-family: apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        font-size: 10.5px;
        letter-spacing: 0.05em;
        padding-top: 3px;
        padding-bottom: 3px;
        vertical-align: middle;
        border-bottom: 1px solid rgb(57, 44, 40);
        color: #6d5eac;
        border-top: none;
        border-top: 1px solid gray !important;
    }

    .edit_bts {
        display: block;
        width: 85px;
        font-size: 13px;
        padding: 3px 5px;
        line-height: normal;
        min-height: 8px;
    }

    .edit_bts_success {
        color: #04AA6D !important;
        font-weight: 600;
    }

    .edit_bts_danger {
        color: red !important;
        font-weight: 600;
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
                        <li class="breadcrumb-item">OSA Status</li>
                        <li class="breadcrumb-item">OSA Pending Status</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d h:i:sa'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <div class="pgn-wrapper" data-position="top" style="top: 4px;" id="msg_div"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="card ">
                            <div class="card-header  separator">
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default required" id="user_name_div">
                                                <form method="POST" action="pending_osa_status">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" required="" value="<?php echo $date[0] ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default required">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" required="" value="<?php echo $date[1] ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <button id="date_range" class='btn btn-primary' style="height:100%">GO</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 mt-0">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <table class="table table-bordered compact wrap dataTable no-footer" id="emp_table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width=10px> Sr#</th>
                                                        <th> Order Code | Manual CN</th>
                                                        <th> OSA</th>
                                                        <th> OSA SD</th>
                                                        <th> Arrival Date</th>
                                                        <th> Order Status</th>
                                                        <th> Customer</th>
                                                        <th> Consignee | Shipper</th>
                                                        <th> Origin | Destination</th>
                                                        <th style="display:none ;">Order Id</th>
                                                        <th width=4%>CS</th>
                                                        <th width=4%>BM</th>
                                                        <th width=4%>A/C </th>
                                                        <th width=4%>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 1;
                                                    foreach ($pending as $rows) {

                                                        if ($rows['order_status'] == 'Deliverd') {
                                                            $order_code = $rows['order_code'];
                                                            $manual_cn = $rows['manual_cn'];
                                                            $order_osa = $rows['order_osa'];

                                                            if ($rows['order_osa_sd_total'] != Null) {
                                                                $order_osa_sd_total = $rows['order_osa_sd_total'];
                                                            } else {
                                                                $order_osa_sd_total = 0;
                                                            }

                                                            $order_booking_date = $rows['arrival_date'];
                                                            $order_status = $rows['order_status'];
                                                            $customer = $rows['customer_name'];
                                                            $consignee_name = $rows['consignee_name'];
                                                            $shipper_name = $rows['shipper_name'];
                                                            $origin_city_name = $rows['origin_city_name'];
                                                            $destination_city_name = $rows['destination_city_name'];
                                                            $soft_copy_check = $rows['soft_copy_check'];
                                                            $hard_copy_check = $rows['hard_copy_check'];
                                                            $request_by_check = $rows['request_by_check'];
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo  $i; ?></td>
                                                                <td> <?php echo $order_code  ?> | <?php echo $manual_cn ?></td>
                                                                <?php
                                                                if ($order_osa <= 0) {
                                                                    echo ' <td class="edit_order_osa"> <input  class="edit_osa form-control edit_bts   edit_bts_danger "  type="number" value="' .  $order_osa . '"></td>';
                                                                } else {
                                                                    echo ' <td class="edit_order_osa"> <input disabled class="edit_osa form-control edit_bts  edit_bts_success"  type="number" value="' . $order_osa . '"></td>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($order_osa_sd_total <= 0) {
                                                                    echo ' <td class="order_osa_sd_total"> <input  class="edit_sd form-control edit_bts  edit_bts_danger" type="number" value="' .  $order_osa_sd_total . '"></td>';
                                                                } else {
                                                                    echo ' <td class="order_osa_sd_total"> <input disabled class="edit_sd form-control edit_bts  edit_bts_success"  type="number" value="' . $order_osa_sd_total . '"></td>';
                                                                }
                                                                ?>

                                                                <td> <?php echo date("d/M/Y", strtotime($order_booking_date)) ?></td>
                                                                <td> <?php echo $order_status ?></td>
                                                                <td> <?php echo $customer ?></td>
                                                                <td> <?php echo $consignee_name ?> | <?php echo $shipper_name ?></td>
                                                                <td> <?php echo $origin_city_name ?> | <?php echo $destination_city_name ?></td>
                                                                <td hidden> <input type="number" hidden class="row_id" value="<?php echo $order_code ?>"></td>
                                                                <?php
                                                                if ($soft_copy_check) {
                                                                    echo '<td class="text-center"> <input type="checkbox" checked disabled class="soft_copy check-primary"></td>';
                                                                } else {
                                                                    echo '<td class="text-center"> <input type="checkbox"  class="soft_copy check-primary"></td>';
                                                                }
                                                                if ($hard_copy_check) {
                                                                    echo '<td class="text-center"> <input type="checkbox" checked disabled class="hard_copy check-primary"></td>';
                                                                } else {
                                                                    echo '<td class="text-center"> <input type="checkbox" class="hard_copy check-primary"></td>';
                                                                }
                                                                if ($request_by_check) {
                                                                    echo '  <td class="text-center"> <input type="checkbox" checked disabled class="request_by check-primary"></td>';
                                                                } else {
                                                                    echo '  <td class="text-center"> <input type="checkbox" class="request_by check-primary"></td>';
                                                                }
                                                                if ($soft_copy_check == true && $hard_copy_check == true && $request_by_check == true) {
                                                                    echo '<td class="text-center"><button disabled style="cursor:not-allowed ;" class=" btn btn-success btn-xs">✓</button></td>';
                                                                } else {
                                                                    echo '<td class="text-center"><button class="update_row btn btn-info btn-xs">✓</button></td>';
                                                                }
                                                                ?>
                                                            </tr>
                                                    <?php $i++;
                                                        }
                                                    } ?>

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

    <?php
    $this->load->view('inc/footer');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#emp_table').DataTable({
                "lengthMenu": [
                    [10, 50, 100, -1],
                    [10, 50, 100, "All"]
                ],
            });
        });
    </script>


    <script>
        $(".edit_order_osa").click(function() {
            var $row = $(this).closest("tr");
            $row.find(".edit_osa").attr("disabled", false);
            $(".edit_osa").keypress(function(event) {
                var edit_order_osa = $row.find(".edit_osa").val();
                var order_code = $row.find(".row_id").val();

                var mydata = {
                    row_id: order_code,
                    edit_order_osa: edit_order_osa,
                };

                var keycode = (event.keyCode ? event.keyCode : event.which);

                if (keycode == '13') {
                    $.ajax({
                        url: "update_osa",
                        method: "POST",
                        data: mydata,
                        beforeSend: function() {
                            $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Please Wait Manual CN <strong>" + order_code + "</strong> is getting processed.</div></div>");
                            $row.find(".edit_osa").css("cursor", "not-allowed");
                            if (edit_order_osa == 0) {
                                $row.find(".edit_osa").addClass('edit_bts_danger').removeClass('edit_bts_success');
                            } else {
                                $row.find(".edit_osa").addClass('edit_bts_success').removeClass('edit_bts_danger');
                            }
                        },
                        success: function(data) {
                            $("#msg_div").html(data);
                            $row.find(".edit_osa").attr("disabled", true).css("cursor", "pointer");
                        },
                    });
                }
            });


        })

        $(".order_osa_sd_total").click(function() {
            var $row = $(this).closest("tr");
            $row.find(".edit_sd").attr("disabled", false);
            $(".edit_sd").keypress(function(event) {
                var order_osa_sd_total = $row.find(".edit_sd").val();
                var edit_order_osa = $row.find(".edit_osa").val();

                var order_code = $row.find(".row_id").val();

                var mydata = {
                    row_id: order_code,
                    order_osa_sd_total: order_osa_sd_total,
                    edit_order_osa: edit_order_osa,
                };
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    $.ajax({
                        url: "update_sd",
                        method: "POST",
                        data: mydata,
                        beforeSend: function() {
                            $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Please Wait Manual CN <strong>" + order_code + "</strong> is getting processed.</div></div>");

                            $row.find(".edit_sd").css("cursor", "not-allowed");
                            if (edit_order_osa == 0) {
                                $row.find(".edit_osa").addClass('edit_bts_danger').removeClass('edit_bts_success');
                            } else {
                                $row.find(".edit_osa").addClass('edit_bts_success').removeClass('edit_bts_danger');
                            }
                            if (order_osa_sd_total == 0) {
                                $row.find(".edit_sd").addClass('edit_bts_danger').removeClass('edit_bts_success');
                            } else {
                                $row.find(".edit_sd").addClass('edit_bts_success').removeClass('edit_bts_danger');
                            }
                        },
                        success: function(data) {
                            $row.find(".edit_sd").attr("disabled", true).css("cursor", "pointer");
                            $("#msg_div").html(data);
                        },
                    });
                }
                // $("#cnnumber").blur();
            });


        })
        $(".update_row").click(function() {
            var $row = $(this).closest("tr");
            var soft_copy_check = '';
            var hard_copy_check = '';
            var request_by_check = '';
            var soft_copy = $row.find(".soft_copy").is(':checked');
            var hard_copy = $row.find(".hard_copy").is(':checked');
            var request_by = $row.find(".request_by").is(':checked');
            var edit_order_osa = $row.find(".edit_osa").val();
            var row_id = $row.find(".row_id").val();

            if (soft_copy) {
                soft_copy_check = 1
                $row.find(".soft_copy").attr("disabled", true);
            } else {
                soft_copy_check = 0
            }

            if (hard_copy) {
                hard_copy_check = 1
                $row.find(".hard_copy").attr("disabled", true);
            } else {
                hard_copy_check = 0
            }

            if (request_by) {
                request_by_check = 1
                $row.find(".request_by").attr("disabled", true);
            } else {
                request_by_check = 0
            }
            var soft_copy_ch = '';
            var hard_copy_ch = '';
            var request_by_ch = '';
            if ($row.find('.soft_copy').attr('disabled')) {
                soft_copy_ch = 1;
            }
            if ($row.find('.hard_copy').attr('disabled')) {
                hard_copy_ch = 1;
            }
            if ($row.find('.request_by').attr('disabled')) {
                request_by_ch = 1;
            }
            var mydata = {
                order_id: row_id,
                soft_copy_check: soft_copy_check,
                hard_copy_check: hard_copy_check,
                request_by_check: request_by_check,
                edit_order_osa: edit_order_osa,
            };

            $.ajax({
                url: "update_record",
                method: "POST",
                data: mydata,
                beforeSend: function() {
                    $row.find(".update_row").html('<div class="lds-ring"><div></div><div></div><div></div><div>');
                    $row.find(".update_row").attr("disabled", true).css("cursor", "not-allowed");
                },
                success: function(data) {
                    if (soft_copy_ch && hard_copy_ch) {
                        $row.find(".update_row").html('Updated').attr("disabled", true).css("cursor", "not-allowed").addClass('btn-success').removeClass('btn-info');
                        location.reload();
                    } else {
                        $row.find(".update_row").html('✓');
                        $row.find(".update_row").attr("disabled", false).css("cursor", "pointer")
                    }
                    $("#msg_div").html(data);
                },
            });
        });
       
    </script>
    <!-- update record -->