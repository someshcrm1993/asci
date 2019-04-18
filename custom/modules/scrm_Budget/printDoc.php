<?php
	ini_set('display_errors', 'on');
	$bean = BeanFactory::getBean('scrm_Budget',$_REQUEST['id']);
	$programme_bean = BeanFactory::getBean('Project',$bean->project_scrm_budget_1project_ida);

	$str = strtotime($programme_bean->end_date_c) - strtotime($programme_bean->start_date_c);
	
	$datediff = floor($str/3600/24) + 1;

	$file="Internal_Budget.xls";
	
	$module = BeanFactory::newBean('scrm_Budget');
	$sum = '';
	foreach ($module->field_name_map as $key => $value) {
		
		if (isset($value['labelValue'])) {
			if ($value['name'] != 'dotp_assigned_user_c' && $value['name'] != 'cd_assigned_to_c' && $value['name'] != 'ac_assigned_to_c'  && $value['name'] != 'dotp_approval_c' && $value['name'] != 'ac_approval_c' && $value['name'] != 'remark_ac_c' && $value['name'] != 'study_tour_currency_c' && $value['name'] != 'currency_id' && $value['name'] != 'dotp_approval_c' && $value['name'] != 'cd_approval_c' && $value['name'] != 'remark_dotp_c' && $value['name'] != 'remark_cd_c') {
				if (strpos($value['name'], '_c') !== false) {
					$sum .= ",scrm_budget_cstm.".$value['name'];
				}else{
					$sum .= ",scrm_budget.".$value['name'];
				}

			}

		}
	}

	$sum = ltrim($sum, ',');
	// echo $sum;exit;
	$id = $_REQUEST['id'];
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
		AND scrm_budget.id = '{$id}'
	";
	// echo $query;exit;
	$query2=$connection->prepare($query);

	$query2->execute();		
	$row = $query2->fetch(PDO::FETCH_ASSOC);
	$data = '';
	// foreach ($module->field_name_map as $key => $value) {
		
	// 	if (isset($value['labelValue'])) {
	// 		if ($value['name'] != 'dotp_assigned_user_c' && $value['name'] != 'cd_assigned_to_c' && $value['name'] != 'ac_assigned_to_c' && $value['name'] != 'ac_approval_c' && $value['name'] != 'remark_ac_c' && $value['name'] != 'study_tour_currency_c' && $value['name'] != 'currency_id' && $value['name'] != 'dotp_approval_c' && $value['name'] != 'cd_approval_c' && $value['name'] != 'remark_dotp_c' && $value['name'] != 'remark_cd_c') {
	// 			$data .= '<tr>';
	// 			$data .='<td style="text-align: left!important;width: 254px;">';
	// 			$data .= $value['labelValue'];
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';				

	// 			$data .='<td>';
	// 			$data .= number_format($row[$value['name']], 2);
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';

	// 			$data .='<td>';
	// 			$data .='';
	// 			$data .='</td>';																
	// 			$data .= '</tr>';
	// 		}
	// 	}
	// }


		$data .= '<tr>';
		$data .= '<td><strong>A</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>INCOME</strong>';

		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
							
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .='<td>';
		$data .='A1';
		$data .='</td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Programme fee per Indian participant (INR)';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['prg_fee_per_participant_c'], 2);
		$data .='</td>';
											
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>A2</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'No. of Indian Participants';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= $row['no_of_participants_c'];
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>A3</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Programme fee per foreign participant USD';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['prog_fee_per_participant_usd_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>A4</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'No. of foreign/USD Participants';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['no_foreign_usd_participants_c'], 2);
		$data .='</td>';
																			
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';						


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>Total Programme Income(A)</b>';
		$data .='</td>';
						
		$data .='<td colspan="2">';
		$data .= number_format($row['total_programme_income_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b></b>';
		$data .='</td>';
		
		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';

		$data .= '<tr>';
		$data .= '<td><strong>B</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'PROGRAMME EXPENDITURE';

		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
																
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';

		
		$data .= '<tr>';
		$data .= '<td><strong>i.</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Direct Cash Expenditure</strong>';
																									
		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B1</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Brochure Printing Costs';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['brochure_printing_costs_c'], 2);
		$data .='</td>';
			
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B13</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Advertisement Cost';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['advertisement_cost_c'], 2);
		$data .='</td>';
									
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B2</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Mailing Costs';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['mailing_costs_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B3</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Training Kit: No of participants +2';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['training_kit_c'], 2);
		$data .='</td>';
			
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B4</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Group Photo: No of pp + 4';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['group_photo_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B5</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Books, Journals, Case Studies etc.';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['books_journals_etc_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B6</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Mess Charges';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['mess_charges_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B7</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Hostel Charges';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['hostel_charges_c'], 2);
		$data .='</td>';
			
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';
		
		
		$data .= '<tr>';
		$data .= '<td><strong>B8</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Arrival & Departure Cost of participants';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['arrival_departure_cost_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Study Tour (Domestic & Overseas) - all inclusive';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['study_tour_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '';
		$data .='</td>';
		
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';

		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Programme Material</strong>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
											
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B9</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Photocopying of reading material (Re.1/- per page x No. of copies)';
		$data .='</td>';

		
		$data .='<td colspan="2">';
		$data .= number_format($row['p_reading_material_c'], 2);
		$data .='</td>';
											
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B9</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Any Other Material for Distribution';
		$data .='</td>';

		
		$data .='<td colspan="2">';
		$data .= number_format($row['material_for_distribution_c'], 2);
		$data .='</td>';
											
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '';
		$data .='</td>';															
		
		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B10</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Guest Faculty Expenditure</strong>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Travel';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['travel_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Honorarium';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['honorarium_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Mementoes';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['mementoes_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Incidentals';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['incidentals_c'], 2);
		$data .='</td>';
																
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Total';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['total_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '';
		$data .='</td>';
		
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B11</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Outbound Training</strong>';
		$data .='</td>';
				
		$data .='<td colspan="2">';
		$data .='';
		$data .='</td>';
									
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Fees';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['fees_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Caps and T Shirts';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['caps_and_t_shirts_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Business Simulation';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['business_simulation_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Module Outsourcing';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['module_outsourcing_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';

		
		$data .= '<tr>';
		$data .= '<td><strong>B12</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Sight Seeing</strong>';
		$data .='</td>';															
		
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Golkonda Sound & Light Show';
		$data .='</td>';
	
		$data .='<td colspan="2">';
		$data .= number_format($row['sound_light_show_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Ramoji Film City';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['ramoji_film_city_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'City Tour';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['city_tour_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';								
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Others Visits';
		$data .='</td>';

		
		$data .='<td colspan="2">';
		$data .= number_format($row['others_visits_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';

		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Bus Charges for Special Visits Including Sightseeting';
		$data .='</td>';

		
		$data .='<td colspan="2">';
		$data .= number_format($row['bus_charges_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B13</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Other Misc Expenditure';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['other_misc_expenditure_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';
		
		$data .= '<tr>';												
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Videography';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['videography_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Hire of Laptops';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['hire_of_laptops_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';

		
		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Cultural Event';
		$data .='</td>';
			
		$data .='<td colspan="2">';
		$data .= number_format($row['cultural_event_c'], 2);
		$data .='</td>';

																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>Sub Total - Cash Expenditure (B i)</b>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['sub_total_cash_exp_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>Contribution available for Overheads (A - B i)</b>';
		$data .='</td>';

		
		$data .='<td colspan="2">';
		$data .= number_format($row['contribution_available_ohds_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>ii.</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Charged Expenditure</strong>';
		$data .='</td>';
		
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';

		$data .= '<tr>';
		$data .= '<td><strong>B14</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Faculty Cost ( @ 35000/- per day)';
		$data .='</td>';

								
		$data .='<td colspan="2">';
		$data .= number_format($row['faculty_cost_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>Sub Total - Charged Expenditure (B ii):</b>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['sub_total_charge_exp_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>iii.</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<strong>Overheads Expenditure</strong>';
		$data .='</td>';
		
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';

		$data .= '<tr>';
		$data .= '<td><strong>B15</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Training infrastructure Overhead (@ 40000/- per day)/ Rs.12000/- per day for off-campus programmes';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['training_infrastructure_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Programmes at ASCI';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['programmes_at_asci_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B16</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Corporate Overhead (@ 25000/- per day)';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['corporate_overhead_c'], 2);
		$data .='</td>';
									
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>B15</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= 'Programmes Off Campus';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['programmes_off_campus_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong></strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>Sub Total - Overhead Expenditure (B iii)</b>';
		$data .='</td>';
								
		$data .='<td colspan="2">';
		$data .= number_format($row['sub_total_overhead_expd_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>C</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>TOTAL EXPENDITURE (B i + B ii + B iii )</b>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['total_expenditure_c'], 2);
		$data .='</td>';
																	
		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';
		$data .= '</tr>';


		$data .= '<tr>';
		$data .= '<td><strong>D</strong></td>';
		$data .='<td style="text-align: left!important;width: 254px;" colspan="4">';
		$data .= '<b>SURPLUS / DEFICIT (A - C)</b>';
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= number_format($row['surplus_deficit_c'], 2);
		$data .='</td>';

		$data .='<td colspan="2">';
		$data .= '';
		$data .='</td>';

		$data .= '</tr>';



	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$file");
	ob_clean();
	$test="<table border='1'>
				<tr style='margin-bottom:5px'>
					<td colspan='9' align='center'><b><u><h4>Administrative Staff College of India<br/>Bella Vista, Hyderabad &#8211 500 082</h4></u></b></td>
				</tr>
				<tr style='margin-bottom:5px'>
					<td colspan='9' align='center'><b><u><h4>Internal Budget for Management Development Programmes</h4></u></b></td>	
				</tr>
				<tr>
					<td width='300px' colspan='2'>Title of the Programme:</td>
					<td colspan='4'>{$programme_bean->name}</td>
					<td colspan='2'>Programme Type:</td>
					<td>{$programme_bean->programme_type_c}</td>					
				</tr>
				<tr>
					<td colspan='2'>Programme Director(s):</td>
					<td colspan='4'>{$programme_bean->assigned_user_name}, {$programme_bean->spd_c}</td>
					<td colspan='2'>No. of Days:</td>
					<td>{$datediff}</td>
				</tr>
				<tr>
					<td colspan='2'>Duration:</td>
					<td colspan='4'>{$programme_bean->start_date_c} - {$programme_bean->end_date_c}</td>
					<td colspan='2'>Programme Code:</td>
					<td>{$programme_bean->programme_id_c}</td>
				</tr>				
		   </table>

		  <table border='1'>
			<thead style='margin-bottom:5px'>
				<tr align='center'>
					<td style='width: 30px;'><b>Sr No.</b></td>
					<td colspan='4'><b>Particulars</b></td>
					<td colspan='2'><b>Budget</b></td>
					<td colspan='2'><b>Actuals</b></td>
				</tr>
			</thead>
			<tbody>
					$data
			</tbody>
		</table>
		   ";

	echo $test;
	exit;

?>	