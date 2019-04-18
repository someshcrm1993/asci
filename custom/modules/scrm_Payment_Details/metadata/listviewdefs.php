<?php
$module_name = 'scrm_Payment_Details';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'INVOICE_NUMBER_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_INVOICE_NUMBER',
    'width' => '10%',
  ),
  'FEES_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_FEES',
    'currency_format' => true,
    'width' => '10%',
  ),
  'PAYMENT_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_PAYMENT_DATE',
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
