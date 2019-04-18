<?php
$viewdefs ['Contacts'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">',
          1 => '<input type="hidden" name="case_id" value="{$smarty.request.case_id}">',
          2 => '<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">',
          3 => '<input type="hidden" name="email_id" value="{$smarty.request.email_id}">',
          4 => '<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">',
          5 => '{if !empty($smarty.request.contact_id)}<input type="hidden" name="reports_to_id" value="{$smarty.request.contact_id}">{/if}',
          6 => '{if !empty($smarty.request.contact_name)}<input type="hidden" name="report_to_name" value="{$smarty.request.contact_name}">{/if}',
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_contact_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'programme_year_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_YEAR',
          ),
          1 => 
          array (
            'name' => 'photo',
            'label' => 'LBL_PHOTO',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE',
          ),
          1 => 
          array (
            'name' => 'project_contacts_2_name',
            'label' => 'LBL_PROJECT_CONTACTS_2_FROM_PROJECT_TITLE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name" id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'last_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'linked_in_c',
            'label' => 'LBL_LINKED_IN',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'phone_work',
          ),
          1 => 
          array (
            'name' => 'phone_mobile',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'designation_c',
            'label' => 'LBL_DESIGNATION',
          ),
          1 => 
          array (
            'name' => 'department',
            'comment' => 'The department of the contact',
            'label' => 'LBL_DEPARTMENT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'nomination_status_c',
            'studio' => 'visible',
            'label' => 'LBL_NOMINATION_STATUS',
          ),
          1 => 
          array (
            'name' => 'nominee_position_c',
            'studio' => 'visible',
            'label' => 'LBL_NOMINEE_POSITION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'reasons_for_rejection_c',
            'studio' => 'visible',
            'label' => 'LBL_REASONS_FOR_REJECTION',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
          1 => 
          array (
            'name' => 'age_c',
            'label' => 'LBL_AGE',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'certificate_name_c',
            'label' => 'LBL_CERTIFICATE_NAME',
          ),
          1 => 
          array (
            'name' => 'gender_c',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'date_of_entry_into_govt_c',
            'label' => 'LBL_DATE_OF_ENTRY_INTO_GOVT',
          ),
          1 => 
          array (
            'name' => 't_shirt_c',
            'studio' => 'visible',
            'label' => 'LBL_T_SHIRT',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'present_responsibilities_c',
            'studio' => 'visible',
            'label' => 'LBL_PRESENT_RESPONSIBILITIES',
          ),
          1 => 
          array (
            'name' => 'report_to_c',
            'studio' => 'visible',
            'label' => 'LBL_REPORT_TO',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'expectation_programme_c',
            'studio' => 'visible',
            'label' => 'LBL_EXPECTATION_PROGRAMME',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'email1',
          ),
          1 => 
          array (
            'name' => 'twitter_handle_c',
            'label' => 'LBL_TWITTER_HANDLE',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'comment' => 'Street address for primary address',
            'label' => 'LBL_PRIMARY_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'alt_address_street',
            'comment' => 'Street address for alternate address',
            'label' => 'LBL_ALT_ADDRESS_STREET',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'passport_number_c',
            'label' => 'LBL_PASSPORT_NUMBER',
          ),
          1 => 
          array (
            'name' => 'visa_validity_c',
            'label' => 'LBL_VISA_VALIDITY',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'self_sponsored_c',
            'label' => 'LBL_SELF_SPONSORED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sponsor_organisation_c',
            'studio' => 'visible',
            'label' => 'LBL_SPONSOR_ORGANISATION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'tan_no_c',
            'label' => 'LBL_TAN_NO',
          ),
          1 => 
          array (
            'name' => 'tan_date_c',
            'label' => 'LBL_TAN_DATE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'pan_no_c',
            'label' => 'LBL_PAN_NO',
          ),
          1 => 
          array (
            'name' => 'pan_date_c',
            'label' => 'LBL_PAN_DATE',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'currency_id',
            'studio' => 'visible',
            'label' => 'LBL_CURRENCY',
          ),
          1 => 
          array (
            'name' => 'programme_fee_c',
            'label' => 'LBL_PROGRAMME_FEE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'payment_mode_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_MODE',
          ),
          1 => 
          array (
            'name' => 'date_of_transfer_c',
            'label' => 'LBL_DATE_OF_TRANSFER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'payment_received_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_RECEIVED',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'issuing_bank_c',
            'label' => 'LBL_ISSUING_BANK',
          ),
          1 => 
          array (
            'name' => 'issuing_city_c',
            'label' => 'LBL_ISSUING_CITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'form_16a_recd_c',
            'label' => 'LBL_FORM_16A_RECD',
          ),
          1 => 
          array (
            'name' => 'tds_certificate_issued_c',
            'label' => 'LBL_TDS_CERTIFICATE_ISSUED',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'tds_deducted_c',
            'label' => 'LBL_TDS_DEDUCTED',
          ),
          1 => 
          array (
            'name' => 'reference_no_c',
            'label' => 'LBL_REFERENCE_NO',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name_of_the_insurance_agency_c',
            'label' => 'LBL_NAME_OF_THE_INSURANCE_AGENCY',
          ),
          1 => 
          array (
            'name' => 'policy_number_c',
            'label' => 'LBL_POLICY_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'validity_upto_c',
            'label' => 'LBL_VALIDITY_UPTO',
          ),
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'lead_source',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
          ),
        ),
      ),
    ),
  ),
);
?>
