<?php
error_reporting(0);
$this->load->view('inc/header');
?>
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
                        <li class="breadcrumb-item">Dc Status</li>
                        <li class="breadcrumb-item">Dc Pending Status</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d H:i:s'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <div class="pgn-wrapper" data-position="top" style="top: 10px;"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row mb-1 mt-0">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table table-bordered compact wrap dataTable no-footer" id="emp_table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width=10px> Sr#</th>
                                                        <th> DC No</th>
                                                        <th> Order Code</th>
                                                        <th> Manual Cn</th>
                                                        <th> Arrival Date</th>
                                                        <th> Order Status</th>
                                                        <th> Customer</th>
                                                        <th> Consignee</th>
                                                        <th> Destination City</th>
                                                        <th style="display:none ;">Order Id</th>
                                                        <th width=4%>Soft Copy</th>
                                                        <th width=4%>Hard Copy</th>
                                                        <th width=4%>Request Back</th>
                                                        <th width=4%>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($pending as $rows) {
                                                        if ($rows['order_status']== 'Deliverd') {
                                                            $i = $i + 1;
                                                        $id = $rows['row_id'];
                                                        $dcNO = $rows['dc_No'];
                                                        $order_id = $rows['order_code'];
                                                        $manual_cn = $rows['manual_cn'];
                                                        $soft_copy_check = $rows['soft_copy_check'];
                                                        $hard_copy_check = $rows['hard_copy_check'];
                                                        $request_by_check = $rows['request_by_check'];
                                                        $order_status = $rows['order_status'];
                                                        $customer = $rows['customer_name'];
                                                        $destination_city_name = $rows['destination_city_name'];
                                                        $order_booking_date = $rows['order_arrival_date'];
                                                        $consignee_name = $rows['consignee_name'];
                                                        }
                                                      
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"> <?php echo  $i; ?></td>
                                                            <td class="edit_dc"> <input disabled class="pickvalue" type="number" value="<?php echo   $dcNO ?>"></td>
                                                            <td> <?php echo $order_id ?></td>
                                                            <td> <?php echo $manual_cn ?></td>
                                                            <td> <?php echo date("d/M/Y", strtotime($order_booking_date)) ?></td>

                                                            <td> <?php echo $order_status ?></td>
                                                            <td> <?php echo $customer ?></td>
                                                            <td> <?php echo $consignee_name ?></td>
                                                            <td> <?php echo $destination_city_name ?></td>
                                                            <td hidden> <input type="number" hidden class="row_id" value="<?php echo $id ?>"></td>
                                                            <?php if ($order_status != 'Deliverd') { ?>
                                                                <td class="text-center"> <input type="checkbox" disabled></td>
                                                                <td class="text-center"> <input type="checkbox" disabled></td>
                                                                <td class="text-center"> <input type="checkbox" disabled></td>
                                                                <td class="text-center"><button disabled class='btn btn-info btn-xs' style="cursor:not-allowed ;">Update Now</button></td>
                                                            <?php } else { ?>
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
                                                                    echo '<td class="text-center"><button disabled style="cursor:not-allowed ;" class=" btn btn-success btn-xs">Updated</button></td>';
                                                                } else {
                                                                    echo '<td class="text-center"><button class="update_row btn btn-info btn-xs">Update Now</button></td>';
                                                                }
                                                                ?>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
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
                    [50, 100, -1],
                    [50, 100, "All"]
                ],
            });
        });
    </script>


    <script>
        $(".edit_dc").click(function() {
            var $row = $(this).closest("tr");
            $row.find(".pickvalue").attr("disabled", false);
            $(".pickvalue").keypress(function(event) {
                var edit_dc = $row.find(".pickvalue").val();
                var row_id = $row.find(".row_id").val();
                var mydata = {
                    row_id: row_id,
                    edit_dc: edit_dc,
                };
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    $.ajax({
                        url: "update_dc",
                        method: "POST",
                        data: mydata,
                        beforeSend: function() {
                            $row.find(".pickvalue").css("cursor", "not-allowed");
                        },
                        success: function(data) {
                            $row.find(".pickvalue").attr("disabled", true).css("cursor", "pointer");
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
            var edit_dc = $row.find(".pickvalue").val();
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
                edit_dc: edit_dc,
            };

            $.ajax({
                url: "update_record",
                method: "POST",
                data: mydata,
                beforeSend: function() {
                    $row.find(".update_row").html(' Sending .. ');
                    $row.find(".update_row").attr("disabled", true).css("cursor", "not-allowed");
                },
                success: function(data) {
                    if (soft_copy_ch && hard_copy_ch) {
                        $row.find(".update_row").html('Updated').attr("disabled", true).css("cursor", "not-allowed").addClass('btn-success').removeClass('btn-info');
                        location.reload();
                    } else {
                        $row.find(".update_row").html('Update Now');
                        $row.find(".update_row").attr("disabled", false).css("cursor", "pointer")
                    }
                    $("#msg_div").html(data);
                },
            });
        });
    </script>
    <!-- update record -->

    <script>
        window.onload = function() {
            window.setTimeout(function() {
                $('.alert').css('display', 'none');
            }, 3000);
        }
    </script>