<?php
$module_name = 'scrm_Sightseeing_Visits';
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
            'name' => 'visit_names_c',
            'studio' => 'visible',
            'label' => 'LBL_VISIT_NAMES',
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
          1 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_sightseeing_visits_1_name',
          ),
        ),
        2 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
