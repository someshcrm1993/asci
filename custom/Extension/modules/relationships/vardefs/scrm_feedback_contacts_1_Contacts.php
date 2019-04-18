<?php
// created: 2018-01-06 00:02:04
$dictionary["Contact"]["fields"]["scrm_feedback_contacts_1"] = array (
  'name' => 'scrm_feedback_contacts_1',
  'type' => 'link',
  'relationship' => 'scrm_feedback_contacts_1',
  'source' => 'non-db',
  'module' => 'scrm_Feedback',
  'bean_name' => 'scrm_Feedback',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_SCRM_FEEDBACK_TITLE',
  'id_name' => 'scrm_feedback_contacts_1scrm_feedback_ida',
);
$dictionary["Contact"]["fields"]["scrm_feedback_contacts_1_name"] = array (
  'name' => 'scrm_feedback_contacts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_SCRM_FEEDBACK_TITLE',
  'save' => true,
  'id_name' => 'scrm_feedback_contacts_1scrm_feedback_ida',
  'link' => 'scrm_feedback_contacts_1',
  'table' => 'scrm_feedback',
  'module' => 'scrm_Feedback',
  'rname' => 'document_name',
);
$dictionary["Contact"]["fields"]["scrm_feedback_contacts_1scrm_feedback_ida"] = array (
  'name' => 'scrm_feedback_contacts_1scrm_feedback_ida',
  'type' => 'link',
  'relationship' => 'scrm_feedback_contacts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_SCRM_FEEDBACK_TITLE',
);
