<?php
$module_name = 'scrm_Qualification';
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
          0 => 'name',
          1 => 
          array (
            'name' => 'subjects',
            'label' => 'LBL_SUBJECTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'year',
            'label' => 'LBL_YEAR',
          ),
          1 => 
          array (
            'name' => 'university_institution',
            'label' => 'LBL_UNIVERSITY_INSTITUTION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_qualification_1_name',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
