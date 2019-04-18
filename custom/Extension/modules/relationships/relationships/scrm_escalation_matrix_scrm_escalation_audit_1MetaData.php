<?php
// created: 2016-04-15 12:16:58
$dictionary["scrm_escalation_matrix_scrm_escalation_audit_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_escalation_matrix_scrm_escalation_audit_1' => 
    array (
      'lhs_module' => 'scrm_Escalation_Matrix',
      'lhs_table' => 'scrm_escalation_matrix',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Escalation_Audit',
      'rhs_table' => 'scrm_escalation_audit',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_escalation_matrix_scrm_escalation_audit_1_c',
      'join_key_lhs' => 'scrm_escala593_matrix_ida',
      'join_key_rhs' => 'scrm_escald34en_audit_idb',
    ),
  ),
  'table' => 'scrm_escalation_matrix_scrm_escalation_audit_1_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'scrm_escala593_matrix_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_escald34en_audit_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_escalation_matrix_scrm_escalation_audit_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_escalation_matrix_scrm_escalation_audit_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_escala593_matrix_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_escalation_matrix_scrm_escalation_audit_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_escald34en_audit_idb',
      ),
    ),
  ),
);