<?php
// created: 2017-06-30 16:50:34
$dictionary["Contact"]["fields"]["contacts_scrm_travel_details_1"] = array (
  'name' => 'contacts_scrm_travel_details_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_travel_details_1',
  'source' => 'non-db',
  'module' => 'scrm_Travel_Details',
  'bean_name' => 'scrm_Travel_Details',
  'vname' => 'LBL_CONTACTS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_TRAVEL_DETAILS_TITLE',
  'id_name' => 'contacts_scrm_travel_details_1scrm_travel_details_idb',
);
$dictionary["Contact"]["fields"]["contacts_scrm_travel_details_1_name"] = array (
  'name' => 'contacts_scrm_travel_details_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_TRAVEL_DETAILS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_travel_details_1scrm_travel_details_idb',
  'link' => 'contacts_scrm_travel_details_1',
  'table' => 'scrm_travel_details',
  'module' => 'scrm_Travel_Details',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Contact"]["fields"]["contacts_scrm_travel_details_1scrm_travel_details_idb"] = array (
  'name' => 'contacts_scrm_travel_details_1scrm_travel_details_idb',
  'type' => 'link',
  'relationship' => 'contacts_scrm_travel_details_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_CONTACTS_SCRM_TRAVEL_DETAILS_1_FROM_SCRM_TRAVEL_DETAILS_TITLE',
);
