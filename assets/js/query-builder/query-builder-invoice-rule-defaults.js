var ruleRowCounter=0;
var loadedRule=null;
var defaultInvoiceRule = {
  readonly : true,
  condition: 'AND',
//	flags:{
//	  condition_readonly: true,
//	  no_add_rule: true,
//	  no_add_group: true,
//	  no_delete: true
//	},
  data: {
        root: true
      },
  rules: [
  {
    id: 'invoice_type',
    operator: 'equal',
    value: 1,
	//readonly:true,
	flags: {
		filter_readonly: true,
		operator_readonly: true,
		//value_readonly: true,
		no_delete: true 
		}
  },
  {
    id: 'invoice_month',
    operator: 'equal',
    value: 0,
	flags: {
		filter_readonly: true,
		operator_readonly: true,
		//value_readonly: true,
		no_delete: true 
		}
  }, 
  {
    id: 'is_gst',
    operator: 'equal',
    value: 1,
	flags: {
		filter_readonly: true,
		operator_readonly: true,
		//value_readonly: true,
		no_delete: true 
		}
  }, 
  {
	condition: 'AND',
	readonly : true,
	flags:{
		condition_readonly: true,
		no_delete: true,
		  no_add_rule: false,
		  no_add_group: false,
	},
    rules: []
	
  }
  ]
};

