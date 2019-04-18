{*******************************************
	Lineitem for adding participant list
	@author: 		Rathina Ganesh And Aditya Harshey
	@date: 			27th May 2017
********************************************}
{if $view eq 'EditView'}
{literal}
<style type="text/css">
	#myModal tr td a:hover{
		cursor: pointer;
	}
</style>
<script>
var a;
var participant_array = [];
var addedlist = [];
var list = '';
var typeOfParticipant;
/* Author by Ashvin
   date:11-12-2018
   Reason: Round up amount
   Start
*/
function roundUp(num) {
  return Math.round(num);
}
/* Author by Ashvin
   date:11-12-2018
   Reason: Round up amount
   End
*/
$(document).ready(function(){
	// $('#subtotal_tax_amount, #cgst_c, #sgst_c, #ugst_c').blur(function(){
	// 	cal_from_sub();
	// });

	$('#igst_c').hide();
	$('#igst_c_label').hide();
	
	$('#cgst_c').hide();
	$('#cgst_c_label').hide();
	
	$('#sgst_c').hide();
	$('#sgst_c_label').hide();

	$('#ugst_c').hide();
	$('#ugst_c_label').hide();
	
	$('#tax_type_c').change(function(){
		taxDropdown();			
	});
	setTimeout(function(){
		clientType();
	}, 2500);
	$('#client_type_c').change(function(){
		clientType();			
	});

	selfSponsored();
	$('#self_sponsored_c,#invoice_type_c').on('click',function(){
		selfSponsored();
	});
	function selfSponsored(){
		if($("#self_sponsored_c").is(':checked') && $('#invoice_type_c').val() == 'Special'){
			$('#billing_account_label').parent().hide();
			$('#participant_c_label').parent().hide();
			$('#line_items_label').parent().hide();
			$('#self_sponsor_c_label').parent().show();

		}else{
			$('#participant_c_label').parent().show();
			$('#line_items_label').parent().show();
			$('#billing_account_label').parent().show();
			$('#self_sponsor_c_label').parent().hide();
		}
	}

	taxDropdown();

	function clientType(){
		var clientType = $('#client_type_c').val();
		if(clientType == 'Government Department'){
			$('#igst_c').hide();	
			$('#igst_c').val('');	
			$('#igst_c_label').hide();
			$('#cgst_c').hide();	
			$('#cgst_c').val('');	
			$('#cgst_c_label').hide();	
			$('#sgst_c').hide();	
			$('#sgst_c').val('');	
			$('#sgst_c_label').hide();
			$('#ugst_c').hide();
			$('#ugst_c').val('');
			$('#ugst_c_label').hide();	
			$("#tax_type_c option:selected").prop("selected", false);
			$('#tax_type_c').parent().parent().hide();
		}else{
			$('#tax_type_c').parent().parent().show();
		}
		if(clientType == 'Un-Registered Dealer'){
			$('#client_gst1_c').parent().parent().hide();
		}else{
			$('#client_gst1_c').parent().parent().show();
		}		
	}
	function taxDropdown(){
		var tax_type = $('#tax_type_c').val();

		if (jQuery.inArray( 'IGST', tax_type ) !== -1) {
				$('#igst_c').show();
				$('#igst_c_label').show();		
		}else{
				$('#igst_c').hide();	
				$('#igst_c').val('');	
				$('#igst_c_label').hide();				
		}

		if (jQuery.inArray( 'CGST', tax_type ) !== -1) {
				$('#cgst_c').show();	
				$('#cgst_c_label').show();	
		}else{
				$('#cgst_c').hide();	
				$('#cgst_c').val('');	
				$('#cgst_c_label').hide();	
		}

		if (jQuery.inArray( 'SGST', tax_type ) !== -1) {
				$('#sgst_c').show();	
				$('#sgst_c_label').show();	
		}else{
				$('#sgst_c').hide();	
				$('#sgst_c').val('');	
				$('#sgst_c_label').hide();				
		}

		if (jQuery.inArray( 'UGST', tax_type ) !== -1) {
				$('#ugst_c').show();	
				$('#ugst_c_label').show();	
		}else{
				$('#ugst_c').hide();
				$('#ugst_c').val('');
				$('#ugst_c_label').hide();				
		}
	}

	invoice_type();
	$('#invoice_type_c').change(function(){
		invoice_type();
	});

	function invoice_type(){
		var invoice_type = $('#invoice_type_c').val();
		
		if (invoice_type == 'Supplementary') {
			$('#accommodation_c').show();
			$('#accommodation_c_label').show();
            
			$('#living_allowance_c').show();
			$('#living_allowance_c_label').show();
            
            $('#other_reimbursement_c').show();
			$('#other_reimbursement_c_label').show();            
            
		}else{
			$('#accommodation_c').hide();
			$('#accommodation_c_label').hide();
            
			$('#living_allowance_c').hide();
			$('#living_allowance_c_label').hide();
           
            $('#other_reimbursement_c').hide();
			$('#other_reimbursement_c_label').hide();        							
		}
		if (invoice_type == 'Special') {
            $('#entry_1_c_label').parent().show();
			$('#entry_2_c_label').parent().show();
			$('#entry_3_c_label').parent().show(); 
            
		}else{

			$('#entry_1_c_label').parent().hide();
			$('#entry_2_c_label').parent().hide();
			$('#entry_3_c_label').parent().hide();
			   							
		}
	}
	
	$('.organisation').on('click blur',function(){
		$.ajax({
			type:'GET',
			url:'index.php?entryPoint=ajaxCall',
			data:{type:'getOrganisationAddr',orgid:$('#billing_account_id').val()},
			async:false,
			dataType:'json',
			beforeSend:function(){
			},
			complete:function(){
			},
			success:function(res)
			{
				$('#billing_address_street').val(res.data.billing_address_street);
				$('#billing_address_city').val(res.data.billing_address_city);
				$('#billing_address_state').val(res.data.billing_address_state);
				$('#billing_address_postalcode').val(res.data.billing_address_postalcode);
				$('#billing_address_country').val(res.data.billing_address_country);
				$('#client_gst1_c').val(res.data.client1_gst_c);
			}
		});
	});

	$('#btn_self_sponsor_c,#self_sponsor_c').on('blur',function(){
		$.ajax({
			type:'GET',
			url:'index.php?entryPoint=ajaxCall',
			data:{type:'getSelfSponsorOrganisationAddr',orgid:$('#contact_id_c').val()},
			async:false,
			dataType:'json',
			beforeSend:function(){
			},
			complete:function(){
			},
			success:function(res)
			{
				$('#billing_address_street').val(res.data.billing_address_street);
				$('#billing_address_city').val(res.data.billing_address_city);
				$('#billing_address_state').val(res.data.billing_address_state);
				$('#billing_address_postalcode').val(res.data.billing_address_postalcode);
				$('#billing_address_country').val(res.data.billing_address_country);
				$('#client_gst1_c').val(res.data.client1_gst_c);
			}
		});
	});
	
	
	$('#billing_account').attr('readonly',true);
	if($('input[name=record]').val() || $('#billing_account_id').val()){
		setTimeout(function(){
			fetchParticipant2();
		},2500);
		// pushParticipantList(participant_array,addedlist);
	}

	$('#participant_list_c_label').parent().hide();
	programmeType();
	$('#programme_type_c').on('change',function(){
		programmeType();
	});

	// $('#btn_project_aos_invoices_1_name,#project_aos_invoices_1_name,#billing_account,#btn_billing_account').on('blur change',function(){
		
	// });
	
	$('#btn_clr_billing_account').on('blur',function(){
		$('.list-group').html('');
		$('#no_of_participants_c').val(0);
		participant_array = [];		
		calculateAmount(participant_array,'ICTP',typeOfParticipant);	
	});	

	$('#myModal').on('hidden.bs.modal', function () {
		$('.list-group').html('');
	    fetchParticipant();// do something…
	})

	$('#btn_billing_account').on('blur',function(){
		fetchParticipant();
	});

	$('#currency_id_select').change(function(){
		fetchParticipant3();
	});

	// $('#discount_in_per_c').on('blur change',function(){
	// 	addParticipantList(participant_array);
	// });
	$('#no_of_participants_c').on('blur change',function(){
		calculateAmount(participant_array,'ICTP',typeOfParticipant);
	});
  	$('#participant_c').after('&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="addlist">Add</button>');
  	
  	$('#addlist').on('click',function(){
  		
  		var pname = $('#participant_c :selected').text();
  		var pid = $('#participant_c').val();
  		var type = $('#participant_c :selected').data('type');
  		var non_resident = 0;
			var resident = 0;
  		if(!pname){
  			alert('Please select the participant to add in list');
  			return;
  		}
  		//var participant_array = JSON.parse($('#participant_list_c').val());
  		//console.log(participant_array);
  		for(var x in participant_array){
  			if(participant_array.hasOwnProperty(x)){
  				if(participant_array[x].id == pid){
  					alert('Already '+participant_array[x].name+' has been added in the list');
  					return;
  				}
  			}
  		}
  		var participant_name = '';
  		var add_name = {
  			"name":pname,
  			"id":pid,
  			"type":type
  		};
  		//console.log('Ganesh');
  		participant_array.push(add_name);

  		addParticipantList(participant_array);

  		for(var x in participant_array){
  			if(participant_array.hasOwnProperty(x)){
  				if (participant_array[x].type != null && participant_array[x].type=="Residential") { resident++; }
				  	else if(participant_array[x].type != null && participant_array[x].type=="NonResidential"){ non_resident++; }
				  	else{ resident++; }
  			}
  		}

  		typeOfParticipant = {
				  			"non_resident":non_resident,
				  			"resident":resident
			};

			if ($('#programme_type_c').val() == 'Announced') {
				calculateAmount(participant_array,'AP',typeOfParticipant);				
			}else{
				calculateAmount(participant_array,'ICTP',typeOfParticipant);				
			}
			
  		$('#participant_list_c').val(JSON.stringify(participant_array));		
	});

		// $('.delete').on('click',function(){
		$(document).on('click','.delete',function(){
			var participant_array1 = participant_array;
	
			
			var non_resident = 0;
			var resident = 0;
			// console.log("existing list"+participant_array1);
			participant_array = [];
			$('#'+$(this).attr("id")).parent().hide();
			for (var x in participant_array1){
			  if (participant_array1.hasOwnProperty(x)){
			  	//console.log($(this).attr("id"));
			  	//console.log(new_participant_array[x].id);
			  	if(participant_array1[x].id != $(this).attr("id"))
			  	{
			  		var add_name = {
			  			"name":participant_array1[x].name,
			  			"id":participant_array1[x].id,
			  			"type": participant_array1[x].type
					};
				  	participant_array.push(add_name);
				  	if (participant_array1[x].type != null && participant_array1[x].type=="Residential") { resident++; }
				  	else if(participant_array1[x].type != null && participant_array1[x].type=="NonResidential"){ non_resident++; }
				  	else{ resident++; }
			  	}


			  }	
			}
	
			typeOfParticipant = {
				  			"non_resident":non_resident,
				  			"resident":resident
			};

			if ($('#programme_type_c').val() == 'Announced') {

				calculateAmount(participant_array,'AP',typeOfParticipant);				
			}else{
				calculateAmount(participant_array,'ICTP',typeOfParticipant);				
			}
			
			// calculateAmount(participant_array,'AP','');
			// console.log("New List"+participant_array);
			$('#participant_list_c').val(JSON.stringify(participant_array));				
		});

		$('#discount_in_per_c,#less_adjustments_c,#tax_type_c,#amount_1_c,#amount_2_c,#amount_3_c,#invoice_type_c,#client_type_c').on('change click',function(){
			var non_resident = 0;
			var resident = 0;
			for(var x in participant_array){
	  			if(participant_array.hasOwnProperty(x)){
	  				if (participant_array[x].type != null && participant_array[x].type=="Residential") { resident++; }
					  	else if(participant_array[x].type != null && participant_array[x].type=="NonResidential"){ non_resident++; }
					  	else{ resident++; }
	  			}
	  		}

	  		typeOfParticipant = {
					  			"non_resident":non_resident,
					  			"resident":resident
				};

				if ($('#programme_type_c').val() == 'Announced') {
					calculateAmount(participant_array,'AP',typeOfParticipant);				
				}else{
					calculateAmount(participant_array,'ICTP',typeOfParticipant);		
				}
		});
});

