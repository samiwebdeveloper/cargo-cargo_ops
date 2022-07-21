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
                        <li class="breadcrumb-item">DC Soft Copy Pending</li>
                        <li class="breadcrumb-item">DC Soft Copy Pending Customer&Month Wise </li>
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
                                            <table class="table table-bordered compact nowrap dataTable no-footer" id="emp_table" width="99%">
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
                                                        <th width=4%>Soft By</th>
                                                        <th width=4%>Date(Soft)</th>
                                                        <th width=4%>Hard Copy</th>
                                                        <th width=4%>Hard By</th>
                                                        <th width=4%>Date(Hard)</th>
                                                        <th width=4%>Request Back</th>
                                                        <th width=4%>Request By</th>
                                                        <th width=4%>Date(Request)</th>
                                                        <th width=4%> Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($soft_copy_pending as $rows) {
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
                                                        $consignee_name = $rows['consignee_name'];
                                                        $destination_city_name = $rows['destination_city_name'];
                                                        $order_booking_date = $rows['order_arrival_date'];

                                                        $soft_copy_by = $rows['soft_by'];
                                                        $soft_copy_at = $rows['soft_copy_at'];

                                                        $hard_copy_by = $rows['hard_by'];
                                                        $hard_copy_at = $rows['hard_copy_at'];

                                                        $requested_by = $rows['request_by'];
                                                        $requested_at = $rows['requested_at'];
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"> <?php echo  $i; ?></td>
                                                            <td class="edit_dc"> <?php echo   $dcNO ?></td>
                                                            <td> <?php echo $order_id ?></td>
                                                            <td> <?php echo $manual_cn ?></td>
                                                            <td> <?php echo date("d-M-Y", strtotime($order_booking_date)) ?></td>

                                                            <td> <?php echo $order_status ?></td>
                                                            <td> <?php echo $customer ?></td>
                                                            <td> <?php echo $consignee_name ?></td>
                                                            <td> <?php echo $destination_city_name ?></td>
                                                            <td hidden> <input type="number" hidden class="row_id" value="<?php echo $id ?>"></td>

                                                            <?php
                                                            if ($soft_copy_check) {
                                                                echo '<td class="text-center"> Received</td>';
                                                                echo '<td class="text-center"> ' . $soft_copy_by . '</td>';
                                                                echo '<td class="text-center"> ' . $soft_copy_at . '</td>';
                                                            } else {
                                                                echo '<td class="text-center">Not Received</td>';
                                                                echo '<td class="text-center"> ' . $soft_copy_by . '</td>';
                                                                echo '<td class="text-center"> ' . $soft_copy_at . '</td>';
                                                            }
                                                            if ($hard_copy_check) {
                                                                echo '<td class="text-center"> Received</td>';
                                                                echo '<td class="text-center"> ' . $hard_copy_by . '</td>';
                                                                echo '<td class="text-center"> ' . $hard_copy_at . '</td>';
                                                            } else {
                                                                echo '<td class="text-center">Not Received</td>';
                                                                echo '<td class="text-center"> ' . $hard_copy_by . '</td>';
                                                                echo '<td class="text-center"> ' . $hard_copy_at . '</td>';
                                                            }
                                                            if ($request_by_check) {
                                                                echo '<td class="text-center"> Yes</td>';
                                                                echo '<td class="text-center"> ' . $requested_by . '</td>';
                                                                echo '<td class="text-center"> ' . $requested_at . '</td>';
                                                            } else {
                                                                echo '<td class="text-center"> No</td>';
                                                                echo '<td class="text-center"> ' . $requested_by . '</td>';
                                                                echo '<td class="text-center"> ' . $requested_at . '</td>';
                                                            }
                                                            echo '<td class="text-center">Pending</td>';
                                                            ?>

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
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "fixedHeader": true,
                "proccessing": true,
                "searching": true,
                "paging": true,
                "ordering": true,
                "bInfo": true,
                "lengthMenu": [
                    [50, 100, 500, -1],
                    [50, 100, 500, "All"]
                ],

                "fixedHeader": true,
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
                        sheetName: 'Pending Dc Report<?php echo $date[0] . " To " .  $date[1]; ?>',
                        exportOptions: {
                            columns: ':visible'
                        },

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
                        title: 'Pending Dc Report<?php echo $date[0] . " To " .  $date[1]; ?>',
                        exportOptions: {
                            columns: ':visible'
                        },

                    },
                ]
            });
        });
    </script>