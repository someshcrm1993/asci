<?php
 // created: 2017-12-04 16:55:43
$layout_defs["Project"]["subpanel_setup"]['project_scrm_payment_details_1'] = array (
  'order' => 100,
  'module' => 'scrm_Payment_Details',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PROJECT_SCRM_PAYMENT_DETAILS_1_FROM_SCRM_PAYMENT_DETAILS_TITLE',
  'get_subpanel_data' => 'project_scrm_payment_details_1',
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
