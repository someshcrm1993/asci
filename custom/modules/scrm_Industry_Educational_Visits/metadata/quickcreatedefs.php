<?php
$module_name = 'scrm_Industry_Educational_Visits';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'participants_c',
            'label' => 'LBL_PARTICIPANTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_time_c',
            'label' => 'LBL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'date_time_to_c',
            'label' => 'LBL_DATE_TIME_TO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'address_location_c',
            'studio' => 'visible',
            'label' => 'LBL_ADDRESS_LOCATION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_industry_educational_visits_1_name',
            'label' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_INDUSTRY_EDUCATIONAL_VISITS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
