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


	require_once('include/entryPoint.php');
	include_once('include/SugarPHPMailer.php');
	include_once('include/utils/db_utils.php');
	require_once('include/utils.php');
	include('custom/include/language/en_us.lang.php');
	global $db,$body,$body_main,$app_list_strings;
	global $sugar_config;

	header("Content-type: application/vnd.ms-word");
	 
	header("Content-Disposition: attachment;Filename=PDReport.doc");    

	ob_clean();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Word Report</title>
</head>
<body>
<style type="text/css">
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
	.box {
	  float: left;
	  margin: 1em;
	}
</style>
<div class="Section1">
	<div class="MsoNormal">
		<div class="" align="center">
			<table>
				<tr>
				<!-- commented by ashvin
				     Date:08-11-2018
					 Reason: Logo Size changes
					 Start
				 -->
					<!--<td width="1000px"><img src="<?php echo $sugar_config['site_url'] ?>/custom/include/logos/logo.png" style="width: 100%"></td>-->
					<td><img src="<?php echo $sugar_config['site_url'] ?>custom/modules/Project/asci_small_logo.jpg" height="50" width="50" style="width: 2%"></td>
					<!-- commented by ashvin
				     Date:08-11-2018
					 Reason: Logo Size changes
					 Start
				 -->
				</tr>
			</table>
			<br>
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA : HYDERABAD - 500 082</h4>
			<br>
			<h5>
				PROGRAMME DIRECTOR’S REPORT
			</h5>
			<br>	
			<div>Title: <?php echo $projectBean->name; ?></div>
			<div>(
    						<?php
			   					echo date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y"); 
			   				?>		
			   				)
			</div>
			<br>
			<div><strong>Program Directors:</strong> <?php echo $projectBean->assigned_user_name; ?>  <?php echo $projectBean->spd_c == ''? '' : '&'.$projectBean->spd_c; ?></div>
			<br>
			<div>
				Report Date:
			</div>
			<br>
			<br>
			<h5>
				PROGRAMME DIRECTOR'S REPORT
			</h5>
			<div>(<?php echo $projectBean->name; ?>)</div>			
			<div>(
    						<?php
			   					echo date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y"); 
			   				?>		
			   				)
			</div>
			<br>
			<div>
				<table cellpadding="3" border="0"  rules="none" style="width: 1500px!important;border: none!important;">
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>1.</b></td>
						<td width="250px" style="border: none!important" align="left">Name of the Institution</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><strong><div>Administrative Staff College of India</div><div>Bella Vista, Hyderabad 500 082</div><div>Andhra Pradesh</div></strong></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>2.</b></td>
						<td width="250px" style="border: none!important" align="left">Title of the Programme</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><?php echo $projectBean->name; ?></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>3.</b></td>
						<td width="250px" style="border: none!important" align="left">Duration/Dates</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><?php echo date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y"); ?></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>4.</b></td>
						<td width="250px" style="border: none!important" align="left">Name(s)  of the Programme Director</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><?php echo $projectBean->assigned_user_name; ?>  <?php echo $projectBean->spd_c == ''? '' : '&'.$projectBean->spd_c; ?></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>5.</b></td>
						<td width="250px" style="border: none!important" align="left">Number. of Participants</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><?php echo count($participantsBean); ?></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>6.</b></td>
						<td width="250px" style="border: none!important" align="left">Number of feedback forms received</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"><?php echo count($participantsBean); ?></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>7.</b></td>
						<td width="250px" style="border: none!important" align="left">About the Course Module</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>8.</b></td>
						<td width="250px" style="border: none!important" align="left">Pedagogy</td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>9.</b></td>
						<td width="250px" style="border: none!important;padding-bottom: 20px!important" align="left"><div>(1) Total number of working days</div><div style="padding-top: 20px!important">
						<br>(2) Number of working hours per day </div></td>
						<td>:</td>
						<td width="300px" style="border: none!important" align="center"></td>
					</tr>
					<tr style="border: none!important">
						<td style="border: none!important" width="100px"><b>10.</b></td>
						<td width="800px" style="border: none!important;padding-bottom: 20px!important" align="left" colspan="3"><strong>General remarks of the Course Director on the nature and extent of participants' involvement in the course, including attendance, punctuality, and interest evinced.</strong>
						<div align="left">
						<ol type="a">
							<li>The program evoked considerable interest among the participants. The programme had full attendance throughout. The participants matched the high standards of punctuality practiced by ASCI.</li>
							<li>The programme, received (Entry: Excellent/ Very Good/good, etc) Feedback</li>
							<li>Some of the notable comments of the participants are quoted below:</li>
							<li>The major suggestions for improvement are given below:</li>
						</ol>
						</div>
						</td>
					</tr>
					<tr style="border: none!important">
						<td width="800px" style="border: none!important;padding-bottom: 20px!important" align="center" colspan="3" width="100px">
						<strong>
						<div align="left">
						<ol type="a">
							<li>More Extensive Coverage for the following Topics:
							(Entry, text, multiple lines with bullets)</li>
							<li>Other suggestions
							(Entry, text, multiple lines with bullets)</li>
						</ol>
						</div>
						</td>
					</tr>										
				</table>
			</div>
			<br>
			<div align="left">
				<div><b>Attachments: (include from Documents)</b></div>
				<ol>
					<li><b>Consolidated Feedback</b>: <a href="<?php echo $sugar_config['site_url'].'/index.php?module=Project&action=feedback&return_module=Project&return_action=DetailView&id='.$projectBean->id; ?>"><?php echo $sugar_config['site_url'].'/index.php?module=Project&action=feedback&return_module=Project&return_action=DetailView&id='.$projectBean->id; ?></a> </li>
					<li><b>Time Table of the program: </b><a href="<?php echo $projectBean->project_scrm_timetable_1scrm_timetable_idb ? ($sugar_config['site_url'].'/index.php?module=scrm_Timetable&action=printDocument&id='.$projectBean->project_scrm_timetable_1scrm_timetable_idb) : ''; ?>"><?php echo $projectBean->project_scrm_timetable_1scrm_timetable_idb ? ($sugar_config['site_url'].'/index.php?module=scrm_Timetable&action=printDocument&id='.$projectBean->project_scrm_timetable_1scrm_timetable_idb) : ''; ?></a></li>
					<li><b>Faculty Workload statement: </b><a href="<?php echo $sugar_config['site_url'].'/index.php?module=Project&action=feedback&return_module=Project&return_action=DetailView&id='.$projectBean->id; ?>"><?php echo $sugar_config['site_url'].'/index.php?module=Project&action=feedback&return_module=Project&return_action=DetailView&id='.$projectBean->id; ?></a></li>
					<li><b>List of participants,  involved ASCI faculty  and guest speakers: </b><a href="<?php echo $sugar_config['site_url'].'/index.php?module=Project&action=printLOPDocument&id='.$projectBean->id; ?>"><?php echo $sugar_config['site_url'].'/index.php?module=Project&action=printLOPDocument&id='.$projectBean->id; ?></a></li>
					<li><b>Group photograph: </b><a href="<?php echo $sugar_config['site_url'].'/index.php?entryPoint=download&id=b266643d-e771-453e-9dad-59b672d25d90&type=Documents'; ?>"><?php echo $sugar_config['site_url'].'/index.php?entryPoint=download&id=b266643d-e771-453e-9dad-59b672d25d90&type=Documents'; ?></a></li>
				</ol>	
			</div>
			<br>
			<div>
				<table>
					<tr>
						<td align="left" width="500px"><?php echo $projectBean->assigned_user_name; ?></td>
						<td align="right" width="500px"><?php echo $projectBean->spd_c == ''? '' : '&'.$projectBean->spd_c; ?></td>
					</tr>
				</table>
			</div>
			<div align="left">
				Date: <?php echo date('d-m-Y'); ?>
			</div>
			<div>
				<?php
					if ($projectBean->overseas_tour_c=='No') {
						echo '</div></div></div></div></body></html>';exit();
					}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php exit; ?>
