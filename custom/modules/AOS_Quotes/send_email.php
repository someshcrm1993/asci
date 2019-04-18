<?php
ini_set("display_errors", 'On');
if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;
$quote_id = $_REQUEST['id'];
$proforma_invoice_bean = BeanFactory::getBean('AOS_Quotes', $quote_id);

$parent = 'Accounts';
$parentID = $proforma_invoice_bean->billing_account_id;
$billing_account = $proforma_invoice_bean->billing_account;
$db->query("update aos_quotes_cstm set proforma_stage_c = 'Proforma sent to client' where id_c = '$proforma_invoice_bean->id'");
$module_type ='AOS_Quotes';
$preBodyHTML = "<pre>Hi $billing_account,

Please find the attachment.</pre>";

require_once('modules/Emails/Email.php');
global $current_user, $mod_strings, $sugar_config;
//First Create e-mail draft
		$email = new Email();
		// set the id for relationships
		$email->id = create_guid();
		$email->new_with_id = true;

		//subject
		$email->name = $subject;
		$email->description_html = $preBodyHTML;
		//type is draft
		$email->type = "draft";
		$email->status = "draft";
		$email->assigned_user_id = $current_user->id;
		$email->modified_user_id = $current_user->id;
		$email->created_by = $current_user->id;
		$email->parent_id=$parentID;
		$email->parent_type=$parent;
		$email->to_addrs ='';
		global $timedate;
		$email->date_start = $timedate->to_display_date_time(gmdate($GLOBALS['timedate']->get_db_date_time_format()));
		$email->save(FALSE);
		$email_id = $email->id;
        //$file_name = 'proforma_'.date('YmdHis').'.pdf';
        $file_name = $_SESSION["proformaPDF"];

		$note = new Note();
		$note->modified_user_id = $current_user->id;
		$note->created_by = $current_user->id;
		$note->name = $file_name;
		$note->parent_type = 'Emails';
		$note->parent_id = $email_id;
		$note->file_mime_type = 'application/pdf';
		$note->filename = $file_name;
		$note->save();
		//~ rename($sugar_config['upload_dir'].'attachmentfile.pdf',$sugar_config['upload_dir'].$note->id);
		rename($sugar_config['upload_dir'].$file_name,$sugar_config['upload_dir'].$note->id);

		if($email_id=="") {
			echo "Unable to initiate Email Client";
			exit;
		} else {
		header("Location: index.php?action=Compose&module=Emails&return_module=".$module_type."&return_action=DetailView&return_id=".$_REQUEST['id']."&recordId=".$email_id);
		}
?>
