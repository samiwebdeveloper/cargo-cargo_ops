<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<style>
    .alert .close {
        top: -14.5px;
    }
    tr.group,
tr.group:hover {
    background-color: #ddd !important;
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
                        <li class="breadcrumb-item">Administraion</li>
                        <li class="breadcrumb-item">Add City</li>
                        <li class="breadcrumb-item">City</li>
                        <li class="breadcrumb-item"><mark><?php echo date('Y-m-d h:i:a'); ?></mark></li>
                    </ol>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="pgn-wrapper" data-position="top" style="top: 48px;" id="msg_div"></div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <!-- START card -->
                    <!-- <?php echo $this->db->last_query(); ?> -->
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">Add City</div>
                                    </div>
                                    <div class="card-body">
                                        <!-- <?php echo  validation_errors();     ?> -->
                                        <?php echo  $this->session->flashdata('msg'); ?>
                                        <form role="form" method="post" action="<?= base_url() ?>AddCity/savedata">
                                            <!-- <div class="row clearfix"> -->
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Name</label>
                                                    <input type="text" placeholder="City Name" class="form-control" name="city_name" value="<?php echo set_value('city_name'); ?>" tabindex=1 required>
                                                    <span style="color: red;"><?php echo form_error('city_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Full Name</label>
                                                    <input type="text" placeholder="City Full Name" class="form-control" name="city_full_name" value="<?php echo set_value('city_full_name'); ?>" tabindex=1 required>
                                                    <span style="color: red;"><?php echo form_error('city_full_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Short Code</label>
                                                    <input type="text" placeholder="City Short Code" class="form-control" name="city_short_code" value="<?php echo set_value('city_short_code'); ?>" tabindex=1 required>
                                                    <span style="color: red;"><?php echo form_error('city_short_code'); ?></span>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Code</label>
                                                    <input type="number" placeholder="City Code" class="form-control" name="city_code" value="<?php echo set_value('city_code'); ?>" tabindex=1 required>
                                                    <span style="color: red;"><?php echo form_error('city_code'); ?></span>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default " ria-="true" id="o_city_div">
                                                    <label>Select Country</label>
                                                    <select class="form-control" id="o_city" name="country" tabindex=4>
                                                        <option value='0' selected>Select Country</option>
                                                        <?php foreach ($country_data as $country) { ?>
                                                            <option value=<?php echo $country->country_id; ?> <?php echo set_select('country', $country->country_id); ?>><?php echo $country->country_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Zone</label>
                                                    <input type="text" placeholder="City Zone" class="form-control" name="city_zone" value="<?php echo set_value('city_zone'); ?>" tabindex=1 required>
                                                    <span style="color: red;"><?php echo form_error('city_zone'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Ex Punjab</label>
                                                    <input type="text" placeholder="Ex Punjab" class="form-control" name="ex_punjab" value="<?php echo set_value('ex_punjab'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Ex Kpk</label>
                                                    <input type="text" placeholder="Ex Kpk" class="form-control" name="ex_kpk" value="<?php echo set_value('ex_kpk'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Ex Sindh</label>
                                                    <input type="text" placeholder="Ex Sindh" class="form-control" name="ex_sindh" value="<?php echo set_value('ex_sindh'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Mixture</label>
                                                    <input type="text" placeholder="Mixture" class="form-control" name="mixture" value="<?php echo set_value('mixture'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Region</label>
                                                    <input type="text" placeholder="City Region" class="form-control" name="city_region" value="<?php echo set_value('city_region'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>City Type</label>
                                                    <input type="text" placeholder="City Type" class="form-control" name="city_type" value="<?php echo set_value('city_type'); ?>" tabindex=1 required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default " ria-required="true" id="o_city_div">
                                                    <label>Select Reporting City</label>
                                                    <select class="form-control"  id="reporting_city_id" name="reporting_city_id" value="<?php echo set_value('oper_user_city_id'); ?>" tabindex=4>
                                                        <option value="" selected>Choose City</option>
                                                        <?php foreach ($Reposrting_city as $city) { ?>
                                                            <option value=<?php echo $city->city_id; ?> <?php echo set_select('reporting_city_id', $city->city_id); ?>><?php echo $city->city_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                          
                                            <style>
                                                .form-group-default textarea.form-control {
                                                    padding: 25px 5px;
                                                }
                                            </style>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Remark</label>
                                                    <textarea name="remark" rows="10" class="form-control "> <?php echo set_value('remark'); ?></textarea>
                                                </div>
                                            </div>
                                            <div>
                                                <input type="submit" id="save" name="save" class='btn btn-primary pull-right' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">City List</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class='table table-bordered compact nowrap' id="myTable">
                                                <thead class="text-text-capitalize">
                                                    <tr>
                                                        <th> Sr# </th>
                                                        <th> city_name </th>
                                                        <th> city_sort_code </th>
                                                        <th> city_code </th>
                                                        <th> city_zone </th>
                                                        <th> ex_punjab </th>
                                                        <th> ex_kpk </th>
                                                        <th> ex_sindh </th>
                                                        <th> mixture </th>
                                                        <th> city_region </th>
                                                        <th> city_type </th>
                                                        <th> reporitng city </th>
                                                        <th> tm_network </th>
                                                        <th> tm_remark </th>
                                                        <th> created_by </th>
                                                        <th> country</th>
                                                        <th> Status</th>
                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultTable">
                                                    <?php
                                                    $i = 0;
                                                    $locs = array_column($country_data, 'country_name', 'country_id');
                                                    $city_da = array_column($Reposrting_city, 'city_name', 'city_id');
                                                    foreach ($city_data as $rows) {
                                                       
                                                        $i = $i + 1;
                                                        $userid = $rows->city_id;
                                                        echo ("<tr>");
                                                        echo ("<td>" . $i . "</td>");
                                                        echo ("<td>" . $rows->city_name . "</td>");
                                                        echo ("<td>" . $rows->city_short_code . "</td>");
                                                        echo ("<td>" . $rows->city_code . "</td>");
                                                        echo ("<td>" . $rows->city_zone . "</td>");
                                                        echo ("<td>" . $rows->ex_punjab . "</td>");
                                                        echo ("<td>" . $rows->ex_kpk . "</td>");
                                                        echo ("<td>" . $rows->ex_sindh . "</td>");
                                                        echo ("<td>" . $rows->mixture . "</td>");
                                                        echo ("<td>" . $rows->city_region . "</td>");
                                                        echo ("<td>" . $rows->city_type . "</td>");
                                                        echo ("<td>" . $city_da[$rows->reporting_city] . "</td>");
                                                        echo ("<td>" . $rows->tm_network . "</td>");
                                                        echo ("<td>" . $rows->tm_remark . "</td>");
                                                        echo ("<td>" . $rows->created_by . "</td>");
                                                        echo ("<td>" . $locs[$rows->country_id] . "</td>");
                                                        if ($rows->is_enable) { ?>
                                                            <td class="bg-success text-white"><a style="text-decoration: none; font-weight: bold;">Enable</a></td>
                                                        <?php } else { ?>
                                                            <td class="bg-danger text-white"><a style="text-decoration: none; font-weight: bold;">Disable</a></td>
                                                        <?php }

                                                        if ($rows->is_enable) { ?>
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #dc3545;color: white; border-radius: 3px;border: 2px solid #dc3545;padding: 1px 9px;" href="AddCity/status/0/<?= $userid; ?>">Disable</a></td>
                                                        <?php } else { ?>
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #28a745;color: white;border-radius: 3px;border: 2px solid #28a745;padding: 1px 11px;" href="AddCity/status/1/<?= $userid ?>">Enable</a></td>
                                                    <?php }
                                                        echo ("</tr>");
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
            <!-- END PAGE CONTENT -->
        </div>
    </div>
    <?php
    $this->load->view('inc/footer');
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#city_status').select2();
            $('#o_city').select2();
            $('#rider_id').select2();
            $('#status').select2();
            $('#reporting_city_id').select2();

        });
    </script>
    <script type="text/javascript">
     $(document).ready(function () {
    var groupColumn = 11;
    var table = $('#myTable').DataTable({
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
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, 'desc']],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;
 
            api
                .column(groupColumn, { page: 'current' })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before('<tr class="group"><th colspan="17"> ' + group + ' [Reporting City]</th></tr>');
 
                        last = group;
                    }
                });
        },
    });
 
    // Order by the grouping
    $('#example tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        } else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
});
    </script>