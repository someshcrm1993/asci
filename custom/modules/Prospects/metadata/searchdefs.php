<?php
$searchdefs ['Prospects'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'search_name' => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'account_name' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_ACCOUNT_NAME',
        'width' => '10%',
        'default' => true,
        'name' => 'account_name',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 
      array (
        'name' => 'phone',
        'label' => 'LBL_ANY_PHONE',
        'type' => 'name',
      ),
      3 => 
      array (
        'name' => 'email',
        'label' => 'LBL_ANY_EMAIL',
        'type' => 'name',
      ),
      4 => 'assistant',
      5 => 'do_not_call',
      6 => 
      array (
        'name' => 'address_street',
        'label' => 'LBL_ANY_ADDRESS',
        'type' => 'name',
      ),
      7 => 
      array (
        'name' => 'address_state',
        'label' => 'LBL_STATE',
        'type' => 'name',
      ),
      8 => 
      array (
        'name' => 'address_postalcode',
        'label' => 'LBL_POSTAL_CODE',
        'type' => 'name',
      ),
      9 => 
      array (
        'name' => 'primary_address_country',
        'label' => 'LBL_COUNTRY',
        'type' => 'name',
        'options' => 'countries_dom',
      ),
      10 => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
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
