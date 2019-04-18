<?php
// created: 2017-06-01 11:56:43
$dictionary["scrm_Accommodation"]["fields"]["project_scrm_accommodation_1"] = array (
  'name' => 'project_scrm_accommodation_1',
  'type' => 'link',
  'relationship' => 'project_scrm_accommodation_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_accommodation_1project_ida',
);
$dictionary["scrm_Accommodation"]["fields"]["project_scrm_accommodation_1_name"] = array (
  'name' => 'project_scrm_accommodation_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_accommodation_1project_ida',
  'link' => 'project_scrm_accommodation_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Accommodation"]["fields"]["project_scrm_accommodation_1project_ida"] = array (
  'name' => 'project_scrm_accommodation_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_accommodation_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_SCRM_ACCOMMODATION_TITLE',
);
