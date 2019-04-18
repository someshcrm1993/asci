<?php
$listViewDefs ['Opportunities'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_OPPORTUNITY_NAME',
    'link' => true,
    'default' => true,
  ),
  'ASCI_PROPOSAL_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ASCI_PROPOSAL_STATUS',
    'width' => '10%',
  ),
  'ASCI_RPF_REFERENCE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ASCI_RPF_REFERENCE',
    'width' => '10%',
  ),
  'CLIENT_RPF_REF_NUMBER_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CLIENT_RPF_REF_NUMBER',
    'width' => '10%',
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'DATE_CLOSED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DATE_CLOSED',
    'default' => false,
  ),
  'SALES_STAGE' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_SALES_STAGE',
    'default' => false,
  ),
  'AMOUNT_USDOLLAR' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_AMOUNT_USDOLLAR',
    'align' => 'right',
    'default' => false,
    'currency_format' => true,
  ),
  'PROPOSAL_ID_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_PROPOSAL_ID ',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'module' => 'Accounts',
    'link' => true,
    'default' => false,
    'sortable' => true,
    'ACLTag' => 'ACCOUNT',
    'contextMenu' => 
    array (
      'objectType' => 'sugarAccount',
      'metaData' => 
      array (
        'return_module' => 'Contacts',
        'return_action' => 'ListView',
        'module' => 'Accounts',
        'parent_id' => '{$ACCOUNT_ID}',
        'parent_name' => '{$ACCOUNT_NAME}',
        'account_id' => '{$ACCOUNT_ID}',
        'account_name' => '{$ACCOUNT_NAME}',
      ),
    ),
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'OPPORTUNITY_TYPE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'default' => false,
  ),
  'LEAD_SOURCE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LEAD_SOURCE',
    'default' => false,
  ),
  'NEXT_STEP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_NEXT_STEP',
    'default' => false,
  ),
  'PROBABILITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PROBABILITY',
    'default' => false,
  ),
  'ACTUAL_DATE_CLOSED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_ACTUAL_DATE_CLOSED',
    'width' => '10%',
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
);
?>
