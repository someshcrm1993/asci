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


class OpportunitiesUpdateFields{

    static $already_ran = false;
    
    function updateFields($bean, $event, $arguments){
        
        if(self::$already_ran == true) return;
        self::$already_ran = true;

        if ($bean->asci_proposal_status_c == "MTDFF" && $bean->asci_proposal_status_c != $bean->fetched_row['asci_proposal_status_c']) {
        // if ($bean->asci_proposal_status_c != $bean->fetched_row['asci_proposal_status_c'] && $bean->asci_proposal_status_c == "MTDFF" ) {
            $this->createEmail($bean);
        }

        global $db;

        //send email to DOTP
        $query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = '80b8a01f-f107-56d9-b52d-592d69e8e822'");

        require_once('modules/EmailTemplates/EmailTemplate.php');
        $template = new EmailTemplate();
        
        if (empty($bean->fetched_row)) {
             $template->retrieve_by_string_fields(array('id' => '35d2e11e-6229-f4fd-59c4-59c8a8b6054a','type'=>'email'));
        }else{
             $template->retrieve_by_string_fields(array('id' => 'b7edfbb8-787b-e16c-5d8b-59c8a80d443e','type'=>'email'));
        }

        $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);    
        // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1,$file);
        // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,'ganesh@simplecrm.com.sg');

        // while ($result = $db->fetchByAssoc($query)) {
        //     if ($result) {
        //         $user = BeanFactory::getBean('Users',$result['user_id']);
        //         $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);    
        //         // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1,$file);
        //         $this->sendEmailWithoutAttachment($template->subject,$template->body_html,'ganesh@simplecrm.com.sg');
        //     }   
        // }            

    }

    public function createEmail($bean='')
    {
        global $sugar_config;
        require_once('modules/EmailTemplates/EmailTemplate.php');

        $template = new EmailTemplate();
        $template->retrieve_by_string_fields(array('id' => 'd48f7147-69dd-622c-2a13-594515bfe9f3','type'=>'email'));
        
        //send email to dotp e6c3eb5b-0918-80d5-d66e-5943b2b84660
        $userBean = BeanFactory::getBean('Users','e6c3eb5b-0918-80d5-d66e-5943b2b84660');

        //Parse Body HTMLcc
        $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
        
        if ($sugar_config['appInTesting']) {
            $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);
        }else{
            $this->sendEmail($template->subject,$template->body_html,$userBean->email1);
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
    
    public function sendEmail($subject,$body,$email)
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


