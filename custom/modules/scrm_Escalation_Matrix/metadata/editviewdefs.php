<?php
$module_name = 'scrm_Escalation_Matrix';
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
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
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
          0 => '',
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'teams_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAMS',
          ),
          1 => 
          array (
            'name' => 'escalation_level_c',
            'studio' => 'visible',
            'label' => 'LBL_ESCALATION_LEVEL',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'email_template_3_c',
            'studio' => 'visible',
            'label' => 'LBL_EMAIL_TEMPLATE_3',
          ),
          1 => 
          array (
            'name' => 'escalation_minutes_level1_c',
            'studio' => 'visible',
            'label' => 'LBL_ESCALATION_MINUTES_LEVEL1',
          ),
        ),
        1 => 
        array (
          0 => '',
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'email_template_2_c',
            'studio' => 'visible',
            'label' => 'LBL_EMAIL_TEMPLATE_2',
          ),
          1 => 
          array (
            'name' => 'escalation_minutes_level2_c',
            'studio' => 'visible',
            'label' => 'LBL_ESCALATION_MINUTES_LEVEL2',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'email_template_1_c',
            'studio' => 'visible',
            'label' => 'LBL_EMAIL_TEMPLATE_1',
          ),
          1 => 
          array (
            'name' => 'escalation_minutes_level3_c',
            'studio' => 'visible',
            'label' => 'LBL_ESCALATION_MINUTES_LEVEL3',
          ),
        ),
        1 => 
        array (
          0 => '',
        ),
      ),
    ),
  ),
);
?>
