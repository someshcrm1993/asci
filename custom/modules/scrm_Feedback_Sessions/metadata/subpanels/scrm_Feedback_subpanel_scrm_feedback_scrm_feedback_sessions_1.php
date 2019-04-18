<?php
// created: 2018-01-06 00:09:22
$subpanel_layout['list_fields'] = array (
  'scrm_feedback_scrm_feedback_sessions_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1_FROM_SCRM_FEEDBACK_TITLE',
    'id' => 'SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1SCRM_FEEDBACK_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'scrm_Feedback',
    'target_record_key' => 'scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida',
  ),
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'delivery_rating_c' => 
  array (
    'type' => 'radioenum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_DELIVERY_RATING',
    'width' => '10%',
  ),
  'relevance_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_RELEVANCE',
    'width' => '10%',
  ),
  'weighted_avg_rating_c' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_WEIGHTED_AVG_RATING',
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
    'module' => 'scrm_Feedback_Sessions',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Feedback_Sessions',
    'width' => '5%',
    'default' => true,
  ),
);