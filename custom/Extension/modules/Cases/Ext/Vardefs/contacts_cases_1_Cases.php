<?php
// created: 2016-04-14 21:37:39
$dictionary["Case"]["fields"]["contacts_cases_1"] = array (
  'name' => 'contacts_cases_1',
  'type' => 'link',
  'relationship' => 'contacts_cases_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_cases_1contacts_ida',
);
$dictionary["Case"]["fields"]["contacts_cases_1_name"] = array (
  'name' => 'contacts_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_cases_1contacts_ida',
  'link' => 'contacts_cases_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Case"]["fields"]["contacts_cases_1contacts_ida"] = array (
  'name' => 'contacts_cases_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_CASES_1_FROM_CASES_TITLE',
);
