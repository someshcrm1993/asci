<?php
// created: 2016-08-26 19:36:08
$dictionary["scrm_partners_aos_products_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_partners_aos_products_1' => 
    array (
      'lhs_module' => 'scrm_Partners',
      'lhs_table' => 'scrm_partners',
      'lhs_key' => 'id',
      'rhs_module' => 'AOS_Products',
      'rhs_table' => 'aos_products',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_partners_aos_products_1_c',
      'join_key_lhs' => 'scrm_partners_aos_products_1scrm_partners_ida',
      'join_key_rhs' => 'scrm_partners_aos_products_1aos_products_idb',
    ),
  ),
  'table' => 'scrm_partners_aos_products_1_c',
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
      'name' => 'scrm_partners_aos_products_1scrm_partners_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_partners_aos_products_1aos_products_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_partners_aos_products_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_partners_aos_products_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_partners_aos_products_1scrm_partners_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_partners_aos_products_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_partners_aos_products_1aos_products_idb',
      ),
    ),
  ),
);