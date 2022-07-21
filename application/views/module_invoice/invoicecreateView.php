<?php
error_reporting(0);
$this->load->view('inc/header');
?>

<script type="text/javascript">
  $(document).ready(function() {
    document.getElementById("customer").focus();
    $('#data_panel').saimtech();
    $('#pending_panel').saimtech();
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
            <li class="breadcrumb-item">Accounts</li>
            <li class="breadcrumb-item">Invoice</li>
            <li class="breadcrumb-item">Create Invoice</li>
            <li class="breadcrumb-item"><mark><?php echo date('Y-m-d h:i:s'); ?></mark></li>
            <li class="breadcrumb-item"><mark><?php echo $invoice_code; ?></mark></li>
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

              <div class="col-md-3">
                <div class="card m-t-10">
                  <div class="card-header  separator">
                    <div class="card-title">Create Invoice </div>
                  </div>
                  <div class="card-body">
                    <h5>Invoice Module <mark><?php echo $invoice_code; ?></mark></h5>
                    <form role="form">
                      <div class="form-group" id="invoice_date_div">
                        <label>To Date</label>
                        <span class="help">e.g. "2019-08-23"</span>
                        <input type="date" id="invoice_date" name="invoice_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" tabindex="1">
                      </div>
                      <div class="form-group" id="invoice_date_f_div">
                        <label>From Date</label>
                        <span class="help">e.g. "2019-08-23"</span>
                        <input type="date" id="invoice_date_f" name="invoice_date_f" value="<?php echo date('Y-m-d'); ?>" class="form-control" tabindex="2">
                      </div>
                      <div class="form-group" id="customer_div">
                        <label>Customer</label>
                        <span class="help">Eatbunny</span>
                        <select class="form-control" id="customer" name="customer" tabindex="3">
                          <option value=""> Select Customer</option>
                          <?php if (!empty($customer_data)) {
                            foreach ($customer_data as $rows) {
                              echo ("<option value='" . $rows->id . "'>" . $rows->name . " (" . $rows->city . ")</option>");
                            }
                          } ?>
                        </select>
                      </div>
                      <div class="form-group" id="rider_div">
                        <label>Permission</label>
                        <span class="help">With GST</span>
                        <input style="background:white" type="text" readonly="readonly" class="form-control" id="permission" name="permission" tabindex="4">
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Other Type</label>
                        <span class="help">if any (Optional)</span>
                        <select type="text" name="other" id="other" class="form-control" tabindex="5">
                          <option value=""> Select Other Option</option>
                          <option value="Lifter Charges">Lifter Charges</option>
                          <option value="Loading / Unloading Charge">Loading/Unloading Charge</option>
                          <option value="Driver Charge">Driver Charge</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Other Amount </label>
                        <span class="help">if any (Optional)</span>
                        <input type="text" name="other_amount" id="other_amount" class="form-control" tabindex="6">
                      </div>
                      <div class="form-group">
                        <label>Fuel Surcharge</label>
                        <span class="help">if any (Optional)</span>
                        <input type="text" name="fuel_amount" id="fuel_amount" class="form-control" tabindex="7">
                      </div>

                      <div class="form-group">
                        <label>Discount Amount </label>
                        <span class="help">if any (Optional)</span>
                        <input type="text" name="discount_amount" id="discount_amount" class="form-control" tabindex="8">
                      </div>
                      <div class="form-group">
                        <label>Remark</label>
                        <span class="help">if any (Optional)</span>
                        <textarea name="remark" id="remark" class="form-control" tabindex="9" rows="6"></textarea>
                      </div>

                    </form>
                  </div>
                </div>
              </div>


              <div class="col-md-7">
                <div class="card m-t-10">
                  <div class="card-header  separator">
                    <div class="card-title">Data Panel</div>
                    <div class="card-controls">
                      <ul>

                        <li>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <button class='pull-right btn btn-primary' onclick="complete_invoice()" id="cp_inv">Complete Invoice</button>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="data_panel">
                        <thead>
                          <tr>
                            <th>Sr</th>
                            <th>Date</th>
                            <th>CN</th>
                            <th>Origin</th>
                            <th>Dest</th>
                            <th>Consignee</th>
                            <th>Pcs</th>
                            <th>Weigh</th>
                            <th>Sc</th>
                            <th>OSA/SD</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="autoload">

                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="card m-t-10 bg-warning text-black">
                  <div class="card-header  separator">
                    <div class="card-title">Summary</div>
                  </div>
                  <div class="card-body">
                    <center>
                      <div id="summary_data"></div>
                    </center>
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

      <script>
        $('#customer').change(function(e) {
          customer = $("#customer").val();
          $.ajax({
            url: "<?php echo base_url(); ?>Invoice/get_cutomer_gst",
            type: "POST",
            data: {
              customer: customer
            },
            dataType: "json",
            success: function(result) {
              $("#permission").val(result.result.is_gst);
            }
          });
          var check = "Pass";
          var customer = "";
          var invoice_code = '<?php echo $invoice_code; ?>';
          var invoice_date = "";
          var invoice_date_f = "";
          //------------Customer
          if ($("#customer").val() != "") {
            customer = $("#customer").val();
            $("#customer_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#customer_div").css("border-color", "red");
            $("#customer").focus();
            check = "Fail";
          }

          //------------Date
          if ($("#invoice_date").val() != "") {
            invoice_date = $("#invoice_date").val();
            $("#invoice_date_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#invoice_date_div").css("border-color", "red");
            $("#invoice_date").focus();
            check = "Fail";
          }



          //------------FDate
          if ($("#invoice_date_f").val() != "") {
            invoice_date_f = $("#invoice_date_f").val();
            $("#invoice_date_f_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#invoice_date_f_div").css("border-color", "red");
            $("#invoice_date_f").focus();
            check = "Fail";
          }
          var mydata = {
            customer: customer,
            invoice_code: invoice_code,
            invoice_date: invoice_date,
            invoice_date_f: invoice_date_f
          };
          $.ajax({
            url: "<?php echo base_url(); ?>Invoice/cn_data_list",
            type: "POST",
            data: mydata,
            success: function(data) {
              $("#autoload").html(data);
              $("#summary_data").html("");
              $.ajax({
                url: "<?php echo base_url(); ?>Invoice/summary",
                type: "POST",
                data: mydata,
                success: function(data) {
                  $("#summary_data").html(data);
                }
              });

            }
          });
          document.getElementById("cp_inv").focus();
          //--------------------------------End
        });


        function remove_from_invoice(cn) {
          var invoice_code = '<?php echo $invoice_code; ?>';
          var invoice_date = '';
          var invoice_date_f = "";
          //------------Date
          if ($("#invoice_date").val() != "") {
            invoice_date = $("#invoice_date").val();
            $("#invoice_date_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#invoice_date_div").css("border-color", "red");
            $("#invoice_date").focus();
            check = "Fail";
          }
          //------------FDate
          if ($("#invoice_date_f").val() != "") {
            invoice_date_f = $("#invoice_date_f").val();
            $("#invoice_date_f_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#invoice_date_f_div").css("border-color", "red");
            $("#invoice_date_f").focus();
            check = "Fail";
          }
          //-------Checking Conditions---------
          var mydata = {
            cn: cn,
            invoice_code: invoice_code,
            invoice_date: invoice_date,
            invoice_date_f: invoice_date_f
          };
          $.ajax({
            url: "<?php echo base_url(); ?>Invoice/release_from_invoice",
            type: "POST",
            data: mydata,
            success: function(data) {
              $("#autoload").html(data);
              $("#summary_data").html("");
              $.ajax({
                url: "<?php echo base_url(); ?>Invoice/summary",
                type: "POST",
                data: mydata,
                success: function(data) {
                  $("#summary_data").html(data);
                }
              });

            }
          });

        }



        function complete_invoice() {
          var check = "Pass";
          var customer = "";
          var permission = "";
          var invoice_code = "<?php echo $invoice_code; ?>";
          var discount_amount = $("#discount_amount").val();
          var fuel_amount = $("#fuel_amount").val();
          var other = $("#other").val();
          var other_amount = $("#other_amount").val();
          var remark = $("#remark").val();

          //------------Customer
          if ($("#customer").val() != "") {
            customer = $("#customer").val();
            $("#customer_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#customer_div").css("border-color", "red");
            $("#customer").focus();
            check = "Fail";
          }
          //--------------------------------End

          //------------Permission
          if ($("#permission").val() != "") {
            permission = $("#permission").val();
            $("#permission_div").css("border-color", "rgba(0, 0, 0, 0.07)");
          } else {
            $("#permission_div").css("border-color", "red");
            $("#permission").focus();
            check = "Fail";
          }
          //--------------------------------End
          //-------Checking Conditions---------
          if (check != "Fail") {
            var mydata = {
              customer: customer,
              permission: permission,
              invoice_code: invoice_code,
              other: other,
              discount_amount: discount_amount,
              other_amount: other_amount,
              fuel_amount: fuel_amount,
              remark: remark
            };
            $.ajax({
              url: "<?php echo base_url(); ?>Invoice/complete_invoice",
              type: "POST",
              data: mydata,
              success: function(data) {
                location.replace("<?php echo base_url(); ?>Invoice/create_invoice");
              }
            });
            $("#cn").val("");
          }


        }
      </script>




    </div>
  </div>
  <?php
  $this->load->view('inc/footer');
  ?>