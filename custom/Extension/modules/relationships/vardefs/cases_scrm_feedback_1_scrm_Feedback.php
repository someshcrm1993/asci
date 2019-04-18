<?php
// created: 2016-04-05 10:58:43
$dictionary["scrm_Feedback"]["fields"]["cases_scrm_feedback_1"] = array (
  'name' => 'cases_scrm_feedback_1',
  'type' => 'link',
  'relationship' => 'cases_scrm_feedback_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES_SCRM_FEEDBACK_1_FROM_CASES_TITLE',
  'id_name' => 'cases_scrm_feedback_1cases_ida',
);
$dictionary["scrm_Feedback"]["fields"]["cases_scrm_feedback_1_name"] = array (
  'name' => 'cases_scrm_feedback_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_SCRM_FEEDBACK_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'cases_scrm_feedback_1cases_ida',
  'link' => 'cases_scrm_feedback_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["scrm_Feedback"]["fields"]["cases_scrm_feedback_1cases_ida"] = array (
  'name' => 'cases_scrm_feedback_1cases_ida',
  'type' => 'link',
  'relationship' => 'cases_scrm_feedback_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CASES_SCRM_FEEDBACK_1_FROM_SCRM_FEEDBACK_TITLE',
);
