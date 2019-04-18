<?php
 // created: 2017-06-21 19:33:23
$layout_defs["scrm_Partners"]["subpanel_setup"]['securitygroups_scrm_partners_1'] = array (
  'order' => 100,
  'module' => 'SecurityGroups',
  'subpanel_name' => 'admin',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_PARTNERS_1_FROM_SECURITYGROUPS_TITLE',
  'get_subpanel_data' => 'securitygroups_scrm_partners_1',
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
