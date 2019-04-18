<?php
$module_name = 'scrm_Programme_Details';
$viewdefs [$module_name] = 
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
          0 => 
          array (
            'name' => 'programme_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME',
          ),
          1 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'duration_in_working_days_c',
            'label' => 'LBL_DURATION_IN_WORKING_DAYS',
          ),
          1 => 
          array (
            'name' => 'fee_per_participant_c',
            'label' => 'LBL_FEE_PER_PARTICIPANT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'calendar_type_c',
            'studio' => 'visible',
            'label' => 'LBL_CALENDAR_TYPE',
          ),
          1 => 
          array (
            'name' => 'number_of_batches_c',
            'label' => 'LBL_NUMBER_OF_BATCHES',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'no_participants_trained_c',
            'label' => 'LBL_NO_PARTICIPANTS_TRAINED',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'preferred_start_date1_c',
            'label' => 'LBL_PREFERRED_START_DATE1',
          ),
          1 => 
          array (
            'name' => 'preferred_end_date1_c',
            'label' => 'LBL_PREFERRED_END_DATE1',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'preferred_start_date2_c',
            'label' => 'LBL_PREFERRED_START_DATE2',
          ),
          1 => 
          array (
            'name' => 'preferred_end_date2_c',
            'label' => 'LBL_PREFERRED_END_DATE2',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'other_t_c',
            'studio' => 'visible',
            'label' => 'LBL_OTHER_T_C',
          ),
          1 => 
          array (
            'name' => 'programme_status_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_STATUS',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'proposal_letter_c',
            'label' => 'LBL_PROPOSAL_LETTER',
          ),
          1 => 
          array (
            'name' => 'total_no_of_calendar_week_c',
            'label' => 'LBL_TOTAL_NO_OF_CALENDAR_WEEK',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'utilization_certificate_c',
            'studio' => 'visible',
            'label' => 'LBL_UTILIZATION_CERTIFICATE',
          ),
          1 => '',
        ),
        9 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'opportunities_scrm_programme_details_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
