<?php

    $admin_option_defs = array();
    $admin_option_defs['Administration']['dashboard_manager'] = array(
        //Icon name. Available icons are located in ./themes/default/images
        'Administration',
        
        //Link name label 
        'LBL_LINK_NAME',
        
        //Link description label
        'LBL_LINK_DESCRIPTION',
        
        //Link URL
        './index.php?module=dash_dashboard_manager&action=copy_dashboard',
    );

    $admin_group_header[] = array(
        //Section header label
        'LBL_SECTION_HEADER',
        
        //$other_text parameter for get_form_header()
        '',
        
        //$show_help parameter for get_form_header()
        false,
        
        //Section links
        $admin_option_defs, 
        
        //Section description label
        'LBL_SECTION_DESCRIPTION'
    );
    ?>
