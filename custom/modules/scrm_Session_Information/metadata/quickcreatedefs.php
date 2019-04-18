<?php
$module_name = 'scrm_Session_Information';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" name="save" id="save" onClick="this.form.return_action.value=\'DetailViewthis.form.action.value=\'Save return custom_function(\'EditView\');" value="Save">',
          ),
        ),
      ),
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
          0 => 
          array (
            'name' => 'scrm_timetable_scrm_session_information_1_name',
            'label' => 'LBL_SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1_FROM_SCRM_TIMETABLE_TITLE',
          ),
        ),
        1 => 
        array (
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
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'faculty_name_c',
            'label' => 'LBL_FACULTY_NAME',
          ),
        ),
      ),
    ),
  ),
);
?>
