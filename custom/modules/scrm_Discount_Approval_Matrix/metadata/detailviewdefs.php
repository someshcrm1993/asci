<?php
$module_name = 'scrm_Discount_Approval_Matrix';
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
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
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
            'name' => 'teams_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAMS',
          ),
          1 => 
          array (
            'name' => 'approval_levels_c',
            'studio' => 'visible',
            'label' => 'LBL_APPROVAL_LEVELS',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'discount1_c',
            'studio' => 'visible',
            'label' => 'LBL_DISCOUNT1',
          ),
          1 => 
          array (
            'name' => 'role1_c',
            'studio' => 'visible',
            'label' => 'LBL_ROLE1',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'discount2_c',
            'studio' => 'visible',
            'label' => 'LBL_DISCOUNT2',
          ),
          1 => 
          array (
            'name' => 'role2_c',
            'studio' => 'visible',
            'label' => 'LBL_ROLE2',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'discount3_c',
            'studio' => 'visible',
            'label' => 'LBL_DISCOUNT3',
          ),
          1 => 
          array (
            'name' => 'role3_c',
            'studio' => 'visible',
            'label' => 'LBL_ROLE3',
          ),
        ),
      ),
    ),
  ),
);
?>
