<?php
// created: 2016-06-08 10:51:18
$dictionary["Lead"]["fields"]["scrm_partner_contacts_leads"] = array (
  'name' => 'scrm_partner_contacts_leads',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_leads',
  'source' => 'non-db',
  'module' => 'scrm_Partner_Contacts',
  'bean_name' => false,
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_LEADS_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'id_name' => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
);
$dictionary["Lead"]["fields"]["scrm_partner_contacts_leads_name"] = array (
  'name' => 'scrm_partner_contacts_leads_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_LEADS_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
  'link' => 'scrm_partner_contacts_leads',
  'table' => 'scrm_partner_contacts',
  'module' => 'scrm_Partner_Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Lead"]["fields"]["scrm_partner_contacts_leadsscrm_partner_contacts_ida"] = array (
  'name' => 'scrm_partner_contacts_leadsscrm_partner_contacts_ida',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_leads',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_LEADS_FROM_LEADS_TITLE',
);
