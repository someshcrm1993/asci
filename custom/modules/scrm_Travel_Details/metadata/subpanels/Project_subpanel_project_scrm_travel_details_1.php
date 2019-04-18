<?php
// created: 2017-06-19 11:06:51
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'name' => 'name',
    'vname' => 'LBL_LIST_NAME',
    'sort_by' => 'last_name',
    'sort_order' => 'asc',
    'widget_class' => 'SubPanelDetailViewLink',
    'module' => 'Contacts',
    'width' => '20%',
    'default' => true,
  ),
  'room_number_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_ROOM_NUMBER',
    'width' => '10%',
  ),
  'mode_of_travel_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_MODE_OF_TRAVEL',
    'width' => '10%',
  ),
  'arrival_date_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_ARRIVAL_DATE_TIME',
    'width' => '10%',
  ),
  'departure_date_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_DEPARTURE_DATE_TIME ',
    'width' => '10%',
  ),
  'phone_work' => 
  array (
    'name' => 'phone_work',
    'vname' => 'LBL_LIST_PHONE',
    'width' => '15%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Contacts',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Contacts',
    'width' => '5%',
    'default' => true,
  ),
  'first_name' => 
  array (
    'name' => 'first_name',
    'usage' => 'query_only',
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'usage' => 'query_only',
  ),
  'salutation' => 
  array (
    'name' => 'salutation',
    'usage' => 'query_only',
  ),
);