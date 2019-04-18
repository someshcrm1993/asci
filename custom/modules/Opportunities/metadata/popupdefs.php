<?php
$popupMeta = array (
    'moduleMain' => 'Opportunity',
    'varName' => 'OPPORTUNITY',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'opportunities.name',
  'assigned_user_id' => 'opportunities.assigned_user_id',
  'asci_rpf_reference_c' => 'opportunities_cstm.asci_rpf_reference_c',
),
    'searchInputs' => array (
  0 => 'name',
  2 => 'assigned_user_id',
  3 => 'asci_rpf_reference_c',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'asci_rpf_reference_c' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ASCI_RPF_REFERENCE',
    'width' => '10%',
    'name' => 'asci_rpf_reference_c',
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
    'listviewdefs' => array (
  'ASCI_RPF_REFERENCE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ASCI_RPF_REFERENCE',
    'width' => '10%',
    'name' => 'asci_rpf_reference_c',
  ),
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_OPPORTUNITY_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'module' => 'Accounts',
    'default' => true,
    'sortable' => true,
    'ACLTag' => 'ACCOUNT',
    'name' => 'account_name',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
),
);
