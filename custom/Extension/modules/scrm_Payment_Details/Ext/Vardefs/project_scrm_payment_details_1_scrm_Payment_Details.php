<?php
// created: 2017-12-04 16:55:43
$dictionary["scrm_Payment_Details"]["fields"]["project_scrm_payment_details_1"] = array (
  'name' => 'project_scrm_payment_details_1',
  'type' => 'link',
  'relationship' => 'project_scrm_payment_details_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_PAYMENT_DETAILS_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_payment_details_1project_ida',
);
$dictionary["scrm_Payment_Details"]["fields"]["project_scrm_payment_details_1_name"] = array (
  'name' => 'project_scrm_payment_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_PAYMENT_DETAILS_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_payment_details_1project_ida',
  'link' => 'project_scrm_payment_details_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Payment_Details"]["fields"]["project_scrm_payment_details_1project_ida"] = array (
  'name' => 'project_scrm_payment_details_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_payment_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_SCRM_PAYMENT_DETAILS_1_FROM_SCRM_PAYMENT_DETAILS_TITLE',
);
