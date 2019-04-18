<?php
$module_name = 'scrm_Payment_Details';
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
          0 => 
          array (
            'name' => 'payment_date_c',
            'label' => 'LBL_PAYMENT_DATE',
          ),
          1 => 
          array (
            'name' => 'invoice_date_c',
            'label' => 'LBL_INVOICE_DATE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'invoice_number_c',
            'label' => 'LBL_INVOICE_NUMBER',
          ),
          1 => 
          array (
            'name' => 'accounts_scrm_payment_details_1_name',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'client_gst_number_c',
            'label' => 'LBL_CLIENT_GST_NUMBER_C',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE_C',
          ),
          1 => 
          array (
            'name' => 'project_scrm_payment_details_1_name',
          ),
        ),
        4 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'aos_invoices_scrm_payment_details_1_name',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'center_c',
            'studio' => 'visible',
            'label' => 'LBL_CENTER',
          ),
          1 => 
          array (
            'name' => 'mode_of_payment_c',
            'studio' => 'visible',
            'label' => 'LBL_MODE_OF_PAYMENT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'currency_id',
            'studio' => 'visible',
            'label' => 'LBL_CURRENCY',
          ),
          1 => 
          array (
            'name' => 'fees_c',
            'label' => 'LBL_FEES',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'tax_description_c',
            'studio' => 'visible',
            'label' => 'LBL_TAX_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'tax_amount_c',
            'label' => 'LBL_TAX_AMOUNT',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'tds_amount_deducted_c',
            'label' => 'LBL_TDS_AMOUNT_DEDUCTED',
          ),
        ),
        9 => 
        array (
          0 => 'description',
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
