<?php
$module_name = 'scrm_Admin_Arranges';
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
        'LBL_EDITVIEW_PANEL1' => 
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
            'name' => 'scrm_admin_arranges_project_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programme_from_date_c',
            'label' => 'LBL_PROGRAMME_FROM_DATE',
          ),
          1 => 
          array (
            'name' => 'programme_to_date_c',
            'label' => 'LBL_PROGRAMME_TO_DATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'inauguration_date_time_c',
            'label' => 'LBL_INAUGURATION_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'airo_briefing_date_and_time_c',
            'label' => 'LBL_AIRO_BRIEFING_DATE_AND_TIME',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'conference_room_c',
            'studio' => 'visible',
            'label' => 'LBL_CONFERENCE_ROOM',
          ),
          1 => 
          array (
            'name' => 'group_photograph_date_time_c',
            'label' => 'LBL_GROUP_PHOTOGRAPH_DATE_TIME',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'no_of_participants_c',
            'label' => 'LBL_NO_OF_PARTICIPANTS',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'special_event_date_time_c',
            'label' => 'LBL_SPECIAL_EVENT_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'pc_lcd_date_time_c',
            'label' => 'LBL_PC_LCD_DATE_TIME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'audio_recording_1_date_time_c',
            'label' => 'LBL_AUDIO_RECORDING_1_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'audio_recording_2_c',
            'label' => 'LBL_AUDIO_RECORDING_2',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'video_recording_1_date_time_c',
            'label' => 'LBL_VIDEO_RECORDING_1_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'video_recording_2_c',
            'label' => 'LBL_VIDEO_RECORDING_2',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'other_audio_visual_aids_c',
            'label' => 'LBL_OTHER_AUDIO_VISUAL_AIDS',
          ),
          1 => 
          array (
            'name' => 'other_c',
            'label' => 'LBL_OTHER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'yoga_date_time_c',
            'label' => 'LBL_YOGA_DATE_TIME',
          ),
          1 => 'assigned_user_name',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'approval_airo_c',
            'studio' => 'visible',
            'label' => 'LBL_APPROVAL_AIRO',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
