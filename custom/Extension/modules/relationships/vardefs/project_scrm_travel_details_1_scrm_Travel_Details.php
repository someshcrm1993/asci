<?php
// created: 2017-05-17 13:27:07
$dictionary["scrm_Travel_Details"]["fields"]["project_scrm_travel_details_1"] = array (
  'name' => 'project_scrm_travel_details_1',
  'type' => 'link',
  'relationship' => 'project_scrm_travel_details_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_TRAVEL_DETAILS_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_travel_details_1project_ida',
);
$dictionary["scrm_Travel_Details"]["fields"]["project_scrm_travel_details_1_name"] = array (
  'name' => 'project_scrm_travel_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_TRAVEL_DETAILS_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_travel_details_1project_ida',
  'link' => 'project_scrm_travel_details_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Travel_Details"]["fields"]["project_scrm_travel_details_1project_ida"] = array (
  'name' => 'project_scrm_travel_details_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_travel_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_TRAVEL_DETAILS_TITLE',
);
