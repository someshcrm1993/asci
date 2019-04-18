<?php
// created: 2016-06-08 11:12:12
$dictionary["Lead"]["fields"]["scrm_partners_leads_1"] = array (
  'name' => 'scrm_partners_leads_1',
  'type' => 'link',
  'relationship' => 'scrm_partners_leads_1',
  'source' => 'non-db',
  'module' => 'scrm_Partners',
  'bean_name' => 'scrm_Partners',
  'vname' => 'LBL_SCRM_PARTNERS_LEADS_1_FROM_SCRM_PARTNERS_TITLE',
  'id_name' => 'scrm_partners_leads_1scrm_partners_ida',
);
$dictionary["Lead"]["fields"]["scrm_partners_leads_1_name"] = array (
  'name' => 'scrm_partners_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_PARTNERS_LEADS_1_FROM_SCRM_PARTNERS_TITLE',
  'save' => true,
  'id_name' => 'scrm_partners_leads_1scrm_partners_ida',
  'link' => 'scrm_partners_leads_1',
  'table' => 'scrm_partners',
  'module' => 'scrm_Partners',
  'rname' => 'name',
);
$dictionary["Lead"]["fields"]["scrm_partners_leads_1scrm_partners_ida"] = array (
  'name' => 'scrm_partners_leads_1scrm_partners_ida',
  'type' => 'link',
  'relationship' => 'scrm_partners_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_PARTNERS_LEADS_1_FROM_LEADS_TITLE',
);
