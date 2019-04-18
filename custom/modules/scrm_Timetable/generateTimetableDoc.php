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
    {page:Section1;}
  
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
  <div class="Section1">
    <div class="MsoNormal">
		<div class="right">
			<table id="timetable_table" class="table table-bordered table-responsive">
				<tr>
					<td style="text-align: center;">
						<span>Time</span>/<span>Session</span>
					</td>

				</tr>
				<?php 
					foreach ($_SESSION['data'] as $date => $sessions) {
						echo "<tr>";
						echo "<td style='text-align: center;'><div>{$sessions['day_name']}</div><div>{$date}</div></td>";
						foreach ($sessions as $key => $value) {
							if($key != 'day_name'){
					    		echo "<td style='text-align: center;'><div class='session-mix-time'>{$value['start_time']} - {$value['end_time']}</div><div>{$value['session_name']}</div><div>-<small><strong>{$value['faculty_name']}</strong></small></div> </td>";
					    	}
						}
						echo "</tr>";
					}

			?>
		</div>


   </div>
   </div>
</body>
</html>
