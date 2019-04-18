<?php
// created: 2017-06-12 17:49:10
$dictionary["scrm_Work_Order"]["fields"]["accounts_scrm_work_order_1"] = array (
  'name' => 'accounts_scrm_work_order_1',
  'type' => 'link',
  'relationship' => 'accounts_scrm_work_order_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_SCRM_WORK_ORDER_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_scrm_work_order_1accounts_ida',
);
$dictionary["scrm_Work_Order"]["fields"]["accounts_scrm_work_order_1_name"] = array (
  'name' => 'accounts_scrm_work_order_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_SCRM_WORK_ORDER_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_scrm_work_order_1accounts_ida',
  'link' => 'accounts_scrm_work_order_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["scrm_Work_Order"]["fields"]["accounts_scrm_work_order_1accounts_ida"] = array (
  'name' => 'accounts_scrm_work_order_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_scrm_work_order_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_SCRM_WORK_ORDER_1_FROM_SCRM_WORK_ORDER_TITLE',
);
