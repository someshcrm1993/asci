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
class updateFields
{
	
	public function updateFields($bean)
	{
		// global $app_list_strings;
		global $db, $sugar_config, $app_list_strings;

		//send email to TO
		$query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = '2bb0fac9-18cb-01a1-3792-592d69983c4c'");

		require_once('modules/EmailTemplates/EmailTemplate.php');
		$template = new EmailTemplate();
    	$template->retrieve_by_string_fields(array('id' => '27744d13-034c-69eb-02cd-5a8eaaa06f08','type'=>'email'));

    	$template->body_html = str_replace('crm_url', $sugar_config['site_url'].'index.php?module=scrm_Admin_Arranges&return_module=scrm_Admin_Arranges&action=DetailView&record='.$bean->scrm_admin813crranges_ida, $template->body_html);

    	$template->body_html = str_replace('sight_url', $sugar_config['site_url'].'index.php?module=scrm_Admin_Arranges&return_module=scrm_Admin_Arranges&action=DetailView&record='.$bean->id, $template->body_html);
		
		if ($sugar_config['appInTesting']) {
            $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
            $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);				
			$this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);				
		}
		else{
			while ($result = $db->fetchByAssoc($query)) {
				if ($result) {
					$user = BeanFactory::getBean('Users',$result['user_id']);
		            $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
		            $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);				
					// $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1);
					if ($sugar_config['appInTesting']) {
						$this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
					}else{
						$this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1);
					}
					
				}	
			}				
		}

		$bean->name = $app_list_strings['visit_names_list'][$bean->visit_names_c];
		$bean->save();
	}

    public function sendEmailWithoutAttachment($subject,$body,$email)
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
