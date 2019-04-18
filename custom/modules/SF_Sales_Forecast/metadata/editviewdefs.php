<?php
$module_name = 'SF_Sales_Forecast';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (


      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" value="Save" name="button" onclick="this.form.action.value=\'Save\'; if(  check_form(\'EditView\') && checkStatus())return true;else return false;" class="button primary" accesskey="S" title="Save [Alt+S]">',
          ),
          1 => 'CANCEL',
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
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'users_sf_sales_forecast_1_name',
            'label' => 'LBL_USERS_SF_SALES_FORECAST_1_FROM_USERS_TITLE',
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
          0 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
