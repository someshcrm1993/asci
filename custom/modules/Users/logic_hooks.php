<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_login'] = Array(); 
$hook_array['after_login'][] = Array(1, 'SugarFeed old feed entry remover', 'modules/SugarFeed/SugarFeedFlush.php','SugarFeedFlush', 'flushStaleEntries'); 

$hook_array['after_login'][] = Array(2, 'Default_Search', 'custom/modules/Users/defaultSearch.php','defaultSearch', 'filterList'); 

$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(2, 'Default_Search', 'custom/modules/Users/defaultSearch.php','defaultSearch', 'updatefilter'); 

$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(2, 'after save logic hook', 'custom/modules/Users/after_save.php','after_save_class', 'after_save_method'); 

?>
