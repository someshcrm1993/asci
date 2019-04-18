<?php
// created: 2017-05-26 15:22:48
$dictionary["scrm_work_order_activities_1_emails"] = array (
  'relationships' => 
  array (
    'scrm_work_order_activities_1_emails' => 
    array (
      'lhs_module' => 'scrm_Work_Order',
      'lhs_table' => 'scrm_work_order',
      'lhs_key' => 'id',
      'rhs_module' => 'Emails',
      'rhs_table' => 'emails',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'scrm_Work_Order',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);