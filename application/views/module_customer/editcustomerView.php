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
                  <li class="breadcrumb-item">Edit Customer</li>
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
     <div class="card-title">Data Panel</div>
     <div class="card-controls">
<ul>

</li>
</ul>
</div>
      </div>
    <div class="card-body">
    
    
    <div class=" container-fluid   container-fixed-lg">
<div class="row row-same-height">
<div class="col-md-4 b-r b-dashed b-grey ">
<div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
<?php if(!empty($message)){ echo("<p class='alert alert-success'>".$message."</p>"); } ?>    
<h2>Your Information is safe with us!</h2>
<p>We respect your privacy and protect it with strong encryption, plus strict policies . Two-step verification, which we encourage all our customers to use.</p>
<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
</div>
</div>
<div class="col-md-8">
<div class="padding-30 sm-padding-5">
<form role="form" method="post" action="<?php echo base_url(); ?>Customer/edit_customer">
<p>Brand Details</p>
<div class="form-group-attached">
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Name</label>
<input type="text" placeholder="Enter Brand Name" class="form-control" value="<?php echo $customer_data[0]['customer_name']; ?>" id="brand_name" name="brand_name" required="" tabindex=1>
<input type="hidden"  id="customer_id" name="customer_id" required=""  value="<?php echo $customer_data[0]['customer_id']; ?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>CNIC</label>
<input type="text" class="form-control"  value="<?php echo $customer_data[0]['customer_cnic']; ?>" placeholder="Enter Brand Name" class="form-control" id="brand_cnic" name="brand_cnic" required="" tabindex=2>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Payment Mode</label>
<select class="form-control" required="" id="pay_mode" name="pay_mode" tabindex=3>
<?php if($customer_data[0]['pay_mode_id']=='1'){
echo("<option value='1'>Account</option>");
} else if($customer_data[0]['pay_mode_id']=='2'){
echo("<option value='2'>FOD</option>");    
} else if($customer_data[0]['pay_mode_id']=='3'){
echo("<option value='3'>Account & FOD</option>");      
} else if($customer_data[0]['pay_mode_id']=='4'){
echo("<option value='4'>Cash</option>");
} else if($customer_data[0]['pay_mode_id']=='5'){
echo("<option value='5'>FOC</option>");
}?>
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
<?php if($customer_data[0]['customer_account_type']=='LW'){
echo("<option value='LW'>Same City</option>");
echo("<option value='NW'>Different City</option>");
} else if($customer_data[0]['customer_account_type']=='NW'){
echo("<option value='NW'>Different Cities</option>");    
echo("<option value='LW'>Same City</option>");
} ?>


</select>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>URL</label>
<input type="text" class="form-control" required="" placeholder="Enter URL"  value="<?php echo $customer_data[0]['customer_url']; ?>"  name="brand_url" id="brand_url" tabindex=5>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Service Type</label>
 <select class='form-control' required="" name="serivce_type" id="service_type">
<?php if ($customer_data[0]['serivce_name']==1){ ?>
<option value="1">Over Night</option>   
<?php } else if($customer_data[0]['serivce_name']==2){ ?>
<option value="2">Over Land</option>
<?php } else if($customer_data[0]['serivce_name']==3){ ?>
<option value="3">Detain</option>
<?php } else if($customer_data[0]['serivce_name']==4){ ?>
<option value="4">Air Frieght</option>
<?php } else if($customer_data[0]['serivce_name']==5){ ?>
<option value="5">Over Night & Over Land</option>
<?php } else if($customer_data[0]['serivce_name']==6){ ?>
<option value="6">Over Night & Detain</option>
<?php } else if($customer_data[0]['serivce_name']==7){ ?>
<option value="7">Over Night & Air Frieght</option>
<?php } else if($customer_data[0]['serivce_name']==8){ ?>
<option value="8">Over Land & Detain</option>
<?php } else if($customer_data[0]['service_name']==9){ ?>
<option value="9">Over Land & Air Frieght</option>
<?php } else if($customer_data[0]['serivce_name']==10){ ?>
<option value="10">Air Frieght & Detain</option>
<?php } else if($customer_data[0]['serivce_name']==11){ ?>
<option value="11">Over Night & Air Frieght & Detain</option>
<?php } else if($customer_data[0]['serivce_name']==13){ ?>
<option value="13">Over Night & Over Land & Detain</option>
<?php } else if($customer_data[0]['serivce_name']==14){ ?>
<option value="14">Over Night & Over Land & Air Frieght</option>
<?php }else if($customer_data[0]['serivce_name']==12){ ?>
<option value="12">All</option>
<?php } ?>
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

