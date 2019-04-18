<?php
 // created: 2017-06-21 15:09:11
$layout_defs["scrm_Work_Order"]["subpanel_setup"]['securitygroups_scrm_work_order_1'] = array (
  'order' => 100,
  'module' => 'SecurityGroups',
  'subpanel_name' => 'admin',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_WORK_ORDER_1_FROM_SECURITYGROUPS_TITLE',
  'get_subpanel_data' => 'securitygroups_scrm_work_order_1',
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
