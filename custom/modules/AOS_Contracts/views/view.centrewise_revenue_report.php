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

class AOS_ContractsViewcentrewise_revenue_report extends SugarView {
	
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
		$centre = $_POST['centre'];
		$programmecode = $_POST['programmecode'];

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT p.id,p.name,pc.programme_id_c,u.user_name,c.name as centre,FORMAT(sum(i.total_amount-i.tax_amount),2) as total,FORMAT(SUM(IF(month(i.date_entered) = 1,ABS(i.total_amount-i.tax_amount),0)),2) as jan_total ,FORMAT(SUM(IF(month(i.date_entered) = 2,ABS(i.total_amount-i.tax_amount),0)),2) as feb_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 3,ABS(i.total_amount-i.tax_amount),0)),2) as mar_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 4,ABS(i.total_amount-i.tax_amount),0)),2) as apr_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 5,ABS(i.total_amount-i.tax_amount),0)),2) as may_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 6,ABS(i.total_amount-i.tax_amount),0)),2) as jun_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 7,ABS(i.total_amount-i.tax_amount),0)),2) as jul_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 8,ABS(i.total_amount-i.tax_amount),0)),2) as aug_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 9,ABS(i.total_amount-i.tax_amount),0)),2) as sep_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 10,ABS(i.total_amount-i.tax_amount),0)),2) as oct_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 11,ABS(i.total_amount-i.tax_amount),0)),2) as nov_total
		  ,FORMAT(SUM(IF(month(i.date_entered) = 12,ABS(i.total_amount-i.tax_amount),0)),2) as dec_total FROM aos_invoices i left join project_aos_invoices_1_c pi on pi.project_aos_invoices_1aos_invoices_idb = i.id left join project p on p.id = pi.project_aos_invoices_1project_ida left join project_cstm pc on pc.id_c = p.id left join securitygroups_records s on s.record_id = p.id left join securitygroups c on c.id = s.securitygroup_id left join users u on u.id = p.assigned_user_id where i.deleted = 0 and p.deleted = 0 and pi.deleted = 0 and s.deleted = 0 and i.status != 'Cancelled'";
		if(!empty($_POST['centre'])){
			$query .=" and s.securitygroup_id = '$centre'";
		}
		if(!empty($_POST['programmecode'])){
			$query .=" and i.name = '$programmecode'";
		}
		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query .=" and i.invoice_date between '$from_date' and '$to_date'";
		}
		$query .=" group by p.id";

		$centreBean = BeanFactory::getBean('SecurityGroups');

		//centre dropdown logic
		$centre_dropdown='<select name="centre" id="centre" class="select2"><option value=""></option>';
		foreach ($centreBean->get_full_list("") as $key => $value) {
			if ($_POST['centre'] == $value->id) {
				$centre_dropdown.='<option label="'.$value->name.'" value="'.$value->id.'" selected>'.$value->name.'</option>';
			}else{
				$centre_dropdown.='<option label="'.$value->name.'" value="'.$value->id.'">'.$value->name.'</option>';				
			}
		}
		$centre_dropdown.='</select>';

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
					<h1>Centre wise Revenue Report</h1>
					<br>
					<table width="100%" style="border-collapse: separate;border-spacing: 1em;" cellspacing="0" cellpadding="0" class="table cell-border" id="dropdowns_table"> 
						
						<tr>
							<td width="1%" style="text-align: left !important;"><b>Programme Code</b></td>
							<td width="1%" style="text-align: left !important;"><input type="text" name="programmecode" value="'.$programmecode.'"></td>
							<td width="1%" style="text-align: left !important;"><b>Centre</b></td>
							<td width="1%" style="text-align: left !important;">'.$centre_dropdown.'</td>
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
		$apr_total = 0;
		$may_total = 0;
		$jun_total = 0;
		$jul_total = 0;
		$aug_total = 0;
		$sep_total = 0;
		$oct_total = 0;
		$nov_total = 0;
		$dec_total = 0;
		$jan_total = 0;
		$feb_total = 0;
		$mar_total = 0;
		$total = 0;
		while($row=$query->fetch()){
			$data .='<tr>';
			$data .='<td>'.$i.'</td>';
			$data .='<td><a href="index.php?module=Project&action=DetailView&record='.$row['id'].'">'.$row['name'].'</td>';
			$data .='<td>'.$row['programme_id_c'].'</td>';
			$data .='<td>'.$row['centre'].'</td>';
			$data .='<td>'.$row['user_name'].'</td>';

			$apr_total += str_replace(",","",$row['apr_total']);
			$may_total += str_replace(",","",$row['may_total']);
			$jun_total += str_replace(",","",$row['jun_total']);
			$jul_total += str_replace(",","",$row['jul_total']);
			$aug_total += str_replace(",","",$row['aug_total']);
			$sep_total += str_replace(",","",$row['sep_total']);
			$oct_total += str_replace(",","",$row['oct_total']);
			$nov_total += str_replace(",","",$row['nov_total']);
			$dec_total += str_replace(",","",$row['dec_total']);
			$jan_total += str_replace(",","",$row['jan_total']);
			$feb_total += str_replace(",","",$row['feb_total']);
			$mar_total += str_replace(",","",$row['mar_total']);
			$total += str_replace(",","",$row['total']);

			$data .='<td>'.$row['apr_total'].'</td>';
			$data .='<td>'.$row['may_total'].'</td>';
			$data .='<td>'.$row['jun_total'].'</td>';
			$data .='<td>'.$row['jul_total'].'</td>';
			$data .='<td>'.$row['aug_total'].'</td>';
			$data .='<td>'.$row['sep_total'].'</td>';
			$data .='<td>'.$row['oct_total'].'</td>';
			$data .='<td>'.$row['nov_total'].'</td>';
			$data .='<td>'.$row['dec_total'].'</td>';
			$data .='<td>'.$row['jan_total'].'</td>';
			$data .='<td>'.$row['feb_total'].'</td>';
			$data .='<td>'.$row['mar_total'].'</td>';
			$data .='<td>'.$row['total'].'</td>';
			$data .='</tr>';
			$i++;
		}	


		$data .='<tr>';
		$data .='<td><b>Total</b></td>';
		$data .='<td></td>';
		$data .='<td></td>';
		$data .='<td></td>';
		$data .='<td></td>';
		$data .='<td>'.number_format($apr_total,2).'</td>';
		$data .='<td>'.number_format($may_total,2).'</td>';
		$data .='<td>'.number_format($jun_total,2).'</td>';
		$data .='<td>'.number_format($jul_total,2).'</td>';
		$data .='<td>'.number_format($aug_total,2).'</td>';
		$data .='<td>'.number_format($sep_total,2).'</td>';
		$data .='<td>'.number_format($oct_total,2).'</td>';
		$data .='<td>'.number_format($nov_total,2).'</td>';
		$data .='<td>'.number_format($dec_total,2).'</td>';
		$data .='<td>'.number_format($jan_total,2).'</td>';
		$data .='<td>'.number_format($feb_total,2).'</td>';
		$data .='<td>'.number_format($mar_total,2).'</td>';
		$data .='<td>'.number_format($total,2).'</td>';
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
								<td>Particulars</td>
								<td>Programme Code</td>
								<td>Centre</td>
								<td>Faculty</td>
								<td>Apr 17</td>
								<td>May 17</td>
								<td>Jun 17</td>
								<td>Jul 17</td>
								<td>Aug 17</td>
								<td>Sep 17</td>
								<td>Oct 17</td>
								<td>Nov 17</td>
								<td>Dec 17</td>
								<td>Jan 18</td>
								<td>Feb 18</td>
								<td>Mar 18</td>
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
