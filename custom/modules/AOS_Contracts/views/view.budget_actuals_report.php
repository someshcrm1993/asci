<?php
// Written By: Aditya Harshey
// Date: 21 Aug 2017

if(!defined('sugarEntry')) define('sugarEntry', true);
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

// ini_set('display_errors','On');


class AOS_ContractsViewbudget_actuals_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$app_list_strings;
		$where = '';
		$url = $sugar_config['site_url'];	

		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if (!$pid_i) {
			$pid_s = "NULL";
		}else{
			$where .= " AND project.id = {$pid_s} ";
		}

		if (isset($_POST['start_date'])) {
			$sdate = $_POST['start_date'];
			if (!$_POST['start_date']) {
				$sdate = "NULL";
			}else{
				// ob_clean();
				// print_r($sdate);exit();
				$sdate = date_create_from_format('d/m/Y', "$sdate")->format('Y-m-d');
				
				$sdate = "'$sdate'";

				$where .= " AND date(project_cstm.start_date_c) >= {$sdate} ";
			}					
		}else{
			$sdate = "NULL";
		}

		if (isset($_POST['end_date'])) {
			$edate = $_POST['end_date'];
			if (!$_POST['end_date']) {
				$edate = "NULL";
			}else{
				// ob_clean();
				// print_r($edate);exit();
				$edate = date_create_from_format('d/m/Y', "$edate")->format('Y-m-d');
				
				$edate = "'$edate'";
				$where .= " AND date(project_cstm.start_date_c) <= {$edate} ";
			}					
		}else{
			$edate = "NULL";
		}		
		
		$module = BeanFactory::newBean('scrm_Budget');
// ob_clean();
// print_r($module);exit();

		date_default_timezone_set("Asia/Calcutta");
		// ob_clean();
		// while($row = $query->fetch(PDO::FETCH_ASSOC)){
		// 	foreach ($row as $key => $value) {
		// 		echo getFieldInfo($key)."<br>";	
		// 	}
		// 	exit();
		// 	// $data .='<tr>';

		// 	// $data .='</tr>';
		// }
		$sum = '';
		foreach ($module->field_name_map as $key => $value) {
			
			if (isset($value['labelValue'])) {
				if ($value['name'] != 'dotp_assigned_user_c' && $value['name'] != 'cd_assigned_to_c' && $value['name'] != 'ac_assigned_to_c'  && $value['name'] != 'dotp_approval_c' && $value['name'] != 'no_of_participants_c' && $value['name'] != 'ac_approval_c' && $value['name'] != 'remark_ac_c' && $value['name'] != 'study_tour_currency_c' && $value['name'] != 'currency_id' && $value['name'] != 'dotp_approval_c' && $value['name'] != 'cd_approval_c' && $value['name'] != 'remark_dotp_c' && $value['name'] != 'remark_cd_c') {
					$sum = $sum.",SUM(".$value['name'].") as ".$value['name'];
				}

			}
		}

		$sum = ltrim($sum, ',');
		require_once('custom/modules/AOS_Contracts/database.php');
		$query="
			SELECT 
				$sum
			FROM scrm_budget
			INNER JOIN scrm_budget_cstm ON scrm_budget.id = scrm_budget_cstm.id_c
			INNER JOIN project_scrm_budget_1_c ON scrm_budget.id = project_scrm_budget_1_c.project_scrm_budget_1scrm_budget_idb
			INNER JOIN project ON project_scrm_budget_1_c.project_scrm_budget_1project_ida = project.id
			INNER JOIN project_cstm ON project_cstm.id_c = project.id
			WHERE scrm_budget.deleted = '0'
			AND project_scrm_budget_1_c.deleted = '0'
			$where
		";
