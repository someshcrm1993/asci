<?php
// created: 2017-05-19 15:17:21
$dictionary["Lead"]["fields"]["project_leads_1"] = array (
  'name' => 'project_leads_1',
  'type' => 'link',
  'relationship' => 'project_leads_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_LEADS_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_leads_1project_ida',
);
$dictionary["Lead"]["fields"]["project_leads_1_name"] = array (
  'name' => 'project_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_LEADS_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_leads_1project_ida',
  'link' => 'project_leads_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["Lead"]["fields"]["project_leads_1project_ida"] = array (
  'name' => 'project_leads_1project_ida',
  'type' => 'link',
  'relationship' => 'project_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_LEADS_1_FROM_LEADS_TITLE',
);
