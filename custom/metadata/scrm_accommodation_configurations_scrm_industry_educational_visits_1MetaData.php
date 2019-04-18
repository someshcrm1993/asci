<?php
// created: 2017-06-28 13:25:25
$dictionary["scrm_accommodation_configurations_scrm_industry_educational_visits_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_accommodation_configurations_scrm_industry_educational_visits_1' => 
    array (
      'lhs_module' => 'scrm_accommodation_configurations',
      'lhs_table' => 'scrm_accommodation_configurations',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Industry_Educational_Visits',
      'rhs_table' => 'scrm_industry_educational_visits',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_accom911c_visits_1_c',
      'join_key_lhs' => 'scrm_accom4287rations_ida',
      'join_key_rhs' => 'scrm_accomd279_visits_idb',
    ),
  ),
  'table' => 'scrm_accom911c_visits_1_c',
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
      'name' => 'scrm_accom4287rations_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_accomd279_visits_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_accomc262al_visits_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_accomc262al_visits_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_accom4287rations_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_accomc262al_visits_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_accomd279_visits_idb',
      ),
    ),
  ),
);