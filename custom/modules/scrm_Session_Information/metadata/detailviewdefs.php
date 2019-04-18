<?php
$module_name = 'scrm_Session_Information';
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
          0 => 
          array (
            'name' => 'scrm_timetable_scrm_session_information_1_name',
          ),
          1 => 
          array (
            'name' => 'slot_c',
            'label' => 'LBL_SLOT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'faculty_name_c',
            'label' => 'LBL_FACULTY_NAME',
          ),
          1 => 'name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'start_time_c',
            'label' => 'LBL_START_TIME',
          ),
          1 => 
          array (
            'name' => 'end_time_c',
            'label' => 'LBL_END_TIME',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
