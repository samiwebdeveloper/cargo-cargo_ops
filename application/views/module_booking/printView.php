<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Address Label</title>
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/qrcode.js" type="text/javascript"></script>
    <style>
        @media screen {
            p.bodyText {
                font-family: verdana, arial, sans-serif;
            }
        }

        @media print {
            p.bodyText {
                font-family: georgia, times, serif;
            }
        }

        @media screen,
        print {
            p.bodyText {
                font-size: 40px
            }
        }

        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }

        .barcode {
            font-family: 'Libre Barcode 39 Text', cursive;
            font-size: 40px !important;
            color: #000 !important;
            line-height: 40px;
            padding: 9px;
        }

        .table td,
        .table th {
            padding: 4;
            vertical-align: middle;
            border: 1px solid black;
        }

        @media print {
            .table {
                border: 1px solid #000000 !important;
            }
        }

        .font_family {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<!-- <body onload="window.print()"> -->

<body>
    <?php if (!empty($print_data)) {

        $i = 0;
        foreach ($print_data as $rows) {
            $i = $i + 1; ?>
            <div class="container">
                <hr>
                <table class="table table-bordered compact" width="100%">
                    <tbody style="font-family:Georgia, 'Times New Roman', Times, serif ;">
                        <tr class="main_tr">
                            <td rowspan="6" class="text-center tm_img_logo"><img src="https://cargo.tmcargoexpress.com/assets/img/print_logo.png" width="150" height="90"></td>
                            <th> Booking Date </th>
                            <td> <?php echo date('d-M-Y', strtotime($rows->order_date)) ?></td>
                            <th>CN#</th>
                            <td class="font_family"><?php echo $rows->order_code; ?></td>
                            <td rowspan="4" class="text-center barcode"><?php echo "*" . $rows->order_code . "*"; ?></td>

                        <tr>
                            <th>Origin</th>
                            <td><?php echo $rows->origin_city_name; ?></td>
                            <th>Destination</th>
                            <td><?php echo $rows->destination_city_name; ?></td>
                        </tr>
                        <tr>
                            <th>Pieces</th>
                            <td class="font_family"><?php echo $rows->pieces; ?></td>
                            <th>Weight (Kg)</th>
                            <td class="font_family"><?php echo $rows->weight; ?></td>
                        </tr>

                        <tr>
                            <th>Product Type</th>
                            <td><?php echo $rows->product_detail; ?></td>
                            <th>Service</th>
                            <td><?php echo $rows->service_name; ?></td>
                        </tr>
                        <tr>
                            <?php if ($rows->order_pay_mode == "Cash") {
                                echo ("<th>Cash</th>");
                            } else {
                                echo ("<th>COD</th>");
                            }
                            ?>
                            <td class="font_family"><?php echo $rows->cod_amount; ?></td>
                            <th>Customer A/C</th>
                            <td><?php echo $rows->customer_name; ?></td>
                            <td class="text-center" rowspan="3">
                                <div id="qrcode_1" style="margin-left: 4.5rem!important"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3" class="text-center"><?php echo $rows->order_remark; ?></td>

                        </tr>
                        </tr>
                        <tr>
                            <?php
                            if ($_SESSION['customer_id'] == '412') {
                                $shipper_address = "Shipper Address : F-441 A , near girls degree college , Site Area, Karachi (02138402072)";
                            } else if (($_SESSION['customer_id'] == '576' || $name == "#786@") && ($name2 != '#UM@')) {
                                $shipper_address = "Shopseven86.com (Best Quality Guranteed)";
                            } else {
                                $shipper_address = $rows->shipper_address;
                            }
                            ?>

                            <th class="text-center">SHIPPER SLIP</th>
                            <td colspan="2"><b>Shipper Detail</b><br> <?php echo $rows->shipper_name; ?> <br><span class="font_family"><?php echo $rows->shipper_phone; ?></span> <br> <?php echo $shipper_address ?> </td>
                            <td colspan="2"><b>Consignee Detail</b><br> <?php echo $rows->consignee_name; ?> <br><span class="font_family"><?php echo $rows->consignee_mobile; ?></span> <br> <?php echo $rows->consignee_address; ?> </td>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-center">The Consignment is booked on shipper risk Please don't accept if shipment is not intact.</th>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <br>
                <hr>
                <table class="table table-bordered compact" width="100%">
                    <tbody style="font-family:Georgia, 'Times New Roman', Times, serif ;">
                        <tr class="main_tr">
                            <td rowspan="6" class="text-center tm_img_logo"><img src="https://cargo.tmcargoexpress.com/assets/img/print_logo.png" width="150" height="90"></td>
                            <th> Booking Date </th>
                            <td> <?php echo date('d-M-Y', strtotime($rows->order_date)) ?></td>
                            <th>CN#</th>
                            <td class="font_family"><?php echo $rows->order_code; ?></td>
                            <td rowspan="4" class="text-center barcode"><?php echo "*" . $rows->order_code . "*"; ?></td>
                        <tr>
                            <th>Origin</th>
                            <td><?php echo $rows->origin_city_name; ?></td>
                            <th>Destination</th>
                            <td><?php echo $rows->destination_city_name; ?></td>
                        </tr>
                        <tr>
                            <th>Pieces</th>
                            <td class="font_family"><?php echo $rows->pieces; ?></td>
                            <th>Weight (Kg)</th>
                            <td class="font_family"><?php echo $rows->weight; ?></td>
                        </tr>

                        <tr>
                            <th>Product Type</th>
                            <td><?php echo $rows->product_detail; ?></td>
                            <th>Service</th>
                            <td><?php echo $rows->service_name; ?></td>
                        </tr>
                        <tr>
                            <?php if ($rows->order_pay_mode == "Cash") {
                                echo ("<th>Cash</th>");
                            } else {
                                echo ("<th>COD</th>");
                            }
                            ?>
                            <td class="font_family"><?php echo $rows->cod_amount; ?></td>
                            <th>Customer A/C</th>
                            <td><?php echo $rows->customer_name; ?></td>
                            <td class="text-center" rowspan="3">
                                <div id="qrcode_2" style="margin-left: 4.5rem!important"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3" class="text-center"><?php echo $rows->order_remark; ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <?php
                            if ($_SESSION['customer_id'] == '412') {
                                $shipper_address = "Shipper Address : F-441 A , near girls degree college , Site Area, Karachi (02138402072)";
                            } else if (($_SESSION['customer_id'] == '576' || $name == "#786@") && ($name2 != '#UM@')) {
                                $shipper_address = "Shopseven86.com (Best Quality Guranteed)";
                            } else {
                                $shipper_address = $rows->shipper_address;
                            }
                            ?>
                            <th class="text-center">CONSIGNEE SLIP</th>
                            <td colspan="2"><b>Shipper Detail</b><br> <?php echo $rows->shipper_name; ?> <br><span class="font_family"><?php echo $rows->shipper_phone; ?></span> <br> <?php echo $shipper_address ?> </td>
                            <td colspan="2"><b>Consignee Detail</b><br> <?php echo $rows->consignee_name; ?> <br><span class="font_family"><?php echo $rows->consignee_mobile; ?></span> <br> <?php echo $rows->consignee_address; ?> </td>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-center">The Consignment is booked on shipper risk Please don't accept if shipment is not intact.</th>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <br>
                <hr>
                <table class="table table-bordered compact" width="100%">
                    <tbody style="font-family:Georgia, 'Times New Roman', Times, serif ;">
                        <tr class="main_tr">
                            <td rowspan="6" class="text-center tm_img_logo"><img src="https://cargo.tmcargoexpress.com/assets/img/print_logo.png" width="150" height="90"></td>
                            <th> Booking Date </th>
                            <td> <?php echo date('d-M-Y', strtotime($rows->order_date)) ?></td>
                            <th>CN#</th>
                            <td class="font_family"><?php echo $rows->order_code; ?></td>
                            <td rowspan="4" class="text-center barcode"><?php echo "*" . $rows->order_code . "*"; ?></td>
                        <tr>
                            <th>Origin</th>
                            <td><?php echo $rows->origin_city_name; ?></td>
                            <th>Destination</th>
                            <td><?php echo $rows->destination_city_name; ?></td>
                        </tr>
                        <tr>
                            <th>Pieces</th>
                            <td class="font_family"><?php echo $rows->pieces; ?></td>
                            <th>Weight (Kg)</th>
                            <td class="font_family"><?php echo $rows->weight; ?></td>
                        </tr>

                        <tr>
                            <th>Product Type</th>
                            <td><?php echo $rows->product_detail; ?></td>
                            <th>Service</th>
                            <td><?php echo $rows->service_name; ?></td>
                        </tr>
                        <tr>
                            <?php if ($rows->order_pay_mode == "Cash") {
                                echo ("<th>Cash</th>");
                            } else {
                                echo ("<th>COD</th>");
                            }
                            ?>
                            <td class="font_family"><?php echo $rows->cod_amount; ?></td>
                            <th>Customer A/C</th>
                            <td><?php echo $rows->customer_name; ?></td>
                            <td class="text-center" rowspan="3">
                                <div id="qrcode_3" style="margin-left: 4.5rem!important"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3" class="text-center"><?php echo $rows->order_remark; ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <?php
                            if ($_SESSION['customer_id'] == '412') {
                                $shipper_address = "Shipper Address : F-441 A , near girls degree college , Site Area, Karachi (02138402072)";
                            } else if (($_SESSION['customer_id'] == '576' || $name == "#786@") && ($name2 != '#UM@')) {
                                $shipper_address = "Shopseven86.com (Best Quality Guranteed)";
                            } else {
                                $shipper_address = $rows->shipper_address;
                            }
                            ?>
                            <th class="text-center">OPERATIONS SLIP</th>
                            <td colspan="2"><b>Shipper Detail</b><br> <?php echo $rows->shipper_name; ?> <br><span class="font_family"><?php echo $rows->shipper_phone; ?></span> <br> <?php echo $shipper_address ?> </td>
                            <td colspan="2"><b>Consignee Detail</b><br> <?php echo $rows->consignee_name; ?> <br><span class="font_family"><?php echo $rows->consignee_mobile; ?></span> <br> <?php echo $rows->consignee_address; ?> </td>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-center">The Consignment is booked on shipper risk Please don't accept if shipment is not intact.</th>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <br>
                <hr>

                <table class="table table-bordered compact" width="100%">
                    <tbody style="font-family:Georgia, 'Times New Roman', Times, serif ;">
                        <tr class="main_tr">
                            <td rowspan="6" class="text-center tm_img_logo"><img src="https://cargo.tmcargoexpress.com/assets/img/print_logo.png" width="150" height="90"></td>
                            <th> Booking Date </th>
                            <td> <?php echo date('d-M-Y', strtotime($rows->order_date)) ?></td>
                            <th>CN#</th>
                            <td class="font_family"><?php echo $rows->order_code; ?></td>
                            <td rowspan="4" class="text-center barcode"><?php echo "*" . $rows->order_code . "*"; ?></td>

                        <tr>
                            <th>Origin</th>
                            <td><?php echo $rows->origin_city_name; ?></td>
                            <th>Destination</th>
                            <td><?php echo $rows->destination_city_name; ?></td>
                        </tr>
                        <tr>
                            <th>Pieces</th>
                            <td class="font_family"><?php echo $rows->pieces; ?></td>
                            <th>Weight (Kg)</th>
                            <td class="font_family"><?php echo $rows->weight; ?></td>
                        </tr>

                        <tr>
                            <th>Product Type</th>
                            <td><?php echo $rows->product_detail; ?></td>
                            <th>Service</th>
                            <td><?php echo $rows->service_name; ?></td>
                        </tr>
                        <tr>
                            <?php if ($rows->order_pay_mode == "Cash") {
                                echo ("<th>Cash</th>");
                            } else {
                                echo ("<th>COD</th>");
                            }
                            ?>
                            <td class="font_family"><?php echo $rows->cod_amount; ?></td>
                            <th>Customer A/C</th>
                            <td><?php echo $rows->customer_name; ?></td>
                            <td class="text-center" rowspan="3">
                                <div id="qrcode_4" style="margin-left: 4.5rem!important"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td colspan="3" class="text-center"><?php echo $rows->order_remark; ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <?php
                            if ($_SESSION['customer_id'] == '412') {
                                $shipper_address = "Shipper Address : F-441 A , near girls degree college , Site Area, Karachi (02138402072)";
                            } else if (($_SESSION['customer_id'] == '576' || $name == "#786@") && ($name2 != '#UM@')) {
                                $shipper_address = "Shopseven86.com (Best Quality Guranteed)";
                            } else {
                                $shipper_address = $rows->shipper_address;
                            }
                            ?>
                            <th class="text-center">ACCOUNTS SLIP</th>
                            <td colspan="2"><b>OPERATIONS Detail</b><br> <?php echo $rows->shipper_name; ?> <br><span class="font_family"><?php echo $rows->shipper_phone; ?></span> <br> <?php echo $shipper_address ?> </td>
                            <td colspan="2"><b>Consignee Detail</b><br> <?php echo $rows->consignee_name; ?> <br><span class="font_family"><?php echo $rows->consignee_mobile; ?></span> <br> <?php echo $rows->consignee_address; ?> </td>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-center">The Consignment is booked on shipper risk Please don't accept if shipment is not intact.</th>
                        </tr>
                    </tbody>
                </table>
                <hr>

            </div>

            <?php if ($i == 1) { ?>
                <div class="pagebreak"></div>
    <?php $i = 0;
            }
        }
    } ?>
    <script type="text/javascript">
        var qrcode_1 = new QRCode(document.getElementById("qrcode_1"), {
            width: 130,
            height: 125
        });
        var qrcode_2 = new QRCode(document.getElementById("qrcode_2"), {
            width: 130,
            height: 125
        });
        var qrcode_3 = new QRCode(document.getElementById("qrcode_3"), {
            width: 130,
            height: 125
        });
        var qrcode_4 = new QRCode(document.getElementById("qrcode_4"), {
            width: 130,
            height: 125
        });


        function makeCode() {
            qrcode_1.makeCode("Booking Date :<?php echo date('d-M-Y', strtotime($rows->order_date)) . '\n' ?>'Cn':<?php echo $rows->order_code . '\n' ?>s:<?php echo $rows->order_service_type . '\n' ?>o:<?php echo $rows->origin_city . '\n'; ?>'d':<?php echo $rows->destination_city . '\n'; ?>'p':<?php echo $rows->pieces . '\n'; ?>'w':<?php echo ceil($rows->weight) . '\n'; ?>'cod':<?php echo $rows->cod_amount; ?>|'cus':<?php echo $rows->customer_id; ?>|'sh':'<?php echo $rows->shipper_name; ?>'|'sa':'<?php echo $rows->shipper_address; ?>'|'sp':'<?php echo $rows->shipper_phone; ?>'|'co':'<?php echo $rows->consignee_name; ?>'|'ca':'<?php echo $rows->consignee_address; ?>'|'cp':'<?php echo $rows->consignee_mobile; ?>'|'pd':'<?php echo $rows->product_detail; ?>'|'r':'<?php echo $rows->order_remarks; ?>'");
            qrcode_2.makeCode("Booking Date :<?php echo date('d-M-Y', strtotime($rows->order_date)) . '\n' ?>'Cn':<?php echo $rows->order_code . '\n' ?>s:<?php echo $rows->order_service_type . '\n' ?>o:<?php echo $rows->origin_city . '\n'; ?>'d':<?php echo $rows->destination_city . '\n'; ?>'p':<?php echo $rows->pieces . '\n'; ?>'w':<?php echo ceil($rows->weight) . '\n'; ?>'cod':<?php echo $rows->cod_amount; ?>|'cus':<?php echo $rows->customer_id; ?>|'sh':'<?php echo $rows->shipper_name; ?>'|'sa':'<?php echo $rows->shipper_address; ?>'|'sp':'<?php echo $rows->shipper_phone; ?>'|'co':'<?php echo $rows->consignee_name; ?>'|'ca':'<?php echo $rows->consignee_address; ?>'|'cp':'<?php echo $rows->consignee_mobile; ?>'|'pd':'<?php echo $rows->product_detail; ?>'|'r':'<?php echo $rows->order_remarks; ?>'");
            qrcode_3.makeCode("Booking Date :<?php echo date('d-M-Y', strtotime($rows->order_date)) . '\n' ?>'Cn':<?php echo $rows->order_code . '\n' ?>s:<?php echo $rows->order_service_type . '\n' ?>o:<?php echo $rows->origin_city . '\n'; ?>'d':<?php echo $rows->destination_city . '\n'; ?>'p':<?php echo $rows->pieces . '\n'; ?>'w':<?php echo ceil($rows->weight) . '\n'; ?>'cod':<?php echo $rows->cod_amount; ?>|'cus':<?php echo $rows->customer_id; ?>|'sh':'<?php echo $rows->shipper_name; ?>'|'sa':'<?php echo $rows->shipper_address; ?>'|'sp':'<?php echo $rows->shipper_phone; ?>'|'co':'<?php echo $rows->consignee_name; ?>'|'ca':'<?php echo $rows->consignee_address; ?>'|'cp':'<?php echo $rows->consignee_mobile; ?>'|'pd':'<?php echo $rows->product_detail; ?>'|'r':'<?php echo $rows->order_remarks; ?>'");
            qrcode_4.makeCode("Booking Date :<?php echo date('d-M-Y', strtotime($rows->order_date)) . '\n' ?>'Cn':<?php echo $rows->order_code . '\n' ?>s:<?php echo $rows->order_service_type . '\n' ?>o:<?php echo $rows->origin_city . '\n'; ?>'d':<?php echo $rows->destination_city . '\n'; ?>'p':<?php echo $rows->pieces . '\n'; ?>'w':<?php echo ceil($rows->weight) . '\n'; ?>'cod':<?php echo $rows->cod_amount; ?>|'cus':<?php echo $rows->customer_id; ?>|'sh':'<?php echo $rows->shipper_name; ?>'|'sa':'<?php echo $rows->shipper_address; ?>'|'sp':'<?php echo $rows->shipper_phone; ?>'|'co':'<?php echo $rows->consignee_name; ?>'|'ca':'<?php echo $rows->consignee_address; ?>'|'cp':'<?php echo $rows->consignee_mobile; ?>'|'pd':'<?php echo $rows->product_detail; ?>'|'r':'<?php echo $rows->order_remarks; ?>'");
        }
    </script>
    <script>
        $(document).ready(function() {
            makeCode();
        });
    </script>
</body>

</html>