$('#query-builder').queryBuilder({

  filters: [
  {
    id: 'invoice_type',
    label: 'Invoice Type',
    type: 'integer',
    input: 'select',
    values: {
		1:'Weight',2:'Per Piece',3:'Fix'
    },
    operators: ['equal']
  },
  {
    id: 'invoice_month',
    label: 'Invoice Month',
    type: 'integer',
    input: 'select',
    values: {
		13:'Past',0:'Current',1:'Jan',2:'Feb',3:'Mar',4:'Apr',5:'May',6:'June',7:'July',8:'Aug',9:'Sept',10:'Oct',11:'Nov',12:'Dec'
    },
    operators: ['equal']
  },
  {
    id: 'is_gst',
    label: 'GST',
    type: 'integer',
    input: 'radio',
    values: {
      1: 'Yes',
      0: 'No'
    },
    operators: ['equal']
  },
  {
    id: 'origin_city',
    label: 'Origin',
    type: 'integer',
    input: 'select',
    values: {
		127:'ABT', 37:'AFA', 36:'AIP', 31:'AKM', 34:'APC', 33:'APE', 38:'ATK', 232:'BDN', 43:'BHK', 223:'BHM', 15:'BHV', 224:'BMK', 39:'BNG', 128:'BNP', 42:'BPI', 46:'BRA', 45:'BRW', 41:'BSP', 44:'BWL', 178:'CCW', 52:'CHA', 129:'CHD', 49:'CHG', 50:'CHN', 51:'CHS', 53:'CHU', 48:'CKL', 25:'CWD', 208:'DAY', 145:'DDU', 185:'DDU KNS', 56:'DGK', 130:'DIK', 58:'DIN', 57:'DJK', 146:'DKI', 222:'DLL', 209:'DMJ', 238:'DNB', 231:'DNG', 55:'DPL', 12:'DSK', 239:'FGI', 59:'FOL', 61:'FPR', 167:'FQD', 251:'FRZ', 5:'FSD', 285:'FTA', 60:'FTS', 300:'FZR', 147:'GBT', 220:'GDN', 206:'GDU', 192:'GGR', 62:'GHK', 23:'GJK', 63:'GRA', 19:'GRT', 148:'GTI', 6:'GUJ', 202:'GYN', 64:'HBD', 8:'HDD', 65:'HFZ', 68:'HLK', 294:'HMA', 66:'HRB', 131:'HRP', 240:'HRP', 69:'HSM', 132:'HSN', 67:'HSP', 218:'HTR', 235:'ILB', 4:'ISB', 149:'JCB', 72:'JHN', 74:'JLM', 257:'JMP', 290:'JMS', 73:'JNG', 70:'JPJ', 252:'JPPW', 75:'JRB', 71:'JRW', 189:'KAK', 216:'KBA', 76:'KBR', 203:'KDK', 229:'KDW', 84:'KHB', 2:'KHI', 196:'KHI', 207:'KHI', 151:'KHM', 152:'KHP', 214:'KHP', 47:'KHR', 168:'KKG', 180:'KKM', 226:'KLB', 286:'KLG', 269:'KLL', 79:'KMK', 78:'KML', 295:'KMR', 297:'KMR', 247:'KMT', 246:'KNG', 150:'KNP', 233:'KNR', 134:'KOL', 77:'KPC', 301:'KPR', 83:'KRH', 82:'KRN', 166:'KSK', 80:'KSR', 271:'KSW', 85:'KTD', 86:'KTK', 253:'KTM', 296:'KTSB', 293:'KUD', 81:'KWL', 1:'LHE', 87:'LLM', 298:'LMT', 90:'LOD', 89:'LQP', 153:'LRK', 88:'LYY', 96:'MAB', 21:'MBD', 94:'MCN', 97:'MDK', 136:'MDN', 260:'MDS', 187:'ME', 284:'MGJ', 186:'MHR', 137:'MIN', 181:'MKL', 236:'MLK', 91:'MLS', 92:'MMD', 200:'MMO', 201:'MMO', 95:'MND', 93:'MNI', 135:'MNS', 262:'MNW', 155:'MPK', 193:'MPR', 154:'MRO', 169:'MSD', 266:'MSG', 7:'MUX', 139:'MZB', 99:'MZG', 184:'NFZ', 100:'NKN', 140:'NOW', 250:'NSV', 30:'NWL', 156:'NWS', 133:'OHT', 102:'OKA', 299:'PBT', 9:'PEW', 106:'PHL', 107:'PHN', 195:'PJG', 141:'PMA', 108:'PML', 157:'PNQ', 103:'PPK', 254:'PPN', 28:'PSR', 105:'PTI', 287:'QDS', 258:'QMB', 138:'QML', 109:'RBW', 188:'RDH', 280:'RJN', 248:'RJP', 278:'RLT', 110:'RND', 111:'RNK', 191:'RPR', 276:'RRI', 190:'RTD', 3:'RWP', 17:'RYK', 210:'SBI', 159:'SDPR', 165:'SDR', 13:'SGD', 115:'SGH', 241:'SGJ', 158:'SHH', 121:'SHJ', 118:'SHK', 160:'SHP', 116:'SHT', 24:'SHW', 29:'SKGH', 120:'SKP', 161:'SKZ', 14:'SLT', 113:'SMB', 114:'SMD', 227:'SNG', 256:'SPR', 283:'SPR', 112:'SQD', 183:'SRI', 143:'SWB', 22:'SWL', 142:'SWT', 163:'TAY', 268:'TDJ', 162:'TDO', 212:'TDW', 164:'THT', 237:'TKB', 123:'TLG', 249:'TLW', 217:'TMA', 170:'TMG', 197:'TMH', 259:'TMK', 228:'TNK', 242:'TSS', 125:'TTS', 124:'TXL', 10:'UET', 225:'UHS', 211:'UMD', 234:'UMK', 219:'UN', 126:'VRI', 270:'WHA', 144:'WHC', 20:'WZB', 18:'ZFW'
    },
    operators: ['equal', 'not_equal']
  },
  {
    id: 'destination_city',
    label: 'Destination',
    type: 'integer',
    input: 'select',
    values: {
		127:'ABT', 37:'AFA', 36:'AIP', 31:'AKM', 34:'APC', 33:'APE', 38:'ATK', 232:'BDN', 43:'BHK', 223:'BHM', 15:'BHV', 224:'BMK', 39:'BNG', 128:'BNP', 42:'BPI', 46:'BRA', 45:'BRW', 41:'BSP', 44:'BWL', 178:'CCW', 52:'CHA', 129:'CHD', 49:'CHG', 50:'CHN', 51:'CHS', 53:'CHU', 48:'CKL', 25:'CWD', 208:'DAY', 145:'DDU', 185:'DDU KNS', 56:'DGK', 130:'DIK', 58:'DIN', 57:'DJK', 146:'DKI', 222:'DLL', 209:'DMJ', 238:'DNB', 231:'DNG', 55:'DPL', 12:'DSK', 239:'FGI', 59:'FOL', 61:'FPR', 167:'FQD', 251:'FRZ', 5:'FSD', 285:'FTA', 60:'FTS', 300:'FZR', 147:'GBT', 220:'GDN', 206:'GDU', 192:'GGR', 62:'GHK', 23:'GJK', 63:'GRA', 19:'GRT', 148:'GTI', 6:'GUJ', 202:'GYN', 64:'HBD', 8:'HDD', 65:'HFZ', 68:'HLK', 294:'HMA', 66:'HRB', 131:'HRP', 240:'HRP', 69:'HSM', 132:'HSN', 67:'HSP', 218:'HTR', 235:'ILB', 4:'ISB', 149:'JCB', 72:'JHN', 74:'JLM', 257:'JMP', 290:'JMS', 73:'JNG', 70:'JPJ', 252:'JPPW', 75:'JRB', 71:'JRW', 189:'KAK', 216:'KBA', 76:'KBR', 203:'KDK', 229:'KDW', 84:'KHB', 2:'KHI', 196:'KHI', 207:'KHI', 151:'KHM', 152:'KHP', 214:'KHP', 47:'KHR', 168:'KKG', 180:'KKM', 226:'KLB', 286:'KLG', 269:'KLL', 79:'KMK', 78:'KML', 295:'KMR', 297:'KMR', 247:'KMT', 246:'KNG', 150:'KNP', 233:'KNR', 134:'KOL', 77:'KPC', 301:'KPR', 83:'KRH', 82:'KRN', 166:'KSK', 80:'KSR', 271:'KSW', 85:'KTD', 86:'KTK', 253:'KTM', 296:'KTSB', 293:'KUD', 81:'KWL', 1:'LHE', 87:'LLM', 298:'LMT', 90:'LOD', 89:'LQP', 153:'LRK', 88:'LYY', 96:'MAB', 21:'MBD', 94:'MCN', 97:'MDK', 136:'MDN', 260:'MDS', 187:'ME', 284:'MGJ', 186:'MHR', 137:'MIN', 181:'MKL', 236:'MLK', 91:'MLS', 92:'MMD', 200:'MMO', 201:'MMO', 95:'MND', 93:'MNI', 135:'MNS', 262:'MNW', 155:'MPK', 193:'MPR', 154:'MRO', 169:'MSD', 266:'MSG', 7:'MUX', 139:'MZB', 99:'MZG', 184:'NFZ', 100:'NKN', 140:'NOW', 250:'NSV', 30:'NWL', 156:'NWS', 133:'OHT', 102:'OKA', 299:'PBT', 9:'PEW', 106:'PHL', 107:'PHN', 195:'PJG', 141:'PMA', 108:'PML', 157:'PNQ', 103:'PPK', 254:'PPN', 28:'PSR', 105:'PTI', 287:'QDS', 258:'QMB', 138:'QML', 109:'RBW', 188:'RDH', 280:'RJN', 248:'RJP', 278:'RLT', 110:'RND', 111:'RNK', 191:'RPR', 276:'RRI', 190:'RTD', 3:'RWP', 17:'RYK', 210:'SBI', 159:'SDPR', 165:'SDR', 13:'SGD', 115:'SGH', 241:'SGJ', 158:'SHH', 121:'SHJ', 118:'SHK', 160:'SHP', 116:'SHT', 24:'SHW', 29:'SKGH', 120:'SKP', 161:'SKZ', 14:'SLT', 113:'SMB', 114:'SMD', 227:'SNG', 256:'SPR', 283:'SPR', 112:'SQD', 183:'SRI', 143:'SWB', 22:'SWL', 142:'SWT', 163:'TAY', 268:'TDJ', 162:'TDO', 212:'TDW', 164:'THT', 237:'TKB', 123:'TLG', 249:'TLW', 217:'TMA', 170:'TMG', 197:'TMH', 259:'TMK', 228:'TNK', 242:'TSS', 125:'TTS', 124:'TXL', 10:'UET', 225:'UHS', 211:'UMD', 234:'UMK', 219:'UN', 126:'VRI', 270:'WHA', 144:'WHC', 20:'WZB', 18:'ZFW'
    },
    operators: ['equal', 'not_equal']
  }
  
  ],
  rules: defaultInvoiceRule//loadedRule//defaultRule
  //,
  //rules: defaultRule,
  //flags: {
  //filter_readonly: true,
  //operator_readonly: true,
  //value_readonly: true,
  //no_delete: true },
});


