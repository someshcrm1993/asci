<?php

/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


require_once('include/MVC/View/views/view.edit.php');

class OpportunitiesViewEdit extends ViewEdit
{
 	
 	function scrm_stationeryViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {

        global $current_user;
        
        $role = ACLRole::getUserRoleNames($current_user->id);
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }else{
            //role is admin
            $role = false;
        }

        $showAsciRef = 2;
        if ($role == false or $role == 'DOTP') {
            $showAsciRef = 3;
        }

        echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Proposal status is Not Awarded and Programme status is Awarded!</p></div>';
        echo <<<JS

        <script>
        	$(document).ready(function(){
                $('#lead_faculty_2_c,#btn_lead_faculty_2_c').on('change blur',function(){
                    if($('#lead_faculty_2_c').val() == $('#lead_faculty_1_c').val()){
                        $('#lead_faculty_2_c').val('');
                        alert('Please select different faculty');   
                    }
                });
                $('#asci_rpf_reference_c').attr('readonly',true);
                $('#asci_rpf_reference_c').after('<b><small>This is an auto-generated field.</small></b>');
                
                if($("#asci_proposal_status_c option:selected").index() > 2){
                    var index = $("#asci_proposal_status_c option:selected").index();
                    for(index = index-1; index >= 0; index--){
                        $('#asci_proposal_status_c option').eq(index).attr('disabled',true);
                    } 
                }
                
                if('{$role}' != 'DOTP'){
                    $('#asci_proposal_status_c option[value="ASC"]').attr('disabled',true);
                    $('#asci_proposal_status_c option[value="SubmittedtoClient"]').attr('disabled',true);
                }
                
                if($('#asci_proposal_status_c').val() == 'MTDFF'){
                    $('#asci_proposal_status_c option[value="EOI"]').attr('disabled',true);
                    $('#asci_proposal_status_c option[value="PUPSWF"]').attr('disabled',true);
                }

        		checkOutcome();
        		$(document).on('change','#asci_proposal_outcome_c',function(){
        			     
        				checkOutcome();
        		});

				$('#duration_in_working_days_c, #number_of_batches_c').change(function(){
                     var total = $('#duration_in_working_days_c').val() * $('#number_of_batches_c').val();
                    $('#total_no_of_calendar_week_c').val(total);
                });
				function checkOutcome(){

        			if($('#asci_proposal_outcome_c').val() == ''){
        				outcomeRemarkHide();
						removeFromValidate('EditView','outcome_remark_c');
        			}else{  
						addToValidate('EditView','outcome_remark_c','varchar',true,'Outcome Remark');
						$('#outcome_remark_c_label').find('.required').remove();
						$('#outcome_remark_c_label').append('<span class="required">*</span>');
        				outcomeRemarkShow();
        			}		
                    if($('#asci_proposal_outcome_c').val() != 'Awarded'){
                        $('#outcome_remark_c_label').closest('tr').next('tr').hide();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').hide();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').hide();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').hide();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').next('tr').hide();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').next('tr').next('tr').hide();
                     }else{
                        $('#outcome_remark_c_label').closest('tr').next('tr').show();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').show();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').show();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').show();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').next('tr').show();
                        $('#outcome_remark_c_label').closest('tr').next('tr').next('tr').next('tr').next('tr').next('tr').next('tr').show();

                     }			
				}        		
                function outcomeRemarkHide(){
					$('#outcome_remark_c_label').hide();
					$('#outcome_remark_c').parent('td').hide();                	
                }

                function outcomeRemarkShow(){
					$('#outcome_remark_c_label').show();
					$('#outcome_remark_c').parent('td').show();                	
                }                           

                // $('#project_opportunities_1_name_label').append('<span class="required">*</span>');
                if($showAsciRef == 2){
                    $('#asci_rpf_reference_c').parent('td').hide();
                    $('#asci_rpf_reference_c_label').hide();
                }
        		// hideICTPSP();
        		// checkProgramme();
          //       $('#programme_type_c').change(function(){
          //           checkProgramme();
        		// });

                // function checkProgramme(){
                //     if($('#programme_type_c').val() == 'Workshop/Seminar/Sponsored'){
                //         showSP();
                //     }else{
                //         showICTP();
                //     }                       
                // }

        		function showICTP(){
	        			
        			$('#total_no_of_calendar_week_c').parent('td').show();	
        			$('#total_no_of_calendar_week_c_label').show();
        			hideSP();
        		}

        		function hideICTP(){
	        			
        			$('#total_no_of_calendar_week_c').parent('td').hide();	
        			$('#total_no_of_calendar_week_c_label').hide();
        		}   

        		function hideSP(){
        			$('#utilisation_cert_req_c_label').hide();
        			$('#utilisation_cert_req_c').parent().parent('td').hide();
        		}

        		function showSP(){
        			$('#utilisation_cert_req_c_label').show();
        			$('#utilisation_cert_req_c').parent().parent('td').show();
        			hideICTP();
        		}

        		function hideICTPSP(){
        			hideICTP();
        			hideSP();
        		}
        		
                //validations
                validations();
                
                $('#programme_status_c, #asci_proposal_outcome_c').change(function(){
                    validations();
                });
                
                function validations(){
                    
                    if($('#programme_status_c').val() == "Awarded" && $('#asci_proposal_outcome_c').val() == "NA"){
                        $('#dialog').dialog();
                    }
                    
                           
                }
        	});
        </script>
JS;
        
        //call parent display method
        parent::display();
    }
}


?>
