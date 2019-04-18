<?php
// created: 2017-07-06 17:13:25
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'total_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_TOTAL',
    'width' => '10%',
  ),
  'guest_faculty_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_GUEST_FACULTY ',
    'width' => '10%',
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'scrm_Mementoes',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Mementoes',
    'width' => '5%',
    'default' => true,
  ),
);