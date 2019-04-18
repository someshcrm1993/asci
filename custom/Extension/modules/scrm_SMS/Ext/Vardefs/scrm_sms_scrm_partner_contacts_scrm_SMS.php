<?php
// created: 2016-08-30 16:53:27
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partner_contacts"] = array (
  'name' => 'scrm_sms_scrm_partner_contacts',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_partner_contacts',
  'source' => 'non-db',
  'module' => 'scrm_Partner_Contacts',
  'bean_name' => 'scrm_Partner_Contacts',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNER_CONTACTS_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'id_name' => 'scrm_sms_scrm_partner_contactsscrm_partner_contacts_ida',
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partner_contacts_name"] = array (
  'name' => 'scrm_sms_scrm_partner_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNER_CONTACTS_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'scrm_sms_scrm_partner_contactsscrm_partner_contacts_ida',
  'link' => 'scrm_sms_scrm_partner_contacts',
  'table' => 'scrm_partner_contacts',
  'module' => 'scrm_Partner_Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partner_contactsscrm_partner_contacts_ida"] = array (
  'name' => 'scrm_sms_scrm_partner_contactsscrm_partner_contacts_ida',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_partner_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNER_CONTACTS_FROM_SCRM_SMS_TITLE',
);
