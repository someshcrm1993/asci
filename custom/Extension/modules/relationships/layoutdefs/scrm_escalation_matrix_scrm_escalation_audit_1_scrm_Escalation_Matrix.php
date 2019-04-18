<?php
 // created: 2016-04-15 12:16:58
$layout_defs["scrm_Escalation_Matrix"]["subpanel_setup"]['scrm_escalation_matrix_scrm_escalation_audit_1'] = array (
  'order' => 100,
  'module' => 'scrm_Escalation_Audit',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_AUDIT_TITLE',
  'get_subpanel_data' => 'scrm_escalation_matrix_scrm_escalation_audit_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
