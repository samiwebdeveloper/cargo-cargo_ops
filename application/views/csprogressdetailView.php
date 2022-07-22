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
                                                <form method="POST" action="cs_progress_detail">
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
                                                        <th> order_code </th>
                                                        <th> manual_cn </th>
                                                        <th> order_location_name </th>
                                                        <th> oper_user_name </th>
                                                        <th> arrival_date </th>
                                                        <th> evevnt_date </th>
                                                        <th> order_event </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 1;
                                                    foreach ($pending as $rows) { ?>
                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $rows['order_code'] ?></td>
                                                            <td><?php echo $rows['manual_cn'] ?></td>
                                                            <td><?php echo $rows['order_location_name'] ?></td>
                                                            <td><?php echo $rows['oper_user_name'] ?></td>
                                                            <td><?php echo $rows['arrival_date'] ?></td>
                                                            <td><?php echo $rows['arrival_date'] ?></td>
                                                            <td><?php echo $rows['order_event'] ?></td>
                                                        </tr>
                                                    <?php $i++;
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
            var groupColumn = 1;
            var table = $('#emp_table').DataTable({
                "displayLength": 20,
                "lengthMenu": [
                    [20, 50, 100, 200, 500, -1],
                    [20, 50, 100, 200, 500, "All"]
                ],
                dom: 'Blfrtip',
                buttons: [
                    'colvis',
                    {
                        extend: 'excelHtml5',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                        text: "<i class='fs-14 pg-form'></i> Excel",
                        titleAttr: 'Excel',
                        sheetName: 'User Report'
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

                ],
                columnDefs: [{
                    visible: false,
                    targets: groupColumn
                }],
                order: [
                    [groupColumn, 'desc']
                ],
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
                                    .before('<tr class="group"><th colspan="7"> ' + group + '</th></tr>');

                                last = group;
                            }
                        });
                },
            });

            // Order by the grouping
            $('#emp_table tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });
        });
    </script>

    <script>
        $("#date_range").click(function() {
            $("#date_range").css("cursor", "not-allowed").html('<div class="lds-ring"><div></div><div></div><div></div><div>')

        })
    </script>