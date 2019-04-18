<?php
/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SimpleCRM <info@simplecrm.com.sg>
 */


require_once('include/MVC/View/views/view.edit.php');

class scrm_AccommodationViewEdit extends ViewEdit
{
 	
 	function scrm_AccommodationViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
    	global $app_list_strings;

    	echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Sorry no rooms are available!</p></div>';
    	echo '<div id = "dialogNoParticipants" title= "Warning!!!" style="display:none"><p>Sorry there are no participants in this programme!</p></div>';
    	echo '<div id = "dialogDate" title= "Warning!!!" style="display:none"><p>*Check in date can not be greater than check out date!</p><p>*Check in is available from 72 hours (3 days) before the Programme Start Date & check out is available upto 72 hours (3 days) after Programme End Date!</p></div>';
    	if ($this->bean->room_no_c == '') {
    		$this->bean->room_no_c = 0;
    	}
    	$room_no_cpc_new = ltrim(implode(',', $app_list_strings['room_no_cpc_new_c_list']), ',');
    	$room_no_cpc_old = ltrim(implode(',', $app_list_strings['cpc_accommodations_list']), ',');
    	$room_no_ndc = ltrim(implode(',', $app_list_strings['room_no_ndc_list']), ',');
    	$room_no_bv = ltrim(implode(',', $app_list_strings['bv_accommodation_list']), ',');

