<?php
$dashletData['AOS_InvoicesDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'stage_c' => 
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
$dashletData['AOS_InvoicesDashlet']['columns'] = array (
  'invoice_reference_no_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_INVOICE_REFERENCE_NO',
    'width' => '10%',
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
  'stage_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STAGE',
    'width' => '10%',
  ),
  'total_amount' => 
  array (
    'width' => '15%',
    'label' => 'LBL_GRAND_TOTAL',
    'currency_format' => true,
    'default' => true,
    'name' => 'total_amount',
  ),
  'number' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_NUM',
    'default' => false,
    'name' => 'number',
  ),
  'billing_contact' => 
  array (
    'width' => '15%',
    'label' => 'LBL_BILLING_CONTACT',
    'name' => 'billing_contact',
    'default' => false,
  ),
  'status' => 
  array (
    'width' => '15%',
    'label' => 'LBL_STATUS',
    'default' => false,
    'name' => 'status',
  ),
  'invoice_date' => 
  array (
    'width' => '15%',
    'label' => 'LBL_INVOICE_DATE',
    'name' => 'invoice_date',
    'default' => false,
  ),
  'due_date' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DUE_DATE',
    'default' => false,
    'name' => 'due_date',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => false,
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
