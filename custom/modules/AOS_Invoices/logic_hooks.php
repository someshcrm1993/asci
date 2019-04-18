<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'relate the participant list with invoice', 'custom/modules/AOS_Invoices/lineitems.php','lineitems', 'relateList');

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'Send Email to FO', 'custom/modules/AOS_Invoices/updateFieldsLogicHook.php','updateFields', 'sendEmailToFO');
?>