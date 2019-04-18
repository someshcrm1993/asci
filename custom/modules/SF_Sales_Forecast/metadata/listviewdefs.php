<?php
$module_name = 'SF_Sales_Forecast';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'USERS_SF_SALES_FORECAST_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
    'id' => 'USERS_SF_SALES_FORECAST_1USERS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'SALES_TARGET' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_SALES_TARGET',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'OPPORTUNITIES_WON' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_OPPORTUNITIES_WON',
    'currency_format' => true,
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
