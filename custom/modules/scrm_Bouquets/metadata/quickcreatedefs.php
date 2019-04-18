<?php
$module_name = 'scrm_Bouquets';
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
            'name' => 'number_of_bouquets_c',
            'label' => 'LBL_NUMBER_OF_BOUQUETS',
          ),
          1 => 
          array (
            'name' => 'date_time_c',
            'label' => 'LBL_DATE_TIME',
          ),
        ),
        1 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_bouquets_1_name',
            'label' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_BOUQUETS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>
