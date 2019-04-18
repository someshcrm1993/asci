<?php
$dashletData['ProjectDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
  'start_date_c' => 
  array (
    'default' => '',
  ),
  'end_date_c' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['ProjectDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'start_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_START_DATE',
    'width' => '10%',
    'name' => 'start_date_c',
  ),
  'end_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_END_DATE',
    'width' => '10%',
    'name' => 'end_date_c',
  ),
  'programme_type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PROGRAMME_TYPE',
    'width' => '10%',
    'name' => 'programme_type_c',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'name' => 'status',
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => true,
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'room_no_bv_c' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_ROOM_NO_BV',
    'width' => '10%',
  ),
  'room_no_cpc_new_c' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_ROOM_NO_CPC_NEW',
    'width' => '10%',
  ),
  'room_no_cpc_old_c' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_ROOM_NO_CPC_OLD',
    'width' => '10%',
  ),
  'estimated_start_date' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_START',
    'width' => '10%',
    'default' => false,
    'name' => 'estimated_start_date',
  ),
  'estimated_end_date' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_END',
    'width' => '10%',
    'default' => false,
    'name' => 'estimated_end_date',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
    'name' => 'date_entered',
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
);
