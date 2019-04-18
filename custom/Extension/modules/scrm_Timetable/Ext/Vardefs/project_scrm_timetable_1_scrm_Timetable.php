<?php
// created: 2017-05-18 16:59:39
$dictionary["scrm_Timetable"]["fields"]["project_scrm_timetable_1"] = array (
  'name' => 'project_scrm_timetable_1',
  'type' => 'link',
  'relationship' => 'project_scrm_timetable_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_timetable_1project_ida',
);
$dictionary["scrm_Timetable"]["fields"]["project_scrm_timetable_1_name"] = array (
  'name' => 'project_scrm_timetable_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_timetable_1project_ida',
  'link' => 'project_scrm_timetable_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Timetable"]["fields"]["project_scrm_timetable_1project_ida"] = array (
  'name' => 'project_scrm_timetable_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_timetable_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_PROJECT_SCRM_TIMETABLE_1_FROM_PROJECT_TITLE',
);
