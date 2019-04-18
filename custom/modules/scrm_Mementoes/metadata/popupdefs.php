<?php
$popupMeta = array (
    'moduleMain' => 'scrm_Mementoes',
    'varName' => 'scrm_Mementoes',
    'orderBy' => 'scrm_mementoes.name',
    'whereClauses' => array (
  'name' => 'scrm_mementoes.name',
),
    'searchInputs' => array (
  0 => 'scrm_mementoes_number',
  1 => 'name',
  2 => 'priority',
  3 => 'status',
),
    'listviewdefs' => array (
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    'name' => 'date_entered',
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'name' => 'date_modified',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
    'name' => 'assigned_user_name',
  ),
),
);
