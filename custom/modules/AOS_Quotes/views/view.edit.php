<?php

require_once('include/MVC/View/views/view.edit.php');
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


class AOS_QuotesViewEdit extends ViewEdit
{
 	
 	function AOS_QuotesViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
        
// 		echo <<<EOD
// 		<script>
// 			$(document).ready(function(){
// 				$('#project_aos_quotes_1_name_label').append('<span class="required">*</span>');
// 				addToValidate('EditView','project_aos_quotes_1_name','project_aos_quotes_1_name',true,'Programme Title');
// 				programmeType();
// 				$('#programme_type_c').on('change',function(){
// 					programmeType();
// 				});

// 				function programmeType(){
					
// 					if($('#programme_type_c').val() == 'Announced'){
// 						$('#no_of_participants_c_label').parent().hide();
// 						$('#participant_c_label').parent().show();
// 						$('#line_items_label').parent().show();
// 					}else{
// 						$('#participant_list_c').val('');
// 						$('#no_of_participants_c_label').parent().show();
// 						$('#participant_c_label').parent().hide();
// 						$('#line_items_label').parent().hide();
// 					}
// 				}

// 				$('#no_of_participants_c').on('blur change',function(){
// 					calculateAmount('','ICTP');
// 				});

// 				function calculateAmount(participant_array,type)
// 				{
// 					var tax_amount = 0;
// 					var s_t_c = 0;
// 					var s_b_c = 0;
// 					var k_k_c = 0;
// 					var total_amount = 0;
// 					var programme_fee = parseFloat($('#programme_fee_c').val());
// 					var discount_in_per_c = $('#discount_in_per_c').val();
// 					var discount_amount = 0;
// 					if(type == "ICTP"){
// 						total_amt = programme_fee * $('#no_of_participants_c').val();
// 					}else{
// 						total_amt = programme_fee * participant_array.length;
// 					}
// 					if(discount_in_per_c){
// 						discount_amount = programme_fee * discount_in_per_c/100;
// 					}
// 					subtotal_amount = total_amt - discount_amount; 
// 					s_t_c = subtotal_amount * 0.14;
// 					s_b_c = subtotal_amount * 0.005;
// 					k_k_c = subtotal_amount * 0.005;
// 					tax_amount = s_t_c + s_b_c + k_k_c;
// 					total_amount = subtotal_amount + tax_amount;
// 					$('#total_amt').val(parseFloat(total_amt).toFixed(2));
// 					$('#discount_amount').val(parseFloat(discount_amount).toFixed(2));
// 					$('#subtotal_tax_amount').val(parseFloat(subtotal_amount).toFixed(2));
// 					$('#s_t_c').val(parseFloat(s_t_c).toFixed(2));
// 					$('#s_b_c').val(parseFloat(s_b_c).toFixed(2));
// 					$('#k_k_c').val(parseFloat(k_k_c).toFixed(2));
// 					$('#tax_amount').val(parseFloat(tax_amount).toFixed(2));
// 					$('#total_amount').val(parseFloat(total_amount).toFixed(2));
// 				}
// 			});
// 		</script>
// EOD;


		$this->ss->assign('id',$this->bean->id);
		$this->ss->assign('view','EditView');
		$this->populateInvoiceTemplates();
		global $current_user;

		$role = ACLRole::getUserRoleNames($current_user->id);
		if (count($role)>0 && isset($role[0])) {
		    $role = $role[0];
		}else{
			//role is admin
		    $role = 'admin';
		}        
		if($this->bean->proforma_stage_c == 'Closed for updates'){
			$params = array(
			  'module'=> 'AOS_Quotes',
			  'action'=>'DetailView', 
			  'record' => $this->bean->id,
			  'message' => 'You may not be authorized to edit the proforma invoice, since it is closed for updates'
			);
			SugarApplication::redirect('index.php?' . http_build_query($params));
		}
		if($role == 'PO(M1,M2,M3)' && $this->bean->proforma_stage_c != 'Draft-Proforma Invoice'){
			$params = array(
			  'module'=> 'AOS_Quotes',
			  'action'=>'DetailView', 
			  'record' => $this->bean->id,
			  'message' => 'You may not be authorized to edit the proforma invoice'
			);
			SugarApplication::redirect('index.php?' . http_build_query($params));
		}
		if($role == 'FO' && empty($this->bean->id)){
			$params = array(
			  'module'=> 'AOS_Quotes',
			  'action'=>'DetailView', 
			  'message' => 'You may not be authorized to create the proforma invoice'
			);
			SugarApplication::redirect('index.php?' . http_build_query($params));
		}

		// if ($this->bean->billing_account_id) {
		// 	$accountBean = BeanFactory::getBean('Accounts',$this->bean->billing_account_id);
		// 	$this->bean->client_gst1_c = $accountBean->client_gst1_c;
		// }
		
