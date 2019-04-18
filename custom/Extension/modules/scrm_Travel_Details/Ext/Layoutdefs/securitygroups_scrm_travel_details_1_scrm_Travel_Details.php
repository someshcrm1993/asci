<?php
 // created: 2017-06-21 19:35:16
$layout_defs["scrm_Travel_Details"]["subpanel_setup"]['securitygroups_scrm_travel_details_1'] = array (
  'order' => 100,
  'module' => 'SecurityGroups',
  'subpanel_name' => 'admin',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_TRAVEL_DETAILS_1_FROM_SECURITYGROUPS_TITLE',
  'get_subpanel_data' => 'securitygroups_scrm_travel_details_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
