<?php 

/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

class logic_hook_class
{
  static $already_ran = false;
  static $already_ran_after_save = false;
  static $already_ran_before_save = false;

	public function after_delete($bean)
	{
    if(self::$already_ran == true) return;
    self::$already_ran = true;
		
    global $db;
		//delete timetable
		$bean->load_relationship('project_scrm_timetable_1');
		
       	$ids = $bean->project_scrm_timetable_1->get();
       	$ids = '"'.implode('","', $ids).'"';
       	
       	if (count($ids)>0) {
       		$bean->project_scrm_timetable_1->delete($bean->id); //this will delete from relationship table
       		$db->query("UPDATE scrm_timetable SET deleted='1' WHERE id IN ({$ids})"); //this will delete from timetable table
       	}

       	//delete budget
       	$bean->load_relationship('project_scrm_budget_1');
		
       	$ids = $bean->project_scrm_budget_1->get();
       	$ids = '"'.implode('","', $ids).'"';
       	
       	if (count($ids)>0) {
       		$bean->project_scrm_budget_1->delete($bean->id);	//this will delete from relationship table
       		$db->query("UPDATE scrm_budget SET deleted='1' WHERE id IN ({$ids})");	//this will delete from timetable table
       	}

       	//delete budget
       	$bean->load_relationship('scrm_admin_arranges_project_1');
		
       	$ids = $bean->scrm_admin_arranges_project_1->get();
       	$ids = '"'.implode('","', $ids).'"';
       	
       	if (count($ids)>0) {
       		$bean->scrm_admin_arranges_project_1->delete($bean->id);	//this will delete from relationship table
       		$db->query("UPDATE scrm_admin_arranges SET deleted='1' WHERE id IN ({$ids})");	//this will delete from timetable table
       	}

       	//delete travel
       	$bean->load_relationship('project_scrm_travel_details_1');
		
       	$ids = $bean->project_scrm_travel_details_1->get();
       	$ids = '"'.implode('","', $ids).'"';
       	
       	if (count($ids)>0) {
       		$bean->project_scrm_travel_details_1->delete($bean->id);	//this will delete from relationship table
       		$db->query("UPDATE scrm_travel_details SET deleted='1' WHERE id IN ({$ids})");	//this will delete from timetable table
       	}       	       	

	}

       public function after_save_method($bean)
       {

              if(self::$already_ran_after_save == true) return;
              self::$already_ran_after_save = true;
              
              if($_REQUEST['module'] != 'Import'){  
              
                global $db, $sugar_config;

                // If Proramme status changed from Proposed to offered
                if ($bean->fetched_row['status'] == 'Proposal Stage' && $bean->status == 'Offered') {
                     require_once('modules/EmailTemplates/EmailTemplate.php');
                     //send email to dotp
                     $dotp = BeanFactory::getBean('Users','e6c3eb5b-0918-80d5-d66e-5943b2b84660');
                     $template = new EmailTemplate();
                     $template->retrieve_by_string_fields(array('id' => '2f92031b-3ad1-ffe4-6809-59d49be6434a','type'=>'email'));
                     $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                     $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
              
                     // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$dotp->email1,$file);                     
                     if ($sugar_config['appInTesting']) {
                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);  
                     }else{
                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$dotp->email1);
                     }
                         

                }
              }
       }

       public function before_save($bean)
       {
              if(self::$already_ran_before_save == true) return;
              self::$already_ran_before_save = true;
              
              if($_REQUEST['module'] != 'Import'){  

                if (empty($bean->fetched_row)) {
                     require_once('modules/EmailTemplates/EmailTemplate.php');
                     
                     //send email to ppd
                     $ppd = BeanFactory::getBean('Users',$bean->assigned_user_id);
                     $template = new EmailTemplate();
                     $template->retrieve_by_string_fields(array('id' => '7f1bac91-3849-3b39-7f42-59c60c57ded0','type'=>'email'));
                     $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                     $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                     global $sugar_config;
                     $template->body_html = str_replace('programme_url', $sugar_config['site_url'].'/index.php?module=Project&action=DetailView&record='.$bean->id, $template->body_html);
                     
                     if ($sugar_config['appInTesting']) {

                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);  
                     }else{
                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$ppd->email1);
                     }              
                     
                
                     // //send email to spd
                     // $spd = BeanFactory::getBean('Users',$bean->spd_c);
                     // $template = new EmailTemplate();
                     // $template->retrieve_by_string_fields(array('id' => '7f1bac91-3849-3b39-7f42-59c60c57ded0','type'=>'email'));
                     // $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                     // $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
              
                     // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$spd->email1);

                     // //send email to dotp
                     // $dotp = BeanFactory::getBean('Users','e6c3eb5b-0918-80d5-d66e-5943b2b84660');
                     // $template = new EmailTemplate();
                     // $template->retrieve_by_string_fields(array('id' => '7f1bac91-3849-3b39-7f42-59c60c57ded0','type'=>'email'));
                     // $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
                     // $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
              
                     // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$dotp->email1);
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