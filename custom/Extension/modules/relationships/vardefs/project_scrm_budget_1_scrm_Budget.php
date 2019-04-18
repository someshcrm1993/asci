<?php
// created: 2017-09-19 16:05:23
$dictionary["scrm_Budget"]["fields"]["project_scrm_budget_1"] = array (
  'name' => 'project_scrm_budget_1',
  'type' => 'link',
  'relationship' => 'project_scrm_budget_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_budget_1project_ida',
);
$dictionary["scrm_Budget"]["fields"]["project_scrm_budget_1_name"] = array (
  'name' => 'project_scrm_budget_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_budget_1project_ida',
  'link' => 'project_scrm_budget_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Budget"]["fields"]["project_scrm_budget_1project_ida"] = array (
  'name' => 'project_scrm_budget_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_budget_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_PROJECT_TITLE',
);
