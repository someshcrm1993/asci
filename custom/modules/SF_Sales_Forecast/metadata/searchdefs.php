<?php
$module_name = 'SF_Sales_Forecast';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'users_sf_sales_forecast_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
        'id' => 'USERS_SF_SALES_FORECAST_1USERS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'users_sf_sales_forecast_1_name',
      ),
      'sales_target' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_SALES_TARGET',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'sales_target',
      ),
      'opportunities_won' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_OPPORTUNITIES_WON',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'opportunities_won',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
