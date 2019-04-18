<?php
// created: 2017-07-06 17:25:58
$dictionary["scrm_Travel_Details"]["fields"]["scrm_partners_scrm_travel_details_1"] = array (
  'name' => 'scrm_partners_scrm_travel_details_1',
  'type' => 'link',
  'relationship' => 'scrm_partners_scrm_travel_details_1',
  'source' => 'non-db',
  'module' => 'scrm_Partners',
  'bean_name' => 'scrm_Partners',
  'vname' => 'LBL_SCRM_PARTNERS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_PARTNERS_TITLE',
  'id_name' => 'scrm_partners_scrm_travel_details_1scrm_partners_ida',
);
$dictionary["scrm_Travel_Details"]["fields"]["scrm_partners_scrm_travel_details_1_name"] = array (
  'name' => 'scrm_partners_scrm_travel_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNERS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_PARTNERS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partners_scrm_travel_details_1scrm_partners_ida',
  'link' => 'scrm_partners_scrm_travel_details_1',
  'table' => 'scrm_partners',
  'module' => 'scrm_Partners',
  'rname' => 'name',
);
$dictionary["scrm_Travel_Details"]["fields"]["scrm_partners_scrm_travel_details_1scrm_partners_ida"] = array (
  'name' => 'scrm_partners_scrm_travel_details_1scrm_partners_ida',
  'type' => 'link',
  'relationship' => 'scrm_partners_scrm_travel_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNERS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_TRAVEL_DETAILS_TITLE',
);
