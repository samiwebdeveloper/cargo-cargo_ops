<?php
error_reporting(0);
$start_date = $date[0];
$end_date = $date[1];

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
                        <li class="breadcrumb-item">Tools</li>
                        <li class="breadcrumb-item">Dc Status</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d H:i:s'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="pgn-wrapper" data-position="top" style="top: 48px;"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="card-header separator">
                                            <div class="card-title">
                                                <h4>Pending Dc Status</h4>
                                            </div>
                                        </div>
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table table-bordered compact nowrap dataTable no-footer" id="emp_table" width="99%">
                                                <thead>
                                                    <tr>
                                                        <th width=10px> Sr#</th>
                                                        <th> DC No</th>
                                                        <th> Order Code</th>
                                                        <th> Order Status</th>
                                                        <th> Customer</th>
                                                        <th> Destination City</th>
                                                        <th style="display:none ;">Order Id</th>
                                                        <th width=8%>Soft Copy</th>
                                                        <th width=8%>Hard Copy</th>
                                                        <th width=8%>Request Back</th>
                                                        <th width=8%> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($pending as $rows) {
                                                        $i = $i + 1;
                                                        $id = $rows['row_id'];
                                                        $dcNO = $rows['dc_No'];
                                                        $order_id = $rows['order_code'];
                                                        $soft_copy_check = $rows['soft_copy_check'];
                                                        $hard_copy_check = $rows['hard_copy_check'];
                                                        $request_by_check = $rows['request_by_check'];
                                                        $order_status = $rows['order_status'];
                                                        $customer = $rows['customer_name'];
                                                        $destination_city_name = $rows['destination_city_name'];

                                                    ?>
                                                        <tr>
                                                            <td class="text-center"> <?php echo  $i; ?></td>
                                                            <td> <?php echo   $dcNO ?></td>
                                                            <td> <?php echo $order_id ?></td>
                                                            <td> <?php echo $order_status ?></td>
                                                            <td> <?php echo $customer ?></td>
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
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-header  separator">
                                        <div class="form-group-attached">
                                            <div class="row clearfix">
                                                <div class="col-sm-3">
                                                    <div class="form-group form-group-default required" id="user_name_div">
                                                        <form>
                                                            <label>Start Date</label>
                                                            <input type="date" class="form-control" id="start_date" name="start_date" required="" value="<?php echo $start_date; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group form-group-default required">
                                                        <label>End Date</label>
                                                        <input type="date" class="form-control" id="end_date" name="end_date" required="" value="<?php echo $end_date ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button id="date_range" class='btn btn-primary' style="height:100%">GO</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div class="card-header separator">
                                                <div class="card-title">
                                                    <h4>Complete Dc Status</h4>
                                                </div>
                                            </div>
                                            <table class="table table-bordered compact nowrap dataTable no-footer"  width="99%">
                                                <thead>
                                                    <tr>
                                                        <th width=10px> Sr#</th>
                                                        <th> DC No</th>
                                                        <th> Order Code</th>
                                                        <th> Order Status</th>
                                                        <th> Customer</th>
                                                        <th> Destination City</th>
                                                        <th style="display:none ;">Order Id</th>
                                                        <th width=8%>Soft Copy</th>
                                                        <th width=8%>Hard Copy</th>
                                                        <th width=8%>Request Back</th>
                                                        <th width=8%> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="complete_record">
                                                      <tr><td colspan="10">loading ...</td></tr>
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
            fetch_record();
            var table = $('table').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "fixedHeader": true,
                "proccessing": true,
                "searching": true,
                "paging": true,
                "ordering": true,
                "bInfo": true,
                dom: 'Blfrtip',
                buttons: ['colvis']
            });
        });
    </script>

    <script>
        $("#date_range").click(function() {
            fetch_record();
        })

        function fetch_record(event) {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var mydata = {
                start_date: start_date,
                end_date: end_date
            };
            $.ajax({
                url: "fetch_record",
                method: "GET",
                data: mydata,

                beforeSend: function() {
                                        $('#data_by_ajax').html("<img src='<?php echo base_url(); ?>assets/ajax-loader.gif' style='margin-left:100px' width='130px'>");
                    $("#date_range").attr("disabled", true).css("cursor", "not-allowed");
                },
                success: function(data) {
                    if (data != '') {
                        $("#date_range").attr("disabled", false).css("cursor", "pointer");
                        $(".complete_record").html(data);
                    } 
                },
            });
        }
    </script>

    <script>
        $(".update_row").click(function() {
            var $row = $(this).closest("tr");
            var soft_copy_check = '';
            var hard_copy_check = '';
            var request_by_check = '';
            var soft_copy = $row.find(".soft_copy").is(':checked');
            var hard_copy = $row.find(".hard_copy").is(':checked');
            var request_by = $row.find(".request_by").is(':checked');
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
                request_by_check: request_by_check
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