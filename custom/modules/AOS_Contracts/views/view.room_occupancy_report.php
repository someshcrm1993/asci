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

class AOS_ContractsViewroom_occupancy_report extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db,$current_user;
		$dateFormat = $current_user->getPreference('datef');;
		$url = $sugar_config['site_url'];	
		
		require_once('custom/modules/AOS_Contracts/database.php');
		
		$where ='';
		if (isset($_POST['from_date']) && $_POST['from_date']) {
			$from_date = date('Y-m-d',strtotime($_POST['from_date']));
			$from_date3 = date('d-m-Y',strtotime($_POST['from_date']));
			$from_date1 =$from_date.' 24:00:00';
			$from_date2 =$from_date.' 00:00:00'; 
			/*Commented & Added by Ashvin
			  * Date: 27-11-2018
			  * Reason:However the occupancy status on selection of date and location is wrong. 
			  * Ticket ID: 3784
			  *	Start 
			*/
			//$where .= " AND project_cstm.start_date_c = '$from_date'";
			$where .= " AND scrm_accommodation_cstm.check_in_c <= '$from_date1' AND scrm_accommodation_cstm.check_out_c >= '$from_date2'";
			
			/*Commented by Ashvin
			  * Date: 27-11-2018
			  * Reason:However the occupancy status on selection of date and location is wrong. 
			  * Ticket ID: 3784
			  *	Start 
			*/
		}
		/*Modified by Ashvin
		  * Date: 12-11-2018
		  * Reason:Location filter should be added in room occupancy report. i.e., in executive hostel column of the report total is displayed from BV+CPC
		  * Ticket ID: 3784
		  *	Start 
		*/
		$loc="";
		if(!empty($_POST['location'])){
			$loc=$_POST['location'];
			$where .=" AND scrm_accommodation_cstm.location_c = '".$loc."' ";
		}
		$occ_location='';
		$occ_location='<select name="location" id="location" class="select2"><option value=""></option>';
		$occ_location.='<option label="Bella Vista" value="Bella Vista" ';
		if($_POST['location']=='Bella Vista'){ $occ_location.='selected';	}	
		$occ_location.='>Bella Vista</option>';
		$occ_location.='<option label="NDC" value="NDC"';
		if($_POST['location']=='NDC'){ $occ_location.='selected';}	
		$occ_location.=' >NDC</option>';
		$occ_location.='<option label="CPC New" value="CPC_New" ';
		if($_POST['location']=='CPC_New'){ $occ_location.='selected';}
		$occ_location.='>CPC New</option>';
		$occ_location.='<option label="CPC Old" value="CPC_Old" ';
		if($_POST['location']=='CPC_Old'){ $occ_location.='selected';}
		$occ_location.='>CPC Old</option>';		
		$occ_location.='</select>';	
		/*Modified by Ashvin
		  * Date: 12-11-2018
		  * Reason:Location filter should be added in room occupancy report. i.e., in executive hostel column of the report total is displayed from BV+CPC
		  * Ticket ID: 3784
		  *	End 
		*/
	     $query="SELECT 
					project.name as project_name,
					project_cstm.dg_flat_c as dg_flat,
					project_cstm.start_date_c as start_date,
					project_cstm.local_c as local,
					SUM(CASE WHEN scrm_accommodation_cstm.accommodation_type_c = 'Executive Hostel' THEN 1 ELSE 0 END) AS eh,
					SUM(scrm_accommodation_cstm.no_of_adults_c) AS adults,
					SUM(scrm_accommodation_cstm.no_of_children_c) AS children
				FROM project
				INNER JOIN project_cstm ON project.id = project_cstm.id_c
				INNER JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida = project.id
				LEFT JOIN scrm_accommodation ON scrm_accommodation.id = project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb
				LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = scrm_accommodation.id
				WHERE project.deleted = '0'
				AND project_scrm_accommodation_1_c.deleted = '0'
				AND scrm_accommodation.deleted = '0'
				$where
				GROUP BY project.id";

		echo '<!DOCTYPE html>
			<html lang="en">

			<body>
			<form name = "run" method = "post" action = "" style="margin-top:50px">
			 
			<div style = "background-color:#EEE">
			<br>
			<center>
			<h2>ROOM OCCUPANCY STATEMENT</h2>
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
					<!--
						Modified by Ashvin
					    Date: 12-11-2018
					    Reason:Location filter should be added in room occupancy report. i.e., in executive hostel column of the report total is displayed from BV+CPC
					    Ticket ID: 3784
					  	start 
					-->
					<td>
						<strong>Location:</strong>
						'.$occ_location.'
					</td>
					<!--
					   Modified by Ashvin
					   Date: 12-11-2018
					   Reason:Location filter should be added in room occupancy report. i.e., in executive hostel column of the report total is displayed from BV+CPC
					   Ticket ID: 3784
					   End 
					-->
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
			</div>
			</div>
			</form>
			</body>
			  
			</html>';			
		$query=$connection->prepare($query);
		$query->execute();
		$i = 1;
		$data = '';
		$t1 = 0;
		$t2 = 0;
		$t3 = 0;
		$t4 = 0;
		$t5 = 0;
		while($row_enquiry=$query->fetch()){
			$data .='<tr>';
			$data .= '<td>'.$row_enquiry['project_name'].'</td>';
			$data .= '<td>'.date('d-m-Y',strtotime($row_enquiry['start_date'])).'</td>';
			$data .= '<td>'.$row_enquiry['eh'].'</td>';
			$t1 = $row_enquiry['eh'] + $t1;
			$t2 = $row_enquiry['dg_flat'] + $t2;
			$t3 = $row_enquiry['local'] + $t3;
			$t5 = ($row_enquiry['eh']+$row_enquiry['dg_flat']+$row_enquiry['local']+$row_enquiry['adults']+$row_enquiry['children']) + $t5;
			$t4 = ($row_enquiry['adults']+$row_enquiry['children']) + $t4;

			$data .= '<td>'.$row_enquiry['dg_flat'].'</td>';
			$data .= '<td>'.$row_enquiry['local'].'</td>';
			$data .= '<td>'.($row_enquiry['adults']+$row_enquiry['children']).'</td>';
			$data .= '<td>'.($row_enquiry['eh']+$row_enquiry['dg_flat']+$row_enquiry['local']+$row_enquiry['adults']+$row_enquiry['children']).'</td>';
			$data .= '<td>&nbsp;</td>';

			// $data .= '<td>Test</td>';
			// $data .= '<td>Test</td>';
			// $data .= '<td>Test</td>';
			// $data .= '<td>Test</td>';
			// $data .= '<td>Test</td>';
			// $data .= '<td>Test</td>';
			// $data .= '<td>&nbsp;</td>';

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
		                    title: 'Room Occupancy Report',
		                },
		                {
		                    extend: 'pdfHtml5',
		                    title: 'Room Occupancy Report',
		                    pageSize: 'A4',
		                    footer: true,
		                    header: true,
							customize: function ( doc ) {
								doc.pageMargins = [10,10,10,10];
								doc.defaultStyle.fontSize = 10;
								doc.styles.tableHeader.fontSize = 9;
								doc.styles.title.fontSize = 14;
							
					        // Styling the table: create style object
					        var objLayout = {};
					        // Horizontal line thickness
					        objLayout['hLineWidth'] = function(i) { return .15; };
					        // Vertikal line thickness
					        objLayout['vLineWidth'] = function(i) { return .15; };
					        // Horizontal line color
					        objLayout['hLineColor'] = function(i) { return '#000'; };
					        // Vertical line color
					        objLayout['vLineColor'] = function(i) { return '#000'; };
					        // Left padding of the cell
					        objLayout['paddingLeft'] = function(i) { return 4; };
					        // Right padding of the cell
					        objLayout['paddingRight'] = function(i) { return 4; };
					        // Inject the object in the document
					        doc.content[1].layout = objLayout;
								var loc='{$loc}';
								var date1='{$from_date3}';
								if(loc !=""){
									
									doc.content.splice( 1, 0, {
										margin: [ 0, 0, 0, 5 ],
										alignment: 'center',		                        
										text:'Location:'+loc,
										fontSize:'9',	
										bold: true,
									} );
								}
								if(loc !="" && date1 !=""){
									doc.content.splice( 2, 0, {
										margin: [ 0, 0, 0, 5 ],
										alignment: 'center',		                        
										text:'Date:'+date1,
										fontSize:'9',	
										bold: true,
									} );
								}
								if(loc =="" && date1 !=""){
									doc.content.splice( 1, 0, {
										margin: [ 0, 0, 0, 5 ],
										alignment: 'center',		                        
										text:'Date:'+date1,
										fontSize:'9',	
										bold: true,
									} );
								}
							}
		                }
	        	]			
			} );
		} );


			</script>
		</head>

		<body class="dt-example">
			<div class="container" style="padding-top:40px" width="100%">
				<section>
					

					<table id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th rowspan="2">Programme Name</th>
								<th rowspan="2">Start Date</th>
								<th colspan="6">Occupancy Position</th>
							</tr>
							<tr>
								<th>Executive Hostel</th>
								<th>D G’s Flat</th>
								<th>Local</th>
								<th>Family Members</th>
								<th>Total Members</th>
								<th>Remarks</th>
							</tr>
						</thead>

						<tbody>
					$data
						</tbody>
						<tfoot>
							<tr>
								<td style="text-align: right !important;"><strong>Total</strong></td>
								<td></td>
								<td>{$t1}</td>
								<td>{$t2}</td>
								<td>{$t3}</td>
								<td>{$t4}</td>
								<td>{$t5}</td>
							</tr>
						</tfoot>
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
					$("#location").removeAttr("selected");
					$('#location').val("").trigger("change");
					$("#location").val("");
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
