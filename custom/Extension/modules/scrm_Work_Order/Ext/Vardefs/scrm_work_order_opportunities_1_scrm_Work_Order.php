<?php
// created: 2017-06-16 13:05:20
$dictionary["scrm_Work_Order"]["fields"]["scrm_work_order_opportunities_1"] = array (
  'name' => 'scrm_work_order_opportunities_1',
  'type' => 'link',
  'relationship' => 'scrm_work_order_opportunities_1',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'scrm_work_order_opportunities_1opportunities_idb',
);
$dictionary["scrm_Work_Order"]["fields"]["scrm_work_order_opportunities_1_name"] = array (
  'name' => 'scrm_work_order_opportunities_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'scrm_work_order_opportunities_1opportunities_idb',
  'link' => 'scrm_work_order_opportunities_1',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["scrm_Work_Order"]["fields"]["scrm_work_order_opportunities_1opportunities_idb"] = array (
  'name' => 'scrm_work_order_opportunities_1opportunities_idb',
  'type' => 'link',
  'relationship' => 'scrm_work_order_opportunities_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_WORK_ORDER_OPPORTUNITIES_1_FROM_OPPORTUNITIES_TITLE',
);
