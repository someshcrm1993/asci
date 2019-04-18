<?php
$module_name = 'scrm_Budget';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'NO_OF_PARTICIPANTS_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_NO_OF_PARTICIPANTS',
    'width' => '10%',
  ),
  'PRG_FEE_PER_PARTICIPANT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_PRG_FEE_PER_PARTICIPANT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'TOTAL_EXPENDITURE_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_TOTAL_EXPENDITURE',
    'currency_format' => true,
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
