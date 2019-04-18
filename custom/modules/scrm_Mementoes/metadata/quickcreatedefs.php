<?php
$module_name = 'scrm_Mementoes';
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
            'name' => 'items_c',
            'studio' => 'visible',
            'label' => 'LBL_ITEMS_C',
          ),
          1 => 
          array (
            'name' => 'guest_faculty_c',
            'label' => 'LBL_GUEST_FACULTY ',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'others_c',
            'label' => 'LBL_OTHERS',
          ),
          1 => 
          array (
            'name' => 'total_c',
            'label' => 'LBL_TOTAL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_mementoes_1_name',
            'label' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_MEMENTOES_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>
