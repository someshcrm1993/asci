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

class AOS_ContractsViewaccomodationsreport extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$current_user;
		$dateFormat = $current_user->getPreference('datef');;
		$url = $sugar_config['site_url'];	
		
		require_once('custom/modules/AOS_Contracts/database.php');
		
		$from_date = date('Y-m-d',strtotime($_POST['from_date']));
		$to_date = date('Y-m-d',strtotime($_POST['to_date']));		
		// echo $from_date;exit;
		$query="SELECT scrm_accommodation_cstm.guest_type_c, scrm_accommodation_cstm.guest_type_c, scrm_accommodation_cstm.check_in_c, scrm_accommodation_cstm.check_out_c,CONCAT(contacts.first_name,' ',contacts.last_name) as participant_name, scrm_partners.name as faculty_name FROM scrm_accommodation_cstm
				INNER JOIN scrm_accommodation ON scrm_accommodation_cstm.id_c = scrm_accommodation.id
				LEFT JOIN scrm_accommodation_contacts_1_c ON scrm_accommodation_contacts_1_c.scrm_accommodation_contacts_1scrm_accommodation_ida = scrm_accommodation_cstm.id_c
				LEFT JOIN scrm_partners_scrm_accommodation_1_c ON scrm_partners_scrm_accommodation_1_c.scrm_partners_scrm_accommodation_1scrm_accommodation_idb = scrm_accommodation_cstm.id_c 
				LEFT JOIN contacts ON contacts.id = scrm_accommodation_contacts_1_c.scrm_accommodation_contacts_1contacts_idb
				LEFT JOIN scrm_partners ON scrm_partners.id = scrm_partners_scrm_accommodation_1_c.scrm_partners_scrm_accommodation_1scrm_partners_ida 
				where scrm_accommodation.deleted = '0'
				AND (scrm_accommodation_contacts_1_c.deleted = '0' OR scrm_accommodation_contacts_1_c.deleted IS NULL)
				AND (scrm_partners_scrm_accommodation_1_c.deleted = '0' OR scrm_partners_scrm_accommodation_1_c.deleted IS NULL)
				AND (contacts.deleted = '0' OR contacts.deleted IS NULL)
				AND (scrm_partners.deleted = '0' OR scrm_partners.deleted IS NULL) 
				AND (scrm_accommodation_cstm.guest_type_c='Guest' OR scrm_accommodation_cstm.guest_type_c='Guest Faculty') 
				AND scrm_accommodation_cstm.check_in_c >= '$from_date' 
				AND scrm_accommodation_cstm.check_out_c <='$to_date'";
// echo $query;exit;
		echo '<!DOCTYPE html>
			<html lang="en">

			<body>
			<form name = "run" method = "post" action = "" style="margin-top:50px">
			 
			<div style = "background-color:#EEE">
			<br>
			<center>
			<h2>Guest Speakers, Bella Vistan &amp; Guests Report</h2>
			<br>
			<table width="50%">
				<tr>
					<td>From</td>
					<td>
						<input type = "text" name = "from_date" id = "from_date" value="'.$_POST["from_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="frb" align="absmiddle" />
						<script type="text/javascript">
							Calendar.setup({inputField   : "from_date",
							ifFormat      :    "%d-%m-%Y",
							button       : "frb",
							align        : "right"});
						</script>
					</td>
					<td>To</td>
					<td>
						<input type = "text" name = "to_date" id = "to_date" value="'.$_POST["to_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
						<script type="text/javascript">
							Calendar.setup({inputField   : "to_date",
							ifFormat      :    "%d-%m-%Y",
							button       : "tob",
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
		// ob_clean();
		$dateFormat = 'd-m-Y';
		while($row_enquiry=$query->fetch()){
			$data .='<tr>';
			$data .='<td>'.$i.'</td>';
			if ($row_enquiry['guest_type_c'] == "Guest Faculty" || $row_enquiry['guest_type_c'] == "Guest") {
				$data .= '<td>'.$row_enquiry['faculty_name'].'</td>';
			}

			if ($row_enquiry['guest_type_c'] == 'BellaVistian') {
				$data .= '<td>'.$row_enquiry['participant_name'].'</td>';
			}

			if ($row_enquiry['check_in_c']) {
				$data .= '<td>'.date($dateFormat.' H:i', strtotime($row_enquiry['check_in_c'])).'</td>';
			}else{
				$data .= '<td></td>';
			}

			if ($row_enquiry['check_out_c']) {
				$data .= '<td>'.date($dateFormat.' H:i', strtotime($row_enquiry['check_out_c'])).'</td>';				
			}else{
				$data .= '<td></td>';
			}

			if ($row_enquiry['check_in_c'] && $row_enquiry['check_out_c']) {
				$data .= '<td>'.date_diff(date_create_from_format("Y-m-d H:i:s",$row_enquiry['check_out_c']),date_create_from_format("Y-m-d H:i:s",$row_enquiry['check_in_c']))->days.'</td>';

			}else{
				$data .= '<td></td>';
			}
			// $data .='<td>'.$row_enquiry['Expectations'].'</td>';
			// $data .='<td>'.$row_enquiry['Present_Responsibility'].'</td>';
			$data .='</tr>';
			$i++;
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
	                    title: 'Guest Speakers, Bella Vistan & Guests Report',
	                },
	                {
	                    extend: 'pdfHtml5',
	                    title: 'Guest Speakers, Bella Vistan & Guests Report',
	                    pageSize: 'LEGAL'
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
								<th>S No</th>
								<th>Name</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>No of days</th>
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
