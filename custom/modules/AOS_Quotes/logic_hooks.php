<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array();
$hook_array['after_save'][] = Array(1, 'Discount Approval', 'custom/modules/AOS_Quotes/DiscountApproval.php','DiscountApproval', 'discount_approval');

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'relate the participant list with proforma invoice', 'custom/modules/AOS_Quotes/lineitems.php','lineitems', 'relateList');
?>
