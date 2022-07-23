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

    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
</style>
<style>
    .lds-ring {
        display: inline-block;
        position: relative;
        width: 9px;
        height: 14px;
        top: -2px;
        right: 11px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 25px;
        height: 25px;
        margin: 3px;
        border: 5px solid #fff;
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
                        <li class="breadcrumb-item">CS Progress </li>
                        <li class="breadcrumb-item">CS Progress Detail</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d H:i:s'); ?></mark></li>
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
                                                <form method="POST">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" required="" value="<?php echo date('Y-m-d', strtotime('-23 days')) ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default required">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" required="" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <button id="date_range" class='btn btn-primary' onclick="load_data()" style="height:100%">GO</button>
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
                                                        <th> order code </th>
                                                        <th> manual cn </th>
                                                        <th> order location </th>
                                                        <th> user name </th>
                                                        <th> arrival date </th>
                                                        <th> evevnt date </th>
                                                        <th> order event </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
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
    <script>
        $("form").on("submit", function(event) {
            event.preventDefault();
        });
        var data_arr = [];

        function load_data() {
            data_arr = [];
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var mydata = {
                start_date: start_date,
                end_date: end_date,
            };
            $.ajax({
                url: "cs_progress_detail_data",
                type: "POST",
                data: mydata,
                beforeSend: function() {
                    $("#date_range").css("cursor", "not-allowed").html('<div class="lds-ring"><div></div><div></div><div></div><div>')
                    $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>Please Wait ..</div></div>");
                    $('tbody').html("<tr><td colspan='14'><img src='<?php echo base_url(); ?>assets/ajax-loader.gif'  width='130px'></td></tr>");
                },
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.length == 0) {
                        $('tbody').html("");
                        $('#date_range').css("cursor", "pointer").html("GO");
                        $("#msg_div").html("<div class='pgn push-on-sidebar-open pgn-bar'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>No Records Found.</div></div>");
                    } else {
                        $('tbody').html("");
                        $('#date_range').css("cursor", "pointer").html("GO");
                        $("#msg_div").html("");
                        for (var count = 0; count < obj.length; count++) {
                            var sub_array = {
                                'sr': (count + 1),
                                'order_code': obj[count].order_code,
                                'manual_cn': obj[count].manual_cn,
                                'order_location_name': obj[count].order_location_name,
                                'oper_user_name': obj[count].oper_user_name,
                                'arrival_date': obj[count].arrival_date,
                                'event_date': obj[count].event_date,
                                'order_event': obj[count].order_event
                            };
                            data_arr.push(sub_array);
                        }
                        data_array(data_arr);
                    }
                }

            });
            //--------------------------------End
        }
        //);			

        function data_array(get_array) {
            $('#emp_table').DataTable().destroy();
            var groupColumn = 1;
            table = $('#emp_table').DataTable({
                data: data_arr,
                order: [],
                columns: [{
                        data: "sr"
                    },
                    {
                        data: "order_code"
                    },
                    {
                        data: "manual_cn"
                    },
                    {
                        data: "order_location_name"
                    },
                    {
                        data: "oper_user_name"
                    },
                    {
                        data: "arrival_date"
                    },
                    {
                        data: "event_date"
                    },
                    {
                        data: "order_event"
                    }
                ],
                "lengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                columnDefs: [{
                    visible: true,
                    targets: groupColumn
                }],
                order: [
                    [groupColumn, 'asc']
                ],
                displayLength: 25,
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api
                        .column(groupColumn, {
                            page: 'current'
                        })
                        .data()
                        .each(function(group, i) {
                            if (last !== group) {
                                $(rows)
                                    .eq(i)
                                    .before('<tr class="group"><th colspan="8">' + group + '</th></tr>');

                                last = group;
                            }
                        });
                },
            });
            $('#emp_table tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            load_data()
        });
    </script>