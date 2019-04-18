<?php
$module_name = 'scrm_Session_Information';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" value="Save" name="button" onclick="this.form.action.value=\'Save\'; if(  check_form(\'EditView\') && checkStatus())return true;else return false;" class="button primary" accesskey="S" title="Save [Alt+S]">',
          ),
          1 => 'CANCEL',
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
          0 => 'name',
          1 => 
          array (
            'name' => 'faculty_id_c',
            'studio' => 'visible',
            'label' => 'LBL_FACULTY_ID_C',
          ),
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
        4 => 
        array (
          0 => 
          array (
            'name' => 'faculty_name_c',
            'label' => 'LBL_FACULTY_NAME',
          ),
          1 => 
          array (
            'name' => 'add_to_feedback_c',
            'label' => 'LBL_ADD_TO_FEEDBACK',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'show_timings_c',
            'label' => 'LBL_SHOW_TIMINGS',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
