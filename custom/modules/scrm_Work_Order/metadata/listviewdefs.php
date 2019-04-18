<?php
$module_name = 'scrm_Work_Order';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PROPOSAL_ID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PROPOSAL_ID',
    'width' => '10%',
  ),
  'ACCOUNTS_SCRM_WORK_ORDER_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ACCOUNTS_SCRM_WORK_ORDER_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNTS_SCRM_WORK_ORDER_1ACCOUNTS_IDA',
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
