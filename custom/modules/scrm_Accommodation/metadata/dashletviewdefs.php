<?php
$dashletData['scrm_AccommodationDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'check_in_c' => 
  array (
    'default' => '',
  ),
  'accommodation_type_c' => 
  array (
    'default' => '',
  ),
  'check_out_c' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['scrm_AccommodationDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'accommodation_type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOMMODATION_TYPE',
    'width' => '10%',
    'name' => 'accommodation_type_c',
  ),
  'project_scrm_accommodation_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_PROJECT_TITLE',
    'id' => 'PROJECT_SCRM_ACCOMMODATION_1PROJECT_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'project_scrm_accommodation_1_name',
  ),
  'check_in_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_CHECK_IN',
    'width' => '10%',
    'name' => 'check_in_c',
  ),
  'check_out_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_CHECK_OUT',
    'width' => '10%',
    'name' => 'check_out_c',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
    'name' => 'date_entered',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
  'guest_type_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_GUEST_TYPE',
    'width' => '10%',
    'name' => 'guest_type_c',
  ),
);
