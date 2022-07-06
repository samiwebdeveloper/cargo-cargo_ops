
<?php
error_reporting(0);
$this->load->view('inc/header');
$start_date = $default;
$end_date = $default;
$default_10day = $default;
foreach (array_slice($md_booking_30days, 0, 1) as $start_date);
foreach (array_slice($md_booking_30days, 0, 30) as $end_date);
$start_date = $start_date["Booking_Date"];
$end_date = $end_date["Booking_Date"];

$now = date("Y-m-d", strtotime("now"));
$before_ten_day = date("Y-m-d", strtotime("-10 day"));

// foreach(array_slice($md_booking_30days, 0, 20) as $default_10day);
// $default_10day=$default_10day["Booking_Date"];
?>

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
<!-- START PAGE CONTENT WRAPPER -->
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
         
        <!-- booking origin city wise chart -->
        <div class="col-md-4 m-b-10">
          <div id="piechart2" style="width:420px; height: 400px;  border-left:5px solid #6f42c1;border-radius: 7px;"></div>
        </div>
        <!-- booking destination wise chart -->
        <div class="col-md-4 m-b-10">
          <div id="piechart3" style="width:420px; height: 400px;"></div>
        </div>
<!-- service wise chart -->
        <div class="col-md-4 m-b-10 ">
          <div id="piechart1" style="width:400px; height: 400px; "></div>
        </div>

        <!-- date filter  -->
        <div class="col-md-12 m-b-10">
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-sm-3">
                <div class="form-group form-group-default required" id="user_name_div">
                  <label>Start Date</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" max="<?php echo $start_date ?>" min="<?php echo $end_date ?>" required="" value="<?php if (!empty($end_date)) {
                                                                                                                                                                                echo $before_ten_day;
                                                                                                                                                                              } ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group form-group-default required">
                  <label>End Date</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" required="" max="<?php echo $start_date ?>" min="<?php echo $end_date ?>" value="<?php if (!empty($start_date)) {
                                                                                                                                                                            echo $now;
                                                                                                                                                                          } ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <button class='btn btn-primary update_row' style="height:100%">GO</button>
              </div>
            </div>
          </div>
        </div>
<!-- booking date wise chart -->
        <div class="col-md-12 m-b-10">
          <div id="barchart_material" style="width:100%; height:450px;border-left:5px solid #6f42c1;border-radius: 7px;"></div>
        </div>
        <!-- <div class="col-md-12 m-b-10">
             <div id="chart_div" style="width: 100%; height: 450px;"></div>
        </div> -->
        <div class="col-md-12 m-b-10">
        <script src="https://www.gstatic.com/charts/loader.js"></script>
<div id="the_chart"></div>
        </div>

      </div>
 <!-- js  data table  -->
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

