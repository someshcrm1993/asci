<?php
// created: 2017-05-17 14:47:52
$dictionary["scrm_Admin_Arranges"]["fields"]["scrm_admin_arranges_project_1"] = array (
  'name' => 'scrm_admin_arranges_project_1',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_project_1',
  'source' => 'non-db',
  'module' => 'Project',
  'bean_name' => 'Project',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_PROJECT_TITLE',
  'id_name' => 'scrm_admin_arranges_project_1project_idb',
);
$dictionary["scrm_Admin_Arranges"]["fields"]["scrm_admin_arranges_project_1_name"] = array (
  'name' => 'scrm_admin_arranges_project_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_PROJECT_TITLE',
  'save' => true,
  'id_name' => 'scrm_admin_arranges_project_1project_idb',
  'link' => 'scrm_admin_arranges_project_1',
  'table' => 'project',
  'module' => 'Project',
  'rname' => 'name',
);
$dictionary["scrm_Admin_Arranges"]["fields"]["scrm_admin_arranges_project_1project_idb"] = array (
  'name' => 'scrm_admin_arranges_project_1project_idb',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_project_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_PROJECT_TITLE',
);
