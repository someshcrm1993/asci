<?php
$viewdefs ['Accounts'] = 
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
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
            'label' => 'LBL_NAME',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'website',
            'type' => 'link',
            'label' => 'LBL_WEBSITE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_fax',
            'label' => 'LBL_FAX',
          ),
          1 => 
          array (
            'name' => 'organisation_activity_c',
            'studio' => 'visible',
            'label' => 'LBL_ORGANISATION_ACTIVITY ',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL',
          ),
          1 => 
          array (
            'name' => 'organisation_type_c',
            'studio' => 'visible',
            'label' => 'LBL_ORGANISATION_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'sector_c',
            'studio' => 'visible',
            'label' => 'LBL_SECTOR',
          ),
          1 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'phone_number_c',
            'label' => 'LBL_PHONE_NUMBER',
          ),
          1 => 
          array (
            'name' => 'alternative_phone_c',
            'label' => 'LBL_ALTERNATIVE_PHONE',
          ),
        ),
        5 => 
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
          1 => 
          array (
            'name' => 'shipping_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
              'copy' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'scrm_partner_contacts_accounts_1_name',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'password_reset_link_c',
            'label' => 'LBL_PASSWORD_RESET_LINK',
          ),
          1 => '',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'client1_gst_c',
            'label' => 'LBL_CLIENT1_GST',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name_of_sponsor_c',
            'label' => 'LBL_NAME_OF_SPONSOR',
            'customCode' => '{html_options name="salutation1_c" id="salutation1_c" options=$fields.salutation1_c.options selected=$fields.salutation1_c.value}&nbsp;<input name="name_of_sponsor_c"  id="name_of_sponsor_c" size="25" maxlength="25" type="text" value="{$fields.name_of_sponsor_c.value}">',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_office',
            'label' => 'LBL_PHONE_OFFICE',
          ),
          1 => 
          array (
            'name' => 'designation_c',
            'label' => 'LBL_DESIGNATION',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name_of_sponsor2_c',
            'label' => 'LBL_NAME_OF_SPONSOR2',
            'customCode' => '{html_options name="salutation2_c" id="salutation2_c" options=$fields.salutation2_c.options selected=$fields.salutation2_c.value}&nbsp;<input name="name_of_sponsor2_c"  id="name_of_sponsor2_c" size="25" maxlength="25" type="text" value="{$fields.name_of_sponsor2_c.value}">',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_alternate',
            'comment' => 'An alternate phone number',
            'label' => 'LBL_PHONE_ALT',
          ),
          1 => 
          array (
            'name' => 'designation2_c',
            'label' => 'LBL_DESIGNATION2',
          ),
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 'annual_revenue',
          1 => 'employees',
        ),
        1 => 
        array (
          0 => 'parent_name',
        ),
        2 => 
        array (
          0 => 'campaign_name',
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
      ),
    ),
  ),
);
?>
