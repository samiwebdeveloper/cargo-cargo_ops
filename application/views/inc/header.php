<!DOCTYPE html>
<?php date_default_timezone_set('Asia/Karachi'); ?>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title>TM Cargo | OPS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/favicon.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/favicon.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/favicon.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/favicon.png">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

	<link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?php echo base_url(); ?>assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>

	<link href="<?php echo base_url(); ?>assets/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
	<link class="main-stylesheet" href="<?php echo base_url(); ?>assets/pages/css/themes/corporate.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables.css">
	<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<style>
		.themebtn {
			background-image: linear-gradient(45deg, #6d5eac, #949AEF);
			color: white;
		}
	</style>
	<style>
		#more {
			display: none;
		}
	</style>
</head>
<?php if ($_SESSION['user_name'] == "" && $_SESSION['portal'] != "ops") {
	redirect('Login');
} ?>

<body class="fixed-header windows desktop pace-done">
	<!-- BEGIN SIDEBAR -->
	<!-- BEGIN SIDEBPANEL-->
	<nav class="page-sidebar" data-pages="sidebar">
		<!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
		<div class="sidebar-overlay-slide from-top" id="appMenu">

		</div>
		<!-- END SIDEBAR MENU TOP TRAY CONTENT-->
		<!-- BEGIN SIDEBAR MENU HEADER-->
		<div class="sidebar-header">
			TM Cargo & Logistics
			<!-- <div class="sidebar-header-controls">
				<button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
				</button>
				<button type="button" class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
				</button>
			</div> -->
		</div>
		<!-- END SIDEBAR MENU HEADER-->
		<!-- START SIDEBAR MENU -->
		<div class="sidebar-menu">
			<!-- BEGIN SIDEBAR MENU ITEMS-->
			<!------------------------BM Power Start------------------------------>
			<?php if ($_SESSION['user_power'] == "BM") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" target='Blank' class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/cs_qsr">Full QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>
							<!-- <li class="">
									<a href="<?php echo base_url(); ?>Home/admin_opslhe">Total Weight</a>
									<span class="icon-thumbnail">TPW</span>
								</li>    -->
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Booking</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking">Single Booking</a>
								<span class="icon-thumbnail">SBG</span>
							</li>
							<!--<li class="">
									<a href="<?php echo base_url(); ?>Booking/Booking/incomplete_detail_view">Incomplete Detail</a>
									<span class="icon-thumbnail">IBD</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking/edit_booking_view">Edit Booking</a>
								<span class="icon-thumbnail">ESB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Arrival">Arrival Scan</a>
								<span class="icon-thumbnail">ARR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading">Manifest</a>
								<span class="icon-thumbnail">MAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Demanifest">De Manifest</a>
								<span class="icon-thumbnail">DMAN</span>
							</li>
							<!--  <li class="">-->
							<!--  <a href="<?php echo base_url(); ?>Loading2DD">Loading To DD</a>-->
							<!--  <span class="icon-thumbnail">DBG</span>-->
							<!--</li>  -->
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">OSA</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
						
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_osa_status"> OSA Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Dc Status</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
						
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_status"> Dc Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Importfile">Import Status</a>
								<span class="icon-thumbnail">OST</span>
							</li>
							<!--<li class="">
									<a href="<?php echo base_url(); ?>Direct/cs_index">Power Tools</a>
									<span class="icon-thumbnail">TOL</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
				<!------------------------BM Power End-------------------------------->
				<!------------------------SM Power Start------------------------------>
			<?php } else  if ($_SESSION['user_power'] == "SM") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>Home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" target='Blank' class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_qsr">Full QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>
							<!--<li class="">
									<a href="<?php echo base_url(); ?>Home/admin_qsr1">DEO QSR</a>
									<span class="icon-thumbnail">DEO</span>
								</li>-->

						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Booking</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking">Single Booking</a>
								<span class="icon-thumbnail">SBG</span>
							</li>
							<!--<li class="">
									<a href="<?php echo base_url(); ?>Booking/Booking/incomplete_detail_view">Incomplete Detail</a>
									<span class="icon-thumbnail">IBD</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking/edit_booking_view">Edit Booking</a>
								<span class="icon-thumbnail">ESB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Arrival">Arrival Scan</a>
								<span class="icon-thumbnail">ARR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading">Manifest</a>
								<span class="icon-thumbnail">MAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Demanifest">De Manifest</a>
								<span class="icon-thumbnail">DMAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading2DD">Loading To DD</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Complains</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>complain/report">Complain List</a>
								<span class="icon-thumbnail">CL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Complain">Register Complain</a>
								<span class="icon-thumbnail">RC</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Customer Account</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-bag"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Customer/add_customer">Create Customer Accounts</a>
								<span class="icon-thumbnail">MCA</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">MR</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Direct/cs_index">Power Tools</a>
								<span class="icon-thumbnail">TOL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
				<!------------------------SM Power End-------------------------------->
				<!------------------------CS Power Start------------------------------>
			<?PHP } else if ($_SESSION['user_power'] == "CS") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" target='Blank' class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/cs_qsr">Full QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_pending">Pending QSR</a>
								<span class="icon-thumbnail">PSR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Booking</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking">Single Booking</a>
								<span class="icon-thumbnail">SBG</span>
							</li>
							<!-- <li class="">
									<a href="<?php echo base_url(); ?>Booking/Booking/incomplete_detail_view">Incomplete Detail</a>
									<span class="icon-thumbnail">IBD</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking/edit_booking_view">Edit Booking</a>
								<span class="icon-thumbnail">ESB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Arrival">Arrival Scan</a>
								<span class="icon-thumbnail">ARR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading">Manifest</a>
								<span class="icon-thumbnail">MAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Demanifest">De Manifest</a>
								<span class="icon-thumbnail">DMAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading2DD">Loading To DD</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">OSA</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
						
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_osa_status"> OSA Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Dc Status</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_status">Dc Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Complains</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>complain/report">Complain List</a>
								<span class="icon-thumbnail">CL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Complain">Register Complain</a>
								<span class="icon-thumbnail">RC</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">RD</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">RT</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Direct/cs_index">Power Tools</a>
								<span class="icon-thumbnail">TOL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Direct">Other Status</a>
								<span class="icon-thumbnail">OST</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Importfile">Import Status</a>
								<span class="icon-thumbnail">OST</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Direct/osa">OSA Module</a>
								<span class="icon-thumbnail">OSA</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
				<!------------------------CS Power End-------------------------------->
				<!------------------------SE Power Start------------------------------>
			<?PHP } else if ($_SESSION['user_power'] == "SE") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<?php if ($_SESSION['user_id'] == "14" or $_SESSION['user_id'] == "20" or $_SESSION['user_id'] == "76" or $_SESSION['user_id'] == "116") { ?>
						<li class="m-t-10">
							<a href="<?php echo base_url(); ?>MainDashbord/main_home" class="detailed">
								<span class="title">Management</span>
								<span class="details">Dashboard</span>
							</a>
							<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
						</li>
					<?php } ?>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" target='Blank' class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/super_admin_qsr">QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_pending">Pending QSR</a>
								<span class="icon-thumbnail">PSR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/complete_qsr">Complete QSR</a>
								<span class="icon-thumbnail">TSP</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_qsr">Full QSR</a>
								<span class="icon-thumbnail">FSR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Booking</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking">Single Booking</a>
								<span class="icon-thumbnail">SBG</span>
							</li>
							<!--<li class="">
									<a href="<?php echo base_url(); ?>Booking/Booking/incomplete_detail_view">Incomplete Detail</a>
									<span class="icon-thumbnail">IBD</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking/all_edit_booking_view">Edit Booking</a>
								<span class="icon-thumbnail">ESB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Arrival">Arrival Scan</a>
								<span class="icon-thumbnail">ARR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading">Manifest</a>
								<span class="icon-thumbnail">MAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Demanifest">De Manifest</a>
								<span class="icon-thumbnail">DMAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading2DD">Loading To DD</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/route_detail">Route List</a>
								<span class="icon-thumbnail">RL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>RR">Print RR</a>
								<span class="icon-thumbnail">RR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Archive/all_cr_report">CR Report</a>
								<span class="icon-thumbnail">CR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Invoice</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-signals"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Invoice">Manage Invoice</a>
								<span class="icon-thumbnail">INV</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Invoice/in_payment">Payment Sheet</a>
								<span class="icon-thumbnail">INP</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoice/unpaid_cn_all">UnInvoiced</a>
								<span class="icon-thumbnail">UIN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoice/uninvoiced_cn_all">UnInvoiced cn</a>
								<span class="icon-thumbnail">UNC</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoiceRules">(BETA)Invoice Rules</a>
								<span class="icon-thumbnail">INR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">(BETA)Invoices</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-calender"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>invoices/create_invoice">(BETA)Create Invoices</a>
								<span class="icon-thumbnail">CIN</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Cn Book</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-calender"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>CnBook/default_load">Cn Book</a>
								<span class="icon-thumbnail">CNB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">(BETA)Franchises</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-note"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Franchises">(BETA)Create Franchise</a>
								<span class="icon-thumbnail">CFH</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Franchises/v2">(BETA2)Create Franchise</a>
								<span class="icon-thumbnail">CFH2</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Customer Account</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-bag"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Customer">Manage Customer Accounts</a>
								<span class="icon-thumbnail">MCA</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Customer/rate">Manage Customer Rates</a>
								<span class="icon-thumbnail">MCR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Complains</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>complain/report">Complain List</a>
								<span class="icon-thumbnail">CL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Complain">Register Complain</a>
								<span class="icon-thumbnail">RC</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">OSA</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
						
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_osa_status"> OSA Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>OSA/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Dc Status</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/upload">Dc File Upload</a>
								<span class="icon-thumbnail">DFU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_status">Dc Status Update</a>
								<span class="icon-thumbnail">DSU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/pending_dc_report">Dc Pending Report</a>
								<span class="icon-thumbnail">DPR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/complete_dc_status">Dc Complete Report</a>
								<span class="icon-thumbnail">DCR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>DcStatus/dc_summary">Dc Status Summary</a>
								<span class="icon-thumbnail">DSS</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">RD</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">RT</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Direct/cs_index">Power Tools</a>
								<span class="icon-thumbnail">TOL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Direct">Other Status</a>
								<span class="icon-thumbnail">TOL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Importfile">Import Status</a>
								<span class="icon-thumbnail">OST</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Direct/osa">OSA Module</a>
								<span class="icon-thumbnail">OSA</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Administration</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>AddUser">Add User</a>
								<span class="icon-thumbnail">AU</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>AddCity">Add City</a>
								<span class="icon-thumbnail">AC</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>AddRoute">Add Route</a>
								<span class="icon-thumbnail">AU</span>
							</li>
						</ul>
					</li>
				</ul>
				<!------------------------SE Power End---------------------------------->
				<!------------------------Accounts Power Start-------------------------->
			<?PHP } else if ($_SESSION['user_power'] == "Account") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" target='Blank' class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_qsr">Full QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Booking</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking">Single Booking</a>
								<span class="icon-thumbnail">SBG</span>
							</li>
							<!-- <li class="">
									<a href="<?php echo base_url(); ?>Booking/Booking/incomplete_detail_view">Incomplete Detail</a>
									<span class="icon-thumbnail">IBD</span>
								</li>-->
							<li class="">
								<a href="<?php echo base_url(); ?>Booking/Booking/edit_booking_view">Edit Booking</a>
								<span class="icon-thumbnail">ESB</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Arrival">Arrival Scan</a>
								<span class="icon-thumbnail">ARR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading">Manifest</a>
								<span class="icon-thumbnail">MAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Demanifest">De Manifest</a>
								<span class="icon-thumbnail">DMAN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Loading2DD">Loading To DD</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>RR">Print RR</a>
								<span class="icon-thumbnail">RR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Archive/all_cr_report">CR Report</a>
								<span class="icon-thumbnail">CR</span>
							</li>

						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Invoice</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-signals"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Invoice">Manage Invoice</a>
								<span class="icon-thumbnail">INV</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Invoice/in_payment">Payment Sheet</a>
								<span class="icon-thumbnail">INP</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoice/unpaid_cn_all">UnInvoiced</a>
								<span class="icon-thumbnail">UIN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoice/uninvoiced_cn_all">UnInvoiced cn</a>
								<span class="icon-thumbnail">UNC</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>invoiceRules">(BETA)Invoice Rules</a>
								<span class="icon-thumbnail">INR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">(BETA)Invoices</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-calender"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>invoices/create_invoice">(BETA)Create Invoices</a>
								<span class="icon-thumbnail">CIN</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">(BETA)Franchises</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-note"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Franchises">(BETA)Create Franchise</a>
								<span class="icon-thumbnail">CIN</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Franchises/v2">(BETA2)Create Franchise</a>
								<span class="icon-thumbnail">CFH2</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Customer Account</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-bag"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Customer">Manage Customer Accounts</a>
								<span class="icon-thumbnail">MCA</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Customer/rate">Manage Customer Rates</a>
								<span class="icon-thumbnail">MCR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">MR</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Direct/cs_index">Power Tools</a>
								<span class="icon-thumbnail">TOL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>

							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
				<!---Accounts Powers ---->
				<!---Read Powers----------------------------------->
			<?PHP } else if ($_SESSION['user_power'] == "READ") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>

					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">QSR</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/admin_qsr">Full QSR</a>
								<span class="icon-thumbnail">QSR</span>
							</li>

						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/setting_view">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
				<!------------------READ POWER END------------------------->
			<?php } else  if ($_SESSION['user_power'] == "AGENT") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Home/branch_qsr" class="detailed">
							<span class="title">QSR</span>
							<span class="details">Quality Service </span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-charts"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Unloading">UN Loading</a>
								<span class="icon-thumbnail">UNL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Debagging">DE Bagging</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>RR">Print RR</a>
								<span class="icon-thumbnail">RR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Return</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-refresh"></i></span>
						<ul class="sub-menu">

							<li class="">
								<a href="<?php echo base_url(); ?>ReBagging">Return Bagging</a>
								<span class="icon-thumbnail">BAG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>ReLoading">Return Loading</a>
								<span class="icon-thumbnail">LOD</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>ReUnloading">Return UN Loading</a>
								<span class="icon-thumbnail">UNL</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>ReDebagging">Return DE Bagging</a>
								<span class="icon-thumbnail">DBG</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>ReSheet">Return Sheet</a>
								<span class="icon-thumbnail">RSH</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Rider">Rider</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route">Route</a>
								<span class="icon-thumbnail">MR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Route/file">Attach File</a>
								<span class="icon-thumbnail">AF</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Home/Change_password">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
			<?php } else  if ($_SESSION['user_power'] == "TM") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>Importfile" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Reports</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-signals"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Tm">TM Shipments</a>
								<span class="icon-thumbnail">TSR</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Tm/tmsummary">TM Summary Report</a>
								<span class="icon-thumbnail">TSS</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Tm/agent_deposit">Payment Deposit</a>
								<span class="icon-thumbnail">TPD</span>
							</li>
						</ul>
					</li>
				</ul>
				</li>
				</ul>
			<?php } else  if ($_SESSION['user_power'] == "TP") { ?>
				<ul class="menu-items">
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Agent" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Agent">Agent Arrival</a>
								<span class="icon-thumbnail">AGT</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>Delivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>RR">Print RR</a>
								<span class="icon-thumbnail">RR</span>
							</li>
						</ul>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Rider" class="detailed">
							<span class="title">Rider</span>
							<span class="details">Manage Rider</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-bag"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Route" class="detailed">
							<span class="title">Route</span>
							<span class="details">Manage Route</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-settings"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
				</ul>
				</li>
				</ul>
			<?php } else  if ($_SESSION['user_power'] == "TPT" && $_SESSION['thrid_party_id'] != 0) { ?>
				<ul class="menu-items">
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Home/TPT" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Operations</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-cupboard"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Agent">Agent Arrival</a>
								<span class="icon-thumbnail">AGT</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>HDelivery">Delivery Phase 1</a>
								<span class="icon-thumbnail">DD1</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>HDelivery2">Delivery Phase 2</a>
								<span class="icon-thumbnail">DD2</span>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>RR">Print RR</a>
								<span class="icon-thumbnail">RR</span>
							</li>

						</ul>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Rider" class="detailed">
							<span class="title">Rider</span>
							<span class="details">Manage Rider</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-bag"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Route" class="detailed">
							<span class="title">Route</span>
							<span class="details">Manage Route</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-settings"></i></span>
					</li>
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
				</ul>
				</li>
				</ul>
			<?php } else  if ($_SESSION['user_power'] == "RIDER") { ?>
				<ul class="menu-items">
					<li class="m-t-30">
						<a href="<?php echo base_url(); ?>home" class="detailed">
							<span class="title">Dashboard</span>
							<span class="details">Account Information</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-thumbs"></i></span>
					</li>
					<li class="m-t-10">
					<li class="m-t-10">
						<a href="<?php echo base_url(); ?>Tracking" class="detailed">
							<span class="title">Track Order</span>
							<span class="details">Order Tracking</span>
						</a>
						<span class="icon-thumbnail themebtn"><i class="pg-search"></i></span>
					</li>
					<li class="m-t-10">
						<a href="javascript:;">
							<span class="title">Tools</span>
							<span class=" arrow "></span>
						</a>
						<span class="bg-success icon-thumbnail themebtn"><i class="pg-settings_small"></i></span>
						<ul class="sub-menu">
							<li class="">
								<a href="<?php echo base_url(); ?>Home/Change_password">Change Password</a>
								<span class="icon-thumbnail">CP</span>
							</li>
						</ul>
					</li>
				</ul>
			<?php } ?>
			<div class="clearfix"></div>
		</div>
		<!-- END SIDEBAR MENU -->
	</nav>
	<!-- END SIDEBAR -->
	<!-- END SIDEBAR -->
	<!-- START PAGE-CONTAINER -->
	<div class="page-container">
		<!-- START PAGE HEADER WRAPPER -->
		<!-- START HEADER -->
		<div class="header ">
			<!-- START MOBILE SIDEBAR TOGGLE -->
			<a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
			</a>
			<!-- END MOBILE SIDEBAR TOGGLE -->
			<div class="">
				<div class="brand inline  m-l-10 ">
					<img src="<?php echo base_url(); ?>assets/img/tmlogo.png" alt="logo" data-src="<?php echo base_url(); ?>assets/img/tmlogo.png" data-src-retina="<?php echo base_url(); ?>assets/img/tmlogo.png" width="120" height="80">
				</div>
			</div>
			<div class="d-flex align-items-center">
				<!-- START User Info-->
				<div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
					<span class="semi-bold"><?php echo $_SESSION['user_name']; ?> </span>
				</div>
				<div class="dropdown pull-right d-lg-block d-none">
					<button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="thumbnail-wrapper d32 circular inline">
							<img src="https://cdn.iconscout.com/icon/free/png-256/laptop-user-1-1179329.png" alt="" data-src="https://cdn.iconscout.com/icon/free/png-256/laptop-user-1-1179329.png" data-src-retina="<?php echo base_url(); ?>assets/img/profiles/avatar_small2x.jpg" width="32" height="32">
						</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
						<a href="#" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
						<a href="<?php echo base_url(); ?>Login/logout" class="clearfix bg-master-lighter dropdown-item">
							<span class="pull-left">Logout</span>
							<span class="pull-right"><i class="pg-power"></i></span>
						</a>
					</div>
				</div>
				<!-- END User Info-->
			</div>
		</div>
		<!-- END HEADER -->
		<!-- END PAGE HEADER WRAPPER -->