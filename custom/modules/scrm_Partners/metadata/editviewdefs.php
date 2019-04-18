<?php
$module_name = 'scrm_Partners';
$_object_name = 'scrm_partners';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Accounts/Account.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_ADDRESS_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMAIL_ADDRESSES' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DESCRIPTION_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'customCode' => '{html_options name="salutation_c" id="salutation_c" options=$fields.salutation_c.options selected=$fields.salutation_c.value}&nbsp;<input name="name"  id="name" size="25" maxlength="25" type="text" value="{$fields.name.value}">',
          ),
          1 => 
          array (
            'name' => 'degree_c',
            'label' => 'LBL_DEGREE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'gender_c',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
          1 => 
          array (
            'name' => 'faculty_type_c',
            'studio' => 'visible',
            'label' => 'LBL_FACULTY_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'centre_c',
            'studio' => 'visible',
            'label' => 'LBL_CENTRE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'area_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'mobile_number_c',
            'label' => 'LBL_MOBILE_NUMBER',
          ),
          1 => 'phone_office',
        ),
        5 => 
        array (
          0 => 'phone_fax',
          1 => 'phone_alternate',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'photo_c',
            'studio' => 'visible',
            'label' => 'LBL_PHOTO',
          ),
          1 => '',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'department_c',
            'label' => 'LBL_DEPARTMENT',
          ),
        ),
      ),
      'lbl_address_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
      ),
      'lbl_email_addresses' => 
      array (
        0 => 
        array (
          0 => 'email1',
        ),
      ),
      'lbl_description_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'profile_c',
            'studio' => 'visible',
            'label' => 'LBL_PROFILE',
          ),
        ),
        1 => 
        array (
          0 => 'description',
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
