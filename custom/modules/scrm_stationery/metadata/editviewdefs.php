<?php
$module_name = 'scrm_stationery';
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
            'name' => 'items_c',
            'studio' => 'visible',
            'label' => 'LBL_ITEMS',
          ),
          1 => 
          array (
            'name' => 'participants_c',
            'label' => 'LBL_PARTICIPANTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'faculty_c',
            'label' => 'LBL_FACULTY',
          ),
          1 => 
          array (
            'name' => 'others_c',
            'label' => 'LBL_OTHERS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'total_c',
            'label' => 'LBL_TOTAL',
          ),
          1 => 
          array (
            'name' => 'general_stationery_c',
            'studio' => 'visible',
            'label' => 'LBL_GENERAL_STATIONERY',
          ),
        ),
        3 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'scrm_admin_arranges_scrm_stationery_1_name',
            'label' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_STATIONERY_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>
