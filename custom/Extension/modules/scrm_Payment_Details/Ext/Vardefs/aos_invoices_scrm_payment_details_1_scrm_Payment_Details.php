<?php
// created: 2017-12-04 16:58:02
$dictionary["scrm_Payment_Details"]["fields"]["aos_invoices_scrm_payment_details_1"] = array (
  'name' => 'aos_invoices_scrm_payment_details_1',
  'type' => 'link',
  'relationship' => 'aos_invoices_scrm_payment_details_1',
  'source' => 'non-db',
  'module' => 'AOS_Invoices',
  'bean_name' => 'AOS_Invoices',
  'vname' => 'LBL_AOS_INVOICES_SCRM_PAYMENT_DETAILS_1_FROM_AOS_INVOICES_TITLE',
  'id_name' => 'aos_invoices_scrm_payment_details_1aos_invoices_ida',
);
$dictionary["scrm_Payment_Details"]["fields"]["aos_invoices_scrm_payment_details_1_name"] = array (
  'name' => 'aos_invoices_scrm_payment_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_INVOICES_SCRM_PAYMENT_DETAILS_1_FROM_AOS_INVOICES_TITLE',
  'save' => true,
  'id_name' => 'aos_invoices_scrm_payment_details_1aos_invoices_ida',
  'link' => 'aos_invoices_scrm_payment_details_1',
  'table' => 'aos_invoices',
  'module' => 'AOS_Invoices',
  'rname' => 'name',
);
$dictionary["scrm_Payment_Details"]["fields"]["aos_invoices_scrm_payment_details_1aos_invoices_ida"] = array (
  'name' => 'aos_invoices_scrm_payment_details_1aos_invoices_ida',
  'type' => 'link',
  'relationship' => 'aos_invoices_scrm_payment_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_INVOICES_SCRM_PAYMENT_DETAILS_1_FROM_SCRM_PAYMENT_DETAILS_TITLE',
);