function loadOrganisations() {
	var	orgTable = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Organisation Name</th><th>Invoice Status</th> </tr> </thead> <tbody style="text-align:center !important">';

}

function programmeType(){
	if($("#self_sponsored_c").is(':checked') && $('#invoice_type_c').val() == 'Special'){
		$('#participant_c_label').parent().hide();
		$('#line_items_label').parent().hide();
		$('#no_of_participants_c_label').parent().hide();
	}
	else if($('#programme_type_c').val() == 'Announced'){
		$('#no_of_participants_c_label').parent().hide();
		$('#participant_c_label').parent().show();
		$('#line_items_label').parent().show();
	}else{
		// $('#participant_list_c').val('');
		$('#no_of_participants_c_label').parent().show();
		$('#participant_c_label').parent().hide();
		$('#line_items_label').parent().hide();
	}
}
var discount_eligibility = false;
function fetchParticipant3(){
	
	$.ajax({
		type:'GET',
		url:'index.php?entryPoint=ajaxCall',
		data:{type:'getparticipantlist',pid:$('#project_aos_invoices_1project_ida').val(),orgid:$('#billing_account_id').val(),currency:$('#currency_id_select').val()},
		async:false,
		dataType:'json',
		beforeSend:function(){
		},
		complete:function(){
		},
		success:function(res)
		{
			participant_array = [];
			var notAcceptedParticipants = [];
			if(res.Success){
				var options = '<option value=""></option>';
				$.each(res.data.name,function(k,v){
					var split = v.toString().split(",");

					options += '<option data-type="'+res.data.type_c[k]+'" value="'+split[1]+'">'+split[0]+'</option>';
			  		var add_name = {
			  			"name":split[0],
			  			"id":split[1],
			  			"type":res.data.type_c[k]
			  		};
			  		
			  		participant_array.push(add_name);
			  		if(res.data.nomination_status_c[k] != "Accepted"){
			  			notAcceptedParticipants.push(split[0]); 
			  			$('input[title=Save]').attr('disabled',true);
			  		}
			  		
				});
				if (notAcceptedParticipants.length) {
				  		alert("Please accept the following participant(s) to save the invoice'"+notAcceptedParticipants.join(",")+"'");
				}
				$('#participant_list_c').val(JSON.stringify(participant_array));

				$('#programme_fee_c').val(parseFloat(res.data.programme_fee_c[0]).toFixed(2));
				$('#programme_fee_non_res_c').val(parseFloat(res.data.programme_fee_non_res_c[0]).toFixed(2));
				
				$('#participant_c').html(options);
		  		
				pushParticipantListAuto3(participant_array,addedlist);

				if (res.discount) {
					discount_eligibility = true;
				}

			}else{
				$('#participant_c').html('');
				$('#programme_fee_c').val('');
			}
		}
	});
	
}	


