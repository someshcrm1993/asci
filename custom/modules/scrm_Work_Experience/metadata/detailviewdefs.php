<?php
$module_name = 'scrm_Work_Experience';
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
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
