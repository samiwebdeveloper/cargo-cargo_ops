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
                        <div class="card ">
                        </div>
                        <div class="row mb-1 mt-0">
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
                                            <table class="table table-bordered compact nowrap dataTable no-footer" width="99%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Customer Name</th>
                                                        <?php
                                                        foreach ($month as $value) {
                                                            echo "<th>" . $value['Month'] . "</th>";
                                                        } ?>
                                                    </tr>
                                                    <?php
                                                    $data_value = array();
                                                    $soft_copy_grand_sum = 0;
                                                    $hard_copy_grand_sum = 0;
                                                    $i = 0;
                                                    foreach ($summary as $month_value) {
                                                        $data_value[$i]['customer'] = $month_value['customer_name'];
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
                                                        echo "  <td>" . $rows['customer'] . " </td>";
                                                        foreach ($month as $value) {
                                                            if (strlen($rows[$value['Month']])) {
                                                                echo "<td>" . $rows[$value['Month']] . "</td>";
                                                            } else {
                                                                echo "<td>0</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                    }

                                                    ?>

                                                </tbody>

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
                                            <table class="table table-bordered compact nowrap dataTable no-footer" width="99%">
                                                <thead>

                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Customer Name</th>
                                                        <?php
                                                        foreach ($hmonth as $hvalue) {
                                                            echo "<th>" . $hvalue['Month'] . "</th>";
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                    $hdata_value = array();
                                                    $i = 0;
                                                    foreach ($hsummary as $month_value) {
                                                        $hdata_value[$i]['customer'] = $month_value['customer_name'];
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
                                                        echo "  <td>" . $rows['customer'] . " </td>";
                                                        foreach ($hmonth as $value) {
                                                            if (strlen($rows[$value['Month']])) {
                                                                echo "<td>" . $rows[$value['Month']] . "</td>";
                                                            } else {
                                                                echo "<td>0</td>";
                                                            }
                                                        }
                                                        echo "</tr>";
                                                    }

                                                    ?>
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
                ],

            });

        });
    </script>
    <script>
        $('#span_soft_total').after("<h5> Total Pending Soft Copy:<?php echo $soft_copy_grand_sum; ?><h5>");
        $('#hardcopy').after("<h5> Total Pending Hard Copy:<?php echo $hard_copy_grand_sum; ?><h5>");
    </script>
    <script>
        window.onload = function() {
            window.setTimeout(function() {
                $('.alert').css('display', 'none');
            }, 3000);
        }
    </script>