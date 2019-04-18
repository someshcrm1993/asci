<?php
// created: 2016-05-10 11:52:23
$dictionary["users_sf_sales_forecast_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'users_sf_sales_forecast_1' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'SF_Sales_Forecast',
      'rhs_table' => 'sf_sales_forecast',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'users_sf_sales_forecast_1_c',
      'join_key_lhs' => 'users_sf_sales_forecast_1users_ida',
      'join_key_rhs' => 'users_sf_sales_forecast_1sf_sales_forecast_idb',
    ),
  ),
  'table' => 'users_sf_sales_forecast_1_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'users_sf_sales_forecast_1users_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'users_sf_sales_forecast_1sf_sales_forecast_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'users_sf_sales_forecast_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'users_sf_sales_forecast_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'users_sf_sales_forecast_1users_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'users_sf_sales_forecast_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'users_sf_sales_forecast_1sf_sales_forecast_idb',
      ),
    ),
  ),
);