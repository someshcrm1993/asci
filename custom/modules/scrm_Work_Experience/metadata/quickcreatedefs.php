<?php
$module_name = 'scrm_Work_Experience';
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
          0 => 'name',
          1 => 
          array (
            'name' => 'positon',
            'label' => 'LBL_POSITON',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'years_of_experience',
            'label' => 'LBL_YEARS_OF_EXPERIENCE',
          ),
          1 => 
          array (
            'name' => 'gross_salary',
            'label' => 'LBL_GROSS_SALARY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_work_experience_1_name',
            'label' => 'LBL_CONTACTS_SCRM_WORK_EXPERIENCE_1_FROM_CONTACTS_TITLE',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
