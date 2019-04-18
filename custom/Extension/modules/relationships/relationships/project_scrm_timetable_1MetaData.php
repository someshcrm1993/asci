<?php
// created: 2017-05-18 16:59:38
$dictionary["project_scrm_timetable_1"] = array (
  'true_relationship_type' => 'one-to-one',
  'from_studio' => true,
  'relationships' => 
  array (
    'project_scrm_timetable_1' => 
    array (
      'lhs_module' => 'Project',
      'lhs_table' => 'project',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Timetable',
      'rhs_table' => 'scrm_timetable',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'project_scrm_timetable_1_c',
      'join_key_lhs' => 'project_scrm_timetable_1project_ida',
      'join_key_rhs' => 'project_scrm_timetable_1scrm_timetable_idb',
    ),
  ),
  'table' => 'project_scrm_timetable_1_c',
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
      'name' => 'project_scrm_timetable_1project_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'project_scrm_timetable_1scrm_timetable_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'project_scrm_timetable_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'project_scrm_timetable_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'project_scrm_timetable_1project_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'project_scrm_timetable_1_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'project_scrm_timetable_1scrm_timetable_idb',
      ),
    ),
  ),
);