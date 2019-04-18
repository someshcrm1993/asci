<?php
 // created: 2016-06-08 11:02:55
$layout_defs["scrm_Partners"]["subpanel_setup"]['scrm_partners_scrm_partner_contacts_1'] = array (
  'order' => 100,
  'module' => 'scrm_Partner_Contacts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_PARTNERS_SCRM_PARTNER_CONTACTS_1_FROM_SCRM_PARTNER_CONTACTS_TITLE',
  'get_subpanel_data' => 'scrm_partners_scrm_partner_contacts_1',
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
