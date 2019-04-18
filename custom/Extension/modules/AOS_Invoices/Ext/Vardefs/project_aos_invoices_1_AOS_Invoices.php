<?php
// created: 2017-05-27 12:32:25
$dictionary["AOS_Invoices"]["fields"]["project_aos_invoices_1"] = array (
  'name' => 'project_aos_invoices_1',
  'type' => 'link',
  'relationship' => 'project_aos_invoices_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_AOS_INVOICES_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_aos_invoices_1project_ida',
);
$dictionary["AOS_Invoices"]["fields"]["project_aos_invoices_1_name"] = array (
  'name' => 'project_aos_invoices_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_AOS_INVOICES_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_aos_invoices_1project_ida',
  'link' => 'project_aos_invoices_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["AOS_Invoices"]["fields"]["project_aos_invoices_1project_ida"] = array (
  'name' => 'project_aos_invoices_1project_ida',
  'type' => 'link',
  'relationship' => 'project_aos_invoices_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_AOS_INVOICES_1_FROM_AOS_INVOICES_TITLE',
);
