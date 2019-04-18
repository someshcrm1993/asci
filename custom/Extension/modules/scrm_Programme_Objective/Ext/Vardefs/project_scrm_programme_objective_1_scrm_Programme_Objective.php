<?php
// created: 2017-08-16 09:54:24
$dictionary["scrm_Programme_Objective"]["fields"]["project_scrm_programme_objective_1"] = array (
  'name' => 'project_scrm_programme_objective_1',
  'type' => 'link',
  'relationship' => 'project_scrm_programme_objective_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_PROJECT_SCRM_PROGRAMME_OBJECTIVE_1_FROM_PROJECT_TITLE',
  'id_name' => 'project_scrm_programme_objective_1project_ida',
);
$dictionary["scrm_Programme_Objective"]["fields"]["project_scrm_programme_objective_1_name"] = array (
  'name' => 'project_scrm_programme_objective_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECT_SCRM_PROGRAMME_OBJECTIVE_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'project_scrm_programme_objective_1project_ida',
  'link' => 'project_scrm_programme_objective_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Programme_Objective"]["fields"]["project_scrm_programme_objective_1project_ida"] = array (
  'name' => 'project_scrm_programme_objective_1project_ida',
  'type' => 'link',
  'relationship' => 'project_scrm_programme_objective_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECT_SCRM_PROGRAMME_OBJECTIVE_1_FROM_SCRM_PROGRAMME_OBJECTIVE_TITLE',
);
