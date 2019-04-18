<?php
// created: 2017-08-16 09:54:24
$dictionary["project_scrm_programme_objective_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'project_scrm_programme_objective_1' => 
    array (
      'lhs_module' => 'Project',
      'lhs_table' => 'project',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Programme_Objective',
      'rhs_table' => 'scrm_programme_objective',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'project_scrm_programme_objective_1_c',
      'join_key_lhs' => 'project_scrm_programme_objective_1project_ida',
      'join_key_rhs' => 'project_scrm_programme_objective_1scrm_programme_objective_idb',
    ),
  ),
  'table' => 'project_scrm_programme_objective_1_c',
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
      'name' => 'project_scrm_programme_objective_1project_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'project_scrm_programme_objective_1scrm_programme_objective_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'project_scrm_programme_objective_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'project_scrm_programme_objective_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'project_scrm_programme_objective_1project_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'project_scrm_programme_objective_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'project_scrm_programme_objective_1scrm_programme_objective_idb',
      ),
    ),
  ),
);