<?php
$module_name = 'scrm_Session_Information';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'scrm_timetable_scrm_session_information_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1_FROM_SCRM_TIMETABLE_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1SCRM_TIMETABLE_IDA',
        'name' => 'scrm_timetable_scrm_session_information_1_name',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'scrm_timetable_scrm_session_information_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1_FROM_SCRM_TIMETABLE_TITLE',
        'id' => 'SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1SCRM_TIMETABLE_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'scrm_timetable_scrm_session_information_1_name',
      ),
      'faculty_name_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_FACULTY_NAME',
        'width' => '10%',
        'name' => 'faculty_name_c',
      ),
      'end_time_c' => 
      array (
        'type' => 'datetimecombo',
        'default' => true,
        'label' => 'LBL_END_TIME',
        'width' => '10%',
        'name' => 'end_time_c',
      ),
      'start_time_c' => 
      array (
        'type' => 'datetimecombo',
        'default' => true,
        'label' => 'LBL_START_TIME',
        'width' => '10%',
        'name' => 'start_time_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
