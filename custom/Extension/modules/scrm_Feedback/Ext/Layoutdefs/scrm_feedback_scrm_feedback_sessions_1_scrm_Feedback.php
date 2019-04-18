<?php
 // created: 2017-07-28 12:01:28
$layout_defs["scrm_Feedback"]["subpanel_setup"]['scrm_feedback_scrm_feedback_sessions_1'] = array (
  'order' => 100,
  'module' => 'scrm_Feedback_Sessions',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_FEEDBACK_SCRM_FEEDBACK_SESSIONS_1_FROM_SCRM_FEEDBACK_SESSIONS_TITLE',
  'get_subpanel_data' => 'scrm_feedback_scrm_feedback_sessions_1',
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
