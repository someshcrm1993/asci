<?php
$module_name = 'scrm_Accommodation';
$listViewDefs [$module_name] = 
array (
  'FULL_NAME' => 
  array (
    'type' => 'fullname',
    'studio' => 
    array (
      'listview' => false,
    ),
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => false,
  ),
  'NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'orderBy' => 'last_name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'PROJECT_SCRM_ACCOMMODATION_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_PROJECT_TITLE',
    'id' => 'PROJECT_SCRM_ACCOMMODATION_1PROJECT_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'ROOM_NO_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ROOM_NO',
    'width' => '10%',
  ),
  'LOCATION_C' => 
  array (
    'type' => 'enum',
    'link' => true,
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_LOCATION',
    'width' => '10%',
  ),
  'TYPE_OF_ROOM_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE_OF_ROOM',
    'width' => '10%',
  ),
  'GUEST_TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_GUEST_TYPE',
    'width' => '10%',
  ),
  'CHECK_IN_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_CHECK_IN',
    'width' => '10%',
  ),
  'CHECK_OUT_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_CHECK_OUT',
    'width' => '10%',
  ),
  'FIRST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FIRST_NAME',
    'width' => '10%',
    'default' => false,
  ),
  'LAST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LAST_NAME',
    'width' => '10%',
    'default' => false,
  ),
  'DO_NOT_CALL' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DO_NOT_CALL',
    'default' => false,
  ),
  'CONTACTS_SCRM_ACCOMMODATION_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_ACCOMMODATION_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_ACCOMMODATION_1CONTACTS_IDA',
    'width' => '10%',
    'default' => false,
  ),
  'PHONE_HOME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_HOME_PHONE',
    'default' => false,
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => false,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10%',
    'label' => 'LBL_WORK_PHONE',
    'default' => false,
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10%',
    'label' => 'LBL_FAX_PHONE',
    'default' => false,
  ),
  'ADDRESS_STREET' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'ADDRESS_STATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
);
?>
