<?php
$dashletData['OpportunitiesDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'opportunity_type' => 
  array (
    'default' => '',
  ),
  'sales_stage' => 
  array (
    'default' => 
    array (
      0 => 'Prospecting',
      1 => 'Qualification',
      2 => 'Needs Analysis',
      3 => 'Value Proposition',
      4 => 'Id. Decision Makers',
      5 => 'Perception Analysis',
      6 => 'Proposal/Price Quote',
      7 => 'Negotiation/Review',
    ),
  ),
  'assigned_user_id' => 
  array (
    'type' => 'assigned_user_name',
    'label' => 'LBL_ASSIGNED_TO',
    'default' => 'Administrator',
  ),
);
$dashletData['OpportunitiesDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '35%',
    'label' => 'LBL_OPPORTUNITY_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'asci_rpf_reference_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ASCI_RPF_REFERENCE',
    'width' => '10%',
  ),
  'account_name' => 
  array (
    'width' => '35%',
    'label' => 'LBL_ACCOUNT_NAME',
    'default' => true,
    'link' => false,
    'id' => 'account_id',
    'ACLTag' => 'ACCOUNT',
    'name' => 'account_name',
  ),
  'asci_proposal_status_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ASCI_PROPOSAL_STATUS',
    'width' => '10%',
  ),
  'opportunity_type' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'name' => 'opportunity_type',
    'default' => false,
  ),
  'lead_source' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LEAD_SOURCE',
    'name' => 'lead_source',
    'default' => false,
  ),
  'date_closed' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_CLOSED',
    'default' => false,
    'defaultOrderColumn' => 
    array (
      'sortOrder' => 'ASC',
    ),
    'name' => 'date_closed',
  ),
  'amount_usdollar' => 
  array (
    'width' => '15%',
    'label' => 'LBL_AMOUNT_USDOLLAR',
    'default' => false,
    'currency_format' => true,
    'name' => 'amount_usdollar',
  ),
  'sales_stage' => 
  array (
    'width' => '15%',
    'label' => 'LBL_SALES_STAGE',
    'name' => 'sales_stage',
    'default' => false,
  ),
  'probability' => 
  array (
    'width' => '15%',
    'label' => 'LBL_PROBABILITY',
    'name' => 'probability',
    'default' => false,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => false,
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
  'next_step' => 
  array (
    'width' => '10%',
    'label' => 'LBL_NEXT_STEP',
    'name' => 'next_step',
    'default' => false,
  ),
);
