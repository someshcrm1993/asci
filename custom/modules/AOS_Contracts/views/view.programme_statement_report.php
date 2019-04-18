<?php
// Written By: Rathina Ganesh
// Date: 08th Sep 2017

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

class AOS_ContractsViewprogramme_statement_report extends SugarView {
	
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

		$from_date = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['from_date'])));
		$to_date = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['to_date'])));

		// $programme_type_dropdown='<select name="programme_type" id="programme_type" class="select2"><option value=""></option>';
		// unset($app_list_strings['organisation_type_list'][""]);
		// foreach ($app_list_strings['organisation_type_list'] as $key => $value) {
		// 	if ($_POST['programme_type'] == $key) {
		// 		$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
		// 	}else{
		// 		$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
		// 	}

		// 	$i++;
		// }
		// $programme_type_dropdown.='</select>';			
		
		require_once('custom/modules/AOS_Contracts/database.php');
		//********************** Filter period 1 starts ***********************//
		//$query="SELECT count(*) as count,pc.programme_type_c as programme_type FROM project p join project_cstm pc on pc.id_c = p.id where p.deleted = 0 and pc.programme_type_c !='' and p.status not in ('Not Offered','Cancelled','Deferred')";
		/*Modified by ashvin
		 *Date:09-11-2018
		 *Reason: No of programmes data have discrepancy as other status programmes are also counted- only ‘Conducted’ status programmes should be displayed. 
		 *Start- change made in query
		*/
		$query="SELECT count(*) as count,pc.programme_type_c as programme_type FROM project p join project_cstm pc on pc.id_c = p.id where p.deleted = 0 and pc.programme_type_c !='' and p.status in ('Conducted')";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		 $query .=" group by pc.programme_type_c ";

		$query1="SELECT count(*) as count,nc.programme_type_c as programme_type FROM contacts n join contacts_cstm nc on nc.id_c = n.id left join project_contacts_2_c pn on pn.project_contacts_2contacts_idb = n.id left join project p on p.id = pn.project_contacts_2project_ida left join project_cstm pc on pc.id_c = p.id where n.deleted = 0 and nc.programme_type_c !='' and p.status in ('Conducted') and pn.deleted = 0 and p.deleted = 0 and nc.nomination_status_c !='Dropped Out' and nc.nomination_status_c !='Rejected'";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query1 .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		$query1 .=" group by nc.programme_type_c ";
		//echo $query1;exit;
		$query2="SELECT sum(datediff(pc.end_date_c,pc.start_date_c)+1) as count,pc.programme_type_c as programme_type FROM project p join project_cstm pc on pc.id_c = p.id where p.deleted = 0 and pc.start_date_c != 'NULL' and pc.end_date_c !='NULL' and pc.programme_type_c !=''  and p.status in ('Conducted') ";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query2 .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		$query2 .=" group by pc.programme_type_c";
		//********************** Filter period 1 ends ***********************//
		
		$from_date = date('Y-m-d',strtotime("{$from_date} -1 Year"));
		$to_date = date('Y-m-d',strtotime("{$to_date} -1 Year"));
		//********************** Filter period 2 starts ***********************//
		$query3="SELECT count(*) as count,pc.programme_type_c as programme_type FROM project p join project_cstm pc on pc.id_c = p.id where p.deleted = 0 and pc.programme_type_c !=''  and p.status in ('Conducted')";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query3 .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		$query3 .=" group by pc.programme_type_c ";

		$query4="SELECT count(*) as count,nc.programme_type_c as programme_type FROM contacts n join contacts_cstm nc on nc.id_c = n.id  left join project_contacts_2_c pn on pn.project_contacts_2contacts_idb = n.id left join project p on p.id = pn.project_contacts_2project_ida left join project_cstm pc on pc.id_c = p.id where n.deleted = 0 and nc.programme_type_c !='' and p.status in ('Conducted') and pn.deleted = 0  and p.deleted = 0 and nc.nomination_status_c !='Dropped Out' and nc.nomination_status_c !='Rejected'";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query4 .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		$query4 .=" group by nc.programme_type_c ";

		$query5="SELECT sum(datediff(pc.end_date_c,pc.start_date_c)+1) as count,pc.programme_type_c as programme_type FROM project p join project_cstm pc on pc.id_c = p.id where p.deleted = 0 and pc.start_date_c != 'NULL' and pc.end_date_c !='NULL' and pc.programme_type_c !=''  and p.status in ('Conducted')";
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query5 .=" and pc.start_date_c between '$from_date' and '$to_date'";
		}
		$query5 .=" group by pc.programme_type_c";
		//********************** Filter period 2 ends ***********************//
		//year dropdown logic
		// $year_dropdown='<select name="year" id="year" class="select2"><option value=""></option>';
		// unset($app_list_strings['programme_year_list'][""]);
		// foreach ($app_list_strings['programme_year_list'] as $key => $value) {
		// 	if ($_POST['year'] == $key) {
		// 		$year_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
		// 	}else{
		// 		$year_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
		// 	}
		// }
		// $year_dropdown.='</select>';
		unset($app_list_strings['programme_type_list'][""]);

		foreach ($app_list_strings['programme_type_list'] as $key => $value) {
			$particulars[$key]['no_programmes1'] = 0;
			$particulars[$key]['no_training_days1'] = 0;
			$particulars[$key]['no_participants1'] = 0;
			$particulars[$key]['no_programmes2'] = 0;
			$particulars[$key]['no_training_days2'] = 0;
			$particulars[$key]['no_participants2'] = 0;
		}
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
					<h1>Programme Statement</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							<td><strong>From: </strong><input type = "text" name = "from_date" id = "from_date" value="'.$_REQUEST["from_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "from_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "fromb",
						align        : "right"});
					</script></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><strong>To: </strong><input type = "text" name = "to_date" id = "to_date" value="'.$_REQUEST["to_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "to_date",
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
				'.$query.' '.$query1.'
			</div>
		</form>
	</body>
