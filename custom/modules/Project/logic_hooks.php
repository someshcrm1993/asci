<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function

$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(1, 'Delete Project Tasks', 'custom/modules/Project/delete_project_tasks.php','delete_project_tasks', 'delete_tasks');

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(2, 'After save actions', 'custom/modules/Project/logic_hook_class.php','logic_hook_class', 'after_save_method');

// $hook_array['after_delete'] = Array();
$hook_array['before_delete'][] = Array(2, 'Delete Dependencies', 'custom/modules/Project/logic_hook_class.php','logic_hook_class', 'after_delete');

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'Generate programme code if confirmed', 'custom/modules/Project/generateprgcode.php','GeneratePrgCode', 'generate_code');
$hook_array['before_save'][] = Array(2, 'Before save actions', 'custom/modules/Project/logic_hook_class.php','logic_hook_class', 'before_save');

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(
    //Processing index. For sorting the array.
    1,
   
    //Label. A string value to identify the hook.
    'nominee list view color coding',
   
    //The PHP file where your class is located.
    'custom/modules/Project/ColorCoding.php',
   
    //The class the method is in.
    'ColorCoding',
   
    //The method to call.
    'showstatus'
);

?>