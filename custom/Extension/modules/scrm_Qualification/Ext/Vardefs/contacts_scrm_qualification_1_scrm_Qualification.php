<?php
// created: 2017-05-24 12:51:17
$dictionary["scrm_Qualification"]["fields"]["contacts_scrm_qualification_1"] = array (
  'name' => 'contacts_scrm_qualification_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_qualification_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_SCRM_QUALIFICATION_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_scrm_qualification_1contacts_ida',
);
$dictionary["scrm_Qualification"]["fields"]["contacts_scrm_qualification_1_name"] = array (
  'name' => 'contacts_scrm_qualification_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_QUALIFICATION_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_qualification_1contacts_ida',
  'link' => 'contacts_scrm_qualification_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_Qualification"]["fields"]["contacts_scrm_qualification_1contacts_ida"] = array (
  'name' => 'contacts_scrm_qualification_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_scrm_qualification_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_SCRM_QUALIFICATION_1_FROM_SCRM_QUALIFICATION_TITLE',
);
