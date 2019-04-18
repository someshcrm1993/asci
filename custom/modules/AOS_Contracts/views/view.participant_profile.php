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

class AOS_ContractsViewparticipant_profile extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$app_list_strings;
		// ob_clean();
		// print_r($app_list_strings);exit();

		$where = '';
		$url = $sugar_config['site_url'];	
		$year = $_POST['year'];

		if ($_POST['year']) {
				
			$where .= ' AND project_cstm.programme_year_c = '.$_POST['year'];
		}

		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if ($pid_i) {
			$where .= "AND project.id = $pid_s";
		}else{
			// $where .= "AND project.id = ''";
		}

		$area = $_POST['area'];
		$area = "'$area'";
		if ($_POST['area']) {   
			$where .= ' AND project_cstm.area_subjects_c = '.$area;
		}

		$organisation = $_POST['organisation'];
		$organisation = "'$organisation'";
		if ($_POST['organisation']) {
			$organisation = "AND accounts.id = $organisation";
		}		

		$sector = $_POST['sector'];
		$sector = "'$sector'";
		if ($_POST['sector']) {
			$where .= 'AND accounts_cstm.sector_c = '.$sector;
		}

		$org_type = $_POST['org_type'];
		
		if ($_POST['org_type']) {
			$where .= " AND accounts_cstm.organisation_type_c LIKE '%$org_type%' ";
		}				


		$employee_level = $_POST['employee_level'];
		$employee_level = "'$employee_level'";
		if ($_POST['employee_level']) {
			$where .= " AND contacts_cstm.nominee_position_c = $employee_level ";
		}			

		$source = $_POST['source'];
		$source = "'$source'";
		if ($_POST['source']) {
			$where .= ' AND contacts.lead_source = '.$source;
		}

		$designation_c = $_POST['designation_c'];
		$designation_c = "'$designation_c'";
		if ($_POST['designation_c']) {
			$where .= " AND contacts_cstm.designation_c = $designation_c ";
		}						

		$employee_level_value = '';
		//Employee Level dropdown logic
		$employee_level_dropdown='<select name="employee_level" id="employee_level" class="select2"><option value=""></option>';
		unset($app_list_strings['nominee_position_list'][""]);
		$i = 1;
		foreach ($app_list_strings['nominee_position_list'] as $key => $value) {
			if ($_POST['employee_level'] == $key) {
				$employee_level_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$employee_level_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}

			$employee_level_value .= 'SUM(CASE WHEN contacts_cstm.nominee_position_c = "'.$value.'" THEN 1 ELSE 0 END) AS el'.$i.','; 
			$i++;
		}

		$employee_level_dropdown.='</select>';				
		$employee_level_value = rtrim($employee_level_value,',');

		$i=1;
		$organisation_type_select = '';
		//Organisation Type dropdown logic
		$org_type_dropdown='<select name="org_type" id="org_type" class="select2"><option value=""></option>';
		unset($app_list_strings['organisation_type_list'][""]);
		foreach ($app_list_strings['organisation_type_list'] as $key => $value) {
			if ($_POST['org_type'] == $key) {
				$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}

			$organisation_type_select .= 'SUM(CASE WHEN accounts_cstm.organisation_type_c LIKE "%'.$value.'%" THEN 1 ELSE 0 END) AS ot'.$i.',';
			$i++;
		}
		$org_type_dropdown.='</select>';	
		$organisation_type_select = rtrim($organisation_type_select,',');

		$i=1;
		$source_select = '';
		//Source dropdown logic
		$source_dropdown='<select name="source" id="source" class="select2"><option value=""></option>';
		unset($app_list_strings['lead_source_dom'][""]);
		foreach ($app_list_strings['lead_source_dom'] as $key => $value) {
			if ($_POST['source'] == $key) {
				$source_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$source_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
			
			$source_select .= 'SUM(CASE WHEN contacts.lead_source = "%'.$value.'%" THEN 1 ELSE 0 END) AS s'.$i.',';
			$i++;
		}
		$source_dropdown.='</select>';	
		$source_select = rtrim($source_select,',');

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					   project.id,
					   project_cstm.area_subjects_c as area_c,
					   accounts.id as org_id,
					   project.name,
					   accounts.name as organisation_name,
					   accounts_cstm.sector_c as sector,
					   project_cstm.programme_year_c,
					   contacts_cstm.designation_c,
					   contacts.id as participant_id,
					   contacts_cstm.gender_c,
					   contacts.lead_source as source,
					   CONCAT(contacts.first_name,' ',contacts.last_name) as participant_name,
					   REPLACE (accounts_cstm.organisation_type_c, '^', '') as organisation_type_c,
					   contacts_cstm.nominee_position_c as employee_level,
					   SUM(CASE WHEN contacts_cstm.age_c >= 20 AND contacts_cstm.age_c <= 40 THEN 1 ELSE 0 END) AS AGE1,
					   SUM(CASE WHEN contacts_cstm.age_c >=40 AND contacts_cstm.age_c <=55 THEN 1 ELSE 0 END) AS AGE2,
					   SUM(CASE WHEN contacts_cstm.age_c >=55 THEN 1 ELSE 0 END) AS AGE3,
					   SUM(CASE WHEN contacts_cstm.gender_c = 'Male' THEN 1 ELSE 0 END) AS Male,
					   SUM(CASE WHEN contacts_cstm.gender_c = 'Female' THEN 1 ELSE 0 END) AS Female,
					   $employee_level_value, $organisation_type_select, $source_select
				FROM contacts
				INNER JOIN contacts_cstm ON contacts.id = contacts_cstm.id_c
				INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2contacts_idb = contacts.id
				INNER JOIN project ON project_contacts_2_c.project_contacts_2project_ida = project.id
				INNER JOIN project_cstm ON project.id = project_cstm.id_c
				INNER JOIN accounts_contacts ON accounts_contacts.contact_id = contacts.id
				INNER JOIN accounts ON accounts.id = accounts_contacts.account_id
				INNER JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
				WHERE project.deleted = '0'
				AND project_contacts_2_c.deleted = '0'
				AND contacts.deleted = '0'
				AND accounts_contacts.deleted = '0'
				$where
				GROUP BY project.id";
		// print_r($query);exit();


		//organisations dropdown logic
		$designation_query = $connection->prepare("SELECT contacts_cstm.designation_c FROM contacts_cstm INNER JOIN contacts ON contacts.id = contacts_cstm.id_c WHERE contacts.deleted = '0' AND contacts_cstm.designation_c <> '' and contacts_cstm.designation_c IS NOT NULL GROUP BY contacts_cstm.designation_c");
		$designation_query->execute();
		$designation_dropdown = '<select name="designation_c" id="designation_c" class="select2"><option value=""></option>';
		while($row_enquiry=$designation_query->fetch()){
			if ($_POST['designation_c'] == $row_enquiry['designation_c']) {
				$designation_dropdown .= '<option label="'.$row_enquiry['designation_c'].'" value="'.$row_enquiry['designation_c'].'" selected>'.$row_enquiry['designation_c'].'</option>';
			}else{
				$designation_dropdown .= '<option label="'.$row_enquiry['designation_c'].'" value="'.$row_enquiry['designation_c'].'">'.$row_enquiry['designation_c'].'</option>';
			}
		}
		$center_dropdown .= '</select>';	

		//Center dropdown logic
		$center_query = $connection->prepare("SELECT id, name FROM securitygroups WHERE deleted = '0'");
		$center_query->execute();
		$center_dropdown = '<select name="center" id="center" class="select2"><option value=""></option>';
		while($row_enquiry=$center_query->fetch()){
			if ($_POST['center'] == $row_enquiry['id']) {
				$center_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$center_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$center_dropdown .= '</select>';		

		//year dropdown
		$year_dropdown = '<select name="year" id="year"><option value=""></option>';
		unset($app_list_strings['programme_year_list'][""]);
		foreach ($app_list_strings['programme_year_list'] as $key => $value) {
			if ($year == $key) {
				$year_dropdown .='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{

				$year_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';	
			}
		}
		$year .='</select>';

		//Area dropdown logic
		$area_dropdown='<select name="area" id="area" class="select2"><option value=""></option>';
		unset($app_list_strings['area_pd_list'][""]);
		foreach ($app_list_strings['area_pd_list'] as $key => $value) {
			if ($_POST['area'] == $key) {
				$area_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$area_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$area_dropdown.='</select>';		

		//programmes dropdown logic
		$programmes_query = $connection->prepare("SELECT id, name FROM project WHERE deleted = '0' group by id");
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

		
		//Sector dropdown logic
		$sector_dropdown='<select name="sector" id="sector" class="select2"><option value=""></option>';
		unset($app_list_strings['sector_list'][""]);
		foreach ($app_list_strings['sector_list'] as $key => $value) {
			if ($_POST['sector'] == $key) {
				$sector_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$sector_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$sector_dropdown.='</select>';			

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
	</style>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h1>Participant Profile Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table" id="dropdowns_table"> 
						
						<tr>

							<td width="1%" style="text-align: left !important;"><b>Employee Level</b></td>
							<td width="1%" align="left" style="text-align: left !important;">'.$employee_level_dropdown.'</td>
							
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Center</b></td>
							<td width="1%" style="text-align: left !important;">'.$center_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Financial Year</b></td>
							<td width="1%" style="text-align: left !important;">'.$year_dropdown.'</td>
						</tr>						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programmes</b></td>
							<td width="1%" style="text-align: left !important;">'.$programmes_dropdown.'</td>
							<td width="1%" style="text-align: left !important;"><b>Area</b></td>
							<td width="1%" style="text-align: left !important;">'.$area_dropdown.'</td>
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Organisation</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Sector</b></td>
							<td width="1%" style="text-align: left !important;">'.$sector_dropdown.'</td>
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Organisation Type</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_type_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Source</b></td>
							<td width="1%" style="text-align: left !important;">'.$source_dropdown.'</td>
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

		while($row_enquiry=$query->fetch()){
			
			$project = BeanFactory::getBean('Project', $row_enquiry['id']);
			
			// $s = SecurityGroup::getGroupWhere($alias, $project->module_dir, $project->id);
			// print_r($project->get_linked_beans('securitygroups_project'));exit;
			$sql = $db->query("SELECT securitygroups.name as center, securitygroups.id as id from project INNER JOIN securitygroups_records ON securitygroups_records.record_id = project.id
				INNER JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id where project.id = '{$project->id}' AND securitygroups.deleted = '0' AND securitygroups_records.deleted = '0'");
			$str = '';
			$ids = '';
			while($row = $db->fetchByAssoc($sql)){
				// print_r($row);exit;
				$str .= ' ,'.$row['center']; 
				$ids .= ' ,'.$row['id']; 
			}
			$array = explode(',', $ids);
			// print_r($array);exit;
			$go = true;
			if ($_POST['center']) {
				if (!in_array($_POST['center'], $array)) {
					$go = false;
				}
			}

			$str = ltrim($str, ' ,');
			// ob_clean();
			// print_r(error_get_last());exit;
			if ($go) {
				$data .='<tr>';		
				$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
				// ob_clean();
				

				$data .='<td>'.$str.'</td>';
				$data .='<td>'.$row_enquiry['area_c'].'</td>';
				$data .='<td>'.$row_enquiry['programme_year_c'].'</td>';
				$data .='<td>'.$row_enquiry['el1'].'</td>';
				$data .='<td>'.$row_enquiry['el2'].'</td>';
				$data .='<td>'.$row_enquiry['el3'].'</td>';
				$data .='<td>'.$row_enquiry['el4'].'</td>';
				$data .='<td>'.$row_enquiry['sector'].'</td>';
				$data .='<td>'.$row_enquiry['ot1'].'</td>';
				$data .='<td>'.$row_enquiry['ot2'].'</td>';
				$data .='<td>'.$row_enquiry['ot3'].'</td>';
				$data .='<td>'.$row_enquiry['ot4'].'</td>';
				$data .='<td>'.$row_enquiry['ot5'].'</td>';
				$data .='<td>'.$row_enquiry['ot6'].'</td>';
				$data .='<td>'.$row_enquiry['Male'].'</td>';
				$data .='<td>'.$row_enquiry['Female'].'</td>';
				$data .='<td>'.$row_enquiry['AGE1'].'</td>';
				$data .='<td>'.$row_enquiry['AGE2'].'</td>';
				$data .='<td>'.$row_enquiry['AGE3'].'</td>';
				$data .='<td>'.$row_enquiry['s1'].'</td>';
				$data .='<td>'.$row_enquiry['s2'].'</td>';
				$data .='<td>'.$row_enquiry['s3'].'</td>';
				$data .='<td>'.$row_enquiry['s4'].'</td>';
				$data .='<td>'.$row_enquiry['s5'].'</td>';
				$data .='<td>'.$row_enquiry['s6'].'</td>';
				$data .='<td>'.$row_enquiry['s7'].'</td>';
				$data .='<td>'.$row_enquiry['s8'].'</td>';
				$data .='<td>'.$row_enquiry['s9'].'</td>';
				$data .='<td>'.$row_enquiry['s10'].'</td>';
				$data .='<td>'.$row_enquiry['s11'].'</td>';
				$data .='<td>'.$row_enquiry['s12'].'</td>';
				$data .='<td>'.$row_enquiry['s13'].'</td>';
				$data .='<td>'.$row_enquiry['s14'].'</td>';
				$data .='<td>'.$row_enquiry['s15'].'</td>';
				$data .='<td>'.$row_enquiry['s16'].'</td>';
				$data .='</tr>';
			}

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


		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
	                {
	                    extend: 'csvHtml5',
	                    title: 'Participant Profile Report',
	                },
	                {
	                    extend: 'pdfHtml5',
	                    title: 'Participant Profile Report',
	                    pageSize: 'LEGAL',
	                    orientation: 'landscape'
	                }
        		],
        		orientation: 'landscape',
			} );
		} );


			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px">
				<section>
					

					<table id="example" class="cell-border table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td rowspan="2">Programme Name</td>
								<td rowspan="2">Center</td>
								<td rowspan="2">Area</td>					
								<td rowspan="2">Financial Year</td>
								<td colspan="4">Employee Level</td>
								<td rowspan="2">Sector</td>
								<td colspan="6">Organisation Type</td>
								<td colspan="2">Gender</td>
								<td colspan="3">Age Group</td>			
								<td colspan="16">Source</td>		
							</tr>
							<tr>
								<td>CEO</td>
								<td>Sr. Level</td>
								<td>Md. Level</td>
								<td>Jr. Level</td>
								<td>Central Government</td>
								<td>Foreign</td>
								<td>International</td>
								<td>Other</td>
								<td>Private</td>
								<td>State Government</td>
								<td>Male</td>
								<td>Female</td>
								<td>20-40</td>
								<td>41-55</td>
								<td>55 & Above</td>
								<td>Snail Mail</td>
								<td>Brochures</td>
								<td>Cold Call</td>
								<td>Existing Customer</td>
								<td>Self Generated</td>
								<td>Employee</td>
								<td>Partner</td>
								<td>Direct Mail</td>
								<td>Conference</td>
								<td>Web Site</td>
								<td>Word of mouth</td>
								<td>Email</td>
								<td>Campaign</td>
								<td>Facebook</td>
								<td>Twitter</td>
								<td>Other</td>
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
		  	 $('.select2').select2();
		  	$("#clear").click(function(){
					$("select option").removeAttr("selected");
					$('.select2').val("").trigger("change");
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