		if(empty($this->bean->id) && !empty($_REQUEST['project_aos_quotes_1project_ida'])){
			$programme = BeanFactory::getBean('Project',$_REQUEST['project_aos_quotes_1project_ida']);
	        $this->bean->programme_type_c = $programme->programme_type_c;
	        $this->bean->programme_fee_c = $programme->programme_fee_c;
	        $this->bean->programme_fee_non_res_c = $programme->programme_fee_non_res_c;
	        $this->bean->name = $programme->programme_id_c;
	        $this->bean->no_of_days_c = $programme->no_of_days_c;
	        $this->bean->minimum_no_participant_c = $programme->no_of_participants_c;
	        $this->bean->status = '';
	    }else{
	    	$programme = BeanFactory::getBean('Project',$this->bean->project_aos_quotes_1project_ida);
	    }
	    
	    if ($programme) {
		    $nominationList = $programme->get_linked_beans('project_contacts_2');
		    $invoicedOrganisation = $programme->get_linked_beans('project_aos_quotes_1');
	    }else{
	    	$nominationList = array();
	    	$invoicedOrganisation = array();
	    }

	    foreach($invoicedOrganisation as $value){
	    	if($value->proforma_stage_c != 'Cancelled'){
	    		$invoiced[$value->billing_account_id] = $value->billing_account;
	    	}
	    }
	    $invoiced = array_unique($invoiced);
	    foreach($nominationList as $value){
	    	if(!empty($value->sponsor_organisation_c))
	    	$organisations[$value->account_id_c] = $value->sponsor_organisation_c;
	    }
	    // ob_clean();
	    // print_r(str_replace("&#039", '', $organisations['5adffe8c-8f5b-7f29-c697-5a7d884400dc']));exit;
	    if(empty($this->bean->id)){
		    $organisationList = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Organisation Name</th><th>Invoice Status</th> </tr> </thead> <tbody style="text-align:center !important">';
	            foreach ($organisations as $organisationsId => $organisationName) {
	                if(isset($invoiced[$organisationsId])){
	                    $organisationList .= '<tr><td>'.$organisationName.'</td><td><span class="label label-success">Invoiced</span></td></tr>'; 
	                }else{
	                    $organisationList .= '<tr><td><a onclick="sendValues(\''.$organisationsId.'\',\''.str_replace("&#039", '', $organisationName).'\');" data-name="'.$organisationName.'"  data-id ="'.$organisationsId.'" class="organisation">'.$organisationName.'</a></td><td><span class="label label-info">Not Invoiced</span></td></tr>'; 
	                }
	                
	        }
	        // print_r($organisationList);exit();
        $organisationList .='</tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>';
        echo $organisationList;
	    }else{
	    	$organisationList = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Organisation Name</th><th>Invoice Status</th> </tr> </thead> <tbody style="text-align:center !important">';
	            foreach ($organisations as $organisationsId => $organisationName) {
	                    $organisationList .= '<tr><td><a onclick="sendValues(\''.$organisationsId.'\',\''.str_replace("&#039", '', $organisationName).'\');" data-name="'.$organisationName.'"  data-id ="'.$organisationsId.'" class="organisation">'.$organisationName.'</a></td><td><span class="label label-info">Not Invoiced</span></td></tr>'; 
	                
	        }
	        // print_r($organisationList);exit();
        $organisationList .='</tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>';
        echo $organisationList;
	    }
	    
        

		//fetch current user role
		
