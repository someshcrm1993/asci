<?php
// Written By: Rathina Ganesh
// Date: 19th Sep 2017
// ini_set('display_errors','On');
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

class AOS_ContractsViewdues_from_clients_report extends SugarView {
	
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
		$pd = $_POST['pd'];

		require_once('custom/modules/AOS_Contracts/database.php');
		$query="SELECT i.invoice_date,i.number,a.name,(select concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) from users  where id = p.assigned_user_id) as pd,DATEDIFF(NOW(),i.invoice_date) AS pending_days,i.total_amount,p.description,pc.programme_id_c,ic.actual_payment_made_c,CASE i.currency_id
			  WHEN '-99' THEN 'Indian Rupee'
			  WHEN '41ae018e-238a-8ed8-d615-592513e171a5' THEN 'EURO'
			  WHEN '5d3103c2-4a19-b7bf-75da-592586ee4aec' THEN 'USD' END as 'currency_id'
			  FROM aos_invoices i left join aos_invoices_cstm ic on ic.id_c = i.id left join accounts a on a.id = i.billing_account_id left join project_aos_invoices_1_c ip on ip.project_aos_invoices_1aos_invoices_idb = i.id join project p on p.id = ip.project_aos_invoices_1project_ida left join project_cstm pc on pc.id_c = p.id left join users u on u.id = p.assigned_user_id left join securitygroups_records s on s.record_id = p.id WHERE i.status ='Unpaid' and i.deleted = 0 and a.deleted = 0 and u.deleted = 0 and s.deleted = 0 and ip.deleted = 0 and p.deleted = 0";

		if(!empty($_POST['from_date']) && !empty($_POST['to_date'])){
			$query .=" and i.invoice_date between '$from_date' and '$to_date'";
		}

		if(!empty($_POST['pd'])){
			$query .=" and p.assigned_user_id = '$pd'";
		}
		if(!empty($_POST['centre'])){
			$query .=" and s.securitygroup_id = '$centre'";
		}
		$query .=" group by s.record_id";
		$pdquery = "SELECT concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as pd,u.id FROM acl_roles_users ru join users u on u.id = ru.user_id WHERE role_id = '270734b1-0242-9157-7a2e-590ff7943164'";
		$pdquery=$connection->prepare($pdquery);
		$pdquery->execute();
		while($row=$pdquery->fetch()){
			$pdArray[$row['id']] = $row['pd'];
		}


		//pd dropdown logic
		$pd_dropdown='<select name="pd" id="pd" class="select2"><option value=""></option>';
		foreach ($pdArray as $key => $value) {
			if ($_POST['pd'] == $key) {
				$pd_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$pd_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}
		}
		$pd_dropdown.='</select>';


		
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
					<h1>Dues From Clients</h1>
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
							<td width="1%" style="text-align: left !important;"><b>Faculty</b></td>
							<td width="1%" style="text-align: left !important;">'.$pd_dropdown.'</td>
							<td width="1%" style="text-align: left !important;"><b>Centre</b></td>
							<td width="1%" style="text-align: left !important;">'.$centre_dropdown.'</td>
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
		$data = '';
		// < 30 Days	31-90 Days	91-180 Days	181-01 Year	01-03 Years	>03 Years

		$query->execute();
		$totalPendingDays = 0;
		$totalAmount = 0;
		$totalAmount1 = 0;
		$totalAmount2 = 0;
		$totalAmount3 = 0;
		$totalAmount4 = 0;
		$totalAmount5 = 0;
		$totalAmount6 = 0;
		while($row=$query->fetch()){
			$data .='<tr>';
			$data .='<td>'.$row['invoice_date'].'</td>';
			$data .='<td>'.$row['number'].'</td>';
			$data .='<td>'.$row['programme_id_c'].'</td>';
			$data .='<td>'.$row['description'].'</td>';
			$data .='<td>'.$row['name'].'</td>';
			$data .='<td>'.$row['pd'].'</td>';
			$totalPendingDays += $row["pending_days"];
			$data .='<td>'.$row["pending_days"].'</td>';
			$data .='<td>'.$row["currency_id"].'</td>';
			$totalAmount += $row["total_amount"] - $row['actual_payment_made_c'] - $row['actual_payment_made_c'];
			$data .='<td>'.number_format($row['total_amount']- $row['actual_payment_made_c'],2).'</td>';

			if($row["pending_days"] <= 30){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount1 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			if($row["pending_days"] >= 31 && $row["pending_days"] <= 90){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount2 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			if($row["pending_days"] >= 91 && $row["pending_days"] <= 180){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount3 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			if($row["pending_days"] >= 181 && $row["pending_days"] <= 365){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount4 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			if($row["pending_days"] >= 366 && $row["pending_days"] <= 1095){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount5 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			if($row["pending_days"] >= 1096){ $total_amount = $row["total_amount"] - $row['actual_payment_made_c']; $totalAmount6 += $row["total_amount"] - $row['actual_payment_made_c']; }else{ $total_amount = ''; }
			$data .='<td>'.number_format($total_amount,2).'</td>';

			$data .='</tr>';
		}	
			$data .='<tr>';
			$data .='<td><b>Total</b></td>';
			$data .='<td></td>';
			$data .='<td></td>';
			$data .='<td></td>';
			$data .='<td></td>';
			$data .='<td></td>';
			$data .='<td>'.$totalPendingDays.'</td>';
			$data .='<td></td>';
			$data .='<td>'.number_format($totalAmount,2).'</td>';
			$data .='<td>'.number_format($totalAmount1,2).'</td>';
			$data .='<td>'.number_format($totalAmount2,2).'</td>';
			$data .='<td>'.number_format($totalAmount3,2).'</td>';
			$data .='<td>'.number_format($totalAmount4,2).'</td>';
			$data .='<td>'.number_format($totalAmount5,2).'</td>';
			$data .='<td>'.number_format($totalAmount6,2).'</td>';
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
								<td>Invoice Date</td>
								<td>Invoice Number</td>
								<td>Programme Code</td>
								<td>Programme Description</td>
								<td>Client Name</td>
								<td>Name of the Program Director</td>
								<td>No of Days Pending</td>
								<td>Currency</td>
								<td>Amount</td>
								<td>< 30 Days</td>
								<td>31-90 Days</td>
								<td>91-180 Days</td>
								<td>181-01 Year</td>
								<td>01-03 Years</td>
								<td>>03 Years</td>
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