function fetchParticipant2(){
	
	$.ajax({
		type:'GET',
		url:'index.php?entryPoint=ajaxCall',
		data:{type:'getparticipantlist',pid:$('#project_aos_invoices_1project_ida').val(),orgid:$('#billing_account_id').val(),currency:$('#currency_id_select').val()},
		async:false,
		dataType:'json',
		beforeSend:function(){
		},
		complete:function(){
		},
		success:function(res)
		{
			participant_array = [];
			var notAcceptedParticipants = [];
			if(res.Success){
				var options = '<option value=""></option>';
				$.each(res.data.name,function(k,v){
					var split = v.toString().split(",");

					options += '<option data-type="'+res.data.type_c[k]+'" value="'+split[1]+'">'+split[0]+'</option>';
			  		var add_name = {
			  			"name":split[0],
			  			"id":split[1],
			  			"type":res.data.type_c[k]
			  		};
			  		
			  		participant_array.push(add_name);
			  		if(res.data.nomination_status_c[k] != "Accepted"){
			  			notAcceptedParticipants.push(split[0]); 
			  			$('input[title=Save]').attr('disabled',true);
			  		}
			  		
				});
				if (notAcceptedParticipants.length) {
				  		alert("Please accept the following participant(s) to save the invoice'"+notAcceptedParticipants.join(",")+"'");
				}
				$('#participant_list_c').val(JSON.stringify(participant_array));

				$('#programme_fee_c').val(parseFloat(res.data.programme_fee_c[0]).toFixed(2));
				$('#programme_fee_non_res_c').val(parseFloat(res.data.programme_fee_non_res_c[0]).toFixed(2));
				
				$('#participant_c').html(options);
		  		
				pushParticipantListAuto2(participant_array,addedlist);

				if (res.discount) {
					discount_eligibility = true;
				}

				var non_resident = 0;
				var resident = 0;
				for(var x in participant_array){
		  			if(participant_array.hasOwnProperty(x)){
		  				if (participant_array[x].type != null && participant_array[x].type=="Residential") { resident++; }
						  	else if(participant_array[x].type != null && participant_array[x].type=="NonResidential"){ non_resident++; }
						  	else{ resident++; }
		  			}
		  		}

		  		typeOfParticipant = {
						  			"non_resident":non_resident,
						  			"resident":resident
					};

					if ($('#programme_type_c').val() == 'Announced') {
						calculateAmount(participant_array,'AP',typeOfParticipant);				
					}else{
						calculateAmount(participant_array,'ICTP',typeOfParticipant);		
					}

			}else{
					if ($('#programme_type_c').val() == 'Announced') {
						calculateAmount(participant_array,'AP',typeOfParticipant);				
					}else{
						calculateAmount(participant_array,'ICTP',typeOfParticipant);				
					}
					$('#participant_list_c').val('');
				// $('#participant_c').html('');
				// $('#programme_fee_c').val('');
			}
		}
	});
	
}	


