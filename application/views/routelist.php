<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<style>
    .alert .close
     {
        top: -13.5px;
        left: 10px;
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
                        <li class="breadcrumb-item">Add User</li>
                        <li class="breadcrumb-item">User</li>
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
                <!-- <?php echo $this->db->last_query(); ?> -->
                <div class="col-xl-12 col-lg-12">
                    <div class=" container-fluid   container-fixed-lg bg-gray">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card m-t-10">
                                    <div class="card-header  separator">
                                        <div class="card-title">Add New User</div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo  $this->session->flashdata('msg'); ?>
                                        <form role="form" method="post" action="<?= base_url() ?>AddUser/savedata">
                                            <!-- <div class="row clearfix"> -->
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Full Name</label>
                                                    <input type="text" placeholder="Full Name" class="form-control" required id="brand_name" name="oper_user_name" value="<?php echo set_value('oper_user_name'); ?>" tabindex=1>
                                                    <span style="color: red;"><?php echo form_error('oper_user_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>User ID</label>
                                                    <input type="text" class="form-control" required placeholder="User ID" class="form-control" required id="brand_name" name="oper_account_no" value="<?php echo set_value('oper_account_no'); ?>" tabindex=1>
                                                    <span style="color: red;"><?php echo form_error('oper_account_no'); ?></span>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                            <!-- <div class="row clearfix"> -->
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Password</label>
                                                    <input type="password" placeholder="Password" class="form-control" required id="brand_name" name="oper_user_password" value="<?php echo set_value('oper_user_password'); ?>" tabindex=1>
                                                    <span style="color: red;"><?php echo form_error('oper_user_password'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default  ">
                                                    <label>Repeate Password</label>
                                                    <input type="password" class="form-control" required placeholder="Repeate Password" class="form-control" required id="brand_name" name="cpassword" value="<?php echo set_value('cpassword'); ?>" tabindex=2>
                                                    <span style="color: red;"><?php echo form_error('cpassword'); ?></span>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                            <!-- <div class="row clearfix"> -->
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Select Role</label>
                                                    <select class="form-control" required id="role" name="oper_user_power" value="<?php echo set_value('oper_user_power'); ?>" tabindex=3>
                                                        <option value=''>Select Role</option>
                                                        <option value='BM' <?php echo set_select('oper_user_power', 'BM', (!empty($data) && $data == "BM" ? TRUE : FALSE)); ?>>(BM) Branch Manager</option>
                                                        <option value='CS' <?php echo set_select('oper_user_power', 'CS', (!empty($data) && $data == "CS" ? TRUE : FALSE)); ?>>(CS) Customer Service </option>
                                                        <option value='SE' <?php echo set_select('oper_user_power', 'SE', (!empty($data) && $data == "SE" ? TRUE : FALSE)); ?>>(SE) Softwaer Engineer</option>
                                                        <option value='SM' <?php echo set_select('oper_user_power', 'SM', (!empty($data) && $data == "SM" ? TRUE : FALSE)); ?>>(SM) Softwaer Manager</option>
                                                        <option value='RIDER' <?php echo set_select('oper_user_power', 'RIDER', (!empty($data) && $data == "RIDER" ? TRUE : FALSE)); ?>>RIDER </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default " ria-required="true" id="o_city_div">
                                                    <label>Select City</label>
                                                    <select class="form-control" required id="o_city" name="oper_user_city_id" value="<?php echo set_value('oper_user_city_id'); ?>" tabindex=4>
                                                        <option value='0' selected>Select User City</option>
                                                        <?php foreach ($result as $city) { ?>
                                                            <option value=<?php echo $city['city_id']; ?> <?php echo set_select('oper_user_city_id', $city['city_id']); ?>><?php echo $city['city_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Select Statsu</label>
                                                    <select class="form-control" required id="status" name="is_enable" value="<?php echo set_value('is_enable'); ?>" tabindex=3>
                                                        <option value="">Select User Statsu</option>
                                                        <option value='1' <?php echo set_select('is_enable', '1', (!empty($data) && $data == "1" ? TRUE : FALSE)); ?>>Active</option>
                                                        <option value='0' <?php echo set_select('is_enable', '0', (!empty($data) && $data == "0" ? TRUE : FALSE)); ?>>DeActive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default ">
                                                    <label>Select Rider</label>
                                                    <select class="form-control" id="rider_id" name="rider_id" value="<?php echo set_value('rider_id'); ?>" tabindex=4>
                                                        <option value='0'>Select Rider</option>
                                                        <?php foreach ($result_rider as $rider) { ?>
                                                            <option value=<?php echo $rider['rider_id']; ?> <?php echo set_select('rider_id', $rider['rider_id']); ?>> <?php echo $rider['rider_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
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
                                        <div class="card-title">Opertional User List</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class='table table-bordered compact' id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr#</th>
                                                        <th>Name</th>
                                                        <th>UserID</th>
                                                        <th>Role</th>
                                                        <th>City</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        <th>REG/Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultTable">
                                                    <?php
                                                    $i = 0;
                                                    $locs = array_column($result, 'city_full_name', 'city_id');
                                                    foreach ($customer_data as $rows) {
                                                        $i = $i + 1;
                                                        $userid = $rows->oper_user_id;
                                                        echo ("<tr>");
                                                        echo ("<td>" . $i . "</td>");
                                                        echo ("<td>" . $rows->oper_user_name . "</td>");
                                                        echo ("<td>" . $rows->oper_account_no . "</td>");
                                                        echo ("<td>" . $rows->oper_user_power . "</td>");
                                                        echo ("<td>" . $locs[$rows->oper_user_city_id] . "</td>");
                                                        if ($rows->is_enable) { ?>
                                                            <td class="bg-success text-white"><a style="text-decoration: none; font-weight: bold;">Enable</a></td>
                                                        <?php } else { ?>
                                                            <td class="bg-danger text-white"><a style="text-decoration: none; font-weight: bold;">Disable</a></td>
                                                        <?php }

                                                        if ($rows->is_enable) { ?>
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #dc3545;color: white; border-radius: 3px;border: 2px solid #dc3545;padding: 1px 9px;" href="adduser/status/0/?id=<?= $userid; ?>">Disable</a></td>
                                                        <?php } else { ?>
                                                            <td><a class="btn btn-primary btn-xs" style="text-decoration: none;background: #28a745;color: white;border-radius: 3px;border: 2px solid #28a745;padding: 1px 11px;" href="adduser/status/1/?id=<?= $userid ?>">Enable</a></td>
                                                    <?php }
                                                        echo ("<td>" . $rows->created_date . "</td>");
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
    <?php $this->load->view('inc/footer'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#role').select2();
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
                "displayLength": 15,
                "lengthMenu": [
                    [15, 25, 50, 100, 200, 500, -1],
                    [15, 25, 50, 100, 200, 500, "All"]
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
                        sheetName: 'User Report',
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

    <script>
        $(document).ready(function() {
            jQuery('#myTable_length select').on('change', function() {
                var mypagelength = this.value;
                $.ajax({
                    url: "adduser/ajaxview",
                    type: "POST",
                    cache: false,
                    data: {
                        company_data: mypagelength
                    },
                    success: function(result) {
                        $('#resultTable').html(result);
                    }
                });
            });
        });
    </script>