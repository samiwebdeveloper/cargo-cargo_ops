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
                  <li class="breadcrumb-item">Manage</li>
                  <li class="breadcrumb-item">Customer</li>
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



<div class="col-md-12">
    <div class="card m-t-10">
    <div class="card-header  separator">
     <div class="card-title">Add Customer View</div>
     <div class="card-controls">
<ul>

</ul>
</div>
      </div>
    <div class="card-body">
    
    
    <div class=" container-fluid   container-fixed-lg">
<div class="row row-same-height">
<div class="col-md-4 b-r b-dashed b-grey ">
<div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
<?php if($error==1){echo("<p class='alert alert-success'>Your Customer Successfully Saved</p>");} else if($error==2){echo("<p class='alert alert-success'>Something Went Wrong Please try again.</p>");} ?>
<h2>Your Information is safe with us!</h2>
<p>We respect your privacy and protect it with strong encryption, plus strict policies . Two-step verification, which we encourage all our customers to use.</p>
<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
</div>
</div>
<div class="col-md-8">
<div class="padding-30 sm-padding-5">
<form role="form" method="post" action="<?php echo base_url(); ?>Customer/add_customer">
<p>Brand Details</p>
<div class="form-group-attached">
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Name</label>
<input type="text" placeholder="Enter Brand Name" class="form-control" id="brand_name" name="brand_name" required="" tabindex=1>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>CNIC</label>
<input type="text" class="form-control" placeholder="Enter CNIC" class="form-control" id="brand_cnic" name="brand_cnic" required="" tabindex=2>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Payment Mode</label>
<select class="form-control" required="" id="pay_mode" name="pay_mode" tabindex=3>
<option value=''>Select Payment Mode</option>
<option value='1'>Account</option>
<option value='2'>FOD</option>
<option value='3'>Account & FOD</option>
<option value='4'>Cash</option>
<option value='5'>FOC</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Operating type</label>
<select class="form-control" required="" id="operating_type" name="operating_type" tabindex=4>
<option value=''>Select Type</option>
<option value='LW'>Same City</option>
<option value='NW'>Different City</option>
</select>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>GST Type</label>
<select class="form-control" required="" id="gst_type" name="gst_type" tabindex=5>
<option value=''>Select Type</option>
<option value='Yes'>GST</option>
<option value='No'>Without GST</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Service Type</label>
 <select class='form-control' required="" name="serivce_type" id="service_type" tabindex=6>
<option value="">Select Service</option>
<option value="1">Over Night</option>
<option value="2">Over Land</option>
<option value="3">Detain</option>
<option value="4">Air Frieght</option>
<option value="5">Over Night & Over Land</option>
<option value="6">Over Night & Detain</option>
<option value="7">Over Night & Air Frieght</option>
<option value="8">Over Land & Detain</option>
<option value="9">Over Land & Air Frieght</option>
<option value="10">Air Frieght & Detain</option>
<option value="11">Over Night & Air Frieght & Detain</option>
<option value="13">Over Night & Over Land & Detain</option>
<option value="14">Over Night & Over Land & Air Frieght</option>
<option value="12">All</option>
</select>
</div>
</div>
</div>

<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Company URL</label>
<input type="text" class="form-control" required="" placeholder="Enter website URL"   name="brand_url" id="brand_url" tabindex=7>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>NTN</label>
<input type="text" class="form-control" required="" placeholder="Enter NTN"   name="brand_ntn" id="brand_ntn" tabindex=8>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Product Type</label>
<input type="text" class="form-control" required="" id="brand_product" name="brand_product" tabindex=9>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Select Calculation Type</label>
<select class='form-control' required="" name="calculation_type" id="calculation_type" tabindex=10>
<option value="">Select Calculation</option>
<option value="Addition">Addition</option>
<option value="Multiplication">Multiplication</option>
</select>
</div>
</div>
</div>
<div class="form-group form-group-default">
<label>Slip Name</label>
<input type="text" class="form-control" required="" id="brand_note" name="brand_note" tabindex=11>
</div>
</div>
<br>
<p>Company Address Detail</p>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Address</label>
<input type="text" class="form-control" id="brand_address" name="brand_address" placeholder="Current address" required="" tabindex=12>
</div>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Contact Person Name</label>
<input type="text" class="form-control" placeholder="Enter Contact Person"  name="pickup_points" id="pickup_points" tabindex=13 required="">
</div>
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default">
<label>City</label>
<select class="form-control" name='brand_city' id='brand_city' tabindex=14>
<option value=''>Select City</option>
<?php
if(!empty($cities_data)){
foreach($cities_data as $rows){
echo("<option value='".$rows->city_id."'>".$rows->city_name."</option>");
}} 
?>    
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required ">
<label>Country</label>
<select class="form-control" name='Country' id='Country'>
<option value=''>Pakistan</option>    
</select>
</div>
</div>
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Email</label>
<input type='email' class="form-control" name='brand_email' id='brand_email' placeholder="Enter Email" tabindex=15>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required ">
<label>Phone</label>
<input type='text' class="form-control" name='brand_phone' id='brand_phone' placeholder="Enter Phone" tabindex=16>
</div>
</div>
</div>
</div>