    	echo <<<EOD
    		<script>
    			$(document).ready(function(){
    				$('#full_name').hide();
    				$('#participants_c_label').parent('tr').next('tr').find('td').eq(1).html('<ul class="list-group"></ul>');

    				if($('#project_scrm_accommodation_1_name').val()){

    					updateRoomsByProgramme($('#project_scrm_accommodation_1project_ida').val());
    				}

    				$('#contacts_scrm_accommodation_1_name_label').text('Participant');
    				addToValidate('EditView','contacts_scrm_accommodation_1_name','contacts_scrm_accommodation_1_name',true,'Participant');
					$('#contacts_scrm_accommodation_1_name_label').append('<span class="required">*</span>');

    				addToValidate('EditView','scrm_partners_scrm_accommodation_1_name','scrm_partners_scrm_accommodation_1_name',true,'Participant');
					$('#scrm_partners_scrm_accommodation_1_name_label').append('<span class="required">*</span>');					
					$('#guest_type_c').change(function(){
						
						guestTypeDependentDropdown();
						
					});

					guestTypeDependentDropdown();
					function guestTypeDependentDropdown(){
						var value = $('#guest_type_c').val();
						

						if( value== 'Guest Faculty' || value == 'Guest Speaker' || value == 'Faculty' || value == 'DG'){

							$('#participant_list_c').parent('td').hide();
							$('#participant_list_c_label').hide();
							$('.list-group').hide();

	    					// removeFromValidate('EditView','contacts_scrm_accommodation_1_name');	    					

							$('#scrm_partners_scrm_accommodation_1_name').parent('td').show();
							$('#scrm_partners_scrm_accommodation_1_name_label').show();
							addToValidate('EditView','scrm_partners_scrm_accommodation_1_name','scrm_partners_scrm_accommodation_1_name',true,'Participant');

						}else{
							$('#participant_list_c').parent('td').show();
							$('#participant_list_c_label').show();
							$('.list-group').show();

							// addToValidate('EditView','contacts_scrm_accommodation_1_name','contacts_scrm_accommodation_1_name',true,'Participant');

							$('#scrm_partners_scrm_accommodation_1_name').parent('td').hide();
							$('#scrm_partners_scrm_accommodation_1_name_label').hide();
	    					removeFromValidate('EditView','scrm_partners_scrm_accommodation_1_name');	    					

						}

						if( value == 'BellaVistian' || value == 'DG'){
							restoreAllRoomsNo();
							$('#project_scrm_accommodation_1_name').parent('td').hide();
							$('#project_scrm_accommodation_1_name_label').hide();
						}else{
							$('#project_scrm_accommodation_1_name').parent('td').show();
							$('#project_scrm_accommodation_1_name_label').show();
		    				
		    				if($('#project_scrm_accommodation_1_name').val()){
		    			
		    					updateRoomsByProgramme($('#project_scrm_accommodation_1project_ida').val());
		    				}							
							
						}
					}

					function restoreAllRoomsNo(){
						
						var cpc_new = '{$room_no_cpc_new}'.split(',');
						var cpc_old = '{$room_no_cpc_old}'.split(',');
						var ndc = '{$room_no_ndc}'.split(',');
						var bv =  '{$room_no_bv}'.split(',');
						
						if(ndc.length > 0){
							$('#room_no_ndc_c').find('option').remove();
							$('#room_no_ndc_c').append($("<option></option>").attr("value",'').text(''));
							for(i=0;i<ndc.length;i++){
								$('#room_no_ndc_c').append($("<option></option>").attr("value",ndc[i]).text(ndc[i]));
							}
						}

						if(bv.length > 0){
							$('#room_no_bv_c').find('option').remove();
							$('#room_no_bv_c').append($("<option></option>").attr("value",'').text(''));
							for(i=0;i<bv.length;i++){
								$('#room_no_bv_c').append($("<option></option>").attr("value",bv[i]).text(bv[i]));
							}

							$("#room_no_bv_c option[value='{$this->bean->room_no_bv_c}']").attr('selected',true);
						}
						
						if(cpc_new.length > 0){
							$('#room_no_cpc_new_c').find('option').remove();
							$('#room_no_cpc_new_c').append($("<option></option>").attr("value",'').text(''));
							for(i=0;i<cpc_new.length;i++){
								$('#room_no_cpc_new_c').append($("<option></option>").attr("value",cpc_new[i]).text(cpc_new[i]));
							}
							
							$("#room_no_cpc_new_c option[value='{$this->bean->room_no_cpc_new_c}']").attr('selected',true);    														

						}

						if(cpc_old.length > 0){
							$('#room_no_cpc_old_c').find('option').remove();
							$('#room_no_cpc_old_c').append($("<option></option>").attr("value",'').text(''));
							for(i=0;i<cpc_old.length;i++){
								$('#room_no_cpc_old_c').append($("<option></option>").attr("value",cpc_old[i]).text(cpc_old[i]));
							}

							$("#room_no_cpc_old_c option[value='{$this->bean->room_no_cpc_old_c}']").attr('selected',true);
						}									
									    					
	    			}


    					$('#check_in_c_trigger').attr('tabindex',2);
    					$('#check_out_c_trigger').attr('tabindex',2);
    					
    					locationType();
    					$(document).on('change','#location_c',function(){
    						locationType();

    					});
    					function locationType(){
    						if($('#location_c').val() == "Bella Vista"){
    							$('#room_no_c').parent('td').hide();
    							$('#room_no_c_label').hide();
    							
    							$('#room_no_bv_c').parent('td').show();
    							$('#room_no_bv_c_label').show();

    							$('#room_no_cpc_new_c').parent('td').hide();
    							$('#room_no_cpc_new_c_label').hide();

    							$('#room_no_cpc_old_c').parent('td').hide();
    							$('#room_no_cpc_old_c_label').hide();    							

    							$('#room_no_ndc_c').parent('td').hide();
    							$('#room_no_ndc_c_label').hide();    							    							

    						}else if($('#location_c').val() == "NDC"){
    							$('#room_no_c_label').hide();
    							$('#room_no_c').parent('td').hide();

    							$('#room_no_bv_c').parent('td').hide();
    							$('#room_no_bv_c_label').hide();

    							$('#room_no_cpc_new_c').parent('td').hide();
    							$('#room_no_cpc_new_c_label').hide();

    							$('#room_no_cpc_old_c').parent('td').hide();
    							$('#room_no_cpc_old_c_label').hide();    							

    							$('#room_no_ndc_c').parent('td').show();
    							$('#room_no_ndc_c_label').show();

    						}else if($('#location_c').val() == "CPC_NEW"){
								$('#room_no_c_label').hide();
    							$('#room_no_c').parent('td').hide();

    							$('#room_no_bv_c').parent('td').hide();
    							$('#room_no_bv_c_label').hide();

    							$('#room_no_cpc_new_c').parent('td').show();
    							$('#room_no_cpc_new_c_label').show();

    							$('#room_no_cpc_old_c').parent('td').hide();
    							$('#room_no_cpc_old_c_label').hide();    							

    							$('#room_no_ndc_c').parent('td').hide();
    							$('#room_no_ndc_c_label').hide();    							
    						}else if($('#location_c').val() == "CPC_OLD"){
								$('#room_no_c_label').hide();
    							$('#room_no_c').parent('td').hide();

    							$('#room_no_bv_c').parent('td').hide();
    							$('#room_no_bv_c_label').hide();

    							$('#room_no_cpc_new_c').parent('td').hide();
    							$('#room_no_cpc_new_c_label').hide();

    							$('#room_no_cpc_old_c').parent('td').show();
    							$('#room_no_cpc_old_c_label').show();    							

    							$('#room_no_ndc_c').parent('td').hide();
    							$('#room_no_ndc_c_label').hide();    	
    						
    							
    						}else{
    							$('#room_no_c_label').show();
    							$('#room_no_c').parent('td').show();

    							$('#room_no_bv_c').parent('td').hide();
    							$('#room_no_bv_c_label').hide();

    							$('#room_no_cpc_new_c').parent('td').hide();
    							$('#room_no_cpc_new_c_label').hide();

    							$('#room_no_cpc_old_c').parent('td').hide();
    							$('#room_no_cpc_old_c_label').hide();    							

    							$('#room_no_ndc_c').parent('td').hide();
    							$('#room_no_ndc_c_label').hide();    							
    						}
    					}
	    				
	    				$(document).on('change','#check_in_c_date, #check_in_c_hours, #check_in_c_minutes, #check_in_c_meridiem, #check_out_c_date, #check_out_c_hours, #check_out_c_moututes, #check_out_c_meridiem', function(){
	    						// updateOccupancyChart();			
	    				});

	    				$(document).on('blur','#check_in_c_trigger, #check_out_c_trigger', function(){
	    						setTimeout(function(){
	    							console.log(p_start_date);
									var checkIn = $('#check_in_c_date').val();
		    						var checkOut = $('#check_out_c_date').val();
									if (p_start_date) {

			    						if(p_start_date){
				    						var start_date = (parseInt(p_start_date.substring(0,2))-3)+p_start_date.substring(2,p_start_date.length);
				    						
			    						}else{
			    							var start_date = p_start_date;
			    						}

			    						if(p_end_date){
				    						var end_date = (parseInt(p_end_date.substring(0,2))+3)+p_end_date.substring(2,p_end_date.length);
				    						
			    						}else{
			    							var end_date = p_end_date;
			    						}		    						

			    						check_dates(start_date,checkIn);
			    						if(checkOut != ''){
			    							check_dates(start_date,checkOut);
				    						check_dates(checkOut,end_date);

			    						}
			    						check_dates(checkIn,end_date);										
									}

			    						
		    						if(checkIn != '' && checkOut != ''){
		    							check_dates(checkIn,checkOut);
		    						}
		    						// updateRoomsByProgramme($('#project_scrm_accommodation_1project_ida').val());
		    						// updateOccupancyChart();			
		    					}, 1000);
	    				});

	    				$(document).on('blur','#project_scrm_accommodation_1_name, #btn_project_scrm_accommodation_1_name', function(){
	    						setTimeout(function(){
	    							if ($('#project_scrm_accommodation_1project_ida').val()) {		    						updateRoomsByProgramme($('#project_scrm_accommodation_1project_ida').val());
			    						updateOccupancyChart();
			    						fetchParticipant();			
	    							}


		    					}, 1000);
	    						
	    				});

		                function getDate(sugardate) {
		                    m = '';
		                    d = '';
		                    y = '';
		                    var dateParts = sugardate.match(date_reg_format);
		                    for (key in date_reg_positions) {
		                        index = date_reg_positions[key];
		                        if (key == 'm') {
		                            m = dateParts[index];
		                            m = (m * 1) - 1;
		                        } else if (key == 'd') {
		                            d = dateParts[index];
		                        } else {
		                            y = dateParts[index];
		                        }
		                    }
		                    var dd = new Date(y, m, d);
		                    return dd;
		                }

		                function check_dates(start,end) {
		            
		                    var jstart = start;
		                    var jend = end;
		                   	
		                    if (jstart != '' && jend != '') {
		                        var start = getDate(jstart);
		                        var end = getDate(jend);

		                        if (start > end) {
		                            // $('#end_date_c').val('');
		                            $('#dialogDate').dialog();
		                        	 $('#check_in_c_date').val('');
		                        	 $('#check_out_c_date').val('');
		                            return false;
		                        }
		                        return true;
		                    }
		                }

	    				var p_start_date;
	    				var p_end_date;
	    				function updateRoomsByProgramme(pid){
							$.ajax({
							  method: "POST",
							  url: "index.php?entryPoint=ajaxCall",
							  data: {pid:pid, type:"getBlockedRooms"}
							}).success(function(rsp){
								rsp = JSON.parse(rsp);
								
								var cpc_new = rsp.data.cpc_new.replace(/\^/g, '').split(',');
								var cpc_old = rsp.data.cpc_old.replace(/\^/g, '').split(',');
								var ndc = rsp.data.ndc.replace(/\^/g, '').split(',');
								var bv =  rsp.data.bv.replace(/\^/g, '').split(',');
								
								if(rsp.Success == true){
									if(ndc.length > 0){
										$('#room_no_ndc_c').find('option').remove();
										$('#room_no_ndc_c').append($("<option></option>").attr("value",'').text(''));
										for(i=0;i<ndc.length;i++){
											$('#room_no_ndc_c').append($("<option></option>").attr("value",ndc[i]).text(ndc[i]));
										}
									}

									if(bv.length > 0){
										$('#room_no_bv_c').find('option').remove();
										$('#room_no_bv_c').append($("<option></option>").attr("value",'').text(''));
										for(i=0;i<bv.length;i++){
											$('#room_no_bv_c').append($("<option></option>").attr("value",bv[i]).text(bv[i]));
										}

										$("#room_no_bv_c option[value='{$this->bean->room_no_bv_c}']").attr('selected',true);
									}
									
									if(cpc_new.length > 0){
										$('#room_no_cpc_new_c').find('option').remove();
										$('#room_no_cpc_new_c').append($("<option></option>").attr("value",'').text(''));
										for(i=0;i<cpc_new.length;i++){
											$('#room_no_cpc_new_c').append($("<option></option>").attr("value",cpc_new[i]).text(cpc_new[i]));
										}
										
										$("#room_no_cpc_new_c option[value='{$this->bean->room_no_cpc_new_c}']").attr('selected',true);    														

									}

									if(cpc_old.length > 0){
										$('#room_no_cpc_old_c').find('option').remove();
										$('#room_no_cpc_old_c').append($("<option></option>").attr("value",'').text(''));
										for(i=0;i<cpc_old.length;i++){
											$('#room_no_cpc_old_c').append($("<option></option>").attr("value",cpc_old[i]).text(cpc_old[i]));
										}

										$("#room_no_cpc_old_c option[value='{$this->bean->room_no_cpc_old_c}']").attr('selected',true);
									}									

									if(rsp.data.start_date){
										p_start_date = rsp.data.start_date;
									}

									if(rsp.data.end_date){
										p_end_date = rsp.data.end_date;
									}

									if(!rsp.createAccommodation){
										
										$('#SAVE_HEADER').attr('disabled',true);
										$('#dialogNoParticipants').dialog();
									}
								}
							});		    					
	    				}			

	    				function updateOccupancyChart(){
	    					SUGAR.ajaxUI.showLoadingPanel();
	    					hideLoader();
	    					setTimeout(function(){
								var datetime = $('#check_in_c').val();
								var datetimeCO = $('#check_out_c').val();

								$.ajax({
								  method: "POST",
								  url: "index.php?entryPoint=ajaxCall",
								  data: {datetime:datetime, datetimeCO:datetimeCO, type:"getAccommodationsRooms",accommodation_type:$('accommodation_type_c').val(),location:$('#location_c').val(),type_of_room:$('#type_of_room_c').val(), guest_type: $('#guest_type_c').val()}
								}).success(function(rsp){
									rsp = JSON.parse(rsp);
									
									if(rsp.Success == true){
										$.each( rsp.data, function( key, value ) {
										  	$('#'+key).text(value);
										});
										
										if(!rsp.data.book){
											// $('#check_in_c_date').val('');
											// $('#dialog').dialog();
										}
										
										if(rsp.data.rooms_booked){
											
											var rooms_booked = rsp.data.rooms_booked.split(',');
											var rooms_booked = rooms_booked.map(function (x) { 
											    return parseInt(x); 
											});
											var i;
											// console.log(rooms_booked);

											if($('#location_c').val() == 'Bella Vista'){
												
												for(i=0;i<rooms_booked.length;i++){
													// console.log($("#room_no_bv_c option[value="+rooms_booked[i]+"]"));
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_bv_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_bv_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_bv_c > option').length == 1){
													if($('#room_no_bv_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														// $('#dialog').dialog();				
													}
												}else if($('#room_no_bv_c > option').length == 0){
													$('#check_in_c_date').val('');
													// $('#dialog').dialog();				
												
												}
																				
											}else if($('#location_c').val() == "CPC_NEW" || $('#location_c').val() == "CPC_OLD"){
												console.log(rooms_booked);
												for(i=0;i<rooms_booked.length;i++){
													
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_cpc_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_cpc_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_cpc_c > option').length == 1){
													if($('#room_no_cpc_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														// $('#dialog').dialog();				
													}
												}else if($('#room_no_cpc_c > option').length == 0){
													$('#check_in_c_date').val('');
													// $('#dialog').dialog();				
												
												}												
											}else if($('#location_c').val() == "NDC"){
												for(i=0;i<rooms_booked.length;i++){
													
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_ndc_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_ndc_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_ndc_c > option').length == 1){
													if($('#room_no_ndc_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														// $('#dialog').dialog();				
													}
												}else if($('#room_no_ndc_c > option').length == 0){
													$('#check_in_c_date').val('');
													// $('#dialog').dialog();				
												
												}		

    										}else{
												// $('#room_no_c').find('option').remove();
												// for(i=1;i<=parseInt(rsp.data.rooms_available);i++){
												   
												//    if($.inArray( i, rooms_booked ) == -1){
												// 	  $('#room_no_c').append($("<option></option>").attr("value",i).text(i));
												//    }
												// }
											}

										}
									}

									
								});		    					
							}, 1000);
	    				}

	    				function hideLoader(){
							setTimeout(function(){
								
								SUGAR.ajaxUI.hideLoadingPanel();								
							}, 2000);
	    				}

	    				function updateOccupancyChartDefault(locationArg){
							var datetime = $('#check_in_c').val();

							$.ajax({
							  method: "POST",
							  url: "index.php?entryPoint=ajaxCall",
							  data: {datetime:datetime, type:"getAccommodations",accommodation_type:$('accommodation_type_c').val(),location:locationArg,type_of_room:$('#type_of_room_c').val(), guest_type: $('#guest_type_c').val()}
							}).success(function(rsp){
								rsp = JSON.parse(rsp);
								
								if(rsp.Success == true){
									$.each( rsp.data, function( key, value ) {
									  	$('#'+key).text(value);
									});
									
									if(rsp.data.rooms_available){
										var rooms_booked = rsp.data.rooms_booked.split(',');
										var i;
										$('#room_no_c').find('option').remove();
										for(i=1;i<=parseInt(rsp.data.rooms_available);i++){
										   
										   if($.inArray( i, rooms_booked ) == -1){
											  $('#room_no_c').append($("<option></option>").attr("value",i).text(i));
										   }
										}

									}
								}
							});		    					
	    				}

	    				if($('#accommodation_type_c').val() == 'Hotel'){
	    						removeValidations();	    						     
	    				}else{
	    						addValidations();
	    				}
	    				
	    				$('#accommodation_type_c').change(function(){
	    					if($('#accommodation_type_c').val() == 'Hotel'){
	    						removeValidations();	    						     
	    					}else{
	    						addValidations();
	    						locationType();
	    					}
	    				});

	    				function removeValidations(){
	    					removeFromValidate('EditView','location_c');
	    					removeFromValidate('EditView','type_of_room_c');
	    					removeFromValidate('EditView','guest_type_c');
	    					removeFromValidate('EditView','check_in_c_date');
	    					removeFromValidate('EditView','check_out_c_date');	    					
							
							$('#location_c_label').hide();
							$('#location_c').parent('td').hide();

							$('#type_of_room_c_label').hide();
							$('#type_of_room_c').parent('td').hide();

							// $('#guest_type_c_label').hide();
							// $('#guest_type_c').parent('td').hide();
							
							// $('#no_of_adults_c_label').hide();
    			// 			$('#no_of_adults_c').parent('td').hide();
    						
    			// 			$('#no_of_children_c_label').hide();
    			// 			$('#no_of_children_c').parent('td').hide();

    						// $('#check_in_c_label').hide();
    						// $('#check_in_c_date').parent('td').parent('tr').hide();

    						// $('#check_out_c_label').hide();
    						// $('#check_out_c_date').parent('td').parent('tr').hide();

							$('#room_no_c_label').hide();
							$('#room_no_c').parent('td').hide();

							$('#room_no_bv_c').parent('td').hide();
							$('#room_no_bv_c_label').hide();

							$('#room_no_cpc_new_c').parent('td').hide();
							$('#room_no_cpc_new_c_label').hide();

							$('#room_no_cpc_old_c').parent('td').hide();
							$('#room_no_cpc_old_c_label').hide();    							

							$('#room_no_ndc_c').parent('td').hide();
							$('#room_no_ndc_c_label').hide();

    						$('#hotel_room_no_c').parent('td').show();        					
    						$('#hotel_room_no_c_label').show();

							$('#hotel_name_c').parent('td').show();
							$('#hotel_name_c_label').show();
	    				}

	    				function addValidations(){
	    					addToValidate('EditView','location_c','location_c',true,'location');
	    					addToValidate('EditView','type_of_room_c','type_of_room_c',true,'type of room');
	    					addToValidate('EditView','guest_type_c','guest_type_c',true,'guest type');
	    					addToValidate('EditView','check_in_c_date','check_in_c_date',true,'check in date');
	    					addToValidate('EditView','check_out_c_date','check_out_c_date',true,'check out date');	
							$('#location_c_label').show();
							$('#location_c').parent('td').show();

							$('#type_of_room_c_label').show();
							$('#type_of_room_c').parent('td').show();

							$('#guest_type_c_label').show();
							$('#guest_type_c').parent('td').show();
							
							$('#no_of_adults_c_label').show();
    						$('#no_of_adults_c').parent('td').show();
    						
    						$('#no_of_children_c_label').show();
    						$('#no_of_children_c').parent('td').show();

    						$('#check_in_c_label').show();
    						$('#check_in_c_date').parent('td').parent('tr').show();

    						$('#check_out_c_label').show();
    						$('#check_out_c_date').parent('td').parent('tr').show();

    						$('#hotel_room_no_c').parent('td').hide();        					
    						$('#hotel_room_no_c_label').hide();

							$('#hotel_name_c').parent('td').hide();
							$('#hotel_name_c_label').hide();
	    				}

	    				$('#location_c').change(function(){
	    					dependentDropdowns();
	    					resetGuestTypeDropdowns();
	    				});

	    				$('#type_of_room_c').change(function(){
	    					if($('#type_of_room_c').val() == 'Self'){
								$('#no_of_adults_c_label').hide();
	    						$('#no_of_adults_c').parent('td').hide();
	    						
	    						$('#no_of_children_c_label').hide();
	    						$('#no_of_children_c').parent('td').hide();

	    						$('#check_in_c_label').hide();
	    						$('#check_in_c_date').parent('td').parent('tr').hide();

	    						$('#check_out_c_label').hide();
	    						$('#check_out_c_date').parent('td').parent('tr').hide();
    						
								$('#room_no_c_label').hide();
								$('#room_no_c').parent('td').hide();

								$('#room_no_bv_c').parent('td').hide();
								$('#room_no_bv_c_label').hide();

								$('#room_no_cpc_new_c').parent('td').hide();
								$('#room_no_cpc_new_c_label').hide();

								$('#room_no_cpc_old_c').parent('td').hide();
								$('#room_no_cpc_old_c_label').hide();    							

								$('#room_no_ndc_c').parent('td').hide();
								$('#room_no_ndc_c_label').hide();

								$('#extra_bed_c_label').hide();
								$('#extra_bed_c').parent('td').hide();

	    					}else{
		    					if($('#location_c').val() == 'CPC_NEW' || $('#location_c').val() == 'CPC_OLD'){
		    						depedentGuestTypeCPC();
		    					}else if($('#location_c').val() == 'Bella Vista'){
		    						depedentGuestTypeBV();
		    					}else if($('#location_c').val() == 'NDC'){
		    						depedentGuestTypeNDC();
		    					}else{
		    						resetGuestTypeDropdowns();
		    					}

								$('#no_of_adults_c_label').show();
	    						$('#no_of_adults_c').parent('td').show();
	    						
	    						$('#no_of_children_c_label').show();
	    						$('#no_of_children_c').parent('td').show();

	    						$('#check_in_c_label').show();
	    						$('#check_in_c_date').parent('td').parent('tr').show();

	    						$('#check_out_c_label').show();
	    						$('#check_out_c_date').parent('td').parent('tr').show();

	    					}

	    				});


	    				function dependentDropdowns(){
	    					if($('#location_c').val() == 'CPC_NEW'){
	    						 $('#type_of_room_c').find('option').remove();
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Double Occupancy Room").text("Double Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Single Occupancy Room").text("Single Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Reserved").text("Reserved"));


	    					}else if($('#location_c').val() == 'CPC_OLD'){
	    						$('#type_of_room_c').find('option').remove();
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Double Occupancy Room").text("Double Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Single Occupancy Room").text("Single Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Reserved").text("Reserved"));
	    					}else if($('#location_c').val() == 'NDC'){
	    						$('#type_of_room_c').find('option').remove();
	    						$('#type_of_room_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    						$('#type_of_room_c').append($("<option></option>").attr("value","Reserved").text("Reserved"));
	    					}else if($('#location_c').val() == 'Bella Vista'){
	    						 $('#type_of_room_c').find('option').remove();
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Double Occupancy Room").text("Double Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Single Occupancy Room").text("Single Occupancy Room"));
	    						 $('#type_of_room_c').append($("<option></option>").attr("value","Reserved").text("Reserved"));
	    					}

	    				}

	    				function depedentGuestTypeCPC(){
    						 if($('#type_of_room_c').val() == 'Reserved'){
	    						// $('#guest_type_c').find('option').remove();
	    						//  $('#guest_type_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    						//  $('#guest_type_c').append($("<option></option>").attr("value","Student").text("Student"));
	    						//  $('#guest_type_c').append($("<option></option>").attr("value","Other").text("Other"));
    						 }else{
    						 	// resetGuestTypeDropdowns();
    						 }	    					
	    				}

	    				function depedentGuestTypeBV(){
    						//  if($('#type_of_room_c').val() == 'Reserved'){
	    					// 	$('#guest_type_c').find('option').remove();
	    					// 	 $('#guest_type_c').append($("<option></option>").attr("value","").text(""));
	    						 
	    					// 	 $('#guest_type_c').append($("<option></option>").attr("value","Guest Faculty").text("Guest Faculty"));
    						//  }else{
	    					// 	resetGuestTypeDropdowns();
	    					// }
	    				}

						function depedentGuestTypeNDC(){
    						 // if($('#type_of_room_c').val() == 'Reserved'){
	    						// $('#guest_type_c').find('option').remove();
	    						//  $('#guest_type_c').append($("<option></option>").attr("value","DG").text("DG"));
	    						 
	    						//  $('#guest_type_c').append($("<option></option>").attr("value","Faculty").text("Faculty"));
    						 // }else{
    						 // 	resetGuestTypeDropdowns();
    						 // }	    					
	    				}

	    				function resetGuestTypeDropdowns(){
    				// 		 $('#guest_type_c').find('option').remove();
	    					 
	    			// 		 $('#guest_type_c').append($("<option></option>").attr("value","").text(""));
    						 
    				// 		 $('#guest_type_c').append($("<option></option>").attr("value","DG").text("DG"));
    						 
    				// 		 $('#guest_type_c').append($("<option></option>").attr("value","Faculty").text("Faculty"));
    						 
    				// 		 $('#guest_type_c').append($("<option></option>").attr("value","Student").text("Student"));
    						 
    				// 		 $('#guest_type_c').append($("<option></option>").attr("value","Other").text("Other"));
    						 
    				// 		 $('#guest_type_c').append($("<option></option>").attr("value","Participants").text("Participants"));
							 
							 // $('#guest_type_c').append($("<option></option>").attr("value","Guest Faculty").text("Guest Faculty"));	    					
	    				}

						// $( document ).ajaxStop(function() {
						//   	SUGAR.ajaxUI.hideLoadingPanel();
						// });	    	

						// $( document ).ajaxSend(function() {
						//   SUGAR.ajaxUI.showLoadingPanel();						  	
						// });	

						// $( document ).ajaxStart(function() {
						//   SUGAR.ajaxUI.showLoadingPanel();						  	
						// });		


	    			var fetch_rooms_button = '&nbsp;&nbsp;<a href="javascript:;" class="btn btn-sm fetch_rooms_button" >Fetch Rooms</a>';
					$('#room_no_cpc_old_c').after(fetch_rooms_button);						
					$('#room_no_cpc_new_c').after(fetch_rooms_button);						
					$('#room_no_bv_c').after(fetch_rooms_button);						

					$('.fetch_rooms_button').click(function(){
						SUGAR.ajaxUI.showLoadingPanel();
						hideLoader();
		
	    					setTimeout(function(){
								var datetime = $('#check_in_c').val();
								var datetimeCO = $('#check_out_c').val();

								$.ajax({
								  method: "POST",
								  url: "index.php?entryPoint=ajaxCall",
								  data: {datetime:datetime, datetimeCO:datetimeCO, type:"getAccommodationsRooms",accommodation_type:$('accommodation_type_c').val(),location:$('#location_c').val(),type_of_room:$('#type_of_room_c').val(), guest_type: $('#guest_type_c').val()}
								}).success(function(rsp){
									rsp = JSON.parse(rsp);
									
									if(rsp.Success == true){
										
										if(rsp.data.rooms_booked){
											
											var rooms_booked = rsp.data.rooms_booked.split(',');
											var rooms_booked = rooms_booked.map(function (x) { 
											    return parseInt(x); 
											});
											var i;
											// console.log(rooms_booked);

											if($('#location_c').val() == 'Bella Vista'){
												
												for(i=0;i<rooms_booked.length;i++){
													// console.log($("#room_no_bv_c option[value="+rooms_booked[i]+"]"));
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_bv_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_bv_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_bv_c > option').length == 1){
													if($('#room_no_bv_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														$('#dialog').dialog();				
													}
												}else if($('#room_no_bv_c > option').length == 0){
													$('#check_in_c_date').val('');
													$('#dialog').dialog();				
												
												}
																				
											}else if($('#location_c').val() == "CPC_NEW"){
												console.log(rooms_booked);
												for(i=0;i<rooms_booked.length;i++){
													
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_cpc_new_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_cpc_new_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_cpc_new_c > option').length == 1){
													if($('#room_no_new_cpc_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														$('#dialog').dialog();				
													}
												}else if($('#room_no_cpc_new_c > option').length == 0){
													$('#check_in_c_date').val('');
													$('#dialog').dialog();				
												
												}												
											}else if($('#location_c').val() == "CPC_OLD"){
												for(i=0;i<rooms_booked.length;i++){
													
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_cpc_old_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_cpc_old_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_cpc_old_c > option').length == 1){
													if($('#room_no_cpc_old_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														$('#dialog').dialog();				
													}
												}else if($('#room_no_cpc_old_c > option').length == 0){
													$('#check_in_c_date').val('');
													$('#dialog').dialog();				
												
												}												
											}else if($('#location_c').val() == "NDC"){
												for(i=0;i<rooms_booked.length;i++){
													
													if({$this->bean->room_no_c} != rooms_booked[i]){
														$("#room_no_ndc_c option[value="+rooms_booked[i]+"]").remove();
													}else{
														$("#room_no_ndc_c option[value="+rooms_booked[i]+"]").attr('selected','selected');
													}
												}	

												if($('#room_no_ndc_c > option').length == 1){
													if($('#room_no_ndc_c option:first').val() == ''){
														$('#check_in_c_date').val('');
														$('#dialog').dialog();				
													}
												}else if($('#room_no_ndc_c > option').length == 0){
													$('#check_in_c_date').val('');
													$('#dialog').dialog();				
												
												}		

    										}else{

											}

										}
									}				
								});		    					
							}, 1000);						
						
	    					
	    				

					});

					extraBedCheck();
					$('#extra_bed_c').click(function(){
						extraBedCheck();						
					});

					function extraBedCheck(){
						if($('#extra_bed_c').is(':checked')){
							$('#no_of_adults_c_label').parent('tr').show();
						}else{
							$('#no_of_adults_c_label').parent('tr').hide();

						}
					}

					//participant dropdown logic

					$('#participant_list_c').after('&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="addlist">Add</button>');

					$('#participants_c').parent('td').hide();
					$('#participants_c_label').hide();
					

					var participant_array = [];
					var addedlist = [];
					function fetchParticipant(){
						
						$.ajax({
							type:'GET',
							url:'index.php?entryPoint=ajaxCall',
							data:{type:'getparticipantlistAccommodation',pid:$('#project_scrm_accommodation_1project_ida').val()},
							async:false,
							dataType:'json',
							beforeSend:function(){
							},
							complete:function(){
							},
							success:function(res)
							{
								participant_array = [];
								
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
									});
									
									$('#participant_list_c').html(options);
									

								}else{
									$('#participant_c').html('');
									$('#participants').val('');
								}
							}
						});
						
					}

					fetchParticipant();
					pushParticipantListAuto(participant_array,addedlist);
					function pushParticipantListAuto(participant_array,addedlist){
						if($('#participants_c').val().length){
							var list = JSON.parse($('#participants_c').val());

							for (var x in list){
							  if (list.hasOwnProperty(x)){
							
							
						  		var add_name = {
						  			"name":list[x].name,
						  			"id":list[x].id,
						  		};	
						  		console.log(list);	
						  		participant_array.push(add_name);
							    $('.list-group').append('<li class="list-group-item" >'+list[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+list[x].id+'" data-type="'+list[x].type+'"></span></li>');	    
							  }
							}
							
						}
					}

				  	$('#addlist').on('click',function(){
				 		if($('#type_of_room_c').val() == "Single Occupancy Room"){
				 			if (participant_array.length > 0) {
				 				alert('You can not add more than one participants in Single Occupancy Room!');
				 				return true;
				 			}
				 		}

				  		var pname = $('#participant_list_c :selected').text();
				  		var pid = $('#participant_list_c').val();
				  		var type = $('#participant_list_c :selected').data('type');
				  		if(!pname){
				  			alert('Please select the participant to add in list');
				  			return;
				  		}

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

				  		participant_array.push(add_name);
				  		addParticipantList(participant_array);
				  		$('#participants_c').val(JSON.stringify(participant_array));		
					});

					function addParticipantList(participant_array){

						var list = '';

						for (var x in participant_array){
						  if (participant_array.hasOwnProperty(x)){
						    list += '<li class="list-group-item"  >'+participant_array[x].name+'<span style="float:right" class="glyphicon glyphicon-remove delete" id="'+participant_array[x].id+'" data-type="'+participant_array[x].type+'"></span></li>';
						  }	
						}

						$('.list-group').html(list);
					}

					// $('.delete').on('click',function(){
					$(document).on('click','.delete',function(){
						var participant_array1 = participant_array;
				
						// console.log("existing list"+participant_array1);
						participant_array = [];
						$('#'+$(this).attr("id")).parent().hide();
						for (var x in participant_array1){
						  if (participant_array1.hasOwnProperty(x)){

						  	if(participant_array1[x].id != $(this).attr("id"))
						  	{
						  		var add_name = {
						  			"name":participant_array1[x].name,
						  			"id":participant_array1[x].id,
						  			"type": participant_array1[x].type
								};
							  	participant_array.push(add_name);
						  	}
						  }	
						}

						// calculateAmount(participant_array,'AP','');
						// console.log("New List"+participant_array);
						$('#participants_c').val(JSON.stringify(participant_array));				
					});	

					
								
								
    			});
    		</script>
EOD;
 		parent::display();
    }
}
