<?php
// created: 2017-07-13 19:01:21
$dictionary["scrm_Programme_Information"]["fields"]["scrm_work_order_scrm_programme_information_1"] = array (
  'name' => 'scrm_work_order_scrm_programme_information_1',
  'type' => 'link',
  'relationship' => 'scrm_work_order_scrm_programme_information_1',
  'source' => 'non-db',
  'module' => 'scrm_Work_Order',
  'bean_name' => 'scrm_Work_Order',
  'vname' => 'LBL_SCRM_WORK_ORDER_SCRM_PROGRAMME_INFORMATION_1_FROM_SCRM_WORK_ORDER_TITLE',
  'id_name' => 'scrm_work_order_scrm_programme_information_1scrm_work_order_ida',
);
$dictionary["scrm_Programme_Information"]["fields"]["scrm_work_order_scrm_programme_information_1_name"] = array (
  'name' => 'scrm_work_order_scrm_programme_information_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_WORK_ORDER_SCRM_PROGRAMME_INFORMATION_1_FROM_SCRM_WORK_ORDER_TITLE',
  'save' => true,
  'id_name' => 'scrm_work_order_scrm_programme_information_1scrm_work_order_ida',
  'link' => 'scrm_work_order_scrm_programme_information_1',
  'table' => 'scrm_work_order',
  'module' => 'scrm_Work_Order',
  'rname' => 'name',
);
$dictionary["scrm_Programme_Information"]["fields"]["scrm_work_order_scrm_programme_information_1scrm_work_order_ida"] = array (
  'name' => 'scrm_work_order_scrm_programme_information_1scrm_work_order_ida',
  'type' => 'link',
  'relationship' => 'scrm_work_order_scrm_programme_information_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_WORK_ORDER_SCRM_PROGRAMME_INFORMATION_1_FROM_SCRM_PROGRAMME_INFORMATION_TITLE',
);
