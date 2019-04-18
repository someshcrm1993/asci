<?php
// created: 2016-06-08 10:51:17
$dictionary["scrm_partner_contacts_leads"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'scrm_partner_contacts_leads' => 
    array (
      'lhs_module' => 'scrm_Partner_Contacts',
      'lhs_table' => 'scrm_partner_contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'Leads',
      'rhs_table' => 'leads',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_partner_contacts_leads_c',
      'join_key_lhs' => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
      'join_key_rhs' => 'scrm_partner_contacts_leadsleads_idb',
    ),
  ),
  'table' => 'scrm_partner_contacts_leads_c',
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
      'name' => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_partner_contacts_leadsleads_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_partner_contacts_leadsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_partner_contacts_leads_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_partner_contacts_leads_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_partner_contacts_leadsleads_idb',
      ),
    ),
  ),
);