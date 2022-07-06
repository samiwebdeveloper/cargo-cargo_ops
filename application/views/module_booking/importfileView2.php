 <?php
error_reporting(0);
//$this->load->view('inc/header');
?>
<script type="text/javascript">
$(document).ready(function(){
$("#typeTable").saimtech();
$("#pickupTable").saimtech();
$("#destinationTable").saimtech(); 
});


function imp_file_upload(){  
if($('#file_upload').val()!=""){
$("#event_file_div").css("border-color", "#20c997");  
var inputFile = $('input[name=filename]'); 
var fileToUpload = inputFile[0].files[0];  
var formData     = new FormData()
formData.append("file" ,fileToUpload);                        
$.ajax({
url: "<?php echo base_url(); ?>booking/submit_import_file",
type: "POST",
data: formData, 
contentType: false,
processData: false,         
success: function(data) {
$("#1-success-message").html(data);
}
});
} else{
$("#event_file_div").css("border-color", "red");  
}
}   

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
                  <li class="breadcrumb-item">Booking</li>
                  <li class="breadcrumb-item">Import Booking</li>
                  
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
<div class="col-md-5">

<div class="card card-transparent">
<div class="card-header ">
<div class="card-title">
Upload CSV file for multiple Booking
</div>
</div>
<div class="card-body">
<h3 class="text-danger no-margin">Import Booking</h3>
<br>
<p>Download CSV File.
  <br>
  Insert Data.
  <br>
  Then Upload CSV File
</p>
<br>
                          <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>Importfile/submit_import_file">
                          <div class="form-group form-group-default"  id="event_file_div">
                            <label>CSV File</label>
                            <input type="file" class="form-control" name="file" id="file" class="form-control"  accept=".csv" >
                          </div>
                     
                      
                      <div class="clearfix"></div>
                      <button type="submit"  class="btn btn-danger pull-right"  tablindex="3"><i class="pg-form"></i> Upload File</button>
<div id="1-success-message"></div>
</div>
</div>

</div>
<div class="col-md-7">

<div class="card card-default">
<div class="card-body">
<p class="sm-p-t-20">You can also make multiple bookings by uplaoding csv file.  <a href="<?php echo base_url();?>assets/import_booking.csv">Click here for download csv format.</a> 
</p>
<div class="row">
 <div class="table-responsive">
  
 <a href="<?php echo base_url();?>assets/import_booking.csv"><img src='<?php echo base_url();?>assets/import_booking.PNG' class='img img-responsive' ></a> 


 </div>
                        <div class="col-xl-4 col-lg-4">
                        <div class="table-responsive">
                        <h3>Shipment Type</h3> 
                        <table class='table table-bordered' id="typeTable">
                        <thead>
                        <tr>
                        <th>Shipment Type</th>
                        <th>Type Name</th>
                        </tr>
                        </thead>   
                        <tbody id="resultTable">
                        <?php if(!empty($shipment_type)){
                        foreach($shipment_type as $rows){
                        echo("<tr>");
                        echo("<td><center>".$rows->service_id."</center></td>");
                        echo("<td><center>".$rows->service_name."</center></td>");
                        echo("</tr>"); 
                        }}?>
                        </tbody>  
                        </table>
                        </div>
                        </div>        



                        <div class="col-xl-4 col-lg-4">
                        <div class="table-responsive">
                        <h3>Pick Up Point</h3> 
                        <table class='table table-bordered' id="pickupTable">
                        <thead>
                        <tr>
                        <th>Pickup Point ID</th>
                        <th>Pickup Point</th>
                        </tr>
                        </thead>   
                        <tbody id="resultTable">
                        <?php if(!empty($pick_up_point)){
                        foreach($pick_up_point as $point){
                        echo("<tr>");
                        echo("<td><center>".$point->points_id."</center></td>");
                        echo("<td><center>".$point->point.", ".$point->city_name.", ".$point->country_name." (".$point->name.")</center></td>");
                        echo("</tr>"); 
                        }}?>
                        </tbody>  
                        </table>
                        </div>
                        </div>
      


                        <div class="col-xl-4 col-lg-4">
                        <div class="table-responsive">
                        <h3>Destination</h3> 
                        <table class='table table-bordered' id="destinationTable">
                        <thead>
                        <tr>
                        <th>Desitnation City Code</th>
                        <th>City</th>
                        </tr>
                        </thead>   
                        <tbody id="resultTable">
                        <?php if(!empty($delivery_cities)){
                        foreach($delivery_cities as $rows){
                        echo("<tr>");
                        echo("<td><center>".$rows->city_code."</center></td>");
                        echo("<td><center>".$rows->city_name." (".$rows->city_short_code.")</center></td>");
                        echo("</tr>"); 
                        }}?>
                        </tbody>  
                        </table>
                        </div>
                        </div>



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
//$this->load->view('inc/footer');
?>      