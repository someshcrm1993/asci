<?php
// created: 2017-05-16 18:57:29
$dictionary["Contact"]["fields"]["project_contacts_2"] = array (
  'name' => 'project_contacts_2',
  'type' => 'link',
  'relationship' => 'project_contacts_2',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_CONTACTS_2_FROM_PROJECT_TITLE',
  'id_name' => 'project_contacts_2project_ida',
);
$dictionary["Contact"]["fields"]["project_contacts_2_name"] = array (
  'name' => 'project_contacts_2_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_CONTACTS_2_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_contacts_2project_ida',
  'link' => 'project_contacts_2',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["Contact"]["fields"]["project_contacts_2project_ida"] = array (
  'name' => 'project_contacts_2project_ida',
  'type' => 'link',
  'relationship' => 'project_contacts_2',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_CONTACTS_2_FROM_CONTACTS_TITLE',
);
