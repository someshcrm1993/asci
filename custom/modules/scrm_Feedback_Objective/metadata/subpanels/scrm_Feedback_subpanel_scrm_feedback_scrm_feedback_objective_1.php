<?php
// created: 2018-01-06 00:09:47
$subpanel_layout['list_fields'] = array (
  'scrm_feedback_scrm_feedback_objective_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_OBJECTIVE_1_FROM_SCRM_FEEDBACK_TITLE',
    'id' => 'SCRM_FEEDBACK_SCRM_FEEDBACK_OBJECTIVE_1SCRM_FEEDBACK_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'scrm_Feedback',
    'target_record_key' => 'scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida',
  ),
  'programme_objective_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_PROGRAMME_OBJECTIVE',
    'width' => '10%',
  ),
  'rating_c' => 
  array (
    'type' => 'radioenum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_RATING',
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
    'module' => 'scrm_Feedback_Objective',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Feedback_Objective',
    'width' => '5%',
    'default' => true,
  ),
);