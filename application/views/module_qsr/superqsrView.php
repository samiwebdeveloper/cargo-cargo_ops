<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<script type="text/javascript">
  $(document).ready(function() {
    var dataSet = <?php echo json_encode($qsr_data); ?>;
    $("#toalrecord").after(" <h1> Total Records<b> :" + dataSet.length + "</b></h1>")
    var table = $('#myTable').DataTable({
      data: dataSet,
      "columns": [{
          "data": "row_number"
        },
        {
          "data": "customer_name"
        },
        {
          "data": "order_code"
        },
        {
          "data": "manual_cn"
        },
        {
          "data": "order_date"
        },
        {
          "data": "order_booking_date"
        },
        {
          "data": "order_status"
        },
        {
          "data": "shipment_received_by"
        },
        {
          "data": "shipper_name"
        },
        {
          "data": "consignee_name"
        },
        {
          "data": "consignee_mobile"
        },
        {
          "data": "consignee_address"
        },
        {
          "data": "origin_city_name"
        },
        {
          "data": "destination_city_name"
        },
        {
          "data": "pieces"
        },
        {
          "data": "weight"
        },
        {
          "data": "order_sc"
        },
        {
          "data": "cod_amount"
        },
        {
          "data": "order_pay_mode"
        },
        {
          "data": "loading_id"
        },
        {
          "data": "on_route_id"
        },
        {
          "data": "rider"
        },
        {
          "data": "service_name"
        },
        {
          "data": "product_detail"
        },
        {
          "data": "order_arrival_date"
        },
        {
          "data": "order_deliver_date"
        },
        {
          "data": "createdby"
        }
      ],
      "lengthMenu": [
        [50, 100, 500, -1],
        [50, 100, 500, "All"]
      ],

      "fixedHeader": true,
      "searching": true,
      "paging": true,
      "ordering": true,
      //"deferRender": true,
      "bInfo": true,
      dom: 'Blfrtip',
      buttons: [
        'colvis',

        {
          extend: 'excelHtml5',
          messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
          text: "<i class='fs-14 pg-form'></i> Excel",
          titleAttr: 'Excel',
          sheetName: 'QSR <?php echo $start_date . " To " . $end_date; ?>',
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
          title: "QSR <?php echo $start_date . " To " . $end_date; ?>",
          message: "Delivery Express <br> System Developer M.Saim <br>Date:<?php echo $start_date . " To " . $end_date; ?> <br>  QSR Report<br>"
        },
      ]

    });

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
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">QSR Report</li>
            <!-- <?php echo $this->db->last_query(); ?> -->
          </ol>
          <!-- END BREADCRUMB -->
        </div>
      </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">
      <!-- BEGIN PlACE PAGE CONTENT HERE -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 ">
          <div class="card m-t-10">
            <div class="card-header  separator">
              <div class="card-title">QSR Report
              </div>
            </div>
            <div class="card-body">
              <div class="row clearfix">
                <div class="col-md-5">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xl-4 col-lg-4">
                  <div class="card card-default bg-primary" style="background-image: linear-gradient(to right, #16222A , #3A6073);">
                    <div class="card-header  separator">
                      <div class="card-title text-white">QSR Conditions
                      </div>
                    </div>
                    <div class="card-body text-white">
                      <h3 class="text-white">
                        <span class="semi-bold text-white">Apply</span> Conditions
                      </h3>
                      <form role="form" action="<?php echo base_url(); ?>Home/submit_super_qsr" method="post">
                        <div class="form-group">
                          <label>Start Date</label>
                          <span class="help text-white">e.g. "2020-07-01"</span>
                          <input type="date" class="form-control" value="<?php echo $start_date; ?>" required="" name="start_date" id="start_date">
                        </div>
                        <div class="form-group">
                          <label>End Date</label>
                          <span class="help text-white">e.g. "2020-07-30"</span>
                          <input type="date" class="form-control" value="<?php echo $end_date; ?>" required="" name="end_date" id="end_date">
                        </div>
                        <div class="form-group">
                          <label>Customer</label>
                          <span class="help text-white">e.g. "Shopping Asaan"</span>
                          <select class="form-control" data-init-plugin="select2" required="" name="customer_id" id="customer_id">
                            <?php if (!empty($customer_id)) {
                              if (!empty($customer_data)) {
                                foreach ($customer_data as $rows) {
                                  if ($rows->customer_id == $customer_id) {
                                    echo ("<option value='" . $rows->customer_id . "'>" . $rows->customer_name . "</option>");
                                  }
                                }
                              }
                            } ?>
                            <option value=0>All</option>
                            <?php
                            if (!empty($customer_data)) {
                              foreach ($customer_data as $rows) {
                                if ($rows->customer_id != $customer_id) {
                                  echo ("<option value='" . $rows->customer_id . "'>" . $rows->customer_name . "</option>");
                                }
                              }
                            } ?>
                          </select>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-deflaut pull-right" id="btn-reload" type="submit">GO</button>
                    </div>
                    </form>
                    <?php echo $msg; ?>
                  </div>
                </div>
                <?php if (!empty($qsr_data)) { ?>
                  <div class='col-md-4 col-lg-4 col-sm-12 col-xm-12'>
                    <div class="card">
                      <div class="card-header  ">
                        <div class="card-title text-black">Summary Graph
                        </div>
                      </div>
                      <div class="card-body no-padding">
                        <div class="card-body">
                          <H1 id="toalrecord">Shipments Status Wise</H1>
                          <div class="chart">
                            <canvas id="pieChart"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <?php if (!empty($summary_archive_qsr_data)) { ?>
                  <div class='col-md-4 col-lg-4 col-sm-12 col-xm-12'>
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title text-black">Archive Summary Graph
                        </div>
                      </div>
                      <div class="card-body no-padding">
                        <div class="card-body">
                          <H1>Shipments Status Wise</H1>
                          <div class="chart">
                            <canvas id="pieChart1"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button id="btn1">change text</button>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="row">
                <?php if (!empty($qsr_data)) { ?>
                  <div class="col-xl-12 col-lg-12">
                    <div class="table-responsive">
                      <table class='table table-bordered nowrap compact' id="myTable">
                        <thead>
                          <tr>
                            <th>Sr#</th>
                            <th>Customer Account</th>
                            <th>CN</th>
                            <th>Manual CN</th>
                            <th>Order Date</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Receiver Name</th>
                            <th>Shipper Name </th>
                            <th>Consignee Name </th>
                            <th>Consignee Mobile No</th>
                            <th>Consignee Address</th>
                            <th>Origin </th>
                            <th>Destination </th>
                            <th>Pieces</th>
                            <th>Weight (Kg)</th>
                            <th>Service Charges</th>
                            <th>COD</th>
                            <th>Pay Mode</th>
                            <th>Manifest Number</th>
                            <th>Delivery Sheet No</th>
                            <th>Delivery Rider</th>
                            <th>Service Type</th>
                            <th>Product Detail</th>
                            <th>Arrival Date</th>
                            <th>Delivery Date</th>
                            <th>Created By</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th colspan="27" style="font-size: 20px;font-weight: 800;">Loading...</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="card-header  separator">
              <div class="card-title" name="1-success-message" id="1-success-message">
              </div>
            </div>
          </div>
          <!-- END card -->
        </div>
      </div>
    </div>
    <!-- END CONTAINER FLUID -->
  </div>
  <!-- END PAGE CONTENT -->
  <script>
    $(function() {
      var PieData = [
        <?php if (!empty($summary_qsr_data)) {
          foreach ($summary_qsr_data as $rows) { ?> {
              value: <?php echo $rows->shipments; ?>,
              color: '<?php echo '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>',

              highlight: "#6d5eac",
              label: "<?php echo $rows->order_status; ?>"
            },

        <?php }
        } ?>


      ];
      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
    });

    $(function() {
      var PieData = [
        <?php if (!empty($summary_archive_qsr_data)) {
          foreach ($summary_archive_qsr_data as $rows) { ?> {
              value: <?php echo $rows->shipments; ?>,
              color: '<?php echo '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>',
              highlight: "#6d5eac",
              label: "<?php echo $rows->order_status; ?>"
            },

        <?php }
        } ?>


      ];

      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
    });
  </script>

  <?php
  $this->load->view('inc/footer');
  ?>
