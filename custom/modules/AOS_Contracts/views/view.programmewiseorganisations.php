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

class AOS_ContractsViewprogrammewiseorganisations extends SugarView {
	
    function __construct(){    
        parent::SugarView();
    }
    
    function display()
	{
		global $sugar_config,$db, $app_list_strings;
		$url = $sugar_config['site_url'];	
		$year = $_POST['year'];
		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT project.id, project.name, project_cstm.programme_year_c,accounts.name as organisation_name, accounts.id as oid FROM project 
				INNER JOIN project_cstm ON project_cstm.id_c = project.id
				INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2project_ida = project.id 
				INNER JOIN accounts_contacts ON accounts_contacts.contact_id = project_contacts_2_c.project_contacts_2contacts_idb
				INNER JOIN accounts ON accounts.id = accounts_contacts.account_id 
				where project.deleted = '0'
				AND accounts.deleted = '0'
				AND project_contacts_2_c.deleted = '0'
				AND accounts_contacts.deleted = '0'
				AND project_cstm.programme_year_c = '$year'
				GROUP BY project.id, accounts.id";

		$program='<select name="year" id="year"><option value=""></option>';
		unset($app_list_strings['programme_year_list'][""]);
		foreach ($app_list_strings['programme_year_list'] as $key => $value) {
			if ($year == $key) {
				$program.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$program.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$program.='</select>';


		echo '<!DOCTYPE html>
<html lang="en">
	<body>
		<form name = "run" method = "post" action = "" style="margin-top:50px">
			<div style = "background-color:#EEE">
				<br>
				<center>
					<h2>Programme wise Organisations</h2>
					<table width="15%">
						<tr>
							<td>Programme Year</td>
							<td>'.$program.'</td>
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
			$data .='<tr>';
			$data .='<td><a href = "index.php?module=Project&action=DetailView&record='.$row_enquiry['id'].'">'.$row_enquiry['name'].'</a></td>';
			$data .='<td>'.$row_enquiry['programme_year_c'].'</td>';
			$data .='<td><a href = "index.php?module=Accounts&action=DetailView&record='.$row_enquiry['oid'].'">'.$row_enquiry['organisation_name'].'</a></td>';
			// $data .='<td>'.$row_enquiry['Expectations'].'</td>';
			// $data .='<td>'.$row_enquiry['Present_Responsibility'].'</td>';
			$data .='</tr>';
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
			<link rel="stylesheet" href="custom/modules/AOS_Contracts/Report.css" type="text/css">
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0"/>

			<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
			<script type="text/javascript" language="javascript" class="init">


		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
		        buttons: [
            		'csv', 'excel'
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
								<th>Programme Name</th>
								<th>Programme Year</th>
								<th>Organisation Name</th>
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
