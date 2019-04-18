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

class updateFields
{
	static $already_ran = false;
	public function updateFields($bean)
	{
		
		global $current_user, $db;
	
       $roleArray= $role = ACLRole::getUserRoleNames($current_user->id);
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }else{
            //role is admin
            $role = false;
        }
		
        if(self::$already_ran == true) return;
        self::$already_ran = true;
		
		// $bean->name = $bean->project_scrm_budget_1_name;
		$db->query("UPDATE scrm_budget SET name = '{$bean->project_scrm_budget_1_name}' WHERE id = '{$bean->id}'");
		/*Added by Ashvin
		  Date:27-10-2018
		  Reason: budget changes
		*/
		
		if(in_array('FAC/PD',$roleArray)){
			$ac_approve=0;
			if($bean->ac_approval_c=='No' && (empty($bean->cd_assigned_to_c))){
				$db->query("UPDATE scrm_budget_cstm SET ac_approval_c = '' WHERE id_c = '{$bean->id}'");
				// $bean->ac_approval_c = '';
				//$bean->remark_ac_c = '';
				$ac_approve=1;
			}
			if($bean->cd_approval_c=='No' && empty($bean->dotp_assigned_user_c)){
				$bean->cd_approval_c = '';
				//$bean->remark_cd_c = '';
				$db->query("UPDATE scrm_budget_cstm SET cd_approval_c = '' WHERE id_c = '{$bean->id}'");
			}
			if($bean->dotp_approval_c=='No' && !empty($bean->dotp_assigned_user_c)){
				$db->query("UPDATE scrm_budget_cstm SET dotp_approval_c = '' WHERE id_c = '{$bean->id}'");
				//$bean->dotp_approval_c = '';
				//$bean->remark_cd_c = '';
			}
		}
		/*Added by Ashvin
		  Date:27-10-2018
		  Reason: budget changes
		*/
		// $bean->save();

        // if ($bean->ac_approval_c == "y" || $bean->cd_approval_c == "y" || $bean->dotp_approval_c == "y" ) {
		// 	//email template
		// 	require_once('modules/EmailTemplates/EmailTemplate.php');


		// 	$template = new EmailTemplate();

			
		// 	// print_r($userBean);exit();
		// 	// $programme = $invoice->get_linked_beans('project_aos_invoices_1');

		// 	$programme = BeanFactory::getBean('Project',$bean->project_scrm_budget_1project_ida);

		// 	//Parse Body HTMLcc
		// 	$template->body_html = $template->parse_template_bean($template->body_html,$userBean->module_dir,$userBean);

	    //     if ($role == 'DOTP' && $bean->dotp_approval_c != $bean->fetched_row['dotp_approval_c']) {
	    //     	$userBean = BeanFactory::getBean('Users',$bean->assigned_user_id);
		// 		$template->retrieve_by_string_fields(array('id' => '6e275329-f16d-b895-b6fa-594a0441b7f8','type'=>'email'));

	    //     }else if ($role == "Centre Director" && $bean->cd_approval_c != $bean->fetched_row['cd_approval_c']) {
	    //     	$userBean = BeanFactory::getBean('Users', $bean->user_id_c);
		// 		$template->retrieve_by_string_fields(array('id' => 'eeb34850-a3a8-ad2b-56c5-594a070f9deb','type'=>'email'));
	        	
	    //     }else if($role == "Area Chairperson" && $bean->ac_approval_c != $bean->fetched_row['ac_approval_c']){
	    //     	$userBean = BeanFactory::getBean('Users',$bean->user_id1_c);
		// 		$template->retrieve_by_string_fields(array('id' => 'e52171ba-afb9-4fe4-e1f4-594a04cee7a7','type'=>'email'));
	        		
	    //     }
		// 	$template->body_html = $template->parse_template_bean($template->body_html,$bean->module_dir,$bean);
		// 	$template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
			
		// 	//$this->sendEmail($template->subject,$template->body_html,$userBean->email1);

			
        // }


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

?>
