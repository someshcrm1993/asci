<?php
$module_name = 'scrm_Timetable';
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
		  /*Modified by Ashvin
		  * Date: 12-11-2018
		  * Reason:Reference field: Finalise time table: Yes/No
		    Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
		  * Ticket ID: 3784
		  *	Start 
		  */
        /*Somesh Bawane
        Dt. 27/03/19
        Reason :  In  detailed view of time table, drop down list at edit button, change the text " Send Time Table to PO" to "Send TT to Production", and change the email id to "productionunit@asci.org.in"*/
          4 => 
          array (
            'customCode' => '{if $fields.finalise_c.value=="Yes"}<input  type="submit" class="button" 
              name="create" id="create" value="Send TT to Production" onClick="document.location=\'index.php?module=scrm_Timetable&action=sendTimetableToPO&return_module=scrm_Timetable&return_action=DetailView&id={$fields.id.value}\'">{/if}',
          ),
		  /*Modified by Ashvin
		  * Date: 12-11-2018
		  * Reason:Reference field: Finalise time table: Yes/No
		    Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
		  * Ticket ID: 3784
		  *	End 
		  */
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/scrm_Timetable/detailView.js',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'project_scrm_timetable_1_name',
          ),
          1 => 
          array (
            'name' => 'start_date_c',
            'label' => 'LBL_START_DATE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'end_date_c',
            'label' => 'LBL_END_DATE',
          ),
          1 => 
          array (
            'name' => 'no_of_days_c',
            'label' => 'LBL_NO_OF_DAYS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'programme_code_c',
            'label' => 'LBL_PROGRAMME_CODE',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'timetable_c',
            'studio' => 'visible',
            'label' => 'LBL_TIMETABLE',
            'customCode' => '{include file=\'custom/modules/scrm_Timetable/views/timetable.tpl\'}',
          ),
        ),
        4 => 
        array (
          0 => 'assigned_user_name',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
