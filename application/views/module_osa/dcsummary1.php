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
                        <li class="breadcrumb-item">Dc Status</li>
                        <li class="breadcrumb-item">Dc Summary</li>
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
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table table-bordered compact nowrap dataTable no-footer" width="99%">
                                                <thead id="getht">
                                                    <tr>
                                                        <th colspan="5" class="text-center" style="font-size:20px ;font-weight:600;color:black ;">Soft Copy Pending DC's </th>
                                                    </tr>
                                                    <tr id="gettext">
                                                        <th width=10px> Sr#</th>
                                                        <th> Customer Name</th>
                                                        <?php
                                                        $customer = array();
                                                        $month = array();
                                                        $date_value = array();
                                                        $data_sep = array();
                                                        $month_sep = array();

                                                        foreach ($summary as $get_month) {
                                                            if ($get_month['data'] != null) {
                                                                array_push($month, $get_month['data']);
                                                                array_push($customer, $get_month['customer_name']);
                                                            }
                                                        }
                                                        foreach ($month as $month_value) {
                                                            foreach (explode("|", $month_value) as $value) {
                                                                array_push($date_value, $value);
                                                            }
                                                        }

                                                        $counter = 1;
                                                        foreach ($date_value as $key => $value) {
                                                            if ($counter % 2 == 0) {
                                                                array_push($data_sep, $value);
                                                            } else {
                                                                array_push($month_sep, $value);
                                                            }
                                                            $counter++;
                                                        }
                                                        $date_unique = array_unique($month_sep);
                                                        foreach ($date_unique as $value) {
                                                            echo "<th>" . $value . "</th>";
                                                        }
                                                        ?>

                                                    </tr>
                                                </thead>

                                                <tbody id="pendingtable">
                                                </tbody>
                                            </table>
                                            <script>
                                               var column=[];
                                               var customer = [];
                                                var total = [];
                                                $('#gettext th').each(function() {
                                                    var cellText = $(this).html();
                                                    var cellindex = $(this).index();
                                                  
                                                        if (cellindex > 1) {
                                                            column.push(cellText);
                                                        } 

                                                
                                                var data_json = <?php echo json_encode($customer_data) ?>;
                                                for (var count = 0; count < data_json.length; count++) {
                                                   
                                                    if (cellText==data_json[count].Month) {
                                                        console.log('yes');
                                                    // customer.push(data_json[count].customer_name);
                                                    // total.push(data_json[count].Month);
                                                    // total.push(data_json[count].total);
                                                    // $('#pendingtable ').
                                                    // append("<tr><td>" +
                                                    //     (count + 1) + "</td><td>" +
                                                    //     data_json[count].customer_name + "</td><td>" +
                                                    //     data_json[count].total + "</td><td>" +
                                                    //     data_json[count].Month + "</td></tr>");
                                                    
                                                    }
                                                  

                                                }

                                                        // else {
                                                        //     $('td').eq(cellindex).html("sami");
                                                        // }

                                                    })
                                                    
                                                    // document.write(total);
                                                    // console.log(total);
                                              

                                                // console.log(data_json);
                                                // console.log(customer);
                                                // console.log(total);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table table-bordered compact nowrap dataTable no-footer" width="99%">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5" class="text-center" style="font-size:20px ;font-weight:600;color:black ;">Hard Copy Pending DC's </th>
                                                    </tr>
                                                    <tr>
                                                        <th width=10px> Sr#</th>
                                                        <th> Customer Name</th>
                                                        <th> April</th>
                                                        <th> May</th>
                                                        <th> June</th>
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

                                                            <?php
                                                            if ($request_by_check) {
                                                                echo '  <td class="text-center"> Checked</td>';
                                                            } else {
                                                                echo '  <td class="text-center"> UnChecked</td>';
                                                            }
                                                            ?>
                                                            <td class="text-center"><button disabled style="cursor:not-allowed ;" class=" btn btn-success btn-xs">Updated</button></td>

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
                buttons: [
                    // 'colvis',
                    {
                        extend: 'excelHtml5',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                        text: "<i class='fs-14 pg-form'></i> Excel",
                        titleAttr: 'Excel',
                        sheetName: 'Complete Dc <?php echo $date[0] . " To " .  $date[1]; ?>',
                        exportOptions: {
                            columns: ':visible'
                        },

                    },
                    {
                        extend: 'print',
                        text: "<i class='fs-14 pg-ui'></i> Print",
                        titleAttr: 'Print',
                        footer: 'true',
                        title: 'Complete Dc <?php echo $date[0] . " To " .  $date[1]; ?>',
                        exportOptions: {
                            columns: ':visible'
                        },

                    },
                ]
            });
        });
    </script>

    <script>
        window.onload = function() {
            window.setTimeout(function() {
                $('.alert').css('display', 'none');
            }, 3000);
        }
    </script>