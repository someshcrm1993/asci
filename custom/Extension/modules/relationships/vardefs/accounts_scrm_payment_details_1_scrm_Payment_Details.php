<?php
// created: 2017-12-04 16:57:21
$dictionary["scrm_Payment_Details"]["fields"]["accounts_scrm_payment_details_1"] = array (
  'name' => 'accounts_scrm_payment_details_1',
  'type' => 'link',
  'relationship' => 'accounts_scrm_payment_details_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_SCRM_PAYMENT_DETAILS_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_scrm_payment_details_1accounts_ida',
);
$dictionary["scrm_Payment_Details"]["fields"]["accounts_scrm_payment_details_1_name"] = array (
  'name' => 'accounts_scrm_payment_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_SCRM_PAYMENT_DETAILS_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_scrm_payment_details_1accounts_ida',
  'link' => 'accounts_scrm_payment_details_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["scrm_Payment_Details"]["fields"]["accounts_scrm_payment_details_1accounts_ida"] = array (
  'name' => 'accounts_scrm_payment_details_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_scrm_payment_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_SCRM_PAYMENT_DETAILS_1_FROM_SCRM_PAYMENT_DETAILS_TITLE',
);
