<?php
$popupMeta = array (
    'moduleMain' => 'Project',
    'varName' => 'PROJECT',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'project.name',
  'programme_type_c' => 'project_cstm.programme_type_c',
  'area_subjects_c' => 'project_cstm.area_subjects_c',
  'start_date_c' => 'project_cstm.start_date_c',
  'end_date_c' => 'project_cstm.end_date_c',
  'status' => 'project.status',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'programme_type_c',
  2 => 'area_subjects_c',
  3 => 'start_date_c',
  4 => 'end_date_c',
  5 => 'status',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'programme_type_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PROGRAMME_TYPE',
    'width' => '10%',
    'name' => 'programme_type_c',
  ),
  'area_subjects_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_AREA_SUBJECTS',
    'width' => '10%',
    'name' => 'area_subjects_c',
  ),
  'start_date_c' => 
  array (
    'type' => 'date',
    'label' => 'LBL_START_DATE',
    'width' => '10%',
    'name' => 'start_date_c',
  ),
  'end_date_c' => 
  array (
    'type' => 'date',
    'label' => 'LBL_END_DATE',
    'width' => '10%',
    'name' => 'end_date_c',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10%',
  ),
),
);
