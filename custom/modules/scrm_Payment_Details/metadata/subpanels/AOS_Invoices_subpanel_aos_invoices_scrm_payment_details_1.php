<?php
// created: 2017-12-04 17:05:12
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'invoice_number_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_INVOICE_NUMBER',
    'width' => '10%',
  ),
  'fees_c' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_FEES',
    'currency_format' => true,
    'width' => '10%',
  ),
  'invoice_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_INVOICE_DATE',
    'width' => '10%',
  ),
  'payment_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_PAYMENT_DATE',
    'width' => '10%',
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'vname' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'assigned_user_id',
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'scrm_Payment_Details',
    'width' => '4%',
    'default' => true,
  ),
);