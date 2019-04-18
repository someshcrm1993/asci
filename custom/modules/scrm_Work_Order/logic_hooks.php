<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'Update fields', 'custom/modules/scrm_Work_Order/customisations.php','Customisations', 'updatefields'); 
$hook_array['after_save'][] = Array(1, 'after save logic hook', 'custom/modules/scrm_Work_Order/after_save.php','after_save_class', 'after_save'); 


?>
