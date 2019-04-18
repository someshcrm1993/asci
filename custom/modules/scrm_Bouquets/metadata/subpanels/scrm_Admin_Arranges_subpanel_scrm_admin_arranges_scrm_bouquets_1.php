<?php
// created: 2017-07-06 17:12:54
$subpanel_layout['list_fields'] = array (
  'number_of_bouquets_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_NUMBER_OF_BOUQUETS',
    'width' => '10%',
  ),
  'date_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_DATE_TIME',
    'width' => '10%',
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
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
    'module' => 'scrm_Bouquets',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Bouquets',
    'width' => '5%',
    'default' => true,
  ),
);