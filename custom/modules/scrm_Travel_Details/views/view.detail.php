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


require_once('include/MVC/View/views/view.detail.php');

class scrm_Travel_DetailsViewDetail extends ViewDetail {

	function scrm_Travel_DetailsViewDetail(){
 		parent::ViewDetail();
 	}
	
	function display(){
		parent::display();
		echo $js = <<<eod
		<script>
			$(document).ready(function(){
					travelMode();
					var mode = $('#mode_of_travel_c').val() 
				switch (mode) {
					case 'Train':
						$('div[field=starting_city_c]').parent().parent().show();
						$('div[field=flight_train_name_c]').parent().parent().show();
						$('div[field="departure_flight_train_name_c"]').parent().parent().show();
						$('div[field="arrival_date_time_c"]').parent().parent().show();
						$('div[field=destination_station_c]').parent().show();
						$('div[field=destination_airport_c]').parent().hide();
						$('#detailpanel_2').hide();
						break;
					case 'Flight':
						$('div[field=starting_city_c]').parent().parent().show();
						$('div[field=flight_train_name_c]').parent().parent().show();
						$('div[field="departure_flight_train_name_c"]').parent().parent().show();
						$('div[field="arrival_date_time_c"]').parent().parent().show();
						$('div[field=destination_station_c]').parent().hide();
						$('div[field=destination_airport_c]').parent().show();
					    $('#detailpanel_2').hide();
						break;
					case 'Local':
						$('div[field=starting_city_c]').parent().parent().hide();
						$('div[field=flight_train_name_c]').parent().parent().hide();
						$('div[field="departure_flight_train_name_c"]').parent().parent().hide();
						$('div[field="arrival_date_time_c"]').parent().parent().hide();
						
						$('#detailpanel_2').show();
						$('div[field=destination_station_c]').parent().hide();
						$('div[field=destination_airport_c]').parent().hide();
						break;
					default:
						$('div[field=starting_city_c]').parent().parent().hide();
						$('div[field=flight_train_name_c]').parent().parent().hide();
						$('div[field="departure_flight_train_name_c"]').parent().parent().hide();
						$('div[field="arrival_date_time_c"]').parent().parent().hide();
						$('#detailpanel_2').hide();
						$('div[field=destination_station_c]').parent().hide();
						$('div[field=destination_airport_c]').parent().hide();
				}
				if($('#guest_type_c').val() == 'Participant'){
					$('div[field=scrm_partners_scrm_travel_details_1_name]').parent().parent().hide();
					$('div[field=contacts_scrm_travel_details_1_name]').parent().parent().show();
				}else{
					$('div[field=scrm_partners_scrm_travel_details_1_name]').parent().parent().show();
					$('div[field=contacts_scrm_travel_details_1_name]').parent().parent().hide();
				}
			});
			function travelMode(){
				if($('#mode_of_travel_c').val() == 'Train'){
					$('div[field=destination_station_c]').parent().show();
					$('div[field=destination_airport_c]').parent().hide();
				}else{
					$('div[field=destination_station_c]').parent().hide();
					$('div[field=destination_airport_c]').parent().show();
				}
			}
		</script>
eod;
	}
	
}
?>
