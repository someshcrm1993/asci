<?php
$module_name = 'scrm_Admin_Arranges';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PROGRAMME_FROM_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_PROGRAMME_FROM_DATE',
    'width' => '10%',
  ),
  'PROGRAMME_TO_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_PROGRAMME_TO_DATE',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'SCRM_ADMIN_ARRANGES_PROJECT_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_SCRM_ADMIN_ARRANGES_PROJECT_1_FROM_PROJECT_TITLE',
    'id' => 'SCRM_ADMIN_ARRANGES_PROJECT_1PROJECT_IDB',
    'width' => '10%',
    'default' => false,
  ),
);
?>
