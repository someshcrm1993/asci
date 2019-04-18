<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
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
global $db;
$id = null;
//Handle Cases Feedback
if(isset($_REQUEST['id'])){
	$id            = $_REQUEST['id'];
	$customer_id   = $_REQUEST['ci'];
	$customer_name = $_REQUEST['cn'];
	//Get Case details
$query = "Select id, created_by, assigned_user_id, case_number from cases where (case_number = '$id' or id = '$id' ) and deleted = 0";
	$result = $db->query($query);
	$ans = $db->fetchbyassoc($result);
	//Get Technician Name
	$technician_name = $ans['created_by'];
	//Get Case Number
	$case_number = $ans['case_number'];
	$id = $ans['id'];
        $assigned_user_id =  $ans['assigned_user_id'];
	//Get Technician Details
	$query = "Select user_name, first_name, last_name from users where id = '$technician_name' and deleted = 0";
	$result = $db->query($query);
	$ans = $db->fetchbyassoc($result);
	//Set Technician Name
	$technician_name = $ans['first_name'].' '.$ans['last_name'];
	//Set Contact Details
	$customer_name = $customer_name;	
}
?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/ico">
		<title>Customer Satisfaction Survey</title>
	</head>
	<body>
		
		<img src="custom/include/images/simple_logo.png"  >
		<hr />
		<H3>Customer Satisfaction Survey</H3>
<?php
if($id){
?>
		<form action="Submit_Survey.php" method="post">
		<table>
			<tr>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						<?php if(isset($_REQUEST['id'])){ echo "Case"; }else{ echo "Order";} ?> ID
					</font>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						<?php echo $case_number;
						if(isset($_REQUEST['id'])){
						?>						
						<input type="hidden" name="case_id" value="<?php echo $id; ?>" />
						<input type="hidden" name="assigned_user_id" value="<?php echo $assigned_user_id; ?>" />
						<?php
						}else{
						?>
						<input type="hidden" name="pb_id" value="<?php echo $id; ?>" />
						<?php
						}
						?>
					</font>
				</td>
			</tr>	
			<tr>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						Technician name
					</font>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						<?php echo $technician_name?>
					</font>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						Date/time
					</font>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						<?php echo $dt = date("Y/m/d H:i:s"); ?>
						<input type="hidden" name="date_modified" value="<?php echo $dt; ?>" />
					</font>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						Customer name
					</font>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<font size="4" face="verdana">
						<?php echo $customer_name; ?>
					</font>
				</td>
			</tr>				
		</table>	
		<hr />
		<table>
			<tr>
				<td align="left" valign="top" colspan="4">
					<H3>Question<H3>
					<hr />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								Was your issue resolved the first time you reported it?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<input type="radio" name="resolution_time" id="resolution_timey" value="Yes" checked /> <label for="resolution_timey"> Yes </label>
				</td>
				<td align="left" valign="top">
					<input type="radio" name="resolution_time" id="resolution_timen" value="No" /><label for="resolution_timen"> No </label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								Was the engineer able to clearly articulate the troubleshooting steps on the call?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<input type="radio" name="explaination_time" id="explaination_timey" value="Yes" checked /> <label for="explaination_timey"> Yes </label>
				</td>
				<td align="left" valign="top">
					<input type="radio" name="explaination_time" id="explaination_timen" value="No" /><label for="explaination_timen"> No </label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								Were you able to understand the tech support engineer clearly?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<input type="radio" name="resolution_result" id="resolution_resulty" value="Yes" checked /> <label for="resolution_resulty"> Yes </label>
				</td>
				<td align="left" valign="top">
					<input type="radio" name="resolution_result" id="resolution_resultn" value="No" /><label for="resolution_resultn"> No </label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								Will you recommend our service to your contacts?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:

				</td>
				<td align="left" valign="top">
					<input type="radio" name="recommendation_time" id="recommendation_timey" value="Yes" checked /> <label for="recommendation_timey"> Yes </label>
				</td>
				<td align="left" valign="top">
					<input type="radio" name="recommendation_time" id="recommendation_timen" value="No" /><label for="recommendation_timen"> No </label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								How likely is it that you would recommend our company to friends or colleagues?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top" colspan="2">
					<select id='recommendation_friend_likely_c' name='recommendation_friend_likely_c'>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								How would you rate your overall satisfaction with SimpleCRM Support?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top" colspan="2">
					<select id='service_rating' name='service_rating'>
						<option value="Excellent">Excellent</option>
						<option value="Very Good">Very Good</option>
						<option value="Good">Good</option>
						<option value="Average">Average</option>
						<option value="Poor">Poor</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" colspan="4">
					<ul>
						<li>
							<font size="4" face="verdana">
								Remarks/Comments:<br />
								<textarea id="description" name="description" rows="4" cols="100"></textarea>
							</font>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<ul>
						<li>
							<font size="4" face="verdana">
								Will you allow us to use these remarks as testimonial on our website and in print?
							</font>
						</li>
					</ul>
				</td>
				<td align="left" valign="top">
					:
				</td>
				<td align="left" valign="top">
					<input type="radio" name="on_website" id="group5y" value="Yes" checked><label for="group5y" /> Yes </label>
				</td>
				<td align="left" valign="top">
					<input type="radio" name="on_website" id="group5n" value="No"><label for="group5n" /> No </label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" colspan="4">
					<hr />
				</td>
		</table>
		<br /><br /><br />			
		<input type="hidden" name="id" value="<?php echo $id ?>" />
		<Center>
			<input type="submit" name="submit" style="font-size:100%" value="Submit your Survey" onclick='javascript:this.style.visiblity="hidden";this.style.display="none";' /></td></td>
			<!-- input type="button" style="font-size:100%" value="Cancel" / -->
		</Center>
		</form>
		<br /><br />
<?php
}elseif(isset($_REQUEST['feedback_saved'])){
	echo "<font size='4' face='verdana'>";
        echo "<p>Thank you for your feedback.</p><p>Team SimpleCRM Support</p>";
	echo "</font>";	
}else{
	echo "<font size='4' face='verdana'>";
        echo "<p>An error occured, please contact SimpleCRM Support Administrator.</p><p>Team SimpleCRM Support</p>";
	echo "</font>";	
}
?>
		<hr />
		<center>
			<font size="4" face="verdana">For any kind of Support in Future, Please Call: <span style="color:#2B60DE;">+91 85 5392 1122</span></font>
		</center>
		
		<hr /><br /><br />
	</body>
</html>
