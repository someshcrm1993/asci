<?php
 // created: 2017-05-24 12:51:17
$layout_defs["Contacts"]["subpanel_setup"]['contacts_scrm_qualification_1'] = array (
  'order' => 100,
  'module' => 'scrm_Qualification',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_SCRM_QUALIFICATION_1_FROM_SCRM_QUALIFICATION_TITLE',
  'get_subpanel_data' => 'contacts_scrm_qualification_1',
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
