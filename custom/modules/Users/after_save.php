<?php 

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

class after_save_class
{
	
	public function after_save_method($bean)
	{
		if ($bean->employee_status == "Leave of Absence" && $bean->fetched_row['employee_status'] != $bean->employee_status) {

			//send email to DOTP 80b8a01f-f107-56d9-b52d-592d69e8e822
			$query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = '80b8a01f-f107-56d9-b52d-592d69e8e822'");

			require_once('modules/EmailTemplates/EmailTemplate.php');
			$template = new EmailTemplate();
	    	$template->retrieve_by_string_fields(array('id' => '2fbdb327-be77-1463-99bf-59c8a82a7397','type'=>'email'));
			while ($result = $db->fetchByAssoc($query)) {
				if ($result) {
					$user = BeanFactory::getBean('Users',$result['user_id']);
		            $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);			
					$this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1,$file);
				}	
			}			
		}
	}

    public function sendEmailWithoutAttachment($subject,$body,$email,$file)
    {
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');
        $emailObj = new Email(); 

        $defaults = $emailObj->getSystemDefaultEmail(); 
        
        $mail = new SugarPHPMailer(); 

        $mail->setMailerForSystem(); 
        $mail->From = $defaults['email']; 
        $mail->FromName = $defaults['name']; 
        
        $mail->Subject = $subject; 
        $mail->Body = $body; 
        $mail->prepForOutbound(); 
        $mail->AddAddress($email);
        $mail->isHTML(true); 
        // print_r($mail);exit();
        @$mail->Send(); 
    }	
}

?>