<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


array_push($job_strings, 'Outstanding_Payment_Alert_To_PD');
array_push($job_strings, 'Group_Nominations');
array_push($job_strings, 'Organisation_to_Portal');
array_push($job_strings, 'PD_to_Portal');
array_push($job_strings, 'Participant_Followup');

//function to make cURL request
function call($method, $parameters, $url)
{
    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

    $jsonEncodedData = json_encode($parameters);

    $post = array(
         "method" => $method,
         "input_type" => "JSON",
         "response_type" => "JSON",
         "rest_data" => $jsonEncodedData
    );

    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);

    $result = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();

    return $response;
}


function apiCallToPortal($data=array(),$url)
{
    // ob_start();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);
    $response = json_decode($server_output);
    // print_r($response);exit();
    // ob_end_flush();
    
    return $response;
}

function Group_Nominations()
{
  // _ppl('Group Nominations');
  // $GLOBALS['log']->logLevel('Fatal');
  // $GLOBALS['log']->fatal('Group Nominations cron'); 

  global $db,$sugar_config;
  $url = $sugar_config['site_url'];
  $url = $url."/service/v4_1/rest.php";
  $username = $sugar_config['crmuser'];
  $password = $sugar_config['crmpass'];
  $portal_url_api = 'http://161.202.21.7/asci/portal/public/portalweb';
  $portal_url = 'http://161.202.21.7/asci/portal/public';
  $GLOBALS['log']->logLevel('Fatal');
  $GLOBALS['log']->fatal('Group Nominations cron '.$sugar_config['crmuser'].' / '.$sugar_config['crmpass']); 
//login --------------------------------------------- 
$login_parameters = array(
     "user_auth" => array(
          "user_name" => $username,
          "password" => md5($password),
          "version" => "1"
     ),
     "application_name" => "RestTest",
     "name_value_list" => array(),
);

$login_result = call("login", $login_parameters, $url);

//get session id
$session_id = $login_result->id;
 
$sql = "SELECT nc.*, n.*,b2.email_address FROM contacts n join contacts_cstm nc on nc.id_c = n.id JOIN ( SELECT eabr.bean_id,ea.email_address, ea.deleted FROM email_addr_bean_rel eabr JOIN email_addresses ea ON ( ea.id = eabr.email_address_id ) WHERE ea.deleted = 0 AND eabr.deleted = 0 AND eabr.primary_address = 1) as b2 ON b2.bean_id = n.id where n.id NOT IN (select scrm_partner_contacts_contacts_1contacts_idb from  scrm_partner_contacts_contacts_1_c cn where cn.deleted =0) and n.deleted = 0";

$result = $db->query($sql);
$GLOBALS['log']->fatal(print_r($result, true));
while($row = $db->fetchByAssoc($result)){
                      // $GLOBALS['log']->fatal('New nomination'.print_r($row,true)); 
	$GLOBALS['log']->fatal(print_r($row, true));
    $nid = $row['id'];
    $mobile = (empty($row['phone_mobile']))? $row['phone_work'] : $row['phone_mobile'];
    $email = $row['email_address'];
    $salutation = $row['salutation'];
    $first_name = $row['first_name'];
    $birthdate = $row['birthdate'];
    $last_name = $row['last_name'];
    // $status = $row['nomination_status_c'];
    $primary_address_street = $row['primary_address_street'];
    $primary_address_country = $row['primary_address_country'];
    $primary_address_state = $row['primary_address_state'];
    $primary_address_city = $row['primary_address_city'];

    $primary_address_postalcode = $row['primary_address_postalcode'];
    $assigned_user_id = $row['assigned_user_id'];

    $rand_id = create_guid();
    $contactsql = "SELECT c.id as id FROM scrm_partner_contacts c inner join scrm_partner_contacts_cstm cstm on cstm.id_c = c.id left join email_addr_bean_rel eb on c.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where ((c.phone_mobile = '$mobile' and c.phone_mobile !='') or (e.email_address = '$email' and e.email_address !='') or (c.first_name = '$first_name' and c.last_name = '$last_name' and cstm.birthdate_c = '$birthdate')) and c.deleted = 0 and e.deleted = 0";

    // $GLOBALS['log']->fatal("SELECT c.id as id FROM scrm_partner_contacts c inner join scrm_partner_contacts_cstm cstm on cstm.id_c = c.id left join email_addr_bean_rel eb on c.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where ((c.phone_mobile = '$mobile' and c.phone_mobile !='') or (e.email_address = '$email' and e.email_address !='') or (c.first_name = '$first_name' and c.last_name = '$last_name' and cstm.birthdate_c = '$birthdate')) and c.deleted = 0 and e.deleted = 0"); 
    $result_n = $db->query($contactsql);
    $contactrow = $db->fetchByAssoc($result_n);
    $cid = $contactrow['id'];
    $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));
    if (empty($cid)) {
      $set_entry_parameters = array(
           "session" => $session_id,
           "module_name" => "scrm_Partner_Contacts",
           "name_value_list" => array(
                array("name" => "salutation", "value" => $salutation),
                array("name" => "first_name", "value" => $first_name),
                array("name" => "last_name", "value" => $last_name),
                array("name" => "phone_mobile", "value" => $mobile),
                // array("name" => "status_c", "value" => $status),
                array("name" => "email1", "value" => $email),
                array("name" => "birthdate_c", "value" => $birthdate),
                array("name" => "primary_address_street", "value" => $primary_address_street),
                array("name" => "primary_address_city", "value" => $primary_address_city),
                array("name" => "primary_address_state", "value" => $primary_address_state),
                array("name" => "primary_address_country", "value" => $primary_address_country),
                array("name" => "primary_address_postalcode", "value" => $primary_address_postalcode),
                array("name" => "assigned_user_id", "value" => $assigned_user_id),
           ),
      );

      // echo "<pre>";
      // print_r($set_entry_parameters);exit();

      $set_entry_result = call("set_entry", $set_entry_parameters, $url);
      $record_id =$set_entry_result->id;
      
     
      $contactnomineerelatequery = "INSERT INTO scrm_partner_contacts_contacts_1_c(id, date_modified, deleted, scrm_partner_contacts_contacts_1scrm_partner_contacts_ida, scrm_partner_contacts_contacts_1contacts_idb) VALUES ('$rand_id','$date','0','$record_id','$nid')";
      // print_r($contactnomineerelatequery);exit();
       

      if ($set_entry_result) {
        $data = array();
        if ($email) {
          $data['email'] = $email;
          $data['name'] = $first_name.' '.$last_name;
          $data['crm_id'] = $record_id;
          $data['dept'] = 2;
        }

        $rsp = apiCallToPortal($data,$portal_url_api.'/create_user');
        // print_r($rsp);       
        if ($rsp) {

          if ($rsp->Success) {
              
              if (count($rsp->data)>0) {
                      
                      $set_entry_parameters = array(
                           "session" => $session_id,
                           "module_name" => "scrm_Partner_Contacts",
                           "name_value_list" => array(
                                array(
                                    "name" => "id",
                                    "value" => $record_id
                                ),
                                array("name" => "portal_reset_password_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
                           ),
                      );
                      $set_entry_result = call("set_entry", $set_entry_parameters, $url);                    
                       // print_r($set_entry_result);
                      // $GLOBALS['log']->fatal('New nomination'.print_r($set_entry_result,true)); 
                  
              }
          }
        
        }

      }
      
    }else{
        $data['id'] = $cid;
        $data['email'] = $email;
        $rsp = apiCallToPortal($data,$portal_url_api.'/generate_token');
        $GLOBALS['log']->fatal('New nomination'.print_r($rsp,true));
        $set_entry_parameters = array(
             "session" => $session_id,
             "module_name" => "scrm_Partner_Contacts",
             "name_value_list" => array(
                  array(
                      "name" => "id",
                      "value" => $cid
                  ),
                  array("name" => "portal_reset_password_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
             ),
        );
        $set_entry_result = call("set_entry", $set_entry_parameters, $url);  
        $contactnomineerelatequery = "INSERT INTO scrm_partner_contacts_contacts_1_c(id, date_modified, deleted, scrm_partner_contacts_contacts_1scrm_partner_contacts_ida, scrm_partner_contacts_contacts_1contacts_idb) VALUES ('$rand_id','$date','0','$cid','$nid')";
    }
    $db->query($contactnomineerelatequery);
    
}
  // $GLOBALS['log']->logLevel('debug');
  // $GLOBALS['log']->fatal('Testing cron by Aditya'); 
  return TRUE;

}

