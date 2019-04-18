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
	static $already_ran = false;
	
	public function after_save_method($bean)
	{
        if(self::$already_ran == true) return;
      	self::$already_ran = true;

		if (empty($bean->fetched_row)) {
			global $db, $sugar_config;
			//send email to TO
			$query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = '2bb0fac9-18cb-01a1-3792-592d69983c4c'");

			require_once('modules/EmailTemplates/EmailTemplate.php');
			$template = new EmailTemplate();
	    $template->retrieve_by_string_fields(array('id' => '68e4624d-e970-dd64-0a17-59c7865b2926','type'=>'email'));
			
      if (!$sugar_config['appInTesting']) {
        while ($result = $db->fetchByAssoc($query)) {
          if ($result) {
            $user = BeanFactory::getBean('Users',$result['user_id']);
                  $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                  $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);        

            $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1);
          } 
        }
      }else{
            $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
            $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);        

            $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
      }


           if ($bean->project_scrm_travel_details_1project_ida) {
               $projectBean = BeanFactory::getBean('Project',$bean->project_scrm_travel_details_1project_ida);
               if ($sugar_config['appInTesting']) {
                  $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
               }
               else{
                 //send email to ppd
                 $ppd = BeanFactory::getBean('Users',$projectBean->assigned_user_id);

                 if ($ppd) {
                   $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$ppd->email1);
                 }

                 //send email to spd
                 $spd = BeanFactory::getBean('Users',$projectBean->spd_c);
                 if ($spd) {
                   $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$spd->email1);
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