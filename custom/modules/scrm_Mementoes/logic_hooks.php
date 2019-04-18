<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 

$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(77, 'updateFields', 'custom/modules/scrm_Mementoes/updateFieldsLogicHook.php','updateFields', 'updateFields'); 

$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'updateFields', 'custom/modules/scrm_Mementoes/updateFieldsLogicHook.php','updateFieldsList', 'updateFieldsList'); 
?>
