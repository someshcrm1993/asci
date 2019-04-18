<?php
 // created: 2017-06-12 17:49:10
$layout_defs["Accounts"]["subpanel_setup"]['accounts_scrm_work_order_1'] = array (
  'order' => 100,
  'module' => 'scrm_Work_Order',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNTS_SCRM_WORK_ORDER_1_FROM_SCRM_WORK_ORDER_TITLE',
  'get_subpanel_data' => 'accounts_scrm_work_order_1',
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