<!-- date filter js  -->
  <script>
    $(".update_row").click(function() {
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();
      if (start_date <= end_date) {
        var start_end_date = {
          start_date: start_date,
          end_date: end_date
        };
        $.ajax({
          url: "fetch_data",
          type: "POST",
          cache: false,
          dataType: 'json',
          data: start_end_date,
          success: function(result) {
            // alert(result)
          //  var jsondata=$.parseJSON(result);
            //  alert($.type(result));
            google.charts.load('current', {
  callback: function () {
    var dataJson = {"total_purchases": [
  { 
    "Booking_Date": "2022-05-13", 
    "booking": 16, "pieces": 40, "weight": 452 },
  {
    "Booking_Date": "2022-05-12",
    "booking": 88,
    "pieces": 167,
    "weight": 1594
  },
  {
    "Booking_Date": "2022-05-11",
    "booking": 80,
    "pieces": 149,
    "weight": 1798
  },
  {
    "Booking_Date": "2022-05-10",
    "booking": 84,
    "pieces": 178,
    "weight": 1976
  },
  {
    "Booking_Date": "2022-05-09",
    "booking": 77,
    "pieces": 114,
    "weight": 1138
  },
  { "Booking_Date": "2022-05-08", "booking": 23, "pieces": 63, "weight": 1448 },
  { "Booking_Date": "2022-05-07", "booking": 73, "pieces": 131, "weight": 2062 }
]
};

    // create blank data table
    var data = new google.visualization.DataTable();

    // add columns: Type      Label
    data.addColumn('string', 'Booking_Date');
    data.addColumn('number', 'booking');
    data.addColumn('number', 'pieces');
    data.addColumn('number', 'weight');

    // add each row from json
    dataJson.total_purchases.forEach(function (row) {
      data.addRow([
        row.Booking_Date,
        row.booking,
        row.pieces,
        row.weight
      ]);
    });

    // sort data table
    data.sort([{column: 0}]);

    var options = {
      chart: {
        title: 'chart '
      },
      hAxis: {
        title: 'week'
      },
      vAxis: {
        title: 'counts',
        viewWindowMode: 'explicit',
        viewWindow: {
          max: 300,
          min: 0
        }
      },
      bars: 'vertical',
      width: 600,
      height: 500
    };

    var chart = new google.charts.Bar(document.getElementById('the_chart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  },
  packages: ['bar']
});
            // $('#resultTable').html(result);
          }
        });
      } else {
        alert("Start date must be less than from end date");
      }

    });
  </script>
<!-- test -->
  <script>
    var dataSet = <?php echo json_encode($md_booking_30days); ?>;
    console.log(dataSet);
    console.log(dataSet[0]['row4']['key2']);
  </script>
 <!-- filter date wise chart js -->
  <script type="text/javascript">
    google.charts.load('current', { 'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Booking_Date', 'Booking', 'Pieces', 'Weight'],
        <?php foreach ($md_booking_30days as $key => $val) { ?>['<?php echo $val['Booking_Date'] ?>', <?php echo $val['booking'] ?>, <?php echo $val['pieces'] ?>, <?php echo $val['weight'] ?>],
        <?php } ?>
      ]);
      var options = {
        chart: {
          title: 'Booking Date Wise',
          // subtitle: 'Booking Date,Booking, Weight, Pieces',
        },
        bars: 'vertical'
      };
      var chart = new google.charts.Bar(document.getElementById('barchart_material'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Booking_Date', 'Booking', 'Pieces', 'Weight'],
          
        <?php foreach ($md_booking_30days as $key => $val) { ?>['<?php $originalDate = $val['Booking_Date']; echo $newDate = date("d-M", strtotime($originalDate));   ?>', <?php echo $val['booking'] ?>, <?php echo $val['pieces'] ?>, <?php echo $val['weight'] ?>],
        <?php } ?>
        ]);

        var options = {
          title : 'Monthly Booking Date Wise',
          vAxis: {title: 'Amount'},
          hAxis: {title: 'Booking_Date'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
 
  
<!-- service wise chart js -->
  <script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['booking_service_wise', 'Count'],
        <?php foreach ($booking_service_wise as $key => $val) { ?>['<?php echo $val['service_name'] ?>', <?php echo $val['service'] ?>],
        <?php } ?>
      ]);
      var options = {
        title: 'Booking Service Wise',
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
      chart.draw(data, options);
    }
  </script>
<!-- origin city chart js -->
  <script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['origin_city_name', 'Count'],
        <?php foreach ($city_origin_wise as $key => $val) { ?>['<?php echo $val['origin_city_name'] ?>', <?php echo $val['origin_city'] ?>],
        <?php } ?>
      ]);
      var options = {
        title: 'Booking Origin City',
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
      chart.draw(data, options);
    }
  </script>
<!-- destination city chart js -->
  <script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['origin_city_name', 'Count'],
        <?php foreach ($city_destination_wise as $key => $val) { ?>['<?php echo $val['destination_city_name'] ?>', <?php echo $val['distination_city'] ?>],
        <?php } ?>
      ]);
      var options = {
        title: 'Booking Destination City',
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
      chart.draw(data, options);
    }
  </script>

  <script>
    $(document).ready(function() {
      jQuery('#myTable_length select').on('change', function() {
        var mypagelength = this.value;
        $.ajax({
          url: "pending_record",
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

   <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#myTable').DataTable({
        "displayLength": 10,
        "lengthMenu": [
          [10, 25, 50, 100, 250, 400, -1],
          [10, 25, 50, 100, 250, 400, "All"]
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