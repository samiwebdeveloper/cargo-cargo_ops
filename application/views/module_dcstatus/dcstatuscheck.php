<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <style>
        .alert {
            margin: 4px 5px;
            padding: 4px 5px 3px 12px;
        }

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
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Tools</li>
                        <li class="breadcrumb-item">DC Upload</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d H:i:s'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>

        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="col-md-12" style="margin-right:70px !important;">
                <div id="errors" class="row col-md-12 d-flex justify-content-center">
                    <?php foreach ($errors as $error) {
                        echo $error;
                    } ?>
                </div>
                <div class="card m-t-10">
                    <div id="msg_div"></div>
                    <div class="table-responsive m-t-10" style="padding:10px 30px ;">
                        <table class="table table-bordered compact nowrap dataTable no-footer" style="margin-top: 10px; border-top: 1px solid gray;" width="100%" id="emp_table">
                            <thead>
                                <tr>
                                    <th width=10px> Sr#</th>
                                    <th> Arrival Date</th>
                                    <th> Customer</th>
                                    <th> Order Code</th>
                                    <th> Manual Cn</th>
                                    <th> Unit Detail</th>
                                    <th> Order Status</th>
                                    <th> Destination City</th>
                                    <th> DC No</th>
                                    <th style="display:none ;">Order Id</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                foreach ($record as $rows) {
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
                                    $order_arrival_date = $rows['order_arrival_date'];
                                    $Units_Detail = $rows['Units_Detail'];
                                ?>
                                    <tr>
                                        <td class="text-center"> <?php echo  $i; ?></td>
                                        <td> <?php echo date("d-M-Y", strtotime($order_arrival_date)) ?></td>
                                        <td> <?php echo $customer ?></td>
                                        <td> <?php echo $order_id ?></td>
                                        <td> <?php echo $manual_cn ?></td>
                                        <td> <?php echo $Units_Detail ?></td>
                                        <td> <?php echo $order_status ?></td>
                                        <td> <?php echo $destination_city_name ?></td>
                                        <td> <?php echo   $dcNO ?></td>
                                        <td hidden> <input type="number" hidden class="row_id" value="<?php echo $id ?>"></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('inc/footer');
?>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('table').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Blfrtip',
            buttons: ['colvis']
        });
    });
</script>
<script>
    window.onload = function() {
        window.setTimeout(function() {
            $('.alert').css('display', 'none');
        }, 15000);
    }
</script>