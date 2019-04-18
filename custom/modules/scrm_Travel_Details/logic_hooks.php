<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'save name', 'custom/modules/scrm_Travel_Details/saveName.php','saveName', 'updateName');

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'after save logic hook', 'custom/modules/scrm_Travel_Details/after_save.php','after_save_class', 'after_save_method');
?>