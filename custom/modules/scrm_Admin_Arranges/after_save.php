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
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
class after_save_class
{
	static $already_ran = false;
	public function after_save_method($bean)
	{
// print_r($bean);exit();
		if(self::$already_ran == true) return;
        self::$already_ran = true;						

		global $sugar_config;
		require_once('modules/EmailTemplates/EmailTemplate.php');

	    $project = $bean->get_linked_beans('scrm_admin_arranges_project_1','Project');
	    // print_r($project);exit();
	    if (count($project)>0) {
           //send email to AIRO
           $template = new EmailTemplate();
           if (empty($bean->fetched_row)) {
               $template->retrieve_by_string_fields(array('id' => 'e6da040e-0d8a-a9f3-ecd4-59cde6b1affe','type'=>'email'));
    	   }else{
    	   	   $template->retrieve_by_string_fields(array('id' => 'bbfca2a9-c64c-1b6a-c905-59ce08e93d23','type'=>'email'));
    	   }
        
         $bean->approval_airo_c = str_replace('^', '', $bean->approval_airo_c);

         $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
         $template->body_html = $template->parse_template_bean($template->body_html,$project[0]->module_dir,$project[0]);
    	   
         $template->body_html = str_replace('crm_url', $sugar_config['site_url'].'index.php?module=scrm_Admin_Arranges&return_module=scrm_Admin_Arranges&action=DetailView&record='.$bean->id, $template->body_html);
         
    	   //check if app is in testing mode 
    	   //if yes then send email on test email address
    	   if($sugar_config['appInTesting']){
               $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);			   	
    	   }else{
    	   	   $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['airo_email']);
    	   }

    	   //send email to PD
    	   if ($bean->approval_airo_c) {
	    	   $template = new EmailTemplate();

	    	   $template->retrieve_by_string_fields(array('id' => '187fe95a-7cc5-4482-7693-59ce0dffa5a1','type'=>'email'));
	    	   $bean->approval_airo_c = str_replace('^', '', $bean->approval_airo_c);
	    	   $bean->approval_airo_c = str_replace(',', ', ', $bean->approval_airo_c);
	           $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
	    	   $template->body_html = str_replace('crm_url', $sugar_config['site_url'].'index.php?module=scrm_Admin_Arranges&return_module=scrm_Admin_Arranges&action=DetailView&record='.$bean->id, $template->body_html);

			   $pd = BeanFactory::getbean('Users',$project[0]->assigned_user_id);
			   $spd = BeanFactory::getbean('Users',$project[0]->spd_c);
			       	   
	    	   //check if app is in testing mode 
	    	   //if yes then send email on test email address
			   if ($pd && $pd->email1) {
		    	   if($sugar_config['appInTesting']){
		               $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);			   	
		    	   }else{
		    	   	   $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$pd->email1);
		    	   }
			   }

			   if ($spd && $spd->email1) {
		    	   if($sugar_config['appInTesting']){
		               $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);			   	
		    	   }else{
		    	   	   $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$spd_c->email1);
		    	   }
			   }
    	   }
	    }	
	
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