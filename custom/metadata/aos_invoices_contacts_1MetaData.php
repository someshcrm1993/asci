<?php
// created: 2017-05-27 12:30:09
$dictionary["aos_invoices_contacts_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'aos_invoices_contacts_1' => 
    array (
      'lhs_module' => 'AOS_Invoices',
      'lhs_table' => 'aos_invoices',
      'lhs_key' => 'id',
      'rhs_module' => 'Contacts',
      'rhs_table' => 'contacts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'aos_invoices_contacts_1_c',
      'join_key_lhs' => 'aos_invoices_contacts_1aos_invoices_ida',
      'join_key_rhs' => 'aos_invoices_contacts_1contacts_idb',
    ),
  ),
  'table' => 'aos_invoices_contacts_1_c',
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
      'name' => 'aos_invoices_contacts_1aos_invoices_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'aos_invoices_contacts_1contacts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'aos_invoices_contacts_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'aos_invoices_contacts_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'aos_invoices_contacts_1aos_invoices_ida',
        1 => 'aos_invoices_contacts_1contacts_idb',
      ),
    ),
  ),
);