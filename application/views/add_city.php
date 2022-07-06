<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<style>
    .alert .close {
        top: -14.5px;
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
                                                <div class="form-group form-group-default ">
                                                    <label>City Statsu </label>
                                                    <select class="form-control" id="status" name="city_status">" tabindex=3>
                                                        <option value="">City Statsu</option>
                                                        <option value='1' <?php echo set_select('city_status', '1', (!empty($data) && $data == "1" ? TRUE : FALSE)); ?>>Enable</option>
                                                        <option value='0' <?php echo set_select('city_status', '0', (!empty($data) && $data == "0" ? TRUE : FALSE)); ?>>Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Tm Network</label>
                                                    <select class="form-control" id="city_status" name="tm_network" tabindex=3>
                                                        <option value="" required=''>Tm Network Status</option>
                                                        <option value='1' <?php echo set_select('tm_network', '1', (!empty($data) && $data == "1" ? TRUE : FALSE)); ?>>True</option>
                                                        <option value='0' <?php echo set_select('tm_network', '0', (!empty($data) && $data == "0" ? TRUE : FALSE)); ?>>False</option>
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
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #dc3545;color: white; border-radius: 3px;border: 2px solid #dc3545;padding: 1px 9px;" href="addcity/status/0/?id=<?= $userid; ?>">Disable</a></td>
                                                        <?php } else { ?>
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #28a745;color: white;border-radius: 3px;border: 2px solid #28a745;padding: 1px 11px;" href="addcity/status/1/?id=<?= $userid ?>">Enable</a></td>
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
            $('input[type="number"]').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });

            $('input[type="date"]').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });

            $('input[type="text"]').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });


            $('input[type="email"]').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });


            $('checkbox').keydown(function(e) {
                if (e.keyCode == 13) {
                    if ($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type') == 'submit') { // check for submit button and submit form on enter press
                        return true;
                    }
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "displayLength": 25,
                "lengthMenu": [
                    [25, 50, 100, 200, 500, -1],
                    [25, 50, 100, 200, 500, "All"]
                ],
                fixedHeader: true,
                "searching": true,
                "paging": true,
                "ordering": true,
                "bInfo": true,
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

                ]
            });
        });
    </script>