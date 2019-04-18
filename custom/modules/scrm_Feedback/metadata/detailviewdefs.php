<?php
$module_name = 'scrm_Feedback';
$_object_name = 'scrm_feedback';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 
          array (
            'customCode' => '<input type="submit" class="button" name="create" id="individualFeedback" value="Download Feedback" onClick="document.location=\'index.php?module=scrm_Feedback&action=downloadFeedback&return_module=scrm_Feedback&return_action=DetailView&id={$fields.id.value}\'">>',
          ),
          )        
      ),
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
            'name' => 'project_scrm_feedback_1_name',
          ),
          1 => 'document_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'topics_include_c',
            'studio' => 'visible',
            'label' => 'LBL_TOPICS_INCLUDE',
          ),
          1 => 
          array (
            'name' => 'overall_rating_c',
            'studio' => 'visible',
            'label' => 'LBL_OVERALL_RATING',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'topics_not_relevant_c',
            'studio' => 'visible',
            'label' => 'LBL_TOPICS_NOT_RELEVANT',
          ),
          1 => 
          array (
            'name' => 'weighted_avg_rating_overall_c',
            'label' => 'LBL_WEIGHTED_AVG_RATING_OVERALL',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'offer_other_programms_c',
            'studio' => 'visible',
            'label' => 'LBL_OFFER_OTHER_PROGRAMMS',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'learning_outcomes_c',
            'studio' => 'visible',
            'label' => 'LBL_LEARNING_OUTCOMES',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'attend_asci_programmes_c',
            'studio' => 'visible',
            'label' => 'LBL_ATTEND_ASCI_PROGRAMMES',
          ),
        ),
        6 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'scrm_feedback_contacts_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
