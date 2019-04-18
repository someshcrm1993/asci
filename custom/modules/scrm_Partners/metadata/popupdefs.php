<?php
$popupMeta = array (
    'moduleMain' => 'scrm_Partners',
    'varName' => 'scrm_Partners',
    'orderBy' => 'scrm_partners.name',
    'whereClauses' => array (
  'name' => 'scrm_partners.name',
  'phone' => 'scrm_partners.phone',
  'address_city' => 'scrm_partners.address_city',
  'email' => 'scrm_partners.email',
  'assigned_user_id' => 'scrm_partners.assigned_user_id',
  'centre_c' => 'scrm_partners_cstm.centre_c',
  'faculty_type_c' => 'scrm_partners_cstm.faculty_type_c',
),
    'searchInputs' => array (
  0 => 'name',
  4 => 'phone',
  5 => 'address_city',
  6 => 'email',
  7 => 'assigned_user_id',
  8 => 'centre_c',
  10 => 'faculty_type_c',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'centre_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_CENTRE',
    'width' => '10%',
    'name' => 'centre_c',
  ),
  'faculty_type_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_FACULTY_TYPE',
    'width' => '10%',
    'name' => 'faculty_type_c',
  ),
  'phone' => 
  array (
    'name' => 'phone',
    'label' => 'LBL_ANY_PHONE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_city' => 
  array (
    'name' => 'address_city',
    'label' => 'LBL_CITY',
    'type' => 'name',
    'width' => '10%',
  ),
  'email' => 
  array (
    'name' => 'email',
    'label' => 'LBL_ANY_EMAIL',
    'type' => 'name',
    'width' => '10%',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'type' => 'enum',
    'label' => 'LBL_ASSIGNED_TO',
    'function' => 
    array (
      'name' => 'get_user_array',
      'params' => 
      array (
        0 => false,
      ),
    ),
    'width' => '10%',
  ),
),
);
