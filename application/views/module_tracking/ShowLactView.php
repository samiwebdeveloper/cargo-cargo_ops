<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Tracking</title>
     <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap1.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />



<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/search2.js" type="text/javascript"></script>

</head>
<script type="text/javascript">
$(document).ready(function(){ 
$("#myTable").saimtech();
});
</script>
<body  style="background-color:#fff">

<table style="width:100%"  id="myTable">

<?php if(!empty($tracking_data)){  

     foreach($tracking_data as $rows){ ?>
<tr bgcolor=#FFFEFF style="border:1px solid #8c363d;">
<td width="10%"  style='color:white;font-size:12px; background:linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center><?php echo $rows->order_event; ?></center></td>
<td width="45%" ><center><code style='font-size:12px;color:#8c363d'><?php echo $rows->order_message." ".$rows->order_reason; ?></code></center></td>
<td width="20%"  style='color:white;font-size:12px; background:linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center><?php echo $rows->order_event_date; ?></font></center></td>
<td width="10%" style='font-size:12px'><center><code style='font-size:12px;color:#8c363d; '><?php echo $rows->order_location_name; ?></code></center></td>
<?php 
if($rows->order_event=="Order" ||  $rows->order_event=="Booking" ||  $rows->order_event=="Cancelled" || $rows->order_event=="Re-order" ){ ?>
<td width="20%"   style='color:white;font-size:11px; background:linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center>Customer</center></td>
<?php } else { ?>
<td width="20%" style='color:white;font-size:11px; background:linear-gradient(to right, #23074d 0%, #cc5333 100%);'><center><a href='https://www.ip2location.com/<?php echo $rows->order_ip; ?>' style="color:white"><?php echo $rows->oper_user_name; ?></a></center></td>
<?php } ?>
</tr>
<tr bgcolor=#fff>
<td><div style="height:5px"></div></td>
<td><div style="height:5px"></div></td>
<td><div style="height:5px"></div></td>
</tr>
<?php }} ?>
</table>
</body>
</html>