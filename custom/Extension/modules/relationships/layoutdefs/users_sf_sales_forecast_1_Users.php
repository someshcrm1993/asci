<?php
 // created: 2016-05-10 11:52:23
$layout_defs["Users"]["subpanel_setup"]['users_sf_sales_forecast_1'] = array (
  'order' => 100,
  'module' => 'SF_Sales_Forecast',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_SF_SALES_FORECAST_TITLE',
  'get_subpanel_data' => 'users_sf_sales_forecast_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
