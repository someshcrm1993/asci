<?php
//ini_set('display_errors','On');
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

   
class DiscountApproval
{
		function discount_approval($bean,$event,$arguments)
		{
			global $db, $current_user; 
			$billing_account_id = $bean->billing_account_id;
			$query_account_details = "SELECT name from accounts where id ='$billing_account_id' and deleted=0";
			$result_account_details = $db->query($query_account_details);
			$row_account_details = $db->fetchByAssoc($result_account_details);
			$account_name = $row_account_details['name'];
			$name = $bean->name;
			$quote_id = $bean->id;
			$quote_number = $bean->number;
			$total_amount= $bean->total_amt;
			$assigned_user_id = $bean->assigned_user_id;
			$discount_amount = -($bean->discount_amount); 
            $module ='AOS_Quotes';
			require_once("modules/ACLRoles/ACLRole.php");
			$acl_role_obj = new ACLRole(); 
			$user_roles = $acl_role_obj->getUserRoles($assigned_user_id);
			$current_user_role = $user_roles[0];
			$discount = ($discount_amount/$total_amount)*100;
			$fetch_reports_to_query = "select reports_to_id from users where id ='$assigned_user_id' and deleted='0'";
							$fetch_reports_to_result=$db->query($fetch_reports_to_query);
							$fetch_reports_to_row = $db->fetchByAssoc($fetch_reports_to_result);
							$reports_to_supervisor = $fetch_reports_to_row['reports_to_id'];
							
			$current_user_id = $current_user->id;				
			$query_from = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$current_user_id' and eabr.deleted='0' and eabr.bean_module='Users'";
					$query_from_result = $db->query($query_from);
					$select_from_result = $db->fetchByAssoc($query_from_result);
				
					$assigned_user_email = $select_from_result['email'];
			$query_discount_approval = "SELECT approval_levels_c from scrm_discount_approval_matrix_cstm JOIN scrm_discount_approval_matrix ON id_c=id where role1_c='$current_user_role' OR role2_c='$current_user_role' OR role3_c='$current_user_role' and deleted=0";
			$result = $db->query($query_discount_approval);
			$row = $db->fetchByAssoc($result);
			$approval_level = $row['approval_levels_c'];
			$Approved = explode('^',$approval_level);
			//~ echo "<br>";
			//~ echo $current_user->id;
			//~ echo "<br>";
			//~ echo $reports_to_supervisor;echo "<br>";
			//~ print_r($Approved);
			//~ if(in_array('Level1', $Approved))
			//~ {
				//~ echo "Hai";
			//~ }
			//~ exit;
			require_once('include/SugarPHPMailer.php');
						$emailObj = new Email();
						$defaults = $emailObj->getSystemDefaultEmail();
						$mail = new SugarPHPMailer();
						$mail->setMailerForSystem();
						$mail->From = $defaults['email'];
						$mail->From .= 'Content-type: text/html\r\n';
						$mail->FromName = $defaults['name'];
						
			if($current_user_id != $reports_to_supervisor)
			{
				if(in_array('Level1', $Approved))
				{
					$query_discount_approval ="SELECT discount1_c from scrm_discount_approval_matrix_cstm JOIN scrm_discount_approval_matrix ON id_c=id where approval_levels_c='$approval_level'";
					$result_discount_approval = $db->query($query_discount_approval);
					$row_approval = $db->fetchByAssoc($result_discount_approval);
					$discount1_c = $row_approval['discount1_c'];
					if($discount < $discount1_c)
					{
						$update_quote = "UPDATE aos_quotes SET approval_status='Approved' where id='$quote_id'";
						$result_quote = $db->query($update_quote);
						
						
						$subject = 'Quote Approved';
						$mail->Subject = $subject;
						$mail->IsHTML(true);
						$body = <<<Email
					<p>Hello,</p>
					<p>I have checked the following quote. We can send this to customer.</p>
					<br>
					<p>Account: $account_name</p>
					<p>Subject: $name</p>
					<p>Quote Number: $quote_number</p>
					<br>
					<br> 
					<p>Thanks,</p>
					<p>SimpleCRM</p>
Email;
						$mail->Body = $body;
						$mail->prepForOutbound();
						$mail->AddAddress($assigned_user_email);
						if (!$mail->Send()){
							$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
						}
					}
						else if($discount > $discount1_c)
						{
							
						$query_reports_to = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$reports_to_supervisor' and eabr.deleted='0' and eabr.bean_module='Users'";
						$query_reports_to_result = $db->query($query_reports_to);
						$select_from_result = $db->fetchByAssoc($query_reports_to_result);
				
						$reports_to_email = $select_from_result['email'];
						$update_quote = "UPDATE aos_quotes SET approval_status='Pending_Approval' where id='$quote_id'";
						$result_quote = $db->query($update_quote);
						
						$subject = 'New Quote For Approval';
						$mail->Subject = $subject;
						$mail->IsHTML(true);
						$body = <<<Email
					<p>Hello,</p>
					<p>Please find below quote details for your approval. Kindly review and let me know if any changes are required.</p>
					<br>
					<p>Account: $account_name</p>
					<p>Subject: $name</p>
					<p>Quote Number: $quote_number</p>
					<br>
					<br> 
					<p>Thanks,</p>
					<p>SimpleCRM</p>
					<br>
					<p>You may review this Quote at:</p>
					http://customerdemo1.simplecrmdemo.com/index.php?action=DetailView&module=AOS_Quotes&record=$quote_id
Email;
						$mail->Body = $body;
						$mail->prepForOutbound();
						$mail->AddAddress($reports_to_email);
						if (!$mail->Send()){
							$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
						}
						
						
						}
			}
			else
			{
					$query_reports_to = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$reports_to_supervisor' and eabr.deleted='0' and eabr.bean_module='Users'";
						$query_reports_to_result = $db->query($query_reports_to);
						$select_from_result = $db->fetchByAssoc($query_reports_to_result);
				
						$reports_to_email = $select_from_result['email'];
						$update_quote = "UPDATE aos_quotes SET approval_status='Pending_Approval' where id='$quote_id'";
						$result_quote = $db->query($update_quote);
						
						$subject = 'New Quote For Approval';
						$mail->Subject = $subject;
						$mail->IsHTML(true);
						$body = <<<Email
					<p>Hello,</p>
					<p>Please find below quote details for your approval. Kindly review and let me know if any changes are required.</p>
					<br>
					<p>Account: $account_name</p>
					<p>Subject: $name</p>
					<p>Quote Number: $quote_number</p>
					<br>
					<br> 
					<p>Thanks,</p>
					<p>SimpleCRM</p>
					<br>
					<p>You may review this Quote at:</p>
					http://customerdemo1.simplecrmdemo.com/index.php?action=DetailView&module=AOS_Quotes&record=$quote_id
Email;
						$mail->Body = $body;
						$mail->prepForOutbound();
						$mail->AddAddress($reports_to_email);
						if (!$mail->Send()){
							$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
						}
			}
		}
			
		}
}
?>
