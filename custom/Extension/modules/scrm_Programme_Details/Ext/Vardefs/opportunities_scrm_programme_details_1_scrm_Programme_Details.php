<?php
// created: 2017-07-06 15:01:12
$dictionary["scrm_Programme_Details"]["fields"]["opportunities_scrm_programme_details_1"] = array (
  'name' => 'opportunities_scrm_programme_details_1',
  'type' => 'link',
  'relationship' => 'opportunities_scrm_programme_details_1',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_OPPORTUNITIES_SCRM_PROGRAMME_DETAILS_1_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_scrm_programme_details_1opportunities_ida',
);
$dictionary["scrm_Programme_Details"]["fields"]["opportunities_scrm_programme_details_1_name"] = array (
  'name' => 'opportunities_scrm_programme_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OPPORTUNITIES_SCRM_PROGRAMME_DETAILS_1_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_scrm_programme_details_1opportunities_ida',
  'link' => 'opportunities_scrm_programme_details_1',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["scrm_Programme_Details"]["fields"]["opportunities_scrm_programme_details_1opportunities_ida"] = array (
  'name' => 'opportunities_scrm_programme_details_1opportunities_ida',
  'type' => 'link',
  'relationship' => 'opportunities_scrm_programme_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_SCRM_PROGRAMME_DETAILS_1_FROM_SCRM_PROGRAMME_DETAILS_TITLE',
);
