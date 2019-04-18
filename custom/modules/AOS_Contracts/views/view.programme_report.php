<?php

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

//~ ini_set('display_errors','On');
require_once('include/SugarCharts/SugarChartFactory.php');
//~ require_once('include/MVC/View/SugarView.php');
require_once('config.php');


class AOS_ContractsViewprogramme_report extends SugarView {
	
	private $chartV;

    function __construct(){    
        parent::SugarView();
    }
   
	
    function display()
	{
		global $sugar_config,$db,$app_list_strings;
		// print_r($app_list_strings);exit();
		$url = $sugar_config['site_url'];
		     if(empty($_REQUEST['from_date'])){
			  $_REQUEST['from_date']=date('01/m/Y');
			  			  }
          if(empty($_REQUEST['to_date'])){
			  $_REQUEST['to_date']=date('d/m/Y');		  
			  }

		$where = '';
		
		$programme_type = $_REQUEST['programme_type'];

		if ($_REQUEST['programme_type']) {

			$where .= " AND pc.programme_type_c = '$programme_type' ";
		}				  

		$programme_type_dropdown='<select name="programme_type" id="programme_type" class="select2"><option value=""></option>';
		unset($app_list_strings['programme_type_list'][""]);
		foreach ($app_list_strings['programme_type_list'] as $key => $value) {
			if ($_POST['programme_type'] == $key) {
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
			}else{
				$programme_type_dropdown.='<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';				
			}

			$i++;
		}
		$programme_type_dropdown.='</select>';		

		echo '<link rel="stylesheet" href="custom/modules/scrm_Custom_Reports/Report.css" type="text/css">';
		
		
		
		echo '<!DOCTYPE html>
<html lang="en">

<body>

<form name = "run" method = "post" action = "">
<center>
<h2 style="font-size: 22px;color: #181818;">ASCI Programme Summary Report</h2>
</center>
<div style = "padding:22px; width:100%; background-color:#EEE;">
<br>

 <table><tr><td><strong>From: </strong><input type = "text" name = "from_date" id = "from_date" value="'.$_REQUEST["from_date"].'">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
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
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
							<strong>Programme Type:</strong>

							'.$programme_type_dropdown.'
						</td>

					</tr>

					</table>

<br><br><br>

 
  <button type="submit" name="state" class="btn btn-primary">Run</button>
&nbsp&nbsp&nbsp&nbsp
<span id="clear"  class="btn btn-primary">Clear</span> 
&nbsp&nbsp&nbsp&nbsp<button type="submit" id="Export" name="Export" value="Export"  class="btn btn-primary">Export</button> &nbsp&nbsp&nbsp&nbsp<button type="submit" id="ExportPDF" name="ExportPDF" value="ExportPDF"  class="btn btn-primary">PDF</button> 
<br>
</div>


</form>
</body>
   <script>
  $(document).ready(function(){
	 
	});
  </script>
</html>';




	$data = '';
	
	$rows_list = $this->getMatrixData($where);
	//~ 
	foreach($rows_list as $row){
		$data .= '<tr style="text-align:center">';
					$originalDate = $row['startdate'];
					$StartnewDate = date("d-m-Y", strtotime($originalDate));
					if($StartnewDate=='01-01-1970') $StartnewDate="";
					$originalDate2 = $row['enddate'];
					$EndnewDate2 = date("d-m-Y", strtotime($originalDate2));
					if($EndnewDate2=='01-01-1970') $EndnewDate2="";
					$data .= '<td width="90px">'.$row['programme_code'].'</td>'; 		
					$data .= '<td>'.$row['type'].'</td>';							
					$data .= '<td>'.$row['name'].'</td>'; 				
					// $data .= '<td>'.$row['status'].'</td>'; 				 				
					$data .='<td>' .$StartnewDate.'</td>'; 
					$data .='<td>' .$EndnewDate2.'</td>'; 
					$data .='<td>' .$row['username'].'</td>';
					if (isset($row['id'])) {
						// echo $row['id'];exit();
						$pcpnts = participants($row['id']);
						$data .='<td>'.$pcpnts.'</td>'; 
					 }else{
					 	$data .='<td></td>'; 
					 } 

		$data .= '</tr>';
		
	}
	$_SESSION['pdf_data']=$data;
	//~ echo '<pre>';
	//~ print_r($data);
	
	echo $html =<<<HTML
		<!DOCTYPE html>
<html>
<head>
	<style>
	td,th
	{ text-align:center;}
	
	</style>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css" class="init">

	</style>
	<!--Added By Ashvin
	    date:23-10-2018
		Reason: Export PDF Through Datatables
	-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<link rel="stylesheet" href="custom/modules/AOS_Contracts/Report.css" type="text/css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
	<!--Added By Ashvin
	    date:23-10-2018
		Reason: Export PDF Through Datatables
	-->
</head><br>
<div class="container">	
 <div class="table-responsive">          
  <table id="example" class="table table-bordered table-responsive" cellspacing="0" width="100%">
  	<thead>
      <tr>
      	<td rowspan=""><b> Programme Code </b></td>
      	<td rowspan=""><b> Programme Type</b></td>
        <td rowspan=""><b> Programme Title </b></td>
<!--        <td rowspan=""><b> Programme Status</b></td> -->
        <td rowspan=""><b>Start Date</b></td>
        <td rowspan=""><b>End Date</b></td>
        <td rowspan=""><b>Course Director</b></td>
        <td rowspan=""><b>No of participants</b></td>
      </tr>
    </thead>
  	<tbody>
	$data
  </tbody>
  </table>
  </div>
</body>
	   <script>
  $(document).ready(function(){
  var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var current_date = '$current_date';
	var start_date = '$start_date';
	if((from_date=="")&&(to_date==""))
	{
	  $("#from_date").val(start_date);
	  $("#to_date").val(current_date);
	}   
  
		  
  	$("#clear").on("click",function(){
			//$("#from_date").val(" ");
			//$("#to_date").val(" ");
			$("#programme_type").val("");
			return false;
		
		});
		

  	/* Modified by: Ashvin
  	   Date:22-10-2010
  	   Reson: Report Format - Programme Summary Report
	   Start
  	*/
	/*var table = $('#example').DataTable( {
		dom: 'Bfrtip',
		buttons: [
		{
						extend: 'csv',
						title: 'Summary of Programmes Conducted Report',
					},
		{
			extend: 'pdfHtml5',
			title: 'Summary of Programmes Conducted Report',
			pageSize: 'LEGAL',
			customize: function ( doc ) {
			doc.pageMargins = [10,10,10,10];
			doc.defaultStyle.fontSize = 9;
			doc.styles.tableHeader.fontSize = 10;
			doc.styles.title.fontSize = 10;
			// Remove spaces around page title
			//doc.content[0].text = doc.content[0].text.trim();
			doc.styles.tableHeader = {
			   color: 'black',
			   background: 'white',
			   alignment: 'center',
			   bold: true,
			}
			doc.styles.tableBodyEven = {
			   color: 'black',
			   background: 'white',
			   alignment: 'center'
			}
			doc.styles.tableBodyOdd = {
			   color: 'black',
			   background: 'white',
			   alignment: 'center'
			}
			// Styling the table: create style object
			var objLayout = {};
			// Horizontal line thickness
			objLayout['hLineWidth'] = function(i) { return .10; };
			// Vertikal line thickness
			objLayout['vLineWidth'] = function(i) { return .10; };
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
			var now = new Date();
			var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
			doc.content.splice( 0, 1, {
				margin: [ 0, 0, 0, 12 ],
				alignment: 'center',
				width:50,		                        
				image: 'data:image/jpg;base64,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rCXlucVIPIHPdTSOVShK0lJq21hO11EZY06+8xaw66VBRWy2ApBH1uWTUXMZvmqtMwVoQ0wlppL++FArWtIyAO7iKsNQBGDxB7DUYbTCizBNbcMbBytKV7qFeI5VFh6de0Urap3TIq1xoWpba1ciXGn3mw290SyknHMHFSfmW1w3Y8tLSWDEQUoXvYASeee/10v3raBYNPpWxD3ZUgnIajjIz6TypZTA1btAdC5yl221Z4N8RvDw7ai5fHDzl25vLDv+yJ+97ULZCdVGtjarhJzugN/Rz+dQ4f2ial4ttptsdXEEgJOPXxp3sOjbRp5lIixkqex1nljKjU+E4HCize4rxFGlpRhfvevsVa3swu007901DJWTzShZxXY1sfs4IL0yY4e3r1Y+KMVOVCv4hiHs7eGgjs7KdMNY3o7jh/ecNS8TROnoSgpm1s7w7Vje99MNFFkVSxVaekpP1NbUdphAQy2htI7EJAFbaKKkoCiiigAooooAKKKKACiiigAooooAKx21migDWpAWClSQQeYIpWvez+x3lSnFxww+f+1k7pzTZRQ1csp1Z03eDsyqV6H1bYVldivXStDk27n/AHQnVWu7T1bhZUyEj6yBjNWr2VggEYNLl5Grrub+7BS9n7FYDatJQN2Tp58HtAP+qFbWJLnVj6fkKV2ZV/qrLVFYUesy2fFIoTFjp+iw2PBIos+YdYw/+P3ZV6tWa5ux3bfZBHB+ssZrCND6tvywu+3nomjzbaz/AKq1QABgADwrI4ijLzDruX+1BR937itY9A2OyFLjccPPjm691jTQEhIAAwByAr1RjhTLQyVKs6jvN3ZmiiigQKKKKACiiigAooooAKKKKAP/2SAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIA=='
			} );
			doc.content.splice( 1, 0, {
				margin: [ 0, 0, 0, 5 ],
				alignment: 'center',		                        
				text:'ADMINISTRATIVE STAFF COLLEGE OF INDIA',
				fontSize:'12',	
				bold: true,
			} );
			doc.content.splice( 2, 0, {
				margin: [ 0, 0, 0, 12 ],
				alignment: 'center',		                        
				text:'BELLA VISTA: HYDERABAD - 500 082',
				fontSize:'12',
				bold: true,	
			} );
			doc.content.splice( 3, 0, {
				margin: [ 0, 0, 0, 12 ],
				alignment: 'center',
				fontSize:'14',		                        
				text:'Summary of Programmes Conducted Report',
				bold: true,
			} );
			doc.content.splice( 4, 0, {
				margin: [ 0, 0, 0, 12 ],
				alignment: 'right',
				fontSize:'12',		                        
				text:'Date: '+jsDate,
				bold: true,
			} );
		}
	}
	]				
});*/
$('a.toggle-vis').on( 'click', function (e) {
	e.preventDefault();

	// Get the column API object
	var column = table.column( $(this).attr('data-column') );

	// Toggle the visibility
	column.visible( ! column.visible() );
} );
/* Modified by: Ashvin
	Date:22-10-2010
	Reson: Report Format - Programme Summary Report
	End
*/
});
</script>
HTML;

if(!empty($_POST['ExportPDF'])){
			
			require_once('include/tcpdf/tcpdf.php');
			$timestamp = date('Y_m_d_His'); 
			ob_end_clean();
			ob_start();	
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Ashvin Sawarkar');
			$pdf->SetTitle('Program Statement');
			$pdf->SetSubject('ASCI Reports');
			$pdf->SetKeywords('ASCI, Reports, Program, Statement, guide');

			$pdf->setPrintHeader(false);
			// set auto page breaks
			//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// set font
			$pdf->SetFont('helvetica', 'B', 13);

			// add a page
			$pdf->AddPage();
			$pdf->Image('custom/modules/Project/asci_small_logo.jpg', 100, 10, 50, 50, 'JPG', '', '', true, 80, '', false, false, 0, false, false, false); 
			$pdf->Write(1, '', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(2, '', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(3, '', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(4, '', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(5, 'ADMINISTRATIVE STAFF COLLEGE OF INDIA', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(6, 'BELLA VISTA: HYDERABAD - 500 082', '', 0, 'C', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->Write(7, '', '', 10, 'C', true, 0, false, false, 0);
			$pdf->Write(8, 'Summary of Programmes Conducted Report', '', 10, 'C', true, 0, false, false, 0);

			$pdf->Write(9, 'Date:'.date('d-m-Y'), '', 10, 'R', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', '', 10);

			$tbl2=$_SESSION['pdf_data'];
			$currentFromDatepdf=$_SESSION['currentFromDatepdf'];
			$currentToDatepdf=$_SESSION['currentToDatepdf'];
			$from_datepdf=$_SESSION['from_datepdf'];
			$to_datepdf=$_SESSION['to_datepdf'];
			$tbl = <<<HTML
			<div style="margin-top:20px;"></div>
			 <table id="example" class="table table-bordered table-responsive" border="1" cellpadding="1" cellspacing="0" width="100%">
  	<thead>
      <tr style="text-align:center">
      	<td rowspan="" width="90px"><b> Programme Code </b></td>
      	<td rowspan=""><b> Programme Type</b></td>
        <td rowspan=""><b> Programme     Title </b></td>
        <td rowspan=""><b>Start Date</b></td>
        <td rowspan=""><b>End Date</b></td>
        <td rowspan=""><b>Course     Director</b></td>
        <td rowspan=""><b>No of participants</b></td>
      </tr>
    </thead>
  	<tbody>
	$tbl2
  </tbody>
  </table>
HTML;
			$pdf->writeHTML($tbl, true, false, false, false, '');
			//Close and output PDF document
		$pdf->Output('Summary_of_Programmes_Conducted_Report.pdf', 'D');
		}
echo $_POST['Export'];
echo $_REQUEST['Export'];
		if(!empty($_POST['Export']))
		{
			$timestamp = date('Y_m_d_His'); 
			ob_end_clean();
			ob_start();	
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header("Content-Disposition: attachment; filename=ASCI_Programme_Summary_Report{$timestamp}.csv");

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
	
			fputcsv($output, array('Programme Code','Programme Type','Programme Title','Start Date','End Date','Course Director','No of participants'));
			// fputcsv($output, array('','','','','','','','BV','BV','CPC','CPC','Hotel',));
			// fputcsv($output, array('','','','','','','','Occupied','Available','Occupied','Available','',));
				foreach ($rows_list as $v) {
			    unset($v['StartDateWeek']);
			    unset($v['EndDateWeek']);
			    unset($v['accommodation']);
			    // 

				$v['name']= strip_tags($v['name'], '');
				$v['type']= strip_tags($v['type'], '');
				
				$v['id'] = participants($v['id']);
				
				if (strpos($v['name'], 'Week') !== false) {
					$v['id'] = '';
				}
				
				// unset($v['id']);
				fputcsv($output,$v);
			}
				exit;
					
		}
		
		
	}
	
	
	function checkholiday(){
		
		return true;
		}
	
	function getMatrixData($where)
	{
		
		global $db;	
		
				//From Date & To Date filter Condition
		  if(empty($_REQUEST['from_date'])){
			  $_REQUEST['from_date']=date('01/m/Y');
			  			  }
          if(empty($_REQUEST['to_date'])){
			  $_REQUEST['to_date']=date('d/m/Y');		  
			  }
		
		$from_date = $_REQUEST['from_date'];
		
		if(!empty($from_date))
		{
			$tmp = explode("/",$from_date);
			if( count($tmp) == 3)
			{
				$from_date = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
				$from_date = date('Y-m-d', strtotime($from_date. ' + 1 days'));
			} else 
			$from_date = '';
		}
		 $Fstart_date=$from_date;
		if(!empty($from_date))
		{
            
             $from_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($from_date)));
             $from_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($from_date)));
             
             $Fstart_date=$from_date;
			$from_date = " and date_created >= '$from_date' ";
		}
		$to_date = $_REQUEST['to_date'];
		if(!empty($to_date))
		{
			$tmp = explode("/",$to_date);
			if( count($tmp) == 3)
			{
				$to_date = $tmp[2].'-'.$tmp[1].'-'.($tmp[0]);
				$to_date = date('Y-m-d', strtotime($to_date. ' + 1 days'));
				//$to_date = $tmp[2].'-'.$tmp[1].'-'.($tmp[0]+1);
			} else 
			$to_date = '';
		}
		$Fend_date=$to_date;
		if(!empty($to_date))
		{
             $to_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($to_date)));
             $to_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($to_date)));
             $Fend_date=date('Y-m-d', strtotime($to_date));
			$to_date = " and date_created <= '$to_date' ";
		}
	
