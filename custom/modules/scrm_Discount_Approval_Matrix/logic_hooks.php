<?php

    $hook_version = 1;
    $hook_array = Array();

    $hook_array['before_save'] = Array();
    $hook_array['before_save'][] = Array(
        //Processing index. For sorting the array.
        1,
       
        //Label. A string value to identify the hook.
        'to save the name of the team',
       
        //The PHP file where your class is located.
        'custom/modules/scrm_Discount_Approval_Matrix/SaveName.php',
       
        //The class the method is in.
        'BeforeSave',
       
        //The method to call.
        'before_save_method'
    );

?>
