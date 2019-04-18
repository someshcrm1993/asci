<?php
$viewdefs ['Opportunities'] = 
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
            'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Create Proposal" onClick="document.location=\'index.php?module=Opportunities&action=EditView&return_module=Opportunities&return_action=DetailView\'">',
          ),
          5 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Generate Work Order" onClick="document.location=\'index.php?module=scrm_Work_Order&action=EditView&return_module=Opportunities&return_action=DetailView&return_id={$fields.id.value}\'">',
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'asci_rpf_reference_c',
            'label' => 'LBL_ASCI_RPF_REFERENCE',
          ),
        ),
        1 => 
        array (
          0 => 'account_name',
          1 => 
          array (
            'name' => 'client_rpf_ref_number_c',
            'label' => 'LBL_CLIENT_RPF_REF_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'client_rpf_date_c',
            'label' => 'LBL_CLIENT_RPF_DATE',
          ),
          1 => 
          array (
            'name' => 'date_of_initial_submission_c',
            'label' => 'LBL_DATE_OF_INITIAL_SUBMISSION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'date_submission_approved_prp_c',
            'label' => 'LBL_DATE_SUBMISSION_APPROVED_PRP',
          ),
          1 => 
          array (
            'name' => 'date_submission_rvsd_app_prp_c',
            'label' => 'LBL_DATE_SUBMISSION_RVSD_APP_PRP',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'fee_quoted_c',
            'label' => 'LBL_FEE_QUOTED',
          ),
          1 => 
          array (
            'name' => 'terms_conditions_c',
            'label' => 'LBL_TERMS_CONDITIONS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'lead_fac_1_centre_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FAC_1_CENTRE',
          ),
          1 => 
          array (
            'name' => 'lead_fac_2_centre_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FAC_2_CENTRE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'lead_faculty_1_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FACULTY_1',
          ),
          1 => 
          array (
            'name' => 'lead_faculty_2_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FACULTY_2',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'asci_proposal_status_c',
            'studio' => 'visible',
            'label' => 'LBL_ASCI_PROPOSAL_STATUS',
          ),
          1 => 
          array (
            'name' => 'asci_proposal_outcome_c',
            'studio' => 'visible',
            'label' => 'LBL_ASCI_PROPOSAL_OUTCOME',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'outcome_remark_c',
            'studio' => 'visible',
            'label' => 'LBL_OUTCOME_REMARK',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'currency_id',
            'comment' => 'Currency used for display purposes',
            'label' => 'LBL_CURRENCY',
          ),
          1 => '',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'total_expected_revenue_c',
            'label' => 'LBL_TOTAL_EXPECTED_REVENUE',
          ),
          1 => 
          array (
            'name' => 'date_proposal_closure_c',
            'label' => 'LBL_DATE_PROPOSAL_CLOSURE',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'date_award_work_order_c',
            'label' => 'LBL_DATE_AWARD_WORK_ORDER',
          ),
          1 => 
          array (
            'name' => 'client_work_order_ref_num_cd_c',
            'label' => 'LBL_CLIENT_WORK_ORDER_REF_NUM_CD',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'total_number_of_programs_prp_c',
            'label' => 'LBL_TOTAL_NUMBER_OF_PROGRAMS_PRP',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'min_number_of_participant_c',
            'label' => 'LBL_MIN_NUMBER_OF_PARTICIPANT',
          ),
          1 => 
          array (
            'name' => 'maximum_participant_c',
            'label' => 'LBL_MAXIMUM_PARTICIPANT',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'no_participants_trained_c',
            'label' => 'LBL_NO_PARTICIPANTS_TRAINED',
          ),
          1 => 
          array (
            'name' => 'fee_sanctioned_c',
            'label' => 'LBL_FEE_SANCTIONED',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'scrm_work_order_opportunities_1_name',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
