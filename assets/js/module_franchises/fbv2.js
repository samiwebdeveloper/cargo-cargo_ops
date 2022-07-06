var cities = {
		127:'ABT', 37:'AFA', 36:'AIP', 31:'AKM', 34:'APC', 33:'APE', 38:'ATK', 232:'BDN', 43:'BHK', 223:'BHM', 15:'BHV', 224:'BMK', 39:'BNG', 128:'BNP', 42:'BPI', 46:'BRA', 45:'BRW', 41:'BSP', 44:'BWL', 178:'CCW', 52:'CHA', 129:'CHD', 49:'CHG', 50:'CHN', 51:'CHS', 53:'CHU', 48:'CKL', 25:'CWD', 208:'DAY', 145:'DDU', 185:'DDU KNS', 56:'DGK', 130:'DIK', 58:'DIN', 57:'DJK', 146:'DKI', 222:'DLL', 209:'DMJ', 238:'DNB', 231:'DNG', 55:'DPL', 12:'DSK', 239:'FGI', 59:'FOL', 61:'FPR', 167:'FQD', 251:'FRZ', 5:'FSD', 285:'FTA', 60:'FTS', 300:'FZR', 147:'GBT', 220:'GDN', 206:'GDU', 192:'GGR', 62:'GHK', 23:'GJK', 63:'GRA', 19:'GRT', 148:'GTI', 6:'GUJ', 202:'GYN', 64:'HBD', 8:'HDD', 65:'HFZ', 68:'HLK', 294:'HMA', 66:'HRB', 131:'HRP', 240:'HRP', 69:'HSM', 132:'HSN', 67:'HSP', 218:'HTR', 235:'ILB', 4:'ISB', 149:'JCB', 72:'JHN', 74:'JLM', 257:'JMP', 290:'JMS', 73:'JNG', 70:'JPJ', 252:'JPPW', 75:'JRB', 71:'JRW', 189:'KAK', 216:'KBA', 76:'KBR', 203:'KDK', 229:'KDW', 84:'KHB', 2:'KHI', 196:'KHI', 207:'KHI', 151:'KHM', 152:'KHP', 214:'KHP', 47:'KHR', 168:'KKG', 180:'KKM', 226:'KLB', 286:'KLG', 269:'KLL', 79:'KMK', 78:'KML', 295:'KMR', 297:'KMR', 247:'KMT', 246:'KNG', 150:'KNP', 233:'KNR', 134:'KOL', 77:'KPC', 301:'KPR', 83:'KRH', 82:'KRN', 166:'KSK', 80:'KSR', 271:'KSW', 85:'KTD', 86:'KTK', 253:'KTM', 296:'KTSB', 293:'KUD', 81:'KWL', 1:'LHE', 87:'LLM', 298:'LMT', 90:'LOD', 89:'LQP', 153:'LRK', 88:'LYY', 96:'MAB', 21:'MBD', 94:'MCN', 97:'MDK', 136:'MDN', 260:'MDS', 187:'ME', 284:'MGJ', 186:'MHR', 137:'MIN', 181:'MKL', 236:'MLK', 91:'MLS', 92:'MMD', 200:'MMO', 201:'MMO', 95:'MND', 93:'MNI', 135:'MNS', 262:'MNW', 155:'MPK', 193:'MPR', 154:'MRO', 169:'MSD', 266:'MSG', 7:'MUX', 139:'MZB', 99:'MZG', 184:'NFZ', 100:'NKN', 140:'NOW', 250:'NSV', 30:'NWL', 156:'NWS', 133:'OHT', 102:'OKA', 299:'PBT', 9:'PEW', 106:'PHL', 107:'PHN', 195:'PJG', 141:'PMA', 108:'PML', 157:'PNQ', 103:'PPK', 254:'PPN', 28:'PSR', 105:'PTI', 287:'QDS', 258:'QMB', 138:'QML', 109:'RBW', 188:'RDH', 280:'RJN', 248:'RJP', 278:'RLT', 110:'RND', 111:'RNK', 191:'RPR', 276:'RRI', 190:'RTD', 3:'RWP', 17:'RYK', 210:'SBI', 159:'SDPR', 165:'SDR', 13:'SGD', 115:'SGH', 241:'SGJ', 158:'SHH', 121:'SHJ', 118:'SHK', 160:'SHP', 116:'SHT', 24:'SHW', 29:'SKGH', 120:'SKP', 161:'SKZ', 14:'SLT', 113:'SMB', 114:'SMD', 227:'SNG', 256:'SPR', 283:'SPR', 112:'SQD', 183:'SRI', 143:'SWB', 22:'SWL', 142:'SWT', 163:'TAY', 268:'TDJ', 162:'TDO', 212:'TDW', 164:'THT', 237:'TKB', 123:'TLG', 249:'TLW', 217:'TMA', 170:'TMG', 197:'TMH', 259:'TMK', 228:'TNK', 242:'TSS', 125:'TTS', 124:'TXL', 10:'UET', 225:'UHS', 211:'UMD', 234:'UMK', 219:'UN', 126:'VRI', 270:'WHA', 144:'WHC', 20:'WZB', 18:'ZFW'
    };
