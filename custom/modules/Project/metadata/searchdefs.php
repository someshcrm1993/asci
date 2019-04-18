<?php
$searchdefs ['Project'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'programme_id_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PROGRAMME_ID',
        'width' => '10%',
        'name' => 'programme_id_c',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'programme_type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PROGRAMME_TYPE',
        'width' => '10%',
        'name' => 'programme_type_c',
      ),
      'programme_year_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PROGRAMME_YEAR',
        'width' => '10%',
        'name' => 'programme_year_c',
      ),
      'start_date_c' => 
      array (
        'type' => 'date',
        'default' => true,
        'label' => 'LBL_START_DATE',
        'width' => '10%',
        'name' => 'start_date_c',
      ),
      'end_date_c' => 
      array (
        'type' => 'date',
        'default' => true,
        'label' => 'LBL_END_DATE',
        'width' => '10%',
        'name' => 'end_date_c',
      ),
      'assigned_user_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ASSIGNED_USER_NAME',
        'id' => 'ASSIGNED_USER_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'assigned_user_name',
      ),
      'spd_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SPD',
        'id' => 'SCRM_PARTNERS_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'spd_c',
      ),
    ),
    'advanced_search' => 
    array (
      0 => 'name',
      1 => 'estimated_start_date',
      2 => 'estimated_end_date',
      3 => 'status',
      4 => 'priority',
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
