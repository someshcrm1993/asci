<?php
$module_name = 'scrm_Social_Recreational_Events';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'events_c',
            'studio' => 'visible',
            'label' => 'LBL_EVENTS',
          ),
          1 => 
          array (
            'name' => 'start_date_time_c',
            'label' => 'LBL_START_DATE_TIME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'participants_c',
            'label' => 'LBL_PARTICIPANTS',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_social_recreational_events_1_name',
            'label' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SOCIAL_RECREATIONAL_EVENTS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>
