<?php
// created: 2017-07-28 15:12:46
$dictionary["scrm_Feedback"]["fields"]["project_scrm_feedback_1"] = array (
  'name' => 'project_scrm_feedback_1',
  'type' => 'link',
  'relationship' => 'project_scrm_feedback_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_FEEDBACK_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_feedback_1project_ida',
);
$dictionary["scrm_Feedback"]["fields"]["project_scrm_feedback_1_name"] = array (
  'name' => 'project_scrm_feedback_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_FEEDBACK_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_feedback_1project_ida',
  'link' => 'project_scrm_feedback_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Feedback"]["fields"]["project_scrm_feedback_1project_ida"] = array (
  'name' => 'project_scrm_feedback_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_feedback_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_SCRM_FEEDBACK_1_FROM_SCRM_FEEDBACK_TITLE',
);
