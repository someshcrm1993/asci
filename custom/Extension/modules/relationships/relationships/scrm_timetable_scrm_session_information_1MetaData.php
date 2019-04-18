<?php
// created: 2017-05-19 14:33:38
$dictionary["scrm_timetable_scrm_session_information_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_timetable_scrm_session_information_1' => 
    array (
      'lhs_module' => 'scrm_Timetable',
      'lhs_table' => 'scrm_timetable',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Session_Information',
      'rhs_table' => 'scrm_session_information',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_timetable_scrm_session_information_1_c',
      'join_key_lhs' => 'scrm_timetable_scrm_session_information_1scrm_timetable_ida',
      'join_key_rhs' => 'scrm_timetc7f4rmation_idb',
    ),
  ),
  'table' => 'scrm_timetable_scrm_session_information_1_c',
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
      'name' => 'scrm_timetable_scrm_session_information_1scrm_timetable_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_timetc7f4rmation_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_timetable_scrm_session_information_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_timetable_scrm_session_information_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_timetable_scrm_session_information_1scrm_timetable_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_timetable_scrm_session_information_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_timetc7f4rmation_idb',
      ),
    ),
  ),
);