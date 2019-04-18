<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class ProjectController extends SugarController
{
    function action_printLOPDocument()
    {
    	$projectBean = BeanFactory::getBean('Project',$_REQUEST['id']);
    	$participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
    	$newData = array();
    	foreach ($participantsBean as $key => $value) {
    		$newData[$key]['id'] = $value->id;
            $newData[$key]['first_name'] = $value->first_name;
    		$newData[$key]['name'] = $value->name;
    		$newData[$key]['designation_c'] = $value->designation_c;
    		$newData[$key]['sponsor_organisation_c'] = $value->sponsor_organisation_c;
    		$newData[$key]['account_id'] = $value->account_id;
            $newData[$key]['account_name'] = $value->account_name;
            $newData[$key]['phone_mobile'] = $value->phone_mobile;
    		$newData[$key]['phone_work'] = $value->alternate_phone_c;
    	}
    	
        usort($newData, array('ProjectController','compareByName'));

    	$data = array();
    	foreach ($participantsBean as $key => $value) {
    		$data[$key]['name'] = $value->name;
    		$data[$key]['dsgAndOrg'] = $value->designation_c;
    		if ($value->account_name != '' && $value->designation_c != '') {
    			$data[$key]['dsgAndOrg'] .= ' & ';
    		}
    		$data[$key]['dsgAndOrg'] .= $value->account_name;
    	}
    	 
    	global $sugar_config;
    	include 'printDocument.php';
    }

    function compareByName($a, $b) {
	  return strcmp($a["first_name"], $b["first_name"]);
	}

    public function action_sendAcceptanceToAllNominations()
    {
        // ini_set('display_errors', 1);
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $sugar_config;

        $projectBean = BeanFactory::getBean('Project',$_REQUEST['id']);
        $ppd = BeanFactory::getBean('Users',$projectBean->assigned_user_id);
        $spd = null;
        if ($projectBean->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$projectBean->scrm_partners_id_c);
        }        
        $participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
        // print_r($participantsBean);exit();
        if (count($participantsBean)>0) {
            foreach ($participantsBean as $key => $value) {
                $contact = $value->get_linked_beans('scrm_partner_contacts_contacts_1', 'scrm_Partner_Contacts');
               
                $template = new EmailTemplate();
                if ($projectBean->programme_type_c == "ICTP-On Campus" || $projectBean->programme_type_c == "ICTP-Off Campus") {
                    $template->retrieve_by_string_fields(array('id' => '5bb070e3-5736-3ecc-a23f-5a092430594d','type'=>'email'));
                }else{
                    // $template->retrieve_by_string_fields(array('id' =>   '443d8a76-b8a0-20d2-c951-59dc76caf81b','type'=>'email'));
                    $template->retrieve_by_string_fields(array('id' =>   'e4ff38b7-be8d-c8d0-504a-5a092518a523','type'=>'email'));
                    $template->body_html = str_replace('one_day_before_start_date',  date('d-m-Y', strtotime('-1 day', strtotime($projectBean->start_date_c))), $template->body_html);
                    if ($ppd) {
                        $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                        $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
                    }else{
                        $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                        $template->body_html = str_replace('ppd_email', '', $template->body_html);            
                    }

                    if ($spd) {
                        $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
                    }else{
                        $template->body_html = str_replace(' – PD1, spd_name - PD2', '', $template->body_html);
                    }

                }

                //Parse Body HTMLcc
                $template->body_html = $template->parse_template_bean($template->body_html,$value->module_dir,$value);
                $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
                $template->body_html = $template->parse_template_bean($template->body_html,$ppd->module_dir,$ppd);
                if (count($contact)>0) {
                    $template->body_html = str_replace('password_reset', $contact[0]->portal_reset_password_c, $template->body_html);
                }

                $template->body_html = str_replace('portal_url', $sugar_config['portal_url'], $template->body_html);
                $template->subject = str_replace('project_name', $projectBean->name, $template->subject);

                // print_r($template->body_html);exit();
				if ($sugar_config['appInTesting']) {
               		 $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
            	}else{
              		  $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$value->email1);            
            	}
                
                
            }
        }

        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);

    }    

    function action_SendAcceptanceToSponsor()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $db, $sugar_config;
        
        $programme = BeanFactory::getBean('Project',$_REQUEST['id']);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $spd = null;
        if ($programme->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
        }

        $template = new EmailTemplate();
        $ictp = true;
        if ($programme->programme_type_c != "ICTP-On Campus" && $programme->programme_type_c != "ICTP-Off Campus") {
            
            $ictp = false;
        }        
        // print_r($contact->project_contacts_2project_ida);exit();

        if ($ictp === false) {
            
            //Parse Body HTML
            $sponsor = array();
            $participantsBeans = $programme->get_linked_beans('project_contacts_2');
            // echo "<pre>";
            foreach ($participantsBeans as $key => $value) {
            

                
                $participants = $programme->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "account_id_c='{$value->account_id_c}' AND nomination_status_c='Accepted'");

                $i = 1;
                if (!isset($sponsor[$value->account_id_c])) {
                    $sponsor[$value->account_id_c] = '';
                    foreach ($participants as $key2 => $value2) {
                        $sponsor[$value->account_id_c] .= '<br>'.$i.'. '.$value2->name;
                        $i++;
                    }
                }
            }    
            // print_r($sponsor);exit();
            $emails = '';
            if (count($sponsor)>0) {
                foreach ($sponsor as $key => $value) {
                    if ($value) {
                        $template->retrieve_by_string_fields(array('id' => '2172b4ca-76c2-48c7-fccb-5a0929215c20','type'=>'email'));
                        $template->subject = str_replace('project_name', $programme->name, $template->subject);
                        $sponsor = BeanFactory::getBean('Accounts',$key);
                        if ($sponsor) {
                            $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
                            $template->body_html = str_replace('nomination_list', $value, $template->body_html);
                            if ($ppd) {
                                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
                            }else{
                                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
                            }

                            if ($spd) {
                                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
                            }else{
                                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
                            }                  
                            $template->body_html = str_replace('one_day_before', date('d-m-Y', strtotime('-1 day', strtotime($programme->start_date_c))), $template->body_html);
                            

                            if ($sugar_config['appInTesting']) {
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                            }else{
                                $emails .= ', '.$sponsor->email1;
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sponsor->email1);            
                            }                   


                        }

                    }
                }                
            }        
        }

        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);  
    }  

    public function action_sendCancellationToNominations()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $sugar_config, $db;
        $projectBean = BeanFactory::getBean('Project',$_REQUEST['id']);
        $participantsBeans = $projectBean->get_linked_beans('project_contacts_2');
        $ppd = null;
        if ($projectBean->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$projectBean->assigned_user_id);
        }

        
        foreach ($participantsBeans as $key => $value) {
            $template = new EmailTemplate();
            $template->retrieve_by_string_fields(array('id' => '778348e3-6214-00ee-2876-5a092fd66231','type'=>'email'));

            //Parse Body HTMLcc
            $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
            // $template->body_html = $template->parse_template_bean($template->body_html,$ppd->module_dir,$ppd);
            $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
            
            if ($ppd) {
                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
            }else{
                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
            }

            if ($spd) {
                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
            }else{
                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
            } 

            $template->subject = str_replace('project_name', $projectBean->name, $template->subject);

            if ($sugar_config['appInTesting']) {
                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
            }else{
                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$value->email1);            
            }
        
            // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,'aditya@simplecrm.com.sg');exit();
            // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$value->email1);
                            
        }   

        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);   
    }

    public function action_sendCancellationDeffered()
    {
        // echo "string";exit();
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $sugar_config, $db;

        $projectBean = BeanFactory::getBean('Project',$_REQUEST['id']);
        $participantsBeans = $projectBean->get_linked_beans('project_contacts_2');
        $ppd = BeanFactory::getBean('Users',$projectBean->assigned_user_id);
        $template = new EmailTemplate();
        

        $i = 0;
        foreach ($participantsBeans as $key => $value) {
            //Parse Body HTMLcc
            $template->retrieve_by_string_fields(array('id' => '3ea947af-a854-83f8-a31a-5a09339d6d5e','type'=>'email'));
            $template->body_html = $template->parse_template_bean($template->body_html,$projectBean->module_dir,$projectBean);
            $template->body_html = $template->parse_template_bean($template->body_html,$value->module_dir,$value);

            if ($ppd) {
                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
            }else{
                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
            }

            if ($spd) {
                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
            }else{
                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
            }   

            $template->subject = str_replace('project_name', $projectBean->name, $template->subject);
            
            // $template->body_html = str_replace('contact_name', $value->name, $template->body_html);
            // $this->sendEmailWithoutAttachment($template->subject,$template->body_html,'aditya@simplecrm.com.sg');exit();
            if ($sugar_config['appInTesting']) {
                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                break;
            }else{
                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$value->email1);            
            }
            
        }   
        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);   
    }       

    public function action_sendDeffermentToSponsor()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $db, $sugar_config;
        
        $programme = BeanFactory::getBean('Project',$_REQUEST['id']);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $spd = null;
        if ($programme->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
        }

        $template = new EmailTemplate();
        $ictp = true;
        if ($programme->programme_type_c != "ICTP-On Campus" && $programme->programme_type_c != "ICTP-Off Campus") {
            
            $ictp = false;
        }        
        // print_r($contact->project_contacts_2project_ida);exit();

        if ($ictp === false) {
            
            //Parse Body HTML
            $sponsor = array();
            $participantsBeans = $programme->get_linked_beans('project_contacts_2');
            // echo "<pre>";
            foreach ($participantsBeans as $key => $value) {
            

                
                $participants = $programme->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "account_id_c='{$value->account_id_c}' AND nomination_status_c='Accepted'");

                $i = 1;
                if (!isset($sponsor[$value->account_id_c])) {
                    $sponsor[$value->account_id_c] = '';
                    foreach ($participants as $key2 => $value2) {
                        $sponsor[$value->account_id_c] .= '<br>'.$i.'. '.$value2->name;
                        $i++;
                    }
                }
            }    
            // print_r($sponsor);exit();
            $emails = '';
            if (count($sponsor)>0) {
                foreach ($sponsor as $key => $value) {
                    if ($value) {
                        $template->retrieve_by_string_fields(array('id' => 'b667215a-70dd-1b8b-dd6d-5a0930868240','type'=>'email'));
                        $template->subject = str_replace('project_name', $programme->name, $template->subject);
                        $sponsor = BeanFactory::getBean('Accounts',$key);
                        if ($sponsor) {
                            $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
                            
                            if ($ppd) {
                                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
                            }else{
                                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
                            }

                            if ($spd) {
                                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
                            }else{
                                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
                            }                  
                            $template->body_html = str_replace('one_day_before', date('d-m-Y', strtotime('-1 day', strtotime($programme->start_date_c))), $template->body_html);
                            

                            if ($sugar_config['appInTesting']) {
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                            }else{
                                $emails .= ', '.$sponsor->email1;
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sponsor->email1);            
                            }                   
                        }
                    }
                }                
            }        
        }

        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);   
    }       

    public function action_sendCancellationToSponsor()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $db, $sugar_config;
        
        $programme = BeanFactory::getBean('Project',$_REQUEST['id']);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $spd = null;
        if ($programme->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
        }


        $template = new EmailTemplate();
        $ictp = true;
        if ($programme->programme_type_c != "ICTP-On Campus" && $programme->programme_type_c != "ICTP-Off Campus") {
            
            $ictp = false;
        }        
        // print_r($contact->project_contacts_2project_ida);exit();

        if ($ictp === false) {
            
            //Parse Body HTML
            $sponsor = array();
            $participantsBeans = $programme->get_linked_beans('project_contacts_2');
           
            foreach ($participantsBeans as $key => $value) {
            
                $participants = $programme->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "account_id_c='{$value->account_id_c}' AND nomination_status_c='Accepted'");

                $i = 1;
                if (!isset($sponsor[$value->account_id_c])) {
                    $sponsor[$value->account_id_c] = '';
                    foreach ($participants as $key2 => $value2) {
                        $sponsor[$value->account_id_c] .= '<br>'.$i.'. '.$value2->name;
                        $i++;
                    }
                }
            }    
           
            $emails = '';
            if (count($sponsor)>0) {
                foreach ($sponsor as $key => $value) {
                    if ($value) {
                        $template->retrieve_by_string_fields(array('id' => '872cf3c0-54a4-1380-c274-5a092e48a455','type'=>'email'));
                        $sponsor = BeanFactory::getBean('Accounts',$key);
                        if ($sponsor) {
                            $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
                            $template->subject = str_replace('project_name', $programme->name, $template->subject);
                            $template->body_html = str_replace('nomination_list', $value, $template->body_html);
                            if ($ppd) {
                                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
                            }else{
                                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
                            }

                            if ($spd) {
                                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
                            }else{
                                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
                            }                  
                            $template->body_html = str_replace('one_day_before', date('d-m-Y', strtotime('-1 day', strtotime($programme->start_date_c))), $template->body_html);
                            $template->subject = str_replace('project_name', $programme->name, $template->subject);            

                            if ($sugar_config['appInTesting']) {
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sugar_config['test_email']);
                            }else{
                                $emails .= ', '.$sponsor->email1;
                                $this->sendEmailWithoutAttachment($template->subject,$template->body_html,$sponsor->email1);            
                            }                   
                        }
                    }
                }                
            }        
        }

        SugarApplication::redirect('index.php?module=Project&action=DetailView&record='.$_REQUEST['id']);       
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

    public function sendEmail($subject,$body,$email,$file)
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
        $mail->AddAttachment('timetable.docx', 'timetable.docx', 'base64', 'application/vnd.ms-word');
        // print_r($mail);exit();
        @$mail->Send(); 
    }
    public function countOfRatings($feedbackbean,$field_name)
    {   
        $ratings = array_map(function($o) use($field_name){
            return $o->$field_name;
        }, feedbackbean);

        return count($ratings);
    }

    public function action_feedback(){
        global $db, $app_list_strings;
        $id = $_REQUEST['id'];

        $db->query("SET SESSION group_concat_max_len = 1000000000000000");
        
        $query = "
                SELECT
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 1 THEN 1 else 0 END) as unsatisfactory,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 2 THEN 1 else 0 END) as satisfactory,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 3 THEN 1 else 0 END) as good,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 4 THEN 1 else 0 END) as very_good,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 5 THEN 1 else 0 END) as excellent,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'High' THEN 1 else 0 END) as High,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Med' THEN 1 else 0 END) as Med,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Low' THEN 1 else 0 END) as Low,
                    SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'VeryLow' THEN 1 else 0 END) as vlow,          
                    scrm_session_information.name as session_name,
                    scrm_session_information_cstm.faculty_id_c as faculty_name
                FROM project 
                INNER JOIN project_scrm_timetable_1_c ON project_scrm_timetable_1_c.project_scrm_timetable_1project_ida = project.id
                INNER JOIN project_cstm ON project_cstm.id_c = project.id
                INNER JOIN scrm_timetable_scrm_session_information_1_c ON scrm_timetable_scrm_session_information_1_c.scrm_timetable_scrm_session_information_1scrm_timetable_ida = project_scrm_timetable_1_c.project_scrm_timetable_1scrm_timetable_idb
                INNER JOIN scrm_feedback_sessions_cstm ON scrm_feedback_sessions_cstm.session_c = scrm_timetable_scrm_session_information_1_c.scrm_timetc7f4rmation_idb
                INNER JOIN scrm_feedback_sessions ON scrm_feedback_sessions.id = scrm_feedback_sessions_cstm.id_c 
                INNER JOIN scrm_feedback_scrm_feedback_sessions_1_c ON scrm_feedback_scrm_feedback_sessions_1_c.scrm_feedback_scrm_feedback_sessions_1scrm_feedback_sessions_idb = scrm_feedback_sessions.id
                INNER JOIN scrm_feedback ON scrm_feedback_scrm_feedback_sessions_1_c.scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida = scrm_feedback.id
                INNER JOIN project_scrm_feedback_1_c ON project_scrm_feedback_1_c.project_scrm_feedback_1scrm_feedback_idb = scrm_feedback.id
                INNER JOIN scrm_session_information ON scrm_session_information.id = scrm_feedback_sessions_cstm.session_c
                INNER JOIN scrm_session_information_cstm ON scrm_session_information_cstm.id_c = scrm_session_information.id
                WHERE project.id = '$id'
                AND scrm_timetable_scrm_session_information_1_c.deleted = '0'
                AND scrm_feedback.deleted = '0'
                AND project_scrm_feedback_1_c.deleted = '0'
                AND project_scrm_timetable_1_c.deleted = '0'
                AND scrm_feedback_sessions.deleted = '0'
                GROUP BY project.id, scrm_session_information.id
                Order by scrm_session_information_cstm.start_time_c asc
        ";
