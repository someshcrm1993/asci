<?php
$module_name = 'scrm_Timetable';
$viewdefs [$module_name] = 
array (
  'EditView' => 
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
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'project_scrm_timetable_1_name',
          ),
          1 => 
          array (
            'name' => 'start_date_c',
            'label' => 'LBL_START_DATE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'end_date_c',
            'label' => 'LBL_END_DATE',
          ),
          1 => 
          array (
            'name' => 'no_of_days_c',
            'label' => 'LBL_NO_OF_DAYS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'programme_code_c',
            'label' => 'LBL_PROGRAMME_CODE',
          ),
        ),
        3 => 
        array (
          0 => 'assigned_user_name',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'finalise_c',
            'studio' => 'visible',
            'label' => 'LBL_FINALISE',
          ),
        ),
      ),
    ),
  ),
);
?>
