<?php
$dashletData['AOS_QuotesDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'proforma_stage_c' => 
  array (
    'default' => '',
  ),
  'invoice_status' => 
  array (
    'default' => '',
  ),
  'billing_account' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['AOS_QuotesDashlet']['columns'] = array (
  'number' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_NUM',
    'default' => true,
    'name' => 'number',
  ),
  'name' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'billing_account' => 
  array (
    'width' => '20%',
    'label' => 'LBL_BILLING_ACCOUNT',
    'name' => 'billing_account',
    'default' => true,
  ),
  'proforma_stage_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PROFORMA_STAGE',
    'width' => '10%',
    'name' => 'proforma_stage_c',
  ),
  'total_amount' => 
  array (
    'width' => '15%',
    'label' => 'LBL_GRAND_TOTAL',
    'currency_format' => true,
    'default' => true,
    'name' => 'total_amount',
  ),
  'expiration' => 
  array (
    'width' => '15%',
    'label' => 'LBL_EXPIRATION',
    'default' => true,
    'name' => 'expiration',
  ),
  'billing_contact' => 
  array (
    'width' => '15%',
    'label' => 'LBL_BILLING_CONTACT',
    'name' => 'billing_contact',
    'default' => false,
  ),
  'opportunity' => 
  array (
    'width' => '25%',
    'label' => 'LBL_OPPORTUNITY',
    'name' => 'opportunity',
    'default' => false,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => false,
  ),
  'stage' => 
  array (
    'width' => '15%',
    'label' => 'LBL_STAGE',
    'default' => false,
    'name' => 'stage',
  ),
  'invoice_status' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_INVOICE_STATUS',
    'width' => '10%',
    'name' => 'invoice_status',
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
);
