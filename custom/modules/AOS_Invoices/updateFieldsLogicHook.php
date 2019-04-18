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

/**
* 
*/
class updateFields
{
	
	public function sendEmailToFO($bean)
	{
        global $current_user;

		$role = ACLRole::getUserRoleNames($current_user->id);
		if (count($role)>0 && isset($role[0])) {
		    $role = $role[0];
		}else{
			//role is admin
		    $role = 'admin';
		}

		if ($role == 'PO(M1,M2,M3)') {
			if ($bean->approval_po_c == 1 && $bean->fetched_row['approval_po_c'] != 1) {
				$this->sendEmail($bean);
			}					
		}		
	}

	public function sendEmail($invoiceBean)
	{
		//email template
		require_once('modules/EmailTemplates/EmailTemplate.php');

		$template = new EmailTemplate();
		//FO id 6c318d02-f7eb-2ffc-0f0c-5943b3347c07
		$template->retrieve_by_string_fields(array('id' => '3bfa018a-e2e5-5c75-0d4c-595619aaebe5','type'=>'email'));

		$userBean = BeanFactory::getBean('Users','6c318d02-f7eb-2ffc-0f0c-5943b3347c07');

		$template->body_html = $template->parse_template_bean($template->body_html,$userBean->module_dir,$userBean);
		$template->body_html = $template->parse_template_bean($template->body_html,$invoiceBean->module_dir,$invoiceBean);

		require_once('modules/Emails/Email.php');
		require_once('include/SugarPHPMailer.php');
		$emailObj = new Email(); 

		$defaults = $emailObj->getSystemDefaultEmail(); 

		$mail = new SugarPHPMailer(); 

		$mail->setMailerForSystem(); 
		$mail->From = $defaults['email']; 
		$mail->FromName = $defaults['name']; 

		$mail->Subject = $template->subject; 
		$mail->Body = $template->body_html; 
		$mail->prepForOutbound(); 
		$mail->AddAddress($userBean->email1);
		$mail->isHTML(true); 
		
		@$mail->Send();

	}
}

?>