$('#btn-back').on('click', function() {
	
	//debugger;
	var nresult = setAllReadOnly(loadedRule, true);
	//Workaround Begin to remove empty blocks in new rule
	//var currentRule = getInvoiceJSON();
	//nresult = currentRule;
	//Workaround End
	$('#is_cancel').val(1);
  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);
	$( "#invoice_rule_name" ).removeAttr('required');
	$( "#invoice_rule_name" ).attr("readonly","readonly");
	$( "#invoice_rule_name" ).val(invoice_rule_name);
	$( "#btn-back" ).removeClass( "hide" );
	$( "#btn-edit" ).removeClass( "hide" );
	$( "#btn-save" ).addClass( "hide" );
	$( "#btn-cancel" ).addClass( "hide" );
	
	  $('#rule_form').submit();
});

$('#btn-edit').on('click', function() {

	if (loadedRule == null) 
		{ loadedRule = defaultInvoiceRule; }
	var nresult = setAllReadOnly(loadedRule, false);

  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);

	$( "#invoice_rule_name" ).removeAttr('readonly');
	$( "#btn-back" ).addClass( "hide" );
	$( "#btn-edit" ).addClass( "hide" );
	$( "#btn-save" ).removeClass( "hide" );
	$( "#btn-cancel" ).removeClass( "hide" );
});

