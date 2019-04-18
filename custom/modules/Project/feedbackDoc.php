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

	header("Content-Disposition: attachment;Filename=Feedback.doc");

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
			<!--Modified by Ashvin
			    Date:09-11-2018
			    Reason: Logo Size Fix
			-->
			<img src="<?php echo $sugar_config['site_url'] ?>custom/modules/Project/asci_small_logo.jpg" width="50" height="50" width="2%" style="width: 10px" width="10px" height="10px">
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA : HYDERABAD - 500 082</h4>
			<!--Modified by Ashvin
			    Date:09-11-2018
			    Reason: Logo Size Fix
			    End
			-->
			<h4>Programme Title: <?php echo $feedback['name'] ?>
			<br />
			<font style="text-align: center;">(
    						<?php
			   					echo date_format(date_create($feedback['start_date_c']),"M d").' to '.date_format(date_create($feedback['end_date_c']),"M d, Y");
			   				?>
			   				)
			</font>
			</h4>

			<div style="text-align: left;" align="left">
				<span style="text-align: left;"><b>I. Please indicate to what extent each of the Programme objectives has been achieved.</b></span>
			</div>
			<br>
			<?php

				if ($feebackObjectives && $feebackObjectives->num_rows > 0) {

					$data = '';
					$i=1;
					while ($value = $db->fetchByAssoc($feebackObjectives)) {
						$data .= '<tr>';
						$data .= '<td style="text-align: center; border-color:#000">'.$i.'</td>';
						$data .= '<td style="border-color:#000;text-align: left;padding-left: 10px">'.$value['name'].'</td>';
						$data .= '<td style="text-align: center; border-color:#000">'.$value['Minimal'].'</td>';
						$data .= '<td style="text-align: center; border-color:#000">'.($value['Partial']).'</td>';
						$data .= '<td style="text-align: center; border-color:#000">'.($value['Complete']).'</td>';
						$data .= '</tr>';
						$i++;
					}
					$table =<<<TABLE
					<table border="1" style="border: 1px solid #000;" cellspacing="0">
						<tbody border="1" style="text-align: center; border-color:#000">
							<tr>
								<td style="text-align: center; border-color:#000" rowspan="3">Sl. No</td>
								<td style="text-align: center; border-color:#000" rowspan="3">Programme Objectives</td>
								<td style="text-align: center; border-color:#000"></td>
								<td style="text-align: center; border-color:#000"></td>
								<td style="text-align: center; border-color:#000"></td>
							</tr>
							<tr>
								<td style="text-align: center; border-color:#000">Minimal</td>
								<td style="text-align: center; border: 1px solid #000">Partial</td>
								<td style="text-align: center; border: 1px solid #000">Complete</td>
							</tr>
							<tr>
								<td style="text-align: center; border-color:#000">1</td>
								<td style="text-align: center; border-color:#000">2</td>
								<td style="text-align: center; border-color:#000">3</td>
							</tr>
							{$data}
						</tbody>
					</table>
TABLE;
 }else{
 	$table = "<span style='font-size:10.0pt;'><b>There are no programme objectives in this programme.</b></span>";
 }
 					echo $table;

					$data = '';
					$i=1;
					while ($value = $db->fetchByAssoc($feedbackSessions)) {
						$data .= '<tr>';
						$data .= '<td style="border-color:#000;text-align: center;">'.$i.'</td>';
						$faculty_name = str_replace('^', '', $value['faculty_name']);
						$fname_a = explode(',', $faculty_name);
						$faculty_name = '';
						foreach ($fname_a as $key => $value2) {
							$faculty_name .= ','.$app_list_strings['faculty_name_list'][$value2];
						}

						$data .= '<td style="border-color:#000;text-align: left;padding-left: 10px">'.($value['session_name'].'-'.ltrim($faculty_name, ',')).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['unsatisfactory']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['satisfactory']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['good']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['very_good']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['excellent']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.number_format((float)(($value['unsatisfactory']+($value['satisfactory']*2)+($value['good']*3)+($value['very_good']*4)+($value['excellent']*5))/(($value['unsatisfactory']+$value['satisfactory']+$value['good']+$value['very_good']+$value['excellent']))), 2, '.', '').'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['High']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['Med']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['Low']).'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.($value['vlow']).'</td>';
						$data .= '</tr>';
						$i++;
					}
					$table =<<<TABLE
						<table cellspacing="0" border="1" style="border: 1px solid #000;" width="100%">
							<thead>
								<tr>
									<td style="text-align: center;border-color:#000;" rowspan='2'>Sl. No</td>
									<td style="text-align: center;border-color:#000;" rowspan='2'>Session Title & Speaker</td>
									<td style="text-align: center;border-color:#000;" colspan='5'>Rating</td>
									<td style="text-align: center;border-color:#000;" rowspan='2'>Weighted. Avg Rating</td>
									<td style="text-align: center;border-color:#000;" colspan='4'>Relevance</td>
								</tr>
								<tr>
									<td style="text-align: center;border-color:#000;">Unsatisfactory<div>1</div></td>
									<td style="text-align: center;border-color:#000;">Satisfactory<div>2</div></td>
									<td style="text-align: center;border-color:#000;">Good<div>3</div></td>
									<td style="text-align: center;border-color:#000;">Very Good<div>4</div></td>
									<td style="text-align: center;border-color:#000;">Excellent<div>5</div></td>
									<td style="text-align: center;border-color:#000;">High</td>
									<td style="text-align: center;border-color:#000;">Med</td>
									<td style="text-align: center;border-color:#000;">Low</td>
									<td style="text-align: center;border-color:#000;">Very Low</td>
								</tr>
							</thead>


							<tbody>
								$data
							</tbody>
						</table>
