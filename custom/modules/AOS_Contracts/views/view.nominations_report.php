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

class AOS_ContractsViewnominations_report extends SugarView {
	
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

		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if (!$pid_i) {
			$pid_s = "NULL";
		}else{
			$where .= " AND project.id = $pid_s ";
		}


		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					   project_cstm.area_subjects_c,
					   project.id,
					   project.name,
					   project_cstm.programme_year_c,
					   SUM(CASE WHEN contacts_cstm.nomination_status_c = 'Nomination Received' THEN 1 ELSE 0 END) as received,
					   SUM(CASE WHEN contacts_cstm.nomination_status_c = 'Accepted' THEN 1 ELSE 0 END) as accepted,
					   SUM(CASE WHEN contacts_cstm.nomination_status_c = 'Rejected' THEN 1 ELSE 0 END) as rejected,
					   SUM(CASE WHEN contacts_cstm.nomination_status_c = 'Commitment' THEN 1 ELSE 0 END) as commitment,
					   SUM(CASE WHEN contacts_cstm.nomination_status_c = 'Dropped Out' THEN 1 ELSE 0 END) as do,
					   contacts.lead_source as source,
					   project_cstm.start_date_c
				FROM project
				INNER JOIN project_cstm ON project.id = project_cstm.id_c
				LEFT JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2project_ida = project.id
				LEFT JOIN contacts_cstm ON project_contacts_2_c.project_contacts_2contacts_idb = contacts_cstm.id_c
				LEFT JOIN contacts ON contacts.id = contacts_cstm.id_c
				WHERE project.deleted = '0'
				AND (project_contacts_2_c.deleted = '0' OR project_contacts_2_c.deleted IS NULL)
				AND (contacts.deleted = '0' OR contacts.deleted IS NULL)
				$where
				GROUP BY project.id ";
		// print_r($query);exit();

