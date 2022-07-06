var firstDayOfPriorMonth;
var lastDayOfPriorMonth;
var today;
$(document).ready(function() {
	//debugger
	$('.allow-multi-select').select2();

	document.getElementById("customer").focus();
	$('#data_panel').saimtech();
	$('#pending_panel').saimtech();
	
	var today = new Date();
	firstDayOfPriorMonth = new Date(today.getFullYear(), today.getMonth()-1, 2);
	lastDayOfPriorMonth = new Date(today.getFullYear(), today.getMonth(), 1);
	
	$("#invoice_date").attr("min", firstDayOfPriorMonth.toISOString().slice(0, 10));
	$("#invoice_date").attr("max", today.toISOString().slice(0, 10));
	$("#invoice_date").val(firstDayOfPriorMonth.toISOString().slice(0, 10));
	
	$("#invoice_date_f").attr("min", firstDayOfPriorMonth.toISOString().slice(0, 10));
	$("#invoice_date_f").attr("max", today.toISOString().slice(0, 10));
	$("#invoice_date_f").val(lastDayOfPriorMonth.toISOString().slice(0, 10));
});

$("#invoice_date").change(function(e){	
	$("#invoice_date_f").attr("min", this.value);
});

$("#invoice_date_f").change(function(e){	
	$("#invoice_date").attr("max", this.value);
});


var customer_ids=[];

var invoice = [];

var invoice_summary = [];

var loading_invoices = 0;

var loaded_invoices = 0;

var buggy_invoices = 0;

$('#apply').click(function(e) {
	
	if(isValidate()){
		
		loaded_invoices = 0;
		loading_invoices = 0;
		buggy_invoices = 0;
		
		$('#section_filters').addClass("hide");
		$('#section_optionals').removeClass("hide");
		$('#section_invoices').removeClass("hide");
		$( "#customers_invoice" ).html("");
		var current_root = location.href.slice(0,location.href.lastIndexOf("/"));
		var customer_list = $("#customer").val();
		
		var origin = $("#origin").val();
		origin = (origin == null || origin == "") ? ("") : (origin.toString());
		
		var destination = $("#destination").val();
		destination = (destination == null || destination == "") ? ("") : (destination.toString());
		
		var invoice_date = $("#invoice_date").val();
		
		var invoice_date_f = $("#invoice_date_f").val();
		
		invoice = [];
		
		invoice_summary = [];
		
		var index = 0;
		for (index = 0; index < customer_list.length; index++) {
				
	  		var val = customer_list[index];
			var sel_option = $("#customer option[value='"+val+"']");
			var txt = sel_option.text();//$("#customer option[value='"+val+"']").text();
			var gst = sel_option.data("gst");//$("#customer option[value='"+val+"']").text();
				
				var cust_data = {
						customer: val,
						customer_name:txt,
						//invoice_code: index,//invoice_code,
						invoice_date: invoice_date,
						invoice_date_f: invoice_date_f,
						origin: origin,
						destination: destination,
						gst:gst
					};
					
						loading_invoices++;
					$.ajax({
						url: current_root+"/cn_data_list",
						type: "POST",
						data: cust_data,
						success: function(data) {
							//debugger
							$( "#customers_invoice" ).append(data);	
							loaded_invoices++;
							var ptage = Math.round((loaded_invoices/loading_invoices)*100);
							$("#pbar").css("width", ptage+"%");
							$("#pbar").html(loaded_invoices+"/"+loading_invoices);
							
							if(ptage == 100)
							{
								onLoadComplete();
							}
							
							//console.log("loading:"+loading_invoices+" loaded:"+loaded_invoices+" Buggy:"+buggy_invoices);
						},
						error: function(data) {
							buggy_invoices++;
						}
					});
					//document.getElementById("cp_inv").focus();
					//--------------------------------End
	
	
	
	
			};
			
			//console.log("Done");
	}
});



$('#save').click(function(e) {
	//console.log("Saving");
	//var current_root = location.href.slice(0,location.href.lastIndexOf("/"));
	var customer_list = $("#customer").val();
	
	var index = 0;
	//loaded_invoices = 0;
	for (index = 0; index < customer_list.length; index++) {
		
		var val = customer_list[index];
		var invoice = $("#invoice_"+val).val();//$("#customer option[value='"+val+"']");
		var gst = $("#gst_"+val).val();
		
		complete_invoice(val, invoice, gst);
		
		}
	loaded_invoices = 0;
	loading_invoices = 0;
	buggy_invoices = 0;
	$("#pbar").css("width", "0%");
	//loading_invoices = index-1;
});