function PD_to_Portal()
{
  // $GLOBALS['log']->fatal('PD To Portal cron'); 

  global $db,$sugar_config;
  $url = $sugar_config['site_url'];
  $url = $url."/service/v4_1/rest.php";
  $username = $sugar_config['crmuser'];
  $password = $sugar_config['crmpass'];
  $portal_url_api = 'http://161.202.21.7/asci/portal/public/portalweb';
  $portal_url = 'http://161.202.21.7/asci/portal/public';

  //login --------------------------------------------- 
  $login_parameters = array(
       "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
       ),
       "application_name" => "RestTest",
       "name_value_list" => array(),
  );

  $login_result = call("login", $login_parameters, $url);

  //get session id
  $session_id = $login_result->id;
   
  $sql = "SELECT u.*,uc.*,b2.email_address FROM users AS u JOIN users_cstm uc on uc.id_c = u.id JOIN acl_roles_users as aru ON aru.user_id = u.id JOIN ( SELECT eabr.bean_id,ea.email_address FROM email_addr_bean_rel eabr JOIN email_addresses ea ON ( ea.id = eabr.email_address_id )) as b2 ON b2.bean_id = u.id where aru.role_id = '270734b1-0242-9157-7a2e-590ff7943164' AND u.deleted = 0 AND (uc.portal_reset_password_c IS NULL or uc.portal_reset_password_c = '') GROUP BY b2.email_address";

  $result = $db->query($sql);

  while($row = $db->fetchByAssoc($result)){
  // print_r($row);
      $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));

      if ($row) {
        $data = array();
        if ($row['email_address']) {
          $data['email'] = $row['email_address'];
          $data['name'] = $row['first_name'].' '.$row['last_name'];
          $data['crm_id'] = $row['id'];
          $data['dept'] = 4;
        }

        $rsp = apiCallToPortal($data,$portal_url_api.'/create_user');

         // ob_clean();
         // print_r($rsp);exit();
        if (isset($rsp->Success)) {

          if ($rsp->Success) {
              
              if (count($rsp->data)>0) {
                      
                  $set_entry_parameters = array(
                       "session" => $session_id,
                       "module_name" => "Users",
                       "name_value_list" => array(
                            array(
                                "name" => "id",
                                "value" => $row['id']
                            ),
                            array("name" => "portal_reset_password_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
                       ),
                  );
                  $set_entry_result = call("set_entry", $set_entry_parameters, $url);                    
                  // print_r($set_entry_result);
                  
              }
          }
        
        }

      }
  }  

  return true;
}

