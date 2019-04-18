<?php
$module_name = 'scrm_Programme_Information';
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
            'name' => 'programme_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME',
          ),
          1 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'utilisation_certificate_c',
            'studio' => 'visible',
            'label' => 'LBL_UTILISATION_CERTIFICATE',
          ),
          1 => 
          array (
            'name' => 'other_payment_t_c',
            'label' => 'LBL_OTHER_PAYMENT_T_C',
          ),
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'scrm_work_order_scrm_programme_information_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
