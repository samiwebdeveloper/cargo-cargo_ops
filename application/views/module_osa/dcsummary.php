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

    table.dataTable {
        border-collapse: collapse;
    }

    tfoot tr {
        border-bottom: 1.1px solid black !important;
    }

    .row_sum,
    .row_sum_soft,
    .row_sum_hard {
        font-size: 16px !important;
        font-weight: 500;
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
                <div id="get_massage"></div>
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="card ">
                        </div>
                        <div class="row mb-1 mt-0">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-header  separator">
                                        <div class="card-title">Total DC's <span id="total_dc"> </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table display_2 table-bordered compact nowrap dataTable no-footer" width="99%" id="total_dc_row">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Customer Name</th>
                                                        <th class="text-center">Total DC</th>
                                                        <?php
                                                        foreach ($month as $value) {
                                                            echo "<th class='text-center'>" . $value['Month'] . "</th>";
                                                        } ?>
                                                    </tr>
                                                    <?php
                                                    $data_value = array();
                                                    $total_summary = 0;
                                                    $i = 0;
                                                    foreach ($dc_summary_soft_copy_summary as $month_value) {
                                                        $data_value[$i]['customer'] = $month_value['customer_name'];
                                                        $data_value[$i]['customer_id'] = $month_value['customer_id'];
                                                        foreach (explode(",",  $month_value['data']) as $value_sep) {
                                                            $val = explode("|", $value_sep);
                                                            $total_summary = $total_summary + $val[1];
                                                            $data_value[$i][$val[0]] = $val[1];
                                                        }
                                                        $i++;
                                                    }

                                                    ?>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($data_value as  $rows) {
                                                        $i = $i + 1;
                                                        echo "  <td>" . $i . " </td>";
                                                        echo "  <td ><input class='get_customer' type='text' hidden value='" . $rows['customer_id'] . "'>" . $rows['customer'] . " </td>";
                                                        echo "<td class='row_sum text-center'></td>";

                                                        foreach ($month as $value) {
                                                            if (strlen($rows[$value['Month']])) {
                                                                echo "<td class='get_id text-center ' style='cursor: pointer;' data-toggle='tooltip' data-placement='top' title='Click And View Details.'>" . $rows[$value['Month']] . "</td>";
                                                            } else {
                                                                echo "<td  class='text-center ' >0</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                    }

                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-center ">Total</th>
                                                        <th class=" total_dc_row text-center"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-header  separator">
                                        <div class="card-title">Soft Copy Pending DC's <span id="span_soft_total"> </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table display_3 table-bordered compact nowrap dataTable no-footer" width="99%" id="soft_check">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Customer Name</th>
                                                        <th class='text-center'>Total DC</th>

                                                        <?php
                                                        foreach ($month as $value) {
                                                            echo "<th class='text-center'>" . $value['Month'] . "</th>";
                                                        } ?>
                                                    </tr>
                                                    <?php
                                                    $data_value = array();
                                                    $soft_copy_grand_sum = 0;
                                                    $hard_copy_grand_sum = 0;
                                                    $i = 0;
                                                    foreach ($summary as $month_value) {
                                                        $data_value[$i]['customer'] = $month_value['customer_name'];
                                                        $data_value[$i]['customer_id'] = $month_value['customer_id'];

                                                        foreach (explode(",",  $month_value['data']) as $value_sep) {
                                                            $val = explode("|", $value_sep);
                                                            $soft_copy_grand_sum = $soft_copy_grand_sum + $val[1];
                                                            $data_value[$i][$val[0]] = $val[1];
                                                        }
                                                        $i++;
                                                    }
                                                    ?>
                                                </thead>
                                                <tbody id="pendingtable">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($data_value as  $rows) {
                                                        $i = $i + 1;
                                                        echo "  <tr> <td>" . $i . " </td>";
                                                        echo "  <td><input class='get_customer' type='text' hidden value='" . $rows['customer_id'] . "'>" . $rows['customer'] . " </td>";
                                                        echo "<td class='row_sum_soft text-center'></td>";

                                                        foreach ($month as $value) {
                                                            if (strlen($rows[$value['Month']])) {
                                                                echo "<td  class='get_id text-center' style='cursor: pointer;' data-toggle='tooltip' data-placement='top' title='Click And View Details.'>" . $rows[$value['Month']] . "</td>";
                                                            } else {
                                                                echo "<td class='text-center'>0</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                    }

                                                    ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-center ">Total</th>
                                                        <th class=" soft_add_th text-center"></th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-header  separator">
                                        <div class="card-title">Hard Copy Pending DC's <span id="hardcopy"></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <div><?php echo $errors[0] ?><?php echo $errors[1] ?></div>
                                            <div id="msg_div"></div>
                                            <table class="table display_1 table-bordered compact nowrap dataTable no-footer" width="99%" id="hard_check">
                                                <thead>

                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Customer Name</th>
                                                        <th class='text-center'>Total DC</th>

                                                        <?php
                                                        foreach ($hmonth as $hvalue) {
                                                            echo "<th class='text-center'>" . $hvalue['Month'] . "</th>";
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                    $hdata_value = array();
                                                    $i = 0;

                                                    foreach ($hsummary as $month_value) {
                                                        $hdata_value[$i]['customer'] = $month_value['customer_name'];
                                                        $hdata_value[$i]['customer_id'] = $month_value['customer_id'];

                                                        foreach (explode(",",  $month_value['data']) as $value_sep) {
                                                            $val = explode("|", $value_sep);
                                                            $hard_copy_grand_sum = $hard_copy_grand_sum + $val[1];
                                                            $hdata_value[$i][$val[0]] = $val[1];
                                                        }
                                                        $i++;
                                                    }

                                                    ?>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($hdata_value as  $rows) {
                                                        $i = $i + 1;
                                                        echo "  <tr> <td>" . $i . " </td>";
                                                        echo "  <td><input class='get_customer' type='text' hidden value='" . $rows['customer_id'] . "'>" . $rows['customer'] . " </td>";
                                                        echo "<td class='row_sum_hard text-center'></td>";

                                                        foreach ($hmonth as $value) {
                                                            if (strlen($rows[$value['Month']])) {
                                                                echo "<td  class='get_id text-center' style='cursor: pointer;' data-toggle='tooltip' data-placement='top' title='Click And View Details.'> " . $rows[$value['Month']] . "</td>";
                                                            } else {
                                                                echo "<td class='text-center'>0</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                    }

                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-center ">Total</th>
                                                        <th class=" hard_add_th text-center"></th>

                                                    </tr>
                                                </tfoot>
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
        $(".display_2 .get_id").click(function() {
            var row = $(this).closest("tr");
            var get_customer = row.find(".get_customer").val();
            var table_name = "completed"
            var get_month = $('tr:first th').eq($(this).index()).text()

            mydata = {
                get_customer: get_customer,
                table_name: table_name,
                get_month: get_month,
            };
            $.ajax({
                url: "get_all_record",
                method: "GET",
                data: mydata,
                success: function(data) {
                    window.open(data, '_blank');
                }
            })
        })
        $(".display_1 .get_id").click(function() {
            var row = $(this).closest("tr");
            var get_customer = row.find(".get_customer").val();
            var table_name = "hard_copy_pending"
            var get_month = $('tr:first th').eq($(this).index()).text()

            mydata = {
                get_customer: get_customer,
                table_name: table_name,
                get_month: get_month,
            };
            $.ajax({
                url: "get_all_record",
                method: "GET",
                data: mydata,
                success: function(data) {
                    window.open(data, '_blank');
                }
            })
        })
        $(".display_3 .get_id").click(function() {
            var row = $(this).closest("tr");
            var get_customer = row.find(".get_customer").val();
            var table_name = "soft_copy_pending"
            var get_month = $('tr:first th').eq($(this).index()).text()

            mydata = {
                get_customer: get_customer,
                table_name: table_name,
                get_month: get_month,
            };
            $.ajax({
                url: "get_all_record",
                method: "GET",
                data: mydata,
                success: function(data) {
                    window.open(data, '_blank');
                }
            })
        })
        $(document).ready(function() {

            var total_dc_row = document.getElementById('total_dc_row').rows[0].cells.length
            for (let index = 3; index < total_dc_row; index++) {
                $(".total_dc_row").after('<th class="text-center"></th>')
            }

            var soft_column_no = document.getElementById('soft_check').rows[0].cells.length
            for (let index = 3; index < soft_column_no; index++) {
                $(".soft_add_th").after('<th class="text-center"></th>')
            }

            var hard_column_no = document.getElementById('hard_check').rows[0].cells.length
            for (let index = 3; index < hard_column_no; index++) {
                $(".hard_add_th").after('<th class="text-center"></th>')
            }

            var table_3 = $('table.display_3').DataTable({

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
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };


                    for (let index = 3; index < soft_column_no; index++) {
                        $(api.column(index).footer()).html(api.column(index).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0));
                    }


                },
            });
            $('.display_3 tr').each(function() {
                var sum = 0
                $(this).find('.get_id').each(function() {
                    var get_id = $(this).text();
                    sum = sum + parseInt(get_id)
                });
                $('.row_sum_soft', this).html(sum);
            });
            var table_2 = $('table.display_2').DataTable({

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
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };


                    for (let index = 3; index < total_dc_row; index++) {
                        $(api.column(index).footer()).html(api.column(index).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0));
                    }


                },
            });

            $('.display_2 tr').each(function() {
                var sum = 0
                $(this).find('.get_id').each(function() {
                    var get_id = $(this).text();
                    sum = sum + parseInt(get_id)
                });
                $('.row_sum', this).html(sum);
            });

            var table_1 = $('table.display_1').DataTable({

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
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };
                    for (let index = 3; index < soft_column_no; index++) {
                        $(api.column(index).footer()).html(api.column(index).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0));
                    }
                },
            });

            $('.display_1 tr').each(function() {
                var sum = 0
                $(this).find('.get_id').each(function() {
                    var get_id = $(this).text();
                    sum = sum + parseInt(get_id)
                });
                $('.row_sum_hard', this).html(sum);
            });
        });
    </script>
    <script>
        $('#total_dc').after("<h5> Total DC:<?php echo $total_summary; ?><h5>");
        $('.total_dc_row').html("<?php echo $total_summary; ?>");
        $('.soft_add_th').html("<?php echo $soft_copy_grand_sum; ?>");
        $('.hard_add_th').html("<?php echo $hard_copy_grand_sum; ?>");
        $('#span_soft_total').after("<h5> Total Pending Soft Copy:<?php echo $soft_copy_grand_sum; ?><h5>");
        $('#hardcopy').after("<h5> Total Pending Hard Copy:<?php echo $hard_copy_grand_sum; ?><h5>");
    </script>