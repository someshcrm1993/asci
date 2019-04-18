<?php
// created: 2017-06-19 10:35:58
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
  'faculty_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_FACULTY',
    'width' => '10%',
  ),
  'participants_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_PARTICIPANTS',
    'width' => '10%',
  ),
  'total_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_TOTAL',
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
    'module' => 'scrm_stationery',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_stationery',
    'width' => '5%',
    'default' => true,
  ),
);