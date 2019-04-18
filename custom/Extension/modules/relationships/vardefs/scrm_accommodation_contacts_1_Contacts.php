<?php
// created: 2017-07-17 18:47:01
$dictionary["Contact"]["fields"]["scrm_accommodation_contacts_1"] = array (
  'name' => 'scrm_accommodation_contacts_1',
  'type' => 'link',
  'relationship' => 'scrm_accommodation_contacts_1',
  'source' => 'non-db',
  'module' => 'scrm_Accommodation',
  'bean_name' => 'scrm_Accommodation',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONTACTS_1_FROM_SCRM_ACCOMMODATION_TITLE',
  'id_name' => 'scrm_accommodation_contacts_1scrm_accommodation_ida',
);
$dictionary["Contact"]["fields"]["scrm_accommodation_contacts_1_name"] = array (
  'name' => 'scrm_accommodation_contacts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONTACTS_1_FROM_SCRM_ACCOMMODATION_TITLE',
  'save' => true,
  'id_name' => 'scrm_accommodation_contacts_1scrm_accommodation_ida',
  'link' => 'scrm_accommodation_contacts_1',
  'table' => 'scrm_accommodation',
  'module' => 'scrm_Accommodation',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Contact"]["fields"]["scrm_accommodation_contacts_1scrm_accommodation_ida"] = array (
  'name' => 'scrm_accommodation_contacts_1scrm_accommodation_ida',
  'type' => 'link',
  'relationship' => 'scrm_accommodation_contacts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_ACCOMMODATION_CONTACTS_1_FROM_CONTACTS_TITLE',
);