		$timestamp = strtotime($Fstart_date);
		$Mdate1=getFirstMondayofWeek($Fstart_date);
		$Fdate1=getFirstFridayofWeek($Fstart_date);
		$Mdate2=getFirstMondayofWeek($Fend_date);
		$Fdate2=getFirstFridayofWeek($Fend_date);
		 
		$diff = abs(strtotime($Fdate2) - strtotime($Mdate1));
		$daysDiff = floor($diff / (60*60*24));
		$weeksDiff = floor($diff / (60*60*24*7));
		$Totalweeks=++$weeksDiff;
	
		//~ printf("     --------->       , %d daysdiff, %d weeks, %d Totalweeks\n", $daysDiff, $weeksDiff, $Totalweeks);

		while($weeksDiff){
			$progdaygroup[$weeksDiff][1]=$weeksDiff;
			$progdaygroup[$weeksDiff][2]=$Mdate2;
			$progdaygroup[$weeksDiff][3]=$Fdate2;
			
			$weeksDiff--;
			$Mdate2=getlastWeekdate($Mdate2);
			$Fdate2=getlastWeekdate($Fdate2);
			}
		
		ksort($progdaygroup);
	
		global $current_user;

		$current_user_id = $current_user->id;
		//Main Query
		$r=0;
		$query="SELECT pc.programme_id_c as programme_code, p.id AS id, p.name AS name, p.status AS status, pc.programme_type_c AS type ,pc.start_date_c AS startdate, pc.end_date_c AS enddate, u.first_name as first_name, u.last_name AS last_name, pc.venue_c AS venue, pc.accommodation_c AS accommodation, pc.room_no_bv_c AS roomnobv, pc.room_no_cpc_new_c AS roomnocpcnew, pc.room_no_cpc_old_c AS roomnocpcold, pc.hotel_c AS hotel, pc.scrm_partners_id_c AS partners_id, WEEK( pc.start_date_c ) AS StartDateWeek, WEEK( pc.end_date_c ) AS EndDateWeek FROM project p, project_cstm pc, users u WHERE p.id = pc.id_c AND p.deleted =0 AND u.id = p.assigned_user_id $where ORDER BY pc.start_date_c ASC";

		
		$result = $db->query($query);
		while($row = $db->fetchByAssoc($result))
		{	
			$id = $row['id']; 
			$data[$r]['id'] = $id;
			$StartDateWeek = $data[$r]['StartDateWeek']= $row['StartDateWeek'];
			$EndDateWeek = $data[$r]['EndDateWeek']= $row['EndDateWeek'];
			
			$name = $data[$r]['name']= $row['name'];
			$type=$row['type'];
				switch ($type) {
					
        		case 'Announced':
        		$color = 'label-default';
        		break;
        		case "ICTP-On Campus":
        		$color = 'label-primary';
        		break;
        		case "ICTP-Off Campus":
        		$color = 'label-success';
        		break;
                case 'Seminar':
                $color = 'label-info';
                break;
                case 'Sponsored':
                $color = 'label-info';
                break;
                case 'Workshop ON Campus':
                $color = 'label-info';
                break;
        		case 'Workshop OFF Campus':
        		$color = 'label-info';
        		break;
        		case 'Long Duration':
        		$color = 'label-warning';
        		break;
        		
        	}
			
            
			$status=$data[$r]['status']=$row['status'];
			$type=$data[$r]['type']='<span class="label '.$color.'">'.$type.'</span>';			
			$startdate = $data[$r]['startdate']= $row['startdate'];
			$enddate = $data[$r]['enddate']= $row['enddate'];
			$username = $data[$r]['username']= $row['first_name']." ".$row['last_name'];
			$partners_id = $data[$r]['partners_id']= $row['partners_id'];
			if($partners_id){	
				$fetch_partner = "SELECT p.name as name FROM scrm_partners p  WHERE p.id='$partners_id' AND p.deleted=0";
				$result_partner = $db->query($fetch_partner);
				$row_partner = $db->fetchByAssoc($result_partner);
				$username = $data[$r]['username']=$username.", ".$row_partner['name'];
				}
			$venue = $data[$r]['venue']= $row['venue'];
			$accommodation = $data[$r]['accommodation']= $row['accommodation'];
			$roomnobv = $data[$r]['roomnobv']= str_replace("^","",$row['roomnobv']);
			$roomnobv=explode(",",str_replace("^","",$row['roomnobv']));
			if(!empty($roomnobv[0])){
				$roomnobv = $data[$r]['roomnobv']=count($roomnobv);
				}else{
					$roomnobv = $data[$r]['roomnobv']=0;
					}
			$A_roomnobv = $data[$r]['A_roomnobv']=90-$data[$r]['roomnobv'];
			$roomnocpcnew=explode(",",str_replace("^","",$row['roomnocpcnew']));
			if(!empty($roomnocpcnew[0])){
				$data[$r]['roomnocpcnew']=count($roomnocpcnew);
					}else{
					$roomnocpcnew = $data[$r]['roomnocpcnew']=0;
					}
			$A_roomnocpcnew = $data[$r]['A_roomnocpcnew']=51-$data[$r]['roomnocpcnew'];
			$roomnocpcold=explode(",",str_replace("^","",$row['roomnocpcold']));
			if(!empty($roomnocpcnew[0])){
				$data[$r]['roomnocpcold']=count($roomnocpcold);
					}else{
					$roomnocpcold = $data[$r]['roomnocpcold']=0;
					}
			$A_roomnocpcold = $data[$r]['A_roomnocpcold']=36-$data[$r]['roomnocpcold'];
			$roomnocpc = $data[$r]['roomnocpc']= "CPC Old:".$data[$r]['roomnocpcold']." ,CPC New: ".$data[$r]['roomnocpcnew'];
			$A_roomnocpc = $data[$r]['A_roomnocpc']= "CPC Old:".$data[$r]['A_roomnocpcold']." ,CPC New: ".$data[$r]['A_roomnocpcnew'];
			$hotel = $data[$r]['hotel']= $row['hotel'];
			$StartDateWeek = $data[$r]['StartDateWeek']= $row['StartDateWeek'];
			$EndDateWeek = $data[$r]['EndDateWeek']= $row['EndDateWeek'];
			$data[$r]['programme_code']= $row['programme_code'];
			$r++;
		}
		//~ print_r($data);
		//~ return $data;
		
