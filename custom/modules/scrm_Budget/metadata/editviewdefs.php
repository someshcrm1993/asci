<?php
$module_name = 'scrm_Budget';
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
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL10' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL11' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'project_scrm_budget_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'prg_fee_per_participant_c',
            'label' => 'LBL_PRG_FEE_PER_PARTICIPANT',
          ),
          1 => 
          array (
            'name' => 'prog_fee_per_participant_usd_c',
            'label' => 'LBL_PROG_FEE_PER_PARTICIPANT_USD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'no_of_participants_c',
            'label' => 'LBL_NO_OF_PARTICIPANTS',
          ),
          1 => 
          array (
            'name' => 'no_foreign_usd_participants_c',
            'label' => 'LBL_NO_FOREIGN_USD_PARTICIPANTS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'total_programme_income_c',
            'label' => 'LBL_TOTAL_PROGRAMME_INCOME',
          ),
          1 => 
          array (
            'name' => 'usd_to_inr_rate_c',
            'label' => 'LBL_USD_TO_INR_RATE_C',
          ),
        ),
        4 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'programmefee_for_foreignpart_c',
            'label' => 'LBL_PROGRAMMEFEE_FOR_FOREIGNPART',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'brochure_printing_costs_c',
            'label' => 'LBL_BROCHURE_PRINTING_COSTS',
          ),
          1 => 
          array (
            'name' => 'advertisement_cost_c',
            'label' => 'LBL_ADVERTISEMENT_COST',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mailing_costs_c',
            'label' => 'LBL_MAILING_COSTS',
          ),
          1 => 
          array (
            'name' => 'training_kit_c',
            'label' => 'LBL_TRAINING_KIT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'group_photo_c',
            'label' => 'LBL_GROUP_PHOTO',
          ),
          1 => 
          array (
            'name' => 'books_journals_etc_c',
            'label' => 'LBL_BOOKS_JOURNALS_ETC',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mess_charges_c',
            'label' => 'LBL_MESS_CHARGES',
          ),
          1 => 
          array (
            'name' => 'hostel_charges_c',
            'label' => 'LBL_HOSTEL_CHARGES',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'arrival_departure_cost_c',
            'label' => 'LBL_ARRIVAL_DEPARTURE_COST',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'study_tour_c',
            'label' => 'LBL_STUDY_TOUR',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'p_reading_material_c',
            'label' => 'LBL_P_READING_MATERIAL',
          ),
          1 => 
          array (
            'name' => 'material_for_distribution_c',
            'label' => 'LBL_MATERIAL_FOR_DISTRIBUTION',
          ),
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'travel_c',
            'label' => 'LBL_TRAVEL',
          ),
          1 => 
          array (
            'name' => 'honorarium_c',
            'label' => 'LBL_HONORARIUM',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mementoes_c',
            'label' => 'LBL_MEMENTOES',
          ),
          1 => 
          array (
            'name' => 'incidentals_c',
            'label' => 'LBL_INCIDENTALS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'total_c',
            'label' => 'LBL_TOTAL',
          ),
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fees_c',
            'label' => 'LBL_FEES ',
          ),
          1 => 
          array (
            'name' => 'caps_and_t_shirts_c',
            'label' => 'LBL_CAPS_AND_T_SHIRTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'business_simulation_c',
            'label' => 'LBL_BUSINESS_SIMULATION',
          ),
          1 => 
          array (
            'name' => 'module_outsourcing_c',
            'label' => 'LBL_MODULE_OUTSOURCING',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'sight_seeing_norms_c',
            'studio' => 'visible',
            'label' => 'LBL_SIGHT_SEEING_NORMS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sound_light_show_c',
            'label' => 'LBL_SOUND_LIGHT_SHOW',
          ),
          1 => 
          array (
            'name' => 'ramoji_film_city_c',
            'label' => 'LBL_RAMOJI_FILM_CITY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'city_tour_c',
            'label' => 'LBL_CITY_TOUR',
          ),
          1 => 
          array (
            'name' => 'others_visits_c',
            'label' => 'LBL_OTHERS_VISITS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'bus_charges_c',
            'label' => 'LBL_BUS_CHARGES',
          ),
          1 => 
          array (
            'name' => 'other_misc_expenditure_c',
            'label' => 'LBL_OTHER_MISC_EXPENDITURE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'videography_c',
            'label' => 'LBL_VIDEOGRAPHY',
          ),
          1 => 
          array (
            'name' => 'hire_of_laptops_c',
            'label' => 'LBL_HIRE_OF_LAPTOPS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'cultural_event_c',
            'label' => 'LBL_CULTURAL_EVENT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'sub_total_cash_exp_c',
            'label' => 'LBL_SUB_TOTAL_CASH_EXP',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'contribution_available_ohds_c',
            'label' => 'LBL_CONTRIBUTION_AVAILABLE_OHDS',
          ),
        ),
      ),
      'lbl_editview_panel10' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'faculty_cost_c',
            'label' => 'LBL_FACULTY_COST',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'sub_total_charge_exp_c',
            'label' => 'LBL_SUB_TOTAL_CHARGE_EXP',
          ),
        ),
      ),
      'lbl_editview_panel11' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'training_infrastructure_c',
            'label' => 'LBL_TRAINING_INFRASTRUCTURE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programmes_at_asci_c',
            'label' => 'LBL_PROGRAMMES_AT_ASCI',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'programmes_off_campus_c',
            'label' => 'LBL_PROGRAMMES_OFF_CAMPUS',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'corporate_overhead_c',
            'label' => 'LBL_CORPORATE_OVERHEAD',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'sub_total_overhead_expd_c',
            'label' => 'LBL_SUB_TOTAL_OVERHEAD_EXPD',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'total_expenditure_c',
            'label' => 'LBL_TOTAL_EXPENDITURE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'surplus_deficit_c',
            'label' => 'LBL_SURPLUS_DEFICIT',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'currency_id',
            'studio' => 'visible',
            'label' => 'LBL_CURRENCY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'expenditure_knowledge_prtn_c',
            'label' => 'LBL_EXPENDITURE_KNOWLEDGE_PRTN',
          ),
          1 => 
          array (
            'name' => 'tax_c',
            'label' => 'LBL_TAX',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'total_expenditure_k_p_c',
            'label' => 'LBL_TOTAL_EXPENDITURE_K_P',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'air_fare_participants_c',
            'label' => 'LBL_AIR_FARE_PARTICIPANTS',
          ),
          1 => 
          array (
            'name' => 'air_fare_pg_d_c',
            'label' => 'LBL_AIR_FARE_PG_D',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'accomodation_c',
            'label' => 'LBL_ACCOMODATION',
          ),
          1 => 
          array (
            'name' => 'board_food_expenses_c',
            'label' => 'LBL_BOARD_FOOD_EXPENSES',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'airport_transfers_c',
            'label' => 'LBL_AIRPORT_TRANSFERS',
          ),
          1 => 
          array (
            'name' => 'tour_expenses_coach_c',
            'label' => 'LBL_TOUR_EXPENSES_COACH',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'total_travel_stay_c',
            'label' => 'LBL_TOTAL_TRAVEL_STAY',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'faculty_per_diem_c',
            'label' => 'LBL_FACULTY_PER_DIEM',
          ),
          1 => 
          array (
            'name' => 'fac_allowance_tour_c',
            'label' => 'LBL_FAC_ALLOWANCE_TOUR',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'special_grant_warm_cloth_c',
            'label' => 'LBL_SPECIAL_GRANT_WARM_CLOTH',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'total_faculty_allowance_c',
            'label' => 'LBL_TOTAL_FACULTY_ALLOWANCE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'international_roaming_data_c',
            'label' => 'LBL_INTERNATIONAL_ROAMING_DATA_C',
          ),
          1 => 
          array (
            'name' => 'miscellaneous_expenses_gift_c',
            'label' => 'LBL_MISCELLANEOUS_EXPENSES_GIFT',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'contingencies_c',
            'label' => 'LBL_CONTINGENCIES',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'total_other_expenses_c',
            'label' => 'LBL_TOTAL_OTHER_EXPENSES',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'grand_total_c',
            'label' => 'LBL_GRAND_TOTAL',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ac_approval_c',
            'studio' => 'visible',
            'label' => 'LBL_AC_APPROVAL_C',
          ),
          1 => 
          array (
            'name' => 'ac_assigned_to_c',
            'studio' => 'visible',
            'label' => 'LBL_AC_ASSIGNED_TO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'remark_ac_c',
            'studio' => 'visible',
            'label' => 'LBL_REMARK_AC_C',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'cd_approval_c',
            'studio' => 'visible',
            'label' => 'LBL_CD_APPROVAL_C',
          ),
          1 => 
          array (
            'name' => 'cd_assigned_to_c',
            'studio' => 'visible',
            'label' => 'LBL_CD_ASSIGNED_TO',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'remark_cd_c',
            'studio' => 'visible',
            'label' => 'LBL_REMARK_CD_C',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'dotp_approval_c',
            'studio' => 'visible',
            'label' => 'LBL_DOTP_APPROVAL_C',
          ),
          1 => 
          array (
            'name' => 'dotp_assigned_user_c',
            'studio' => 'visible',
            'label' => 'LBL_DOTP_ASSIGNED_USER',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'remark_dotp_c',
            'studio' => 'visible',
            'label' => 'LBL_REMARK_DOTP_C',
          ),
        ),
      ),
    ),
  ),
);
?>
