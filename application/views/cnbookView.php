<?php
error_reporting(0);
$this->load->view('inc/header');
?>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('table').DataTable({
            "displayLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, "All"]
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
                    extend: 'csv',
                    titleAttr: 'Excel',
                    title: "Route Detail",
                },
                {
                    extend: 'copyHtml5',
                    footer: 'true',
                    text: "<i class='fs-14 pg-note'></i> Copy",
                    titleAttr: 'Copy'
                },
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    title: "Route Detail",

                }
            ]

        });
    });
</script>
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
                        <li class="breadcrumb-item">CnBook</li>
                        <li class="breadcrumb-item">Manage CnBook</li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="pgn-wrapper" data-position="top" style="top: 48px;" id="msg_div"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <!-- START card -->
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">Manage CnBook
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#stockin"><i class="pg-plus"></i> Stock In</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#stockout"><i class="fa fa-sign-out"></i> Stock Out</button>
                                        <div class="table-responsive m-t-10">
                                            <table style="border-top: 1px solid black;" class="table table-bordered compact nowrap dataTable no-footer" id="myTable">
                                                <thead>
                                                    <th>Sr</th>
                                                    <th>Route Code</th>
                                                    <th>Route Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="autoload">
                                                    <?php if (!empty($route_data)) {
                                                        $i = 0;
                                                        foreach ($route_data as $rows) {
                                                            $i = $i + 1;
                                                            echo ("<tr>");
                                                            echo ("<td>" . $i . "</td>");
                                                            echo ("<td>" . $rows->route_code . "</td>");
                                                            echo ("<td>" . $rows->route_name . "</td>");
                                                            if ($rows->is_enable == 1) {
                                                                echo ("<td class='bg-success text-black' ><center>Active</center></td>");
                                                                echo ("<td><button class='btn btn-danger btn-xs' onclick='update_status(0," . $rows->route_id . ")'>Deactive</button></td>");
                                                            } else if ($rows->is_enable == 0) {
                                                                echo ("<td class='bg-danger text-black' ><center>Deactive</center></td>");
                                                                echo ("<td><button class='btn btn-success btn-xs' onclick='update_status(1," . $rows->route_id . ")'>Active</button></td>");
                                                            }
                                                            echo ("</tr>");
                                                        }
                                                    }  ?>
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
            <!-- The Modal -->
            <div class="modal" id="stockin">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">CN Book Stock In</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p id="msg_show">Stock In</p>
                            <div class="form-group-attached" style="border-color: black">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required" aria-required="true" id="route_code_div">
                                            <label>Series To</label>
                                            <input type="number" class="form-control" placeholder="Enter Series To" name="seriesto" id="seriesto" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required" aria-required="true" id="route_code_div">
                                            <label>Series From</label>
                                            <input type="number" class="form-control" placeholder="Enter Series From" name="seriesfrom" id="seriesfrom" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-default required" id="route_name_div">
                                    <label>Date Time</label>
                                    <input type="datetime-local" class="form-control" name="datetime" id="datetime" tabindex="2">
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="add_route()">Create Route</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal" id="stockout">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">CN Book Stock Out</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p id="msg_show">Stock In</p>
                            <div class="form-group-attached" style="border-color: black">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required" aria-required="true" id="route_code_div">
                                            <label>Series To</label>
                                            <input type="number" class="form-control" placeholder="Enter Series To" name="seriesto" id="seriesto" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required" aria-required="true" id="route_code_div">
                                            <label>Series From</label>
                                            <input type="number" class="form-control" placeholder="Enter Series From" name="seriesfrom" id="seriesfrom" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-default required" id="route_name_div">
                                <label>Select Rider</label>
                                                    <select class="form-control" id="o_city" name="country" tabindex=4>
                                                        <option value='0' selected>Select Rider</option>
                                                        <?php foreach ($country_data as $country) { ?>
                                                            <option value=<?php echo $country->country_id; ?> <?php echo set_select('country', $country->country_id); ?>><?php echo $country->country_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                </div>
                                <div class="form-group form-group-default required" id="route_name_div">
                                <label>Select Route</label>
                                                    <select class="form-control" id="o_city" name="country" tabindex=4>
                                                        <option value='0' selected>Select Route</option>
                                                        <?php foreach ($country_data as $country) { ?>
                                                            <option value=<?php echo $country->country_id; ?> <?php echo set_select('country', $country->country_id); ?>><?php echo $country->country_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                </div>
                                <div class="form-group form-group-default required" id="route_name_div">
                                    <label>Date Time</label>
                                    <input type="datetime-local" class="form-control" name="datetime" id="datetime" tabindex="2">
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="add_route()">Create Route</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                function add_route() {
                    var check = "Pass";
                    var name = "";
                    var code = "";
                    //------------Route Name
                    if ($("#route_name").val() != "") {
                        name = $("#route_name").val();
                        $("#route_name_div").css("border-color", "rgba(0, 0, 0, 0.07)");
                    } else {
                        $("#route_name_div").css("border-color", "red");
                        $("#route_name").focus();
                        check = "Fail";
                    }
                    //--------------------------------End
                    //------------Route Code-----------
                    if ($("#route_code").val() != "") {
                        code = $("#route_code").val();
                        $("#route_code_div").css("border-color", "rgba(0, 0, 0, 0.07)");
                    } else {
                        $("#route_code_div").css("border-color", "red");
                        $("#route_code").focus();
                        check = "Fail";
                    }
                    //--------------------------------End    
                    //-------Checking Conditions---------
                    if (check != "Fail") {
                        var mydata = {
                            name: name,
                            code: code
                        };
                        $.ajax({
                            url: "<?php echo base_url(); ?>Route/add_route",
                            type: "POST",
                            data: mydata,
                            success: function(data) {
                                if (data == 1) {
                                    $("#msg_show").html("<p class='alert alert-danger'>Something Went Wrong Please Try Again.</p>");
                                } else if (data == 0) {
                                    $("#msg_show").html("<p class='alert alert-success'>Route successfully add in Data Base.</p>");
                                } else if (data == 2) {
                                    $("#msg_show").html("<p class='alert alert-danger'>Duplicate Route Try with Different Route.</p>");
                                }
                                $.ajax({
                                    url: "<?php echo base_url(); ?>Route/redraw_table",
                                    type: "POST",
                                    data: mydata,
                                    success: function(data) {
                                        $("#autoload").html(data);
                                    }
                                });
                            }
                        });
                        $("#route_name").val("");
                        $("#route_code").val("");
                    }
                }

                function update_status(status, id) {
                    var mydata = {
                        status: status
                    };
                    $.ajax({
                        url: "<?php echo base_url(); ?>Route/update_status/" + status + "/" + id,
                        type: "POST",
                        data: mydata,
                        success: function(data) {
                            $('#autoload').html(data);
                        }
                    });
                }
            </script>
        </div>
    </div>
    <?php
    $this->load->view('inc/footer');
    ?>