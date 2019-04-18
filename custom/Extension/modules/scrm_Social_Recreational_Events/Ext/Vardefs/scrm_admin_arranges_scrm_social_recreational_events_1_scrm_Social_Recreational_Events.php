<?php
// created: 2017-05-17 14:16:32
$dictionary["scrm_Social_Recreational_Events"]["fields"]["scrm_admin_arranges_scrm_social_recreational_events_1"] = array (
  'name' => 'scrm_admin_arranges_scrm_social_recreational_events_1',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_scrm_social_recreational_events_1',
  'source' => 'non-db',
  'module' => 'scrm_Admin_Arranges',
  'bean_name' => 'scrm_Admin_Arranges',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SOCIAL_RECREATIONAL_EVENTS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'id_name' => 'scrm_admin783erranges_ida',
);
$dictionary["scrm_Social_Recreational_Events"]["fields"]["scrm_admin_arranges_scrm_social_recreational_events_1_name"] = array (
  'name' => 'scrm_admin_arranges_scrm_social_recreational_events_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SOCIAL_RECREATIONAL_EVENTS_1_FROM_SCRM_ADMIN_ARRANGES_TITLE',
  'save' => true,
  'id_name' => 'scrm_admin783erranges_ida',
  'link' => 'scrm_admin_arranges_scrm_social_recreational_events_1',
  'table' => 'scrm_admin_arranges',
  'module' => 'scrm_Admin_Arranges',
  'rname' => 'name',
);
$dictionary["scrm_Social_Recreational_Events"]["fields"]["scrm_admin783erranges_ida"] = array (
  'name' => 'scrm_admin783erranges_ida',
  'type' => 'link',
  'relationship' => 'scrm_admin_arranges_scrm_social_recreational_events_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_ADMIN_ARRANGES_SCRM_SOCIAL_RECREATIONAL_EVENTS_1_FROM_SCRM_SOCIAL_RECREATIONAL_EVENTS_TITLE',
);
