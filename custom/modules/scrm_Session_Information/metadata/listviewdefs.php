<?php
$module_name = 'scrm_Session_Information';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1_FROM_SCRM_TIMETABLE_TITLE',
    'id' => 'SCRM_TIMETABLE_SCRM_SESSION_INFORMATION_1SCRM_TIMETABLE_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'START_TIME_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_START_TIME',
    'width' => '10%',
  ),
  'END_TIME_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_END_TIME',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
?>