var routes = {
		'HALL ROAD':'HALL ROAD', 'ops123':'Airport', 'RND MUX':'RD/RND RD', 'Ops121':'Emporium, Iqbal Town', 'OPS-001':'SHEIKHUPURA ROAD', 'Ops1122':'Ferozpure road/Gajumata', 'Ops 1212':'Kot Lakhpath', '880':'Raiwind', '000000':'SELF COLLECTION', 'OPS':'Operations', 'Manga Mandi':'Manga Mandi', 'Multan Road':'Multan Road', 'GUBERG':'Gulberg', 'Shalimar':'Shalimar', 'DHA,PKG':'DHA,PKG', 'Samanabad':'samanabad'
	};

$(document).ready(function() {	
	
	imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
	$('.allow-multi-select').select2();

	$(".on-page-view").hide();
	$(".on-page-edit").hide();
	
	$(".on-page-edit").addClass("hide");
	
	$(".form-control").on("keydown",function(e){

		 if(e.which === 13) {

			var inputs = $(".form-control");
                var idx = inputs.index(this);
				
                if (idx == inputs.length - 1) {
                    inputs[0].select();
                } else {

					if(inputs[idx+1].classList.contains("allow-multi-select"))
					{
						if(inputs[idx].classList.contains("select2-input"))
						{
							$("#"+inputs[idx-1].id).select2('close');
							inputs[idx + 2].focus();
						}
						else
						{
							$("#"+inputs[idx+1].id).select2('focus');
						}
					}
					else
					{
						inputs[idx + 1].focus();
					}
                }
                return false;
			}
	});
	
	$(".collapse").on("show.bs.collapse", function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
	});
	
	$(".repeat-target").on("click", function(){
		var control_id = $(this).attr("repeatable-target");
		$(this).closest("#"+control_id).clone(true).insertAfter($(this).closest("#"+control_id));
	});
	
	$(".remove-target").on("click", function(){
		var control_id = $(this).attr("remove-target");
		$(this).closest("#"+control_id).remove();
	});
	
	var today = new Date();
	
	$("#date_of_registration").attr("min", today.getFullYear()+"-01-01");
	$("#date_of_registration").attr("max", today.toISOString().slice(0, 10));
	$("#date_of_registration").val(today.toISOString().slice(0, 10));
	
	
	$("#agreement_expiry").attr("min", today.toISOString().slice(0, 10));
	$("#agreement_expiry").val(today.toISOString().slice(0, 10));
	
	var citylist = '';
	$.each(cities, function(key, value){
		citylist += '<option value=' + key + '>' + value + '</option>';
	});
	
	$("#service_area").html(citylist);
	$("#delivery_location").html(citylist);
	
	$("#parent").html(citylist);
	$("#city").html(citylist);
	
	var routelist = '';
	$.each(routes, function(key, value){
		routelist += '<option value=' + key + '>' + value + '</option>';
	});
	
	$("#route").html(routelist);

	$(".land-line").attr("maxlength", 12);	
	$(".land-line").keyup(function() {
		$(this).val($(this).val().replace(/\D/g,'').replace(/^(\d{3})(\d{8})$/, "$1-$2"));
	});
	
	$(".mobile-no").attr("maxlength", 12);	
	$(".mobile-no").keyup(function() {
		$(this).val($(this).val().replace(/\D/g,'').replace(/^(\d{4})(\d{7})$/, "$1-$2"));
	});
	
	$(".tax-no").attr("maxlength", 9);	
	$(".tax-no").keyup(function() {
		$(this).val($(this).val().replace(/\D/g,'').replace(/^(\d{7})(\d{1})$/, "$1-$2"));
	});
	
	$(".nic").attr("maxlength", 15);	
	$(".nic").keyup(function() {
		$(this).val($(this).val().replace(/\D/g,'').replace(/^(\d{5})(\d{7})(\d{1})$/, "$1-$2-$3"));
	});
	/*
	$( "#save" ).on( "click", function() {
		$(".on-page-view").show();
		$(".on-page-edit").hide();
		$(".form-control").attr('readonly', true);
		//$('#id').attr('readonly', true);
	});
	
	$( "#cancel" ).on( "click", function() {
		$(".on-page-view").hide();
		$(".on-page-edit").show();
		$(".form-control").attr('readonly', false);
		//$('#id').attr('readonly', true);
	});
	
	$( ".on-page-view" ).on( "click", function() {
		console.log($(this));
		debugger
		//$("#"+$(this).attr("for")).attr('readonly', false);
		$(this).parent().find(".form-control").attr('readonly', false);
		//$(".on-page-view").show();
		
		//$(".on-page-edit").hide();
		//$(".form-control").attr('readonly', true);
		
		
		
		//$('#id').attr('readonly', true);
	});
	*/
});