		$s=0;
 foreach ($progdaygroup as $progdaygrouplist) {
	 
	 		$weeknum=$progdaygrouplist[1];
			
			$Fmonday = date("d-m-Y", strtotime($progdaygrouplist[2]));
			$Ffriday = date("d-m-Y", strtotime($progdaygrouplist[3]));
			
			$s++;
			$progdata[$s]['name']= "<b>Week No-".$weeknum."  ".$Fmonday." To ".$Ffriday."</b>";	
			//~ $progdata[$s]['roomnobv']=getBVOccupied($Fmonday,$Ffriday);
			$s++;
				foreach ($data as $rowlist) {
				
					$date2=$rowlist['startdate'];
					$date4=$rowlist['enddate'];
					$date1=$progdaygrouplist[2];
					$date3=$progdaygrouplist[3];
					
					//if((($date2<=$date3)&&($date1<=$date2)) || (($date4<=$date3)&&($date1<=$date4))){
					/*somesh bawane
					dt.20/03/2019
					reason: only need to consider start date between range week. earlier it was considering start and end date both within week range*/
					if(($date2<=$date3)&&($date1<=$date2)) { 
						/*Modified by ashvin
						* Date:09-11-2018
						* Reason:Programmes data is wrong. If any month is selected other month programmes 
						* Start
						*/
						if(!empty($Fend_date) && strtotime($rowlist['startdate'])<=strtotime($Fend_date) || (empty($Fend_date))){
							$progdata[$s]['programme_code']= $rowlist['programme_code'];
							$progdata[$s]['type']= $rowlist['type'];
							$progdata[$s]['name']= $rowlist['name'];
							
							$progdata[$s]['startdate']=$rowlist['startdate'];
							$progdata[$s]['enddate']=$rowlist['enddate'];
							$progdata[$s]['username']=$rowlist['username'];
							
							// $pcpnts = participants($rowlist['id']);

							$progdata[$s]['id']=$rowlist['id'];
							$s++;
						}
						/*Modified by ashvin
						* Date:09-11-2018
						* Reason: Programmes data is wrong. If any month is selected other month programmes 
						* End*/
					}

				}
			
			$s++;	
			$Totalweeks--;
			}	
		// print_r($progdata);exit();
		return $progdata;
	}
 }
 
 function getlastWeekdate($dayfromdate){
	$timestamp = strtotime($dayfromdate);
	//~ echo $days_ago = date('Y-m-d', strtotime('-7 days', $timestamp));
	return $days_ago = date('Y-m-d', strtotime('-7 days', $timestamp));
	}
