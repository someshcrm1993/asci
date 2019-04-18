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

class AOS_ContractsViewnomination_position extends SugarView {
	
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

		if (!$_POST['year']) {
			$year = "NULL";
		}

		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if (!$pid_i) {
			$pid_s = "NULL";
		}

		$area = $_POST['area'];
		$area = "'$area'";
		if (!$_POST['area']) {
			$area = "NULL";
		}

		$organisation = $_POST['organisation'];
		$organisation = "'$organisation'";
		if (!$_POST['organisation']) {
			$organisation = "NULL";
		}		

		$sector = $_POST['sector'];
		$sector = "'$sector'";
		if (!$_POST['sector']) {
			$sector = "NULL";
		}

		$org_type = $_POST['org_type'];
		$org_type = "'$org_type'";
		if (!$_POST['org_type']) {
			$org_type = "NULL";
		}				

		$center = $_POST['center'];
		$center = "'$center'";
		if ($_POST['center']) {
			$where .= 'AND securitygroups.id='.$center; 
		}					

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					   project_cstm.area_subjects_c,
					   project.id,
					   accounts.id as org_id,
					   project.name,
					   accounts.name as organisation_name,
					   accounts_cstm.sector_c as sector,
					   project_cstm.programme_year_c,
					   securitygroups.name as center,
					   count(*) as received,
					   SUM(CASE contacts_cstm.nomination_status_c WHEN 'Accepted' THEN 1 ELSE 0 END) as accepted,
					   SUM(CASE contacts_cstm.nomination_status_c WHEN 'Rejected' THEN 1 ELSE 0 END) as rejected,
					   SUM(CASE contacts_cstm.nomination_status_c WHEN 'Commitment' THEN 1 ELSE 0 END) as commitment,
					   SUM(CASE contacts_cstm.nomination_status_c WHEN 'Dropped Out' THEN 1 ELSE 0 END) as do,
					   COUNT(leads.id) as leads
				FROM project
				INNER JOIN project_cstm ON project.id = project_cstm.id_c
				INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2project_ida = project.id
				INNER JOIN contacts_cstm ON project_contacts_2_c.project_contacts_2contacts_idb = contacts_cstm.id_c
				INNER JOIN contacts ON contacts.id = contacts_cstm.id_c
				LEFT JOIN project_leads_1_c ON project_leads_1_c.project_leads_1project_ida = project.id
				LEFT JOIN leads ON project_leads_1_c.project_leads_1leads_idb = leads.id
				LEFT JOIN leads_cstm ON leads_cstm.id_c = leads.id
				LEFT JOIN accounts_contacts ON accounts_contacts.contact_id = contacts.id
				LEFT JOIN accounts ON accounts.id = accounts_contacts.account_id
				LEFT JOIN accounts_cstm ON accounts_cstm.id_c = accounts.id
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = project.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				WHERE project.deleted = '0'
				AND project_contacts_2_c.deleted = '0'
				AND contacts.deleted = '0'
				AND project_cstm.programme_year_c = IFNULL({$year},project_cstm.programme_year_c)
				AND project_cstm.area_subjects_c = IFNULL({$area},project_cstm.area_subjects_c)
				AND accounts_cstm.sector_c = IFNULL({$sector},accounts_cstm.sector_c)
				$where
				AND IFNULL({$org_type},accounts_cstm.organisation_type_c) LIKE '%'
				AND project.id = IFNULL({$pid_s},project.id)
				AND accounts.id = IFNULL({$organisation},accounts.id)
				AND (leads.deleted = '0' OR leads.deleted IS NULL)
				AND ( project_cstm.programme_type_c = 'Announced' OR project_cstm.programme_type_c = 'Sponsored')
				GROUP BY project.id, accounts.id";
		// print_r($query);exit();

		//organisations dropdown logic
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

		$program='<select name="year" id="year"><option value=""></option>';
		unset($app_list_strings['programme_year_list'][""]);
		foreach ($app_list_strings['programme_year_list'] as $key => $value) {
			if ($year == $key) {
				$program.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$program.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$program.='</select>';

		//Area dropdown logic
		$area_dropdown='<select name="area" id="area" class="select2"><option value=""></option>';
		unset($app_list_strings['area_subjects_list'][""]);
		foreach ($app_list_strings['area_subjects_list'] as $key => $value) {
			if ($_POST['area'] == $key) {
				$area_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$area_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$area_dropdown.='</select>';		

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

		//Organisation Type dropdown logic
		$org_type_dropdown='<select name="org_type" id="org_type" class="select2"><option value=""></option>';
		unset($app_list_strings['organisation_type_list'][""]);
		foreach ($app_list_strings['organisation_type_list'] as $key => $value) {
			if ($_POST['org_type'] == $key) {
				$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$org_type_dropdown.='</select>';	

		echo '<!DOCTYPE html>
<html lang="en">
	<body>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h2>Nomination position report:</h2>
					<table width="50%" style="border-collapse: separate;border-spacing: 1em;">
						<tr>
							<td>Center</td>
							<td>'.$center_dropdown.'</td>
						</tr>
						<tr>
							<td>Financial Year</td>
							<td>'.$program.'</td>
						</tr>
						<tr>
							<td>Programmes</td>
							<td>'.$programmes_dropdown.'</td>
						</tr>						
						<tr>
							<td>Area</td>
							<td>'.$area_dropdown.'</td>
						</tr>
						<tr>
							<td>Organisation</td>
							<td>'.$org_dropdown.'</td>
						</tr>
						<tr>
							<td>Sector</td>
							<td>'.$sector_dropdown.'</td>
						</tr>
						<tr>
							<td>Organisation Type</td>
							<td>'.$org_type_dropdown.'</td>
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
			$data .='<tr>';
			$data .='<td>'.$row_enquiry['center'].'</td>';
			$data .='<td>'.$row_enquiry['area_subjects_c'].'</td>';
			$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
			$data .='<td><a href = "index.php?module=Accounts&action=DetailView&record='.$row_enquiry['org_id'].'">'.$row_enquiry['organisation_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['programme_year_c'].'</td>';
			$data .='<td>'.$row_enquiry['received'].'</td>';
			$data .='<td>'.$row_enquiry['accepted'].'</td>';
			$data .='<td>'.$row_enquiry['rejected'].'</td>';
			$data .='<td>'.$row_enquiry['commitment'].'</td>';
			$data .='<td>'.$row_enquiry['do'].'</td>';
			$data .='<td>'.$row_enquiry['leads'].'</td>';
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
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
			<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" language="javascript" class="init">


		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Rlfrtip'
			} );
		} );


			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px">
				<section>
					

					<table id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td colspan="5">Nomination status</td>
							</tr>
							<tr>
								<td>Center</td>
								<td>Area</td>
								<td>Programme Name</td>
								<td>Organisation</td>								
								<td>Financial Year</td>								
								<td>Recieved</td>
								<td>Accepted</td>
								<td>Rejected</td>
								<td>Commitment</td>
								<td>Dropped Out</td>
								<td>Enquiries</td>
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