		//Area dropdown logic
		$nomination_status_dropdown='<select name="nomination_status_c" id="nomination_status_c" class="select2"><option value=""></option>';
		unset($app_list_strings['nomination_status_list'][""]);
		foreach ($app_list_strings['nomination_status_list'] as $key => $value) {
			if ($_POST['nomination_status_c'] == $key) {
				$nomination_status_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$nomination_status_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$nomination_status_dropdown.='</select>';		

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

		//Source dropdown logic
		$source_dropdown='<select name="source" id="source" class="select2"><option value=""></option>';
		unset($app_list_strings['lead_source_dom'][""]);
		foreach ($app_list_strings['lead_source_dom'] as $key => $value) {
			if ($_POST['source'] == $key) {
				$source_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$source_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$source_dropdown.='</select>';

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
					<h1>Nominations Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							
							<td width="1%" style="text-align: left !important;"><b>Programme</b></td>
							<td width="1%" style="text-align: left !important;">'.$programmes_dropdown.'</td>

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
			$data2='';
		while($row_enquiry=$query->fetch()){
			$project = BeanFactory::getBean('Project', $row_enquiry['id']);
			
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
			/*Modified by Ashvin
			  Date:24-10-2018
			  Reason:Change PDF Report Format
			  
			  <td align="center" width="140%">Area</td>
			<td align="center" width="200%">Center</td>
			<td align="center" width="205%">Programme Name</td>
			<td align="center" width="80%">Start Date</td>													
			<td align="center" width="50%">Recieved</td>
			<td align="center" width="50%">Accepted</td>
			<td align="center" width="50%">Rejected</td>
			<td align="center" width="50%">Commitment</td>
			<td align="center" width="50%">Dropped Out</td>
			<td align="center" width="70%">Enquiries</td>
			*/
			
			$str = ltrim($str, ' ,');
			if ($go) {
				
				$data .='<tr>';
				$data2 .='<tr>';
				$data .='<td align="center" >'.$row_enquiry['area_subjects_c'].'</td>';
				$data2 .='<td align="center" width="140%">'.$row_enquiry['area_subjects_c'].'</td>';
				
				
				$data .='<td align="center" >'.$str.'</td>';
				$data2 .='<td align="center" width="230%">'.$str.'</td>';
				$originalDate = $row_enquiry['start_date_c'];
				$StartnewDate = date("d-m-Y", strtotime($originalDate));
				$data .='<td align="center"><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
				$data2 .='<td align="center" width="235%"><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
				$data .='<td align="center">'.$StartnewDate.'</td>';
				$data2 .='<td align="center" width="80%">'.$StartnewDate.'</td>';
				//$data .='<td>'.$row_enquiry['source'].'</td>';
				$data .='<td align="center">'.$row_enquiry['received'].'</td>';
				$data2 .='<td align="center" width="50%">'.$row_enquiry['received'].'</td>';
				$data .='<td align="center">'.$row_enquiry['accepted'].'</td>';
				$data2 .='<td align="center" width="50%">'.$row_enquiry['accepted'].'</td>';
				$data .='<td align="center">'.$row_enquiry['rejected'].'</td>';
				$data2 .='<td align="center" width="50%">'.$row_enquiry['rejected'].'</td>';
				$data .='<td align="center">'.$row_enquiry['commitment'].'</td>';
				$data2 .='<td align="center" width="50%">'.$row_enquiry['commitment'].'</td>';
				$data .='<td align="center">'.$row_enquiry['do'].'</td>';
				$data2 .='<td align="center" width="50%">'.$row_enquiry['do'].'</td>';
				$data .='<td align="center">'.count($project->get_linked_beans('project_leads_1')).'</td>';
				$data2 .='<td align="center" width="75%">'.count($project->get_linked_beans('project_leads_1')).'</td>';
				//$data .='<td>'.$row_enquiry['source'].'</td>';
				// $data .='<td>'.$row_enquiry['Expectations'].'</td>';
				// $data .='<td>'.$row_enquiry['Present_Responsibility'].'</td>';
				$data .='</tr>';
				$data2 .='</tr>';
				
			}

		}
		$_SESSION['pdf_data1']=$data2;
		/*Modified by Ashvin
		  Date:24-10-2018
		  Reason:Change PDF Report Format
		  End
		*/
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
				<!--Modified by Ashvin
				  Date:24-10-2018
				  Reason:Change PDF Report Format
				-->
					<form name = "exportOption" method = "post" id="exportOption" action = "" >
					<button type="submit" id="Export" name="Export" value="Export" style="position: absolute;margin-left:53px"  class="btn btn-primary" onclick="$('form#exportOption').submit();">PDF</button>
					</form>
				<!--Modified by Ashvin
				  Date:24-10-2018
				  Reason:Change PDF Report Format
				  End
				-->
					<table id="example" class="table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr >
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								
								<td colspan="5">Nomination status</td>
								<td></td>
							</tr>
							<tr>
								<td>Area</td>
								<td>Center</td>
								<td>Programme Name</td>
								<td>Start Date</td>													
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
		  	/* Modified by: Ashvin
		  	   Date:22-10-2010
		  	   Reson: Report Format - Nominations Report
			   Start
		  	*/
			var table = $('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [    
					{
						extend: 'csv',
						title: 'Nominations Report',
					}
        		],			
			} );
			/* Modified by: Ashvin
		  	   Date:22-10-2010
		  	   Reson: Report Format - Nominations Report
			   End
		  	*/
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
/*Writtern by -Ashvin
  Date:23-10-2018
  Reason- Custom PDF Report
  Start
*/
if(!empty($_POST['Export'])){
	require_once('include/tcpdf/tcpdf.php');
	$timestamp = date('Y_m_d_His'); 
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ashvin Sawarkar');
$pdf->SetTitle('Nominations Report');
$pdf->SetSubject('ASCI Reports');
$pdf->SetKeywords('ASCI, Reports, Nominations, Statement, guide');
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', 'B', 12);
// add a page
$pdf->AddPage('L', 'A4');
$pdf->Image('custom/modules/Project/asci_small_logo.jpg', 140, 10, 50, 50, 'JPG', '', '', true, 80, '', false, false, 0, false, false, false); 
$pdf->Write(1, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(2, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(3, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(4, '', '', 0, 'C', true, 0, false, false, 0);



$pdf->Write(6, 'ADMINISTRATIVE STAFF COLLEGE OF INDIA', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(7, 'BELLA VISTA: HYDERABAD - 500 082', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 12);

$pdf->Write(9, 'Nominations Report', '', 10, 'C', true, 0, false, false, 0);

$pdf->Write(10, 'Date:'.date('d-m-Y'), '', 2, 'R', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 8.5);

$tbl2=$_SESSION['pdf_data1'];

$tbl = <<<HTML

<table id="" cellspacing="0" width="100%" border="1">
	<thead >
		<tr style="font-weight:bold">
			<td width="140%"></td>
			<td width="230%"></td>
			<td width="235%"></td>
			<td width="80%"></td>
			
			<td colspan="5" align="center" width="50%">Nomination status</td>
			<td width="75%"></td>
		</tr>
		<tr style="font-weight:bold">
			<td align="center" width="140%">Area</td>
			<td align="center" width="230%">Center</td>
			<td align="center" width="235%">Programme Name</td>
			<td align="center" width="80%">Start Date</td>													
			<td align="center" width="50%">Recieved</td>
			<td align="center" width="50%">Accepted</td>
			<td align="center" width="50%">Rejected</td>
			<td align="center" width="50%">Commitment</td>
			<td align="center" width="50%">Dropped Out</td>
			<td align="center" width="75%">Enquiries</td>
			
		</tr>
	</thead>
		$tbl2					
	</table>
HTML;
$pdf->writeHTML($tbl, true, false, false, false, '');
//Close and output PDF document
$pdf->Output('Nominations_Report.pdf', 'D');
}
/*Writtern by -Ashvin
  Date:23-10-2018
  Reason- Custom PDF Report
  Start
*/