function getFirstMondayofWeek($dayfromdate){
	$timestamp = strtotime($dayfromdate);
	$Dateday=date("l", $timestamp);
	if($Dateday=='Monday'){
		return $dayfromdate;
		}else if($Dateday=='Sunday'){
			$timestamp=strtotime('this monday', $timestamp);
			return date("Y-m-d", $timestamp);
			}else{
				$timestamp=strtotime('last monday', $timestamp);
				return date("Y-m-d", $timestamp);
				}
	}
function getFirstFridayofWeek($dayfromdate){
	$timestamp = strtotime($dayfromdate);
	$Dateday=date("l", $timestamp);
	if($Dateday=='Friday'){
		return $dayfromdate;
		}else if($Dateday=='Saturday'){
			$timestamp=strtotime('last friday', $timestamp);
			return date("Y-m-d", $timestamp);
			}else{
				$timestamp=strtotime('this friday', $timestamp);
				return date("Y-m-d", $timestamp);
				}
	}
function getusername($userid){
	global $db;	
	$fetch_user = "SELECT u.first_name as first_name, u.last_name AS last_name FROM users u  WHERE u.id='$partners_id' AND u.deleted=0";
				$result_user = $db->query($fetch_user);
				$row_user = $db->fetchByAssoc($result_user);
				return $username = $row_user['first_name']." ".$row_user['last_name'];

	}
	
