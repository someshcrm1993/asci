<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

class scrm_Travel_DetailsViewEdit extends ViewEdit {
	function scrm_Travel_DetailsViewEdit(){
 		parent::ViewEdit();
 	}
	
	function display(){
		parent::display();
    	
    	echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>*Arrival date should be greater than departure!</p><p>*Arrival is available from 72 hours (3 days) before the Programme Start Date & Departure is available upto 72 hours (3 days) after Programme End Date!</p></div>';

	echo $js = <<<eod
		<script>
			$(document).ready(function(){

				$('#destination_station_c_label').parent().hide();
				$('#destination_airport_c_label').parent().hide();
				travelMode();
				$('#mode_of_travel_c').on('change',function(){
					travelMode();
				});
				showGuestTypeFields();
				$('#guest_type_c').on('change',function(){
					showGuestTypeFields();
				});
				$('#contacts_scrm_travel_details_1_name_label').text('Participant');
				//addToValidate('EditView','contacts_scrm_travel_details_1_name','contacts_scrm_travel_details_1_name',true,'Participant');
				//$('#contacts_scrm_travel_details_1_name_label').append('<span class="required">*</span>');
				
				$('#PRIMARY_address_fieldset legend').text('Pick up Address');
				$('#ALT_address_fieldset legend').text('Drop Address');
				$('#alt_address_street_label label').text('Address');

			});
			function showGuestTypeFields(){
				if($('#guest_type_c').val() == 'Participant'){
					$('#scrm_partners_scrm_travel_details_1_name_label').parent().hide();
					$('#contacts_scrm_travel_details_1_name_label').parent().show();
				}else{
					$('#contacts_scrm_travel_details_1_name_label').parent().hide();
					$('#scrm_partners_scrm_travel_details_1_name_label').parent().show();
				}
			}
			function travelMode(){
		
				var mode = $('#mode_of_travel_c').val() 
				switch (mode) {
					case 'Train':
						$('#mode_of_travel_c').closest('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').next('tr').show();
						$('#destination_airport_c_label').parent().hide();
						$('#destination_station_c_label').parent().show();
						$('#detailpanel_2').hide();
					    $('#train_name_c_label').parent('tr').show();
					    $('#flight_name_c_label').parent('tr').hide();
					    $('#departure_train_name_c_label').parent('tr').show();
					    $('#departure_flight_name_c_label').parent('tr').hide();

						break;
					case 'Flight':
						$('#mode_of_travel_c').closest('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').show();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').next('tr').show();
						$('#destination_station_c_label').parent().hide();
					    $('#destination_airport_c_label').parent().show();
					    $('#detailpanel_2').hide();
					    $('#train_name_c_label').parent('tr').hide();
					    $('#flight_name_c_label').parent('tr').show();
					    $('#departure_train_name_c_label').parent('tr').hide();
					    $('#departure_flight_name_c_label').parent('tr').show();

						break;
					case 'Local':
						$('#mode_of_travel_c').closest('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').next('tr').hide();
						$('#detailpanel_2').show();
						$('#destination_airport_c_label').parent().hide();
						$('#destination_station_c_label').parent().hide();
						$('#departure_flight_name_c_label').parent().hide();
						$('#arrival_date_time_c_label').parent().hide();
						// if (address) {
						// 	$.each(address, function(index, val) {
						// 		 $('#'+index).val(val);
						// 	});								
						// }
					
						break;
					default:
						$('#mode_of_travel_c').closest('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').hide();
						$('#mode_of_travel_c').closest('tr').next('tr').next('tr').next('tr').next('tr').hide();
						$('#detailpanel_2').hide();
						$('#destination_airport_c_label').parent().hide();
						$('#destination_station_c_label').parent().hide();
				}

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
                        	console.log('dialog');
                            $('#dialog').dialog();

                            return false;
                        }
                        return true;
                    }
                }

                $('#arrival_date_time_c_trigger').attr('tabindex',2);
                $('#departure_date_time_c_trigger').attr('tabindex',2);

                var p_start_date;
                var p_end_date;
				$(document).on('blur','#project_scrm_travel_details_1_name, #btn_project_scrm_travel_details_1_name, #guest_type_c', function(){
					
						setTimeout(function(){
							var pid = $('#project_scrm_travel_details_1project_ida').val();
                   			
		                    if(pid != ''){
		                        $.ajax({url:'popupproginfo.php', data:{pid1:pid},type:'GET',dataType:'json',success:function(result){

		                            p_start_date=result.a;
		                            p_end_date=result.b;
		                            pcode = result.g;
		                            if(pcode){
		                            	$('#programme_code_c').val(pcode);
		                            }
		                        }
		                        });
		                   }							
						}, 1000);
				});

				// if($('#departure_date_time_c_date').val() == ''){
				// 	$('#room_number_c').parent('td').hide();
				// 	$('#room_number_c_label').hide();					
				// }

				$(document).on('blur','#arrival_date_time_c_trigger, #departure_date_time_c_trigger, #arrival_date_time_c_date, #departure_date_time_c_date', function(){
						
						setTimeout(function(){
							var arrival = $('#arrival_date_time_c_date').val();
	    					var departure = $('#departure_date_time_c_date').val();
							
							// if(departure){
							// 	$('#room_number_c').parent('td').show();
							// 	$('#room_number_c_label').show();
							// }else{
							// 	$('#room_number_c').parent('td').hide();
							// 	$('#room_number_c_label').hide();								
							// }

							if (p_start_date) {
								
	    						var start_date;
	    						var end_date;
	    						
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

	    						console.log('start date '+start_date);
	    						 console.log('end date '+end_date);
	    						 console.log(arrival);
	    						 console.log('p start date '+p_start_date);

	    						
	    						if (start_date != '' && arrival != '') {
	    							var v2 = check_dates(start_date,arrival);
	    							if (!v2) {
	    								$('#arrival_date_time_c_date').val('');	
	    							}
	    							
	    						}

	    						if(start_date != '' && departure != ''){
	    							var v3 = check_dates(start_date,departure);
		    						if (!v3) {
	    								$('#departure_date_time_c_date').val('');	
	    							}
	    						}

	    						if(end_date != '' && departure != ''){
		    						var v4 = check_dates(departure,end_date);  	
		    						if (!v4) {
	    								$('#departure_date_time_c_date').val('');	
	    							}					
	    						}	    						
    						}

    						if(arrival != '' && departure != ''){
    							
	    						var v1 = check_dates(arrival,departure);
	    						if(!v1){
	    							$('#departure_date_time_c_date').val('');
	    							$('#departure_date_time_c').val('');
	    						}
    						}

    					}, 2000);
				});

				// $(document).on('blur','#contacts_scrm_travel_details_1_name, #btn_contacts_scrm_travel_details_1_name',function(){
					
				// 	// roomNoAjax($('#contacts_scrm_travel_details_1contacts_ida').val());
				// });

				// $(document).on('blur','#scrm_partners_scrm_travel_details_1_name, #btn_scrm_partners_scrm_travel_details_1_name',function(){
					
				// 	// roomNoGuestAjax($('#scrm_partners_scrm_travel_details_1scrm_partners_ida').val());
				// });				

				// function roomNoAjax(id){
				// 	$.ajax({
				// 	  method: "POST",
				// 	  url: "index.php?entryPoint=ajaxCall",
				// 	  data: {type:"getAccommodationsOfParticipant",pid: id}
				// 	}).success(function(rsp){
				// 		rsp = JSON.parse(rsp);
						
				// 		if(rsp.Success == true){
				// 			if(rsp.data){
				// 				$('#room_number_c').val(rsp.data);
				// 			}
				// 		}
				// 	});					
				// }
				// var address;
				// function roomNoGuestAjax(id){
				// 	$.ajax({
				// 	  method: "POST",
				// 	  url: "index.php?entryPoint=ajaxCall",
				// 	  data: {type:"getAccommodationsOfGuest",gid: id}
				// 	}).success(function(rsp){
				// 		rsp = JSON.parse(rsp);
						
				// 		if(rsp.Success == true){
				// 			if(rsp.data.room_no_c){
				// 				$('#room_number_c').val(rsp.data.room_no_c);
				// 			}

				// 			address = rsp.data.address;
				// 			$.each(rsp.data.address, function(index, val) {
				// 				 $('#'+index).val(val);
				// 			});
				// 		}
				// 	});					
				// }		

			}
			
		</script>
eod;
	}
}
?>
