<?php
// created: 2017-07-11 14:02:17
$dictionary["scrm_partner_contacts_accounts_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_partner_contacts_accounts_1' => 
    array (
      'lhs_module' => 'scrm_Partner_Contacts',
      'lhs_table' => 'scrm_partner_contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_partner_contacts_accounts_1_c',
      'join_key_lhs' => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
      'join_key_rhs' => 'scrm_partner_contacts_accounts_1accounts_idb',
    ),
  ),
  'table' => 'scrm_partner_contacts_accounts_1_c',
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
      'name' => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_partner_contacts_accounts_1accounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_partner_contacts_accounts_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_partner_contacts_accounts_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_partner_contacts_accounts_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_partner_contacts_accounts_1accounts_idb',
      ),
    ),
  ),
);