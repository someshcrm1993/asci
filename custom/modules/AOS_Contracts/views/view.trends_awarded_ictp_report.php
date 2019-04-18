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

class AOS_ContractsViewtrends_awarded_ictp_report extends SugarView {
	
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

		if (isset($_POST['sector'])) {
			$sector = $_POST['sector'];
			$sector = "'$sector'";
			if (!$_POST['sector']) {
				$sector = "NULL";
			}else{
				$where .= " AND accounts_cstm.sector_c = $sector ";	
			}
		}else{
			$sector = "NULL";
		}

		if (isset($_POST['org_type'])) {
			$org_type = $_POST['org_type'];
			// $org_type = "$org_type";
			if (!$_POST['org_type']) {
				
			}else{
				$where .= " AND accounts_cstm.organisation_type_c like '%{$org_type}%' ";
			}
		}

		if (isset($_POST['employee_level'])) {
			$employee_level = $_POST['employee_level'];
			// $org_type = "$org_type";
			if (!$_POST['employee_level']) {
				$employee_level = "NULL";
			}else{
				$where .= " AND contacts_cstm.nominee_position_c like '%{$employee_level}%' ";
			}
		}else{
			$org_type = "NULL";
		}

		if (isset($_POST['organisation'])) {
			$organisation = $_POST['organisation'];
			$organisation = "'$organisation'";
			if (!$_POST['organisation']) {
				$organisation = "NULL";
			}else{
				$where .= " AND accounts.id = {$organisation} ";
			}	
		}else{
			$organisation = "NULL";
		}

		if (isset($_POST['director'])) {
			$director_i = $_POST['director'];
			$director_s = "'$director_i'";
			if (!$director_i) {
				$director_s = "NULL";
			}else{
				$where .= " AND project.assigned_user_id = {$director_s} ";
			}				
		}else{
			$director_s = "NULL";
		}	

		if (isset($_POST['area'])) {
			$area = $_POST['area'];
			$area = "'$area'";
			if (!$_POST['area']) {
				$area = "NULL";
			}else{
				$where .= " AND project_cstm.area_subjects_c = {$area} ";
			}
		}else{
			$area = "NULL";
		}
		// ob_clean();

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					accounts.name as organisation_name,
					securitygroups.name as center,
					accounts.id as oid,
					project_cstm.programme_fee_c,
					project.name as project_name,
					users_cstm.area_c as area,
					project_cstm.start_date_c,
					project_cstm.end_date_c,
					project.id as pid,
					CONCAT(IFNULL(contacts.first_name,''),' ',contacts.last_name) as participant_name,
					contacts_cstm.designation_c,
					contacts_cstm.nominee_position_c as employee_level,
					contacts.lead_source as source,
					contacts_cstm.programme_year_c,
					accounts_cstm.sector_c as sector,
					contacts.id as participant_id,
					REPLACE (accounts_cstm.organisation_type_c, '^', '') as organisation_type_c
				FROM accounts
				LEFT JOIN accounts_cstm ON accounts.id = accounts_cstm.id_c
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = accounts.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				LEFT JOIN accounts_contacts ON accounts_contacts.account_id = accounts.id
				LEFT JOIN contacts ON contacts.id = accounts_contacts.contact_id
				LEFT JOIN contacts_cstm ON contacts_cstm.id_c = contacts.id
				LEFT JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2contacts_idb = contacts.id				
				LEFT JOIN project ON project.id = project_contacts_2_c.project_contacts_2project_ida
				LEFT JOIN project_cstm ON project_cstm.id_c = project.id

