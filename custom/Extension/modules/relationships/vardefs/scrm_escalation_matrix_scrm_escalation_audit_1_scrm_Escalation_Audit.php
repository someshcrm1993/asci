<?php
// created: 2016-04-15 12:16:58
$dictionary["scrm_Escalation_Audit"]["fields"]["scrm_escalation_matrix_scrm_escalation_audit_1"] = array (
  'name' => 'scrm_escalation_matrix_scrm_escalation_audit_1',
  'type' => 'link',
  'relationship' => 'scrm_escalation_matrix_scrm_escalation_audit_1',
  'source' => 'non-db',
  'module' => 'scrm_Escalation_Matrix',
  'bean_name' => 'scrm_Escalation_Matrix',
  'vname' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_MATRIX_TITLE',
  'id_name' => 'scrm_escala593_matrix_ida',
);
$dictionary["scrm_Escalation_Audit"]["fields"]["scrm_escalation_matrix_scrm_escalation_audit_1_name"] = array (
  'name' => 'scrm_escalation_matrix_scrm_escalation_audit_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_MATRIX_TITLE',
  'save' => true,
  'id_name' => 'scrm_escala593_matrix_ida',
  'link' => 'scrm_escalation_matrix_scrm_escalation_audit_1',
  'table' => 'scrm_escalation_matrix',
  'module' => 'scrm_Escalation_Matrix',
  'rname' => 'name',
);
$dictionary["scrm_Escalation_Audit"]["fields"]["scrm_escala593_matrix_ida"] = array (
  'name' => 'scrm_escala593_matrix_ida',
  'type' => 'link',
  'relationship' => 'scrm_escalation_matrix_scrm_escalation_audit_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_AUDIT_TITLE',
);