function Organisation_to_Portal()
{
  // $GLOBALS['log']->fatal('Organisation to Portal cron'); 

  global $db,$sugar_config;
  $url = $sugar_config['site_url'];
  $url = $url."/service/v4_1/rest.php";
  $username = $sugar_config['crmuser'];
  $password = $sugar_config['crmpass'];
  $portal_url_api = 'http://161.202.21.7/asci/portal/public/portalweb';
  $portal_url = 'http://161.202.21.7/asci/portal/public';

  //login --------------------------------------------- 
  $login_parameters = array(
       "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
       ),
       "application_name" => "RestTest",
       "name_value_list" => array(),
  );

  $login_result = call("login", $login_parameters, $url);


  //get session id
  $session_id = $login_result->id;

  $sql = "SELECT nc.*, n.*,b2.email_address FROM accounts n join accounts_cstm nc on nc.id_c = n.id JOIN ( SELECT eabr.bean_id,ea.email_address FROM email_addr_bean_rel eabr JOIN email_addresses ea ON ( ea.id = eabr.email_address_id )) as b2 ON b2.bean_id = n.id where n.deleted = 0 and (nc.password_reset_link_c IS NULL or nc.password_reset_link_c = '')";
   
  $result = $db->query($sql);

  while($row = $db->fetchByAssoc($result)){
  // print_r($row);
      $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));

      if ($row) {
        $data = array();
        if ($row['email_address']) {
          $data['email'] = $row['email_address'];
          $data['name'] = $row['name_of_sponsor_c'] != '' ? $row['name_of_sponsor_c'] : $row['name'];
          $data['crm_id'] = $row['id'];
          $data['dept'] = 3;
        }

        $rsp = apiCallToPortal($data,$portal_url_api.'/create_user');

         // ob_clean();
         // print_r($rsp);exit();
        if (isset($rsp->Success)) {

          if ($rsp->Success) {
              
              if (count($rsp->data)>0) {
                      
                  $set_entry_parameters = array(
                       "session" => $session_id,
                       "module_name" => "Accounts",
                       "name_value_list" => array(
                            array(
                                "name" => "id",
                                "value" => $row['id']
                            ),
                            array("name" => "password_reset_link_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
                       ),
                  );
                  $set_entry_result = call("set_entry", $set_entry_parameters, $url);                    
                  // print_r($set_entry_result);
                  
              }
          }
        
        }

      }
  }  
  return true;
}
/**
 * Description of what my_task does.
 *
 * @return boolean Returns TRUE on success and FALSE otherwise.
 */
