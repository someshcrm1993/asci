<?php
// created: 2015-08-27 09:14:09
$subpanel_layout['list_fields'] = array (
  'campaign_name1' => 
  array (
    'vname' => 'LBL_LIST_CAMPAIGN_NAME',
    'width' => '20%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'campaign_id',
    'target_module' => 'Campaigns',
    'default' => true,
  ),
  'activity_type' => 
  array (
    'vname' => 'LBL_ACTIVITY_TYPE',
    'width' => '15%',
    'default' => true,
  ),
  'activity_date' => 
  array (
    'vname' => 'LBL_ACTIVITY_DATE',
    'width' => '15%',
    'default' => true,
  ),
  'related_name' => 
  array (
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'related_id',
    'target_module_key' => 'related_type',
    'parent_id' => 'target_id',
    'parent_module' => 'target_type',
    'vname' => 'LBL_RELATED',
    'width' => '15%',
    'sortable' => false,
    'default' => true,
  ),
  'related_id' => 
  array (
    'usage' => 'query_only',
  ),
  'related_type' => 
  array (
    'usage' => 'query_only',
  ),
  'target_id' => 
  array (
    'usage' => 'query_only',
  ),
  'target_type' => 
  array (
    'usage' => 'query_only',
  ),
);