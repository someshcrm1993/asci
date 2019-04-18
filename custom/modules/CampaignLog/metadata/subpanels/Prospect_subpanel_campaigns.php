<?php
// created: 2016-10-06 18:08:25
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
    'width' => '10%',
    'default' => true,
  ),
  'activity_date' => 
  array (
    'vname' => 'LBL_ACTIVITY_DATE',
    'width' => '10%',
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
    'width' => '60%',
    'sortable' => false,
    'default' => true,
  ),
  'hits' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_HITS',
    'width' => '10%',
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