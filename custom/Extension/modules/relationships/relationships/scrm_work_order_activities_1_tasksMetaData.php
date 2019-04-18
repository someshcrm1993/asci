<?php
// created: 2017-05-26 15:22:48
$dictionary["scrm_work_order_activities_1_tasks"] = array (
  'relationships' => 
  array (
    'scrm_work_order_activities_1_tasks' => 
    array (
      'lhs_module' => 'scrm_Work_Order',
      'lhs_table' => 'scrm_work_order',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
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