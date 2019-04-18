<?php
// created: 2016-08-30 16:53:27
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partners"] = array (
  'name' => 'scrm_sms_scrm_partners',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_partners',
  'source' => 'non-db',
  'module' => 'scrm_Partners',
  'bean_name' => 'scrm_Partners',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNERS_FROM_SCRM_PARTNERS_TITLE',
  'id_name' => 'scrm_sms_scrm_partnersscrm_partners_ida',
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partners_name"] = array (
  'name' => 'scrm_sms_scrm_partners_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNERS_FROM_SCRM_PARTNERS_TITLE',
  'save' => true,
  'id_name' => 'scrm_sms_scrm_partnersscrm_partners_ida',
  'link' => 'scrm_sms_scrm_partners',
  'table' => 'scrm_partners',
  'module' => 'scrm_Partners',
  'rname' => 'name',
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_partnersscrm_partners_ida"] = array (
  'name' => 'scrm_sms_scrm_partnersscrm_partners_ida',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_partners',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_SMS_SCRM_PARTNERS_FROM_SCRM_SMS_TITLE',
);
