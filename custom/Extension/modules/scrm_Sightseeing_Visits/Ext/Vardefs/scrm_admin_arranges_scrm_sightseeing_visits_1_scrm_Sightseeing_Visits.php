<?php
// created: 2017-05-17 12:44:54
$dictionary["scrm_Sightseeing_Visits"]["fields"]["scrm_admin_arranges_scrm_sightseeing_visits_1"] = array (
  'name' => 'scrm_admin_arranges_scrm_sightseeing_visits_1',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_scrm_sightseeing_visits_1',
  'source' => 'non-db',
  'module' => 'scrm_Admin_Arranges',
  'bean_name' => 'scrm_Admin_Arranges',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SIGHTSEEING_VISITS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'id_name' => 'scrm_admin813crranges_ida',
);
$dictionary["scrm_Sightseeing_Visits"]["fields"]["scrm_admin_arranges_scrm_sightseeing_visits_1_name"] = array (
  'name' => 'scrm_admin_arranges_scrm_sightseeing_visits_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SIGHTSEEING_VISITS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'save' => true,
  'id_name' => 'scrm_admin813crranges_ida',
  'link' => 'scrm_admin_arranges_scrm_sightseeing_visits_1',
  'table' => 'scrm_admin_arranges',
  'module' => 'scrm_Admin_Arranges',
  'rname' => 'name',
);
$dictionary["scrm_Sightseeing_Visits"]["fields"]["scrm_admin813crranges_ida"] = array (
  'name' => 'scrm_admin813crranges_ida',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_scrm_sightseeing_visits_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SIGHTSEEING_VISITS_1_FROM_SCRM_SIGHTSEEING_VISITS_TITLE',
);
