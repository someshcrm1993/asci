<?php
$module_name = 'scrm_Timetable';
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
        1 => 
        array (
          1 => 
          array (
            'name' => 'project_scrm_timetable_1_name',
            'label' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_PROJECT_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>
