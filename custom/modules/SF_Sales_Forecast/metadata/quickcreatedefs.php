<?php
$module_name = 'SF_Sales_Forecast';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'users_sf_sales_forecast_1_name',
            'label' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
          ),
          1 => 
          array (
            'name' => 'sales_target',
            'label' => 'LBL_SALES_TARGET',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'opportunities_won',
            'label' => 'LBL_OPPORTUNITIES_WON',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