function fetchParticipant(){
	
	$.ajax({
		type:'GET',
		url:'index.php?entryPoint=ajaxCall',
		data:{type:'getparticipantlist',pid:$('#project_aos_invoices_1project_ida').val(),orgid:$('#billing_account_id').val(),currency:$('#currency_id_select').val()},
		async:false,
		dataType:'json',
		beforeSend:function(){
		},
		complete:function(){
		},
		success:function(res)
		{
			participant_array = [];
			var notAcceptedParticipants = [];
			if(res.Success){
				var options = '<option value=""></option>';
				$.each(res.data.name,function(k,v){
					var split = v.toString().split(",");

					options += '<option data-type="'+res.data.type_c[k]+'" value="'+split[1]+'">'+split[0]+'</option>';
			  		var add_name = {
			  			"name":split[0],
			  			"id":split[1],
			  			"type":res.data.type_c[k]
			  		};
			  		
			  		participant_array.push(add_name);
			  		if(res.data.nomination_status_c[k] != "Accepted"){
			  			notAcceptedParticipants.push(split[0]); 
			  			$('input[title=Save]').attr('disabled',true);
			  		}
			  		
				});
				if (notAcceptedParticipants.length) {
				  		alert("Please accept the following participant(s) to save the invoice'"+notAcceptedParticipants.join(",")+"'");
				}
				$('#participant_list_c').val(JSON.stringify(participant_array));

				$('#programme_fee_c').val(parseFloat(res.data.programme_fee_c[0]).toFixed(2));
				$('#programme_fee_non_res_c').val(parseFloat(res.data.programme_fee_non_res_c[0]).toFixed(2));
				
				$('#participant_c').html(options);
		  		
				pushParticipantListAuto(participant_array,addedlist);

				if (res.discount) {
					discount_eligibility = true;
				}

			}else{
				$('#participant_c').html('');
				$('#programme_fee_c').val('');
			}
		}
	});
	
}	

