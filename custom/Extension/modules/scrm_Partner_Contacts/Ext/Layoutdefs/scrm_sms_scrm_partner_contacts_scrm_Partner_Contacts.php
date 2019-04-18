<?php
 // created: 2016-08-30 16:53:27
$layout_defs["scrm_Partner_Contacts"]["subpanel_setup"]['scrm_sms_scrm_partner_contacts'] = array (
  'order' => 100,
  'module' => 'scrm_SMS',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_SMS_SCRM_PARTNER_CONTACTS_FROM_SCRM_SMS_TITLE',
  'get_subpanel_data' => 'scrm_sms_scrm_partner_contacts',
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
