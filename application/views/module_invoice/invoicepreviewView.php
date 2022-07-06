<?php
error_reporting(0);
$this->load->view('inc/header');
?>
<?php 
$sheet_code="";
$sheet_date="";
$sheet_customer_name="";
$sheet_type="";
$sheet_payment="";
$sheet_tid="";
$total_fuel="";
$total_sc="";
$total_gst="";
$sheet_id="";
$other_amount="";
$remark="";
if(!empty($sheet_data)){
foreach($sheet_data as $rows){
$sheet_code             = $rows->invoice_code;
$other_name             = $rows->other_name;
$other_amount           = $rows->other_amount;
$customer_account_no    = $rows->customer_account_no;
$sheet_id               = $rows->invoice_id;
$sheet_date             = $rows->invoice_date;
$cn_date                = $rows->cn_date;
$origin                 = $rows->city_name;
$sheet_customer_name    = $rows->customer_name;
$sheet_customer_address = $rows->customer_address;
$sheet_customer_ntn     = $rows->customer_ntn;
$sheet_customer_note    = $rows->customer_note;
$sheet_type             = $rows->invoice_permission;
$sheet_payment          = $rows->payment_mode;
$sheet_tid              = $rows->payment_tid;
$total_sc               = $rows->invoice_sc;
$total_osa_sd           = $rows->invoice_osa_sd_total;
$total_gst              = $rows->invoice_gst;
$total_fuel             = $rows->fuel_surcharge;
$discounSSt_amount      = $rows->DC;
$remark                 = $rows->invoice_remark;
}} ?>
<style type = "text/css">
 @media print {
    body{
        width: 40cm;
        height: 29.7cm;
        margin: 15mm 45mm 30mm 30mm; 
        /* change the margins as you want them to be. */
   } 
}
@media print {
  .pagebrake{page-break-before: always;}
}
</style>

 <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          <!-- START JUMBOTRON -->
          
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








<div class="card card-default m-t-10">
 
