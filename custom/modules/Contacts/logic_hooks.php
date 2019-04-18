<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 

$hook_array['before_save'] = Array(); 
// $hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'custom/modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateGeocodeInfo'); 
$hook_array['before_save'][] = Array(1, 'Contacts push feed', 'modules/Contacts/SugarFeeds/ContactFeed.php','ContactFeed', 'pushFeed');
$hook_array['after_save'] = Array(); 
// $hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'custom/modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo'); 
$hook_array['after_save'][] = Array(1, 'Update Portal', 'custom/modules/Contacts/updatePortal.php','updatePortal', 'updateUser'); 

$hook_array['after_save'][] = Array(2, 'Update Program Code', 'custom/modules/Contacts/update_program_code.php','update_program_code', 'program_code');
// $hook_array['after_save'][] = Array(1, 'after save logic hook', 'custom/modules/Contacts/after_save.php','after_save_class', 'after_save_method'); 

// $hook_array['after_save'][] = Array(1, 'Update description', 'custom/modules/Contacts/update_description_contact.php','UpdateDescriptionContact', 'updateDescriptionFunctionContact'); 
$hook_array['after_save'][] = Array(1, 'Link contact with lead', 'custom/modules/Contacts/linkcontactlead.php','linkContactLead', 'relateContactLead'); 

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(
    //Processing index. For sorting the array.
    1,
   
    //Label. A string value to identify the hook.
    'nominee list view color coding',
   
    //The PHP file where your class is located.
    'custom/modules/Contacts/ColorCoding.php',
   
    //The class the method is in.
    'NomineeColorCoding',
   
    //The method to call.
    'showstatus'
);
?>
