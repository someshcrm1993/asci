<?php
// created: 2017-07-11 14:02:18
$dictionary["Account"]["fields"]["scrm_partner_contacts_accounts_1"] = array (
  'name' => 'scrm_partner_contacts_accounts_1',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_accounts_1',
  'source' => 'non-db',
  'module' => 'scrm_Partner_Contacts',
  'bean_name' => 'scrm_Partner_Contacts',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_ACCOUNTS_1_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'id_name' => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
);
$dictionary["Account"]["fields"]["scrm_partner_contacts_accounts_1_name"] = array (
  'name' => 'scrm_partner_contacts_accounts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_ACCOUNTS_1_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
  'link' => 'scrm_partner_contacts_accounts_1',
  'table' => 'scrm_partner_contacts',
  'module' => 'scrm_Partner_Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Account"]["fields"]["scrm_partner_contacts_accounts_1scrm_partner_contacts_ida"] = array (
  'name' => 'scrm_partner_contacts_accounts_1scrm_partner_contacts_ida',
  'type' => 'link',
  'relationship' => 'scrm_partner_contacts_accounts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNER_CONTACTS_ACCOUNTS_1_FROM_ACCOUNTS_TITLE',
);
