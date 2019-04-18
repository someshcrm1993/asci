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

class AOS_ContractsViewadmin_arrangements_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$app_list_strings;
		// ob_clean();
		// echo "<pre>";
		// print_r($app_list_strings);exit();
		$where = '';
		$url = $sugar_config['site_url'];	

		$proposal_status = $_POST['proposal_status'];
		$proposal_status = "'$proposal_status'";
		if (!$_POST['proposal_status']) {
			$proposal_status = "NULL";
		}

		$outcome_status = $_POST['outcome_status'];
		$outcome_status = "'$outcome_status'";
		if (!$_POST['outcome_status']) {
			$outcome_status = "NULL";
		}

		$organisation = $_POST['organisation'];
		$organisation = "'$organisation'";
		if (!$_POST['organisation']) {
			$organisation = "NULL";
		}

		$date = $_POST['from_date'];
		if (!$_POST['from_date']) {
			$date = "NULL";
		}else{
			// ob_clean();
			// print_r($date);exit();
			$date = date_create_from_format('d/m/Y', "$date")->format('Y-m-d');
			
			$date = "'$date'";
			$where .= " AND project_cstm.start_date_c = {$date} ";
		}

		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if (!$pid_i) {
			$pid_s = "NULL";
		}else{
			$where .= " AND project.id = {$pid_s} ";
		}

		$director_i = $_POST['director'];
		$director_s = "'$director_i'";
		if (!$director_i) {
			$director_s = "NULL";
		}else{
			$where .= " AND project.assigned_user_id = {$director_s} ";
		}		
		// ob_clean();

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					securitygroups.name as center,
					project_cstm.programme_fee_c,
					project.name as project_name,
					project_cstm.area_subjects_c as area,
					project_cstm.start_date_c,
					project_cstm.end_date_c,
					project.id as pid,
					scrm_admin_arranges.id as aa_id,
					scrm_admin_arranges_cstm.airo_briefing_date_and_time_c as airo_briefing,
					scrm_admin_arranges_cstm.inauguration_date_time_c as course_inauguration,
					scrm_admin_arranges_cstm.group_photograph_date_time_c as group_photograph,
					scrm_admin_arranges_cstm.conference_room_c as conference_room,
					scrm_admin_arranges_cstm.no_of_participants_c as no_of_participants_c,
					scrm_admin_arranges_cstm.special_event_date_time_c as special_event_date_time_c,
					scrm_admin_arranges_cstm.pc_lcd_date_time_c as pc_lcd_date_time_c,
					scrm_admin_arranges_cstm.audio_recording_2_c as audio_recording_2_c,
					scrm_admin_arranges_cstm.audio_recording_1_date_time_c as audio_recording_1_date_time_c,
					scrm_admin_arranges_cstm.video_recording_1_date_time_c as video_recording_1_date_time_c,
					scrm_admin_arranges_cstm.video_recording_2_c as video_recording_2_c,
					scrm_admin_arranges_cstm.other_audio_visual_aids_c as other_audio_visual_aids_c,
					scrm_admin_arranges_cstm.other_c as other_c,
					scrm_admin_arranges_cstm.approval_airo_c as approval_airo_c,
					scrm_admin_arranges_cstm.yoga_date_time_c as yoga_date_time_c,
					scrm_bouquets_cstm.number_of_bouquets_c as number_of_bouquets_c,
					scrm_bouquets_cstm.date_time_c as bouquet_date,
					GROUP_CONCAT(scrm_industry_educational_visits.name) as educational_visit_name,	
					GROUP_CONCAT(scrm_industry_educational_visits_cstm.address_location_c) as educational_visit_location,	
					GROUP_CONCAT(scrm_industry_educational_visits_cstm.date_time_c) as educational_visit_date_time_from,	
					GROUP_CONCAT(scrm_industry_educational_visits_cstm.date_time_to_c) as educational_visit_date_time_to,	
					GROUP_CONCAT(scrm_industry_educational_visits_cstm.participants_c) as educational_visit_participants,	
					GROUP_CONCAT(scrm_stationery.name) as stationary_items,	
					GROUP_CONCAT(scrm_stationery_cstm.participants_c) as stationary_participants,	
					GROUP_CONCAT(scrm_stationery_cstm.faculty_c) as stationary_faculty,	
					GROUP_CONCAT(scrm_stationery_cstm.others_c) as stationary_others,	
					GROUP_CONCAT(scrm_stationery_cstm.total_c) as stationary_total,	
					GROUP_CONCAT(scrm_social_recreational_events_cstm.events_c) as social_events,	
					GROUP_CONCAT(scrm_social_recreational_events_cstm.start_date_time_c) as social_start_date_time,	
					GROUP_CONCAT(scrm_social_recreational_events_cstm.end_date_time_c) as social_end_date_time,	
					GROUP_CONCAT(scrm_social_recreational_events_cstm.participants_c) as social_participants,	
					GROUP_CONCAT(scrm_sightseeing_visits_cstm.visit_names_c) as sight_visits,	
					GROUP_CONCAT(scrm_sightseeing_visits_cstm.start_date_time_c) as sight_start_date_time,	
					GROUP_CONCAT(scrm_sightseeing_visits_cstm.end_date_time_c) as sight_end_date_time,	
					GROUP_CONCAT(scrm_sightseeing_visits_cstm.participants_c) as sight_participants,	
					CONCAT(users.first_name ,' ', users.last_name) as ppd
				FROM scrm_admin_arranges
				LEFT JOIN scrm_admin_arranges_cstm ON scrm_admin_arranges_cstm.id_c = scrm_admin_arranges.id
				LEFT JOIN scrm_admin_arranges_project_1_c ON scrm_admin_arranges_project_1_c.scrm_admin_arranges_project_1scrm_admin_arranges_ida = scrm_admin_arranges.id
				LEFT JOIN project ON project.id = scrm_admin_arranges_project_1_c.scrm_admin_arranges_project_1project_idb
				LEFT JOIN project_cstm ON project.id = project_cstm.id_c
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = scrm_admin_arranges.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				LEFT JOIN users ON users.id = project.assigned_user_id
				LEFT JOIN users_cstm ON users_cstm.id_c = users.id
				LEFT JOIN scrm_admin_arranges_scrm_bouquets_1_c ON scrm_admin_arranges_scrm_bouquets_1_c.scrm_admin_arranges_scrm_bouquets_1scrm_admin_arranges_ida = scrm_admin_arranges.id
				LEFT JOIN scrm_bouquets_cstm ON scrm_bouquets_cstm.id_c = scrm_admin_arranges_scrm_bouquets_1_c.scrm_admin_arranges_scrm_bouquets_1scrm_bouquets_idb
				LEFT JOIN scrm_admin_arranges_scrm_industry_educational_visits_1_c ON scrm_admin_arranges_scrm_industry_educational_visits_1_c.scrm_admin7cf8rranges_ida = scrm_admin_arranges.id
				LEFT JOIN scrm_industry_educational_visits_cstm ON scrm_industry_educational_visits_cstm.id_c = scrm_admin_arranges_scrm_industry_educational_visits_1_c.scrm_admina997_visits_idb
				LEFT JOIN scrm_industry_educational_visits ON scrm_industry_educational_visits.id = scrm_industry_educational_visits_cstm.id_c
				LEFT JOIN scrm_admin_arranges_scrm_stationery_1_c ON scrm_admin_arranges_scrm_stationery_1_c.scrm_admin_arranges_scrm_stationery_1scrm_admin_arranges_ida = scrm_admin_arranges.id
				LEFT JOIN scrm_stationery ON scrm_stationery.id = scrm_admin_arranges_scrm_stationery_1_c.scrm_admin_arranges_scrm_stationery_1scrm_stationery_idb
				LEFT JOIN scrm_stationery_cstm ON scrm_stationery_cstm.id_c = scrm_stationery.id
				LEFT JOIN scrm_admin_arranges_scrm_social_recreational_events_1_c ON scrm_admin_arranges_scrm_social_recreational_events_1_c.scrm_admin783erranges_ida = scrm_admin_arranges.id
				LEFT JOIN scrm_social_recreational_events_cstm ON scrm_social_recreational_events_cstm.id_c = scrm_admin_arranges_scrm_social_recreational_events_1_c.scrm_admin33ed_events_idb
				LEFT JOIN scrm_admin_arranges_scrm_sightseeing_visits_1_c ON scrm_admin_arranges_scrm_sightseeing_visits_1_c.scrm_admin813crranges_ida = scrm_admin_arranges.id
				LEFT JOIN scrm_sightseeing_visits_cstm ON scrm_sightseeing_visits_cstm.id_c = scrm_admin_arranges_scrm_sightseeing_visits_1_c.scrm_admin9c30_visits_idb
				WHERE scrm_admin_arranges.deleted = '0'
				$where 
				GROUP BY scrm_admin_arranges.id";

				// AND opportunities_cstm.asci_proposal_status_c = IFNULL({$proposal_status},opportunities_cstm.asci_proposal_status_c)
				// AND opportunities_cstm.asci_proposal_outcome_c = IFNULL({$outcome_status},opportunities_cstm.asci_proposal_outcome_c)
				// AND (date(project_cstm.start_date_c) = IFNULL({$date},project_cstm.start_date_c) OR project_cstm.start_date_c IS NULL)				
				// AND (project.id = IFNULL({$pid_s},project.id) OR project_cstm.scrm_partners_id_c = IFNULL({$pid_s},project_cstm.scrm_partners_id_c))
				// AND project.assigned_user_id = IFNULL({$director_s},project.assigned_user_id)

		// print_r($query);exit();

		//organisations dropdown logic
		$org_query = $connection->prepare("SELECT id, name FROM accounts WHERE deleted = '0'");
		$org_query->execute();
		$org_dropdown = '<select name="organisation" id="organisation" class="select2"><option value=""></option>';
		while($row_enquiry=$org_query->fetch()){
			if ($_POST['organisation'] == $row_enquiry['id']) {
				$org_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$org_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$org_dropdown .= '</select>';	

		//Area dropdown logic
		$proposal_status_dropdown='<select name="proposal_status" id="proposal_status" class="select2"><option value=""></option>';
		unset($app_list_strings['asci_proposal_status_list'][""]);
		foreach ($app_list_strings['asci_proposal_status_list'] as $key => $value) {
			if ($_POST['proposal_status'] == $key) {
				$proposal_status_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$proposal_status_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$proposal_status_dropdown.='</select>';		

		//Source dropdown logic
		$outcome_status_dropdown='<select name="outcome_status" id="outcome_status" class="select2"><option value=""></option>';
		unset($app_list_strings['asci_proposal_outcome_list'][""]);
		foreach ($app_list_strings['asci_proposal_outcome_list'] as $key => $value) {
			if ($_POST['outcome_status'] == $key) {
				$outcome_status_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$outcome_status_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$outcome_status_dropdown.='</select>';

		//directors dropdown logic
		$directors_query = $connection->prepare("SELECT users.id, CONCAT(users.first_name,' ',users.last_name) as name FROM acl_roles INNER JOIN acl_roles_users ON acl_roles_users.role_id = acl_roles.id INNER JOIN users ON acl_roles_users.user_id = users.id WHERE acl_roles_users.deleted = '0' AND acl_roles.deleted = '0' AND acl_roles_users.role_id = '270734b1-0242-9157-7a2e-590ff7943164' AND users.deleted = '0'");
		$directors_query->execute();
		$directors_dropdown = '<select name="director" id="director" class="select2"><option value=""></option>';
		while($row_enquiry=$directors_query->fetch()){
			if ($_POST['director'] == $row_enquiry['id']) {
				$directors_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$directors_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$directors_dropdown .= '</select>';

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
	</style>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h1>Admin Arrangements report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programme Directors</b></td>
							<td width="1%" style="text-align: left !important;">'.$directors_dropdown.'</td>						
						</tr>
						<tr>
							
							<td width="1%" style="text-align: left !important;"><b>Programme Name</b></td>
							<td width="1%" style="text-align: left !important;">'.$programmes_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Start Date</b></td>
							<td width="1%" style="text-align: left !important;">
								<input type = "text" name = "from_date" id = "from_date" value="'.$_REQUEST["from_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
								<script type="text/javascript">
									Calendar.setup({inputField   : "from_date",
									ifFormat      :    "%d/%m/%Y", 
									button       : "fromb",
									align        : "right"});
								</script>
							</td>
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
		$query=$connection->prepare($query);

		$query->execute();
		date_default_timezone_set("Asia/Calcutta");

		while($row_enquiry=$query->fetch()){
			$data .='<tr>';
			
			$project = BeanFactory::getBean('Project', $row_enquiry['pid']);
			
			// $s = SecurityGroup::getGroupWhere($alias, $project->module_dir, $project->id);
			// print_r($project->get_linked_beans('securitygroups_project'));exit;
			$sql = $db->query("SELECT securitygroups.name as center from project INNER JOIN securitygroups_records ON securitygroups_records.record_id = project.id
				INNER JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id where project.id = '{$project->id}' AND securitygroups.deleted = '0' AND securitygroups_records.deleted = '0'");
			$str = '';
			while($row = $db->fetchByAssoc($sql)){
				// print_r($row);exit;
				$str .= ' ,'.$row['center']; 
			}
			$str = ltrim($str, ' ,');

			$data .='<td>'.$str.'</td>';
			$data .='<td>'.$row_enquiry['area'].'</td>';
			$data .='<td><a href = "index.php?module=scrm_Admin_Arranges&action=DetailView&record='.$row_enquiry['aa_id'].'">'.$row_enquiry['project_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['ppd'].'</td>';
			$data .='<td>'.($row_enquiry['start_date_c'] == '' ? '' : date('d-m-Y ',strtotime($row_enquiry['start_date_c']))).'</td>';
			$data .='<td>'.($row_enquiry['end_date_c'] == '' ? '' : date('d-m-Y',strtotime($row_enquiry['end_date_c']))).'</td>';
			$data .='<td>'.($row_enquiry['course_inauguration'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['course_inauguration'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.($row_enquiry['airo_briefing'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['airo_briefing'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['conference_room'].'</td>';
			$data .='<td>'.($row_enquiry['group_photograph'] == '' ? '' : date('d-m-Y',strtotime($row_enquiry['group_photograph'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['no_of_participants_c'].'</td>';
			$data .='<td>'.($row_enquiry['special_event_date_time_c'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['special_event_date_time_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['pc_lcd_date_time_c'].'</td>';
			$data .='<td>'.($row_enquiry['audio_recording_1_date_time_c'] == '' ? '' :date('d-m-Y H:i',strtotime($row_enquiry['audio_recording_1_date_time_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.($row_enquiry['audio_recording_2_c'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['audio_recording_2_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.($row_enquiry['video_recording_1_date_time_c'] == '' ? '': date('d-m-Y H:i',strtotime($row_enquiry['video_recording_1_date_time_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.($row_enquiry['video_recording_2_c'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['video_recording_2_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['other_c'].'</td>';
			$data .='<td>'.$row_enquiry['other_audio_visual_aids_c'].'</td>';
			$data .='<td>'.($row_enquiry['yoga_date_time_c'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['yoga_date_time_c'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.str_replace('^', '', $row_enquiry['approval_airo_c']).'</td>';
			$data .='<td>'.$row_enquiry['number_of_bouquets_c'].'</td>';
			$data .='<td>'.($row_enquiry['bouquet_date'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['bouquet_date'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['educational_visit_name'].'</td>';
			$data .='<td>'.$row_enquiry['educational_visit_participants'].'</td>';
			$data .='<td>'.($row_enquiry['educational_visit_date_time_from'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['educational_visit_date_time_from'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.($row_enquiry['educational_visit_date_time_to'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['educational_visit_date_time_to'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$row_enquiry['stationary_items'].'</td>';
			$data .='<td>'.$row_enquiry['stationary_faculty'].'</td>';
			$data .='<td>'.$row_enquiry['stationary_participants'].'</td>';
			$data .='<td>'.$row_enquiry['stationary_total'].'</td>';
			$data .='<td>'.$app_list_strings['events_list'][$row_enquiry['social_events']].'</td>';
			$data .='<td>'.$row_enquiry['social_participants'].'</td>';
			$data .='<td>'.($row_enquiry['social_start_date_time'] == '' ? '': date('d-m-Y H:i',strtotime($row_enquiry['social_start_date_time'].' +5 hours +30 minutes'))).'</td>';
			// $data .='<td>'.($row_enquiry['social_end_date_time'] == '' ? '' : date('d-m-Y H:i',strtotime($row_enquiry['social_end_date_time'].' +5 hours +30 minutes'))).'</td>';
			$data .='<td>'.$app_list_strings['visit_names_list'][$row_enquiry['sight_visits']].'</td>';
			$data .='<td>'.$row_enquiry['sight_participants'].'</td>';
			// $data .='<td>'.$row_enquiry['Expectations'].'</td>';
			// $data .='<td>'.$row_enquiry['Present_Responsibility'].'</td>';
			$data .='</tr>';
		}
// // echo $data;exit();
	echo $html =<<<HTML
		<!DOCTYPE html>
		<html>
		<head>
			<style>
			td,th
			{ text-align:center !important;}
			</style>
			<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
			<link rel="stylesheet" href="custom/modules/AOS_Contracts/Report.css" type="text/css">
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0"/>

			<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
			<script type="text/javascript" language="javascript" class="init">
			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px">
				<section>

					<table id="example" class="table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>

								<td>Center</td>
								<td>Area</td>
								<td>Programme Name</td>
								<td>Programme Directors</td>
								<td>Start Date</td>
								<td>End Date</td>
								<td>Course Inauguration</td>
								<td>AIRO Briefing</td>
								<td>Conference Room</td>
								<td>Group Photograph</td>
								<td>No. of participants</td>
								<td>Any other special event</td>
								<td>PC & LCD (Display)</td>
								<td>Audio Recording-1</td>
								<td>Audio Recording -2</td>
								<td>Video Recording - 1</td>
								<td>Video Recording-2</td>
								<td>Other</td>
								<td>Other (Date and Time)</td>
								<td>Yoga</td>
								<td>AIRO Approval</td>
								<td>Number of Bouquets</td>
								<td>Bouquets Date & Time</td>
								<td>Industry Visits Organisation</td>
								<td>Industry Visits Participants</td>
								<td>Industry Visits Date Time From</td>
								<td>Industry Visits Date Time To</td>
								<td>Stationary Item/Set</td>
								<td>Stationary Faculty</td>
								<td>Stationary Participants</td>
								<td>Stationary Total</td>
								<td>Social/Recreational Event</td>
								<td>Social/Recreational Pariticipants</td>
								<td>Social/Recreational Start Date And Time</td>
								
								<td>Sightseeing Visit Name</td>
								<td>Sightseeing Visits Participants</td>
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
		                    title: 'Admin Arrangements report',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'Admin Arrangements report',
		                    pageSize: 'LEGAL'
		                }
	        	]			
			} );
		    $('a.toggle-vis').on( 'click', function (e) {
		        e.preventDefault();
		 
		        // Get the column API object
		        var column = table.column( $(this).attr('data-column') );
		 
		        // Toggle the visibility
		        column.visible( ! column.visible() );
		    } );

		  	$('.select2').select2();
			  	$("#clear").click(function(){
						$("select option").removeAttr("selected");
						$('.select2').val("").trigger("change");
						$('#from_date').val("");
						return false;
				});	
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
