<?php
// created: 2017-07-11 14:01:43
$dictionary["Contact"]["fields"]["scrm_partner_contacts_contacts_1"] = array (
  'name' => 'scrm_partner_contacts_contacts_1',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_contacts_1',
  'source' => 'non-db',
  'module' => 'scrm_Partner_Contacts',
  'bean_name' => 'scrm_Partner_Contacts',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_CONTACTS_1_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'id_name' => 'scrm_partner_contacts_contacts_1scrm_partner_contacts_ida',
);
$dictionary["Contact"]["fields"]["scrm_partner_contacts_contacts_1_name"] = array (
  'name' => 'scrm_partner_contacts_contacts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_CONTACTS_1_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partner_contacts_contacts_1scrm_partner_contacts_ida',
  'link' => 'scrm_partner_contacts_contacts_1',
  'table' => 'scrm_partner_contacts',
  'module' => 'scrm_Partner_Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Contact"]["fields"]["scrm_partner_contacts_contacts_1scrm_partner_contacts_ida"] = array (
  'name' => 'scrm_partner_contacts_contacts_1scrm_partner_contacts_ida',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_contacts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_CONTACTS_1_FROM_CONTACTS_TITLE',
);
