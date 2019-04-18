<?php
// created: 2016-08-30 16:53:27
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_sms_template"] = array (
  'name' => 'scrm_sms_scrm_sms_template',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_sms_template',
  'source' => 'non-db',
  'module' => 'scrm_SMS_Template',
  'bean_name' => 'scrm_SMS_Template',
  'vname' => 'LBL_SCRM_SMS_SCRM_SMS_TEMPLATE_FROM_SCRM_SMS_TEMPLATE_TITLE',
  'id_name' => 'scrm_sms_scrm_sms_templatescrm_sms_template_ida',
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_sms_template_name"] = array (
  'name' => 'scrm_sms_scrm_sms_template_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_SMS_SCRM_SMS_TEMPLATE_FROM_SCRM_SMS_TEMPLATE_TITLE',
  'save' => true,
  'id_name' => 'scrm_sms_scrm_sms_templatescrm_sms_template_ida',
  'link' => 'scrm_sms_scrm_sms_template',
  'table' => 'scrm_sms_template',
  'module' => 'scrm_SMS_Template',
  'rname' => 'name',
);
$dictionary["scrm_SMS"]["fields"]["scrm_sms_scrm_sms_templatescrm_sms_template_ida"] = array (
  'name' => 'scrm_sms_scrm_sms_templatescrm_sms_template_ida',
  'type' => 'link',
  'relationship' => 'scrm_sms_scrm_sms_template',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_SMS_SCRM_SMS_TEMPLATE_FROM_SCRM_SMS_TITLE',
);
