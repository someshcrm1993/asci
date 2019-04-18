<?php
 // created: 2016-08-30 16:53:27
$layout_defs["scrm_Partners"]["subpanel_setup"]['scrm_sms_scrm_partners'] = array (
  'order' => 100,
  'module' => 'scrm_SMS',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_SMS_SCRM_PARTNERS_FROM_SCRM_SMS_TITLE',
  'get_subpanel_data' => 'scrm_sms_scrm_partners',
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
