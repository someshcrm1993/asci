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
        if (self::$already_ran == true) return;
        self::$already_ran = true;
        $today = date('Y-m-d');
        global $db, $sugar_config;
        if($_REQUEST['module'] != 'Import'){  
            // if (!empty($bean->fetched_row) && (($bean->nomination_status_c == "Accepted" && $bean->nomination_status_c != $bean->fetched_row['nomination_status_c']) || ($bean->nomination_status_c == "Rejected" && $bean->nomination_status_c != $bean->fetched_row['nomination_status_c']))) {
            //     //send email to participant
            //     require_once('modules/EmailTemplates/EmailTemplate.php');
                
            //     $template = new EmailTemplate();
            //     if ($bean->nomination_status_c == "Accepted") {
            //         $template->retrieve_by_string_fields(array(
            //             'id' => 'ccb21de9-5259-e55c-885c-59c791be9e17',
            //             'type' => 'email'
            //         ));
            //         $id = $bean->id;

            //         $db->query("UPDATE contacts_cstm SET nomination_letter_date_c = '{$today}' WHERE id_c = '{$id}'");
            //     } else {
            //         $template->retrieve_by_string_fields(array(
            //             'id' => 'b53257c9-a26c-ddba-a264-59c7935f2508',
            //             'type' => 'email'
            //         ));
            //     }
                
            //     $projectBean = BeanFactory::getBean('Project', $bean->project_contacts_2project_ida);
            //     $template->body_html = $template->parse_template_bean($template->body_html, $projectBean->module_dir, $projectBean);
                
            //     // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$bean->email1);
                
            //     if ($sugar_config['appInTesting']) {
            //         $this->sendEmailWithoutAttachment($template->subject, $template->body_html, $sugar_config['test_email']);    
            //     }else{
            //         $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$bean->email1);    
            //     }
                
            //     //send email to sponsor
            //     if ($bean->account_id_c) {
            //         $accountBean = BeanFactory::getBean('Accounts', $bean->account_id_c);
                    
            //         if ($bean->nomination_status_c == "Accepted") {
            //             $template->retrieve_by_string_fields(array(
            //                 'id' => 'df9ecd17-d678-6b04-e1ad-59c8996158a6',
            //                 'type' => 'email'
            //             ));
            //         } else {
            //             $template->retrieve_by_string_fields(array(
            //                 'id' => '2c9a04d7-74a5-121c-097f-59c899c93b55',
            //                 'type' => 'email'
            //             ));
            //         }
            //         $template->body_html = $template->parse_template_bean($template->body_html, $bean->module_dir, $bean);
            //         if ($sugar_config['appInTesting']) {
            //         $this->sendEmailWithoutAttachment($template->subject, $template->body_html, $sugar_config['test_email']);    
            //         }else{
            //             $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$accountBean->email1);
            //         }

            //     }
            // }
        }
    }
    
    public function sendEmailWithoutAttachment($subject, $body, $email)
    {
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');
        $emailObj = new Email();
        
        $defaults = $emailObj->getSystemDefaultEmail();
        
        $mail = new SugarPHPMailer();
        
        $mail->setMailerForSystem();
        $mail->From     = $defaults['email'];
        $mail->FromName = $defaults['name'];
        
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->prepForOutbound();
        $mail->AddAddress($email);
        $mail->isHTML(true);
        // print_r($mail);exit();
        @$mail->Send();
    }
}

?>