<?php
$module_name = 'scrm_Sightseeing_Visits';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'START_DATE_TIME_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_START_DATE_TIME',
    'width' => '10%',
  ),
  'END_DATE_TIME_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_END_DATE_TIME',
    'width' => '10%',
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
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
