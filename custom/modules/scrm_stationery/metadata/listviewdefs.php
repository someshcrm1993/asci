<?php
$module_name = 'scrm_stationery';
$listViewDefs [$module_name] = 
array (
  'ITEMS_C' => 
  array (
    'type' => 'enum',
    'link' => true,
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ITEMS',
    'width' => '10%',
  ),
  'FACULTY_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_FACULTY',
    'width' => '10%',
  ),
  'TOTAL_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_TOTAL',
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
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
);
?>
