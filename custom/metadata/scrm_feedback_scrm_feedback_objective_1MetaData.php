<?php
// created: 2017-07-28 12:02:23
$dictionary["scrm_feedback_scrm_feedback_objective_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_feedback_scrm_feedback_objective_1' => 
    array (
      'lhs_module' => 'scrm_Feedback',
      'lhs_table' => 'scrm_feedback',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Feedback_Objective',
      'rhs_table' => 'scrm_feedback_objective',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_feedback_scrm_feedback_objective_1_c',
      'join_key_lhs' => 'scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida',
      'join_key_rhs' => 'scrm_feedb10e5jective_idb',
    ),
  ),
  'table' => 'scrm_feedback_scrm_feedback_objective_1_c',
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
      'name' => 'scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_feedb10e5jective_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_feedback_scrm_feedback_objective_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_feedback_scrm_feedback_objective_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_feedback_scrm_feedback_objective_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_feedb10e5jective_idb',
      ),
    ),
  ),
);