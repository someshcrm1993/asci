<?php
$module_name = 'scrm_Travel_Details';
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
      'first_name' => 
      array (
        'name' => 'first_name',
        'default' => true,
        'width' => '10%',
      ),
      'last_name' => 
      array (
        'name' => 'last_name',
        'default' => true,
        'width' => '10%',
      ),
      'address_city' => 
      array (
        'name' => 'address_city',
        'default' => true,
        'width' => '10%',
      ),
      'created_by_name' => 
      array (
        'name' => 'created_by_name',
        'default' => true,
        'width' => '10%',
      ),
      'mode_of_travel_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MODE_OF_TRAVEL',
        'width' => '10%',
        'name' => 'mode_of_travel_c',
      ),
      'do_not_call' => 
      array (
        'name' => 'do_not_call',
        'default' => true,
        'width' => '10%',
      ),
      'project_scrm_travel_details_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_PROJECT_SCRM_TRAVEL_DETAILS_1_FROM_PROJECT_TITLE',
        'id' => 'PROJECT_SCRM_TRAVEL_DETAILS_1PROJECT_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'project_scrm_travel_details_1_name',
      ),
      'programme_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PROGRAMME_CODE',
        'width' => '10%',
        'name' => 'programme_code_c',
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
