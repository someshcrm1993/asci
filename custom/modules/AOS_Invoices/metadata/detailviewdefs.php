<?php
$module_name = 'AOS_Invoices';
$_object_name = 'aos_invoices';
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
        'LBL_PANEL_OVERVIEW' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_INVOICE_TO' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_LINE_ITEMS' => 
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
      'LBL_PANEL_OVERVIEW' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'number',
            'label' => 'LBL_INVOICE_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'invoice_reference_no_c',
            'label' => 'LBL_INVOICE_REFERENCE_NO',
          ),
          1 => 
          array (
            'name' => 'stage_c',
            'studio' => 'visible',
            'label' => 'LBL_STAGE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'due_date',
            'label' => 'LBL_DUE_DATE',
          ),
          1 => 
          array (
            'name' => 'invoice_date',
            'label' => 'LBL_INVOICE_DATE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'regd_no_c',
            'label' => 'LBL_REGD_NO',
          ),
          1 => 
          array (
            'name' => 'tax_payable_c',
            'studio' => 'visible',
            'label' => 'LBL_TAX_PAYABLE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'kind_attention_c',
            'label' => 'LBL_KIND_ATTENTION',
          ),
          1 => 
          array (
            'name' => 'pan_c',
            'label' => 'LBL_PAN',
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
            'name' => 'proforma_invoice_c',
            'studio' => 'visible',
            'label' => 'LBL_PROFORMA_INVOICE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'programme_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMME_TYPE',
          ),
          1 => 
          array (
            'name' => 'project_aos_invoices_1_name',
            'label' => 'LBL_PROJECT_AOS_INVOICES_1_FROM_PROJECT_TITLE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'programme_fee_c',
            'label' => 'LBL_PROGRAMME_FEE',
          ),
          1 => 
          array (
            'name' => 'programme_fee_non_res_c',
            'label' => 'LBL_PROGRAMME_FEE_NON_RES',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'no_of_days_c',
            'label' => 'LBL_NO_OF_DAYS',
          ),
          1 => 
          array (
            'name' => 'minimum_no_participant_c',
            'label' => 'LBL_MINIMUM_NO_PARTICIPANT',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'place_of_supply_c',
            'label' => 'LBL_PLACE_OF_SUPPLY',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'payment_mode_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_MODE',
          ),
          1 => 
          array (
            'name' => 'actual_payment_made_c',
            'label' => 'LBL_ACTUAL_PAYMENT_MADE',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'invoice_type_c',
            'studio' => 'visible',
            'label' => 'LBL_INVOICE_TYPE',
          ),
          1 => 
          array (
            'name' => 'self_sponsored_c',
            'label' => 'LBL_SELF_SPONSORED',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'special_note_c',
            'studio' => 'visible',
            'label' => 'LBL_SPECIAL_NOTE',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'note_c',
            'label' => 'LBL_NOTE',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'bank_c',
            'studio' => 'visible',
            'label' => 'LBL_BANK',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'refund_bank_name_c',
            'label' => 'LBL_REFUND_BANK_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'refund_address_line_1_c',
            'label' => 'LBL_REFUND_ADDRESS_LINE_1',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'refund_address_line_2_c',
            'label' => 'LBL_REFUND_ADDRESS_LINE_2',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'refund_address_line_3_c',
            'label' => 'LBL_REFUND_ADDRESS_LINE_3',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'refund_bank_account_number_c',
            'label' => 'LBL_REFUND_BANK_ACCOUNT_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'beneficiary_account_name_c',
            'label' => 'LBL_BENEFICIARY_ACCOUNT_NAME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'refund_bank_micr_no_c',
            'label' => 'LBL_REFUND_BANK_MICR_NO',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'refund_neft_ifsc_code_c',
            'label' => 'LBL_REFUND_NEFT_IFSC_CODE',
          ),
        ),
      ),
      'LBL_INVOICE_TO' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'billing_account',
            'label' => 'LBL_BILLING_ACCOUNT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'self_sponsor_c',
            'studio' => 'visible',
            'label' => 'LBL_SELF_SPONSOR',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'label' => 'LBL_BILLING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
            ),
          ),
          1 => 
          array (
            'name' => 'shipping_address_street',
            'label' => 'LBL_SHIPPING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
            ),
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'client_type_c',
            'studio' => 'visible',
            'label' => 'LBL_CLIENT_TYPE',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'tax_type_c',
            'studio' => 'visible',
            'label' => 'LBL_TAX_TYPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'client_gst1_c',
            'label' => 'LBL_CLIENT_GST1',
          ),
        ),
      ),
      'lbl_line_items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'no_of_participants_c',
            'label' => 'LBL_NO_OF_PARTICIPANTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'participant_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTICIPANT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'line_items',
            'label' => 'LBL_LINE_ITEMS',
            'customCode' => '{include file=\'custom/modules/AOS_Invoices/lineitems.tpl\'}',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'participant_list_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTICIPANT_LIST',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'entry_1_c',
            'label' => 'LBL_ENTRY_1',
          ),
          1 => 
          array (
            'name' => 'amount_1_c',
            'label' => 'LBL_AMOUNT_1',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'entry_2_c',
            'label' => 'LBL_ENTRY_2',
          ),
          1 => 
          array (
            'name' => 'amount_2_c',
            'label' => 'LBL_AMOUNT_2',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'entry_3_c',
            'label' => 'LBL_ENTRY_3',
          ),
          1 => 
          array (
            'name' => 'amount_3_c',
            'label' => 'LBL_AMOUNT_3',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'total_amt',
            'label' => 'LBL_TOTAL_AMT',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'discount_in_per_c',
            'label' => 'LBL_DISCOUNT_IN_PER',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'discount_amount',
            'label' => 'LBL_DISCOUNT_AMOUNT',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'subtotal_amount',
            'label' => 'LBL_SUBTOTAL_AMOUNT',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'cgst_c',
            'label' => 'LBL_CGST',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'sgst_c',
            'label' => 'LBL_SGST',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'igst_c',
            'label' => 'LBL_IGST',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'ugst_c',
            'label' => 'LBL_UGST',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'tax_amount',
            'label' => 'LBL_TAX_AMOUNT',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'accommodation_c',
            'label' => 'LBL_ACCOMMODATION',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'living_allowance_c',
            'label' => 'LBL_LIVING_ALLOWANCE',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'other_reimbursement_c',
            'label' => 'LBL_OTHER_REIMBURSEMENT',
          ),
        ),
        19 => 
        array (
          0 => 
          array (
            'name' => 'adjustment_note_c',
            'label' => 'LBL_ADJUSTMENT_NOTE',
          ),
          1 => '',
        ),
        20 => 
        array (
          0 => 
          array (
            'name' => 'less_adjustments_c',
            'label' => 'LBL_LESS_ADJUSTMENTS',
          ),
          1 => '',
        ),
        21 => 
        array (
          0 => 
          array (
            'name' => 'total_amount',
            'label' => 'LBL_GRAND_TOTAL',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'approval_po_c',
            'label' => 'LBL_APPROVAL_PO',
          ),
          1 => 
          array (
            'name' => 'fo_approval_c',
            'label' => 'LBL_FO_APPROVAL',
          ),
        ),
      ),
    ),
  ),
);
?>