				LEFT JOIN users ON users.id = project.assigned_user_id
				LEFT JOIN users_cstm ON users_cstm.id_c = users.id				
				WHERE accounts.deleted = '0'
				AND (securitygroups.deleted = '0' OR securitygroups.deleted IS NULL)
				AND contacts.id IS NOT NULL
				AND contacts.deleted = '0' 
				$where
				GROUP BY contacts.id
				";
		// print_r($query);exit();
	//~ AND opportunities_cstm.asci_proposal_outcome_c = 'Awarded'
				//~ AND (securitygroups.deleted = '0' OR securitygroups.deleted IS NULL)
				//~ AND accounts_opportunities.deleted = '0'
				//~ AND accounts.id = IFNULL({$organisation},accounts.id)
				//~ AND accounts_cstm.sector_c = IFNULL({$sector},accounts_cstm.sector_c)
				//~ AND IFNULL({$org_type},accounts_cstm.organisation_type_c) LIKE '%'
				//~ AND project_cstm.area_subjects_c = IFNULL({$area},project_cstm.area_subjects_c)
				//~ AND opportunities.deleted = '0'
				//~ AND (scp1.deleted = '0' OR scp1.deleted IS NOT NULL)
				//~ AND (scp2.deleted = '0' OR scp1.deleted IS NOT NULL)
				//~ AND project.assigned_user_id = IFNULL({$director_s},project.assigned_user_id)
				//~ AND contacts.id IS NOT NULL
		//organisations dropdown logic
		$org_query = $connection->prepare("SELECT id, name FROM accounts WHERE deleted = '0'");
		$org_query->execute();
		$org_dropdown = '<select name="organisation" id="organisation" class="select2"><option value=""></option>';
		while($row_enquiry=$org_query->fetch()){
			if (isset($_POST['organisation']) && $_POST['organisation'] == $row_enquiry['id']) {
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
			if (isset($_POST['sector']) && $_POST['sector'] == $key) {
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
			if (isset($_POST['org_type']) && $_POST['org_type'] == $key) {
				$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{

					$org_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
								
			}
		}
		$org_type_dropdown.='</select>';

		//directors dropdown logic
		$directors_query = $connection->prepare("SELECT users.id, CONCAT(IFNULL(users.first_name,''),' ',users.last_name) as name FROM acl_roles INNER JOIN acl_roles_users ON acl_roles_users.role_id = acl_roles.id INNER JOIN users ON acl_roles_users.user_id = users.id WHERE acl_roles_users.deleted = '0' AND acl_roles.deleted = '0' AND acl_roles_users.role_id = '270734b1-0242-9157-7a2e-590ff7943164' AND users.deleted = '0'");
		$directors_query->execute();
		$directors_dropdown = '<select name="director" id="director" class="select2"><option value=""></option>';
		while($row_enquiry=$directors_query->fetch()){
			if (isset($_POST['director']) && $_POST['director'] == $row_enquiry['id']) {
				$directors_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$directors_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$directors_dropdown .= '</select>';

		//Employee Level dropdown logic
		$employee_level_dropdown='<select name="employee_level" id="employee_level" class="select2"><option value=""></option>';
		unset($app_list_strings['nominee_position_list'][""]);
		foreach ($app_list_strings['nominee_position_list'] as $key => $value) {
			if (isset($_POST['employee_level']) && $_POST['employee_level'] == $key) {
				$employee_level_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$employee_level_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$employee_level_dropdown.='</select>';
// 		ob_clean();	
// print_r(error_get_last());exit();
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
					<h1>Trends in Awarded ICTP Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							
							<td width="1%" style="text-align: left !important;"><b>Organisation</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Sector</b></td>
							<td width="1%" style="text-align: left !important;">'.$sector_dropdown.'</td>							
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Organization Type</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_type_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Programme Directors</b></td>
							<td width="1%" style="text-align: left !important;">'.$directors_dropdown.'</td>
						</tr>						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Employee level</b></td>
							<td width="1%" style="text-align: left !important;">'.$employee_level_dropdown.'</td>
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
			$data .='<td>'.$row_enquiry['programme_year_c'].'</td>';
			$data .='<td>'.$row_enquiry['center'].'</td>';
			$data .='<td>'.$row_enquiry['area'].'</td>';			
			$data .='<td><a href = "index.php?module=Accounts&action=DetailView&record='.$row_enquiry['oid'].'">'.$row_enquiry['organisation_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['sector'].'</td>';
			$data .='<td>'.$row_enquiry['organisation_type_c'].'</td>';
			$data .='<td><a href = "index.php?module=Contacts&action=DetailView&record='.$row_enquiry['participant_id'].'">'.$row_enquiry['participant_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['designation_c'].'</td>';
			$data .='<td>'.$row_enquiry['employee_level'].'</td>';
			$data .='<td>'.$row_enquiry['source'].'</td>';
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
								<td>Financial Year</td>
								<td>Center</td>
								<td>Area</td>
								<td>Organizations</td>
								<td>Sector</td>
								<td>Organization Type</td>
								<td>Participant Name</td>
								<td>Participant Designation</td>
								<td>Employee Level</td>
								<td>Source</td>
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
		                    title: 'Trends in Awarded ICTP Report',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'Trends in Awarded ICTP Report',
		                    pageSize: 'LEGAL',
		                    orientation: 'landscape'
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