function Outstanding_Payment_Alert_To_PD() {
  // Add your code here.
  // $GLOBALS['log']->fatal('Testing cron by Aditya'); 
  global $db;
  // $GLOBALS['log']->logLevel('debug');
  $date = date('Y-m-d');
  $date = strtotime($date);
  $date = strtotime("+7 day", $date);
  $date = date('Y-m-d', $date);
  $query = $db->query("SELECT b1.*,group_concat( b5.salutation,  ' ', b5.first_name,  ' ', b5.last_name ) as nominations, b2.*, b7.email_address from project_cstm as b1 inner join project as b2 on b1.id_c=b2.id inner join project_contacts_2_c as b3 on b3.project_contacts_2project_ida = b1.id_c inner join contacts_cstm as b4 on b4.id_c = b3.project_contacts_2contacts_idb inner join contacts as b5 on b5.id = b4.id_c inner join email_addr_bean_rel as b6 on b6.bean_id = b2.assigned_user_id and b6.bean_module = 'Users' inner join email_addresses as b7 on b7.id = b6.email_address_id where b1.start_date_c = '$date' and b2.deleted= 0 and b4.payment_received_c = 'n'");
  require_once('modules/EmailTemplates/EmailTemplate.php');
      require_once('modules/Emails/Email.php');
    require_once('include/SugarPHPMailer.php');
  while ($result = $db->fetchByAssoc($query)) {


        $template = new EmailTemplate();
        $template->retrieve_by_string_fields(array('id' => 'e4f7e1e9-524f-f0ca-4b81-59422390fe6c','type'=>'email'));
        
        //Parse Body HTML
        // $template->body_html = $template->parse_template_bean($template->body_html,$contact->module_dir,$result);

      $emailObj = new Email(); 

      $defaults = $emailObj->getSystemDefaultEmail(); 
      
      $mail = new SugarPHPMailer(); 

      $mail->setMailerForSystem(); 
      $mail->From = $defaults['email']; 
      $mail->FromName = $defaults['name']; 
      
      $mail->Subject = $template->subject; 
      $mail->Body = $template->body_html; 
      $mail->prepForOutbound(); 
      $mail->AddAddress($result['email_address']);
      $mail->isHTML(true); 
      // print_r($mail);exit();
      @$mail->Send(); 
        // $this->sendEmail($template->subject,$template->body_html,$result['email_address']); 
      
  }

  
  return TRUE;
}