// function cal_from_sub(){
// 	var tax_amount = 0;
// 	var cgst = 0;
// 	var sgst = 0;
// 	var ugst = 0;
// 	var igst = 0;
// 	var total_amount = 0;
// 	var programme_fee = parseFloat((a = $('#programme_fee_c').val()) == ''? 0: a);
// 	var programme_fee_non_res = parseFloat((a = $('#programme_fee_non_res_c').val()) == ''? 0: a);
// 	var accommodation = parseFloat((a = $('#accommodation_c').val()) == ''? 0: a);
// 	var living_allowance = parseFloat((a = $('#living_allowance_c').val()) == ''? 0: a);
// 	var other_reimbursement = parseFloat((a = $('#other_reimbursement_c').val()) == ''? 0: a);
// 	var discount_in_per_c = parseFloat((a = $('#discount_in_per_c').val()) == ''? 0: a);
// 	var discount_amount = 0;
// 	var npp = 0;

// 	// total_amt = programme_fee * $('#no_of_participants_c').val();

	
// 	total_amt = parseFloat((a = $('#total_amt').val()) == ''? 0: a);


// 	if (!discount_in_per_c || discount_in_per_c == 0) {
// 		// discount_in_per_c = 10;
// 		// $('#discount_in_per_c').val(10);
// 	}
// 	if (discount_in_per_c) {
// 		discount_amount = total_amt * discount_in_per_c/100;
// 	}

// 	var subtotal_amount = parseFloat((a = $('#subtotal_amount').val()) == ''? 0: a);	
// 	console.log(subtotal_amount);
// 	var tax_type = $('#tax_type_c').val();
// 	if (jQuery.inArray( 'IGST', tax_type ) !== -1) {
// 		igst = parseFloat(subtotal_amount) * parseFloat(0.18);
// 	}
// 	else{
// 			igst = 0;
// 		}

// 	if (jQuery.inArray( 'UGST', tax_type ) !== -1) {
// 		ugst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			ugst = 0;
// 		}

// 	if (jQuery.inArray( 'SGST', tax_type ) !== -1) {
// 		sgst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			sgst = 0;
// 		}

// 	if (jQuery.inArray( 'CGST', tax_type ) !== -1) {
// 		cgst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			cgst = 0;
// 		}
// console.log(cgst);
// console.log(sgst);

// 	tax_amount = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(ugst);
	
// 	total_amount = subtotal_amount + tax_amount + accommodation + living_allowance + other_reimbursement;
// 	// console.log(total_amt);

// 	// if ($('#billing_address_state').val().indexOf('Telangana') !== -1) {
// 	// 	$('#cgst_c').val(parseFloat(cgst).toFixed(2));
// 	// 	$('#sgst_c').val(parseFloat(sgst).toFixed(2));		
// 	// 	$('#igst_c').val(0);
// 	// }else{
// 	// $('#cgst_c').val(parseFloat(cgst).toLocaleString('en-IN',{ maximumFractionDigits: 2 }));
// 	$('#cgst_c').val(parseFloat(cgst));
// 	$('#sgst_c').val(parseFloat(sgst));		
// 	$('#ugst_c').val(parseFloat(ugst));		

// 	if ($('#igst_c').val() == '') {
// 		if ($('#billing_address_state').val().indexOf('Telangana') !== -1) {
// 			igst = parseFloat(cgst) + parseFloat(sgst);
// 		}
// 	}

// 	$('#igst_c').val(parseFloat(igst));
	

// 	// 	$('#cgst_c').val(0);
// 	// 	$('#sgst_c').val(0);			
// 	// 	$('#igst_c').val(parseFloat(parseFloat(cgst) + parseFloat(sgst)).toFixed(2));
// 	// }

// 	$('#tax_amount').val(parseFloat(tax_amount));
// 	$('#total_amount').val(parseFloat(total_amount));	
// }

function pushParticipantListAuto3(participant_array,addedlist){

	if($('#participant_list_c').val().length){
		var list = JSON.parse($('#participant_list_c').val());
		var non_resident = 0;
		var resident = 0;
		for (var x in list){
		  if (list.hasOwnProperty(x)){
		    // $('.list-group').append('<li class="list-group-item" >'+list[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+list[x].id+'" data-type="'+list[x].type+'"></span></li>');
			if (list[x].type != null && list[x].type=="Residential") { resident++; }
			else if(list[x].type != null && list[x].type=="NonResidential"){ non_resident++; }
			else{ resident++; }		    
		  }
		}
		typeOfParticipant = {
			  			"non_resident":non_resident,
			  			"resident":resident
		};
	}
}

