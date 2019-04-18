<?php
// Written By: Rathina Ganesh
// Date: 22nd Sep 2017

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

class AOS_ContractsViewcentrewise_ie_statement_report extends SugarView {
	
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

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT sg.name,sum(i.total_amount-i.tax_amount) as total FROM aos_invoices i left join project_aos_invoices_1_c pi on pi.project_aos_invoices_1aos_invoices_idb = i.id left join project p on p.id = pi.project_aos_invoices_1project_ida left join project_cstm pc on pc.id_c = p.id left join securitygroups_records s on s.record_id = p.id left join securitygroups sg on sg.id = s.securitygroup_id where i.deleted = 0 and p.deleted = 0 and pi.deleted = 0 and s.deleted = 0 and i.status != 'Cancelled'";
	
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query .=" and i.invoice_date between '$from_date' and '$to_date'";
		}
		$query .=" group by s.securitygroup_id";

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
					<h1>Centre wise I&E Statement Report</h1>
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
				'.$query.'
			</div>
		</form>
	</body>
</html>';			
		$query=$connection->prepare($query);

		$query->execute();
		$i = 1;
		$total = 0;
		while($row=$query->fetch()){
			$data .='<tr>';
			$data .='<td>'.$i.'</td>';
			$data .='<td>'.$row['name'].'</td>';
			$total += $row['total'];
			$data .='<td>'.number_format($row['total'],2).'</td>';
			$data .='<td></td>';
			$data .='<td></td>';
			$data .='</tr>';
			$i++;
		}	
		$data .='<tr>';
		$data .='<td><b>Total</b></td>';
		$data .='<td></td>';
		$data .='<td>'.number_format($total,2).'</td>';
		$data .='<td></td>';
		$data .='<td></td>';
		$data .='</tr>';


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
								<td>S No.</td>
								<td>Name of Centre</td>
								<td>Actual Revenues</td>
								<td>Actual Expenses</td>
								<td>Surplus / (Deficit)</td>
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
            		'copy', 'csv', 'excel', 'pdf'
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
