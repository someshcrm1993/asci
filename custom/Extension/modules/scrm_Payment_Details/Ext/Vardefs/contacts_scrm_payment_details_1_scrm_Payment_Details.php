<?php
// created: 2017-10-05 19:39:44
$dictionary["scrm_Payment_Details"]["fields"]["contacts_scrm_payment_details_1"] = array (
  'name' => 'contacts_scrm_payment_details_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_payment_details_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_SCRM_PAYMENT_DETAILS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_scrm_payment_details_1contacts_ida',
);
$dictionary["scrm_Payment_Details"]["fields"]["contacts_scrm_payment_details_1_name"] = array (
  'name' => 'contacts_scrm_payment_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_PAYMENT_DETAILS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_payment_details_1contacts_ida',
  'link' => 'contacts_scrm_payment_details_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_Payment_Details"]["fields"]["contacts_scrm_payment_details_1contacts_ida"] = array (
  'name' => 'contacts_scrm_payment_details_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_scrm_payment_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_SCRM_PAYMENT_DETAILS_1_FROM_SCRM_PAYMENT_DETAILS_TITLE',
);
