<?php
// created: 2017-07-06 15:01:12
$dictionary["opportunities_scrm_programme_details_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'opportunities_scrm_programme_details_1' => 
    array (
      'lhs_module' => 'Opportunities',
      'lhs_table' => 'opportunities',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Programme_Details',
      'rhs_table' => 'scrm_programme_details',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'opportunities_scrm_programme_details_1_c',
      'join_key_lhs' => 'opportunities_scrm_programme_details_1opportunities_ida',
      'join_key_rhs' => 'opportunities_scrm_programme_details_1scrm_programme_details_idb',
    ),
  ),
  'table' => 'opportunities_scrm_programme_details_1_c',
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
      'name' => 'opportunities_scrm_programme_details_1opportunities_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'opportunities_scrm_programme_details_1scrm_programme_details_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'opportunities_scrm_programme_details_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'opportunities_scrm_programme_details_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'opportunities_scrm_programme_details_1opportunities_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'opportunities_scrm_programme_details_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'opportunities_scrm_programme_details_1scrm_programme_details_idb',
      ),
    ),
  ),
);