// ob_clean();
// echo $query;exit();
        $queryObjective = "
                SELECT 
                    SUM(CASE WHEN scrm_feedback_objective_cstm.rating_c = 1 THEN 1 else 0 END) as Minimal,
                    SUM(CASE WHEN scrm_feedback_objective_cstm.rating_c = 2 THEN 1 else 0 END) as Partial,
                    SUM(CASE WHEN scrm_feedback_objective_cstm.rating_c = 3 THEN 1 else 0 END) as Complete,
                    scrm_feedback_objective_cstm.objective_c,
                    scrm_programme_objective.name
                FROM project
                INNER JOIN project_scrm_feedback_1_c ON project_scrm_feedback_1_c.project_scrm_feedback_1project_ida = project.id
                INNER JOIN scrm_feedback_scrm_feedback_objective_1_c ON scrm_feedback_scrm_feedback_objective_1_c.scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida = project_scrm_feedback_1_c.project_scrm_feedback_1scrm_feedback_idb
                INNER JOIN scrm_feedback_objective_cstm ON scrm_feedback_objective_cstm.id_c = scrm_feedback_scrm_feedback_objective_1_c.scrm_feedb10e5jective_idb
                INNER JOIN scrm_programme_objective ON scrm_feedback_objective_cstm.objective_c = scrm_programme_objective.id
                WHERE project.id = '$id'
                AND project_scrm_feedback_1_c.deleted = '0'
                GROUP BY scrm_feedback_objective_cstm.objective_c
                Order by scrm_programme_objective.name asc 
        ";

        $queryProgramme = "
                SELECT
                    SUM(CASE WHEN scrm_feedback_cstm.overall_rating_c = 1 THEN 1 else 0 END) as o1,
                    SUM(CASE WHEN scrm_feedback_cstm.overall_rating_c = 2 THEN 1 else 0 END) as o2,
                    SUM(CASE WHEN scrm_feedback_cstm.overall_rating_c = 3 THEN 1 else 0 END) as o3,
                    SUM(CASE WHEN scrm_feedback_cstm.overall_rating_c = 4 THEN 1 else 0 END) as o4,
                    SUM(CASE WHEN scrm_feedback_cstm.overall_rating_c = 5 THEN 1 else 0 END) as o5,
                    project_cstm.start_date_c,
                    project_cstm.end_date_c,
                    project.name,
                    GROUP_CONCAT(scrm_feedback_cstm.topics_include_c SEPARATOR ':') as topics_include_c,
                    GROUP_CONCAT(scrm_feedback_cstm.topics_not_relevant_c SEPARATOR ':') as topics_not_relevant_c,
                    GROUP_CONCAT(scrm_feedback_cstm.learning_outcomes_c SEPARATOR ':') as learning_outcomes_c,
                    GROUP_CONCAT(scrm_feedback_cstm.attend_asci_programmes_c) as attend_asci_programmes_c,
                    GROUP_CONCAT(scrm_feedback_cstm.offer_other_programms_c) as offer_other_programms_c
                FROM project 
                INNER JOIN project_cstm ON project_cstm.id_c = project.id
                LEFT JOIN project_scrm_feedback_1_c ON project_scrm_feedback_1_c.project_scrm_feedback_1project_ida = project.id
                LEFT JOIN scrm_feedback_cstm ON scrm_feedback_cstm.id_c = project_scrm_feedback_1_c.project_scrm_feedback_1scrm_feedback_idb
                LEFT JOIN scrm_feedback ON scrm_feedback.id = scrm_feedback_cstm.id_c
                WHERE project.deleted = '0'
                AND project.id = '$id'
                AND scrm_feedback.deleted='0'
                AND project_scrm_feedback_1_c.deleted = '0'
                GROUP BY project.id
        ";

        /*Somesh Bawane
        Dt. 24/01/2019
        Mid-point feedback start*/

        $sql = "SELECT start_date_c,end_date_c FROM project INNER JOIN project_cstm ON project_cstm.id_c = project.id WHERE id = '".$id."'";
        $date = $db->fetchByAssoc($db->query($sql));

        $now = new DateTime(); // get today's date
        $start = new DateTime($date['start_date_c']); // get start date of program
        $end = new DateTime($date['end_date_c']); // get end date of program
        
        // total days
        $days = $start->diff($end, true)->days;
        $curdays = $start->diff($now, true)->days;

        $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
        $sundaystoday = intval($curdays / 7) + ($start->format('N') + $curdays % 7 >= 7);
        $newprog = [];

        $interval = $days - $sundays;
        $curInterval = $curdays - $sundaystoday;

        //for showing Section 3 - 7 on last day +-1 day
        $show = 'hide';
        if($curInterval == ($interval-1) || $curInterval >= $interval){
            $show = 'show';
        }
        
        /*Midpoint feedback end*/

        $feedbackSessions = $db->query($query);
        $feebackObjectives = $db->query($queryObjective);
        $feedback = $db->fetchByAssoc($db->query($queryProgramme));

        include 'feedbackDoc.php';
    }

    public function action_pdReport(){
        
        $projectBean = BeanFactory::getBean('Project',$_REQUEST['id']);
        // print_r($projectBean->project_scrm_timetable_1scrm_timetable_idb);exit();
        $participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
        include 'pdReportDoc.php';
    }
}

?> 
