<?php
error_reporting(0);
$this->load->view('inc/header');
?>

<script type="text/javascript">
$(document).ready(function(){ 
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
                  <li class="breadcrumb-item">Customer</li>
                  <li class="breadcrumb-item">Add Rate</li>
                  <li class="breadcrumb-item">Rate</li>
                  <li class="breadcrumb-item"><mark><?php echo date('Y-m-d h:i:s'); ?></mark></li>
                 
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
   
           

                  <div class="col-xl-12 col-lg-12" >

                <!-- START card -->
               
                    
               <div class=" container-fluid   container-fixed-lg bg-gray"  >
<div class="row">

<div class="col-md-4">
  <div class="card m-t-10">
    <div class="card-header  separator">
     <div class="card-title">Add New Rate</div>
      </div>
   <div class="card-body">
<form role="form">
<div class="form-group">
<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">    
<label>Service Type</label>
<select class="form-control" name="service_type" id="service_type" tabindex=1>
<option value="">Select Service Type</option>
<?php if(!empty($service_data)){foreach($service_data as $rows){echo("<option value=".$rows->service_id.">".$rows->service_name."</option>");}}?>
</select>    
</div>


<div class="card" style="border-color:#6f42c1">
<div class="card-header  separator">
<div class="card-title">Zone A Rate</div>
</div>    
<div class="card-body">
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 1</label>
<input type="number" id="zone_a_wgt_1" name="zone_a_wgt_1" class="form-control"  tabinde="1">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 1</label>
<input type="number" id="zone_a_rate_1" name="zone_a_rate_1" class="form-control"  tabinde="2">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 2</label>
<input type="number" id="zone_a_wgt_2" name="zone_a_wgt_2" class="form-control"  tabinde="3">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 2</label>
<input type="number" id="zone_a_rate_2" name="zone_a_rate_2" class="form-control"  tabinde="4">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Additional Weight</label>
<input type="number" id="zone_a_add_wgt" name="zone_a_add_wgt" class="form-control"  tabinde="5">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Additional Rate</label>
<input type="number" id="zone_a_add_rate" name="zone_a_add_rate" class="form-control"  tabinde="6">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Zone A GST</label>
<input type="number" id="zone_a_gst" name="zone_a_gst" class="form-control"  tabinde="7">
</div>
</div>
</div>
</div>
</div>

<div class="card" style="border-color:#007bff">
<div class="card-header  separator">
<div class="card-title">Zone B Rate</div>
</div>    
<div class="card-body">
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 1</label>
<input type="number" id="zone_b_wgt_1" name="zone_b_wgt_1" class="form-control"  tabinde="8">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 1</label>
<input type="number" id="zone_b_rate_1" name="zone_b_rate_1" class="form-control"  tabinde="9">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 2</label>
<input type="number" id="zone_b_wgt_2" name="zone_b_wgt_2" class="form-control"  tabinde="10">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 2</label>
<input type="number" id="zone_b_rate_2" name="zone_b_rate_2" class="form-control"  tabinde="11">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Additional Weight</label>
<input type="number" id="zone_b_add_wgt" name="zone_b_add_wgt" class="form-control"  tabinde="12">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Additional Rate</label>
<input type="number" id="zone_b_add_rate" name="zone_b_add_rate" class="form-control"  tabinde="13">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Zone B GST</label>
<input type="number" id="zone_b_gst" name="zone_b_gst" class="form-control"  tabinde="14">
</div>
</div>
</div>
</div>
</div>

<div class="card" style="border-color:#17a2b8">
<div class="card-header  separator">
<div class="card-title">Zone C Rate</div>
</div>    
<div class="card-body">
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 1</label>
<input type="number" id="zone_c_wgt_1" name="zone_c_wgt_1" class="form-control"  tabinde="15">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 1</label>
<input type="number" id="zone_c_rate_1" name="zone_c_rate_1" class="form-control"  tabinde="16">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 2</label>
<input type="number" id="zone_c_wgt_2" name="zone_c_wgt_2" class="form-control"  tabinde="17">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 2</label>
<input type="number" id="zone_c_rate_2" name="zone_c_rate_2" class="form-control"  tabinde="18">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Additional Weight</label>
<input type="number" id="zone_c_add_wgt" name="zone_c_add_wgt" class="form-control"  tabinde="19">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Additional Rate</label>
<input type="number" id="zone_c_add_rate" name="zone_c_add_rate" class="form-control"  tabinde="20">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Zone C GST</label>
<input type="number" id="zone_c_gst" name="zone_c_gst" class="form-control"  tabinde="21">
</div>
</div>
</div>
</div>
</div>

<div class="card" style="border-color:#20c997">
<div class="card-header  separator">
<div class="card-title">Zone D Rate</div>
</div>    
<div class="card-body">
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 1</label>
<input type="number" id="zone_d_wgt_1" name="zone_d_wgt_1" class="form-control"  tabinde="22">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 1</label>
<input type="number" id="zone_d_rate_1" name="zone_d_rate_1" class="form-control"  tabinde="23">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Weight 2</label>
<input type="number" id="zone_d_wgt_2" name="zone_d_wgt_2" class="form-control"  tabinde="24">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Rate 2</label>
<input type="number" id="zone_d_rate_2" name="zone_d_rate_2" class="form-control"  tabinde="25">
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">    
<div class="form-group">
<label>Additional Weight</label>
<input type="number" id="zone_d_add_wgt" name="zone_d_add_wgt" class="form-control"  tabinde="26">
</div>
</div>
<div class="col-md-6">    
<div class="form-group">
<label>Additional Rate</label>
<input type="number" id="zone_d_add_rate" name="zone_d_add_rate" class="form-control"  tabinde="27">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Zone C GST</label>
<input type="number" id="zone_d_gst" name="zone_d_gst" class="form-control"  tabinde="28">
</div>
</div>
</div>
</div>
</div>
</div>
</form>

<div class="card-footer">
<button class="btn btn-info pull-right" onclick="add_rate()">Save Zone Wise Rate</button>
<button class="btn btn-danger pull-left" onclick="clear1()">Clear</button>  
</div>

</div>
</div>


<div class="col-md-8">
    <div class="card m-t-10">
    <div class="card-header  separator">
     <div class="card-title">Data Panel</div>
      </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="data_panel">
        <thead>
        <tr>
         <th>Service Type</th>
         <th style="border-color:#6f42c1">Zone A Detail</th>
         <th style="border-color:#007bff">Zone B Detail</th>
         <th style="border-color:#17a2b8">Zone C Detail</th>        
         <th style="border-color:#20c997">Zone D Detail</th>
         <th>Status</th>
        </tr>
      </thead>
      <tbody id="autoload">
       <?php if(!empty($rate_data)){foreach($rate_data as $rows){
             echo("<tr>");
             echo("<td><center>".$rows->service_name." (".$rows->service_code.")<p><b>Rate ID:</b>".$rows->rate_id."</p>");
             if($rows->rate_status==1){
             echo("<a href='".base_url()."customer/destination_wise_rate_view/".$rows->customer_id."/".$rows->service_id."' class='btn btn-info'>Destination Wise</a>");
             }
             echo("</center></td>");
             echo("<td style='border-color:#6f42c1'>
             <p><b>WGT1:</b> ".$rows->sc_wgt1."    <b>Rate1:</b> ".$rows->sc_rate1."</p>
             <p><b>WGT2:</b> ".$rows->sc_wgt2."    <b>Rate2:</b> ".$rows->sc_rate2."</p>
             <p><b>AWGT:</b> ".$rows->sc_dd_wgt."  <b>ARate:</b> ".$rows->sc_add_rate."</p>
             <p><b>GST:</b> ".$rows->sc_gst_rate."</p>
             </td>");
             echo("<td style='border-color:#007bff'>
             <p><b>WGT1:</b> ".$rows->sz_wgt1."    <b>Rate1:</b> ".$rows->sz_rate1."</p>
             <p><b>WGT2:</b> ".$rows->sz_wgt2."    <b>Rate2:</b> ".$rows->sz_rate2."</p>
             <p><b>AWGT:</b> ".$rows->sz_add_wgt."        <b>ARate:</b> ".$rows->sz_add_rate."</p>
             <p><b>GST:</b> ".$rows->sz_gst_rate."</p>
             </td>");
             echo("<td style='border-color:#17a2b8'>
             <p><b>WGT1:</b> ".$rows->dz_wgt1."    <b>Rate1:</b> ".$rows->dz_rate1."</p>
             <p><b>WGT2:</b> ".$rows->dz_wgt2."    <b>Rate2:</b> ".$rows->dz_rate2."</p>
             <p><b>AWGT:</b> ".$rows->dz_add_wgt."        <b>ARate:</b> ".$rows->dz_add_rate."</p>
             <p><b>GST:</b> ".$rows->dz_gst_rate."</p>
             </td>");
             echo("<td style='border-color:#20c997'>
             <p><b>WGT1:</b> ".$rows->zz_wgt1."    <b>Rate1:</b> ".$rows->zz_rate1."</p>
             <p><b>WGT2:</b> ".$rows->zz_wgt2."    <b>Rate2:</b> ".$rows->zz_rate2."</p>
             <p><b>AWGT:</b> ".$rows->zz_add_wgt." <b>ARate:</b> ".$rows->zz_add_rate."</p>
             <p><b>GST:</b> ".$rows->zz_gst_rate."</p>
             </td>");
             if($rows->rate_status==1){
             echo("<td class='bg-success text-white'><center>Active</center></td>");     
             } else {
             echo("<td class='bg-danger text-white'><center>Blocked</center></td>");     
             }
             echo("</tr>");  
        }}?>
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

<script>
 
function clear1(){
//=====Zone A
$("#zone_a_wgt_1").val("");
$("#zone_a_rate_1").val("");
$("#zone_a_wgt_2").val("");
$("#zone_a_rate_2").val("");
$("#zone_a_add_wgt").val("");
$("#zone_a_add_rate").val("");
//=====Zone B
$("#zone_b_wgt_1").val("");
$("#zone_b_rate_1").val("");
$("#zone_b_wgt_2").val("");
$("#zone_b_rate_2").val("");
$("#zone_b_add_wgt").val("");
$("#zone_b_add_rate").val("");
//=====Zone C
$("#zone_c_wgt_1").val("");
$("#zone_c_rate_1").val("");
$("#zone_c_wgt_2").val("");
$("#zone_c_rate_2").val("");
$("#zone_c_add_wgt").val("");
$("#zone_c_add_rate").val("");
//=====Zone D
$("#zone_d_wgt_1").val("");
$("#zone_d_rate_1").val("");
$("#zone_d_wgt_2").val("");
$("#zone_d_rate_2").val("");
$("#zone_d_add_wgt").val("");
$("#zone_d_add_rate").val("");
}

function add_rate(){
var service_type=""; 
var customer_id=""; 
var zone_a_wgt_1="";
var zone_a_rate_1="";
var zone_a_wgt_2="";
var zone_a_rate_2="";
var zone_a_add_wgt="";
var zone_a_add_rate="";
var zone_a_gst="";
//=====Zone B
var zone_b_wgt_1="";
var zone_b_rate_1="";
var zone_b_wgt_2="";
var zone_b_rate_2="";
var zone_b_add_wgt="";
var zone_b_add_rate="";
var zone_b_gst="";
//=====Zone C
var zone_c_wgt_1="";
var zone_c_rate_1="";
var zone_c_wgt_2="";
var zone_c_rate_2="";
var zone_c_add_wgt="";
var zone_c_add_rate="";
var zone_c_gst="";
//=====Zone D
var zone_d_wgt_1="";
var zone_d_rate_1="";
var zone_d_wgt_2="";
var zone_d_rate_2="";
var zone_d_add_wgt="";
var zone_d_add_rate="";
var zone_d_gst="";
var check="Pass";
//===========Zone A Gst
//------------Zone A GST
if($("#zone_a_gst").val()>0){
zone_a_gst=$("#zone_a_gst").val();
$("#zone_a_gst").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_gst").css("border-color", "red"); 
$("#zone_a_gst").focus();
check="Fail";
}
//--------------------------------End
//------------Zone B GST
if($("#zone_b_gst").val()>0){
zone_b_gst=$("#zone_b_gst").val();
$("#zone_b_gst").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_gst").css("border-color", "red"); 
$("#zone_b_gst").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C GST
if($("#zone_c_gst").val()>0){
zone_c_gst=$("#zone_c_gst").val();
$("#zone_c_gst").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_gst").css("border-color", "red"); 
$("#zone_c_gst").focus();
check="Fail";
}
//--------------------------------End
//------------Zone D GST
if($("#zone_d_gst").val()>0){
zone_d_gst=$("#zone_d_gst").val();
$("#zone_d_gst").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_gst").css("border-color", "red"); 
$("#zone_d_gst").focus();
check="Fail";
}
//--------------------------------End
//======Rate Add
//------------Zone A Rate Add
if($("#zone_a_add_rate").val()>0){
zone_a_add_rate=$("#zone_a_add_rate").val();
$("#zone_a_add_rate").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_add_rate").css("border-color", "red"); 
$("#zone_a_add_rate").focus();
check="Fail";
}
//--------------------------------End
//------------Zone B Rate Add
if($("#zone_b_add_rate").val()>0){
zone_b_add_rate=$("#zone_b_add_rate").val();
$("#zone_b_add_rate").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_add_rate").css("border-color", "red"); 
$("#zone_b_add_rate").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C Rate Add
if($("#zone_c_add_rate").val()>0){
zone_c_add_rate=$("#zone_c_add_rate").val();
$("#zone_c_add_rate").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_add_rate").css("border-color", "red"); 
$("#zone_c_add_rate").focus();
check="Fail";
}
//--------------------------------End
//------------Zone d Rate 1
if($("#zone_d_add_rate").val()>0){
zone_d_add_rate=$("#zone_d_add_rate").val();
$("#zone_d_add_rate").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_add_rate").css("border-color", "red"); 
$("#zone_d_add_rate").focus();
check="Fail";
}
//--------------------------------End

//======Rate 1
//------------Zone A Rate 1
if($("#zone_a_rate_1").val()>0){
zone_a_rate_1=$("#zone_a_rate_1").val();
$("#zone_a_rate_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_rate_1").css("border-color", "red"); 
$("#zone_a_rate_1").focus();
check="Fail";
}
//--------------------------------End
//------------Zone B Rate 1
if($("#zone_b_rate_1").val()>0){
zone_b_rate_1=$("#zone_b_rate_1").val();
$("#zone_b_rate_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_rate_1").css("border-color", "red"); 
$("#zone_b_rate_1").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C Rate 1
if($("#zone_c_rate_1").val()>0){
zone_c_rate_1=$("#zone_c_rate_1").val();
$("#zone_c_rate_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_rate_1").css("border-color", "red"); 
$("#zone_c_rate_1").focus();
check="Fail";
}
//--------------------------------End
//------------Zone d Rate 1
if($("#zone_d_rate_1").val()>0){
zone_d_rate_1=$("#zone_d_rate_1").val();
$("#zone_d_rate_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_rate_1").css("border-color", "red"); 
$("#zone_d_rate_1").focus();
check="Fail";
}
//--------------------------------End
//======Rate 2
//------------Zone A Rate 2
if($("#zone_a_rate_2").val()>0){
zone_a_rate_2=$("#zone_a_rate_2").val();
$("#zone_a_rate_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_rate_2").css("border-color", "red"); 
$("#zone_a_rate_2").focus();
check="Fail";
}
//--------------------------------End
//------------Zone B Rate 2
if($("#zone_b_rate_2").val()>0){
zone_b_rate_2=$("#zone_b_rate_2").val();
$("#zone_b_rate_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_rate_2").css("border-color", "red"); 
$("#zone_b_rate_2").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C Rate 2
if($("#zone_c_rate_2").val()>0){
zone_c_rate_2=$("#zone_c_rate_2").val();
$("#zone_c_rate_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_rate_2").css("border-color", "red"); 
$("#zone_c_rate_2").focus();
check="Fail";
}
//--------------------------------End
//------------Zone d Rate 2
if($("#zone_d_rate_2").val()>0){
zone_d_rate_2=$("#zone_d_rate_2").val();
$("#zone_d_rate_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_rate_2").css("border-color", "red"); 
$("#zone_d_rate_2").focus();
check="Fail";
}
//--------------------------------End
//======= WGT 1
//------------Zone A WGT 1
if($("#zone_a_wgt_1").val()>0){
zone_a_wgt_1=$("#zone_a_wgt_1").val();
$("#zone_a_wgt_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_wgt_1").css("border-color", "red"); 
$("#zone_a_wgt_1").focus();
check="Fail";
}
//--------------------------------End

//------------Zone B WGT 1 
if($("#zone_b_wgt_1").val()>0){
zone_b_wgt_1=$("#zone_b_wgt_1").val();
$("#zone_b_wgt_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_wgt_1").css("border-color", "red"); 
$("#zone_b_wgt_1").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C WGT 1 
if($("#zone_c_wgt_1").val()>0){
zone_c_wgt_1=$("#zone_c_wgt_1").val();
$("#zone_c_wgt_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_wgt_1").css("border-color", "red"); 
$("#zone_c_wgt_1").focus();
check="Fail";
}
//--------------------------------End
//------------Zone D WGT 1 
if($("#zone_d_wgt_1").val()>0){
zone_d_wgt_1=$("#zone_d_wgt_1").val();
$("#zone_d_wgt_1").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_wgt_1").css("border-color", "red"); 
$("#zone_d_wgt_1").focus();
check="Fail";
}
//--------------------------------End
//=============WGT 2
//------------Zone A WGT 2
if($("#zone_a_wgt_2").val()>0){
zone_a_wgt_2=$("#zone_a_wgt_2").val();
$("#zone_a_wgt_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_wgt_2").css("border-color", "red"); 
$("#zone_a_wgt_2").focus();
check="Fail";
}
//--------------------------------End

//------------Zone B WGT 2 
if($("#zone_b_wgt_2").val()>0){
zone_b_wgt_2=$("#zone_b_wgt_1").val();
$("#zone_b_wgt_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_wgt_2").css("border-color", "red"); 
$("#zone_b_wgt_2").focus();
check="Fail";
}
//--------------------------------End

//------------Zone C WGT 2 
if($("#zone_c_wgt_2").val()>0){
zone_c_wgt_2=$("#zone_c_wgt_2").val();
$("#zone_c_wgt_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_wgt_2").css("border-color", "red"); 
$("#zone_c_wgt_2").focus();
check="Fail";
}
//--------------------------------End
//------------Zone D WGT 2 
if($("#zone_d_wgt_2").val()>0){
zone_d_wgt_2=$("#zone_d_wgt_2").val();
$("#zone_d_wgt_2").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_wgt_2").css("border-color", "red"); 
$("#zone_d_wgt_2").focus();
check="Fail";
}
//--------------------------------End
//=============ADD WGT
//------------Zone A  ADD WGT 
if($("#zone_a_add_wgt").val()>0){
zone_a_add_wgt=$("#zone_a_add_wgt").val();
$("#zone_a_add_wgt").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_a_add_wgt").css("border-color", "red"); 
$("#zone_a_add_wgt").focus();
check="Fail";
}
//--------------------------------End
//------------Zone B  ADD WGT 
if($("#zone_b_add_wgt").val()>0){
zone_b_add_wgt=$("#zone_b_add_wgt").val();
$("#zone_b_add_wgt").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_b_add_wgt").css("border-color", "red"); 
$("#zone_b_add_wgt").focus();
check="Fail";
}
//--------------------------------End
//------------Zone C  ADD WGT 
if($("#zone_c_add_wgt").val()>0){
zone_c_add_wgt=$("#zone_c_add_wgt").val();
$("#zone_c_add_wgt").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_c_add_wgt").css("border-color", "red"); 
$("#zone_c_add_wgt").focus();
check="Fail";
}
//--------------------------------End
//------------Zone D  ADD WGT 
if($("#zone_d_add_wgt").val()>0){
zone_d_add_wgt=$("#zone_d_add_wgt").val();
$("#zone_d_add_wgt").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#zone_d_add_wgt").css("border-color", "red"); 
$("#zone_d_add_wgt").focus();
check="Fail";
}
//--------------------------------End
//------------Service Type 
if($("#service_type").val()>0){
service_type=$("#service_type").val();
$("#service_typet").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
$("#service_type").css("border-color", "red"); 
$("#service_type").focus();
check="Fail";
}
//--------------------------------End
//------------Service Type 
if($("#customer_id").val()>0){
customer_id=$("#customer_id").val();
$("#customer_id").css("border-color", "rgba(0, 0, 0, 0.07)");  
} else {
check="Fail";
}
//--------------------------------End
if(check!="Fail"){  
var mydata={
service_type           :service_type,
customer_id            :customer_id,
zone_a_gst             :zone_a_gst,
zone_b_gst             :zone_b_gst,
zone_c_gst             :zone_c_gst,
zone_d_gst             :zone_d_gst,
zone_a_wgt_1           :zone_a_wgt_1,
zone_a_rate_1          :zone_a_rate_1,
zone_a_wgt_2           :zone_a_wgt_2,
zone_a_rate_2          :zone_a_rate_2,
zone_a_add_wgt         :zone_a_add_wgt,
zone_a_add_rate        :zone_a_add_rate,
zone_b_wgt_1           :zone_b_wgt_1,
zone_b_rate_1          :zone_b_rate_1,
zone_b_wgt_2           :zone_b_wgt_2,
zone_b_rate_2          :zone_b_rate_2,
zone_b_add_wgt         :zone_b_add_wgt,
zone_b_add_rate        :zone_b_add_rate,
zone_c_wgt_1           :zone_c_wgt_1,
zone_c_rate_1          :zone_c_rate_1,
zone_c_wgt_2           :zone_c_wgt_2,
zone_c_rate_2          :zone_c_rate_2,
zone_c_add_wgt         :zone_c_add_wgt,
zone_c_add_rate        :zone_c_add_rate,
zone_d_wgt_1           :zone_d_wgt_1,
zone_d_rate_1          :zone_d_rate_1,
zone_d_wgt_2           :zone_d_wgt_2,
zone_d_rate_2          :zone_d_rate_2,
zone_d_add_wgt         :zone_d_add_wgt,
zone_d_add_rate        :zone_d_add_rate
};
$.ajax({
url: "<?php echo base_url(); ?>Customer/add_zone_wise_rate",
type: "POST",
data: mydata,        
success: function(data) {
$("#autoload").html(data);
//=====Zone A
$("#zone_a_wgt_1").val("");
$("#zone_a_gst").val("");
$("#zone_a_rate_1").val("");
$("#zone_a_wgt_2").val("");
$("#zone_a_rate_2").val("");
$("#zone_a_add_wgt").val("");
$("#zone_a_add_rate").val("");
//=====Zone B
$("#zone_b_wgt_1").val("");
$("#zone_b_rate_1").val("");
$("#zone_b_wgt_2").val("");
$("#zone_b_rate_2").val("");
$("#zone_b_add_wgt").val("");
$("#zone_b_add_rate").val("");
$("#zone_b_gst").val("");

//=====Zone C
$("#zone_c_wgt_1").val("");
$("#zone_c_gst").val("");
$("#zone_c_rate_1").val("");
$("#zone_c_wgt_2").val("");
$("#zone_c_rate_2").val("");
$("#zone_c_add_wgt").val("");
$("#zone_c_add_rate").val("");
//=====Zone D
$("#zone_d_wgt_1").val("");
$("#zone_d_gst").val("");
$("#zone_d_rate_1").val("");
$("#zone_d_wgt_2").val("");
$("#zone_d_rate_2").val("");
$("#zone_d_add_wgt").val("");
$("#zone_d_add_rate").val("");

}
});
}    
}

</script>




</div>
</div>
<?php
$this->load->view('inc/footer');
?>      