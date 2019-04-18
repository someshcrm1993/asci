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

class AOS_ContractsViewprojection_report extends SugarView {
	
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

		$proposal_status = $_POST['proposal_status'];
		$proposal_status = "'$proposal_status'";
		if (!$_POST['proposal_status']) {
			$proposal_status = "NULL";
		}else{
			$where .= " AND opportunities_cstm.asci_proposal_status_c = {$proposal_status} ";
		}				

		$outcome_status = $_POST['outcome_status'];
		$outcome_status = "'$outcome_status'";
		if (!$_POST['outcome_status']) {
			$outcome_status = "NULL";
		}else{
			$where .= " AND opportunities_cstm.asci_proposal_outcome_c = {$outcome_status} ";
		}

		$organisation = $_POST['organisation'];
		$organisation = "'$organisation'";
		if (!$_POST['organisation']) {
			$organisation = "NULL";
		}else{
			$where .= " AND accounts.id= $organisation ";
		}

		$date = $_POST['from_date'];
		if (!$_POST['from_date']) {
			$date = "NULL";
		}else{
			// ob_clean();
			// print_r($date);exit();
			$date = date_create_from_format('d/m/Y', "$date")->format('Y-m-d');
			
			$date = "'$date'";
			$where .= " AND date(opportunities.date_entered) = {$date} ";
		}
		// ob_clean();

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					accounts.name as organisation_name,
					securitygroups.name as center,
					opportunities.name as title,
					opportunities.id,
					scp1.name as lead_faculty1,
					accounts.id as oid,
					scp2.name as lead_faculty2,
					opportunities_cstm.date_submission_approved_prp_c,
					opportunities_cstm.asci_proposal_status_c,
					opportunities_cstm.asci_proposal_outcome_c,
					opportunities_cstm.total_expected_revenue_c,
					opportunities_cstm.outcome_remark_c,
					opportunities_cstm.fee_quoted_c,
					project_cstm.programme_fee_c,
					project.name as project_name
				FROM opportunities
				INNER JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c
				LEFT JOIN accounts_opportunities ON accounts_opportunities.opportunity_id = opportunities.id
				LEFT JOIN accounts ON accounts.id = accounts_opportunities.account_id
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = opportunities.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				LEFT JOIN scrm_partners as scp1 ON scp1.id = opportunities_cstm.scrm_partners_id_c
				LEFT JOIN scrm_partners as scp2 ON scp2.id = opportunities_cstm.scrm_partners_id1_c
				LEFT JOIN opportunities_scrm_programme_details_1_c ON opportunities_scrm_programme_details_1_c.opportunities_scrm_programme_details_1opportunities_ida = opportunities.id
				LEFT JOIN scrm_programme_details_cstm ON scrm_programme_details_cstm.id_c = opportunities_scrm_programme_details_1_c.opportunities_scrm_programme_details_1scrm_programme_details_idb
				LEFT JOIN project ON project.id = scrm_programme_details_cstm.project_id_c
				LEFT JOIN project_cstm ON project_cstm.id_c = project.id
				WHERE accounts.deleted = '0'
				$where
				AND (securitygroups.deleted = '0' OR securitygroups.deleted IS NULL)
				AND accounts_opportunities.deleted = '0'
				AND opportunities.deleted = '0'
				AND (scp1.deleted = '0' OR scp1.deleted IS NOT NULL)
				AND (scp2.deleted = '0' OR scp1.deleted IS NOT NULL)
				";
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
					<h1>ICTP Projections Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							
							<td width="1%" style="text-align: left !important;"><b>Organisation</b></td>
							<td width="1%" style="text-align: left !important;">'.$org_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Date</b></td>
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
						<tr>
							
							<td width="1%" style="text-align: left !important;"><b>Proposal Status</b></td>
							<td width="1%" style="text-align: left !important;">'.$proposal_status_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Outcome Status</b></td>
							<td width="1%" style="text-align: left !important;">'.$outcome_status_dropdown.'</td>
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
			$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['oid'].'">'.$row_enquiry['organisation_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['center'].'</td>';
			$data .='<td>'.$row_enquiry['asci_proposal_outcome_c'].'</td>';
			$data .='<td><a href = "index.php?module=Opportunities&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['title'].'</a></td>';
			$data .='<td>'.$row_enquiry['lead_faculty1'].'</td>';
			$data .='<td>'.$row_enquiry['lead_faculty2'].'</td>';
			$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['date_submission_approved_prp_c'])).'</td>';
			$data .='<td>'.$app_list_strings['asci_proposal_status_list'][$row_enquiry['asci_proposal_status_c']].'</td>';
			$data .='<td>'.$row_enquiry['outcome_remark_c'].'</td>';
			$data .='<td>'.number_format($row_enquiry['total_expected_revenue_c'], 2).'</td>';
			$data .='<td>'.$row_enquiry['project_name'].'</td>';
			$data .='<td>'.number_format($row_enquiry['programme_fee_c'], 2).'</td>';
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
								<td>Client Name</td>
								<td>Center</td>
								<td>Outcome</td>
								<td>Proposal Title</td>
								<td>Lead Faculty1</td>
								<td>Lead Faculty2</td>														
								<td>Date of submission of Approved Proposal</td>
								<td>Status</td>
								<td>Outcome Remark</td>
								<td>Total expected revenue</td>
								<td>Programme Title</td>
								<td>Expected revenue</td>
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
		                    title: 'ICTP Projections Report',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'ICTP Projections Report',
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
