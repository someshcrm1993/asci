<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class SendEmail{
    
	function sendEamilFunction($bean, $event, $arguments){


global $db;
global $sugar_config;

$site_url =  $sugar_config['site_url'];
$site_url =  trim($site_url,"/");

$id = $bean->id;
$status = $bean->status;
$GLOBALS['log']->fatal('status : '.$status);
$feeback_email_sent = $bean->feeback_email_sent_c;
$GLOBALS['log']->fatal('feeback_email_sent : '.$feeback_email_sent);
if ($status == 'Closed_Closed' && $feeback_email_sent == 'no'){

//$GLOBALS['log']->fatal('status : '.$status);

		include_once('modules/Accounts/Account.php');
		$obj = new Account();
		//$obj->retrieve($_REQUEST['return_id']);
		$obj->retrieve($bean->account_id);
		require_once('include/SugarPHPMailer.php');
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$mail->From = $defaults['email'];
		$mail->From .= 'Content-type: text/html\r\n';
		$mail->FromName = $defaults['name'];
		$subject = 'Case is closed';
		$mail->Subject = $subject;
		//110.234.25.164
		$mail->IsHTML(true);
		$body = <<<EOF
<p style = "margin-bottom: 0in;"><span style = "font-size: medium; font-family: verdana,geneva;">Dear <strong>$obj->name</strong><br /></span></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;"><span style = "font-size: medium; font-family: verdana,geneva;">We hope your case number&nbsp; #<strong>$bean->case_number</strong> has been resolved to full satisfaction. This case has now been closed. In case you face any further issues, please feel free to contact us at <strong> +91 85 5392 1122 </strong> and we will be happy to resolve it for you. Alternately you can write to us at <span style = "color: #0000ff;"><span lang = "en-US"><span style = "text-decoration: underline;"><a href = "mailto:simplecrm2@gmail.com">simplecrm2@gmail.com</a></span></span></span>.</span></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;"><span style = "font-size: medium; font-family: verdana,geneva;">In our continuous endeavor for service improvement, we request you to spare a few minutes and answer five questions that will help us understand your experience with us better. Please click on the below URL to go to our feedback survey form:</span></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;"><a href = "$site_url/Survey.php?id=$bean->id&cn=$bean->account_name&ci=$bean->account_id"><strong>click here</strong></a></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;"><span style = "font-size: medium; font-family: verdana,geneva;">Regards,</span></p>
<p style = "margin-bottom: 0in;"><span style = "font-size: medium; font-family: verdana,geneva;">Team SimpleCRM Support</span></p>
EOF;
		$mail->Body = $body;
		$mail->prepForOutbound();
		$email = $obj->email1;
		$mail->AddAddress($email);
		//$mail->AddBCC('gagandeep.singh@techliveconnect.com');
		//@$mail->Send();
		$GLOBALS['log']->fatal('Email:'.$email);
		if (!$mail->Send()){
			$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
                }

                //if ($mail->Send()){
			$query2 = "UPDATE cases_cstm SET feeback_email_sent_c = 'yes'  WHERE id_c = '".$id."'"; 
                        $result2 = $db->query($query2);
                //}



}





	}

}
?>
