<?php
// created: 2017-10-05 19:50:21
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'fees_c' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_FEES',
    'currency_format' => true,
    'width' => '10%',
  ),
  'invoice_number_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_INVOICE_NUMBER',
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
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Payment_Details',
    'width' => '5%',
    'default' => true,
  ),
);