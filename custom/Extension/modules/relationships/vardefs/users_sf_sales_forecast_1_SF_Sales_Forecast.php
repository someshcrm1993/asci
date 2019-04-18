<?php
// created: 2016-05-10 11:52:23
$dictionary["SF_Sales_Forecast"]["fields"]["users_sf_sales_forecast_1"] = array (
  'name' => 'users_sf_sales_forecast_1',
  'type' => 'link',
  'relationship' => 'users_sf_sales_forecast_1',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'vname' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
  'id_name' => 'users_sf_sales_forecast_1users_ida',
);
$dictionary["SF_Sales_Forecast"]["fields"]["users_sf_sales_forecast_1_name"] = array (
  'name' => 'users_sf_sales_forecast_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
  'save' => true,
  'id_name' => 'users_sf_sales_forecast_1users_ida',
  'link' => 'users_sf_sales_forecast_1',
  'table' => 'users',
  'module' => 'Users',
  'rname' => 'name',
);
$dictionary["SF_Sales_Forecast"]["fields"]["users_sf_sales_forecast_1users_ida"] = array (
  'name' => 'users_sf_sales_forecast_1users_ida',
  'type' => 'link',
  'relationship' => 'users_sf_sales_forecast_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_SF_SALES_FORECAST_TITLE',
);
