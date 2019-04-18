<?php
// created: 2015-08-27 09:21:20
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'vname' => 'LBL_LIST_ASSIGNED_USER_ID',
    'widget_class' => 'SubPanelDetailViewLink',
    'module' => 'Users',
    'target_record_key' => 'assigned_user_id',
    'target_module' => 'Users',
    'width' => '15%',
    'sortable' => false,
    'default' => true,
  ),
  'estimated_start_date' => 
  array (
    'vname' => 'LBL_DATE_START',
    'width' => '10%',
    'sortable' => true,
    'default' => true,
  ),
  'estimated_end_date' => 
  array (
    'vname' => 'LBL_DATE_END',
    'width' => '10%',
    'sortable' => true,
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Project',
    'width' => '3%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Project',
    'width' => '3%',
    'default' => true,
  ),
);