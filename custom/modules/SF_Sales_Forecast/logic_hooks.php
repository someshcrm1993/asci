<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1,'Update the Name of the Sales Target','custom/modules/SF_Sales_Forecast/UpdateName.php','UpdateName','update_name');

$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(2,'Update the Opportunity won','custom/modules/SF_Sales_Forecast/AfterSave.php','AfterSave','AfterSave');
