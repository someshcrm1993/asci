<?php
// created: 2017-06-30 11:58:52
$dictionary["Document"]["fields"]["aos_invoices_documents_1"] = array (
  'name' => 'aos_invoices_documents_1',
  'type' => 'link',
  'relationship' => 'aos_invoices_documents_1',
  'source' => 'non-db',
  'module' => 'AOS_Invoices',
  'bean_name' => 'AOS_Invoices',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_AOS_INVOICES_TITLE',
  'id_name' => 'aos_invoices_documents_1aos_invoices_ida',
);
$dictionary["Document"]["fields"]["aos_invoices_documents_1_name"] = array (
  'name' => 'aos_invoices_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_AOS_INVOICES_TITLE',
  'save' => true,
  'id_name' => 'aos_invoices_documents_1aos_invoices_ida',
  'link' => 'aos_invoices_documents_1',
  'table' => 'aos_invoices',
  'module' => 'AOS_Invoices',
  'rname' => 'name',
);
$dictionary["Document"]["fields"]["aos_invoices_documents_1aos_invoices_ida"] = array (
  'name' => 'aos_invoices_documents_1aos_invoices_ida',
  'type' => 'link',
  'relationship' => 'aos_invoices_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
