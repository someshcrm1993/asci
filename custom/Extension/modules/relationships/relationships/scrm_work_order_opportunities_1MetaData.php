<?php
// created: 2017-06-16 13:05:19
$dictionary["scrm_work_order_opportunities_1"] = array (
  'true_relationship_type' => 'one-to-one',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_work_order_opportunities_1' => 
    array (
      'lhs_module' => 'scrm_Work_Order',
      'lhs_table' => 'scrm_work_order',
      'lhs_key' => 'id',
      'rhs_module' => 'Opportunities',
      'rhs_table' => 'opportunities',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_work_order_opportunities_1_c',
      'join_key_lhs' => 'scrm_work_order_opportunities_1scrm_work_order_ida',
      'join_key_rhs' => 'scrm_work_order_opportunities_1opportunities_idb',
    ),
  ),
  'table' => 'scrm_work_order_opportunities_1_c',
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
      'name' => 'scrm_work_order_opportunities_1scrm_work_order_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_work_order_opportunities_1opportunities_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_work_order_opportunities_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_work_order_opportunities_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_work_order_opportunities_1scrm_work_order_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_work_order_opportunities_1_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_work_order_opportunities_1opportunities_idb',
      ),
    ),
  ),
);