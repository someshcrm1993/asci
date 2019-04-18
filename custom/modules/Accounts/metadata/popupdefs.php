<?php
$popupMeta = array (
    'moduleMain' => 'Account',
    'varName' => 'ACCOUNT',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'accounts.name',
  'billing_address_city' => 'accounts.billing_address_city',
  'billing_address_state' => 'accounts.billing_address_state',
  'billing_address_country' => 'accounts.billing_address_country',
  'email' => 'accounts.email',
  'assigned_user_id' => 'accounts.assigned_user_id',
  'organisation_type_c' => 'accounts_cstm.organisation_type_c',
  'name_of_sponsor_c' => 'accounts_cstm.name_of_sponsor_c',
  'name_of_sponsor2_c' => 'accounts_cstm.name_of_sponsor2_c',
  'parent_name' => 'accounts.parent_name',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'billing_address_city',
  5 => 'billing_address_state',
  6 => 'billing_address_country',
  7 => 'email',
  8 => 'assigned_user_id',
  9 => 'organisation_type_c',
  10 => 'name_of_sponsor_c',
  11 => 'name_of_sponsor2_c',
  12 => 'parent_name',
),
    'create' => array (
  'formBase' => 'AccountFormBase.php',
  'formBaseClass' => 'AccountFormBase',
  'getFormBodyParams' => 
  array (
    0 => '',
    1 => '',
    2 => 'AccountSave',
  ),
  'createButton' => 'LNK_NEW_ACCOUNT',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'organisation_type_c' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'label' => 'LBL_ORGANISATION_TYPE',
    'width' => '10%',
    'name' => 'organisation_type_c',
  ),
  'name_of_sponsor_c' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_NAME_OF_SPONSOR',
    'width' => '10%',
    'name' => 'name_of_sponsor_c',
  ),
  'name_of_sponsor2_c' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_NAME_OF_SPONSOR2',
    'width' => '10%',
    'name' => 'name_of_sponsor2_c',
  ),
  'billing_address_city' => 
  array (
    'name' => 'billing_address_city',
    'width' => '10%',
  ),
  'billing_address_state' => 
  array (
    'name' => 'billing_address_state',
    'width' => '10%',
  ),
  'billing_address_country' => 
  array (
    'name' => 'billing_address_country',
    'width' => '10%',
  ),
  'email' => 
  array (
    'name' => 'email',
    'width' => '10%',
  ),
  'parent_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MEMBER_OF',
    'id' => 'PARENT_ID',
    'width' => '10%',
    'name' => 'parent_name',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'label' => 'LBL_ASSIGNED_TO',
    'type' => 'enum',
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
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'ACCOUNT_TYPE' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
    'name' => 'account_type',
  ),
  'BILLING_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_CITY',
    'default' => true,
    'name' => 'billing_address_city',
  ),
  'BILLING_ADDRESS_STATE' => 
  array (
    'width' => '7%',
    'label' => 'LBL_STATE',
    'default' => true,
    'name' => 'billing_address_state',
  ),
  'BILLING_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_COUNTRY',
    'default' => true,
    'name' => 'billing_address_country',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
),
);
