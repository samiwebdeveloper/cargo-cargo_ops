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
                        <li class="breadcrumb-item">CS Progress Summmary</li>
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
                                                <form method="POST" action="cs_progress_summary">
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
                                                        <th> oper_user_name </th>
                                                        <th> arrival_date </th>
                                                        <th> evevnt_date </th>
                                                        <th> order_event </th>
                                                        <th> total_code </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 1;
                                                    foreach ($pending as $rows) { ?>
                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $rows['oper_user_name'] ?></td>
                                                            <td><?php echo $rows['arrival_date'] ?></td>
                                                            <td><?php echo $rows['arrival_date'] ?></td>
                                                            <td><?php echo $rows['order_event'] ?></td>
                                                            <td><?php echo $rows['total_code'] ?></td>
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
        // http://stackoverflow.com/a/35657438/386557

        $(document).ready(function() {
            var table = $('#emp_table').DataTable({
                "columnDefs": [{
                    "visible": true,
                    "targets": 1
                }],
                "order": [
                    [1, 'asc']
                ],
                "lengthMenu": [
                    [20, 50, 100, -1],
                    [20, 50, 100, "All"]
                ],
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'all'
                    }).nodes();
                    var last = null;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    total = [];
                    api.column(1, {
                        page: 'all'
                    }).data().each(function(group, i) {
                        group_assoc = group.replace(' ', "_");
                        console.log(group_assoc);
                        if (typeof total[group_assoc] != 'undefined') {
                            total[group_assoc] = total[group_assoc] + intVal(api.column(5).data()[i]);
                        } else {
                            total[group_assoc] = intVal(api.column(5).data()[i]);
                        }
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><th colspan="5">' + group + '</th><th class="' + group_assoc + '"></th></tr>'
                            );

                            last = group;
                        }
                    });
                    for (var key in total) {
                        $("." + key).html(total[key]);
                    }
                }
            });


        });
    </script>


    <script>
        $("#date_range").click(function() {
            $("#date_range").css("cursor", "not-allowed").html('<div class="lds-ring"><div></div><div></div><div></div><div>')

        })
    </script>