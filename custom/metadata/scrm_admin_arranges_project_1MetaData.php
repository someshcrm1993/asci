<?php
// created: 2017-05-17 14:47:52
$dictionary["scrm_admin_arranges_project_1"] = array (
  'true_relationship_type' => 'one-to-one',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_admin_arranges_project_1' => 
    array (
      'lhs_module' => 'scrm_Admin_Arranges',
      'lhs_table' => 'scrm_admin_arranges',
      'lhs_key' => 'id',
      'rhs_module' => 'Project',
      'rhs_table' => 'project',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_admin_arranges_project_1_c',
      'join_key_lhs' => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
      'join_key_rhs' => 'scrm_admin_arranges_project_1project_idb',
    ),
  ),
  'table' => 'scrm_admin_arranges_project_1_c',
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
      'name' => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_admin_arranges_project_1project_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_admin_arranges_project_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_admin_arranges_project_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_admin_arranges_project_1_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_admin_arranges_project_1project_idb',
      ),
    ),
  ),
);