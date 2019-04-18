<?php
// created: 2017-06-16 13:05:20
$dictionary["Opportunity"]["fields"]["scrm_work_order_opportunities_1"] = array (
  'name' => 'scrm_work_order_opportunities_1',
  'type' => 'link',
  'relationship' => 'scrm_work_order_opportunities_1',
  'source' => 'non-db',
  'module' => 'scrm_Work_Order',
  'bean_name' => 'scrm_Work_Order',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_SCRM_WORK_ORDER_TITLE',
  'id_name' => 'scrm_work_order_opportunities_1scrm_work_order_ida',
);
$dictionary["Opportunity"]["fields"]["scrm_work_order_opportunities_1_name"] = array (
  'name' => 'scrm_work_order_opportunities_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_SCRM_WORK_ORDER_TITLE',
  'save' => true,
  'id_name' => 'scrm_work_order_opportunities_1scrm_work_order_ida',
  'link' => 'scrm_work_order_opportunities_1',
  'table' => 'scrm_work_order',
  'module' => 'scrm_Work_Order',
  'rname' => 'name',
);
$dictionary["Opportunity"]["fields"]["scrm_work_order_opportunities_1scrm_work_order_ida"] = array (
  'name' => 'scrm_work_order_opportunities_1scrm_work_order_ida',
  'type' => 'link',
  'relationship' => 'scrm_work_order_opportunities_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_SCRM_WORK_ORDER_TITLE',
);
