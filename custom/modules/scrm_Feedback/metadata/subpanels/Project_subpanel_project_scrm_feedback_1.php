<?php
// created: 2019-01-24 18:16:26
$subpanel_layout['list_fields'] = array (
  'document_name' => 
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
  'scrm_feedback_contacts_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_SCRM_FEEDBACK_CONTACTS_1_FROM_CONTACTS_TITLE',
    'id' => 'SCRM_FEEDBACK_CONTACTS_1CONTACTS_IDB',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'scrm_feedback_contacts_1contacts_idb',
  ),
  'weighted_avg_rating_overall_c' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_WEIGHTED_AVG_RATING_OVERALL',
    'width' => '10%',
  ),
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'scrm_Feedback',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'scrm_Feedback',
    'width' => '5%',
    'default' => true,
  ),
);