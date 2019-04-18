<?php
$module_name = 'scrm_Accommodation';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
      ),
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'project_scrm_accommodation_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_PROJECT_SCRM_ACCOMMODATION_1_FROM_PROJECT_TITLE',
        'id' => 'PROJECT_SCRM_ACCOMMODATION_1PROJECT_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'project_scrm_accommodation_1_name',
      ),
      'location_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_LOCATION',
        'width' => '10%',
        'name' => 'location_c',
      ),
      'guest_type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_GUEST_TYPE',
        'width' => '10%',
        'name' => 'guest_type_c',
      ),
      'type_of_room_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TYPE_OF_ROOM',
        'width' => '10%',
        'name' => 'type_of_room_c',
      ),
      'created_by_name' => 
      array (
        'name' => 'created_by_name',
        'default' => true,
        'width' => '10%',
      ),
      'email' => 
      array (
        'name' => 'email',
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
