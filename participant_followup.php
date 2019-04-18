<?php 
	// if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	if(!defined('sugarEntry')) define('sugarEntry', true);
	require_once('include/entryPoint.php');

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
  $nal_date = $row['nomination_letter_date_c'];
		$sd = $row['start_date'];
		$date1 = new DateTime("{$nal_date}");
  $date2 = new DateTime("{$today}");
		$date3 = new DateTime("{$sd}");

  $diff = $date2->diff($date1)->format("%a");
		$diff2 = $date3->diff($date2)->format("%a");

    if ($diff2 == 3 || $diff2 == 2 || $diff2 == 1) {
        $template->retrieve_by_string_fields(array('id' => '368ebe1e-95f7-88cd-e133-59d25c4d90f6','type'=>'email')); 
        print_r($template->body_html);exit(); 
        $template->body_html = str_replace('name', $row['first_name'], $template->body_html);
        $template->body_html = str_replace('programme_name', $row['programme_name'], $template->body_html);
        $template->body_html = str_replace('portal_url', $sugar_config['portal_url'], $template->body_html);
        
        if ($sugar_config['appInTesting']) {
          $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);            
        }else{
          $this->sendEmail($template->subject,$template->body_html,$row['email_address']);            
        }      
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


?>