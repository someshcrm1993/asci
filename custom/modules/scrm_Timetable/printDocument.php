<?php

//ini_set("display_errors", 'On');
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

require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
global $db,$body,$body_main,$app_list_strings;
global $sugar_config,$app_list_strings;
/*Code by Ashvin
  Date:28-12-2018
  Reason: Change week number in Roman Fomat
*/
function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}
/*end*/
 header("Content-type: application/vnd.ms-word");
 
 header("Content-Disposition: attachment;Filename=Timetable.doc");    
  
  // echo "<html>";
  // echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";

  ob_clean();
  echo "<body>";
    // $_REQUEST['id']
  session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Word Report</title>
<style>
<!--
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {
    font-size:12.0pt;
    font-family:"Times New Roman";}
@page Section1
    {size:595.3pt 841.9pt;
    margin: 28.8pt 42pt 19.6pt 20pt;}
div.Section1
    {page:Section1; }
  
  .temprow
  {
    border:1px solid #ff00000;
    height:220px;
  }
 
	.glyphicon-minus{
		color: red!important;
	}
	.right span:hover{
		cursor: pointer;
		/*background-color: #eee; */
	}

	table .glyphicon-plus{
		cursor: pointer;
		display: block!important;
		padding-bottom: 4px;
	}
	table td div span:hover{
		cursor: pointer;
		/*background-color: #2382D5; */
	}

	table td div .glyphicon-remove{
		padding-left: 4px!important;
	}

	.drop{
		padding: 0!important;
	}
	.w50{
		width: 50%!important;display: inline-block;
	}
	.w33{
		width: 33.3333333333%!important;display: inline-block;
	}

	.w25{
		width: 25%!important;display: inline-block;
	}
	.w100{
		width: 100%!important;
	}
	.session-data{
		border:1px solid #ddd;padding: 9px;;
	}
	.session-mix-time{
		font-size: 10px;
	    width: auto;
	    border-bottom: 1px solid #ddd;
	    padding-left: 27px;
	    padding-bottom: 2px;
	}
	.popover.clockpicker-popover{
	    z-index: 9999;
	}
table#timetable_table{
	    border: 1px solid #ddd;
}

-->
</style>
</head>
<body>
<?php 
	$projectBean = $_SESSION['project'];
	$programObjective = $_SESSION['programObjective'];
	$tFooterData = $_SESSION['tFooterData'];
?>
 <?php $i=1; $lineCount=0; foreach ($_SESSION['table'] as $key => $value) {?>
 
  <div class="Section1">
    <div class="MsoNormal">
		<div class="right">
		<div align="center">
			<img src="<?php echo $sugar_config['site_url'] ?>custom/modules/Project/asci_small_logo.jpg" height="50" width="50" style="width: 2%">
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA : HYDERABAD - 500 082</h4>
			
			<h4><?php echo $projectBean->name; ?>
			<br/>(
					<?php
	   					echo date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y"); 
	   				?>		
	   			 )
			</h4>			
		</div>
		<div align="center"><strong><u>TIME TABLE
		<?php if(count($_SESSION['table'] )>1){?>
			: WEEK- <?php echo integerToRoman($i); ?>
			<?php } ?>
		</u></strong></div>
		
		<div>
		<div  style="float:right" align="right"><strong>Venue: </strong><?php echo $projectBean->cr_no_c; ?></div>

			<table id="timetable_table" class="table table-bordered table-responsive" border="1">
				<tr>
				<!-- Modified By - Ashvin
				     Date - 17-10-2018
				     Reason - SWS needs to fix the table formatting in the timetable document exported	
				     Start----->
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<span>Day</span>/<span>Date</span>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	09:00 - 10:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	11:00 - 12:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	14:00 - 15:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	16:00 - 17:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;" width="200px">
						<strong>	18:00 - 19:30</strong>
					</td>
				    <!-- Modified By - Ashvin
				     Date - 17-10-2018
				     Reason - SWS needs to fix the table formatting in the timetable document exported	
				     End----->
				</tr>
			
				<?php echo $value;?>

				</table>
				<table style="width: 100%">
					<tr>
						<td style="text-align: left" align="left">Coffee / Tea: 1030 - 1100 hrs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td></td>
						<td style="text-align: center;" align="center">Lunch 1230 - 1400 hrs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td></td>
						<td style="text-align: center;" align="right">Tea / Coffee: 1530 - 1600 hrs</td>
					</tr>
				</table>
				<br>
				<!-- Code Modified by Somesh Bawane
				on dt. 22/1/19
				reason: as if footer was not present we are not able to get multiweek timetable on different pages -->
				<?php //if(!empty($tFooterData)){?>
					<div align="center" style="width: 50px;text-align: center;">
						<?php 

							foreach ($tFooterData as $k => $v) {	  
								if($v['weekno_c']==$i){							
									echo nl2br($v['description']);
									
									if(count($tFooterData)!=$i){
									echo '<div style="page-break-before: always;width:0px;height:0px;line-height: 0px;font-size:0px;visibility: hidden;">&nbsp;</div>';
									}else{
										echo '<div style="page-break-before: always;width:0px;height:0px;line-height: 0px;font-size:0px;visibility: hidden;">&nbsp;</div>';
									}
								}
							}
						?>	
					</div>
				
				<?php// }else{ ?>
				<div align="center" style="width: 50px;text-align: center;">
						<?php 
							foreach ($_SESSION['a'] as $key => $value) {								
								echo $value;
								echo "<br />";
							}
						?>	
				</div>
		</div>
   </div>
   </div>
  
   <?php //}
    $i++;  } ?>
</body>
</html>
<?php exit; ?>
