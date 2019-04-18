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
class logic_hooks_class
{
	static $already_ran = false;

	public function after_save_method($bean)
	{
        if(self::$already_ran == true) return;
        self::$already_ran = true;
        if($_REQUEST['module'] != 'Import'){  
			if(!empty($bean->fetched_row['id'])){
				
				require_once('custom/modules/Accounts/database.php');
				$check = $connection->prepare("SELECT email from users WHERE email = '$bean->email1'");
				$check->execute();
				if (!$check->fetch()) {
					$e = $connection->prepare("UPDATE employees JOIN users ON users.context_id = employees.id SET employees.name = '{$bean->name}', employees.email = '{$bean->email1}', employees.mobile = '{$bean->phone_number_c}', employees.mobile2 = '{$bean->alternative_phone_c}', employees.sp1_designation = '{$bean->designation_c}', employees.sp2_designation = '{$bean->designation2_c}', employees.street = '{$bean->billing_address_street}', employees.state = '{$bean->billing_address_state}', employees.postal_code = '{$bean->billing_address_postalcode}', employees.country = '{$bean->billing_address_country}', users.email = '{$bean->email1}', users.name = '{$bean->name}', employees.about = '{$bean->description}' WHERE users.crm_id = '{$bean->id}'");
					$e->execute();
				}

			}else{
		        require_once('modules/EmailTemplates/EmailTemplate.php');
		    
		        $template = new EmailTemplate();
		        $template->retrieve_by_string_fields(array('id' => 'c5960b89-9c62-cb7e-edc2-59c65d7f5d6b','type'=>'email'));
		        global $db, $sugar_config;

		        $result = $db->query("SELECT email_addresses.email_address FROM users INNER JOIN email_addr_bean_rel ON email_addr_bean_rel.bean_id = users.id INNER JOIN email_addresses ON email_addresses.id = email_addr_bean_rel.email_address_id");
				$emails = array();

				if (!$sugar_config['appInTesting']) {
					while ($row = $db->fetchByAssoc($result)) {
						
				        //Parse Body HTMLcc
				        $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
						if($sugar_config['appInTesting']){
					        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);				
						}else{
					        $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$row->email_address);				
						}
					}
				}else{
				    $template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
				    $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);							
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
