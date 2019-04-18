n<?php
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

class AOS_ContractsViewfaculty_feedback_report extends SugarView {
	
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
		$programme_type = $_POST['programme_type'];



		$pid_i = $_POST['programme'];
		$pid_s = "'$pid_i'";
		if ($pid_i) {
			$where .= "AND project.id = $pid_s";
		}

		$year = $_POST['year'];
		$year = "'$year'";
		if ($_POST['year']) {   
			$where .= ' AND project_cstm.programme_year_c = '.$year;
		}

		$type = $_POST['programme_type'];
		$type = "'$type'";
		if ($_POST['programme_type']) {   
			$where .= ' AND project_cstm.programme_type_c = '.$type;
		}		

		if (isset($_POST['faculty'])) {
			$fac_i = $_POST['faculty'];
			// $fac_s = "'$fac_i'";
			if (!$fac_i) {
				$fac_s = "NULL";
			}else{
				$where .= " AND scrm_session_information_cstm.faculty_id_c like '%{$fac_i}%' ";
			}			
		}
		// ob_clean();

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT 
					scrm_session_information.name as session_name,
					project.name as programme_name,
					project.id as pid,
					project_cstm.programme_type_c,			
					project_cstm.programme_year_c as year,
					scrm_partners.name,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 1 THEN 1 else 0 END) as unsatisfactory,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 2 THEN 1 else 0 END) as satisfactory,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 3 THEN 1 else 0 END) as good,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 4 THEN 1 else 0 END) as very_good,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 5 THEN 1 else 0 END) as excellent,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'High' THEN 1 else 0 END) as High,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Med' THEN 1 else 0 END) as Med,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Low' THEN 1 else 0 END) as Low,
					SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'VeryLow' THEN 1 else 0 END) as vlow
				FROM scrm_session_information
				INNER JOIN scrm_session_information_cstm ON scrm_session_information.id = scrm_session_information_cstm.id_c
				INNER JOIN scrm_timetable_scrm_session_information_1_c ON scrm_timetable_scrm_session_information_1_c.scrm_timetc7f4rmation_idb = scrm_session_information.id
				INNER JOIN project_scrm_timetable_1_c ON project_scrm_timetable_1_c.project_scrm_timetable_1scrm_timetable_idb = scrm_timetable_scrm_session_information_1_c.scrm_timetable_scrm_session_information_1scrm_timetable_ida
				LEFT JOIN project ON project.id = project_scrm_timetable_1_c.project_scrm_timetable_1project_ida
				LEFT JOIN project_cstm ON project_cstm.id_c = project.id				
				LEFT JOIN scrm_partners ON scrm_partners.id = scrm_session_information_cstm.faculty_id_c
				LEFT JOIN scrm_partners_cstm ON scrm_partners.id = scrm_partners_cstm.id_c
				LEFT JOIN scrm_feedback_sessions_cstm ON scrm_feedback_sessions_cstm.session_c = scrm_session_information.id
				WHERE scrm_session_information.deleted = '0'
				AND project_scrm_timetable_1_c.deleted = '0'
				AND project.deleted = '0'
				AND (scrm_partners.deleted = '0' OR scrm_partners.deleted IS NULL)
				AND scrm_timetable_scrm_session_information_1_c.deleted = '0'
				$where
				GROUP BY scrm_session_information.id,project.id
				";
		// print_r($query);exit();

		//Porgramme Type dropdown logic
		$programme_type_dropdown='<select name="programme_type" id="programme_type" class="select2"><option value=""></option>';
		unset($app_list_strings['programme_type_list'][""]);
		foreach ($app_list_strings['programme_type_list'] as $key => $value) {
			if (isset($_POST['programme_type_c']) && $_POST['programme_type_c'] == $key) {
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$programme_type_dropdown.='</select>';		

		//programmes dropdown logic
		$programmes_query = $db->query("SELECT id, name FROM project WHERE deleted = '0'");
		// $programmes_query->execute();
		$programmes_dropdown = '<select name="programme" id="programme" class="select2"><option value=""></option>';
		while($row_enquiry = $db->fetchByAssoc($programmes_query )){
			if ($pid_i == $row_enquiry['id']) {
				$programmes_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$programmes_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$programmes_dropdown .= '</select>';		

		//faculty and faculty type dropdown logic
		$faculty_query = $connection->prepare("SELECT scrm_partners.id, scrm_partners.name, scrm_partners_cstm.faculty_type_c FROM scrm_partners INNER JOIN scrm_partners_cstm ON scrm_partners_cstm.id_c = scrm_partners.id WHERE scrm_partners.deleted = '0'");
		$faculty_query->execute();
		$faculty_dropdown = '<select name="faculty" id="" class="select2"><option value=""></option>';
		while($row_enquiry=$faculty_query->fetch()){
			if ($fac_i == $row_enquiry['id']) {
				$faculty_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'" selected>'.$row_enquiry['name'].'</option>';
			}else{
				$faculty_dropdown .= '<option label="'.$row_enquiry['name'].'" value="'.$row_enquiry['id'].'">'.$row_enquiry['name'].'</option>';
			}
		}
		$faculty_dropdown .= '</select>';				

		$year_dropdown='<select name="year" id="year"><option value=""></option>';
		unset($app_list_strings['programme_year_list'][""]);
		foreach ($app_list_strings['programme_year_list'] as $key => $value) {
			if ($year == $key) {
				$year_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$year_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$year_dropdown.='</select>';	

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
					<h1>Faculty/Guest Faculty Feedback</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programme Type</b></td>
							<td width="1%" style="text-align: left !important;">'.$pt_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Programme Name</b></td>
							<td width="1%" style="text-align: left !important;">'.$programmes_dropdown.'</td>
						</tr>						
 	 					<tr>
							<td width="1%" style="text-align: left !important;"><b>Financial Year</b></td>
							<td width="1%" style="text-align: left !important;">'.$year_dropdown.'</td>

							<td width="1%" style="text-align: left !important;"><b>Faculty</b></td>
							<td width="1%" style="text-align: left !important;">'.$faculty_dropdown.'</td>							
						</tr>												
						<tr>

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
			$data .='<td>'.$row_enquiry['programme_type_c'].'</td>';			
			$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['pid'].'">'.$row_enquiry['programme_name'].'</a></td>';
			$data .='<td>'.$row_enquiry['year'].'</td>';
			$data .='<td>'.$row_enquiry['session_name'].'</td>';
			$data .='<td>'.$row_enquiry['unsatisfactory'].'</td>';
			$data .='<td>'.$row_enquiry['satisfactory'].'</td>';
			$data .='<td>'.$row_enquiry['good'].'</td>';
			$data .='<td>'.$row_enquiry['very_good'].'</td>';
			$data .='<td>'.$row_enquiry['excellent'].'</td>';
			$data .='<td>'.number_format((float)(($row_enquiry['unsatisfactory']+($row_enquiry['satisfactory']*2)+($row_enquiry['good']*3)+($row_enquiry['very_good']*4)+($row_enquiry['excellent']*5))/(($row_enquiry['unsatisfactory']+$row_enquiry['satisfactory']+$row_enquiry['good']+$row_enquiry['very_good']+$row_enquiry['excellent']))), 2, '.', '').'</td>';
			$data .='<td>'.$row_enquiry['High'].'</td>';
			$data .='<td>'.$row_enquiry['Med'].'</td>';
			$data .='<td>'.$row_enquiry['Low'].'</td>';
			$data .='<td>'.$row_enquiry['vlow'].'</td>';
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
								<td rowspan='2'>Programme Type</td>
								<td rowspan='2'>Programme Name</td>
								<td rowspan='2'>Financial Year</td>
								<td rowspan='2'>Session Name</td>
								<td colspan='5'>Rating</td>
								<td rowspan='2'>Weighted. Avg Rating</td>
								<td colspan='4'>Relevance</td>
							</tr>
							<tr>
								<td>Unsatisfactory</td>
								<td>Satisfactory</td>
								<td>Good</td>
								<td>Very Good</td>
								<td>Excellent</td>
								<td>High</td>
								<td>Med</td>
								<td>Low</td>
								<td>Very Low</td>							
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
		                    title: 'Faculty/Guest Faculty Feedback',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'Faculty/Guest Faculty Feedback',
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
