<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
  <div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
      <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
        <div class="inner">
          <!-- START BREADCRUMB -->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Operation</li>
            <li class="breadcrumb-item">Route Detail</li>
            <li class="breadcrumb-item"><mark><?php echo date('Y-m-d H:i:s'); ?></mark></li>
          </ol>
          <!-- END BREADCRUMB -->
        </div>
      </div>
    </div>
    <style>
      .alert {
        margin: 4px 5px;
        padding: 4px 5px 3px 12px;
      }

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

    <div class="container-fluid container-fixed-lg">
      <!-- BEGIN PlACE PAGE CONTENT HERE -->
      <div class="col-md-12" style="margin-right:70px !important;">
        <div id="errors" class="row col-md-12 d-flex justify-content-center">
          <?php foreach ($errors as $error) {
            echo $error;
          } ?>
        </div>
        <div class="card m-t-10">
          <div class="card-header separator">
            <div class="card-title">
              <h4>Route Detail</h4>
            </div>
          </div>
          <div id="msg_div"></div>
          <div class="table-responsive m-t-10" style="padding:10px 30px ;">
            <table class="table table-bordered compact nowrap dataTable no-footer" style="margin-top: 10px; border-top: 1px solid gray;" width="100%" id="emp_table">
              <thead>
                <tr>
                  <th width=10px> Sr#</th>
                  <th>Route Name</th>
                  <th>Route Service Name</th>
                  <th>Route Code</th>
                  <th>Origin City</th>
                  <th>Origin Code</th>
                  <th>Reporitng City</th>
                  <th>Reporting Code</th>
                  <th>Destination City</th>
                  <th>destination Code</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($route_detail as $rows) {

                  $i = $i + 1;
                  // $id = $rows['row_id'];
                  $route_name = $rows['route_name'];
                  $route_service_name = $rows['route_service_name'];
                  $route_code = $rows['route_code'];
                  $origin_city = $rows['origin_city'];
                  $origin_code = $rows['origin_code'];
                  $reporting_city = $rows['reporting_city'];
                  $reporting_code = $rows['reporting_code'];
                  $destination_city = $rows['destination_city'];
                  $destination_code = $rows['destination_code'];
                ?>
                  <tr>
                    <td class="text-center"> <?php echo  $i; ?></td>
                    <td> <?php echo  $route_name ?></td>
                    <td> <?php echo $route_service_name ?></td>
                    <td> <?php echo $route_code ?></td>
                    <td> <?php echo $origin_city ?></td>
                    <td> <?php echo $origin_code ?></td>
                    <td> <?php echo $reporting_city ?></td>
                    <td> <?php echo $reporting_code ?></td>
                    <td> <?php echo $destination_city ?></td>
                    <td> <?php echo $destination_code ?></td>
                    <!-- <td hidden> <input type="number" hidden class="row_id" value="<?php echo $id ?>"></td> -->

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$this->load->view('inc/footer');
?>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('table').DataTable({
      "displayLength": 10,
      "lengthMenu": [
        [10, 25, 50, 100, 250, 500, -1],
        [10, 25, 50, 100, 250, 500, "All"]
      ],

      "fixedHeader": true,
      "searching": true,
      "paging": true,
      "ordering": true,
      "bInfo": true,
      dom: 'Blfrtip',
      buttons: [
        'colvis',
        {
          extend: 'csv',
          titleAttr: 'Excel',
          title: "Route Detail",
        },
        {
          extend: 'copyHtml5',
          footer: 'true',
          text: "<i class='fs-14 pg-note'></i> Copy",
          titleAttr: 'Copy'
        },
        {
          extend: 'print',
          titleAttr: 'Print',
          title: "Route Detail",

        }
      ]

    });
  });
</script>
<script>
  window.onload = function() {
    window.setTimeout(function() {
      $('.alert').css('display', 'none');
    }, 15000);
  }
</script>