<?php
$viewdefs ['Contacts'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
          4 => 
          array (
            'AOS_GENLET' => 
            array (
              'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}">',
            ),
          ),
          'AOP_CREATE' => 
          array (
            'customCode' => '{if !$fields.joomla_account_id.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'createPortalUser\';" value="{$MOD.LBL_CREATE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_CREATE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_CREATE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'createPortalUser\';',
                'name' => 'buttonCreatePortalUser',
                'id' => 'createPortalUser_button',
              ),
              'template' => '{if !$fields.joomla_account_id.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          'AOP_DISABLE' => 
          array (
            'customCode' => '{if $fields.joomla_account_id.value && !$fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'disablePortalUser\';" value="{$MOD.LBL_DISABLE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_DISABLE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_DISABLE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'disablePortalUser\';',
                'name' => 'buttonDisablePortalUser',
                'id' => 'disablePortalUser_button',
              ),
              'template' => '{if $fields.joomla_account_id.value && !$fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          'AOP_ENABLE' => 
          array (
            'customCode' => '{if $fields.joomla_account_id.value && $fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input type="submit" class="button" onClick="this.form.action.value=\'enablePortalUser\';" value="{$MOD.LBL_ENABLE_PORTAL_USER}"> {/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_ENABLE_PORTAL_USER}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_ENABLE_PORTAL_USER}',
                'class' => 'button',
                'onclick' => 'this.form.action.value=\'enablePortalUser\';',
                'name' => 'buttonENablePortalUser',
                'id' => 'enablePortalUser_button',
              ),
              'template' => '{if $fields.joomla_account_id.value && $fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}[CONTENT]{/if}',
            ),
          ),
          5 => 
          array (
            'customCode' => '<input  type="submit" class="button" 
              name="create" id="create" value="Create Contact" onClick="document.location=\'index.php?module=Contacts&action=EditView&return_module=Contacts&return_action=DetailView\'">',
          ),
          6 => 
          array (
            'customCode' => '{if $fields.nomination_status_c.value == "Accepted" }<input type="submit" class="button" 
              name="create" id="create" value="Send Acceptance" onClick="document.location=\'index.php?module=Contacts&action=SendNominationAcceptance&return_module=Contacts&return_action=DetailView&id={$fields.id.value}\'"{/if}>',
          ),
          7 => 
          array (
            'customCode' => '{if $fields.nomination_status_c.value == "Rejected" }<input type="submit" class="button" 
              name="create" id="create" value="Send Rejection" onClick="document.location=\'index.php?module=Contacts&action=SendNominationRejection&return_module=Contacts&return_action=DetailView&id={$fields.id.value}\'">{/if}>',
          ),
          8 => 
          array (
            'customCode' => '{if $fields.nomination_status_c.value == "Rejected" }<input type="submit" class="button" 
              name="create" id="sendRSponsor" value="Send Rejection To Sponsor" onClick="document.location=\'index.php?module=Contacts&action=SendRejectionToSponsor&return_module=Contacts&return_action=DetailView&id={$fields.id.value}\'">{/if}>',
          ),
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
          'file' => 'modules/Leads/Lead.js',
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
      'syncDetailEditViews' => true,
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
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'comment' => 'First name of the contact',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'last_name',
            'comment' => 'Last name of the contact',
            'label' => 'LBL_LAST_NAME',
          ),
        ),
        3 => 
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
        4 => 
        array (
          0 => 
          array (
            'name' => 'po_remark_c',
            'studio' => 'visible',
            'label' => 'LBL_PO_REMARK',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'reasons_for_rejection_c',
            'studio' => 'visible',
            'label' => 'LBL_REASONS_FOR_REJECTION',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'nationality_c',
            'studio' => 'visible',
            'label' => 'LBL_NATIONALITY',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNT_NAME',
            'displayParams' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'organisation_details_c',
            'studio' => 'visible',
            'label' => 'LBL_ORGANISATION_DETAILS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'phone_work',
            'label' => 'LBL_OFFICE_PHONE',
          ),
          1 => 
          array (
            'name' => 'phone_mobile',
            'label' => 'LBL_MOBILE_PHONE',
          ),
        ),
        9 => 
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
        10 => 
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
        11 => 
        array (
          0 => 
          array (
            'name' => 'linked_in_c',
            'label' => 'LBL_LINKED_IN',
          ),
          1 => 
          array (
            'name' => 'twitter_handle_c',
            'label' => 'LBL_TWITTER_HANDLE',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'alternate_phone_c',
            'label' => 'LBL_ALTERNATE_PHONE',
          ),
          1 => 
          array (
            'name' => 'do_not_call',
            'comment' => 'An indicator of whether contact can be called',
            'label' => 'LBL_DO_NOT_CALL',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'designation_c',
            'label' => 'LBL_DESIGNATION',
          ),
          1 => 
          array (
            'name' => 'department',
            'label' => 'LBL_DEPARTMENT',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'certificate_issued_c',
            'studio' => 'visible',
            'label' => 'LBL_CERTIFICATE_ISSUED',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'label' => 'LBL_FAX_PHONE',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'date_of_entry_into_govt_c',
            'label' => 'LBL_DATE_OF_ENTRY_INTO_GOVT',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 't_shirt_c',
            'studio' => 'visible',
            'label' => 'LBL_T_SHIRT',
          ),
        ),
        17 => 
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
        18 => 
        array (
          0 => 
          array (
            'name' => 'expectation_programme_c',
            'studio' => 'visible',
            'label' => 'LBL_EXPECTATION_PROGRAMME',
          ),
        ),
        19 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL_ADDRESS',
          ),
        ),
        20 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'label' => 'LBL_PRIMARY_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
            ),
          ),
          1 => 
          array (
            'name' => 'alt_address_street',
            'label' => 'LBL_ALTERNATE_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'alt',
            ),
          ),
        ),
        21 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        22 => 
        array (
          0 => 
          array (
            'name' => 'feedback_requested_c',
            'studio' => 'visible',
            'label' => 'LBL_FEEDBACK_REQUESTED',
          ),
          1 => 
          array (
            'name' => 'feedback_status_c',
            'studio' => 'visible',
            'label' => 'LBL_FEEDBACK_STATUS',
          ),
        ),
        23 => 
        array (
          0 => 
          array (
            'name' => 'scrm_feedback_contacts_1_name',
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
            'name' => 'passport_validity_c',
            'label' => 'LBL_PASSPORT_VALIDITY',
          ),
        ),
        1 => 
        array (
          0 => 
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
          1 => 
          array (
            'name' => 'sponsor_details_c',
            'studio' => 'visible',
            'label' => 'LBL_SPONSOR_DETAILS',
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
            'comment' => 'How did the contact come about',
            'label' => 'LBL_LEAD_SOURCE',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_travel_details_1_name',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'scrm_accommodation_contacts_1_name',
          ),
          1 => 
          array (
            'name' => 'scrm_partner_contacts_contacts_1_name',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'enquiry_id_c',
            'label' => 'LBL_ENQUIRY_ID',
          ),
        ),
      ),
    ),
  ),
);
?>
