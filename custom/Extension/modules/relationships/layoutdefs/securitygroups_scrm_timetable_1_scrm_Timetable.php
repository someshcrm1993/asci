<?php
 // created: 2017-06-21 19:31:20
$layout_defs["scrm_Timetable"]["subpanel_setup"]['securitygroups_scrm_timetable_1'] = array (
  'order' => 100,
  'module' => 'SecurityGroups',
  'subpanel_name' => 'admin',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_TIMETABLE_1_FROM_SECURITYGROUPS_TITLE',
  'get_subpanel_data' => 'securitygroups_scrm_timetable_1',
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
