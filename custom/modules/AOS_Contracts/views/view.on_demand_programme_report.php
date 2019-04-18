<?php
// Written By: Aditya Harshey
// Date: 21 Aug 2017

if(!defined('sugarEntry')) define('sugarEntry', true);
// ini_set('display_errors','On');

class AOS_ContractsViewon_demand_programme_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db, $app_list_strings;
		// echo "<pre>";
		// print_r($app_list_strings);exit;
		$url = $sugar_config['site_url'];	
		$year1 = $_POST['year'];

		$where = '';
		$url = $sugar_config['site_url'];	
		$year = $_POST['year'];

		if ($_POST['year']) {
				
			$where .= ' AND project_cstm.programme_year_c = '.$_POST['year'];
		}

		$area = $_POST['area'];
		$area = "'$area'";
		if ($_POST['area']) {   
			$where .= ' AND users_cstm.area_c = '.$area;
		}

		$organisation = $_POST['organisation'];
		$organisation = "'$organisation'";
		if ($_POST['organisation']) {
			$where .= " AND accounts.id = $organisation";
		}		

		$programme_type = $_POST['programme_type'];
		
		if ($_POST['programme_type']) {
			$where .= " AND project_cstm.programme_type_c LIKE '%$programme_type%' ";
		}				

		$center = $_POST['center'];
		$center = "'$center'";


		$date_from = date('Y-m-d',strtotime($_POST['from_date']));;
		if ($_POST['from_date']) {
			$where .= " AND project_cstm.start_date_c >= '$date_from' "; 
		}

		$date_to = date('Y-m-d',strtotime($_POST['to_date']));;
		if ($_POST["to_date"]) {
			$where .= " AND project_cstm.end_date_c <= '$date_to' " ; 
		}

		$i=1;
		
		//Organisation Type dropdown logic
		$programme_type_dropdown='<select name="programme_type" id="programme_type" class="select2"><option value=""></option>';
		unset($app_list_strings['organisation_type_list'][""]);
		foreach ($app_list_strings['organisation_type_list'] as $key => $value) {
			if ($_POST['programme_type'] == $key) {
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}

			$i++;
		}
		$programme_type_dropdown.='</select>';	
		$organisation_type_select = rtrim($organisation_type_select,',');

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT project.id, project.name, project_cstm.area_subjects_c as area, project_cstm.programme_year_c,accounts.name as organisation_name, accounts.id as oid, project_cstm.start_date_c, project_cstm.end_date_c, project_cstm.programme_type_c, securitygroups.name as center, CONCAT(IFNULL(users.first_name,''),' ',IFNULL(users.last_name,'')) as ppd, scrm_partners.name as spd, accounts.deleted, project_contacts_2_c.deleted, accounts_contacts.deleted FROM project 
				INNER JOIN project_cstm ON project_cstm.id_c = project.id
				LEFT JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2project_ida = project.id 
				LEFT JOIN accounts_contacts ON accounts_contacts.contact_id = project_contacts_2_c.project_contacts_2contacts_idb
				LEFT JOIN accounts ON accounts.id = accounts_contacts.account_id 
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = project.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				LEFT JOIN users ON users.id = project.assigned_user_id
				LEFT JOIN users_cstm ON users_cstm.id_c = users.id
				LEFT JOIN scrm_partners ON scrm_partners.id = project_cstm.scrm_partners_id_c
				where project.deleted = '0'
				AND (securitygroups.deleted = '0' OR securitygroups.deleted IS NULL)
				AND (accounts.deleted = '0' OR accounts.id IS NULL)
				AND (project_contacts_2_c.deleted = '0' OR project_contacts_2_c.deleted IS NULL)
				AND (accounts_contacts.deleted = '0' OR accounts_contacts.deleted IS NULL) 
				$where
				GROUP BY project.id, accounts.id";
				//print_r($query);exit();
		$year='<select name="year" id="year"><option value=""></option>';

		unset($app_list_strings['programme_year_list'][""]);
		foreach ($app_list_strings['programme_year_list'] as $key => $value) {
			if ($year1 == $key) {
				$year.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$year.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$year.='</select>';

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

		//Area dropdown logic
		$pt_dropdown='<select name="programme_type" id="programme_type" class="select2"><option value=""></option>';
		unset($app_list_strings['programme_type_list'][""]);
		foreach ($app_list_strings['programme_type_list'] as $key => $value) {
			if ($_POST['programme_type'] == $key) {
				$pt_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$pt_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$pt_dropdown.='</select>';			

		echo '<!DOCTYPE html>
<html lang="en">
	<body>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h2>On demand list of programmes</h2>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table" id="dropdowns_table"> 
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Start Date</b></td>
							<td width="1%" style="text-align: left !important;">
								<input type = "text" name = "from_date" id = "from_date" value="'.$_POST["from_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="frb" align="absmiddle" />
								<script type="text/javascript">
									Calendar.setup({inputField   : "from_date",
									ifFormat      :    "%d-%m-%Y",
									button       : "frb",
									align        : "right"});
								</script>
							</td>
							<td width="1%" style="text-align: left !important;"><b>End Date</b></td>
							<td width="1%" style="text-align: left !important;">
								<input type = "text" name = "to_date" id = "to_date" value="'.$_POST["to_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
								<script type="text/javascript">
									Calendar.setup({inputField   : "to_date",
									ifFormat      :    "%d-%m-%Y",
									button       : "tob",
									align        : "right"});
								</script>
							</td>
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Financial Year</b></td>
							<td width="1%" style="text-align: left !important;">'.$year.'</td>

							<td width="1%" style="text-align: left !important;"><b>Organisation</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_dropdown.'</td>
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programme Type</b></td>
							<td width="1%" style="text-align: left !important;">'.$pt_dropdown.'</td>
						</tr>						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Center</b></td>
							<td width="1%" style="text-align: left !important;">'.$center_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Area</b></td>
							<td width="1%" style="text-align: left !important;">'.$area_dropdown.'</td>
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
// print_r($query);exit();

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

			if ($go) {
				$data .='<tr>';
				$data .='<td>'.$row_enquiry['programme_year_c'].'</td>';
				$data .='<td>'.$row_enquiry['programme_type_c'].'</td>';

				$data .='<td>'.$str.'</td>';

				$data .='<td>'.$row_enquiry['area'].'</td>';
				$data .='<td>'.$row_enquiry['organisation_name'].'</td>';
				$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
				$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['start_date_c'])).'</td>';
				$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['end_date_c'])).'</td>';
				$o = $row_enquiry['oid'];
				$nop = $db->getOne("SELECT count(*) from contacts INNER JOIN contacts_cstm ON contacts_cstm.id_c = contacts.id INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2contacts_idb = contacts.id INNER JOIN project ON  project_contacts_2_c.project_contacts_2project_ida = project.id INNER JOIN accounts_contacts ON accounts_contacts.contact_id = contacts.id  WHERE project.id = '{$project->id}' AND contacts_cstm.nomination_status_c = 'Accepted' AND contacts.deleted = '0' AND project_contacts_2_c.deleted = '0' AND accounts_contacts.account_id = '{$o}'");
				// echo "SELECT count(*) from contacts INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2contacts_idb = contacts.id INNER JOIN project ON  project_contacts_2_c.project_contacts_2project_ida = project.id WHERE project.id = '{$project->id}' AND contacts_cstm.nomination_status_c = 'Accepted' AND contacts.deleted = '0' AND project_contacts_2_c.deleted = '0'";exit;
				$data .='<td>'.$nop.'</td>';
				$data .='<td>'.$row_enquiry['ppd'].'</td>';
				$data .='<td>'.$row_enquiry['spd'].'</td>';
				// $data .='<td>'.$row_enquiry['Expectations'].'</td>';
				// $data .='<td>'.$row_enquiry['Present_Responsibility'].'</td>';
				$data .='</tr>';
			}

		}
// echo $data;exit();
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
			$('.select2').select2();
			$('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
		                {
		                    extend: 'csvHtml5',
		                    title: 'On demand list of programmes',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'On demand list of programmes',
		                    pageSize: 'LEGAL',
		                    orientation: 'landscape'
		                }
	        	]
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
								<td>Programme Year</td>
								<td>Programme Type</td>
								<td>Center</td>
								<td>Area</td>
								<td>Organization</td>
								<td>Programme Name</td>
								<td>Start Date</td>
								<td>End Date</td>
								<td>No of participants</td>
								<td>Primary Programme Director</td>
								<td>Secondary Programme Director</td>
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
			  	$("#clear").click(function(){
						$("select option").removeAttr("selected");
						$("input").val("");
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
