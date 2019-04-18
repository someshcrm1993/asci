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
global $db;
global $sugar_config;
$full_name = $_GET['full_name'];
$user_id = $_GET['user_id'];
$user_details = "SELECT first_name, last_name,phone_mobile from users where id='$user_id'";
$result_user_details = $db->query($user_details);
$row_user_details = $db->fetchByAssoc($result_user_details);
$first_name = $row_user_details['first_name'];
$last_name = $row_user_details['last_name'];
$mobile_number = $row_user_details['phone_mobile'];
if($mobile_number)
{
	$mobile = "Mobile Number :$mobile_number";
}
$user_info ="SELECT E_table.email_address FROM email_addresses E_table JOIN email_addr_bean_rel EB_table ON EB_table.email_address_id=E_table.id WHERE EB_table.bean_id='".$user_id."' AND EB_table.bean_module='Users'";
$result_info = $db->query($user_info);
$row_info = $db->fetchByAssoc($result_info);
$email_id  = $row_info['email_address'];
$site_url = $sugar_config['site_url'];
require_once('include/SugarPHPMailer.php');
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$email = 'downloads@simplecrm.com.sg';
		$mail->From = $defaults['email'];
		//$mail->From .= 'Content-type: text/html\r\n';
		$mail->FromName = $defaults['name'];
		$subject = 'Request to send the source code';
		$mail->Subject = $subject;
		$mail->IsHTML(true);
		$body = <<<EOD
		<p style = "margin-bottom: 0in;">Hi Team, </p>
<p style = "margin-bottom: 0in;">We got a request for source code. </span></p>
<p style = "margin-bottom: 0in;">Details are as follows: </span></p>
<p style = "margin-bottom: 0in;">Instance: $site_url</span></p>
<p style = "margin-bottom: 0in;">First Name: $first_name</span></p>
<p style = "margin-bottom: 0in;">Last Name: $last_name</span></p>
<p style = "margin-bottom: 0in;">$mobile</span></p>
<p style = "margin-bottom: 0in;">User Email Id: $email_id</a></p>
<p style = "margin-bottom: 0in;">Kindly do the needful.</a></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;">Regards,</span></p>
<p style = "margin-bottom: 0in;">Team SimpleCRM</span></p>
		
EOD;
$mail->Body = $body;
		$mail->prepForOutbound();
		$mail->AddAddress($email);
		//$mail->AddBCC('gagandeep.singh@techliveconnect.com');
		//@$mail->Send();
		//$GLOBALS['log']->fatal('Email:'.$email);
		if (!$mail->Send()){
			$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
                }
                

?>
