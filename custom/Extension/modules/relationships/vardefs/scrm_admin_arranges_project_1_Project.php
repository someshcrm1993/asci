<?php
// created: 2017-05-17 14:47:52
$dictionary["Project"]["fields"]["scrm_admin_arranges_project_1"] = array (
  'name' => 'scrm_admin_arranges_project_1',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_project_1',
  'source' => 'non-db',
  'module' => 'scrm_Admin_Arranges',
  'bean_name' => 'scrm_Admin_Arranges',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'id_name' => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
);
$dictionary["Project"]["fields"]["scrm_admin_arranges_project_1_name"] = array (
  'name' => 'scrm_admin_arranges_project_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'save' => true,
  'id_name' => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
  'link' => 'scrm_admin_arranges_project_1',
  'table' => 'scrm_admin_arranges',
  'module' => 'scrm_Admin_Arranges',
  'rname' => 'name',
);
$dictionary["Project"]["fields"]["scrm_admin_arranges_project_1scrm_admin_arranges_ida"] = array (
  'name' => 'scrm_admin_arranges_project_1scrm_admin_arranges_ida',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_project_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
);
