<?php
// created: 2017-06-28 13:25:27
$dictionary["scrm_Industry_Educational_Visits"]["fields"]["scrm_accomc262al_visits_1"] = array (
  'name' => 'scrm_accomc262al_visits_1',
  'type' => 'link',
  'relationship' => 'scrm_accommodation_configurations_scrm_industry_educational_visits_1',
  'source' => 'non-db',
  'module' => 'scrm_accommodation_configurations',
  'bean_name' => 'scrm_accommodation_configurations',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONFIGURATIONS_SCRM_INDUSTRY_EDUCATIONAL_VISITS_1_FROM_SCRM_ACCOMMODATION_CONFIGURATIONS_TITLE',
  'id_name' => 'scrm_accom4287rations_ida',
);
$dictionary["scrm_Industry_Educational_Visits"]["fields"]["scrm_accom0d6dsits_1_name"] = array (
  'name' => 'scrm_accom0d6dsits_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONFIGURATIONS_SCRM_INDUSTRY_EDUCATIONAL_VISITS_1_FROM_SCRM_ACCOMMODATION_CONFIGURATIONS_TITLE',
  'save' => true,
  'id_name' => 'scrm_accom4287rations_ida',
  'link' => 'scrm_accomc262al_visits_1',
  'table' => 'scrm_accommodation_configurations',
  'module' => 'scrm_accommodation_configurations',
  'rname' => 'name',
);
$dictionary["scrm_Industry_Educational_Visits"]["fields"]["scrm_accom4287rations_ida"] = array (
  'name' => 'scrm_accom4287rations_ida',
  'type' => 'link',
  'relationship' => 'scrm_accommodation_configurations_scrm_industry_educational_visits_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONFIGURATIONS_SCRM_INDUSTRY_EDUCATIONAL_VISITS_1_FROM_SCRM_INDUSTRY_EDUCATIONAL_VISITS_TITLE',
);
