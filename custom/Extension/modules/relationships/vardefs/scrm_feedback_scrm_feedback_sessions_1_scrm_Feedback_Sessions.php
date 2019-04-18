<?php
// created: 2017-07-28 12:01:28
$dictionary["scrm_Feedback_Sessions"]["fields"]["scrm_feedback_scrm_feedback_sessions_1"] = array (
  'name' => 'scrm_feedback_scrm_feedback_sessions_1',
  'type' => 'link',
  'relationship' => 'scrm_feedback_scrm_feedback_sessions_1',
  'source' => 'non-db',
  'module' => 'scrm_Feedback',
  'bean_name' => 'scrm_Feedback',
  'vname' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1_FROM_SCRM_FEEDBACK_TITLE',
  'id_name' => 'scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida',
);
$dictionary["scrm_Feedback_Sessions"]["fields"]["scrm_feedback_scrm_feedback_sessions_1_name"] = array (
  'name' => 'scrm_feedback_scrm_feedback_sessions_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1_FROM_SCRM_FEEDBACK_TITLE',
  'save' => true,
  'id_name' => 'scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida',
  'link' => 'scrm_feedback_scrm_feedback_sessions_1',
  'table' => 'scrm_feedback',
  'module' => 'scrm_Feedback',
  'rname' => 'document_name',
);
$dictionary["scrm_Feedback_Sessions"]["fields"]["scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida"] = array (
  'name' => 'scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida',
  'type' => 'link',
  'relationship' => 'scrm_feedback_scrm_feedback_sessions_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1_FROM_SCRM_FEEDBACK_SESSIONS_TITLE',
);