<br>
<p>Bank Detail</p>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Name</label>
<select  class="form-control" id="bank_name" name="bank_name" required="" tabindex=17>
<option value="">Select Bank</option>
<option>ADVANCE MICROFINANCE</option>
<option>AL BARAKA BANK LIMITED</option>
<option>ALLIED BANK LIMITED</option>
<option>APNA MICROFINANCE BANK</option>
<option>ASKARI BANK LIMITED</option>
<option>BANK AL HABIB LTD</option>
<option>BANK ALFALAH LIMITED</option>
<option>BANK OF PUNJAB</option>
<option>BANKISLAMI BANK</option>
<option>BURJ BANK LIMITED</option>
<option>CITIBANK</option>
<option>DUBAI ISLAMIC BANK</option>
<option>FAYSAL BANK LIMITED</option>
<option>FINCA MICRO FINANCE BANK LTD</option>
<option>FIRST WOMEN BANK</option>
<option>HABIB BANK LIMITED</option>
<option>HABIB METROPOLITAN BANK LIMITED</option>
<option>INDUSTRIAL COMMERCIAL BANK OF CHINA</option>
<option>JS BANK LIMITED</option>
<option>KASB BANK LIMITED</option>
<option>MCB ISLAMIC BANK LIMITED</option>
<option>MEEZAN BANK LIMITED</option>
<option>MOBILINK MICROFINANCE</option>
<option>MUSLIM COMMERCIAL BANK</option>
<option>NATIONAL BANK OF PAKISTAN</option>
<option>NATIONAL RURAL SUPPORT PROGRAMME</option>
<option>NIB BANK LIMITED</option>
<option>SAMBA</option>
<option>SILK BANK</option>
<option>SINDH BANK</option>
<option>SONERI BANK LIMITED</option>
<option>STANDARD CHARTERED BANK PAKISTAN LTD</option>
<option>SUMMIT BANK</option>
<option>TELENOR MICROFINANCE BANK LTD</option>
<option>U MICROFINANCE</option>
<option>UNITED BANK LIMITED</option>
    
</select>    
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Account Title</label>
<input type="text" class="form-control" id='account_title' name='account_title' placeholder="Enter Bank Account Title" required="" tabindex=18>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Account Number</label>
<input type="text" class="form-control" id='account_no' name='account_no' placeholder="Enter Bank Account Number" required="" tabindex=19>
</div>
</div>

</div>
<div class="form-group form-group-default required">
<label>IBAN</label>
<input type="text" class="form-control" id='account_iban' name='account_iban' placeholder="Enter IBAN" required="" tabindex=20>
</div>
</div>


<br>
<p>Login Detail</p>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Display Name</label>
<input type="text" class="form-control" name="display_name" id="display_name" placeholder="Account Display Name" required="" tabindex=21>
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default required" id="user_name_div">
<label>Username</label></label>
<input type="text" class="form-control" name="user_name" id="user_name" onblur="check_username()" placeholder="Account User Name" required="" tabindex=22>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Password</label>
<input type="text" class="form-control" name="user_password" id="user_password"  placeholder="Account User Password" required="" tabindex=23>
</div>
</div>

</div>


</div>







<br>
<p>Reference Detail</p>
<div class="form-group-attached">

<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default required" id="user_name_div">
<label>Reference By</label></label>
<select class="form-control" name='reference_by' id='reference_by'  required="" tabindex=24>
<option value=''>Select Reference</option>
<?php
if(!empty($reference_data)){
foreach($reference_data as $rows){
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>");
}} 
?> 
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Freelancer Reference By</label>
<select class="form-control" name='secondary_reference_by' id='secondary_reference_by' tabindex=25> 
<option value=''>Select Freelancer Reference</option> 
<?php
if(!empty($freelancer_data)){
foreach($freelancer_data as $rows){
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>");
}} 
?> 
</select>
</div>
</div>

</div>


</div>













<br>
<button type="submuit" class='btn btn-primary pull-right' tabindex=26>Open Customer Account</button>
</form>

</div>
</div>
</div>
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
 
function check_username(){
  
var username=$("#user_name").val();
var mydata={
username : username
};
$.ajax({
url: "<?php echo base_url(); ?>Customer/check_username",
type: "POST",
data: mydata,        
success: function(data) {
  //  alert(data);
if(data==0){    
$("#user_name_div").css("border-color", "green");
} else if(data!=0){
$("#user_name_div").css("border-color", "red");
$("#user_name").focus();
}
}
});

}

</script>




</div>
</div>
<?php
$this->load->view('inc/footer');
?>      