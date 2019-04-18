<?php
$module_name = 'scrm_Industry_Educational_Visits';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
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
      'syncDetailEditViews' => true,
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
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_time_to_c',
            'label' => 'LBL_DATE_TIME_TO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'address_location_c',
            'studio' => 'visible',
            'label' => 'LBL_ADDRESS_LOCATION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_industry_educational_visits_1_name',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