		echo <<<EOD
		<script>
		function sendValues(id,name){
			$('#billing_account').val(name);
			$('#billing_account_id').val(id);
			$('#myModal').modal('toggle');
		}
			$(document).ready(function(){

				$("#proforma_stage_c option[value='Draft-Proforma Invoice']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='PO Verified']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='FOEXE Reviewed & confirmed']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='FOEXE Reviewed but not confirmed']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='Approved by PO']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='Proforma sent to client']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='Ready to invoice']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='Cancelled']").attr('disabled','disabled');
				$("#proforma_stage_c option[value='Closed for updates']").attr('disabled','disabled');
				
				if('$role' == 'PO(M1,M2,M3)'){
					$("#proforma_stage_c option[value='Draft-Proforma Invoice']").attr('disabled',false);
				}
				if('$role' == 'PO' && ('{$this->bean->proforma_stage_c}' == 'Draft-Proforma Invoice' || '{$this->bean->proforma_stage_c}' == 'PO Verified' || '{$this->bean->proforma_stage_c}' == 'FOEXE Reviewed but not confirmed')){
					$("#proforma_stage_c option[value='Draft-Proforma Invoice']").attr('disabled',false);
					$("#proforma_stage_c option[value='PO Verified']").attr('disabled',false);
				}

				if('$role' == 'PO' && ('{$this->bean->proforma_stage_c}' == 'FOEXE Reviewed & confirmed')){
					$("#proforma_stage_c option[value='Draft-Proforma Invoice']").attr('disabled',false);
					$("#proforma_stage_c option[value='PO Verified']").attr('disabled',false);
					$("#proforma_stage_c option[value='Approved by PO']").attr('disabled',false);
				}

				if('$role' == 'PO' && ('{$this->bean->proforma_stage_c}' == 'Approved by PO' || '{$this->bean->proforma_stage_c}' == 'Proforma sent to client' || '{$this->bean->proforma_stage_c}' == 'Ready to invoice' || '{$this->bean->proforma_stage_c}' == 'Cancelled' || '{$this->bean->proforma_stage_c}' == 'Closed for updates')){
					$("#proforma_stage_c option[value='Draft-Proforma Invoice']").attr('disabled',false);
					$("#proforma_stage_c option[value='PO Verified']").attr('disabled',false);
					$("#proforma_stage_c option[value='Approved by PO']").attr('disabled',false);
					$("#proforma_stage_c option[value='Proforma sent to client']").attr('disabled',false);
					$("#proforma_stage_c option[value='Ready to invoice']").attr('disabled',false);
					$("#proforma_stage_c option[value='Cancelled']").attr('disabled',false);
					$("#proforma_stage_c option[value='Closed for updates']").attr('disabled',false);
				}

				if('$role' == 'FO' && ('{$this->bean->proforma_stage_c}' == 'PO Verified' || '{$this->bean->proforma_stage_c}' == 'FOEXE Reviewed but not confirmed')){
					$("#proforma_stage_c option[value='FOEXE Reviewed & confirmed']").attr('disabled',false);
					$("#proforma_stage_c option[value='FOEXE Reviewed but not confirmed']").attr('disabled',false);
				}

				if($('#special_note_c').val() == 'No'){
					$('#note_c').parent().parent().hide();
				}else{
					$('#note_c').parent().parent().show();
				}
				$('#special_note_c').on('change',function(){
					if($('#special_note_c').val() == 'No'){
						$('#note_c').parent().parent().hide();
					}else{
						$('#note_c').parent().parent().show();
					}
				});
				$('#subtotal_tax_amount').attr('readonly',true);
				$('#cgst_c').attr('readonly',true);
				$('#sgst_c').attr('readonly',true);
				$('#igst_c').attr('readonly',true);
				$('#ugst_c').attr('readonly',true);
				$('#tax_amount').attr('readonly',true);
				$('#total_amount').attr('readonly',true);
				$('input[type=text]').each(function(){
						$(this).val($(this).val().replace(',',''));
					});
					
                $('#SAVE_HEADER').click(function(){
                    $(this).attr('disabled', true);

                    setTimeout(function(){
                        $('#SAVE_HEADER').attr('disabled', false);
                    },5000);
                });
				
				poApproval();
				function poApproval(){
					if('$role' == 'PO(M1,M2,M3)' || '$role' == 'PO' || '$role' == 'po'){
						$('#approval_po_c').attr('disabled',false);						
					}else{
						$('#approval_po_c').attr('disabled',true);												
					}
				}
				
				
				if('$role' == 'FO'){
					FO();	
				}
				if('$role' != 'FO'){
					$('#fo_approval_c').attr('disabled',true);	
				}
				
				function FO(){
					$('#due_date_trigger').hide();					
					$("#EditView :input").prop("readonly", true);
					$('#btn_project_aos_invoices_1_name').attr('disabled',true);
					$('#btn_clr_project_aos_invoices_1_name').attr('disabled',true);
					
					$('#btn_assigned_user_name').attr('disabled',true);
					$('#btn_clr_assigned_user_name').attr('disabled',true);

					$('#org').attr('disabled',true);
					$('#btn_clr_billing_account').attr('disabled',true);
					$('#invoice_date').attr('readonly',false);
					
				}

				$('#btn_billing_account').after('<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><img src="themes/default/images/id-ff-select.png"></button> ');

				$('#btn_billing_account').hide();

				$('#project_aos_quotes_1_name_label').append('<span class="required">*</span>');
				addToValidate('EditView','project_aos_quotes_1_name','project_aos_quotes_1_name',true,'Programme Title');
				if($('#status').val() == 'Paid'){
					$('#payment_mode_c_label').parent().show();
				}else{
					$('#payment_mode_c_label').parent().hide();
				}
				reasonForCancelation();
				$('#proforma_stage_c').on('change',function(){
					reasonForCancelation();
				});
				$('#status').on('change',function(){
					if($('#status').val() == 'Paid'){
						$('#payment_mode_c_label').parent().show();
					}else{
						$('#payment_mode_c_label').parent().hide();
					}
				})
			});
			function reasonForCancelation(){
				if($('#proforma_stage_c').val() == 'Cancelled'){
						$('#description_label').parent().show();
					}else{
						$('#description_label').parent().hide();
					}
			}
		</script>
EOD;
		parent::display();

    }
	
	function populateInvoiceTemplates(){
		global $app_list_strings;
		
		$sql = "SELECT id, name FROM aos_pdf_templates WHERE deleted='0' AND type='AOS_Invoices'";
		$res = $this->bean->db->query($sql);
		
		$app_list_strings['template_ddown_c_list'] = array();
		while($row = $this->bean->db->fetchByAssoc($res)){
			$app_list_strings['template_ddown_c_list'][$row['id']] = $row['name'];
		}
	}
}