function getBVOccupied($fmonday,$ffriday){
	global $db;	

	$fetch_Occupied = "SELECT count(distinct ac.room_no_bv_c) as Occupied FROM scrm_accommodation a, scrm_accommodation_cstm ac WHERE a.id=ac.id_c AND a.deleted=0 AND ac.room_no_bv_c <> 0 AND ac.room_no_bv_c IS NOT NULL AND ((ac.check_in_c BETWEEN CAST('$fmonday' AS DATE) AND CAST('$ffriday' AS DATE)) OR (ac.check_out_c BETWEEN CAST('$fmonday' AS DATE) AND CAST('$ffriday' AS DATE)))";
				$result_Occupied = $db->query($fetch_Occupied);
				$row_Occupied = $db->fetchByAssoc($result_Occupied);
				return $Occupied = $row_Occupied['Occupied'];

	}
	
function getCPCNewOccupied($fmonday,$ffriday){
	global $db;	

	$fetch_Occupied = "SELECT count(distinct ac.room_no_cpc_new_c) as Occupied FROM scrm_accommodation a, scrm_accommodation_cstm ac WHERE a.id=ac.id_c AND a.deleted=0 AND ac.room_no_cpc_new_c <> 0 AND ac.room_no_cpc_new_c IS NOT NULL AND ((ac.check_in_c BETWEEN CAST('$fmonday' AS DATE) AND CAST('$ffriday' AS DATE)) OR (ac.check_out_c BETWEEN CAST('$fmonday' AS DATE) AND CAST('$ffriday' AS DATE)))";
				$result_Occupied = $db->query($fetch_Occupied);
				$row_Occupied = $db->fetchByAssoc($result_Occupied);
				return $Occupied = $row_Occupied['Occupied'];

	}


function participants($id='')
{
	// echo $id;exit();
	$projectBean = BeanFactory::getBean('Project',$id);
	$participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
	return count($participantsBean);
}