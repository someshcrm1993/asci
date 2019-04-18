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

class AOS_ContractsViewfaculty_workload_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$app_list_strings;
		require_once('custom/modules/AOS_Contracts/database.php');

		$where = '';


		if (isset($_POST['faculty'])) {
			$fac_i = $_POST['faculty'];
			// $fac_s = "'$fac_i'";
			if (!$fac_i) {
				$fac_s = "NULL";
			}else{
				$where .= " AND scrm_session_information_cstm.faculty_id_c like '%{$fac_i}%' ";
			}			
		}else{
			$fac_s = "NULL";
		}		



		//faculty dropdown logic
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

		$url = $sugar_config['site_url'];	

		if (isset($_POST['faculty_type'])) {

			$faculty_type = $_POST['faculty_type'];
			$faculty_type = "'$faculty_type'";
			if (!$_POST['faculty_type']) {
				$faculty_type = "NULL";
			}else{

				$faculties = $connection->prepare("SELECT scrm_partners.id, scrm_partners.name, scrm_partners_cstm.faculty_type_c FROM scrm_partners INNER JOIN scrm_partners_cstm ON scrm_partners_cstm.id_c = scrm_partners.id WHERE scrm_partners.deleted = '0' AND scrm_partners_cstm.faculty_type_c = $faculty_type");
				$faculties->execute();
				$fac = '';
				while($row_enquiry=$faculties->fetch()){
					$fac .= ','.$row_enquiry['id'];
				}
				// echo $fac;exit();
				// $where .= " AND FIND_IN_SET(scrm_session_information_cstm.faculty_id_c, '$fac') > 0 ";
			}
		}else{
			$faculty_type = "NULL";
		}

		$area = $_POST['area'];
		$area = "'$area'";
		if ($_POST['area']) {   
			$where .= ' AND users_cstm.area_c = '.$area;
		}

		if (isset($_POST['start_date'])) {
			$sdate = $_POST['start_date'];
			if (!$_POST['start_date']) {
				$sdate = "NULL";
			}else{
				// ob_clean();
				// print_r($sdate);exit();
				$sdate = date_create_from_format('d/m/Y', "$sdate")->format('Y-m-d');
				
				$sdate = "'$sdate'";

				$where .= " AND date(project_cstm.start_date_c) >= {$sdate} ";
			}					
		}else{
			$sdate = "NULL";
		}

		if (isset($_POST['end_date'])) {
			$edate = $_POST['end_date'];
			if (!$_POST['end_date']) {
				$edate = "NULL";
			}else{
				// ob_clean();
				// print_r($edate);exit();
				$edate = date_create_from_format('d/m/Y', "$edate")->format('Y-m-d');
				
				$edate = "'$edate'";
				$where .= " AND date(project_cstm.end_date_c) <= {$edate} ";
			}					
		}else{
			$edate = "NULL";
		}


		if (isset($_POST['programme'])) {
			$pid_i = $_POST['programme'];
			$pid_s = "'$pid_i'";
			if (!$pid_i) {
				$pid_s = "NULL";
			}else{
				$where .= " AND project.id = $pid_s ";
			}			
		}else{
			$pid_s = "NULL";
		}

		if (isset($_POST['center'])) {
			$center = $_POST['center'];
			$center = "'$center'";
			if ($_POST['center']) {
				$where .= 'AND securitygroups.id='.$center; 
			}						
		}else{
			$where .= ''; 
		}

		// ob_clean();

		/* Changes made by Ashvin
		*  date:13-11-2018
		*  Reason: add start and end time columns in query : Faculty work load report- Any session less than or equal to 45 minutes should be considered as half session(0.5) and any session greater than 45 minutes and upto 90 minutes should be considered as one session.
		*  Ticket ID: 3784
		*  Start 
		*/
		$query="SELECT 
					scrm_session_information.name as session_name,
					project.name as programme_name,
					project.id as pid,
					project_cstm.programme_year_c as year,
					project_cstm.start_date_c as start_date,
					project_cstm.end_date_c as end_date,
					users_cstm.area_c as area,
					scrm_session_information_cstm.start_time_c as start_time_c,
					scrm_session_information_cstm.end_time_c as end_time_c,
					scrm_session_information_cstm.slot_c as slot_c,
					scrm_session_information_cstm.faculty_name_c as faculty_name_c,
					scrm_session_information_cstm.faculty_id_c as faculty_id_c,
					(CASE project.assigned_user_id WHEN project.assigned_user_id = scrm_session_information_cstm.faculty_id_c OR project_cstm.scrm_partners_id_c = scrm_session_information_cstm.faculty_id_c THEN 1 ELSE 0 END) as pd,
					count(*) as no_of_sessions,
					scrm_partners.name,
					securitygroups.name as center,
					concat(users.last_name,' ',users.first_name) as pd_name
				FROM scrm_session_information
				LEFT JOIN scrm_session_information_cstm ON scrm_session_information.id = scrm_session_information_cstm.id_c
				LEFT JOIN scrm_timetable_scrm_session_information_1_c ON scrm_timetable_scrm_session_information_1_c.scrm_timetc7f4rmation_idb = scrm_session_information.id
				LEFT JOIN project_scrm_timetable_1_c ON project_scrm_timetable_1_c.project_scrm_timetable_1scrm_timetable_idb = scrm_timetable_scrm_session_information_1_c.scrm_timetable_scrm_session_information_1scrm_timetable_ida
				LEFT JOIN project ON project.id = project_scrm_timetable_1_c.project_scrm_timetable_1project_ida
				LEFT JOIN project_cstm ON project_cstm.id_c = project.id				
				LEFT JOIN scrm_partners ON scrm_partners.id = scrm_session_information_cstm.faculty_id_c
				LEFT JOIN scrm_partners_cstm ON scrm_partners.id = scrm_partners_cstm.id_c
				LEFT JOIN securitygroups_records ON securitygroups_records.record_id = scrm_partners.id
				LEFT JOIN securitygroups ON securitygroups.id = securitygroups_records.securitygroup_id
				LEFT JOIN users ON users.id = project.assigned_user_id
				LEFT JOIN users_cstm ON users_cstm.id_c = users.id				
				WHERE scrm_session_information.deleted = '0'
				AND project_scrm_timetable_1_c.deleted = '0'
				AND project.deleted = '0'
				AND scrm_timetable_scrm_session_information_1_c.deleted = '0'
				$where
				GROUP BY scrm_session_information.id,project.id
				";
		/* Changes made by Ashvin
		*  date:13-11-2018
		*  Reason: add start and end time columns in query : Faculty work load report- Any session less than or equal to 45 minutes should be considered as half session(0.5) and any session greater than 45 minutes and upto 90 minutes should be considered as one session.
		*  Ticket ID: 3784
		*  End
		*/
				// AND project.id = IFNULL({$pid_s},project.id)
				// AND scrm_partners.id = IFNULL({$fac_s},scrm_partners.id)
				// AND scrm_partners_cstm.faculty_type_c = IFNULL({$faculty_type},scrm_partners_cstm.faculty_type_c)
				// AND project.id = IFNULL({$pid_s},project.id)								
				// AND date(project_cstm.start_date_c) = IFNULL({$sdate},project_cstm.start_date_c)
				// AND date(project_cstm.end_date_c) = IFNULL({$edate},project_cstm.end_date_c)
		 // print_r($query);exit();

		//Center dropdown logic
		$center_query = $connection->prepare("SELECT id, name FROM securitygroups WHERE deleted = '0'");
		$center_query->execute();
		$center_dropdown = '<select name="center" id="center" class="select2"><option value=""></option>';
		while($row_enquiry=$center_query->fetch()){
			if (isset($_POST['center']) && $_POST['center'] == $row_enquiry['id']) {
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


		//Faculty type dropdown logic
		$faculty_type_dropdown='<select name="faculty_type" id="faculty_type" class="select2"><option value=""></option>';
		unset($app_list_strings['faculty_type_list'][""]);
		foreach ($app_list_strings['faculty_type_list'] as $key => $value) {
			if (isset($_POST['faculty_type']) && $_POST['faculty_type'] == $key) {
				$faculty_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$faculty_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$faculty_type_dropdown.='</select>';					
// 		ob_clean();	
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
					<h1>Faculty workload Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>


<td width="1%" style="text-align: left !important;"><strong>Start Date: </strong>
<td width="1%" style="text-align: left !important;"><input type = "text" name = "start_date" id = "start_date" value="'.$_REQUEST["start_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "start_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "fromb",
						align        : "right"});
					</script></td>

					<td width="1%" style="text-align: left !important;">
								&nbsp;&nbsp;&nbsp;&nbsp;<strong>End Date: </strong></td>

					<td width="1%" style="text-align: left !important;">
					<input type = "text" name = "end_date" id = "end_date" value="'.$_REQUEST["end_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "end_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "tob",
						align        : "right"});
					</script></td>														
						</tr>
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Type of faculty</b></td>
							<td width="1%" style="text-align: left !important;">'.$faculty_type_dropdown.'</td>
					
							<td width="1%" style="text-align: left !important;"><b>Faculty</b></td>
							<td width="1%" style="text-align: left !important;">'.$faculty_dropdown.'</td>
						</tr>																	
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programme Name</b></td>
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
// ob_clean();
		while($row_enquiry=$query->fetch()){
			
			/*Changes made by Ashvin
			*  date:13-11-2018
			*  Reason: add start and end time columns in query : Faculty work load report- Any session less than or equal to 45 minutes should be considered as half session(0.5) and any session greater than 45 minutes and upto 90 minutes should be considered as one session.
			*  Ticket ID: 3784
			*  Start
			*/
			$time='';
			$date_startTime = 0;
			$date_endTime = 0;
			$interval =0;
			
			$date_startTime = new DateTime($row_enquiry['start_time_c']); 
			$date_endTime = new DateTime($row_enquiry['end_time_c']);	
			$interval = date_diff($date_startTime,$date_endTime);
			$time=$interval->format('%h:%i:%s');
			$time_1 = explode(':', $time);
			
			$mintues= ($time_1[0]*60) + ($time_1[1]) + ($time_1[2]/60);
			
			$slot_arr=explode(',', $row_enquiry['slot_c']);
			$break_time=0;
			if(count($slot_arr)>=5){				
				$break_time=180;
			}
			if(count($slot_arr)==4){				
					$break_time=150;				
			}
			if(count($slot_arr)==3){				
				if($slot_arr[0]==1 && $slot_arr[1]==2 && $slot_arr[2]==3){
					$break_time=120;						
				}
				if($slot_arr[0]==2 && $slot_arr[1]==3 && $slot_arr[2]==4){
					$break_time=120;						
					
				}
				if($slot_arr[0]==3 && $slot_arr[1]==4 && $slot_arr[2]==5){
					$break_time=60;						
				}			
			}
			if(count($slot_arr)==2){					
				if($slot_arr[0]==2 && $slot_arr[1]==3){
					$break_time=90;						
				}else{
					$break_time=30;
				}						
			}
			
			$mintues=(integer)$mintues-$break_time;
			
			if((integer)$mintues<=45){
				$row_enquiry['no_of_sessions']=0.5;
			}
			if((integer)$mintues>45 && (integer)$mintues<=90){
				$row_enquiry['no_of_sessions']=1;
			}
			
			if((integer)$mintues>90 && (integer)$mintues<=180){
				$row_enquiry['no_of_sessions']=2;
			}
			if((integer)$mintues>180 && (integer)$mintues<=270){
				$row_enquiry['no_of_sessions']=3;
			}
			
			if((integer)$mintues>270 && (integer)$mintues<=405){
				$row_enquiry['no_of_sessions']=4;
			}
			if((integer)$mintues>405 && (integer)$mintues<=495){
				$row_enquiry['no_of_sessions']=5;
			}
			/*Changes made by Ashvin
			*  date:13-11-2018
			*  Reason: add start and end time columns in query : Faculty work load report- Any session less than or equal to 45 minutes should be considered as half session(0.5) and any session greater than 45 minutes and upto 90 minutes should be considered as one session.
			*  Ticket ID: 3784
			*  End
			*/
			if ($faculty_type != "NULL") {
				$faculty_id_c = str_replace('^', '', $row_enquiry['faculty_id_c']);
				$faculty_id_c = str_replace(' ', '', $faculty_id_c);
				// echo $row_enquiry['faculty_id_c'];
				$faculty_id_c = explode(',', $faculty_id_c);
				// print_r($faculty_id_c);
				$show = false;
				foreach ($faculty_id_c as $key => $value) {
					if (strpos($fac, $value) !== false) {
						$show = true;
					}
				}
				if ($show) {
					
					$data .='<tr>';
					$data .='<td>'.$row_enquiry['year'].'</td>';			
					$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['pid'].'">'.$row_enquiry['programme_name'].'</a></td>';
					$data .='<td>'.$row_enquiry['session_name'].'</td>';
					$data .='<td>'.$row_enquiry['faculty_name_c'].'</td>';
					$data .='<td>'.$row_enquiry['no_of_sessions'].'</td>';
					
					$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['start_date'])).'</td>';
					$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['end_date'])).'</td>';
					$data .='</tr>';						
				
				}
				
			}else{
						$data .='<tr>';
						$data .='<td>'.$row_enquiry['year'].'</td>';			
						$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['pid'].'">'.$row_enquiry['programme_name'].'</a></td>';
						$data .='<td>'.$row_enquiry['session_name'].'</td>';
						$data .='<td>'.$row_enquiry['faculty_name_c'].'</td>';
						$data .='<td>'.$row_enquiry['no_of_sessions'].'</td>';
						
						$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['start_date'])).'</td>';
						$data .='<td>'.date('d-m-Y',strtotime($row_enquiry['end_date'])).'</td>';
						$data .='</tr>';				
			}




			// $data .='<tr>';
			// $data .='<td>'.$row_enquiry['year'].'</td>';			
			// $data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['pid'].'">'.$row_enquiry['programme_name'].'</a></td>';
			// $data .='<td>'.$row_enquiry['session_name'].'</td>';
			// $data .='<td>'.$row_enquiry['faculty_name_c'].'</td>';
			// $data .='<td>'.$row_enquiry['no_of_sessions'].'</td>';
			// $data .='<td>'.($row_enquiry['pd_name'] == $row_enquiry['name'] ? 'Yes': 'No').'</td>';
			// $data .='<td>'.date('d-m-Y',strtotime($row_enquiry['start_date'])).'</td>';
			// $data .='<td>'.date('d-m-Y',strtotime($row_enquiry['end_date'])).'</td>';
			// $data .='</tr>';	

		}
		// exit();
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

								<td>Programme Name</td>
								<td>Session Name</td>
								<td>Faculty</td>
								<td>No of Sessions</td>

								<td>Start Date</td>
								<td>End Date</td>
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
		                    title: 'Faculty workload Report',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'Faculty workload Report',
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
					$('#start_date,#end_date').val("");
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