$('#btn-cancel').on('click', function() {
	
	//debugger;
	var nresult = setAllReadOnly(loadedRule, true);
	//Workaround Begin to remove empty blocks in new rule
	//var currentRule = getInvoiceJSON();
	//nresult = currentRule;
	//Workaround End
	$('#is_cancel').val(1);
  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);
	$( "#invoice_rule_name" ).removeAttr('required');
	$( "#invoice_rule_name" ).attr("readonly","readonly");
	$( "#invoice_rule_name" ).val(invoice_rule_name);
	$( "#btn-back" ).removeClass( "hide" );
	$( "#btn-edit" ).removeClass( "hide" );
	$( "#btn-save" ).addClass( "hide" );
	$( "#btn-cancel" ).addClass( "hide" );
	
	  $('#rule_form').submit();
});

$('#btn-save').on('click', function() {
//debugger;
//alert('saving...');
$("#rule_form").validate();
var sErrors = $("#rule_form").validate().numberOfInvalids();
var txtRuleName = $( "#invoice_rule_name" ).val().trim();
if(txtRuleName != ""){

	$('#is_cancel').val(0);

	var currentRule = getInvoiceJSON();
	var nresult = setAllReadOnly(currentRule, true);
  //console.log(nresult);
  
  $('#invoice_rule_json').val(JSON.stringify(nresult));
  // Workaround being to geneate SQL with empty rules
  x =  $('#query-builder').queryBuilder('setRules', nresult);
  // Workaround End
  $('#invoice_rule_sql').val(getInvoiceSQL());
  
  
  
  $('#rule_form').submit();
  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);
	
	$( "#invoice_rule_name" ).attr("readonly","readonly");
	$( "#btn-back" ).removeClass( "hide" );
	$( "#btn-edit" ).removeClass( "hide" );
	$( "#btn-save" ).addClass( "hide" );
	$( "#btn-cancel" ).addClass( "hide" );
}
else
{
	$( "#invoice_rule_name_error" ).removeClass( "hide" );
	//$("#rule_form").validate()
}
});


