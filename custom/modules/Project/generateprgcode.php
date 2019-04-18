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


    class GeneratePrgCode
    {
        function generate_code($bean, $event, $arguments)
        {
        	global $db,$current_user;

            if($bean->status == 'Offered' && empty($bean->programme_id_c)){

                $pyear = $bean->programme_year_c;
                $fromyear = substr($pyear, 2,4);
                $toyear = substr(($pyear + 1),2,4);
                $year = "$fromyear-$toyear";
				/*Code Added & commented by Ashvin
				  Date:12-12-2018
				  Reason: Issue-Programme Code-2019-2020
				  Ticket -ID: 3950
				*/
            	/*$prgidresult = $db->query("select count(project.id) as count from project join project_cstm on project.id = project_cstm.id_c where project_cstm.programme_year_c = '$pyear' and project.deleted='0'");
                
                $prgidrow = $db->fetchByAssoc($prgidresult);
                $progidcount = $prgidrow['count']+1;*/
				$prgidresult = $db->query("select project_cstm.programme_id_c as programme_id_c from project join project_cstm on project.id = project_cstm.id_c where project_cstm.programme_year_c = '$pyear' and project.deleted='0' order by date_entered desc limit 0,1");
				$prgidrow = $db->fetchByAssoc($prgidresult);
                $oldprogid = $prgidrow['programme_id_c'];
				
				$old_programme_id_c_arr=explode('/',$oldprogid);
				$progidcount = $old_programme_id_c_arr[3]+1;
				/*Code Added & commented by Ashvin
				  Date:12-12-2018
				  Reason: Issue-Programme Code-2019-2020
				  Ticket -ID: 3950
				*/
                /*================ Programme Code ======================
                Prg/16-17/1/17-Announced,Prg/16-17/2/65-Sponsor Programme,Prg/16-17/3/1-ICTP ON Campus,Prg/16-17/4/71-Seminar,Prg/16-17/5/132-ICTP OFF Campus,Prg/16-17/6/156-Workshop ON Campus, Prg/16-17/7/121-Workshop OFF Campus,Prg/16-17/8/143-Long duration programme

                ========================================================*/
                switch ($bean->programme_type_c) {

                    case 'Announced':
                    $code = 1;
                    break;
                    case 'Sponsored':
                    $code = 2;
                    break;
                    case "ICTP-On Campus":
                    $code = 3;
                    break;
                    case "Seminar":
                    $code = 4;
                    break;
                    case "ICTP-Off Campus":
                    $code = 5;
                    break;
                    case 'Workshop ON Campus':
                    $code = 6;
                    break;
                    case 'Workshop OFF Campus':
                    $code = 7;
                    break;
                    case 'Long Duration':
                    $code = 8;
                    break;
                
                }
            	$bean->programme_id_c = "PRG/$year/$code/$progidcount";

            }

            if($bean->dotp_approval_c && $bean->fetched_row['dotp_approval_c'] != $bean->dotp_approval_c){
                $programmeName = $bean->name;
                $userBean = BeanFactory::getBean('Users',$bean->assigned_user_id);
                $email = $userBean->email1;
                $subject = "CR Approved for ".$programmeName;
                $body = "Hi,<br><br> CR allotment for the programme \"$programmeName\" has been approved";
                $this->sendEmail($subject,$body,$email);
            }
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
