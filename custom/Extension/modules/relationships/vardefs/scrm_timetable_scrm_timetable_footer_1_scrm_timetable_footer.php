<?php
// created: 2019-01-03 14:08:49
$dictionary["scrm_timetable_footer"]["fields"]["scrm_timetable_scrm_timetable_footer_1"] = array (
  'name' => 'scrm_timetable_scrm_timetable_footer_1',
  'type' => 'link',
  'relationship' => 'scrm_timetable_scrm_timetable_footer_1',
  'source' => 'non-db',
  'module' => 'scrm_Timetable',
  'bean_name' => 'scrm_Timetable',
  'vname' => 'LBL_SCRM_TIMETABLE_SCRM_TIMETABLE_FOOTER_1_FROM_SCRM_TIMETABLE_TITLE',
  'id_name' => 'scrm_timetable_scrm_timetable_footer_1scrm_timetable_ida',
);
$dictionary["scrm_timetable_footer"]["fields"]["scrm_timetable_scrm_timetable_footer_1_name"] = array (
  'name' => 'scrm_timetable_scrm_timetable_footer_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_TIMETABLE_SCRM_TIMETABLE_FOOTER_1_FROM_SCRM_TIMETABLE_TITLE',
  'save' => true,
  'id_name' => 'scrm_timetable_scrm_timetable_footer_1scrm_timetable_ida',
  'link' => 'scrm_timetable_scrm_timetable_footer_1',
  'table' => 'scrm_timetable',
  'module' => 'scrm_Timetable',
  'rname' => 'name',
);
$dictionary["scrm_timetable_footer"]["fields"]["scrm_timetable_scrm_timetable_footer_1scrm_timetable_ida"] = array (
  'name' => 'scrm_timetable_scrm_timetable_footer_1scrm_timetable_ida',
  'type' => 'link',
  'relationship' => 'scrm_timetable_scrm_timetable_footer_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_TIMETABLE_SCRM_TIMETABLE_FOOTER_1_FROM_SCRM_TIMETABLE_FOOTER_TITLE',
);