<div class="form-group form-group-default required">
<label>NTN</label>
<input type="text" class="form-control" required="" placeholder="Enter NTN"  value="<?php echo $customer_data[0]['customer_ntn']; ?>"  name="brand_ntn" id="brand_ntn" tabindex=5>
</div>
<div class="row clearfix">
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Product Type</label>
<input type="text" class="form-control" required="" value="<?php echo $customer_data[0]['customer_product_type']; ?>" id="brand_product" name="brand_product" tabindex=6>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Select Calculation Type</label>
<select class='form-control' required="" name="calculation_type" id="calculation_type" tabindex=10>
<?php if($customer_data[0]['cal_type']=='Addition'){
echo("<option value='Addition'>Addition</option>");
echo("<option value='Multiplication'>Multiplication</option>");
} else if($customer_data[0]['cal_type']=='Multiplication'){
echo("<option value='Multiplication'>Multiplication</option>");
echo("<option value='Addition'>Addition</option>");
}?>    
</select>
</div>
</div>
</div>
<div class="form-group form-group-default">
<label>Slip Name</label>
<input type="text" class="form-control" required="" id="brand_note" name="brand_note" value="<?php echo $customer_data[0]['customer_note']; ?>" tabindex=6>
</div>
</div>
<br>
<p>Address Detail</p>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Address</label>
<input type="text" class="form-control" id="brand_address" name="brand_address" value="<?php echo $customer_data[0]['customer_address']; ?>" placeholder="Current address" required="" tabindex=7>
</div>

<div class="form-group form-group-default required">
<label>Contact Person Name</label>
<input type="text" class="form-control" placeholder="Enter Contact Person Name" value="<?php echo $customer_data[0]['customer_contact_person']; ?>" name="pickup_points" id="pickup_points" tabindex=8 required="">
</div>
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default">
<label>City</label>
<select class="form-control" name='brand_city' id='brand_city' tabindex=8>

<?php
if(!empty($cities_data)){
foreach($cities_data as $rows){
if($rows->city_id==$customer_data[0]['customer_city']){    
echo("<option value='".$rows->city_id."'>".$rows->city_name."</option>");
}    
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
<input type='email' class="form-control" name='brand_email' id='brand_email' value="<?php echo $customer_data[0]['customer_contact2']; ?>" placeholder="Enter Email" tabindex=9>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required ">
<label>Phone</label>
<input type='text' class="form-control" name='brand_phone' id='brand_phone' value="<?php echo $customer_data[0]['customer_contact']; ?>" placeholder="Enter Phone" tabindex=10>
</div>
</div>
</div>
</div>


<br>
<p>Bank Detail</p>
<div class="form-group-attached">
<div class="form-group form-group-default required">
<label>Name</label>
<input type="text" class="form-control" placeholder="Enter Bank Name" id="bank_name" value="<?php echo $customer_data[0]['customer_bank']; ?>" name="bank_name" required="" tabindex=11>
</div>
<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Account Title</label>
<input type="text" class="form-control" id='account_title' name='account_title' value="<?php echo $customer_data[0]['customer_bank_account_title']; ?>" placeholder="Enter Bank Account Title" required="" tabindex=12>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default required">
<label>Account Number</label>
<input type="text" class="form-control" id='account_no' name='account_no' value="<?php echo $customer_data[0]['customer_bank_account_no']; ?>" placeholder="Enter Bank Account Number" required="" tabindex=13>
</div>
</div>

</div>
<div class="form-group form-group-default required">
<label>IBAN</label>
<input type="text" class="form-control" id='account_iban' name='account_iban'  value="<?php echo $customer_data[0]['customer_iban']; ?>" placeholder="Enter IBAN" required="" tabindex=14>
</div>
</div>









<br>
<p>Reference Detail</p>
<div class="form-group-attached">

<div class="row clearfix">

<div class="col-sm-6">
<div class="form-group form-group-default required" id="user_name_div">
<label>Reference By</label></label>
<select class="form-control" name='reference_by' id='reference_by'  required="" tabindex=17>
<?php
if(!empty($reference_data)){
foreach($reference_data as $rows){
if($rows->reference_id==$customer_data[0]['reference_by']){    
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>");
} else if($rows->reference_id!=$customer_data[0]['reference_by']){    
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>");    
}}}
?> 
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-group-default">
<label>Freelancer Reference By</label>
<select class="form-control" name='secondary_reference_by' id='secondary_reference_by' tabindex=18> 
<?php
if(!empty($freelancer_data)){
foreach($freelancer_data as $rows){
if($rows->reference_id==$customer_data[0]['secondary_reference_by']){        
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>");
} else if($rows->reference_id!=$customer_data[0]['secondary_reference_by']){  
echo("<option value=''>Select Freelancer</option>");     
echo("<option value='".$rows->reference_id."'>".$rows->reference_name."</option>"); 
}
}} 
?> 
</select>
</div>
</div>

</div>


</div>









<br>
<button type="submuit" class='btn btn-primary pull-right'>Update Customer Account</button>
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