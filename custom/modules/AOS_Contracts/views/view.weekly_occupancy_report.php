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

class AOS_ContractsViewweekly_occupancy_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }

    public function programmeData($id='', $week_array, $connection)
    {
		
		// $query="SELECT 
		// 			project.name,
		// 			project_cstm.start_date_c, 
		// 			project_cstm.end_date_c,
		// 			count(scrm_accommodation_cstm.id_c) as occupied
		// 		FROM project 
		// 		INNER JOIN project_cstm ON project_cstm.id_c = project.id
		// 		LEFT JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida = project.id
		// 		LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb
		// 		LEFT JOIN scrm_accommodation ON scrm_accommodation.id = scrm_accommodation_cstm.id_c
		// 		WHERE project.deleted = '0'
		// 		AND (scrm_accommodation.id is NULL OR scrm_accommodation.deleted = '0')
		// 		AND project.id = $id
		// 		GROUP BY project.id";
		$query="SELECT 
					project.id,
					project.name
				FROM project 
				INNER JOIN project_cstm ON project_cstm.id_c = project.id
				WHERE
				 ((project_cstm.start_date_c BETWEEN '".$week_array[0]."' AND '".$week_array[7]."')
				OR (project_cstm.end_date_c BETWEEN '".$week_array[0]."' AND '".$week_array[7]."'))
				AND project.deleted = '0'
				GROUP BY project.id";
		// echo $query;exit();
		// print_r($connection);exit();
		// echo strstr($week_array[0], ' ');exit();
		$query=$connection->prepare($query);
		$query->execute();

		// while () {
		// 	# code...
		// }
		$data = '';
		// print_r($week_array);exit();
		while($row = $query->fetch()){
			
			$data .= '<tr>';
			$data .= '<td>'.$row['name'].'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[0], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[1], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[2], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[3], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[4], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[5], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[6], $connection).'</td>';
			$data .= '<td>'.$this->getOccupied($row['id'], $week_array[7], $connection).'</td>';
			$data .= '</tr>';
		}

		return $data;

    }

    public function getOccupied($id, $date, $connection)
    {
		$query="SELECT 
					project.name as project_name,
					SUM(CASE WHEN scrm_accommodation_cstm.accommodation_type_c = 'Executive Hostel' THEN 1 ELSE 0 END) AS eh
				FROM project
				INNER JOIN project_cstm ON project.id = project_cstm.id_c
				INNER JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida = project.id
				LEFT JOIN scrm_accommodation ON scrm_accommodation.id = project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb
				LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = scrm_accommodation.id
				WHERE project.deleted = '0'
				AND project_scrm_accommodation_1_c.deleted = '0'
				AND scrm_accommodation.deleted = '0'
				AND date(scrm_accommodation_cstm.check_in_c) <= '{$date}'  
				AND date(scrm_accommodation_cstm.check_out_c) >= '{$date}'
				AND scrm_accommodation.deleted = '0'
				AND project.id = '{$id}'
				";
		// echo $query; exit();

		$query=$connection->prepare($query);
		$query->execute();

		$row = $query->fetch();
		if (!$row['eh']) {
			return 0;
		}
		return $row['eh'];
    }
    
    function display()
	{
		global $sugar_config,$db,$current_user;
		$dateFormat = $current_user->getPreference('datef');;
		$url = $sugar_config['site_url'];	

		require_once('custom/modules/AOS_Contracts/database.php');
		
		if (!isset($_POST['to_date']) || !$_POST['to_date']) {
				$date = date('d-m-Y');
		}else{
			$date = $_POST['to_date'];			
		}
	
		$my_date = $date; 
		$week = date("W", strtotime($my_date)); // get week
		$y =    date("Y", strtotime($my_date)); // get year
		$first_date =  date('d-m-Y',strtotime($y."W".$week)); //first date 
		$first_date = date('d-m-Y', strtotime($first_date."-2 day"));
		 // echo $first_date;exit();
		$first_date = strtotime($first_date);
		$week_array = array();
		for($i=0 ;$i<=7; $i++) {
			  $week_array[] = date('l', strtotime("+ {$i} day", $first_date)).'('.date('d-m-Y', strtotime("+ {$i} day", $first_date)).')';
		}

		for($i=0 ;$i<=7; $i++) {
			  $week_array2[] = date('Y-m-d', strtotime("+ {$i} day", $first_date));
		}		

		echo '<!DOCTYPE html>
			<html lang="en">

			<body>
			<form name = "run" method = "post" action = "" style="margin-top:50px">
			 
			<div style = "background-color:#EEE">
			<br>
			<center>
			<h2>WEEKLY OCCUPANCY STATEMENT</h2>
			<br>
			<table width="50%">
				<tr>
					<td>Date</td>
					<td>
						<input type = "text" name = "to_date" id = "to_date" value="'.$_POST["to_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="frb" align="absmiddle" />
						<script type="text/javascript">
							Calendar.setup({inputField   : "to_date",
							ifFormat      :    "%d-%m-%Y",
							button       : "frb",
							align        : "right"});
						</script>
					</td>					
				</tr>
			</table>
			</center>
			<br>
			<div class="text-center">
			<button type="submit" name="state" class="btn btn-primary">Run</button>
			&nbsp&nbsp&nbsp&nbsp
			<button id="clear"  class="btn btn-primary">Clear</button> 			
			<div>
			</div>
			</form>
			</body>
			  
			</html>';			
	
		$data = '';
		$data .= '<table id="" class="display example" class="table table-bordered" cellspacing="0" width="100%">';
		$data .= '<thead>';
		$data .= '<tr>';
		$data .= '<td>Project Name</td>';
		foreach ($week_array as $key => $value) {
			$data .= '<td>'.str_replace(' ', '<br>', $value).'</td>';
		}
		$data .= '</tr>';
		$data .= '</thead>';
		$data .= '<tbody>';
		$data .= $this->programmeData('sadsad', $week_array2, $connection);
		$data .= '</tbody>';
		$data .= '</table>';	

// print_r(error_get_last());exit();
// echo $temp_data;exit();
	echo $html =<<<HTML
		<!DOCTYPE html>
		<html>
		<head>
			<style>
			td,th
			{ text-align:center !important;}
			</style>
			<link rel="stylesheet" href="custom/modules/AOS_Contracts/Report.css" type="text/css">
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0"/>

			<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
			<script type="text/javascript" language="javascript" class="init">


		$(document).ready(function() {
			$('.example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
		                {
		                    extend: 'csvHtml5',
		                    title: 'WEEKLY OCCUPANCY STATEMENT',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'WEEKLY OCCUPANCY STATEMENT',
		                    pageSize: 'A4',
		                    orientation: 'landscape',
		                }
	        	]						
			} );
		} );


			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px">
				<section>
					$data
				</section>
			</div>

		</body>
		 <script>
		  $(document).ready(function(){
		  	$("#clear").click(function(){
					$("select option").removeAttr("selected");
					$("#from_date").val("");
					$("#to_date").val("");
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
