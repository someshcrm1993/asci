<?php
// created: 2017-06-21 19:31:20
$dictionary["securitygroups_scrm_timetable_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'securitygroups_scrm_timetable_1' => 
    array (
      'lhs_module' => 'SecurityGroups',
      'lhs_table' => 'securitygroups',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Timetable',
      'rhs_table' => 'scrm_timetable',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'securitygroups_scrm_timetable_1_c',
      'join_key_lhs' => 'securitygroups_scrm_timetable_1securitygroups_ida',
      'join_key_rhs' => 'securitygroups_scrm_timetable_1scrm_timetable_idb',
    ),
  ),
  'table' => 'securitygroups_scrm_timetable_1_c',
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
      'name' => 'securitygroups_scrm_timetable_1securitygroups_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'securitygroups_scrm_timetable_1scrm_timetable_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'securitygroups_scrm_timetable_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'securitygroups_scrm_timetable_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'securitygroups_scrm_timetable_1securitygroups_ida',
        1 => 'securitygroups_scrm_timetable_1scrm_timetable_idb',
      ),
    ),
  ),
);