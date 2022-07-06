<?php
error_reporting(0);
$this->load->view('inc/header');
$now = date("Y-m-d H:i", strtotime("now"));
$now = str_replace(" ", "T", $now);



?>
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('table.display').DataTable({

            "lengthMenu": [
                [-1, 10, 25, 50, ],
                ["All", 10, 25, 50]
            ],
            fixedHeader: true,
            "searching": true,
            "paging": true,
            "ordering": true,
            "bInfo": true,
            dom: 'Blfrtip',

            buttons: ['colvis']
        });

        // console.log(table.rows().count());
        // console.log(table.column(6).data().unique().text())
    });
</script>

<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Operations</li>
                        <li class="breadcrumb-item">Manifest</li>
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

            <div class="col-md-12">
                <div class="card m-t-10">

                    <div class="card">
                        <div class="card-body">

                            <?php
                            if (!empty($destination_data)) {
                                foreach ($destination_data as $dest) {
                                    $dest = $dest->dest;
                                    $transit_code = "";
                                    $staff_name = "";
                                    $staff_number = "";
                                    $date = "";
                                    if (!empty($sheet_data)) {
                                        foreach ($sheet_data as $rows) {
                                            if ($rows->destination == $dest) {
                                                $transit_code = $rows->transit_code;
                                                $sname = $rows->sname;
                                                $staff_name = $rows->staff_name;
                                                $vehicle_no = $rows->vehicle_no;
                                                $staff_number = $rows->staff_number;
                                                $date = $rows->tDate;
                                                $completedate = $rows->CompleteDate;
                                                $TC = $rows->TransitD;
                                            }
                                        }
                            ?>
                                        <table style="width:100%">
                                            <td style="width:20%"><img src='<?php echo base_url(); ?>assets/img/tmlogo1.png' width="100px"></td>
                                            <td style="width:60%">
                                                <center>
                                                    <h1>T.M Cargo Manifest</h1>
                                                </center>
                                            </td>
                                            <td style="width:20%;"><strong><u><?php echo $transit_code; ?> </br><?php echo $sname; ?></u></strong></td>
                                        </table>
                                        <table style="width:70%;margin-left:3px">
                                            <tr>
                                                <th style="width:40%">Transit / Hub </th>
                                                <td style="width:60%;border-bottom: 1px solid black;font-size: 25px;"> <strong><?php echo $_SESSION['origin_name'] . " - " . $TC; ?></strong></th>
                                            </tr>
                                            <tr>
                                                <th style="width:40%">Driver Detail</th>
                                                <td style="width:60%;border-bottom: 1px solid black;"><?php echo $staff_name . " / " . $staff_number; ?></th>
                                            </tr>
                                            <tr>
                                                <th style="width:40%">Vehicle Detail</th>
                                                <td style="width:60%;border-bottom: 1px solid black;"><?php echo $vehicle_no; ?></th>
                                            </tr>
                                            <tr>
                                                <th style="width:40%">Transit / Loading Date</th>
                                                <td style="width:60%;border-bottom: 1px solid black;"><?php echo date('d-M-Y g:i A (H:i)', strtotime($completedate)); ?></th>
                                            </tr>
                                        </table>
                                        <hr>
                                        <div class="form-group" id="msg_div"></div>
                                        <div class="table-responsive m-t-10">
                                            <table class="display table table-bordered wrap compact" style="margin-top: 10px; border-top: 1px solid gray;" width="100%" id="emp_table">
                                                <thead>
                                                    <tr>
                                                        <th> Sr#</th>
                                                        <th> Origin</th>
                                                        <th> ElectronNo ||CN.No</th>
                                                        <th> Shipper||Consignee</th>
                                                        <th> Pieces ||Weight</th>
                                                        <th> ToPay</th>
                                                        <th> Destination</th>
                                                        <th> Current/Status</th>
                                                        <th> Order/Status</th>
                                                        <th> Date</th>
                                                        <th> Rider</th>
                                                        <th>Order/Receiver</th>
                                                        <th style="display:none ;">Order Id</th>

                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($sheet_data)) {
                                                        $i = 0;
                                                        $tweight = 0;
                                                        $tpieces = 0;
                                                        // echo"<pre>";
                                                        // print_r($sheet_data);
                                                        foreach ($sheet_data as $rows) {

                                                            if ($rows->destination == $dest) {
                                                                $i = $i + 1;
                                                                //   echo"<br>";
                                                                $orderid = $rows->order_code;
                                                                $orderStatus = $rows->is_final;
                                                                $order_Status = $rows->order_status;
                                                                $tweight = $tweight + $rows->weight;
                                                                $tpieces = $tpieces + $rows->pieces;
                                                                echo ("<tr>");
                                                                echo ("<td class='idd'>" . $i . "</td>");
                                                                echo ("<td>" . $rows->origin_city_name . "</td>");
                                                                echo ("<td>" . $rows->transit_cn . " || " . $rows->manual_cn . "</td>");
                                                                echo ("<td>" . $rows->transit_shipper . " || " . $rows->consignee_detail . "</td>");
                                                                echo ("<td>" . $rows->pieces . " || " . $rows->weight . "</td>");
                                                                if ($rows->order_pay_mode == 'ToPay' || $rows->order_pay_mode == 'Topay') {
                                                                    echo ("<td>" . $rows->cod_amount . "</td>");
                                                                } else {
                                                                    echo ("<td>" . "0" . "</td>");
                                                                }
                                                                echo ("<td>" . $rows->ActaulD . "</td>");
                                                    ?>
                                                                <?php
                                                                if ($orderStatus) { ?>
                                                                    <?php echo ("<td>" . $order_Status . "</td>"); ?>

                                                                    <td>
                                                                        <select class="order_status form-control" disabled name="order_status" style="font-size:12px ;padding: 1px 6px;color: #444;line-height: 10px;">
                                                                            <option value="" selected disabled>Status</option>

                                                                        </select>
                                                                    </td>
                                                                    <td> <input type="datetime-local" readonly style="font-size:12px ;" class="date form-control" name="date"></td>
                                                                    <td>
                                                                        <select class="order_status form-control" disabled name="order_status" style="font-size:12px ;padding: 1px 6px;color: #444;line-height: 10px;">
                                                                            <option value="" selected disabled>Select Rider</option>

                                                                        </select>
                                                                    </td>
                                                                    <td> <input type="text" readonly class="receiver form-control" id="receiver_<?php echo $orderid ?>" style="font-size:12px ;padding: 1px 6px;color: #444;line-height: 10px;"></td>
                                                                    <td style="display:none ;"><input type="text" hidden class="order_id form-control" value="<?php echo $orderid ?>"></td>

                                                                    <?php echo ("<td ><button class='update_row btn btn-success btn-xs'style='cursor: not-allowed;' disabled >Final Status</button></td>"); ?>
                                                                <?php } else { ?>
                                                                    <?php echo ("<td class='current_status'>" . $order_Status . "</td>"); ?>

                                                                    <td>
                                                                        <select class="order_status form-control" id="order_status" name="order_status" style="font-size:12px ;padding: 1px 6px;color: #444;line-height: 10px;">
                                                                            <option value="" selected disabled>Status</option>
                                                                            <optgroup label="Delivered">
                                                                                <option value="Deliverd">Deliverd</option>
                                                                                <option value="RTS">RTS</option>
                                                                                <option value="De Manifest">De Manifest</option>
                                                                            </optgroup>
                                                                            <optgroup label="Cancelled">
                                                                                <option value="Refused">Refused</option>
                                                                                <option value="Return">Return</option>
                                                                                <option value="HIO">HIO</option>
                                                                                <option value="OSA">OSA</option>
                                                                                <option value="CNA">CNA</option>
                                                                                <option value="NSA">NSA</option>
                                                                                <option value="RTO">RTO</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </td>
                                                                    <td> <input type="datetime-local" style="font-size:12px ;" id="date_<?php echo $orderid ?>" class="date form-control" name="date"></td>
                                                                    <td>
                                                                        <select class="rider" data-init-plugin="select2" id="rider_<?php echo $orderid ?>" name="rider">
                                                                            <?php
                                                                            foreach ($rider_data as $rows) {
                                                                                if (1 == $rows->rider_id) {
                                                                                    $select = "selected";
                                                                                } else {
                                                                                    $select = "";
                                                                                }
                                                                                echo "<option {$select} value='$rows->rider_id' >" . $rows->rider_code . " - " . $rows->rider_name . "</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td> <input type="text" class="receiver form-control" id="receiver_<?php echo $orderid ?>" style="font-size:12px ;padding: 1px 6px;color: #444;line-height: 10px;"></td>
                                                                    <td style="display:none ;"><input type="text" hidden class="order_id form-control" value="<?php echo $orderid ?>"></td>
                                                                    <script>
                                                                        jQuery('.order_status').on('change', function() {
                                                                            var $row = $(this).closest("tr");
                                                                            var status = $row.find(".order_status").find(":selected").text();
                                                                            var currentdate = new Date();

                                                                            function getMonth2Digits(date) {
                                                                                const month = currentdate.getMonth() + 1;
                                                                                if (month < 10) {
                                                                                    return '0' + month;
                                                                                }
                                                                                return month;
                                                                            }

                                                                            function getDay2Digits(date) {
                                                                                const day = currentdate.getDate();
                                                                                if (day < 10) {
                                                                                    return '0' + day;
                                                                                }
                                                                                return day;
                                                                            }
                                                                            var month_2digit = getMonth2Digits(currentdate.getMonth() + 1);
                                                                            var date_2digit = getDay2Digits(currentdate.getDate());
                                                                            var datetime = currentdate.getFullYear() + "-" +
                                                                                month_2digit + "-" +
                                                                                date_2digit + "T" +
                                                                                currentdate.getHours() + ":" +
                                                                                currentdate.getMinutes();
                                                                            $row.find(".date").val(datetime);
                                                                            if (status == 'De Manifest' || status == 'RTS' || status == 'Deliverd' || status == '') {
                                                                                $row.find('#receiver_<?php echo $orderid ?>').attr('readonly', false);
                                                                                $row.find('#rider_<?php echo $orderid ?>').attr("disabled", false);
                                                                            } else {
                                                                                $row.find('#receiver_<?php echo $orderid ?>').attr('readonly', true);
                                                                                $row.find('#rider_<?php echo $orderid ?>').attr("disabled", true);
                                                                            }
                                                                        });
                                                                    </script>
                                                                    <?php echo ("<td ><button class='update_row btn btn-info btn-xs'>Update Now</button></td>"); ?>




                                                                <?php } ?>
                                                                <?php echo ("</tr>"); ?>

                                                    <?php
                                                            }
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                            <?php }
                                }
                            } ?>

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
    $(".update_row").click(function() {
        $("#msg_div").html("");

        var chk = 0;
        var ajaxurl = "";
        var mydata = {};

        var $row = $(this).closest("tr");
        var order_id = $row.find(".order_id").val();
        var date = $row.find(".date").val();
        var rider = $row.find(".rider").find(":selected").val();
        var status = $row.find(".order_status").find(":selected").text();
        var receiver = $row.find(".receiver").val();
        var update_row = $row.find(".update_row").text();

        if (status != 'Status') {
            if (status == 'De Manifest' || status == 'RTS' || status == 'Deliverd') {
                if (rider != 'Select Rider' && receiver != "" && date != "") {
                    mydata = {
                        rider: rider,
                        order_status: status,
                        cn: order_id,
                        receive_by: receiver,
                        delivery_date: date
                    };
                    ajaxurl = "<?php echo base_url(); ?>Direct/cs_direct_process";
                    chk = 1;
                } else {                    
                    $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Date, Rider or Reciver Name is missing.</div></div>");
                }
            } else {
                mydata = {
                    delivery_date: date,
                    order_status: status,
                    cn: order_id
                };
                ajaxurl = "<?php echo base_url(); ?>Direct/direct_process";
                chk = 1;
            }

        } else {
            $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Status is required.</div></div>");
        }

        if (chk == 1) {
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: mydata,
                success: function(data) {
                    $("#msg_div").html(data);
                    if ($("#msg_div p").hasClass('alert-success')) {
                        if (status == 'RTS' || status == 'Deliverd') {
                            $row.find(".date").attr("disabled", true);
                            $row.find(".rider").attr("disabled", true);
                            $row.find(".order_status").attr("disabled", true);
                            $row.find(".receiver").attr("disabled", true);
                            $row.find(".update_row")
                                .attr("disabled", true)
                                .css("cursor", "not-allowed")
                                .html("Fianl Status")
                                .addClass('btn-success')
                                .removeClass('btn-info');
                            $row.find(".current_status").html(status)

                        } else {
                            $row.find(".current_status").html(status)
                            $row.find(".receiver").attr("readonly", false);
                            $row.find(".rider").attr("disabled", false);
                        }                        
                    } 
                }, 
                error: function(data, sts, errmsg){
                    $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>"+ errmsg +"</div></div>");
                }
            });
        }
    });
</script>