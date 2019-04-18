<?php
$listViewDefs ['Project'] = 
array (
  'NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
  ),
  'PROGRAMME_TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PROGRAMME_TYPE',
    'width' => '10%',
  ),
  'PROGRAMME_ID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PROGRAMME_ID',
    'width' => '10%',
  ),
  'START_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_START_DATE',
    'width' => '10%',
  ),
  'END_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_END_DATE',
    'width' => '10%',
  ),
  'PRIORITY' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_PRIORITY',
    'width' => '10%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'ESTIMATED_END_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_END',
    'link' => false,
    'default' => false,
  ),
  'NO_OF_PARTICIPANTS_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_NO_OF_PARTICIPANTS',
    'width' => '10%',
  ),
  'ESTIMATED_START_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_START',
    'link' => false,
    'default' => false,
  ),
  'BV_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_BV',
    'width' => '10%',
  ),
  'CPC_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_CPC',
    'width' => '10%',
  ),
);
?>
