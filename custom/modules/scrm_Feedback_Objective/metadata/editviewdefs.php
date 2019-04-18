<?php
$module_name = 'scrm_Feedback_Objective';
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programme_objective_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_OBJECTIVE',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'scrm_feedback_scrm_feedback_objective_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
