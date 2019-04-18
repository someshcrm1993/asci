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

class AOS_ContractsViewdaily_occupancy_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$current_user;
		$dateFormat = $current_user->getPreference('datef');;
		$url = $sugar_config['site_url'];	
		
		require_once('custom/modules/AOS_Contracts/database.php');
		
		if (!isset($_POST['from_date']) || !$_POST['from_date']) {
				$date = date('Y-m-d');
		}else{
			$date = $_POST['from_date'];			
		}
		$date = date('Y-m-d', strtotime($date));
		$query="SELECT 
					SUM(CASE WHEN scrm_accommodation_cstm.accommodation_type_c = 'Executive Hostel' THEN 1 ELSE 0 END) AS occupied,
					scrm_accommodation_cstm.location_c
				FROM scrm_accommodation
				LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = scrm_accommodation.id
				WHERE scrm_accommodation.deleted = '0'
				AND date(scrm_accommodation_cstm.check_in_c) <= '{$date}'  
				AND date(scrm_accommodation_cstm.check_out_c) >= '{$date}'
				GROUP BY scrm_accommodation_cstm.location_c";
		$date = date('d M Y', strtotime($date));
		// print_r($query);exit();
		echo '<!DOCTYPE html>
			<html lang="en">

			<body>
			<form name = "run" method = "post" action = "" style="margin-top:50px">
			 
			<div style = "background-color:#EEE">
			<br>
			<center>
			<h2>DAILY OCCUPANCY STATEMENT</h2>
			<br>
			<table width="50%">
				<tr>
					<td>Selct Date</td>
					<td>
						<input type = "text" name = "from_date" id = "from_date" value="'.$_POST["from_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="frb" align="absmiddle" />
						<script type="text/javascript">
							Calendar.setup({inputField   : "from_date",
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
		$query=$connection->prepare($query);
		$query->execute();
		$i = 1;
		$data = '';
		$cpc_new = false;
		$cpc_old = false;
		$bv = false;

		while($row = $query->fetch()){
			$data .='<tr>';
			$data .= '<td>'.$date.'</td>';
			$data .= '<td>'.str_replace('_', ' ', $row['location_c']).'</td>';
			$data .= '<td>'.($row['occupied']).'</td>';

			if ($row['location_c'] == 'CPC_NEW') {			
				$data .= '<td>'.(55 - $row['occupied']).'</td>';		
				$data .= '<td>55</td>';
				$cpc_new = true;
			}

			if ($row['location_c'] == 'CPC_OLD') {
				$data .= '<td>'.(58 - $row['occupied']).'</td>';		
				$data .= '<td>58</td>';
				$cpc_old = true;
			}

			if ($row['location_c'] == 'Bella Vista') {
				$data .= '<td>'.(92 - $row['occupied']).'</td>';		
				$data .= '<td>92</td>';
				$bv = true;
			}			

			$data .='</tr>';
			$i++;
		}

		if (!$cpc_new) {
			$data .='<tr>';
			$data .= '<td>'.$date.'</td>';
			$data .= '<td>CPC New</td>';
			$data .= '<td>0</td>';		
			$data .= '<td>55</td>';			
			$data .= '<td>55</td>';			
			$data .= '</tr>';			

		}
		if (!$bv) {
			$data .='<tr>';
			$data .= '<td>'.$date.'</td>';
			$data .= '<td>Bella Vista</td>';
			$data .= '<td>0</td>';		
			$data .= '<td>92</td>';			
			$data .= '<td>92</td>';			
			$data .= '</tr>';
		}
		if (!$cpc_old) {
			$data .='<tr>';
			$data .= '<td>'.$date.'</td>';
			$data .= '<td>CPC Old</td>';
			$data .= '<td>0</td>';		
			$data .= '<td>58</td>';			
			$data .= '<td>58</td>';
			$data .= '</tr>';			
		}				

// print_r(error_get_last());exit();
// echo $data;exit();
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
			$('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
		                {
		                    extend: 'csvHtml5',
		                    title: 'DAILY OCCUPANCY STATEMENT',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'DAILY OCCUPANCY STATEMENT',
		                    pageSize: 'A4'
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
								<td>Date</td>
								<td>Location</td>
								<td>Occupied</td>
								<td>Available</td>
								<td>Total</td>
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