function Participant_Followup()
{
	global $db, $sugar_config;
	$today = date('Y-m-d');
	$result = $db->query("SELECT 
					contacts_cstm.nomination_letter_date_c,
					email_addresses.email_address,
					contacts.first_name,
					project.name as programme_name,
     project_cstm.start_date_c as start_date
				FROM contacts
				INNER JOIN contacts_cstm ON contacts_cstm.id_c = contacts.id
				INNER JOIN email_addr_bean_rel ON email_addr_bean_rel.bean_id = contacts.id
				INNER JOIN email_addresses ON email_addresses.id = email_addr_bean_rel.email_address_id
				INNER JOIN project_contacts_2_c ON project_contacts_2_c.project_contacts_2contacts_idb = contacts.id
				INNER JOIN project ON project.id = project_contacts_2_c.project_contacts_2project_ida
				INNER JOIN project_cstm ON project_cstm.id_c = project.id
    LEFT JOIN contacts_scrm_travel_details_1_c ON contacts_scrm_travel_details_1_c.contacts_scrm_travel_details_1contacts_ida = contacts.id
				WHERE contacts.deleted = '0'
				AND contacts_cstm.nomination_status_c = 'Accepted'
				AND project_cstm.start_date_c > '{$today}'
				AND project.deleted = '0'
    AND contacts_scrm_travel_details_1_c.contacts_scrm_travel_details_1contacts_ida IS NULL
		");

   require_once('modules/EmailTemplates/EmailTemplate.php');

   $template = new EmailTemplate();
   
	while ($row = $db->fetchByAssoc($result)) {
		// $GLOBALS['log']->fatal('nominations: '.print_r($row,true));
  // return true;
  $nal_date = $row['nomination_letter_date_c'];
		$sd = $row['start_date'];
		$date1 = new DateTime("{$nal_date}");
  $date2 = new DateTime("{$today}");
		$date3 = new DateTime("{$sd}");

  $diff = $date2->diff($date1)->format("%a");
		$diff2 = $date3->diff($date2)->format("%a");

  if ($diff2 == 3 || $diff2 == 2 || $diff2 == 1) {

      $template->retrieve_by_string_fields(array('id' => '368ebe1e-95f7-88cd-e133-59d25c4d90f6','type'=>'email'));  
   
      $template->body_html = str_replace('first_name', $row['first_name'], $template->body_html);
      $template->body_html = str_replace('programme_name', $row['programme_name'], $template->body_html);
      $template->body_html = str_replace('portal_url', $sugar_config['portal_url'], $template->body_html);

      if ($sugar_config['appInTesting']) {
        sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);            
      }else{
        sendEmail($template->subject,$template->body_html,$row['email_address']);            
      }      
   //    $GLOBALS['log']->fatal('difference 2: '.print_r($template->body_html,true));
   // return true;        
  }else{
    if ($diff != 0 && ($diff % 4) == 0) {
      $template->retrieve_by_string_fields(array('id' => '368ebe1e-95f7-88cd-e133-59d25c4d90f6','type'=>'email'));  
      $template->body_html = str_replace('name', $row['first_name'], $template->body_html);
      $template->body_html = str_replace('programme_name', $row['programme_name'], $template->body_html);
      $template->body_html = str_replace('portal_url', $sugar_config['portal_url'], $template->body_html);
      
      if ($sugar_config['appInTesting']) {
        $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);            
      }else{
        $this->sendEmail($template->subject,$template->body_html,$row['email_address']);            
      }
    }      
  }

  // $GLOBALS['log']->fatal('difference 1: '.print_r($diff,true));
		// $GLOBALS['log']->fatal('difference 2: '.print_r($diff2,true));

	}

	return true;
}

function sendEmail($subject,$body,$email)
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
?>
