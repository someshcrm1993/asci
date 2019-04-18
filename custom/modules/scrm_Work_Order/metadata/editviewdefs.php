<?php
$module_name = 'scrm_Work_Order';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
          0 => 
          array (
            'name' => 'proposal_status_asci_c',
            'studio' => 'visible',
            'label' => 'LBL_PROPOSAL_STATUS_ASCI',
          ),
          1 => 
          array (
            'name' => 'asci_rpf_reference_c',
            'label' => 'LBL_ASCI_RPF_REFERENCE',
          ),
        ),
        1 => 
        array (
          0 => 'description',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'scrm_work_order_opportunities_1_name',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'client_work_order_date_c',
            'label' => 'LBL_CLIENT_WORK_ORDER_DATE',
          ),
          1 => 
          array (
            'name' => 'client_work_order_reference_c',
            'label' => 'LBL_CLIENT_WORK_ORDER_REFERENCE',
          ),
        ),
        4 => 
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
        5 => 
        array (
          0 => 
          array (
            'name' => 'lead_faculty_1_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FACULTY_1',
            'displayParams' => 
            array (
              'initial_filter' => '&centre_c_advanced="+this.form.{$fields.lead_fac_1_centre_c.name}.value+"',
            ),
          ),
          1 => 
          array (
            'name' => 'lead_faculty_2_c',
            'studio' => 'visible',
            'label' => 'LBL_LEAD_FACULTY_2',
            'displayParams' => 
            array (
              'initial_filter' => '&centre_c_advanced="+this.form.{$fields.lead_fac_2_centre_c.name}.value+"',
            ),
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'accounts_scrm_work_order_1_name',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'total_no_programmes_awarded_c',
            'label' => 'LBL_TOTAL_NO_PROGRAMMES_AWARDED',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'other_payment_t_c',
            'label' => 'LBL_OTHER_PAYMENT_T_C',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'min_participants_per_batch_c',
            'label' => 'LBL_MIN_PARTICIPANTS_PER_BATCH',
          ),
          1 => 
          array (
            'name' => 'max_participants_per_batch_c',
            'label' => 'LBL_MAX_PARTICIPANTS_PER_BATCH',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'sp_total_expected_revenue_c',
            'label' => 'LBL_SP_TOTAL_EXPECTED_REVENUE',
          ),
          1 => 
          array (
            'name' => 'utilisation_certificate_req_c',
            'studio' => 'visible',
            'label' => 'LBL_UTILISATION_CERTIFICATE_REQ',
          ),
        ),
        11 => 
        array (
          0 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