</html>';			
		$query=$connection->prepare($query);

		$query->execute();

		while($row=$query->fetch()){
			$particulars[$row['programme_type']]['no_programmes1'] = $row['count'];
		}	

		$query1=$connection->prepare($query1);

		$query1->execute();

		while($row=$query1->fetch()){
			$particulars[$row['programme_type']]['no_participants1'] = $row['count'];
		}
		
		$query2=$connection->prepare($query2);

		$query2->execute();

		while($row=$query2->fetch()){
			$particulars[$row['programme_type']]['no_training_days1'] = $row['count'];
		}

		$query3=$connection->prepare($query3);

		$query3->execute();

		while($row=$query3->fetch()){
			$particulars[$row['programme_type']]['no_programmes2'] = $row['count'];
		}	

		$query4=$connection->prepare($query4);

		$query4->execute();

		while($row=$query4->fetch()){
			$particulars[$row['programme_type']]['no_participants2'] = $row['count'];
		}
		
		$query5=$connection->prepare($query5);

		$query5->execute();

		while($row=$query5->fetch()){
			$particulars[$row['programme_type']]['no_training_days2'] = $row['count'];
		}
		/*Somesh Bawane
		Dt.: 18-02-19
		Adding total in pdf*/
		$total = array();
		foreach ($particulars as $key => $value) {
			$total[0][] = $value['no_programmes1'];
			$total[1][] = $value['no_training_days1'];
			$total[2][] = $value['no_participants1'];
			$total[3][] = $value['no_programmes2'];
			$total[4][] = $value['no_training_days2'];
			$total[5][] = $value['no_participants2'];
		}
		/*Somesh Bawane
		Dt.: 18-02-19
		Adding total in pdf*/
		
		foreach($particulars as $key=>$value){
			$data .='<tr>';
			$data .='<td align="center" style="font-weight:bold">'.$key.'</td>';
			$data .='<td align="center">'.$value['no_programmes1'].'</td>';
			$data .='<td align="center">'.$value['no_training_days1'].'</td>';
			$data .='<td align="center">'.$value['no_participants1'].'</td>';
			$data .='<td align="center">'.$value['no_programmes2'].'</td>';
			$data .='<td align="center">'.$value['no_training_days2'].'</td>';
			$data .='<td align="center">'.$value['no_participants2'].'</td>';
			$data .='</tr>';
		}

		/*Somesh Bawane
		Dt.: 18-02-19
		Adding total in pdf*/
		$data .='<tr id="totalAcc">';
		$data .='<td align="center" style="font-weight:bold">Total</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[0]).'</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[1]).'</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[2]).'</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[3]).'</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[4]).'</td>';
		$data .='<td align="center" style="font-weight:bold">'.array_sum($total[5]).'</td>';
		$data .='</tr>';
		/*Somesh Bawane
		Dt.: 18-02-19
		Adding total in pdf*/
		$_SESSION['pdf_data']=$data;
		if(empty($_POST['from_date']) || empty($_POST['to_date'])){
			$currentFromDate = '';
			$currentToDate = '';			
			$from_date = '';
			$to_date = '';
			if(empty($_POST['Export'])){
				$_SESSION['currentFromDatepdf']='';
				$_SESSION['currentToDatepdf']='';
				$_SESSION['from_datepdf']='';
				$_SESSION['to_datepdf']='';
			}
		}else{
			$currentFromDate = date('d-m-Y',strtotime(str_replace('/', '-', $_POST['from_date'])));
			$currentToDate = date('d-m-Y',strtotime(str_replace('/', '-', $_POST['to_date'])));
			$_SESSION['currentFromDatepdf']=$currentFromDate;
			$_SESSION['currentToDatepdf']=$currentToDate;
			$from_date = date('d-m-Y',strtotime($from_date));
			$to_date = date('d-m-Y',strtotime($to_date));
			$_SESSION['from_datepdf']=$from_date;
			$_SESSION['to_datepdf']=$to_date;
		}
 //echo $data;exit();
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
					<!--Added by Ashvin
					    Date:24-10-2018
						Reason: PDF Report Format
						-->
					<form name = "exportOption" method = "post" id="exportOption" action = "" >
					<button type="submit" id="Export" name="Export" value="Export" style="position:absolute; margin-left:53px;"  class="btn btn-primary" onclick="$('form#exportOption').submit();">PDF</button>
					</form>
					<!--Added by Ashvin
					    Date:24-10-2018
						Reason: PDF Report Format
						-->
					<table id="example" class="table table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td rowspan="2">Particulars</td>
								<td colspan="3">Current Year ($currentFromDate - $currentToDate)</td>
								<td colspan="3">Previous Year ($from_date - $to_date)</td>
							</tr>
							<tr>
								<td>No of Programs</td>
								<td>No of Training Days</td>
								<td>No of Participants</td>
								<td>No of Programs</td>
								<td>No of Training Days</td>
								<td>No of Participants</td>
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
		  	//Hidding row "total" from html list
		  	document.getElementById("totalAcc").style.display = 'none';		  	
			var table =$('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [{
					 extend: 'csv',
						title: 'MDP_Activity_Report',
					
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
					$('input[type=text]').val('');
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
$pdf->SetTitle('Program Statement');
$pdf->SetSubject('ASCI Reports');
$pdf->SetKeywords('ASCI, Reports, Program, Statement, guide');

$pdf->setPrintHeader(false);
// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('helvetica', 'B', 13);

// add a page
$pdf->AddPage();
$pdf->Image('custom/modules/Project/asci_small_logo.jpg', 100, 10, 50, 50, 'JPG', '', '', true, 80, '', false, false, 0, false, false, false); 
$pdf->Write(1, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(2, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(3, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(4, '', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(5, 'ADMINISTRATIVE STAFF COLLEGE OF INDIA', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(6, 'BELLA VISTA: HYDERABAD - 500 082', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Write(7, '', '', 10, 'C', true, 0, false, false, 0);
$pdf->Write(8, 'MDP Activity Report', '', 10, 'C', true, 0, false, false, 0);

$pdf->Write(9, 'Date:'.date('d-m-Y'), '', 10, 'R', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 10);

$tbl2=$_SESSION['pdf_data'];
$currentFromDatepdf=$_SESSION['currentFromDatepdf'];
$currentToDatepdf=$_SESSION['currentToDatepdf'];
$from_datepdf=$_SESSION['from_datepdf'];
$to_datepdf=$_SESSION['to_datepdf'];
$tbl = <<<HTML
<div style="margin-top:20px;"></div>
<table  cellspacing="0" cellspacing="0" cellpadding="2" width="100%" border="1">
	<thead>
		<tr style="font-weight:bold">
			<td rowspan="2" align="center">Particulars</td>
			<td colspan="3" align="center">Current Year ($currentFromDatepdf - $currentToDatepdf)</td>
			<td colspan="3" align="center">Previous Year ($from_datepdf - $to_datepdf)</td>
		</tr>
		<tr style="font-weight:bold">
			<td align="center" style="padding:2px;">No of    Programs  </td>
			<td align="center">No of Training Days</td>
			<td align="center">No of Participants</td>
			<td align="center" style="padding:2px;">No of    Programs  </td>
			<td align="center">No of Training Days</td>
			<td align="center">No of Participants</td>
		</tr>
	</thead>
	<tbody>
		$tbl2
	</tbody>
</table>
HTML;
$pdf->writeHTML($tbl, true, false, false, false, '');
//Close and output PDF document
$pdf->Output('MDP_Activity_Report.pdf', 'D');
}
/*Writtern by -Ashvin
  Date:23-10-2018
  Reason- Custom PDF Report
  Start
*/