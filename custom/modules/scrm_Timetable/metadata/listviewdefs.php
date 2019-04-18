<?php
$module_name = 'scrm_Timetable';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'END_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_END_DATE',
    'width' => '10%',
  ),
  'NO_OF_DAYS_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_NO_OF_DAYS',
    'width' => '10%',
  ),
  'START_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_START_DATE',
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
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'PROJECT_SCRM_TIMETABLE_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_PROJECT_TITLE',
    'id' => 'PROJECT_SCRM_TIMETABLE_1PROJECT_IDA',
    'width' => '10%',
    'default' => false,
  ),
);
?>
