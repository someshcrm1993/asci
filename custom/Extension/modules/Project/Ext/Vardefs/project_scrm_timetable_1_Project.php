<?php
// created: 2017-05-18 16:59:39
$dictionary["Project"]["fields"]["project_scrm_timetable_1"] = array (
  'name' => 'project_scrm_timetable_1',
  'type' => 'link',
  'relationship' => 'project_scrm_timetable_1',
  'source' => 'non-db',
  'module' => 'scrm_Timetable',
  'bean_name' => 'scrm_Timetable',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_SCRM_TIMETABLE_TITLE',
  'id_name' => 'project_scrm_timetable_1scrm_timetable_idb',
);
$dictionary["Project"]["fields"]["project_scrm_timetable_1_name"] = array (
  'name' => 'project_scrm_timetable_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_SCRM_TIMETABLE_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_timetable_1scrm_timetable_idb',
  'link' => 'project_scrm_timetable_1',
  'table' => 'scrm_timetable',
  'module' => 'scrm_Timetable',
  'rname' => 'name',
);
$dictionary["Project"]["fields"]["project_scrm_timetable_1scrm_timetable_idb"] = array (
  'name' => 'project_scrm_timetable_1scrm_timetable_idb',
  'type' => 'link',
  'relationship' => 'project_scrm_timetable_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_SCRM_TIMETABLE_TITLE',
);
