<?php
// created: 2018-01-06 00:02:04
$dictionary["scrm_Feedback"]["fields"]["scrm_feedback_contacts_1"] = array (
  'name' => 'scrm_feedback_contacts_1',
  'type' => 'link',
  'relationship' => 'scrm_feedback_contacts_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'scrm_feedback_contacts_1contacts_idb',
);
$dictionary["scrm_Feedback"]["fields"]["scrm_feedback_contacts_1_name"] = array (
  'name' => 'scrm_feedback_contacts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'scrm_feedback_contacts_1contacts_idb',
  'link' => 'scrm_feedback_contacts_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_Feedback"]["fields"]["scrm_feedback_contacts_1contacts_idb"] = array (
  'name' => 'scrm_feedback_contacts_1contacts_idb',
  'type' => 'link',
  'relationship' => 'scrm_feedback_contacts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_CONTACTS_TITLE',
);
