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
			<img src="<?php echo $sugar_config['site_url'] ?>custom/modules/Project/asci_small_logo.jpg" style="width: 5%">
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA :: HYDERABAD - 500 082</h4>
			
			<h4>Programme Title: <?php echo $feedback['name'] ?>
			<br />
			<span style="text-align: center;">
			(
    						<?php
			   					echo date_format(date_create($feedback['start_date_c']),"M d").' to '.date_format(date_create($feedback['end_date_c']),"M d, Y"); 
			   				?>		
			   				)
			
			</span>
			</h4>	
			<br><br>
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
						$data .= '<td style="text-align: center;border-color:#000;">'.$i.'</td>';
						$data .= '<td style="border-color:#000;text-align: left;padding-left: 10px">'.$value['name'].'</td>';
						$data .= '<td style="text-align: center;border-color:#000;">'.$value['rating_c'].'</td>';
						$data .= '</tr>';
						$i++;
					}			
					$table =<<<TABLE
					<table cellspacing="0" border="1" style="border: 1px solid #000;" width="100%">
						<tbody border="1" style="border: 1px solid #000;">
							<tr>
								<td style="text-align: center;border-color:#000;"">Sl. No</td>
								<td style="text-align: center;border-color:#000;"">Programme Objectives</td>
								<td style="text-align: center;border-color:#000;"">Rating</td>
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
						$data .= '<td style="border-color:#000;text-align: center;">'.($value['delivery_rating_c']).'</td>';
						$data .= '<td style="border-color:#000;text-align: center;">'.($value['relevance_c']).'</td>';
						$data .= '</tr>';
						$i++;
					}			
					$table =<<<TABLE
						<table cellspacing="0" border="1" style="border: 1px solid #000;" width="100%">
							<thead>
								<tr>
									<td style="border-color:#000;text-align: center;">Sl. No</td>
									<td style="border-color:#000;text-align: center;">Session Title & Speaker</td>
									<td style="border-color:#000;text-align: center;">Rating</td>
									<td style="border-color:#000;text-align: center;">Relevance</td>
								</tr>
							</thead>


							<tbody>
								$data
							</tbody>
						</table>	
TABLE;
 ?>
 		<br><br>
 		<!-- Modified: Somesh Bawane
 		Dt. : 29/01/2019
 		Reason: Mid point feedback started -->
 		<?php if($show == 'show') { ?>
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
	 	<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>III. "Are there any  topics that you would like included in the Programme?"</b></span>
	 	
				<br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $feedback['topics_include_c']; ?>
				 

		</div>
			<br><br>
		<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>IV. Are there any topics that you feel were not relevant to the theme of the Programme?</b></span>
	 	
				<br>
				<?php 
					$a = '<ul>';
					$exploded = preg_split('/[0-9]+./', $feedback['topics_not_relevant_c']); 
					foreach($exploded as $index => $answer){ 
					    if (!empty($answer)){ 
					        $a .= '<li>'.$answer.'</li>';
					    } 
					} 

					echo $a.'</ul>'; 

				?>

		</div>
			<br><br>
		<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>V. Your overall rating of the Programme</b></span>
						
				<br><br>
				<div style="padding-left: 10px">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php 

					echo $feedback['o1'];
					?>				 
				</div>
		</div>
			<br><br>
		<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>VI. What were the major learning outcomes of the Programme for you?</b></span>
		
				<br>
		
					<?php 
							$a = '<ul style="text-align: left">';
							$exploded = preg_split('/[0-9]+./', $feedback['learning_outcomes_c']); 
							foreach($exploded as $index => $answer){ 
							    if (!empty($answer)){ 
							        $a .= '<li>'.$answer.'</li>';
							    } 
							} 

							echo $a.'</ul>';					 
					?>
			
		</div>
			<br><br>
		<div style="text-align: left;" align="left">
	 		<span style="text-align: left;"><b>VII. What other training programmes would you like to attend in the next 2 years?</b></span>
	 	</div>
				<br>
				<ul style="text-align: left">
					<li style="margin: 1em 0;">
						<b>ASCI programmes</b>
						<br><br>
						<?php echo $feedback['attend_asci_programmes_c']; ?>
					</li>
					<li style="margin: 1em 0;">
						<b>Other programmes that you would like ASCI to Offer:</b>
						<br><br>
						<?php echo $feedback['offer_other_programms_c']; ?>
					</li>					
				</ul>
			<?php } ?> <!-- MidPoint feedback ends -->
		</div>
	</div>
</div>
</body>
</html>
<?php exit; ?>
