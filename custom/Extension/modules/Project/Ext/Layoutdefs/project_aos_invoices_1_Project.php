<?php
 // created: 2017-05-27 12:32:23
$layout_defs["Project"]["subpanel_setup"]['project_aos_invoices_1'] = array (
  'order' => 100,
  'module' => 'AOS_Invoices',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PROJECT_AOS_INVOICES_1_FROM_AOS_INVOICES_TITLE',
  'get_subpanel_data' => 'project_aos_invoices_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
