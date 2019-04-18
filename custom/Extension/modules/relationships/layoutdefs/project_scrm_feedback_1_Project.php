<?php
 // created: 2017-07-28 15:12:46
$layout_defs["Project"]["subpanel_setup"]['project_scrm_feedback_1'] = array (
  'order' => 100,
  'module' => 'scrm_Feedback',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PROJECT_SCRM_FEEDBACK_1_FROM_SCRM_FEEDBACK_TITLE',
  'get_subpanel_data' => 'project_scrm_feedback_1',
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