TABLE;
 ?>
 		<br><br>
 		<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>II. Please indicate how effectively the following sessions have been conducted in the Programme.</b></span>
		</div>
			<br>
			<?php
				if ($feedbackSessions && $feedbackSessions->num_rows > 0) {
					echo $table;
				}else{
					echo '<span style="font-size:10.0pt;"><b>There are no sessions in this programme!</b></span>';
				}
			?>
	 		<br><br>
	 		<!-- Modified: Somesh Bawane
	 		Dt. : 29/01/2019
	 		Reason: Mid point feedback started -->
	 		<?php if($show == 'show') { ?>
	 		<div style="text-align: left;" align="left">
		 		<span style="text-align: left;"><b>III. Are there any  topics that you would like included in the Programme?</b></span>
			</div>
			<br>
			<div style="text-align: left;" align="left">
				<ul>
					<li>
						<?php
								$a = str_replace(',,', ',', $feedback['topics_include_c']);
								$a = str_replace('::', ':', rtrim($a, ':'));
								// ob_clean();
								// print_r($a);
								// exit();
								echo implode('</li><li>',explode(':', $a));
						?>
					</li>
				</ul>
			</div>
			<br><br>
			<div style="text-align: left;" align="left">
		 		<span style="text-align: left;"><b>IV. Are there any topics that you feel were not relevant to the theme of the Programme?</b></span>
			</div>

			<br>
			<div style="text-align: left;" align="left">
				<ul>
					<li>
						<?php
								$a = str_replace(',,', ',', $feedback['topics_not_relevant_c']);
								$a = str_replace('::', ':', $a);
								echo implode('</li><li>',explode(':', rtrim($a, ':')));
						?>
					</li>
				</ul>
			</div>
			<br><br>
	 		<div style="text-align: left;" align="left">
		 		<span style="text-align: left;"><b>V. Your overall rating of the Programme</b></span>
			</div>
				<br>
				<div style="text-align: center;" align="center">
				<?php
					$data = '';

					$data .= '<tr>';
					$data .= '<td style="border: 1px solid #000;text-align: center; width: 30px" width="30px">'.$feedback['o1'].'</td>';
					$data .= '<td style="border: 1px solid #000;text-align: center; width: 30px" width="30px">'.$feedback['o2'].'</td>';
					$data .= '<td style="border: 1px solid #000;text-align: center; width: 30px" width="30px">'.$feedback['o3'].'</td>';
					$data .= '<td style="border: 1px solid #000;text-align: center; width: 30px" width="30px">'.$feedback['o4'].'</td>';
					$data .= '<td style="border: 1px solid #000;text-align: center; width: 30px" width="30px">'.$feedback['o5'].'</td>';

					$data .= '<td style="border: 1px solid #000;text-align: center; width: 70px" width="70px" >'.number_format((float)(($feedback['o1']+($feedback['o2']*2)+($feedback['o3']*3)+($feedback['o4']*4)+($feedback['o5']*5))/(($feedback['o1']+$feedback['o2']+$feedback['o3']+$feedback['o4']+$feedback['o5']))), 2, '.', '').'</td>';
					$data .= '</tr>';
					$i++;

					$table =<<<TABLE
						<table border="1" style="border: 1px solid #000" cellspacing="0" width="40%">
							<thead>
								<tr>
									<td style="border-color: #000;text-align: center; width: 30px" width="30px">1</td>
									<td style="border-color: #000;text-align: center; width: 30px" width="30px">2</td>
									<td style="border-color: #000;text-align: center; width: 30px" width="30px">3</td>
									<td style="border-color: #000;text-align: center; width: 30px" width="30px">4</td>
									<td style="border-color: #000;text-align: center; width: 30px" width="30px">5</td>
									<td style="border-color: #000;text-align: center; width: 70px" width="70px" >Weighted. Avg Rating</td>
								</tr>
							</thead>

							<tbody>
								$data
							</tbody>
						</table>
TABLE;
				echo $table;
				?>
				</div>
			<br><br>
			<div style="text-align: left;" align="left">
	 			<span style="text-align: left;"><b>VI. what were the major learning outcomes of the Programme for you?</b></span>
	 		</div>
				<br>
				<ul style="text-align: left;">

					<li>
						<?php
							
							$a = str_replace('::', ':', rtrim($feedback['learning_outcomes_c'], ':'));
							echo implode('</li><li>',explode(':', $a));
						?>
					</li>

				</ul>
			<br><br>
			<div style="text-align: left;" align="left">
	 			<span style="text-align: left;"><b>VII. What other training programmes would you like to attend in the next 2 years?</b></span>
			</div>
				<br>
				<ul style="text-align: left">
					<li style="text-align: left; margin: 1em 0">
						<b>ASCI programmes</b>
						<br><br>
						<?php echo ltrim(str_replace(',,', ',', $feedback['attend_asci_programmes_c']), ','); ?>
					</li>
					<li style="text-align: left; margin: 1em 0">
						<b>Other programmes that you would like ASCI to Offer:</b>
						<br><br>
						<?php echo ltrim(str_replace(',,', ',', $feedback['offer_other_programms_c']), ','); ?>
					</li>
				</ul>
				<?php } ?> <!-- MidPoint feedback ends -->
		</div>
	</div>
</div>
</body>
</html>
<?php exit; ?>
