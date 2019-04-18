<?php
$viewdefs ['Project'] = 
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
      'form' => 
      array (
        'hidden' => '<input type="hidden" name="is_template" value="{$is_template}" />',
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 
          array (
            'customCode' => '{if !empty($smarty.request.return_action) && $smarty.request.return_action == "ProjectTemplatesDetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesDetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif !empty($smarty.request.return_action) && $smarty.request.return_action == "DetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'DetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif $is_template}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesListView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {/if}',
          ),
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_PROJECT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
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
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_project_information' => 
      array (
        0 => 
        array (
          0 => 'status',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programme_year_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_YEAR',
          ),
          1 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'programme_id_c',
            'label' => 'LBL_PROGRAMME_ID',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'area_subjects_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA_SUBJECTS',
          ),
          1 => 
          array (
            'name' => 'no_of_days_c',
            'label' => 'LBL_NO_OF_DAYS',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'start_date_c',
            'label' => 'LBL_START_DATE',
          ),
          1 => 
          array (
            'name' => 'end_date_c',
            'label' => 'LBL_END_DATE',
          ),
        ),
        5 => 
        array (
          0 => 'estimated_start_date',
          1 => 'estimated_end_date',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'estimated_start_date1_c',
            'label' => 'LBL_ESTIMATED_START_DATE1',
          ),
          1 => 
          array (
            'name' => 'estimated_end_date1_c',
            'label' => 'LBL_ESTIMATED_END_DATE1',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'date_receiving_nominee_c',
            'label' => 'LBL_DATE_RECEIVING_NOMINEE',
          ),
          1 => 
          array (
            'name' => 'ebd_date_c',
            'label' => 'LBL_EBD_DATE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'programme_group_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_GROUP_TYPE',
          ),
          1 => 
          array (
            'name' => 'cobrand_c',
            'label' => 'LBL_COBRAND',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'issue_certificate_c',
            'label' => 'LBL_ISSUE_CERTIFICATE',
          ),
          1 => 
          array (
            'name' => 'allot_souvenir_c',
            'label' => 'LBL_ALLOT_SOUVENIR',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'new_regular_c',
            'studio' => 'visible',
            'label' => 'LBL_NEW_REGULAR',
          ),
          1 => 
          array (
            'name' => 'no_of_participants_c',
            'label' => 'LBL_NO_OF_PARTICIPANTS',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'inauguration_date_time_c',
            'label' => 'LBL_INAUGURATION_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'overseas_tour_c',
            'studio' => 'visible',
            'label' => 'LBL_OVERSEAS_TOUR',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'from_date_c',
            'label' => 'LBL_FROM_DATE',
          ),
          1 => 
          array (
            'name' => 'to_date_c',
            'label' => 'LBL_TO_DATE',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'overseas_name_c',
            'label' => 'LBL_OVERSEAS_NAME',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'tshirt_c',
            'studio' => 'visible',
            'label' => 'LBL_TSHIRT',
          ),
          1 => '',
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'scrm_admin_arranges_project_1_name',
          ),
          1 => 
          array (
            'name' => 'project_scrm_timetable_1_name',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'lump_sum_c',
            'label' => 'LBL_LUMP_SUM',
          ),
          1 => 
          array (
            'name' => 'project_scrm_budget_1_name',
          ),
        ),
        17 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'programme_fee_c',
            'label' => 'LBL_PROGRAMME_FEE',
          ),
          1 => 
          array (
            'name' => 'usd_c',
            'label' => 'LBL_USD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'euro_c',
            'label' => 'LBL_EURO',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'programme_fee_non_res_c',
            'label' => 'LBL_PROGRAMME_FEE_NON_RES',
          ),
          1 => 
          array (
            'name' => 'usd_non_res_c',
            'label' => 'LBL_USD_NON_RES',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'euro_non_res_c',
            'label' => 'LBL_EURO_NON_RES',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'lump_sum_inr_c',
            'label' => 'LBL_LUMP_SUM_INR',
          ),
          1 => 
          array (
            'name' => 'lump_sum_usd_c',
            'label' => 'LBL_LUMP_SUM_USD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'lump_sum_euro_c',
            'label' => 'LBL_LUMP_SUM_EURO',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'venue_c',
            'studio' => 'visible',
            'label' => 'LBL_VENUE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'cr_no_c',
            'studio' => 'visible',
            'label' => 'LBL_CR_NO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'hotel_c',
            'label' => 'LBL_HOTEL',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'occupancy_chart_c',
            'label' => 'LBL_OCCUPANCY_CHART',
          ),
          1 => 
          array (
            'name' => 'dotp_approval_c',
            'label' => 'LBL_DOTP_APPROVAL',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'accommodation_c',
            'studio' => 'visible',
            'label' => 'LBL_ACCOMMODATION_C',
          ),
          1 => 
          array (
            'name' => 'room_no_cpc_new_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_CPC_NEW',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'room_no_cpc_old_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_CPC_OLD',
          ),
          1 => 
          array (
            'name' => 'room_no_bv_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_BV',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'occupancy_chart_2_c',
            'label' => 'LBL_OCCUPANCY_CHART_2',
          ),
          1 => 
          array (
            'name' => 'selected_rooms_c',
            'label' => 'LBL_SELECTED_ROOMS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'dg_flat_c',
            'label' => 'LBL_DG_FLAT',
          ),
          1 => 
          array (
            'name' => 'local_c',
            'label' => 'LBL_LOCAL',
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'spd_c',
            'studio' => 'visible',
            'label' => 'LBL_SPD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'comment' => 'Date record last modified',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
      ),
    ),
  ),
);
?>
