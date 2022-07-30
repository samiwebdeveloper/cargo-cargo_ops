<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<script>
  window.onload = function() {
    window.setTimeout(function() {
      $('#loaderinpage').css('display', 'none')
      $('.page-content-wrapper').css('display', 'block')
    }, 100);
  }
</script>
<div class="col-md-12" id='loaderinpage' style="height:57vh ;text-align: center;position: relative;top: 250px;">
  <!-- <img src="<?php echo base_url();?>assets/preloader.gif" width="100px"> -->
  <img src="<?php echo base_url();?>assets/ajax-loader.gif" width="200px">
</div>
<style>
  .page-content-wrapper {
    display: none;
  }
</style>
<style>
  .card-header a:not(.btn) {
    color: #575757 !important;
    opacity: 1;
  }

  .windows h5 {
    font-size: 13px;
    line-height: 4px;
    font-weight: normal;
  }

  label,
  input,
  button,
  select,
  textarea {
    font-size: 12px;
    font-weight: normal;
    line-height: 20px;
    cursor: pointer;
  }
</style>

<div class="page-content-wrapper">
  <!-- START PAGE CONTENT -->
  <div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
      <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0" style="background-color: #575757 !important; color:white">
        <div class="inner">
          <marquee class="font-montserrat fs-13 all-caps p-t-3">This Will Show TM Cargo & Logistics News Update. http://www.tmcargo.net</marquee>
        </div>
      </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">
      <!-- BEGIN PlACE PAGE CONTENT HERE -->
      <div class="row">

        <div class="col-md-3 m-b-10">
          <div class="widget-9 card no-border bg-primary no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #6d5eac)">
            <div class="full-height d-flex flex-column">
              <div class="card-header ">
                <div class="card-title text-white">
                  <span class="font-montserrat fs-11 all-caps">QSR<i class="fa fa-chevron-right"></i>
                  </span>
                </div>
                <div class="card-controls">
                  <ul>
                    <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-l-20">
                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                </a>
                <a href="<?= base_url(); ?>Home/cs_qsr"><span class="small hint-text text-white">Click here for more detail</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 m-b-10">
          <div class="widget-9 card no-border bg-info no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #949AEF)">
            <div class="full-height d-flex flex-column">
              <div class="card-header ">
                <div class="card-title text-white">
                  <span class="font-montserrat fs-11 all-caps">Manage Your Mail <iclass="fa fa-chevron-right"></i>
                  </span>
                </div>
                <div class="card-controls">
                  <ul>
                    <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-l-20">
                <h3 class="no-margin p-b-5 text-white">Inbox</h3>
                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                </a>
                <a href="https://tmcargo.net:2096/" target="_blank"><span class="small hint-text text-white">Click here for more detail</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 m-b-10">
          <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #28a745)">
            <div class="full-height d-flex flex-column">
              <div class="card-header ">
                <div class="card-title text-white">
                  <span class="font-montserrat fs-11 all-caps">Pending Sheets <i class="fa fa-chevron-right"></i>
                  </span>
                </div>
                <div class="card-controls">
                  <ul>
                    <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="fa fa-search"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-l-20">
                <h3 class="no-margin p-b-5 text-white"><?php echo $pendings_dd_count; ?></h3>
                <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                </a>
                <a href="<?php echo base_url(); ?>home/pending_sheets"><span class="small hint-text text-white">Click here for more detail</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 m-b-10">
          <div class="widget-9 card no-border bg-danger no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #1f3953, #a01c21);">
            <div class="full-height d-flex flex-column">
              <div class="card-header ">
                <div class="card-title text-white">
                  <span class="font-montserrat fs-11 all-caps">Pickup Pending <i class="fa fa-chevron-right"></i>
                  </span>
                </div>
                <div class="card-controls">
                  <ul>
                    <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-l-20">
                <h3 class="no-margin p-b-5 text-white"><?php echo $incomming_pendings_count; ?></h3>
                <a href="<?php echo base_url(); ?>Pendingpickup" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i></a>
                <a href="<?php echo base_url(); ?>Pendingpickup"><span class="small hint-text text-white">Click here for more detail</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 m-b-10">
          <a href="<?php echo base_url(); ?>MainDashbord/main_home" class="btn btn-primary btn-sm">Main Dashbord</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 m-b-10">
          <div class="card">
            <div class="card-header">
              <div class="card-body no-padding">
                <?php if (!empty($pending_data)) { ?>
                  <div class='table-responsive'>
                    <table class="table table-bordered compact nowrap" id='myTable'>
                      <thead>
                        <tr>
                          <th>No #</th>
                          <th>Customer</th>
                          <th>CN</th>
                          <th>Manual CN</th>
                          <th>Status</th>
                          <th>Origin </th>
                          <th>Destination </th>
                          <th>Pieces </th>
                          <th>Weight</th>
                          <th>COD</th>
                          <th class='bg-danger text-white' style="box-shadow: 5px 10px #888888;">DOS</th>
                          <th>OrderDate</th>
                          <th>BookingDate</th>
                          <th>ArrivalDate</th>
                          <th>LastActivityDate</th>
                        </tr>
                      </thead>
                      <tbody id="resultTable">
                        <?php if (!empty($pending_data)) {
                          $i = 0;
                          foreach ($pending_data as $rows) {
                            $i = $i + 1;
                            echo ("<tr>");
                            echo ("<td>" . $i . "</td>");
                            echo ("<td>" . $rows->customer_name . "</td>");
                            echo ("<td>" . $rows->order_code . "</td>");
                            echo ("<td>" . $rows->manual_cn . "</td>");
                            echo ("<td>" . $rows->order_status . "</td>");
                            echo ("<td>" . $rows->origin_city_name . "</td>");
                            echo ("<td>" . $rows->destination_city_name . "</td>");
                            echo ("<td>" . $rows->pieces . "</td>");
                            echo ("<td>" . $rows->weight . "</td>");
                            echo ("<td>" . number_format($rows->cod_amount) . "</td>");
                            echo ("<td class='bg-danger text-white' style='box-shadow:5px 5px 10px #888888;'><center><h5 class='text-white'>" . $rows->DOS . "<h5></center></td>");
                            echo ("<td>" . $rows->order_date . "</td>");
                            echo ("<td>" . $rows->order_booking_date . "</td>");
                            echo ("<td>" . $rows->order_arrival_date . "</td>");
                            echo ("<td>" . $rows->lastactivitydate . "</td>");
                            echo ("</tr>");
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                <?php } ?>
              </div>
              <div class="card-header  separator">
                <div class="card-title" name="1-success-message" id="1-success-message">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
  </div>
  <!-- END PAGE CONTENT -->
  <?php
  $this->load->view('inc/footer');
  ?>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#myTable').DataTable({
        "displayLength": 10,
        "lengthMenu": [
          [10, 25, 50, 100, 250, 500, -1],
          [10, 25, 50, 100, 250, 500, "All"]
        ],

        'fixedHeader': true,
        "searching": true,
        "paging": true,
        "ordering": true,
        "bInfo": true,
        dom: 'Blfrtip',
        buttons: [
          'colvis',
          {
            extend: 'excelHtml5',
            text: "<i class='fs-14 pg-form'></i> Excel",
            titleAttr: 'Excel',
            sheetName: 'Pendings',
            className: 'btn-info',
            exportOptions: {
              modifier: {
                page: 'current'
              }
            }
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
            title: "Pendings",
            message: "Delivery Express <br> System Developer M.Saim <br>  Pending Report<br>"
          }
        ]
      });

    });
  </script>

  <script>
    $(document).ready(function() {
      jQuery('#myTable_length select').on('change', function() {
        var mypagelength = this.value;
        $.ajax({
          url: "home/pending_record",
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