<br>
<br>
<?php function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
}
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . '' : '') . $get_paise;
}
?>

              <div class="card-body">
                <div class="invoice padding-20 sm-padding-10">
                   
                  <div>
                    <div class="pull-left">
                    <?php if($sheet_type=="Yes"){ ?>
                    <!----<img width="235" height="155" alt="" class="invoice-logo" data-src-retina="<?php echo base_url();?>assets/gst.png" data-src="<?php echo base_url();?>assets/gst.png" src="<?php echo base_url();?>assets/gst.png">-->
                  
                    <?php } else { ?>
                    <!----<img width="235" height="155" alt="" class="invoice-logo" data-src-retina="<?php echo base_url();?>assets/gst.png" data-src="<?php echo base_url();?>assets/not_gst.png" src="<?php echo base_url();?>assets/not_gst.png">-->
                 
                    
                    <?php } ?>
                          </div>
                    <div class="pull-right sm-m-t-10">
                         <?php if($sheet_type=="Yes"){ ?>
                      <h4 class="font-montserrat">T.M Cargo & Logistics</h4>
                      <h5 class="font-montserrat">T.M Cargo NTN: 7900821-0 </h5>
                      <?php }  else { ?>
                      <h2 class="font-montserrat">T.M Cargo Services</h2>
                      <?php } ?>
                      <h2 class="font-montserrat">Invoice <img src="<?php echo base_url(); ?>assets/barcode/invoice/<?php echo $sheet_code; ?>.png" width="140" height="50"></h2>
                      
                    </div>
               
                  </div>
                  <div class="col-12">
                    <div class="row">
                      <div class="col-lg-9 col-sm-height sm-no-padding">
                        <p class="small no-margin"><b>Client Account No : </b><?php echo $customer_account_no; ?></p>
                        <h5 class="semi-bold m-t-0"><span style="font-size: 12px; color:#575757;" ><b>Client Name: </b></span><?php echo $sheet_customer_name; ?></h5>
                        <span style="font-size: 12px; " ><b>Client Address: </b></span><?php echo $sheet_customer_address; ?>
                        <br><span style="font-size: 12px;" ><b>Client NTN: </b> </span><?php echo $sheet_customer_ntn; ?><span style="font-size: 12px; padding-left:10px;"><b>Client GST: </b>0</span>
                       
                      </div>
                      <div class="col-lg-3 d-flex align-items-end justify-content-between">
                        <div>
                          <div class="font-montserrat bold all-caps">Invoice No : <?php echo $sheet_code; ?></div>
                            <?php $date=date_create($sheet_date); ?>
                          
                          <div class="font-montserrat bold all-caps">Invoice date :<?php echo date_format($date,"M-d-Y"); ?></div>
                          <?php $date=date_create($sheet_data); ?>
                          <div class="font-montserrat bold all-caps">Billing Month :<?php echo $rows->Month; ?>-<?php echo $rows->Year; ?></div>
                          <div class="clearfix"></div>
                        </div>
                     
                      </div>
                    </div>
                  </div>
                  <!--<p style="font-size:20px; padding-left:17px; padding-top:20px; margin-bottom:-15px;"><b>Statement of Account</b></p>-->
                  <table class="m-t-20" style="width:50%">
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Service Charges</th>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($total_sc); ?></td>
                          </tr>
                          
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">OSA/SD Charges</th>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($total_osa_sd); ?></td>
                          </tr>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <?php if($other_name==""){ ?>
                          <th style="border:1px solid black">Others</th>
                          <td class="text-right" style="border:1px solid black">0</td>
                          <?php } else { ?> 
                          <th style="border:1px solid black"><?php echo $other_name; ?></th>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($other_amount); ?></td>
                              
                          <?php } ?> 
                          </tr>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Fuel Surcharge</th>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($total_fuel); ?></td>
                          </tr>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Insurance Premium</th>
                          <td class="text-right" style="border:1px solid black">0</td>
                          </tr>
                          <?php if($discounSSt_amount!=0){ ?>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Discount Amount</th>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($discounSSt_amount); ?></td>
                          </tr>
                          <?php } ?>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">G.S.T</th>
                          <?php if($sheet_type=="Yes"){ ?>
                          <td class="text-right" style="border:1px solid black"><?php echo number_format($total_gst); ?></td>
                          <?php } else { ?>
                          <td class="text-right" style="border:1px solid black"> <?php echo number_format(0); ?></td>
                          <?php } ?>
                          </tr>
                           <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Net Amount</th>
                           <?php if($sheet_type=="Yes"){ ?>
                          <th class="text-right" style="border:1px solid black"><?php echo number_format(($total_sc + $total_osa_sd + $total_gst + $total_fuel + $other_amount)-$discounSSt_amount); ?></th>
                          <?php } else {?>
                          <th class="text-right" style="border:1px solid black"><?php echo number_format(($total_sc + $total_osa_sd + $total_fuel + $other_amount)-$discounSSt_amount); ?></th>
                          <?php } ?>
                          </tr>
                          <tr>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <td style="border:0px;background-color:white"></td>
                          <th style="border:1px solid black">Amount in Words (PKR)</th>
                          <?php if($sheet_type=="Yes"){ ?>
                          <th class="text-right" style="border:1px solid black">
                              <?php
                               $total_net = round(($total_sc + $total_osa_sd + $total_gst + $total_fuel + $other_amount)-$discounSSt_amount);
                                 $get_amount= AmountInWords($total_net);
                                 echo $get_amount; 
                              ?>
                          </th>
                          <?php } else {?>
                          <th class="text-right" style="border:1px solid black">
                              <?php
                              $total_net = round(($total_sc + $total_osa_sd + $total_fuel + $other_amount)-$discounSSt_amount); 
                              $get_amount= AmountInWords($total_net);
                                 echo $get_amount; 
                              ?>
                          </th>
                          <?php } ?>
                          </tr>
                        </tbody>
                    </table>
                    <br>
                  <p class="small">Note:<?php echo $remark; ?></p>
                    <hr>
                  <p class="small">Note: The Items and particulars of shipments on this statement must be verified and T.M Cargo notified of any discrepancy within 07 days hereof it would be considered true. </p>
                  <p class="small">For complaints that remain unsolved beyond 10 days, you may send an email to cfo@tmcargo.net or call 042-111-862-862</p><br>
                  
                  <div class="pagebrake table-responsive" style="margin-top:50px;">
                    <center>
                        <h5 class="semi-bold m-t-0"><span style="font-size: 12px; color:#575757;" ><b>Client Name: </b></span><?php echo $sheet_customer_name; ?></h5>
                         <div class="font-montserrat bold all-caps">Invoice No : <?php echo $sheet_code; ?></div>
                        <table class="m-t-20" style="width:100%" >
                         <tbody>
                        <tr>
                          <th class="text-center" style="border:1px solid black">Sr</th>        
                          <th class="text-center" style="border:1px solid black">Date</th>
                          <th class="text-center" style="border:1px solid black">CN No</th>
                          <th class="text-center" style="border:1px solid black">Origin</th>
                          <th class="text-center" style="border:1px solid black">Destination</th>
                          <th class="text-center" style="border:1px solid black">Conignee</th>
                          <th class="text-center" style="border:1px solid black">Pieces</th>
                          <th class="text-center" style="border:1px solid black">Weight</th>
                          <th class="text-center" style="border:1px solid black">Service</th>
                          <th class="text-center" style="border:1px solid black">Rate</th>
                          <th class="text-center" style="border:1px solid black">OSA/SD</th>
                          <th class="text-right"  style="border:1px solid black">Amount</th>
                        </tr>
                     
                   
                        
                         <?php if(!empty($sheet_data)){ 
                         $total_wgt=0;
                         $total_pcs=0;
                         $i=0;
                         $j=0;
                          $page=0;
                         foreach($sheet_data as $rows){ $i=$i+1; $j=$j+1; 
                         $total_wgt=$total_wgt + ceil($rows->weight);
                         $total_pcs=$total_pcs + ceil($rows->pcs);
                         ?> 
                        <tr>
                           <th class="" style="border:1px solid black; width:3%"><center><?php echo $i; ?></center></th>
                           <th class="" style="border:1px solid black; width:10%"><center><?php echo $rows->date; ?></center></th>
                           <th class="" style="border:1px solid black; width:9%"><center>
                        <?php if($rows->manual_cn!=""){echo $rows->manual_cn;} else {echo $rows->cn;}; ?></center>
                          </td>
                          <th class="text-center" style="border:1px solid black; width:9%"><?php echo $rows->origin; ?></th>
                          <th class="text-center" style="border:1px solid black; width:10%"><?php echo $rows->destination_name; ?></th>
                          <th class="text-center" style="border:1px solid black; width:14%"><?php echo $rows->consignee_detail; ?></th>
                          <th class="text-center" style="border:1px solid black; width:8%"><?php echo $rows->pcs; ?></th>
                          <th class="text-center" style="border:1px solid black; width:7%"><?php echo ceil($rows->weight); ?></th>
                          <?php if($rows->serivce_name=="Over Night"){ ?>
                          <th class="text-center" style="border:1px solid black; width:9%">O/N</h4>
                          <?php }  else if($rows->serivce_name=="Over Land") { ?>
                          <th class="text-center" style="border:1px solid black; width:9%">OLE</h2>
                          <?php }  else if($rows->serivce_name=="Detain") { ?>
                          <th class="text-center" style="border:1px solid black; width:9%">DTN</h2>
                          <?php } else { ?>
                          <th class="text-center" style="border:1px solid black; width:9%">AF</h2>
                          <?php }  ?>
                      
                          <th class="text-center" style="border:1px solid black; width:10%"><?php echo $rows->rate; ?></th>
                          <th class="text-center" style="border:1px solid black; width:10%"><?php echo $rows->osa_sd; ?></th>
                          <th class="text-right"  style="border:1px solid black; width:13%"><?php echo number_format($rows->sc); ?></th>
                        </tr>
                      
            
                    
                     
                
                     <?php } ?>
                        <tr>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td>
                          <th style="border:1px solid black;background-color:white"><center>Total</center></th>
                          <th style="border:1px solid black;background-color:white"><center><?php echo number_format($total_pcs); ?></center></th>
                          <th style="border:1px solid black;background-color:white"><center><?php echo number_format($total_wgt); ?></center></th>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td>
                          <td style="border:1px solid black;background-color:white"></td> 
                          <td style="border:1px solid black;background-color:white"></td> 
                          </tr>
                       <?php } ?>
                    </table>
                            
                  </div></center>
                  
                  <!--<hr>
                  <p class="small">Note: The Items and particulars of shipments on this statement must be verified and T.M Cargo notified of any discrepancy within 07 days hereof it would be considered true. </p>
                  <p class="small">For complaints that remain unsolved beyond 10 days, you may send an email to cfo@tmcargo.net or call 042-111-862-862</p><br>-->
                  
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

<?php
$this->load->view('inc/wfooter');
?>      