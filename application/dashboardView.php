 <?php
  error_reporting(0);
  $this->load->view('inc/header');
  ?>

 <!-- START PAGE CONTENT WRAPPER -->
 <div class="page-content-wrapper">
   <!-- START PAGE CONTENT -->
   <div class="content">
     <!-- START JUMBOTRON -->
     <div class="jumbotron" data-pages="parallax">
       <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0" style="background-image:linear-gradient(45deg, #5a5a5a, #2B6A94);color:white">
         <div class="inner">
           <marquee class="font-montserrat fs-13 all-caps p-t-3"><?php if ($_SESSION['user_power'] != "SUBAGENT") { ?><b>Customer Services Mobile #</b> 03097777228. <b>Operations #</b> 03092862862 <?php } else { ?>Welcome To T.M Cargo.<?php } ?></marquee>
         </div>
       </div>
     </div>
     <!-- END JUMBOTRON -->
     <!-- START CONTAINER FLUID -->
     <div class="container-fluid container-fixed-lg">
       <!-- BEGIN PlACE PAGE CONTENT HERE -->

       <div class="row">

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker
 no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Manage Booking<i class="fa fa-chevron-right"></i>
                   </span>
                 </div>
                 <div class="card-controls">
                   <ul>
                     <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                     </li>
                   </ul>
                 </div>
               </div>
               <a href="<?php echo base_url(); ?>booking">
                 <div class="p-l-20">
                   <h3 class="no-margin p-b-5 text-white">Booking</h3>
                   <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                   </a>
                   <a href="<?php echo base_url(); ?>booking"><span class="small hint-text text-white">Click here for more detail</span></a>
                 </div>
               </a>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Manage Address Labe <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Address Lable</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>booking/address_label"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>



         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white ">
                   <span class="font-montserrat fs-11 all-caps">Track Shipmenets <i class="fa fa-chevron-right"></i>
                   </span>
                 </div>
                 <div class="card-controls">
                   <ul>
                     <li><a href="#" class="card-refresh text-black" data-toggle="refresh"><i class="fa fa-search"></i></a>
                     </li>
                   </ul>
                 </div>
               </div>
               <div class="p-l-20 d-none d-sm-block">
                 <h3 class="no-margin p-b-5 text-white">Tracking</h3>
                 <a href="<?php echo base_url(); ?>Trackingo" target="blank" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>Trackingo" target="blank"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
               <div class="p-l-20 d-block d-sm-none">
                 <h3 class="no-margin p-b-5 text-white">Tracking</h3>
                 <a href="<?php echo base_url(); ?>Mtracking" target="blank" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>Mtracking" target="blank"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>


         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">All Cancelled Shipments <i class="fa fa-chevron-right"></i>
                   </span>
                 </div>
                 <div class="card-controls">
                   <ul>
                     <li>
                       <!--<a href="<?php echo base_url(); ?>home/cancelled_cn_view" class="card-refresh text-white" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
-->
                     </li>
                   </ul>
                 </div>
               </div>
               <div class="p-l-20">
                 <h3 class="no-margin p-b-5 text-white">Cancelled CN</h3>
                 <!--<a href="<?php echo base_url(); ?>home/cancelled_cn_view" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>-->
                 <!--</a>-->
                 <!--<a href="<?php echo base_url(); ?>home/cancelled_cn_view"><span class="small hint-text text-white">Click here for more detail</span></a>-->
               </div>
             </div>
           </div>
         </div>




       </div>









       <div class="row">


         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #2B6A94, #616161)">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Manage Pick Up Points <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Pick Up Points</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>Pickpoint"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #2B6A94, #616161)">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Pick Up Cities <i class="fa fa-chevron-right"></i>
                   </span>
                 </div>
                 <div class="card-controls">
                   <ul>
                     <li><a href="" class="card-refresh text-black" data-toggle="refresh"><i class="card-icon card-icon-refresh"></i></a>
                     </li>
                   </ul>
                 </div>
               </div>
               <div class="p-l-20">
                 <h3 class="no-margin p-b-5 text-white">All Pick Up Cities</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>home/pickup_cities"> <span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #2B6A94, #616161)">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">All Delivery Cities <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Delivery Cities</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>home/delivery_cities"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>
         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-success no-margin widget-loader-bar" style="background-image:linear-gradient(45deg, #2B6A94, #616161)">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Quality Service Report <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">QSR</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <?php if ($_SESSION['customer_id'] != 632) { ?>

                   <a href="<?php echo base_url(); ?>Home/qsr"><span class="small hint-text text-white">Click here for more detail</span></a>
                 <?php } else { ?>
                   <a href="<?php echo base_url(); ?>Home/so_kamal_qsr"><span class="small hint-text text-white">Click here for more detail</span></a>
                 <?php } ?>
               </div>
             </div>
           </div>
         </div>


       </div>

       <div class="row">


         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">All Paid Invoices <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Paid</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>Invoice"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Address Label <i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Print Label</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>booking/address_label"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps"><?php echo $webapi; ?>
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
                 <h3 class="no-margin p-b-5 text-white">Web Api</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>assets/API.pdf"><span class="small hint-text text-white">Click here for more detail</span></a>
               </div>
             </div>
           </div>
         </div>

         <div class="col-md-3 m-b-10">
           <div class="widget-9 card no-border bg-complete-darker no-margin widget-loader-bar">
             <div class="full-height d-flex flex-column">
               <div class="card-header ">
                 <div class="card-title text-white">
                   <span class="font-montserrat fs-11 all-caps">Manage Account Settings<i class="fa fa-chevron-right"></i>
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
                 <h3 class="no-margin p-b-5 text-white">Settings</h3>
                 <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                 </a>
                 <a href="<?php echo base_url(); ?>home/setting_view"><span class="small hint-text text-white">Click here for more detail</span></a>
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