function pushParticipantListAuto2(participant_array,addedlist){

	if($('#participant_list_c').val().length){
		var list = JSON.parse($('#participant_list_c').val());
		var non_resident = 0;
		var resident = 0;
		for (var x in list){
		  if (list.hasOwnProperty(x)){
		    $('.list-group').append('<li class="list-group-item" >'+list[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+list[x].id+'" data-type="'+list[x].type+'"></span></li>');
			if (list[x].type != null && list[x].type=="Residential") { resident++; }
			else if(list[x].type != null && list[x].type=="NonResidential"){ non_resident++; }
			else{ resident++; }		    
		  }
		}
		typeOfParticipant = {
			  			"non_resident":non_resident,
			  			"resident":resident
		};
	}
}

function pushParticipantListAuto(participant_array,addedlist){

	if($('#participant_list_c').val().length){
		var list = JSON.parse($('#participant_list_c').val());
		var non_resident = 0;
		var resident = 0;
		for (var x in list){
		  if (list.hasOwnProperty(x)){
		    $('.list-group').append('<li class="list-group-item" >'+list[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+list[x].id+'" data-type="'+list[x].type+'"></span></li>');
			if (list[x].type != null && list[x].type=="Residential") { resident++; }
			else if(list[x].type != null && list[x].type=="NonResidential"){ non_resident++; }
			else{ resident++; }		    
		  }
		}
		typeOfParticipant = {
			  			"non_resident":non_resident,
			  			"resident":resident
		};
		if ($('#programme_type_c').val() == 'Announced') {
			// setTimout()
			calculateAmount(participant_array,'AP',typeOfParticipant);				
		}else{
			calculateAmount(participant_array,'ICTP',typeOfParticipant);				
		}
	}
}

function pushParticipantList(participant_array,addedlist){
	if($('#participant_list_c').val().length){
		var list = JSON.parse($('#participant_list_c').val());
		var non_resident = 0;
		var resident = 0;
		for (var x in list){
		  if (list.hasOwnProperty(x)){
		    $('.list-group').append('<li class="list-group-item" >'+list[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+list[x].id+'" data-type="'+list[x].type+'"></span></li>');
		    addedlist = {
	  			"name":list[x].name,
	  			"id":list[x].id,
	  			"type": list[x].type_c
	  		};
	
		    participant_array.push(addedlist);
		  }
		}
	}
}
function addParticipantList(participant_array){

	var list = '';
	var non_resident = 0;
	var resident = 0;
	for (var x in participant_array){
	  if (participant_array.hasOwnProperty(x)){
	    list += '<li class="list-group-item"  >'+participant_array[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+participant_array[x].id+'" data-type="'+participant_array[x].type+'"></span></li>';
	  }	
	  if (participant_array[x].type != null && participant_array[x].type=="Residential") { resident++; }
	  else if(participant_array[x].type != null && participant_array[x].type=="NonResidential"){ non_resident++; }
	  else{ resident++; }
	}
	typeOfParticipant = {
	  			"non_resident":non_resident,
	  			"resident":resident
	};

	$('.list-group').html(list);
}

function calculateAmount(participant_array,type,typeOfParticipant)
{
	
	var tax_amount = 0;
	var cgst = 0;
	var sgst = 0;
	var ugst = 0;
	var igst = 0;
	var total_amount = 0;
	var programme_fee = parseFloat((a = $('#programme_fee_c').val()) == ''? 0: a);
	var programme_fee_non_res = parseFloat((a = $('#programme_fee_non_res_c').val()) == ''? 0: a);
	var discount_in_per_c = $('#discount_in_per_c').val();
	var discount_amount = 0;

	var accommodation = parseFloat((a = $('#accommodation_c').val()) == ''? 0: a);
	var living_allowance = parseFloat((a = $('#living_allowance_c').val()) == ''? 0: a);
	var other_reimbursement = parseFloat((a = $('#other_reimbursement_c').val()) == ''? 0: a);		
	var less_adjustments_c = parseFloat((a = $('#less_adjustments_c').val()) == ''? 0: a);		
	var no_of_days_c = parseFloat((a = $('#no_of_days_c').val()) == ''? 0: a);		
	var minimum_no_participant_c = parseFloat((a = $('#minimum_no_participant_c').val()) == ''? 0: a);		
	var programme_type_c = $('#programme_type_c').val();
	var invoice_type_c = $('#invoice_type_c').val();
	var specialAmount1 = parseFloat((a = $('#amount_1_c').val()) == ''? 0: a);	
	var specialAmount2 = parseFloat((a = $('#amount_2_c').val()) == ''? 0: a);	
	var specialAmount3 = parseFloat((a = $('#amount_3_c').val()) == ''? 0: a);	

	var npp = 0;
	var additionalParticipant = 0;

	if(invoice_type_c == 'Special'){
		if($("#self_sponsored_c").is(':checked')){
			$('#no_of_participants_c').val('1');
			total_amt = specialAmount1 + specialAmount2 + specialAmount3;
		}else{
			$('#no_of_participants_c').val(participant_array.length);
			total_amt = specialAmount1 + specialAmount2 + specialAmount3;
		}
		
	}else if(type == "ICTP"){
		// total_amt = programme_fee * $('#no_of_participants_c').val();
		npp = participant_array.length;
		if(programme_type_c == 'ICTP-Off Campus'){

			if(npp<=minimum_no_participant_c){
				$('#no_of_participants_c').val(participant_array.length);
				total_amt = (no_of_days_c * programme_fee);
			}else{
				$('#no_of_participants_c').val(participant_array.length);
				total_amt = (no_of_days_c * programme_fee);
				additionalParticipant = npp - minimum_no_participant_c;
				total_amt += (no_of_days_c * additionalParticipant * (programme_fee/minimum_no_participant_c));
			}
			
		}else{
			if(npp<minimum_no_participant_c){
				$('#no_of_participants_c').val(minimum_no_participant_c);
				total_amt = (minimum_no_participant_c * programme_fee);
			}else{
				$('#no_of_participants_c').val(participant_array.length);
				total_amt = (typeOfParticipant.resident * programme_fee) + (typeOfParticipant.non_resident * programme_fee_non_res);
			}
		}
		
	}else{
		var total_fee;
		
		if (participant_array.length > 1) {
			npp = parseInt(typeOfParticipant.resident) + parseInt(typeOfParticipant.non_resident);
			total_fee = (typeOfParticipant.resident * programme_fee) + (typeOfParticipant.non_resident * programme_fee_non_res);
		}else{
			if (participant_array.length >0) {
				npp = participant_array.length;
				
				if (participant_array[0].type == "NonResidential") {
					total_fee = programme_fee_non_res;	
				}else{
					total_fee = programme_fee;
				}				
			}else{
				total_fee = 0;		
			}
			
		}
		total_amt = total_fee;
	}


	if (!discount_in_per_c || discount_in_per_c == 0) {
		// discount_in_per_c = 10;
		// $('#discount_in_per_c').val(10);
	}
	if (discount_in_per_c) {
		discount_amount = total_amt * discount_in_per_c/100;
		discount_amount = roundUp(discount_amount);
	}

	subtotal_amount = total_amt - discount_amount; 
	
	// console.log("cgst"+cgst+"subtotal_amount"+subtotal_amount);
	

	// if ($('#cgst_c').val() != '') {
	// 	cgst = $('#cgst_c').val();
	// }

	// if ($('#igst_c').val() != '') {
	// 	igst = $('#igst_c').val();
	// }	

	// if ($('#sgst_c').val() != '') {
	// 	sgst = $('#sgst_c').val();
	// }		

	// if ($('#ugst_c').val() != '') {
	// 	ugst = $('#ugst_c').val();
	// }		
	$('#subtotal_amount').val(parseFloat(subtotal_amount).toFixed(2));	
	var tax_type = $('#tax_type_c').val();
	if (jQuery.inArray( 'IGST', tax_type ) !== -1) {
		igst = parseFloat(subtotal_amount) * parseFloat(0.18);
		igst=roundUp(igst);
	}
	else{
			igst = 0;
		}

	if (jQuery.inArray( 'UGST', tax_type ) !== -1) {
		ugst = parseFloat(subtotal_amount) * parseFloat(0.09);
		ugst=roundUp(ugst);
	}
	else{
			ugst = 0;
		}

	if (jQuery.inArray( 'SGST', tax_type ) !== -1) {
		sgst = parseFloat(subtotal_amount) * parseFloat(0.09);
		sgst=roundUp(sgst);
	}
	else{
			sgst = 0;
		}

	if (jQuery.inArray( 'CGST', tax_type ) !== -1) {
		cgst = parseFloat(subtotal_amount) * parseFloat(0.09);
		cgst=roundUp(cgst);
	}
	else{
			cgst = 0;
		}

	tax_amount = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(ugst);
	
	total_amount = roundUp(subtotal_amount) + roundUp(tax_amount) + roundUp(accommodation) + roundUp(living_allowance) + roundUp(other_reimbursement) - roundUp(less_adjustments_c);
	console.log(total_amt);
	$('#total_amt').val(parseFloat(total_amt).toFixed(2));
	$('#discount_amount').val(parseFloat(discount_amount).toFixed(2));
	$('#subtotal_tax_amount').val(parseFloat(subtotal_amount).toFixed(2));

	// if ($('#billing_address_state').val().indexOf('Telangana') !== -1) {
	// 	$('#cgst_c').val(parseFloat(cgst).toFixed(2));
	// 	$('#sgst_c').val(parseFloat(sgst).toFixed(2));		
	// 	$('#igst_c').val(0);
	// }else{
	$('#cgst_c').val(parseFloat(cgst).toFixed(2));
	$('#sgst_c').val(parseFloat(sgst).toFixed(2));		
	$('#ugst_c').val(parseFloat(ugst).toFixed(2));		

	// if ($('#igst_c').val() == '') {
	// 	if ($('#billing_address_state').val().indexOf('Telangana') !== -1) {
	// 		igst = parseFloat(cgst) + parseFloat(sgst);
	// 	}
	// }

	$('#igst_c').val(parseFloat(igst).toFixed(2));
	

	// 	$('#cgst_c').val(0);
	// 	$('#sgst_c').val(0);			
	// 	$('#igst_c').val(parseFloat(parseFloat(cgst) + parseFloat(sgst)).toFixed(2));
	// }

	$('#tax_amount').val(parseFloat(tax_amount).toFixed(2));
	$('#total_amount').val(parseFloat(total_amount).toFixed(2));
}


// $('#no_of_participants_c,#total_amt, #discount_in_per_c, #discount_amount, #tax_type_c,#tax_type_c,#client_type_c').on('blur change',function(){
// $('#no_of_participants_c,#total_amt, #discount_in_per_c, #discount_amount, #tax_type_c,#tax_type_c').on('blur change',function(){
		
// 		var a;
// 		var no_of_participants = $('#no_of_participants_c').val();
// 		var programme_fee = parseFloat((a = $('#programme_fee_c').val()) == ''? 0: a);
// 		var programme_fee_non_res = parseFloat((a = $('#programme_fee_non_res_c').val()) == ''? 0: a);
// 		var discount_in_per_c = parseFloat((a = $('#discount_in_per_c').val()) == ''? 0: a);
// 		var total_amount = (typeOfParticipant.resident * programme_fee) + (typeOfParticipant.non_resident * programme_fee_non_res);
// 		var discount_amount = total_amount * discount_in_per_c/100;
// 		$('#discount_amount').val(parseFloat(discount_amount).toFixed(2));
// 		var discount_amount = parseFloat(discount_amount);
		
// 		var accommodation = parseFloat((a = $('#accommodation_c').val()) == ''? 0: a);
// 		var living_allowance = parseFloat((a = $('#living_allowance_c').val()) == ''? 0: a);
// 		var other_reimbursement = parseFloat((a = $('#other_reimbursement_c').val()) == ''? 0: a);		
		
// 		var subtotal_amount = total_amount - discount_amount;
// 		$('#subtotal_amount').val(subtotal_amount);	
// 		var tax_type = $('#tax_type_c').val();
// 		if (jQuery.inArray( 'IGST', tax_type ) !== -1) {
// 		igst = parseFloat(subtotal_amount) * parseFloat(0.18);
// 	}
// 	else{
// 			igst = 0;
// 		}

// 	if (jQuery.inArray( 'UGST', tax_type ) !== -1) {
// 		ugst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			ugst = 0;
// 		}

// 	if (jQuery.inArray( 'SGST', tax_type ) !== -1) {
// 		sgst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			sgst = 0;
// 		}

// 	if (jQuery.inArray( 'CGST', tax_type ) !== -1) {
// 		cgst = parseFloat(subtotal_amount) * parseFloat(0.09);
// 	}
// 	else{
// 			cgst = 0;
// 		}


// 		$('#cgst_c').val(parseFloat(cgst).toFixed(2));
// 		$('#sgst_c').val(parseFloat(sgst).toFixed(2));		
// 		$('#ugst_c').val(parseFloat(ugst).toFixed(2));	
// 		$('#igst_c').val(parseFloat(igst).toFixed(2));

// 		var tax_amount = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(ugst);

// 		total_amount = subtotal_amount + tax_amount + accommodation + living_allowance + other_reimbursement;

// 		$('#tax_amount').val(tax_amount.toFixed(2));
// 		$('#total_amount').val(total_amount.toFixed(2));


// });


</script>

{/literal}

{else}

{literal}
<script>
var participant_array = [];
$(document).ready(function(){
	var url="{/literal}{$url}{literal}";
	$('div[field=participant_list_c]').parent().hide();
	$('div[field=participant_c]').parent().hide();
	if($('#participant_list_c').text().length){
		var list = JSON.parse($('#participant_list_c').text());
		for (var x in list){
		  if (list.hasOwnProperty(x)){
		    $('.list-group').append('<li class="list-group-item" ><a target="_blank" href="index.php?&action=DetailView&module=Contacts&record='+list[x].id+'">'+list[x].name+'</a></li>');
		  }
		}
	}

	if($("#self_sponsored_c").is(':checked') && $('#invoice_type_c').val() == 'Special'){
		$('div[field=self_sponsor_c]').parent().show();
		$('div[field=billing_account]').parent().hide();
		$('div[field=participant_c]').parent().hide();
		$('div[field=line_items]').parent().hide();
		$('div[field=no_of_participants_c]').parent().hide();
	}
	else if($('#programme_type_c').val() == 'Announced'){
		$('div[field=self_sponsor_c]').parent().hide();
		$('div[field=billing_account]').parent().show();
		$('div[field=no_of_participants_c]').parent().hide();
		$('div[field=line_items]').parent().show();
	}else{
		$('div[field=self_sponsor_c]').parent().hide();
		$('div[field=billing_account]').parent().show();
		$('div[field=no_of_participants_c]').parent().show();
		$('div[field=participant_c]').parent().hide();
		$('div[field=line_items]').parent().hide();
	}

	var record_id = $('input[name=record]').val();


		$('#detail_header_action_menu').before('<a href="index.php?module=AOS_Invoices&action=sugarpdf&sugarpdf=invoice&record='+record_id+'" class="glyphicon glyphicon-print fa-2x" target="_blank" style="padding-right:10px;"></a>');


});
</script>
{/literal}

{/if}
<ul class="list-group">
	
</ul>