<?php
// created: 2017-06-02 18:47:57
$dictionary["AOS_Quotes"]["fields"]["project_aos_quotes_1"] = array (
  'name' => 'project_aos_quotes_1',
  'type' => 'link',
  'relationship' => 'project_aos_quotes_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_AOS_QUOTES_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_aos_quotes_1project_ida',
);
$dictionary["AOS_Quotes"]["fields"]["project_aos_quotes_1_name"] = array (
  'name' => 'project_aos_quotes_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_AOS_QUOTES_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_aos_quotes_1project_ida',
  'link' => 'project_aos_quotes_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["AOS_Quotes"]["fields"]["project_aos_quotes_1project_ida"] = array (
  'name' => 'project_aos_quotes_1project_ida',
  'type' => 'link',
  'relationship' => 'project_aos_quotes_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_AOS_QUOTES_1_FROM_AOS_QUOTES_TITLE',
);
