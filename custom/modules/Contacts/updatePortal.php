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

/**
* 
*/
// ini_set('display_errors','On');
class updatePortal
{
	static $already_ran = false;
	public function updateUser($bean)
	{
		if (self::$already_ran == true) return;
        self::$already_ran = true;
        if($_REQUEST['module'] != 'Import'){  
          global $db, $sugar_config;
          // print_r($bean->project_contacts_2project_ida);exit();
          $project = $bean->get_linked_beans('project_contacts_2');
          if (count($project)>0) {
            $projectBean = $project[0];          
          
            if (($bean->nomination_status_c == "Nomination Received" && $bean->nomination_status_c != $bean->fetched_row['nomination_status_c'])) {
                    $query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = 'd5c461d1-c8bd-11f0-5022-592d69392d24'");
                  require_once('modules/EmailTemplates/EmailTemplate.php');
                  $template = new EmailTemplate();
                  $template->retrieve_by_string_fields(array('id' => '7bdffdcd-3728-3de2-e4fa-5a1d105d7f49','type'=>'email'));                
                  if (!$sugar_config['appInTesting']) {
                    while ($result = $db->fetchByAssoc($query)) {
                      if ($result) {
                        $user = BeanFactory::getBean('Users',$result['user_id']);
                              $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);                        

                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$user->email1);
                      } 
                    }
                  }else{
                        $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);       

                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                  }                
            }


            if (($bean->nomination_status_c == "Screened by PO" && $bean->nomination_status_c != $bean->fetched_row['nomination_status_c'])) {
                    $query = $db->query("SELECT user_id FROM acl_roles_users WHERE role_id = 'd5c461d1-c8bd-11f0-5022-592d69392d24'");
                  require_once('modules/EmailTemplates/EmailTemplate.php');
                  $template = new EmailTemplate();
                  $template->retrieve_by_string_fields(array('id' => 'e9e9159c-a183-824b-341e-5a1d104d7ea7','type'=>'email'));                
                  if (!$sugar_config['appInTesting']) {
                    while ($result = $db->fetchByAssoc($query)) {
                        $ppd = null;
                        if ($projectBean->assigned_user_id) {
                            $ppd = BeanFactory::getBean('Users',$projectBean->assigned_user_id);
                            $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$ppd->email1);
                        }      
                        if ($projectBean->scrm_partners_id_c) {
                            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
                            $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$spd->email1);
                        }  


                    }
                  }else{
                        $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);       

                        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                  }                
            }
          }
        }

		// echo "<pre>";
		// print_r($bean);exit();
		// if(empty($bean->fetched_row['id'])){
		// 	require_once('custom/modules/Accounts/database.php');

		// 	$e = $connection->prepare("UPDATE employees JOIN users ON users.context_id = employees.id SET employees.name = '{$bean->name}', employees.email = '{$bean->email1}', employees.mobile = '{$bean->phone_mobile}', employees.mobile2 = '{$bean->alternate_phone_c}', employees.street = '{$bean->billing_address_street}', employees.state = '{$bean->billing_address_state}', employees.postal_code = '{$bean->billing_address_postalcode}', employees.country = '{$bean->billing_address_country}', users.email = '{$bean->email1}', users.name = '{$bean->name}', employees.about = '{$bean->description}' WHERE users.crm_id = '{$bean->id}'");
		// 	$e->execute();
		// }		
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