$('#btn-reset').on('click', function() {
	var result = $('#query-builder').queryBuilder('getRules', {
		get_flags: true,
        skip_empty: true
    });
	var nresult = setAllReadOnly(result, false);
  console.log(nresult);
  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);  
});

$('#btn-set').on('click', function() {
  
  x =  $('#query-builder').queryBuilder('setRules', defaultRule);
  
});

$('#btn-mysql').on('click', function() {
  alert(getInvoiceSQL());
  //var result = $('#query-builder').queryBuilder('getSQL');
  ////alert(result);
  //if (!$.isEmptyObject(result)) {
  //  alert(JSON.stringify(result, null, 2));
  //}
});

$('#btn-json').on('click', function() {


	  var result = $('#query-builder').queryBuilder('getRules', {
        get_flags: true,
        skip_empty: true
      });
  //if (!$.isEmptyObject(result)) {
  //  alert(JSON.stringify(result, null, 2));
  //}
  //console.log(result);
  //debugger;
  //var nresult = JSON.stringify(setAllReadOnly(result, true), null, 2);
  var nresult = setAllReadOnly(result, true);
  ruleRowCounter=0;
  x =  $('#query-builder').queryBuilder('setRules', nresult);  
});



function setRuleJSON(rule, isReadOnly){
	ruleRowCounter=0;
	$('#query-builder').queryBuilder('setRules', setAllReadOnly(rule,isReadOnly));  
};

function getInvoiceJSON(){

	var result = $('#query-builder').queryBuilder('getRules', {
        get_flags: true,
        skip_empty: true
      });
	return result;
};

function getInvoiceSQL(){

	var result = $('#query-builder').queryBuilder('getSQL');
	return JSON.stringify(result, null, 2);
};


function setAllReadOnly(item, value){

	var level = 0;
	var result =  setReadOnly(item, value, level);
	return result;
};

function setReadOnly(item, value, level){
	if(item)
	{
		var containsCondition = false;
		if(isCondition(item))
		{
			setConditionReadOnly(item, value,level++)
			
			if(item.rules && item.rules.length)
			{
				for (var i = 0; i < item.rules.length; i++) {

					if(isCondition(item.rules[i]))
					{
						containsCondition = true;
						setReadOnly(item.rules[i], value, level);
					}
					else
					{
						setRuleReadOnly(item.rules[i], value,level);
					}

				}
			}
		}
		if(level == 1 && !containsCondition && !value)
		{
			item.rules.push({
				condition: 'AND',
				readonly : true,
				flags:{
					condition_readonly: true,
					no_delete: true,
					no_add_rule: false,
					no_add_group: false,
				},
				rules: []
			});
		}
	}
	return item;
};

function setConditionReadOnly(item, value ,level){
	
	if(level == 0)
	{
		item.readonly = value;
		item.flags = {
		  condition_readonly: true,
		  no_add_rule: true,
		  no_add_group: true,
		  no_delete: true
		};
	}
	else if(level == 1)
	{
		item.readonly = value;
		item.flags = {
		  condition_readonly: true,
		  no_add_rule: value,
		  no_add_group: value,
		  no_delete: true
		};
	}
	else
	{
		item.readonly = value;
		item.flags = {
		  condition_readonly: value,
		  no_add_rule: value,
		  no_add_group: value,
		  no_delete: value
		};
	}
};

function setRuleReadOnly(item, value ,level){
	
	if(level == 1)
	{
		item.readonly = value;
		item.flags = {
			filter_readonly: true,
			operator_readonly: true,
			value_readonly: value,
			no_delete: true 
		};
	}
	else
	{
		item.readonly = value;
		item.flags = {
			filter_readonly: value,
			operator_readonly: value,
			value_readonly: value,
			no_delete: value 
		};
	}
};

function isCondition(item){
	if(item["condition"]){
		return true;
	}
	return false;
};
