<?php
// created: 2017-09-19 16:05:23
$dictionary["Project"]["fields"]["project_scrm_budget_1"] = array (
  'name' => 'project_scrm_budget_1',
  'type' => 'link',
  'relationship' => 'project_scrm_budget_1',
  'source' => 'non-db',
  'module' => 'scrm_Budget',
  'bean_name' => 'scrm_Budget',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_SCRM_BUDGET_TITLE',
  'id_name' => 'project_scrm_budget_1scrm_budget_idb',
);
$dictionary["Project"]["fields"]["project_scrm_budget_1_name"] = array (
  'name' => 'project_scrm_budget_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_SCRM_BUDGET_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_budget_1scrm_budget_idb',
  'link' => 'project_scrm_budget_1',
  'table' => 'scrm_budget',
  'module' => 'scrm_Budget',
  'rname' => 'name',
);
$dictionary["Project"]["fields"]["project_scrm_budget_1scrm_budget_idb"] = array (
  'name' => 'project_scrm_budget_1scrm_budget_idb',
  'type' => 'link',
  'relationship' => 'project_scrm_budget_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_PROJECT_SCRM_BUDGET_1_FROM_SCRM_BUDGET_TITLE',
);
