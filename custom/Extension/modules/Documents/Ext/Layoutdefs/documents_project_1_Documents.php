<?php
 // created: 2017-06-17 13:22:49
$layout_defs["Documents"]["subpanel_setup"]['documents_project_1'] = array (
  'order' => 100,
  'module' => 'Project',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DOCUMENTS_PROJECT_1_FROM_PROJECT_TITLE',
  'get_subpanel_data' => 'documents_project_1',
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
