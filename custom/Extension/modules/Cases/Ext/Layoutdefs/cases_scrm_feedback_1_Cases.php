<?php
 // created: 2016-04-05 10:58:43
$layout_defs["Cases"]["subpanel_setup"]['cases_scrm_feedback_1'] = array (
  'order' => 100,
  'module' => 'scrm_Feedback',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CASES_SCRM_FEEDBACK_1_FROM_SCRM_FEEDBACK_TITLE',
  'get_subpanel_data' => 'cases_scrm_feedback_1',
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
