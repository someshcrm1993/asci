<?php
// created: 2016-08-26 19:36:08
$dictionary["AOS_Products"]["fields"]["scrm_partners_aos_products_1"] = array (
  'name' => 'scrm_partners_aos_products_1',
  'type' => 'link',
  'relationship' => 'scrm_partners_aos_products_1',
  'source' => 'non-db',
  'module' => 'scrm_Partners',
  'bean_name' => 'scrm_Partners',
  'vname' => 'LBL_SCRM_PARTNERS_AOS_PRODUCTS_1_FROM_SCRM_PARTNERS_TITLE',
  'id_name' => 'scrm_partners_aos_products_1scrm_partners_ida',
);
$dictionary["AOS_Products"]["fields"]["scrm_partners_aos_products_1_name"] = array (
  'name' => 'scrm_partners_aos_products_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNERS_AOS_PRODUCTS_1_FROM_SCRM_PARTNERS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partners_aos_products_1scrm_partners_ida',
  'link' => 'scrm_partners_aos_products_1',
  'table' => 'scrm_partners',
  'module' => 'scrm_Partners',
  'rname' => 'name',
);
$dictionary["AOS_Products"]["fields"]["scrm_partners_aos_products_1scrm_partners_ida"] = array (
  'name' => 'scrm_partners_aos_products_1scrm_partners_ida',
  'type' => 'link',
  'relationship' => 'scrm_partners_aos_products_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNERS_AOS_PRODUCTS_1_FROM_AOS_PRODUCTS_TITLE',
);
