<?php
 // created: 2016-06-08 10:51:17
$layout_defs["scrm_Partner_Contacts"]["subpanel_setup"]['scrm_partner_contacts_leads'] = array (
  'order' => 100,
  'module' => 'Leads',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_PARTNER_CONTACTS_LEADS_FROM_LEADS_TITLE',
  'get_subpanel_data' => 'scrm_partner_contacts_leads',
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
