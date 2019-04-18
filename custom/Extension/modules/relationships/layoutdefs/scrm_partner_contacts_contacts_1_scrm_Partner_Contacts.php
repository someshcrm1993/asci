<?php
 // created: 2017-07-11 14:01:43
$layout_defs["scrm_Partner_Contacts"]["subpanel_setup"]['scrm_partner_contacts_contacts_1'] = array (
  'order' => 100,
  'module' => 'Contacts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_PARTNER_CONTACTS_CONTACTS_1_FROM_CONTACTS_TITLE',
  'get_subpanel_data' => 'scrm_partner_contacts_contacts_1',
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