// echo $query;exit();
		$query2=$connection->prepare($query);

		$query2->execute();		
		$row = $query2->fetch(PDO::FETCH_ASSOC);
		foreach ($module->field_name_map as $key => $value) {
			
			// if (isset($value['labelValue'])) {
			// 	if ($value['name'] != 'dotp_assigned_user_c' && $value['name'] != 'cd_assigned_to_c' && $value['name'] != 'ac_assigned_to_c' && $value['name'] != 'ac_approval_c' && $value['name'] != 'remark_ac_c' && $value['name'] != 'study_tour_currency_c' && $value['name'] != 'currency_id' && $value['name'] != 'dotp_approval_c' && $value['name'] != 'cd_approval_c' && $value['name'] != 'remark_dotp_c' && $value['name'] != 'remark_cd_c') {
			// 		$data .= '<tr>';
			// 		$data .='<td style="text-align: left!important;width: 254px;">';
			// 		$data .= $value['labelValue'];
			// 		$data .='</td>';

			// 		$data .='<td>';
			// 		$data .= number_format($row[$value['name']], 2);
			// 		$data .='</td>';

			// 		$data .='<td>';
			// 		$data .='';
			// 		$data .='</td>';

			// 		$data .='<td>';
			// 		$data .='';
			// 		$data .='</td>';

			// 		$data .='<td>';
			// 		$data .='';
			// 		$data .='</td>';																
			// 		$data .= '</tr>';
			// 	}
			// }
		}

		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>INCOME</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Programme fee per Indian participant (INR)';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['prg_fee_per_participant_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'No. of Indian Participants';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['no_of_participants_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Programme fee per foreign participant USD';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['prog_fee_per_participant_usd_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'No. of foreign/USD Participants';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['no_foreign_usd_participants_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';						



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>Total Programme Income</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['total_programme_income_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';						





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Direct Cash Expenditure</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Brochure Printing Costs';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['brochure_printing_costs_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Advertisement Cost';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['advertisement_cost_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Mailing Costs';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['mailing_costs_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Training Kit: No of participants +2';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['training_kit_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';				




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Group Photo: No of pp + 4';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['group_photo_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Books, Journals, Case Studies etc.';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['books_journals_etc_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Arrival & Departure Cost of participants';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['arrival_departure_cost_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';								




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Study Tour (Domestic & Overseas) - all inclusive';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['study_tour_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';								





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Programme Material</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Photocopying of reading material (Re.1/- per page x No. of copies)';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['p_reading_material_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Any Other Material for Distribution';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['material_for_distribution_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';										




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Guest Faculty Expenditure</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Travel';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['travel_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	


		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Honorarium';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['honorarium_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	






		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Mementoes';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['mementoes_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';												






		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Incidentals';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['incidentals_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Total';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['total_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Outbound Training</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';																





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Fees';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['fees_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Caps and T Shirts';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['caps_and_t_shirts_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Business Simulation';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['business_simulation_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Module Outsourcing';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['module_outsourcing_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';						


		

		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Sight Seeing</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Golkonda Sound & Light Show';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['sound_light_show_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';						





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Ramoji Film City';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['ramoji_film_city_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	





		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'City Tour';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['city_tour_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';								





		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Others Visits';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['others_visits_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';



		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Bus Charges for Special Visits Including Sightseeting';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['bus_charges_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';




		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Other Misc Expenditure';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['other_misc_expenditure_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';												





		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Videography';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['videography_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	





		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Hire of Laptops';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['hire_of_laptops_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		
		



		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Cultural Event';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['cultural_event_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';																




		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>Sub Total - Cash Expenditure (B i)</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['sub_total_cash_exp_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>Contribution available for Overheads (A - B i)</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['contribution_available_ohds_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Charged Expenditure</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Faculty Cost ( @ 35000/- per day)';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['faculty_cost_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	


		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>Sub Total - Charged Expenditure (B ii):</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['sub_total_charge_exp_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';			



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="">';
		$data .= '<strong>Overheads Expenditure</strong>';
		$data .='</td>';															
				$data .='<td>';
		$data .= '';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Training infrastructure Overhead (@ 40000/- per day)/ Rs.12000/- per day for off-campus programmes';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['training_infrastructure_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	




		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Programmes at ASCI';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['programmes_at_asci_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';		



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Corporate Overhead (@ 25000/- per day)';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['corporate_overhead_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= 'Programmes Off Campus';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['programmes_off_campus_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';							



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>Sub Total - Overhead Expenditure (B iii)</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['sub_total_overhead_expd_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>TOTAL EXPENDITURE (B i + B ii + B iii )</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['total_expenditure_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';	



		$data .= '<tr>';
		$data .='<td style="text-align: left!important;width: 254px;">';
		$data .= '<b>SURPLUS / DEFICIT (A - C)</b>';
		$data .='</td>';

		$data .='<td>';
		$data .= number_format($row['surplus_deficit_c'], 2);
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';

		$data .='<td>';
		$data .='';
		$data .='</td>';																
		$data .= '</tr>';													



		//programmes dropdown logic
		$programmes_query = $connection->prepare("SELECT id, name FROM project WHERE deleted = '0'");
		$programmes_query->execute();
		$programmes_dropdown = '<select name="programme" id="programme" class="select2"><option value=""></option>';
		while($row_enquiry=$programmes_query->fetch()){
			if ($pid_i == $row_enquiry['id']) {
				$programmes_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$programmes_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$programmes_dropdown .= '</select>';

		echo '<!DOCTYPE html>
<html lang="en">
	<body>
	<style>
		.select2-container{
			width: 200px!important;
		}
		#dropdowns_table tr td{
			padding: 0!important;
		}
		a{
			cursor: pointer;	
		}

		.fieldLabel{
			text-align: "left!important"
		}
	</style>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h1>Budget vs Actual Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							<td><strong>From: </strong><input type = "text" name = "start_date" id = "start_date" value="'.$_REQUEST["start_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "start_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "fromb",
						align        : "right"});
					</script></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><strong>To: </strong><input type = "text" name = "end_date" id = "end_date" value="'.$_REQUEST["end_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "end_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "tob",
						align        : "right"});
					</script></td>
						</tr>						
					</table>
				</center>
				<br>
				<button type="submit" name="state" class="btn btn-primary">Run</button>
				&nbsp&nbsp&nbsp&nbsp
				<button id="clear"  class="btn btn-primary">Clear</button> 
				&nbsp&nbsp&nbsp&nbsp
				<button id="showquery" data-toggle="collapse" data-target="#demo" class="btn btn-primary btn-sm">Show Query</button>
			</div>
			<div id="showq" class="collapse">
				'.$query.'
			</div>
		</form>
	</body>
</html>';	
// // echo $data;exit();
	echo $html =<<<HTML
		<!DOCTYPE html>
		<html>
		<head>
			<style>
			td,th
			{ text-align:center !important;}
			</style>
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/r-2.2.0/datatables.min.css"/>
				 
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
				<script type="text/javascript" src="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/r-2.2.0/datatables.min.js"></script>
			<script type="text/javascript" language="javascript" class="init">
			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px">
				<section>

					<table id="example" class="table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td>Cost Sheet</td>
								<td>Budget</td>
								<td>Actual</td>
								<td>Variance</td>
								<td>Variance %</td>
							</tr>
						</thead>
						<tbody>
								$data
						</tbody>
					</table>

					
						</div>

					</div>
				</section>
			</div>

		</body>
		 <script>
		  $(document).ready(function(){
			var table = $('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
            		{
		                extend: 'csvHtml5',
		                title: 'Budget_Vs_Actuals_Report'
		            },
            		{
		                extend: 'excelHtml5',
		                title: 'Budget_Vs_Actuals_Report'
		            },
            		{ extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4', title: 'Budget Vs Actuals Report' }
        		],
        		ordering: false,
        		paging: false,
		        searching: false,
			
			} );

			$("#showquery").click(function(){
				$('#showq').toggle();
					return false;
				});
			});
		  </script>
		</html>
			
HTML;



       
	} 

} //end of class
