<?php
 // created: 2017-06-21 15:09:11
$layout_defs["SecurityGroups"]["subpanel_setup"]['securitygroups_scrm_work_order_1'] = array (
  'order' => 100,
  'module' => 'scrm_Work_Order',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_WORK_ORDER_1_FROM_SCRM_WORK_ORDER_TITLE',
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
