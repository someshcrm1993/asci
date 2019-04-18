<?php
$module_name = 'scrm_Programme_Objective';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'FIRST_OBJECTIVE_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_FIRST_OBJECTIVE',
    'sortable' => false,
    'width' => '10%',
  ),
  'SECOND_OBJECTIVE_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SECOND_OBJECTIVE',
    'sortable' => false,
    'width' => '10%',
  ),
  'THIRD_OBJECTIVE_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_THIRD_OBJECTIVE',
    'sortable' => false,
    'width' => '10%',
  ),
  'FOURTH_OBJECTIVE_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_FOURTH_OBJECTIVE',
    'sortable' => false,
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
