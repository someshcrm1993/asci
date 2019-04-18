<?php
// created: 2016-08-30 16:53:27
$dictionary["scrm_sms_scrm_partners"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'scrm_sms_scrm_partners' => 
    array (
      'lhs_module' => 'scrm_Partners',
      'lhs_table' => 'scrm_partners',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_SMS',
      'rhs_table' => 'scrm_sms',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_sms_scrm_partners_c',
      'join_key_lhs' => 'scrm_sms_scrm_partnersscrm_partners_ida',
      'join_key_rhs' => 'scrm_sms_scrm_partnersscrm_sms_idb',
    ),
  ),
  'table' => 'scrm_sms_scrm_partners_c',
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
      'name' => 'scrm_sms_scrm_partnersscrm_partners_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_sms_scrm_partnersscrm_sms_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_sms_scrm_partnersspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_sms_scrm_partners_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_sms_scrm_partnersscrm_partners_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_sms_scrm_partners_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_sms_scrm_partnersscrm_sms_idb',
      ),
    ),
  ),
);