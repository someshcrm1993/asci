<?php
 // created: 2017-06-21 19:32:12
$layout_defs["SecurityGroups"]["subpanel_setup"]['securitygroups_scrm_admin_arranges_1'] = array (
  'order' => 100,
  'module' => 'scrm_Admin_Arranges',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SECURITYGROUPS_SCRM_ADMIN_ARRANGES_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'get_subpanel_data' => 'securitygroups_scrm_admin_arranges_1',
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