$('#cancel').click(function(e) {
	$('#section_filters').removeClass("hide");
	$('#section_optionals').addClass("hide");
	$('#section_invoices').addClass("hide");
	$('#customers_invoice').html("");
	$("#pbar").css("width", "0%");
	loaded_invoices = 0;
	loading_invoices = 0;
	buggy_invoices = 0;
	
});

function isValidate(){
	
	var valid = true;
	//------------Customer
	if ($("#customer").val() != "") {
		//customer = $("#customer").val();
		$("#customer_div").css("border-color", "rgba(0, 0, 0, 0.07)");
	} else {
		$("#customer_div").css("border-color", "red");
		$("#customer").focus();
		valid = false;
	}

	//------------Date
	if ($("#invoice_date").val() != "") {
		//invoice_date = $("#invoice_date").val();
		$("#invoice_date_div").css("border-color", "rgba(0, 0, 0, 0.07)");
	} else {
		$("#invoice_date_div").css("border-color", "red");
		$("#invoice_date").focus();
		valid = false;
	}



	//------------FDate
	if ($("#invoice_date_f").val() != "") {
		//invoice_date_f = $("#invoice_date_f").val();
		$("#invoice_date_f_div").css("border-color", "rgba(0, 0, 0, 0.07)");
	} else {
		$("#invoice_date_f_div").css("border-color", "red");
		$("#invoice_date_f").focus();
		valid = false;
	}
	
	return valid;
}

function remove_from_invoice(cn) {
	var current_root = location.href.slice(0,location.href.lastIndexOf("/"));
	var invoice_code = '<?php echo $invoice_code; ?>';
	var invoice_date = '';
	var invoice_date_f = "";
	//------------Date
	if ($("#invoice_date").val() != "") {
		invoice_date = $("#invoice_date").val();
		$("#invoice_date_div").css("border-color", "rgba(0, 0, 0, 0.07)");
	} else {
		$("#invoice_date_div").css("border-color", "red");
		$("#invoice_date").focus();
		check = "Fail";
	}
	//------------FDate
	if ($("#invoice_date_f").val() != "") {
		invoice_date_f = $("#invoice_date_f").val();
		$("#invoice_date_f_div").css("border-color", "rgba(0, 0, 0, 0.07)");
	} else {
		$("#invoice_date_f_div").css("border-color", "red");
		$("#invoice_date_f").focus();
		check = "Fail";
	}
	//-------Checking Conditions---------
	var mydata = {
		cn: cn,
		invoice_code: invoice_code,
		invoice_date: invoice_date,
		invoice_date_f: invoice_date_f
	};
	$.ajax({
		url: current_root+"/release_from_invoice",
		type: "POST",
		data: mydata,
		success: function(data) {
			$("#autoload").html(data);
			$("#summary_data").html("");
			$.ajax({
				url: current_root+"/summary",
				type: "POST",
				data: mydata,
				success: function(data) {
					$("#summary_data").html(data);
				}
			});

		}
	});

}



function complete_invoice(customer, invoice_code, permission) {
	console.log("complete customer : "+customer+", invoice_code : "+invoice_code+", permission : "+ permission);
	var current_root = location.href.slice(0,location.href.lastIndexOf("/"));

	var discount_amount = getDefaultZero($("#discount_amount").val());
	var fuel_amount = getDefaultZero($("#fuel_amount").val());
	var other = $("#other").val();
	var other_amount = getDefaultZero($("#other_amount").val());
	var remark = $("#remark").val();


		var mydata = {
			customer: customer,
			permission: permission,
			invoice_code: invoice_code,
			other: other,
			discount_amount: discount_amount,
			other_amount: other_amount,
			fuel_amount: fuel_amount,
			remark: remark
		};
		$.ajax({
			url: current_root+"/complete_invoice",
			type: "POST",
			data: mydata,
			success: function(data) {
				//console.log("completed "+data);
				location.replace(current_root+"/create_invoice");
			},
			error: function(data) {
				//console.log("completed "+data);
				location.replace(current_root+"/create_invoice");
			}
		});
		$("#cn").val("");

}

function getDefaultZero(value){
	
	if(value == null || value == "")
		return 0;
	
	return value
}

function onLoadComplete(){
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
	});
}

