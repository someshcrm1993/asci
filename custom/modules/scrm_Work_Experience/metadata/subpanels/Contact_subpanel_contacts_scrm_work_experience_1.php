<?php
// created: 2017-05-24 12:55:03
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'positon' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_POSITON',
    'width' => '10%',
    'default' => true,
  ),
  'years_of_experience' => 
  array (
    'type' => 'int',
    'vname' => 'LBL_YEARS_OF_EXPERIENCE',
    'width' => '10%',
    'default' => true,
  ),
  'gross_salary' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_GROSS_SALARY',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'scrm_Work_Experience',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Work_Experience',
    'width' => '5%',
    'default' => true,
  ),
);