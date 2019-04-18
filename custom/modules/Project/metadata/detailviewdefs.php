<?php
$viewdefs ['Project'] = 
array (
  'DetailView' => 
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Project/Project.js',
        ),
        1 => 
        array (
          'file' => 'modules/Project/js/custom_project.js',
        ),
      ),
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button" type="submit" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}"onclick="{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'ProjectTemplatesEditView\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'; {/if}"/>',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => ' {$APP.LBL_EDIT_BUTTON_LABEL} ',
              'htmlOptions' => 
              array (
                'id' => 'edit_button',
                'class' => 'button',
                'accessKey' => '{$APP.LBL_EDIT_BUTTON_KEY}',
                'name' => 'Edit',
                'onclick' => '{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'ProjectTemplatesEditView\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'; {/if}',
              ),
            ),
          ),
          1 => 
          array (
            'customCode' => '<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" type="button" name="Delete" id="delete_button" value="{$APP.LBL_DELETE_BUTTON_LABEL}" onclick="project_delete(this);"/>',
            'sugar_html' => 
            array (
              'type' => 'button',
              'id' => 'delete_button',
              'value' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DELETE_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_DELETE_BUTTON_KEY}',
                'id' => 'delete_button',
                'class' => 'button',
                'onclick' => 'project_delete(this);',
              ),
            ),
          ),
          2 => 
          array (
            'customCode' => '<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" type="submit" name="Duplicate" id="duplicate_button" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}"onclick="{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'projecttemplateseditview\'; this.form.return_id.value=\'{$id}\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'; this.form.return_id.value=\'{$id}\';{/if}""/>',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_DUPLICATE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DUPLICATE_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_DUPLICATE_BUTTON_KEY}',
                'class' => 'button',
                'name' => 'Duplicate',
                'id' => 'duplicate_button',
                'onclick' => '{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'projecttemplateseditview\'; this.form.return_id.value=\'{$id}\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'; this.form.return_id.value=\'{$id}\';{/if}',
              ),
            ),
          ),
          3 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Create Project" onClick="document.location=\'index.php?module=Project&action=EditView&return_module=Project&return_action=DetailView\'">',
          ),
          4 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="feedback" id="feedback" value="View Feedback" onClick="document.location=\'index.php?module=Project&action=feedback&return_module=Project&return_action=DetailView&id={$id}\'">',
          ),
          5 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="pdReport" id="pdReport" value="Print PD\'s Report" onClick="document.location=\'index.php?module=Project&action=pdReport&return_module=Project&return_action=DetailView&id={$id}\'">',
          ),
          6 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="sendAcceptanceToAllNominations" id="sendAcceptanceToAllNominations" value="Send Acceptance To All Nominations" onClick="document.location=\'index.php?module=Project&action=sendAcceptanceToAllNominations&return_module=Project&return_action=DetailView&id={$id}\'">',
          ),
          7 => 
          array (
            'customCode' => '{if $fields.programme_type_c.value == "Announced" }<input type="submit" class="button" name="SendAcceptanceToSponsor" id="SendAcceptanceToSponsor" value="Send Acceptance To Sponsors" onClick="document.location=\'index.php?module=Project&action=SendAcceptanceToSponsor&return_module=Project&return_action=DetailView&id={$id}\'">{/if}',
          ),
          8 => 
          array (
            'customCode' => '{if $fields.status.value == "Cancelled" }<input type="submit" class="button" name="sendCancellationToSponsor" id="sendCancellationToSponsor" value="Send Cancellation To Sponsors" onClick="document.location=\'index.php?module=Project&action=sendCancellationToSponsor&return_module=Project&return_action=DetailView&id={$id}\'">{/if}',
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
          0 => 
          array (
            'name' => 'estimated_start_date',
            'label' => 'LBL_DATE_START',
          ),
          1 => 
          array (
            'name' => 'estimated_end_date',
            'label' => 'LBL_DATE_END',
          ),
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
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
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
