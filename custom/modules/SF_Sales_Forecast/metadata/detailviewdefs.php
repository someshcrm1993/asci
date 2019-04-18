<?php
$module_name = 'SF_Sales_Forecast';
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
          array (
              'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Create Sales Target" onClick="document.location=\'index.php?module=SF_Sales_Forecast&action=EditView&return_module=SF_Sales_Forecast&return_action=DetailView\'">',
            ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
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
            'name' => 'users_sf_sales_forecast_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'year',
            'studio' => 'visible',
            'label' => 'LBL_YEAR',
          ),
          1 => 
          array (
            'name' => 'quarter',
            'studio' => 'visible',
            'label' => 'LBL_QUARTER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'sales_target',
            'label' => 'LBL_SALES_TARGET',
          ),
          1 => 
          array (
            'name' => 'opportunities_won',
            'label' => 'LBL_OPPORTUNITIES_WON',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
